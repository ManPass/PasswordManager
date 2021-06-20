<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\UserRole;
use App\Models\Role;
//use App\Http\Requests\RegistraionRequest;
use App\Models\users;
class AuthController extends Controller
{
    public function login(Request $request){
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
        
        //$loginCookie = $request->cookie('login'); //получение коков
        
        //if ($request->cookie('login')||$request->cookie('valid')){
        //    echo $request->cookie('login'). ' ' . $request->cookie('valid');
        //}
        
        /*сделать переход Route на Home в этом методе
        *сделать при обращении ко всем роутам проверку куки юзера(регистрацию и аутендификацию)
        *убрать из стандартного шаблона Registraion и Login, и добавить Logout
        *убрать из шаблона аутендификации все кроме Registraion и Login
        */
        return redirect()->route('home')->withCookie($coockie)->withCookie($coockieValid);
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
        return redirect()->route('login')->withCookie(Cookie::forget('login'))->
        withCookie(Cookie::forget('valid'));
    }
}
