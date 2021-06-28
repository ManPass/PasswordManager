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

        if ($request->hasCookie('token') != false && $request->hasCookie('login') != false &&
            $request->hasCookie('user_id') != false){
            return redirect()->route('records-data');
        }
        else {
            return $next($request);
        }

    }
}
