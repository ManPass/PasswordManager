<?php

namespace App\Services\Account;

use App\Models\Record;
use App\Models\User;

class RecordService
{
    private function getUser()
    {
        return User::find(request()->cookie('user_id'));
    }
    public function getRecords()
    {
        $user = $this->getUser();
        $records[] = $user->records;
        $userRoles = $user->roles;
        foreach($userRoles as $userRole)
        {
            $records[] = $userRole->records;
        }

        return $records ?? [];
    }

    public function getPersonalRecords()
    {
        return $this->getUser()->records ?? [];
    }

    public function addPersonalRecord($record)
    {
        $this->getUser()->records()->save($record);
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
