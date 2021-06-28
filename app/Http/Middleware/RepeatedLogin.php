<?php

namespace App\Http\Middleware;

use App\Policies\AuthPolice;
use Closure;
use Illuminate\Http\Request;

class RepeatedLogin
{
    protected $authPolice;
    public function __construct(AuthPolice $authPolice){
        $this->authPolice = $authPolice;
    }
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

        if ($this->authPolice->userValid($request)!=null){
            return redirect()->route('records-data');
        }
        return $next($request);

    }
}
