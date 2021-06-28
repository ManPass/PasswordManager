<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegRequest;
use App\Services\AuthService;
use App\Services\CookieService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\Role;
use Illuminate\Support\Str;
//use App\Http\Requests\RegistraionRequest;
use App\Models\User;
class AuthController extends Controller
{
    protected $authService;
    protected $cookieService;
    public function __construct(AuthService $authService,CookieService $cookieService){
        $this->authService = $authService;
        $this->cookieService = $cookieService;
    }

    public function login(Request $request){
        if (($user = $this->authService->login($request))!=null){
            $cookies = $this->cookieService->allBasicCookie($user);
            return redirect()->route('home')->withCookie($cookies['token'])->withCookie($cookies['login'])
                ->withCookie($cookies['user_id'])->withCookie($cookies['role_id']);
        }
        else return redirect()->route('login')->with("message","wrong email or password");
    }

    public function registration(RegRequest $request){
        if ($this->authService->registration($request) == true)
            return redirect()->route('login')->with('message','регистрация успешна');
        else
            return redirect()->route('registration')->with('message','Данный логин уже занят');
    }
    public function logout(Request $request){
        return redirect()->route('login')->withCookie(Cookie::forget('role_id'))->
        withCookie(Cookie::forget('token'))->withCookie(Cookie::forget('user_id'));
    }
}
