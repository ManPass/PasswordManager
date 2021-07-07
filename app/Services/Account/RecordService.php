<?php

namespace App\Services\Account;

use App\Http\Requests\RecordRequest;
use App\Models\Record;
use App\Models\User;

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
     * @return array
     */
    public function getRecords(): array
    {
        $user = $this->getUser();
        $records = [];
        if(request()->ispersonal)
        {
            $records[] = $user->records;
        }
        $userRoles = $this->getFilterRoles();
        foreach($userRoles as $userRole)
        {
            $records[] = $userRole->records;
        }

        return $records;
    }

    public function addPersonalRecord($record)
    {
        $this->getUser()->records()->save($record);
    }

    private function getFilterRoles()
    {
        $filterRoles = request()->input("roles");
        if(!isset($filterRoles))
        {
            return $this->getUser()->roles ?? [];
        }
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
        $searchableRecords[] = $this->getUser()->records()->where($choose , 'LIKE' , '%' . $search . '%')->get();

        foreach($this->getRoles() as $role)
        {
            $searchableRecords[] = $role->records()->where($choose , 'LIKE' , '%' . $search . '%')->get();
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
