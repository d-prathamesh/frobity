<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SignupFormRequest;
use App\Http\Requests\VerifyOTPFormRequest;
use App\Http\Requests\VerifyLoginFormRequest;
use App\Http\Requests\SendOTPFormRequest;
use App\Http\Requests\SocialRegisterFormRequest;
use App\Http\Requests\VerifyIdentityFormRequest;
use App\Http\Requests\SocialIdentityFormRequest;
use App\Http\Requests\CheckSocialIdentityFormRequest;
use App\Http\Requests\ForgotPasswordFormRequest;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\User;
//use App\Services\MessageService;
use App\Services\MessageService;
use App\Token; 
use App\Mail\SendOtpMail;
//use App\Mail\ForgotPasswordEmail;

class AuthController extends Controller
{

    public function postSignup(SignupFormRequest $request){
        
        $data = $request->all();
        try{

            $data['api_token'] = str_random(150);
            $data['otp'] = rand(1000,9999);
            //$data['password'] = crypt( $data['password'], 'hirebunny' );
			$data['password'] = crypt( $data['password'], 'frobity' );
            $data['otp_expires_at'] = time()+300;
            $message = "Your OTP is ".$data['otp']." to verify your account with Fineagle";
            if($user = User::create($data)){
                if(MessageService::sendMessage($user)){
                    return response(['isSuccess'=>true,'message'=>"User registered!. OTP sent",'result'=>[]], 200);
                }else{
                    return response(['isSuccess'=>true,'message'=>"User registered. OTP not sent",'result'=>[]], 200);
                }
            }else{
                return response(['isSuccess'=>false,'message'=>"Unable to register user",'result'=>[]], 400);
            }
            
        }catch(\Exception $e){
            return response(['isSuccess'=>false,'message'=>$e->getMessage(),'result'=>[]], 400);
        }
        
    }

    public function postSendOtp(SendOTPFormRequest $request){
        try{
			
			if( $request->input('mobile') != '' ) {
				$user = User::where('mobile',$request->input('mobile'))->where('user_type',$request->input('user_type'))->first();
				if($user){
					$user->api_token = str_random(150);
					$user->otp = rand(1000,9999);
					$user->otp_expires_at = time()+300;
				
					$user->save();
					if(MessageService::sendMessage($user)){
						return response(['isSuccess'=>true,'message'=>"OTP sent successfully",'result'=>[]], 200);
					}else{
						return response(['isSuccess'=>false,'message'=>"Failed to send OTP",'result'=>[]], 400);
					}
				}else{
					return response(['isSuccess'=>false,'message'=>"No user registered with this mobile",'result'=>[]], 400);
				}
			}else{
				$user = User::where('email',$request->input('email'))
				->where('user_type',$request->input('user_type'))
				->first();
				if($user){
					$user->api_token = str_random(150);
					$user->otp = rand(1000,9999);
					$user->otp_expires_at = time()+300;
				
					$user->save();
					 Mail::to($user->email)
                    ->send(new SendOtpMail($user));
						return response(['isSuccess'=>true,'message'=>"OTP sent successfully",'result'=>[]], 200);
					
				}else{
					return response(['isSuccess'=>false,'message'=>"No user registered with this Email",'result'=>[]], 400);
				}
				
			}
        }catch(\Exception $e){
            return response(['isSuccess'=>false,'message'=>$e->getMessage(),'result'=>[]], 400);
        }
        

    }
	
	
/*	public function postEmailSendOtp(SendOTPFormRequest $request){
        try{
            $user = User::where('email',$request->input('email'))->where('user_type',$request->input('user_type'))->first();
            if($user){
                $user->api_token = str_random(150);
                $user->otp = rand(1000,9999);
                $user->otp_expires_at = time()+300;
            
                $user->save();
                if(MessageService::sendMessage($user)){
                    return response(['isSuccess'=>true,'message'=>"OTP sent successfully",'result'=>[]], 200);
                }else{
                    return response(['isSuccess'=>false,'message'=>"Failed to send OTP",'result'=>[]], 400);
                }
            }else{
                return response(['isSuccess'=>false,'message'=>"No user registered with this mobile",'result'=>[]], 400);
            }
        }catch(\Exception $e){
            return response(['isSuccess'=>false,'message'=>$e->getMessage(),'result'=>[]], 400);
        }
        

    }
	*/

