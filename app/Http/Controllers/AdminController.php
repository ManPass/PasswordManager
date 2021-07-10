<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\Admin\AdminService;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function showAllUsers(Request $request, AdminService $adminService){
        return view('admin/admin-page',['data'=> $adminService->showAllUsers($request) ,
            'roles' => Role::all()]);
    }
    public function addRole(Request $request,AdminService $adminService){
        $adminService->addRole($request);

        return redirect()->route('admin-page',['answer' => 'ok']);
    }
    public function deleteRoleToUser(Request $request,AdminService $adminService){
        $adminService->deleteRoleToUser($request);

        return redirect()->route('admin-page',['answer' => 'role_successful_deleted']);
    }
    public function addRoleToUser(Request $request,AdminService $adminService){

        $adminService->addRoleToUser($request);
        return redirect()->route('admin-page',['answer' => 'role_successful_add']);
    }
}
