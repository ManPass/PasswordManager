<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RepeatedLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //при переходе на логин или регистрацию уже зарегестрированные пользователи должны
        //пересылаться на домашнюю страницу
        $session = $request->cookie('login') != null && $request->cookie('valid') != null;
        if ($session){
            return redirect()->route('home');
        }
        else {
            return $next($request);
        }
      
    }
}
