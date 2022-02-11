<?php

namespace App\Http\Controllers\Frontend\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;

class SettingController extends PartnerController{

    public function getNotificationSetting(Request $request){
        

        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/get-profile');
        $profile = isset($responseData['result']) ? $responseData['result'] : [];
        $page_h1 = 'Notification Settings';
        $icon_class = 'fa-bell';

       
        return view('frontend.partner.setting.notification',compact('profile','page_h1','icon_class'));
    }

    public function postNotificationSetting(Request $request){
        \Session::put('currentRoute', $request->route()->getName());

        $payload = $request->only(['sms_alert','email_alert']);
        $payload['sms_alert'] = isset($payload['sms_alert']) ? $payload['sms_alert'] :"0";
        $payload['email_alert'] = isset($payload['email_alert']) ? $payload['email_alert'] :"0";

        $responseData = $this->callAPI('POST','/api/notification-setting',[],$payload);
        
        if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            return \Redirect::back()->withInput($payload)->withErrors(['message'=>$responseData['message']]);
        }
        else{
            \Session::flash('successMessage', $responseData['message']); 
            return redirect()->route('web.partner.setting.notification');
        }
    }


    public function getBank(Request $request){
        

        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/get-bank-details');
        $bankDetail = isset($responseData['result']) ? $responseData['result'] : [];
        
        $editable = true;
        if(!empty($bankDetail['bank_name']) && !empty($bankDetail['name']) && !empty($bankDetail['acc_num']) && !empty($bankDetail['ifsc'])) {
            $editable = false;
        }
        $page_h1 = 'Bank Details';
        $icon_class = 'fa-bank';

       //dd($bankDetail);
        return view('frontend.partner.setting.bank',compact('bankDetail','editable','page_h1','icon_class'));
    }


    public function postBank(Request $request){
        Validator::make($request->all(), [
            'name'=>'required',
            'ifsc'=>'required|min:11',
            'acc_num'=>'required|numeric',
            'bank_name'=>'required'
        ])->validate();
        
        $payload = $request->only(['name','acc_num','ifsc','bank_name']);
        $responseData = $this->callAPI('POST','/api/update-bank-details',[],$payload);
        
        if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            return \Redirect::back()->withInput($payload)->withErrors(['message'=>$responseData['message']]);
        }
        else{
            \Session::flash('successMessage', $responseData['message']); 
//            return redirect()->route('web.partner.setting.bank');
            return ;
        }
    }


    public function getProfile(Request $request){

        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/get-profile');
        $profile = isset($responseData['result']) ? $responseData['result'] : [];
        $partner = session()->get('partner');
        $partner['name'] = $profile['name'];
        $partner['image'] = $profile['image'];
        session(['partner'=>$partner]);
        $page_h1 = 'Edit Profile';
        $icon_class = 'fa-user';

        return view('frontend.partner.setting.profile',compact('profile','page_h1','icon_class'));
    }


    public function postProfile(Request $request){
        Validator::make($request->all(), [
            'name'=>'required',
        ])->validate();
        
        //$payload = $request->only(['name']);
		$payload = $request->only(['name','pass','address']);
        $responseData = $this->callAPI('POST','/api/update-profile',[],$payload);
        
        if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            
            return \Redirect::back()->withInput($payload)->withErrors(['message'=>$responseData['message']]);
        }
        else{
            
            \Session::flash('successMessage', $responseData['message']); 
            return redirect()->route('web.partner.setting.profile');
        }
    }

    public function getAboutme(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/get-profile');
        $profile = isset($responseData['result']) ? $responseData['result'] : [];
       
        $readOnly  =  $profile['about_me_update_status'] ? 0 : 1; 
        $page_h1 = 'About Me';
        $icon_class = 'fa-user';

        return view('frontend.partner.setting.aboutme',compact('profile','readOnly','page_h1','icon_class'));
    }

    public function postAboutme(Request $request){
       $requiredFields =  [
            'professional_experience'=>'required',
            'gender'=>'required',
            'bio'=>'required',
            'hourly_rate'=>'required',
            'city'=>'required',
           // 'longitude'=>'required|numeric',
           // 'latitude'=>'required|numeric'
       ];

       if(session()->get('partner')['service_type'] == 1){ // mandatory only for CA
           $requiredFields['member_id'] = 'required';
       }
        Validator::make($request->all(),$requiredFields )->validate();
        
        $payload = $request->only(['professional_experience','gender','bio','hourly_rate','city','longitude','latitude','member_id']);
        $responseData = $this->callAPI('POST','/api/update-about',[],$payload);
        
        if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            
            return \Redirect::back()->withInput($payload)->withErrors(['message'=>$responseData['message']]);
        }
        else{
            
            \Session::flash('successMessage', $responseData['message']); 
            return $responseData['message'];//redirect()->route('web.partner.setting.aboutme');
        }
    }

    public function getIdentity(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/upload-id-proof');
        $ids = isset($responseData['result']) ? $responseData['result'] : [];

        $page_h1 = 'Identity Proof';
        $icon_class = 'fa-address-card';

        return view('frontend.partner.setting.identity',compact('ids','page_h1','icon_class'));
        
    }

    public function postIdentity(Request $request){
        $requiredFields =  [
            'identity'=>'image|mimes:jpg,jpeg,png',
        ];
        Validator::make($request->all(),$requiredFields )->validate();

        $imgcode = file_get_contents($request->file('identity'));
        
    	$payload = array(
		'imagebase64' => base64_encode($imgcode),
        );

        
        $responseData = $this->callAPI('POST','/api/upload-id-proof',[],$payload);
        
        if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            
            return \Redirect::back()->withErrors(['message'=>$responseData['message']]);
        }
        else{
            
           // \Session::flash('successMessage', json_encode($responseData));//$responseData['message']); 
		    \Session::flash('successMessage', $responseData['message']); 
            return redirect()->route('web.partner.setting.identity');
        }

    }

    public function postProfilePicture(Request $request){

        $requiredFields =  [
            'profileimage'=>'image|mimes:jpg,jpeg,png',
        ];
        Validator::make($request->all(),$requiredFields )->validate();

        $imgcode = file_get_contents($request->file('profileimage'));
        
    	$payload = array(
		'image' => base64_encode($imgcode),
        );

        
        $responseData = $this->callAPI('POST','/api/update-profile-image',[],$payload);
    
        if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            
            return \Redirect::back()->withErrors(['message'=>$responseData['message']]);
        }
        else{
            
            \Session::flash('successMessage', $responseData['message']); 
            return redirect()->route('web.partner.setting.profile');
        }

    }
}