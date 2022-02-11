<?php

namespace App\Services;

class FcmService
{
    /** */
    public static function sendPushNotification($appName,$tokens,$data){

        $fcmKey= null;
        if($appName == 'CLIENT'){
            $fcmKey = env('CLIENT_FCM_API_KEY');
        }else if($appName == 'PARTNER'){
            $fcmKey = env('PARTNER_FCM_API_KEY');
        }
        
        $fcmPayload = array(
            'registration_ids'=>$tokens,
            'priority'=>'high'
        );
        if(isset($data['notification'])){
            $fcmPayload['notification'] = $data['notification'];
        }
        if(isset($data['data'])){
            $fcmPayload['data'] = $data['data'];
        }
        
        if($fcmKey){
            try{
                $headers = array(
                    'Authorization: key=' .$fcmKey,
                    'Content-Type: application/json'
                );

                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmPayload ) );
                $result = curl_exec($ch);
                curl_close($ch);
	        return $result;
            }catch(\Exception $e){

            }   
        }
    }
}
