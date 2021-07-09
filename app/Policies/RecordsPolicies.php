<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordsPolicies
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function availableToRecord(Request $request):bool{
        $user = User::find($request->cookie('user_id'));
        $record = Record::find($request->id);
        //проверка запись либо личная либо юзер имеет роль как у записи иначе нет доступа
        if ($user->id === $record->user_id ||
            $this->roleConfirmation($user,$record)==true)
            return true;
        return false;
    }

    /***
     * @param $user
     * @param $record
     * @return bool
     * хоть и выглядит как N^2, но почти всегда у записи 1 роль так что средняя работа почти всегда N
     */
    private function roleConfirmation($user,$record):bool{
        foreach ($user->roles as $userRoleModel){
            foreach ($record->roles as $recordRoleModel){
                if ($userRoleModel->role === $recordRoleModel->role) return true;
            }
        }
        return false;
    }
}
