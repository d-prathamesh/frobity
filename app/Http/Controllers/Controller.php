<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use Illuminate\Http\Request;
use Route;

class Controller extends BaseController
{
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function getServiceTypes(){
        $request = Request::create('/api/categories', 'GET');
        $request->headers->add(['x-api-key'=>env('WEBCLIENT_KEY')]);
        $response = Route::dispatch($request);
        $responseData = json_decode($response->getContent(), TRUE);
        $categories = isset($responseData['result']) ? $responseData['result']  :  [];
        return $categories;
    }
	
	
}
