<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PartnerAuth
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
        $user  = session('partner');
        if(!$user) {
            //$request->session('user',$)
            
           return redirect()->route('web.getLoginWithEmail',['type'=>'partner']);
        }

        return $next($request);
    }
}
