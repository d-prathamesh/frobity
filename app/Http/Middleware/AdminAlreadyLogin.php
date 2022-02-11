<?php

namespace App\Http\Middleware;

use Closure;

class AdminAlreadyLogin
{

    public function handle($request, Closure $next)
    {
        if ($request->session()->exists('admin_data')) {
            // user value cannot be found in session
            return redirect()->route('dashboard');
        }

        return $next($request);
    }

}