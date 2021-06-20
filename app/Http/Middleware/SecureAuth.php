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
        $session = $request->cookie('login') != null && $request->cookie('valid') != null;
        if($session){
            return $next($request);
        }
        else{
            return redirect()->route('login');
        }
        //abort(404);//аборты это выбор женщины, это не убийство!
    }
    
}
