<?php


namespace App\Services;


use App\Models\Role;
use App\Models\User;

class UserService{
     public function addRole($role_id,$login){
         $user = User::all()->where('login',$login)->first();
         $user->roles()->attach($role_id);
     }
     public function deleteRole($role_id,$login){
         $user = User::all()->where('login',$login)->first();
         $user->roles()->detach($role_id);
     }

}
