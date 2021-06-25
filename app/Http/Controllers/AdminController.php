<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function showAllUsers(Request $request){
        $allUsers = User::all();

        $UserRoles = [];
        foreach($allUsers as $user){
            $rolesArr = UserRole::all()->where('user_id',$user->id);
            $rolesEl = [];
            foreach($rolesArr as $role){
                $rolesEl[] = Role::find($role['role_id'])['role'];
            }
            $UserRoles[$user->login] = $rolesEl;

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
    public function deleteRoleToUser(Request $request){
        $role = Role::where('role',$request['role'])->get()->first()->id;
        $user_role = UserRole::where('user_id',$request['user'])->where('role_id',$role)->get()->first();
        $user_role->delete();
        return redirect()->route('admin_page',['answer' => 'role_successful_deleted']);
    }
    public function addRoleToUser(Request $request){

        $user_role = new UserRole();
        $user_role->user_id = $request['user'];
        $user_role->role_id = $request['role_id'];
        $user_role->save();

        return redirect()->route('admin_page',['answer' => 'role_successful_add']);
    }
}
