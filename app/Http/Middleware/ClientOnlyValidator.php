<?php

namespace App\Http\Middleware;

use Closure;

class ClientOnlyValidator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($request->user()->user_type==0){
             return response(['isSuccess'=>false,'message'=>'No Permission to access this resource','result'=>[]],403);
            
        }
        
        return $next($request);
    }
}