    public function postVerifyOtp(VerifyOTPFormRequest $request){
        try{

            if( $request->input('mobile') != '' ){
                $user = User::where('mobile',$request->input('mobile'))->where('user_type',$request->input('user_type'))->first();
                if($user){
                    if($user->otp == $request->input('otp')){
                        $user->api_token = str_random(150);
                        $token = Token::create([ 'access_token'=>str_random(150), 'user_id'=>$user->id, 'refresh_token'=>str_random(50), 'expires_in'=>date('Y-m-d H:i:s',strtotime('+30 days'))]);
                        $user->api_token = $token->access_token;
                        if($request->has('device_token')){
                            $user->device_token = $request->input('device_token');
                        }
                        $user->login_tried = $user->login_tried+1;
                        $user->save();
                        return response(['isSuccess'=>true,'message'=>"Verified successfully",'result'=>$user], 200);
                    }else{
                        return response(['isSuccess'=>false,'message'=>"OTP not matched",'result'=>[]], 400);
                    }
                }else{
                    return response(['isSuccess'=>false,'message'=>"No user registered with this mobile",'result'=>[]], 400);
                }
            }
            if( $request->input('email') != '' ){
                $user = User::where('email',$request->input('email'))->where('user_type',$request->input('user_type'))->first();
                if($user){
                    if($user->otp == $request->input('otp')){
                        $user->api_token = str_random(150);
                        $token = Token::create([ 'access_token'=>str_random(150), 'user_id'=>$user->id, 'refresh_token'=>str_random(50), 'expires_in'=>date('Y-m-d H:i:s',strtotime('+30 days'))]);
                        $user->api_token = $token->access_token;
                        if($request->has('device_token')){
                            $user->device_token = $request->input('device_token');
                        }
                        $user->login_tried = $user->login_tried+1;
                        $user->save();
                        return response(['isSuccess'=>true,'message'=>"Verified successfully",'result'=>$user], 200);
                    }else{
                        return response(['isSuccess'=>false,'message'=>"OTP not matched",'result'=>[]], 400);
                    }
                }else{
                    return response(['isSuccess'=>false,'message'=>"No user registered with this Email",'result'=>[]], 400);
                }
            }
        }catch(\Exception $e){
             return response(['isSuccess'=>false,'message'=>$e->getMessage(),'result'=>[]], 400);
        }
    }

    public function postVerifyLogin(VerifyLoginFormRequest $request){
        try{
            $user = User::where('email',$request->input('email'))->where('user_type',$request->input('user_type'))->first();
            if($user){
              //  if($user->password == $request->input('password') || $user->password == crypt( $request->input('password'), 'hirebunny' ) ){
				    if($user->password == $request->input('password') || $user->password == crypt( $request->input('password'), 'frobity' ) ){
                    $user->api_token = str_random(150);
                    $token = Token::create([ 'access_token'=>str_random(150), 'user_id'=>$user->id, 'refresh_token'=>str_random(50), 'expires_in'=>date('Y-m-d H:i:s',strtotime('+30 days'))]);
                    $user->api_token = $token->access_token;
                    if($request->has('device_token')){
                        $user->device_token = $request->input('device_token');
                    }
                    $user->login_tried = $user->login_tried+1;
                    $user->save();
                    return response(['isSuccess'=>true,'message'=>"Verified successfully",'result'=>$user], 200);
                }else{
                    return response(['isSuccess'=>false,'message'=>"Password not matched",'result'=>[]], 400);
                }
            }else{
                return response(['isSuccess'=>false,'message'=>"No user registered with this email",'result'=>[]], 400);
            }
        }catch(\Exception $e){
             return response(['isSuccess'=>false,'message'=> "excetion message".$e->getMessage(),'result'=>[]], 400);
        }
    }

    public function postSocialLogin(SociaLRegisterFormRequest $request){
        $socialEmail = $request->input('email');
        $socialHandler = $request->input('social_handler');
        try{
            $user = User::where('email',$socialEmail)->first();
            if($user){
                if($user->social_handler != $socialHandler){
                    $errorBag = ['email'=>"Email is already registered with us using ".($user->social_handler ? $user->social_handler : 'default')." signup"];
                    return response(['isSuccess'=>false,'message'=>"Validation Error",'result'=>["errors"=>$errorBag]], 406);
                }
                $user->api_token = "";
                if(!$user->mobile_verified){
                      return response(['isSuccess'=>false,'message'=>"Mobile number not verified yet",'result'=>["mobile_verified"=>$user->mobile_verified]], 200);
                }
                $user->api_token = str_random(50);
                $user->save();
                return response(['isSuccess'=>false,'message'=>"",'result'=>$user], 200);
            }else{
               $data = $request->only(["user_type",'name','email','social_handler','social_id','mobile_verified'=>"0"]);
               $user = User::create($data);
               return response(['isSuccess'=>false,'message'=>"Mobile number not verified yet",'result'=>["mobile_verified"=>$user->mobile_verified]], 200);
            }
        }catch(\Exception $e){
            return response(['isSuccess'=>false,'message'=>$e->getMessage(),'result'=>[]], 400);
        }
    }

