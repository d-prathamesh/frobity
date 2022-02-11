<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
{

    public function handle($request, Closure $next)
    {  
      if (!$request->session()->exists('admin_data')) {
            // user value cannot be found in session
            return redirect()->route('admin_login');
        }

        return $next($request);
    }

}