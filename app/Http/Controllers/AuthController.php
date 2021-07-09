<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegRequest;
use App\Models\Expectant;
use App\Services\Auth\AuthService;
use App\Services\Auth\CookieService;
use App\Services\Email\EmailService;
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
        if (($user = $this->authService->loginValid($request))!=null){
            $cookies = $this->cookieService->allBasicCookie($user);
            return redirect()->route('records-data')->withCookie($cookies['token'])->withCookie($cookies['login'])
                ->withCookie($cookies['user_id'])->withCookie($cookies['role_id']);
        }
        else return redirect()->route('login')->with("message","Неверный email или пароль");
    }

    public function registration(RegRequest $request){
        if ($this->authService->registrationValid($request,new EmailService()) == true)
            return redirect()->route('login')->with('message_success','Подтвердите ваш акаунт на почте');
        else
            return redirect()->route('registration')->with('message','Данный логин уже занят');
    }
    public function registrationConfirm(Request $request){
        if ($this->authService->createUser($request->input('token'))==true)
            return redirect()->route('login')->with('message_success','Регистрация успешна');
        else return redirect()->route('login')->with('message','Упс некорректные данные');
        //dd(Expectant::where('token', $request->input('token'))->first()->login);
    }
    public function logout(Request $request){
        return redirect()->route('login')->withCookie(Cookie::forget('role_id'))->
        withCookie(Cookie::forget('token'))->withCookie(Cookie::forget('user_id'));
    }
}
