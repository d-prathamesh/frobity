<?php

namespace App\Http\Controllers\Frontend\Client;
//use Route;
//use Request;
//use App\Http\Controllers\Controller;
//use Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Validator;
use App\Notification;
use App\Messages;
use DB;

class ClientController extends Controller{

	protected function getAuth(){
        return session('client');
    }

    protected  function callAPI($method, $url, $headers = [], $payload = [],$flag = false){
        
        $headers['Content-type']='application/json';
        $headers['x-api-key']=env('WEBCLIENT_KEY');
        $headers['authorization']='Bearer '.session()->get('client')['api_token'];
        $request = null;
        if($flag){
            $request = Request::create($url, $method,$payload,[],[],$_SERVER,json_encode($payload));
        }else{
            $request = Request::create($url, $method,$payload,[],[],$_SERVER);
        }
        
        \Request::replace($payload);
        $request->headers->add($headers);
        $response =  app()->handle($request);
        
        return $responseData = json_decode($response->getContent(), TRUE);
    }
	
	protected function getNotifications( Request $request ){

        if($request->ajax()){
          $responseData = $this->callAPI('GET','/api/notifications');
		  return response(["new_leads"=> count($responseData['result'])]);
        }else{
            $responseData = $this->callAPI('GET','/api/notifications/2');
            $icon_class = 'fa-bell';
            $page_h1 = 'Notifications';
            return view('frontend.client.notifications',[ 'page_h1' => $page_h1, 'icon_class' => $icon_class, 'responsedata' => $responseData['result'] ] );

        }
    }

    protected function postGetNotifications( Request $request ){
        $responseData = $this->callAPI('GET','/api/notifications/1');
        return response(["result"=> $responseData['result'],"in clint "=>"in client controllers",'total_Res'=>$responseData]);
        
        
    }
	
	    protected function getMessages( Request $request ){
     	if($request->ajax()){
          $responseData = $this->callAPI('GET','/api/messages');
		  //echo "<pre>";
		  //print_r($responseData);
		  //echo "</pre>";
		  return response(["new_messages"=> count($responseData['result'])]);
        }else{
            $responseData = $this->callAPI('GET','/api/messages/2');
			$icon_class = 'fa-bell';
            $page_h1 = 'Messages';
            return view('frontend.client.messages',[ 'page_h1' => $page_h1, 'icon_class' => $icon_class, 'responsedata' => $responseData['result'] ] );

        }
	}
	
	protected function postGetMessages( Request $request ){
        //echo "in partner controller";
	    $responseData = $this->callAPI('GET','/api/messages/1');
		//echo "<pre>";
		//print_r($responseData);
		//echo "</pre>";
		//die();
		return response(["result"=> $responseData['result'],"in partner "=>"partner controller",'total_Res'=>$responseData]);
        
        //return response(["result"=> $responseData['result']]);
    }
}