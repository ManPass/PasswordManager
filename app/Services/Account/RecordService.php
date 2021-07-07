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
        if(request()->ispersonal)
        {
            foreach($user->records as $record)
            {
                if(!count($record->roles))
                    $records->add($record);
            }
        }
        if(request()->input("roles") == null)
        {
            return $records;
        }

        $userRoles = $this->getFilterRoles();
        foreach($userRoles as $userRole)
        {
            foreach($userRole->records as $record)
            {
                    $records->add($record);
            }
        }

        return $records->unique();
    }

    public function attachRecord($record)
    {
        $user = $this->getUser();
        $userRoles = $this->getFilterRoles();
        foreach($userRoles as $userRole)
        {
            $record->roles()->attach($userRole["id"]);
        }
    }

    public function addPersonalRecord($record)
    {
        $this->getUser()->records()->save($record);
    }

    private function getFilterRoles()
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

    public function getSearchableRecords()
    {
        $choose = request()->choose;
        $search = request()->search;
        $searchableRecords = new Collection();
        $searchableArray[] = $this->getUser()->records()->where($choose , 'LIKE' , '%' . $search . '%')->get();

        foreach($this->getRoles() as $role)
        {
            $searchableArray[] = $role->records()->where($choose, 'LIKE', '%' . $search . '%')->get();
        }

        foreach($searchableArray as $collection)
        {
            foreach($collection as $record)
            {
                $searchableRecords->add($record);
            }

        }

        return $searchableRecords;
    }

    public function getRoles()
    {
        return $this->getUser()->roles ?? [];
    }

    public function getRecord($id)
    {
        return Record::find($id);
    }
}