    public function postIdentity(VerifyIdentityFormRequest $request){

        $identity = $request->input('identity');
        $password = $request->input('password');
        $type = $request->input('user_type');

        try{
        $type = $request->input('user_type');
            $user = User::where('email',$identity)->where('password',$password)->where('user_type',$type)->first();
            if($user){
               
                $user->api_token = str_random(150);
                $token = Token::create([ 'access_token'=>str_random(150), 'user_id'=>$user->id, 'refresh_token'=>str_random(50), 'expires_in'=>date('Y-m-d H:i:s',strtotime('+30 days'))]);
                $user->api_token = $token->access_token;
                if($request->has('device_token')){
                    $user->device_token = $request->input('device_token');
                }
                $user->save();
                return response(['isSuccess'=>true,'message'=>"Login successfully",'result'=>$user], 200);
                
            }else{
                return response(['isSuccess'=>false,'message'=>"Wrong credentials !",'result'=>[]], 400);
            }
        }catch(\Exception $e){
             return response(['isSuccess'=>false,'message'=>$e->getMessage(),'result'=>[]], 400);
        }
    }

    public function postSocialIdentity(SocialIdentityFormRequest $request){

        $payload = $request->only(['provider','provider_id','name','email','mobile','user_type','device_token','device_type','service_type','sub_service_type']);
        

        try{
        $type = $request->input('user_type');
            $user = User::where('social_handler',$payload['provider'])
                    ->where('social_id',$payload['provider_id'])
                    ->where('user_type',$payload['user_type'])->first();
            if(!$user){
                $payload['social_id'] =  $payload['provider_id'];
                $payload['social_handler'] = $payload['provider'];
                $payload['api_token'] = str_random(150);
                $payload['otp'] = rand(1000,9999);
                $payload['otp_expires_at'] = time()+300;

                if($user = User::create($payload)){
                    $token = Token::create([ 'access_token'=>str_random(150), 'user_id'=>$user->id, 'refresh_token'=>str_random(50), 'expires_in'=>date('Y-m-d H:i:s',strtotime('+30 days'))]);
                    $user->api_token = $token->access_token;
                    $user->save();
                    $user = User::find($user->id);
                    return response(['isSuccess'=>true,'message'=>"Login successfully",'result'=>$user], 200);
                   
                }else{
                    return response(['isSuccess'=>false,'message'=>"Unable to register user",'result'=>[]], 400);
                }
                
            }else{
                return response(['isSuccess'=>false,'message'=>"User already exists!",'result'=>[]], 400);
            }
        }catch(\Exception $e){
             return response(['isSuccess'=>false,'message'=>$e->getMessage(),'result'=>[]], 400);
        }
    }

    public function postCheckSocialIdentity(CheckSocialIdentityFormRequest $request){

        $payload = $request->only(['provider','provider_id','user_type']);
        try{

            $user = User::where('social_handler',$payload['provider'])
                    ->where('social_id',$payload['provider_id'])
                    ->where('user_type',$payload['user_type'])->first();
            if($user){
                $user->api_token = str_random(150);
                $token = Token::create([ 'access_token'=>str_random(150), 'user_id'=>$user->id, 'refresh_token'=>str_random(50), 'expires_in'=>date('Y-m-d H:i:s',strtotime('+30 days'))]);
                $user->api_token = $token->access_token;
                if($request->has('device_token')){
                    $user->device_token = $request->input('device_token');
                }
                $user->save();
                return response(['isSuccess'=>true,'message'=>"Login successfully",'result'=>$user], 200);
                
            }else{
                return response(['isSuccess'=>false,'message'=>"User not exits",'result'=>[]], 400);
            }
        }catch(\Exception $e){
             return response(['isSuccess'=>false,'message'=>$e->getMessage(),'result'=>[]], 400);
        }
    }

    public function postForgotPassword(ForgotPasswordFormRequest $request){
        $payload = $request->only(['user_type','email']);
        $user = User::where('email',$payload['email'])
                   ->where('user_type',$payload['user_type'])->first();
        if($user){
            try{
                Mail::to($user->email)
                    ->send(new ForgotPasswordEmail($user));
                    return response(['isSuccess'=>true,'message'=>"Email sent successfully",'result'=>[]], 200);
            }catch(\Exception $e){
               return response(['isSuccess'=>true,'message'=>"Fail to sent email",'result'=>[]], 200);
            }
        }else{
            return response(['isSuccess'=>false,'message'=>"User not exits",'result'=>[]], 400);
        }

    }

}
