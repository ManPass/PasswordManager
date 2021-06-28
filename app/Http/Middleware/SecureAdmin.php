<?php

namespace App\Http\Middleware;

use App\Policies\AuthPolice;
use Closure;
use Illuminate\Http\Request;

class SecureAdmin
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
    public function handle(Request $request, Closure $next){
        if (($validRequest = $this->authPolice->adminValid($request))!=null)
            return $next($validRequest);
        else
            return redirect()->route('records-data');
    }
}
