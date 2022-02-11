<?php

namespace App\Http\Middleware;
use Closure;
use App\Log;

class ClientValidator
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
        $token = $request->header('x-api-key');
        if(!$token){
            return response(['isSuccess'=>false,'message'=>'Client auth api key not set','result'=>[]],403);
        }
        
        if(!in_array($token,explode(',',env('CLIENT_AUTHORIZATION_KEYS')))){
            return response(['isSuccess'=>false,'message'=>'Invalid client auth api key ','result'=>[]],403);
        }
        return $next($request);
    }

    public function terminate($request, $response)
    {
        Log::create(['request'=>$request,'response'=>$response]);
    }
}
