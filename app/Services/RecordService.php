<?php

namespace App\Services;

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
        $usersRoles = $this->getUser()->roles;

        return $usersRoles->find(request()->cookie('role_id'))->records ?? [];
    }

    public function getRoles()
    {
        $roles = $this->getUser()->roles;
        return $this->getUser()->roles ?? [];
    }


    public function getRecord($id)
    {
        return Record::find($id);
    }
}
