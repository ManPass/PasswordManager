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
    public function deleteRole(Request $request){
        $user = users::where('id',$request['user'])->get();

        $role = Role::where('role',$request['role'])->get()->first()->id;
        $user_role = UserRole::where('user_id',$request['user'])->where('role_id',$role)->get()->first();
        $user_role->delete();
        //$this->showAllUsers($request);
        //dd($role);
        return redirect()->route('admin_page',['answer' => 'role_successful_deleted']);
    }
    public function addRoleToUser(Request $request){

        $user = users::where('id',$request['user'])->get();

        $user_role = new UserRole();
        $user_role->user_id = $request['user'];
        $user_role->role_id = $request['role_id'];
        $user_role->save();

        return redirect()->route('admin_page',['answer' => 'role_successful_add']);
    }
}
