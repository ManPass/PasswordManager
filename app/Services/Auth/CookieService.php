<?php


namespace App\Services\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CookieService
{
    public function cookieToken($user){
        $token = Str::random(60);
        $user->remember_token = Hash::make($token);
        $user->save();
        return cookie('token',$token,60);
    }
    public function cookieLogin(string $login){
        return cookie('login',$login,60);
    }
    public function cookieUserId($userId){
        return cookie('user_id',$userId,60);
    }
    public function cookieDefaultRole(){
        return cookie('role_id',1);
    }

    public function allBasicCookie(User $user){
        return [
            'token' => $this->cookieToken($user),
            'login' => $this->cookieLogin($user->login),
            'user_id' => $this->cookieUserId($user->id),
            'role_id' => $this->cookieDefaultRole()
        ];
    }
}
