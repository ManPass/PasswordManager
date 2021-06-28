<?php


namespace App\Services\Admin;


use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminService{
    protected $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    public function deleteRoleToUser(Request $request){
        $this->userService->deleteRole($request->input('role_id'),$request->input('login'));
    }
    public function addRoleToUser(Request $request){

        $this->userService->addRole($request->input('role_id'),$request->input('login'));
    }
    public function showAllUsers(Request $request): array
    {
        if ($request->input('loginSearch') != null) {//если был поиск по конкретному логину

            return $this->dataExtraction([User::where('login', $request->input('loginSearch'))->first()]);
        }
        else
            return $this->dataExtraction(User::all());
    }
    public function addRole(Request $request){
        $role = Role::create([
            'role' => $request->input('role')
        ]);
        $role->save();
    }
    /**
     * @param $users
     * @return array
     * получение массива данных ['login'=>логин пользователя,'roles'=>[['role'=>роль1,'role_id'=>id],..]] для админки
     */
    private function dataExtraction($users): array
    {
        $usersData = [];
        foreach ($users as $user){
            $usersData[] = ['login' => $user->login,'roles' => $user->roles];
        }

        return $usersData;
    }


}
