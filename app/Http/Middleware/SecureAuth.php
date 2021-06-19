<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecureAuth
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
        if($request->cookie('login') != null || $request->cookie('valid') != null){
            return $next($request);
        }
        abort(404);//аборты это выбор женщины, это не убийство!
    }
    
}
