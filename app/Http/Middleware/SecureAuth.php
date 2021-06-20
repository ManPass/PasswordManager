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
            
            //$request->merge(['login'=> $request->cookie('login')]);
            //$request->request->add(['login' => $request->cookie('login')]);
            $request->request->add(['login'=> $request->cookie('login')]);
            return $next($request);
           
        }
        else{
            return redirect()->route('login');
        }
    }
    
}
