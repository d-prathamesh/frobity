<?php

namespace App\Http\Middleware;

use Closure;
use Razorpay\Api\Api;

class SubscriptionValidator
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
        $user = $request->user();
        $api = new Api(env('RAZOR_API_KEY'), env('RAZOR_API_SECRET'));
        if($user->service_type < 6){
            if($user->subscription_id){
                try{
                    $subscription = $api->subscription->fetch($user->subscription_id);
                    if($subscription){
                        if(in_array($subscription->status,['active','authenticated'])){
                            return $next($request);
                        }else{
                            return response(['isSuccess'=>false,"result"=>[],'message'=>"You subscription no longer active"],500);
                        }
                    }else{
                        return response(['isSuccess'=>false,"result"=>[],'message'=>"You haven't subscription"],500);
                    }
                }catch(\Exception $e){
                    return response(['isSuccess'=>false,"result"=>[],'message'=>"Error to fetch subscription"],500);
                }
                
            }else{
                return response(['isSuccess'=>false,"result"=>[],'message'=>"You haven't subscription"],500);
            }
        }else{
            return $next($request);
        }
       
       
    }
}
