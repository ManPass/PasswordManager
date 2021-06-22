<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\UserRole;
use App\Models\users;
use Illuminate\Http\Request;
class adminController extends Controller
{
    public function showAllUsers(Request $request){
        $allUsers = users::all();
        $roles = [];
        $count = 0;
        foreach($allUsers as $user){
            $rolesArr = UserRole::all()->where('user_id',$user->id);
            $rolesEl = [];
            foreach($rolesArr as $role){
                //dd($role['role_id']);
                $rolesEl[] = Role::find($role['role_id'])['role'];
            }
            $roles[$user->login] = $rolesEl;
            $count++;
        }

        return view('admin/admin_page',['data'=> $allUsers, 'roles' => $roles]);
    }
}
