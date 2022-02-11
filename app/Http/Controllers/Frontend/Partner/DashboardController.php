<?php

namespace App\Http\Controllers\Frontend\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;

class DashboardController extends PartnerController{

    public function getIndex(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        $loginTried = $request->input('first_login');
        // get applicable jobs
        $responseData = $this->callAPI('GET','/api/leads');
        $applicableJobs = isset($responseData['result']) ? $responseData['result'] : []; 

        //get proposals sent 
        $responseData = $this->callAPI('GET','api/lead/sent/proposals');
        $proposals = isset($responseData['result']) ? $responseData['result'] : []; 

        //get ongoing jobs
        $responseData = $this->callAPI('GET','/api/on-going');
        $ongoingJobs = isset($responseData['result']) ? $responseData['result'] : [];

        //get completed jobs
        $responseData = $this->callAPI('GET','/api/completed');
        $completedJobs = isset($responseData['result']) ? $responseData['result'] : [];

        //get total earnings
        $responseData = $this->callAPI('GET','/api/lead/proposals/payment');
        $jobPaymentreceived = isset($responseData['result']) ? $responseData['result'] : [];
        
        //get pending earnings
        $responseData = $this->callAPI('GET','/api/lead/proposals/pendingPayment');
        $jobPaymentpending = isset($responseData['result']) ? $responseData['result'] : 0;

        
        return view('frontend.partner.dashboard.index',['loginTried'=>$loginTried, 'page_h1' => "Dashboard", 'icon_class' => 'fa-dashboard', 'applicableJobs' => $applicableJobs
        	, 'proposals' => $proposals
        	, 'ongoingJobs' => $ongoingJobs
        	, 'completedJobs' => $completedJobs
            , 'jobPaymentreceived' => $jobPaymentreceived
            , 'jobPaymentpending' => $jobPaymentpending
         ]);
    }
}