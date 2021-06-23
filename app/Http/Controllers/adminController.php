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

        $UserRoles = [];
        $count = 0;
        foreach($allUsers as $user){
            $rolesArr = UserRole::all()->where('user_id',$user->id);
            $rolesEl = [];
            foreach($rolesArr as $role){
                //dd($role['role_id']);
                $rolesEl[] = Role::find($role['role_id'])['role'];
            }
            $UserRoles[$user->login] = $rolesEl;
            $count++;
        }
        $roles = Role::all();
        return view('admin/admin_page',['data'=> $allUsers, 'UserRoles' => $UserRoles, 'roles' => $roles]);
    }
    public function addRole(Request $request){
        $role = new Role();
        $role->role= $request->input('role');
        $role->save();
        return redirect()->route('admin_page',['answer' => 'ok']);
    }
}
