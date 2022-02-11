<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsFormRequest;
use App\Service;
use DB;
use App\User;
use App\Services\FcmService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class CommonController extends Controller
{
    public function postContactUs(ContactUsFormRequest $request){
        try{
            return response(['isSuccess'=>true,"message"=>"","result"=>[]]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"message"=>$e->getMessage(),"result"=>[]],400);
        }
    	 
    }

    public function getCategories(){
		
        try{
            /*$categories = Cache::rememberForever('categories', function() {
                return Service::where('parent_id',0)->where('status',1)->with('subcategories')->get();
            });*/
			$categories = Service::where('parent_id',0)->where('status',1)->with('subcategories')->get();
            return response(['isSuccess'=>true,"message"=>"","result"=>$categories]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"message"=>$e->getMessage(),"result"=>[]],400);
        }
    }

    public function getSubcategories(Request $request,$id){
        try{
            $subcategories = Cache::rememberForever('subcategories-'.$id, function() use($id) {
                return Service::with('subcategories')->where('id',$id)->where('parent_id',0)->get(['id','name','form','image_url']);
            });
            return response(['isSuccess'=>true,"message"=>"","result"=>$subcategories]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"message"=>$e->getMessage(),"result"=>[]],400);
        }
        
    }

    public function getTopFreelancers(Request $request){
        try{
            $service_type = $request->input('service_type');
            $subcategories = $request->input('service_sub_type');
            $users =User::where('user_type',0)
                               ->where('service_type',$service_type)
                                //->where('service_sub_type')
                                ->take(25)->select('id','name','email','mobile','image','city','hourly_rate')->get();
            return  response(['isSuccess'=>true,"message"=>"","result"=>$users]);
        }catch(\Exception $e){
           return response(['isSuccess'=>false,"message"=>$e->getMessage(),"result"=>[]],400);
        }
           
    }
    
    public function getSearch(Request $request)
    {
        try{
            $searchResults = [];
            $keyword  = $request->input('q');
            if($keyword){
                $searchResults = Service::with('category')->where('parent_id','<>',0)->where('status',1)->where('name','LIKE',"%$keyword%")->take(50)->get();
                if(count($searchResults)==0 ){
                    $searchResults = [];
                }
            }
            return response(['isSuccess'=>true,"message"=>"","result"=>$searchResults]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"message"=>$e->getMessage(),"result"=>[]],400);
        }
    }

    public function postNotificationWebhook(Request $request){
        try{
           
            $receiverFirebaseId = $request->input('receiver_firebase_id');
            $senderirebaseId = $request->input('sender_firebase_id');
            $message = $request->input('message');
            $receiver = $request->input('receiver');
            $sender = $request->input('sender');

            $userReceiver = User::find($receiver);
	    $userSender = User::find($sender);
	  if(!$userReceiver){ return response(["isSuccess"=>false,"message"=>"Invalid receiver id"],400); }
 	  if(!$userSender) { return response(["isSuccess"=>false,"message"=>"invalid sender id"],400);} 
            if($userReceiver && $userSender){
                
                $type = $userReceiver->user_type == 0 ? 'PARTNER' : 'CLIENT';
                $payload = [];
                $payload['notification']     = array(
                    "body"             => "You have received new message from ".$userSender->name,
                    "title"            => "New Message request",
                );
                $payload['data']= $request->all();
                $payload['data']['receiver_name'] = $userReceiver->name;
                $payload['data']['sender_name'] = $userSender->name;
                $res=FcmService::sendPushNotification($type,[$userReceiver->device_token],$payload);
	    return response(["isSuccess"=>true,"result"=>$res]);
	    
	    }
            

        }catch(\Exception $e){
            return response(['isSuccess'=>false,"message"=>$e->getMessage(),"result"=>[]],400);
        }
    }

    public function getLogs(Request $request,$days=1){
       $logs = \App\Log::where('created_at',">",Carbon::now()->subDay($days))->orderBy('id','DESC')->get();
       return view('logs',compact('logs'));
    }
}
