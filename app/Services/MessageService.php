<?php

namespace App\Services;

class MessageService
{
    
    public static function sendMessage($user){

        //$message = "Your OTP $user->otp to verify account with Hire Bunny";
		$message = "Your OTP $user->otp to verify account with Frobity";
        try{
            $params = http_build_query([
                'authkey' => env('MSG91_API_KEY'),
                'message' => "$message",
                'mobile' => "{$user->mobile}" ,
                'sender'=> env('MSG91_SENDERID'),
                'otp'=> "{$user->otp}"
            ]);
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => env('MSG91_ENDPOINT').'?'.$params,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => [],
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return false;
            } else {
             $jsonArray = json_decode($response,true);
             if(isset($jsonArray['type']) && $jsonArray['type'] == 'success'){
                 return true;
             }
             return false;
            } 
        }catch(\Exception $e){
            return false;
        }

    }
   
}
