<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadIdProofRequest;
use App\Http\Requests\BankDetailFormRequest;
use App\Http\Requests\SettingsFormRequest;
use App\UserPhoto;
use App\PartnerSubscription;
use App\Http\Requests\SubscriptionFormRequest;
use Carbon\Carbon;
use App\Http\Requests\UpdateProfileFormRequest;
use App\Http\Requests\DeviceTokenFormRequest;
use Razorpay\Api\Api as RazorApi;
use GuzzleHttp\Client as GuzzleHttpClient;
use App\Http\Requests\VerifyPaymentFormRequest;
use App\Http\Requests\UpdateProfileImageRequest;
use App\Http\Requests\ProfileUpdateFormRequest;
use App\Http\Requests\UpdateProfileRequest;


class ProfileController extends Controller
{   
    
    public function getProfile(Request $request){
        
        $user = $request->user();
        unset($user->api_token);
        return response(['isSuccess'=>true,"message"=>"","result"=>$user]);
    }

    public function postUpdateAboutMe(UpdateProfileFormRequest $request){
        try{
            $data = $request->only(["member_id", "professional_experience", "city", "gender",
            "bio",        "longitude",        "latitude",        "service_offered"]);
            $user = $request->user();
            foreach($data as $key=>$value){
                $user->$key = $value;
            }
            $user->about_me_update_status = 1;
            $user->save();
            return response(['isSuccess'=>true,"result"=>$user,"message"=>"Updated successfully"]);
        }catch(\Exception $e){
            
            return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
       
    }

    public function postUpdateAbout(ProfileUpdateFormRequest $request){
        try{
            $data = $request->only(["hourly_rate","professional_experience", "gender","bio","city"]);
            $user = $request->user();
            foreach($data as $key=>$value){
                $user->$key = $value;
            }
            $user->about_me_update_status = 1;
            $user->save();
            return response(['isSuccess'=>true,"result"=>$user,"message"=>"Updated successfully"]);
        }catch(\Exception $e){
            
            return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
       
    }

    public function postIdProof(UploadIdProofRequest $request){
        try{
        $image = base64_decode($request->input('imagebase64'));
        $safeName = str_random(10).'.'.'png';
        
        Storage::disk('public')->put('idproofs/'.$safeName, $image);

        $path  = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
       // $path = Storage::disk('uploads')->getAdapter()->getPathPrefix();
//                $public_path = Storage::disk('/');

        UserPhoto::create(['user_id'=>$request->user()->id,'image'=>$safeName]);
        return response(['isSuccess'=>true,"result"=>[],"message"=>"Upload successfully", "upload_path" =>'strpath','path'=>$path]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
    }

    public function getIdProof(Request $request){
        try{
            $photos = UserPhoto::where('user_id',$request->user()->id)->get();
            return response(['isSuccess'=>true,"result"=>$photos]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
        
    }

    public function getBankDetails(Request $request){

        try{
            $details = $request->user()->bankDetail;
            if(!$details){
                    $details =  $request->user()->addBank();
            }
           
            return response(['isSuccess'=>true,"message"=>"","result"=>$details]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
       
           
    }

    public function postUpdateBankDetails(BankDetailFormRequest $request){

        try{
            $details = $request->user()->updateBank($request->only(['acc_num','ifsc','bank_name','name']));
            return response(['isSuccess'=>true,"message"=>"Bank details updated","result"=>$details]);
        }catch(\Exception $e){ 
             return response(['isSuccess'=>false,"message"=>"Unable to update bank details","result"=>[]],400);
        }

    }

    public function postNotificationSetting(SettingsFormRequest $request){
        try{
            $request->user()->sms_alert = $request->input('sms_alert');
            $request->user()->email_alert = $request->input('email_alert');
            $request->user()->save();
            return response(['isSuccess'=>true,"message"=>"Notification settings updated.","result"=>$request->user()]);
        }catch(\Exception $e){ 
             return response(['isSuccess'=>false,"message"=>"Unable to update settings.","result"=>[]],400);
        }
    }

    public function getCheckSubscription(Request $request){
        $user  = $request->user();
        $api = new RazorApi(env('RAZOR_API_KEY'), env('RAZOR_API_SECRET'));
        $response = ['hasSubscription'=>"0","status"=>""];
        if($user->subscription_id){
            try{
                $subscription = $api->subscription->fetch($user->subscription_id);
                if($subscription){
                    $response = array_merge(['hasSubscription'=>"1"],$subscription->toArray());
                    return response(['isSuccess'=>true,"result"=>$response]);
                }else{
                    return response(['isSuccess'=>true,"result"=>$response]);
                }
               
               
            }catch(\Exception $e){
                return response(['isSuccess'=>true,"result"=>$response,'message'=>$e->getMessage()]);
            }
            
            
        }else{
            return response(['isSuccess'=>true,"result"=>$response]);
        }
        
    }
  
    private function createSubscriptionAtRazor($user, $razorApi){
        $subscription = $razorApi->subscription->create(array('plan_id' => env('RAZOR_PLAN_ID'), 'customer_notify' => 0, 'total_count' => 12, ));
        $user->subscription_id = $subscription->id;
        $user->save();
        return $user;
    }

    public function postCreateSubscription(Request $request){

         $user = $request->user();
         $razorApi = new RazorApi(env('RAZOR_API_KEY'), env('RAZOR_API_SECRET'));
         $subscriptionId  = $user->subscription_id;

         try{
            if($subscriptionId){
                try{
                    $subscription = $razorApi->subscription->fetch($subscriptionId);
                    if($subscription){
                        if(in_array($subscription->status,['active','authenticated'])){
                            return response(['isSuccess'=>false,"result"=>[],'message'=>'Subscription already active/authorized']);
                        }else{
                            /* If subscription created or expired or halted then need to create new */
                            if($subscription->status == 'created'){
                                return response(['isSuccess'=>true,"result"=>['subscription_id'=> $user->subscription_id]]);
                            }else{
                                $user = $this->createSubscriptionAtRazor($user,$razorApi);
                                return response(['isSuccess'=>true,"result"=>['subscription_id'=> $user->subscription_id]]);
                            }
                        }
                    }else{
                       $user = $this->createSubscriptionAtRazor($user,$razorApi);
                       return response(['isSuccess'=>true,"result"=>['subscription_id'=> $user->subscription_id]]);
                    }
                }catch(\Exception $e){
                    /*If subscription not found at razor */
                    $user = $this->createSubscriptionAtRazor($user,$razorApi);
                    return response(['isSuccess'=>true,"result"=>['subscription_id'=> $user->subscription_id]]);
                }

            }else{
                /*If subscription not created yet*/
                $user = $this->createSubscriptionAtRazor($user,$razorApi);
                return response(['isSuccess'=>true,"result"=>['subscription_id'=> $user->subscription_id]]);
            }
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],'message'=>$e->getMessage()],400);
        }
    }

    public function postVerifyPayment(VerifyPaymentFormRequest $request){

        $user = $request->user();
        $razorpay_subscription_id = $request->input('razorpay_subscription_id');
        $razorpay_payment_id = $request->input('razorpay_payment_id');
        $razorpay_signature = $request->input('razorpay_signature');
        $expectedSignature = hash_hmac('SHA256', $razorpay_payment_id . '|' . $razorpay_subscription_id, env('RAZOR_API_SECRET'));
        $user->subscription_payment_id = $razorpay_payment_id;
        $response = ['isSuccess'=>false,"result"=>[],'message'=>''];
        if($expectedSignature  == $razorpay_signature){
            $user->subscription_payment_status = 'Success';
            $response['isSuccess'] = true;
            $response['message'] = 'Subscription payment recieved';

        }else{
            $user->subscription_payment_status = 'Failed';
            $response['isSuccess'] = false;
            $response['message'] = 'Subscription payment failed';
        }

        $user->save();
        return response($response);
       
    }


    public function postDeviceToken(DeviceTokenFormRequest $request){
        $deviceToken = $request->input('device_token'); 
        try{
            $user = $request->user();
            $user->device_token = $deviceToken;
            $user->save();
            return response(['isSuccess'=>true,"result"=>[],'message'=>'Device Tokev updated']);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],'message'=>$e->getMessage()],400);
        }
    }

    public function postUpdateProfileImage(UpdateProfileImageRequest $request){
        $user = $request->user();

        try{
            $image = base64_decode($request->input('image'));
            $safeName = str_random(10).'.'.'png';
            Storage::disk('public')->put('profile-images/'.$safeName, $image);
            $user->image = $safeName;
            $user->save();
            return response(['isSuccess'=>true,"result"=>$user,"message"=>"Upload successfully"]);
            }catch(\Exception $e){
                return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
            }
    }
    
    public function postUpdateProfile(UpdateProfileRequest $request){
		//$all = $request->all(); 
        //print_r($all);
		$name = $request->input('name'); 
		//$new_password = bcrypt($request->input('pass'));
		$new_password = $request->input('pass');
		$new_address = $request->input('address');
		
		//echo "name is " . $name;
		//echo "password is " . $client_password;
		//die();
        try{
            $user = $request->user();
            $user->name = $name;
			$user->password = $new_password;
			$user->address = $new_address;
            $user->save();
            return response(['isSuccess'=>true,"result"=>[],'message'=>'Profile updated']);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],'message'=>$e->getMessage()],400);
        }
        return response(['isSuccess'=>false,"result"=>[],"message"=>""],200);
    }


    
}
