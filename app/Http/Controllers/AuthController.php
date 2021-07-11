<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegRequest;
use App\Http\Requests\ResetRequest;
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
use App\Models\User;
class AuthController extends Controller
{
    public function login(Request $request,AuthService $authService,CookieService $cookieService){
        $user = $authService->getUserByVerifivation($request);
        if ($user != null) {
            $cookies = $cookieService->allBasicCookie($user);
            return redirect()->route('records-data')->withCookie($cookies['token'])->withCookie($cookies['login'])
                ->withCookie($cookies['user_id'])->withCookie($cookies['role_id']);
        }
        else return redirect()->route('login')->with("message","Неверный email или пароль");
    }

    public function registration(RegRequest $request,AuthService $authService){
        if ($authService->registrationValid($request,new EmailService()) == true)
            return redirect()->route('login')->with('message_success','Подтвердите ваш акаунт на почте');
        else
            return redirect()->route('registration')->with('message','Данный логин уже занят');
    }
    public function registrationConfirm(Request $request,AuthService $authService){
        if ($authService->createUser($request->input('token'))==true)
            return redirect()->route('login')->with('message_success','Регистрация успешна');
        else return redirect()->route('login')->with('message','Упс некорректные данные');
    }
    public function logout(){
        return redirect()->route('login')->withCookie(Cookie::forget('role_id'))->
        withCookie(Cookie::forget('token'))->withCookie(Cookie::forget('user_id'));
    }

    public  function forgotPassword(){
        return view('auth/forgot_pass');
    }
    public  function forgotPasswordSubmit(ResetRequest $request,AuthService $authService){
        if ($authService->resetPasswordValid($request,new EmailService()) == true)
            return redirect()->route('forgot-password')->with('message_success','проверьте свою почту');
        else return redirect()->route('forgot-password')->with('message','почта не найдена');
    }
    public  function resetPassword(Request $request){
        return view('auth/change_password')->with('token',$request->input('token'));
    }
    public function resetPasswordSubmit(ChangePasswordRequest $request,AuthService $authService){

        if($authService->changePassword($request) == true)
            return redirect()->route('login')->with('message_success','Пароль успешно изменен');
        else return redirect()->back()->with('message','Reset password session is invalid');

    }
}
