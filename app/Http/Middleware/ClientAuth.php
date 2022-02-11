<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ClientAuth
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
        $user  = session('client');
        if(!$user) {
            
           return redirect()->route('web.getLoginWithEmail',['type'=>'client']);
        }

        return $next($request);
    }
}
