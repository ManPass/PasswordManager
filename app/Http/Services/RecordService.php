<?php

namespace App\Http\Services;

use App\Models\Record;
use App\Models\User;

class RecordService
{
    private function getUser()
    {
        return User::find(request()->cookie('u'));
    }
    public function getRecords()
    {
        $currentRole = $this->getUser()->roles->find(request()->cookie('p'));

        return $currentRole->records ?? [];
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
