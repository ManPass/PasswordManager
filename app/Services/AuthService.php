<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    /**
     * @param Request $request
     * @return string
     */
    public function registration(Request $request){
        if ($this->uniqueLogin($request->input('login')) == false)
            return "Данный логин уже занят";
        $user = User::create(
            [
                'login' => $request->input('login'),
                'password' => Hash::make($request->input('password'))
            ]
        );

        $user->save();

        $user->roles()->attach(1);

        return "Регистрация успешна";

    }
    public function login(Request $request ){

    }
    private function uniqueLogin(string $login):bool{
        foreach (User::all() as $user) {
            if ($login === $user->login)
                return false;
        }
        return true;
    }
}
