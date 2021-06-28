<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\Admin\AdminService;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    protected $adminService;
    public function __construct(AdminService $adminService){
        $this->adminService = $adminService;
    }
    public function showAllUsers(Request $request){

        return view('admin/admin_page',['data'=> $this->adminService->showAllUsers($request) ,
            'roles' => Role::all()]);
    }
    public function addRole(Request $request){
        $this->adminService->addRole($request);

        return redirect()->route('admin_page',['answer' => 'ok']);
    }
    public function deleteRoleToUser(Request $request){
        $this->adminService->deleteRoleToUser($request);

        return redirect()->route('admin_page',['answer' => 'role_successful_deleted']);
    }
    public function addRoleToUser(Request $request){

        $this->adminService->addRoleToUser($request);
        return redirect()->route('admin_page',['answer' => 'role_successful_add']);
    }
}
