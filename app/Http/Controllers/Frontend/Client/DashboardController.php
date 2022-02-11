<?php

namespace App\Http\Controllers\Frontend\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;

class DashboardController extends ClientController{

    public function getIndex(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
		

        // get posted jobs
        $responseData = $this->callAPI('GET','/api/client/leads');
        $leads = isset($responseData['result']) ? $responseData['result'] : [];

        // get proposals
        $responseData = $this->callAPI('GET','/api/client/lead/proposals');
        $proposals = isset($responseData['result']) ? $responseData['result'] : [];

        // get ongoing
        $responseData = $this->callAPI('GET','/api/client/on-going');
        $ongoingJobs = isset($responseData['result']) ? $responseData['result'] : [];

        // get completed
        $responseData = $this->callAPI('GET','/api/client/completed');
        $completedJobs = isset($responseData['result']) ? $responseData['result'] : [];

        //amount spent
        $responseData = $this->callAPI('GET','/api/client/lead/getPaidProposals');
        $jobPaymentreceived = isset($responseData['result']) ? $responseData['result'] : [];

        return view('frontend.client.dashboard.index', [ 'leads'=> $leads,
        	'proposals'=> $proposals,
        	'ongoingJobs'=> $ongoingJobs,
        	'completedJobs'=> $completedJobs,
            'jobPaymentmade' => $jobPaymentreceived
         ] );
    }
}