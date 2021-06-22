<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\UserRole;
use App\Models\Role;
use Illuminate\Support\Str;
//use App\Http\Requests\RegistraionRequest;
use App\Models\users;
class AuthController extends Controller
{
    public function login(Request $request){

        $user_2 = users::where('login',$request->input('login'))->first();
        if ($user_2 != null && Hash::check($request->input('password'),$user_2->password)){
            $token = Str::random(60);
            $user_2->remember_token = Hash::make($token);//копия хэшированного токена для бд
            $user_2->save();
            $cookie = cookie('tk',$token,60);//копия токена для юзера
            $cookie_log = cookie('l',$user_2->login,60);
            $cookie_user_id = cookie('u',$user_2->id,60);
            $cookie_role = cookie('p','default');
            return redirect()->route('home')->withCookie($cookie)->withCookie($cookie_log)
                ->withCookie($cookie_user_id)->withCookie($cookie_role);
        }
        else {
            return redirect()->route('login')->with("message","wrong email or password");//если юзера нет то бекаем его
        }

        /*
        $user = null;
        foreach(users::all() as $user_el){//поиск юзера
            if ($request->input('login') === $user_el->login &&
            Hash::check($request->input('password'), $user_el->password))
                $user = $user_el;
        }
        if($user != null) {//если юзер найден то создаем ему сессию на 60 минут
            //dd($request->cookie('login'),$request->cookie('valid'));
            $coockie=cookie('login',$request->input('login'),60);
            $coockieValid=cookie('valid','true',60);//можно сюда приписать токен
        }
        else {
            return redirect()->route('login')->with("message","wrong email or password");//если юзера нет то бекаем его
        }
        */

        //$loginCookie = $request->cookie('login'); //получение коков

        //if ($request->cookie('login')||$request->cookie('valid')){
        //    echo $request->cookie('login'). ' ' . $request->cookie('valid');
        //}

        /*сделать переход Route на Home в этом методе
        *сделать при обращении ко всем роутам проверку куки юзера(регистрацию и аутендификацию)
        *убрать из стандартного шаблона Registraion и Login, и добавить Logout
        *убрать из шаблона аутендификации все кроме Registraion и Login
        */

        //return response('login has been success')->withCookie($coockie)->withCookie($coockieValid);
    }

    public function registration(RegRequest $request){

         foreach(users::all() as $user_el){
            if ($request->input('login') === $user_el->login)

                return redirect()->route('registraion')->with("message","this email already exist");
        }

        $user = new Users();
        $user->login = $request->input('login');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        $user_role = new UserRole();
        $user_role->user_id = $user->id;
        $user_role->role_id = Role::where('role','Default')->first()['id'];

        $user_role->save();
        //после регистрации перенаправляет на login
        return redirect()->route('login');

    }
    public function logout(Request $request){
        //dd($request);
        return redirect()->route('login')->withCookie(Cookie::forget('l'))->
        withCookie(Cookie::forget('tk'))->withCookie(Cookie::forget('u'));
    }
}
