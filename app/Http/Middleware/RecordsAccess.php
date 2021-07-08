<?php

namespace App\Http\Middleware;

use App\Policies\RecordsPolicies;
use Closure;
use Illuminate\Http\Request;

class RecordsAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $recordsPolicies;
    public function __construct(RecordsPolicies $recordsPolicies){
        $this->recordsPolicies = $recordsPolicies;
    }
    public function handle(Request $request, Closure $next)
    {
        if($this->recordsPolicies->availableToRecord($request))
            return $next($request);
        return back();
    }
}
