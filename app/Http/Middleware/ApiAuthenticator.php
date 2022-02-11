<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ApiAuthenticator
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
        //app()->handle($request);
        $user  = Auth::guard('token')->user();
        if(!$user) {
            //$request->session('user',$)
            
           return response(['isSuccess'=>false,'message'=>'Invalid token','result'=>[]], 401);
        }

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}
