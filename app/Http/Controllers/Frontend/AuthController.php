<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

use Validator;

class AuthController extends Controller
{
   public function getPartnerLoginAction(){
        return view('frontend.partner.login');
   }

   public function getOtp(Request $request,$type){
    return view('frontend.otp',compact('type'));
   }
   
   public function getEmailOtp(Request $request,$type){
    return view('frontend.emailWithotp',compact('type'));
   }

   public function getLoginWithEmail(Request $request,$type){
    return view('frontend.loginWithEmail',compact('type'));
   }   

   public function postSendOtp(Request $request,$type ){

/*    Validator::make($request->all(), [
        'mobile'=>'required'
    ])->validate();*/

    $userType = $type  == 'client' ? "1"  : "0"; 
    $payload = ["mobile"=>$request->input('mobile'),"user_type"=>"$userType"];
	//print_r($payload);
    
    $request = Request::create('/api/send-otp', 'POST',$payload);
    \Request::replace($payload);
    $request->headers->add(['Content-type'=>'application/json']);
    $request->headers->add(['x-api-key'=>env('WEBCLIENT_KEY')]);
    $response = Route::dispatch($request);
    $responseData = json_decode($response->getContent(), TRUE);
	//echo "in response";
	//print_r($responseData);
	//die();
    if(!$responseData['isSuccess']){
        return \Redirect::back()->withErrors(['mobile'=>$responseData['message']]);
    }else{
        session(['mobile'=>$payload['mobile']]);
        return redirect()->route('web.get-verify-otp',['type'=>$type])->with('success','Please enter otp which we have sent you');
    }

    
   }
   
   public function postEmailSendOtp(Request $request,$type ){

    Validator::make($request->all(), [
        'email'=>'required'
    ])->validate();
    $userType = $type  == 'client' ? "1"  : "0"; 
    $payload = ["email"=>$request->input('email'),"user_type"=>"$userType"];
    print_r($payload);
    $request = Request::create('/api/send-otp', 'POST',$payload);
    \Request::replace($payload);
    $request->headers->add(['Content-type'=>'application/json']);
    $request->headers->add(['x-api-key'=>env('WEBCLIENT_KEY')]);
    $response = Route::dispatch($request);
    $responseData = json_decode($response->getContent(), TRUE);
    echo "in response";
	print_r($responseData);
//	die();
	if(!$responseData['isSuccess']){
        return \Redirect::back()->withErrors(['email'=>$responseData['message']]);
    }else{
        session(['email'=>$payload['email']]);
        return redirect()->route('web.get-verify-otp',['type'=>$type])->with('success','Please enter otp which we have sent you');
    }

    
   }

   public function getVerifyOtp(Request $request,$type){
   
    return view('frontend.verify-otp',compact('type'));
   }

   public function postVerifyOtp(Request $request,$type){
   //echo "step 1";
   Validator::make($request->all(), [
        'otp'=>'required'
    ])->validate();
	//echo "step 2";
    $userType = $type  == 'client' ? "1"  : "0"; 
    $payload = ["email"=>session('email'),"mobile"=>session('mobile'),'otp'=>$request->input('otp'),"user_type"=>"$userType"];
    //echo "step 3";
	$request = Request::create('/api/verify-otp', 'POST',$payload);
    \Request::replace($payload);
    $request->headers->add(['Content-type'=>'application/json']);
    $request->headers->add(['x-api-key'=>env('WEBCLIENT_KEY')]);
    $response = Route::dispatch($request);
    $responseData = json_decode($response->getContent(), TRUE);
    //echo "step 4";
	//echo"<pre>";
	//print_r($_POST);
	
	//print_r($responseData);
	//echo"</pre>";
	//die();
	if(!$responseData['isSuccess']){
        return \Redirect::back()->withErrors(['otp'=>$responseData['message']]);
    }
    else{
        session([$type=>$responseData['result']]);
        return redirect()->route("web.$type.dashboard",['first_login'=>$responseData['result']['login_tried']]);
    }
   }

    public function postLoginWithEmail( Request $request, $type ){
        Validator::make($request->all(), [
        'email'=>'required',
        'password'=>'required'
        ])->validate();

        $userType = $type  == 'client' ? "1"  : "0"; 
        $payload = ["email"=>$request->input('email'),'password'=>$request->input('password'),"user_type"=>"$userType"];
        $request = Request::create('/api/verify-login', 'POST',$payload);
        \Request::replace($payload);
        $request->headers->add(['Content-type'=>'application/json']);
        $request->headers->add(['x-api-key'=>env('WEBCLIENT_KEY')]);
        $response = Route::dispatch($request);
        $responseData = json_decode($response->getContent(), TRUE);
        if(!$responseData['isSuccess']){
            return \Redirect::back()->withErrors(['email'=>"error is ".$responseData['message']]);
        }
        else{
            session([$type=>$responseData['result']]);
            return redirect()->route("web.$type.dashboard",['first_login'=>$responseData['result']['login_tried']]);
        }
        
    }


   
/*
   public function postPartnerLoginAction(){

        $request = Request::create('/api/categories', 'GET');
        $request->headers->add(['x-api-key'=>env('WEBCLIENT_KEY')]);
        $response = Route::dispatch($request);
        $responseData = json_decode($response->getContent(), TRUE);
        $categories = isset($responseData['result']) ? $responseData['result']  :  [];
        $range = [200, 300, 400, 500, 600,700, 800, 900];
        return view('frontend.home',compact('categories','range'));
   }*/

   public function getRegister(Request $request,$type){
    $categories = $this->getServiceTypes();
    return  view('frontend.register',compact('categories','type'));
   }

   public function postRegister(Request $request,$type){

    $validations = [
        'name'=>'required',
        'mobile'=>'required',
        'email'=>'required',
        'password'=>'required|min:6'
    ];
    if($type == 'partner'){
        $validations['service_type'] = 'required';
    }

    Validator::make($request->all(), $validations)->validate();

    $userType = $type  == 'client' ? "1"  : "0"; 
    $payload = $request->only(['name','email','mobile','password','service_type']);
    $payload['user_type']=$userType;
    $payload['device_type'] = "web";
    $payload['device_id'] ="device_token";


    $request = Request::create('/api/signup', 'POST',$payload);
    \Request::replace($payload);
    $request->headers->add(['Content-type'=>'application/json']);
    $request->headers->add(['x-api-key'=>env('WEBCLIENT_KEY')]);
    $response = Route::dispatch($request);
    $responseData = json_decode($response->getContent(), TRUE);
    
    if(!$responseData['isSuccess']){
        $errors = $responseData['result']['errors'];
        $errors['errorMessage'] = $responseData['message'];
        return \Redirect::back()->withInput($payload)->withErrors($errors);
    }
    else{
        session(['mobile'=>$payload['mobile']]);
        return redirect()->route('web.get-verify-otp',['type'=>$type])->with('success','Please enter otp which we have sent you');
    }
   }


   public function logoutAction(Request $request,$type){
    $request->session()->forget($type);
    return redirect()->route('web.home');
}


   
}
