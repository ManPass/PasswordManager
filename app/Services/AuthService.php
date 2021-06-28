<?php


namespace App\Services;


use App\Models\User;
use App\Policies\AuthPolice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AuthService
{
    protected $authPolice;//проверяет всю логику доступа юзера

    public function __construct(AuthPolice $authPolice){
        $this->authPolice = $authPolice;

    }

    /**
     * @param Request $request
     * @return bool
     */
    public function registration(Request $request):bool{
        if ($this->authPolice->uniqueLogin($request->input('login')) == false)
            return false;
        else
            $user = User::create(
                [
                    'login' => $request->input('login'),
                    'password' => Hash::make($request->input('password'))
                ]
            );
            $user->save();

            $user->roles()->attach(1);

            return true;
    }
    public function login(Request $request ){
        $user = $this->authPolice->userExists($request);//проверка введенных данных
        if ($user == null) return null;
        return $user;
    }

}
