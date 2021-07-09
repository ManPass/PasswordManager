<?php

namespace App\Services\Account;

use App\Http\Requests\RecordRequest;
use App\Models\Record;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class RecordService
{

    /**
     * Получение текущего юзера
     * @return mixed
     */
    private function getUser()
    {
        return User::find(request()->cookie('user_id'));
    }


    /**
     * Получение всех записей, по выбранным ролям
     * @return Collection
     */
    public function getRecords()
    {
        $records = new Collection();
        $user = $this->getUser();
        //Если нужно отобразить личные, получить все личные пароли
        if(request()->ispersonal)
        {
            foreach($user->records as $record)
            {
                if(!count($record->roles))
                    $records->add($record);
            }
        }

        //Если не нужно отображать ролевые пароли, вернуть только личные
        if(request()->input("roles") == null)
        {
            //Если паролей для отображения, тогда отобразить все
            if(count($records)) return $records;
            else return $this->getAllRecords();
        }

        //Получить пароли выбранных ролей
        $userRoles = $this->getFilterRoles();
        foreach($userRoles as $userRole)
        {
            foreach($userRole->records as $record)
            {
                $records->add($record);
            }
        }

        //Предотвратить повторение паролей
        return $records->unique();
    }

    /**
     * Добавление ролевого пароля
     * @param $record
     */
    public function attachRecord($record)
    {
        //Получить все роли, выбранные юзером и присоединить к ним добавленный пароль
        $userRoles = $this->getFilterRoles();
        foreach($userRoles as $userRole)
        {
            $record->roles()->attach($userRole["id"]);
        }
    }

    /**
     * Добавление личного пароля
     * @param $record
     */
    public function addPersonalRecord($record)
    {
        $this->getUser()->records()->save($record);
    }

    /**
     * Получение всех ролей, выбранных юзером
     * @return array
     */
    private function getFilterRoles(): array
    {
        $filterRoles = request()->input("roles");
        $needRoles = [];
        foreach($filterRoles as $frole)
        {
            foreach($this->getUser()->roles as $role)
            {
                if($role->role == $frole)
                {
                    $needRoles[] = $role;
                }
            }
        }

        return $needRoles;
    }

    /**
     * Получение всех искомых паролей
     * @return Collection
     */
    public function getSearchableRecords(): Collection
    {
        $choose = request()->choose;
        $search = request()->search;
        //Объявление коллекции (массив не подойдёт)
        $searchableRecords = new Collection();
        //Поиск паролей среди личных
        $searchableArray[] = $this->getUser()->records()->where($choose , 'LIKE' , '%' . $search . '%')->get();

        //Поиск паролей среди ролевых
        foreach($this->getRoles() as $role)
        {
            $searchableArray[] = $role->records()->where($choose, 'LIKE', '%' . $search . '%')->get();
        }

        //Передача всех найденных паролей в коллекцию
        foreach($searchableArray as $collection)
        {
            foreach($collection as $record)
            {
                $searchableRecords->add($record);
            }

        }
        return $searchableRecords;
    }

    /**
     * Получение всех ролей пользователя
     * @return mixed
     */
    public function getRoles()
    {
        return $this->getUser()->roles ?? [];
    }

    /**
     * Поиск нужного пароля
     * @param $id
     * @return mixed
     */
    public function getRecord($id)
    {
        return Record::find($id);
    }

    private function getAllRecords()
    {
        $records = new Collection();
        foreach($this->getUser()->records as $record)
        {
            $records->add($record);
        }
        foreach($this->getRoles() as $role)
        {
            foreach($role->records as $record)
            {
                $records->add($record);
            }
        }

        return $records->unique();
    }
}
