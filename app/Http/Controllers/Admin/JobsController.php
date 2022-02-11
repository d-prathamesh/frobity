<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use validator;
use Session;
use App\Job;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Refund;
use Razorpay\Api\Api as RazorApi;
use DB;

class JobsController extends Controller
{
	public $jobsmodel; 
    
    public function __construct(){
    	$this->jobsmodel = new Job();
    }

    public function completed_jobs(Request $request){
        $jobs =$this->jobsmodel->jobs_by_status($this->jobsmodel::COMPLETED);
        return view('admin.jobs.completed',['data'=>$jobs]);
        
    }
    public function refunded_jobs(Request $request){
        $jobs =$this->jobsmodel->jobs_by_status($this->jobsmodel::REFUNDED);
        return view('admin.jobs.refunded',['data'=>$jobs]);
        
    }

    public function inprogress_jobs(Request $request){
         //$jobs =$this->jobsmodel->jobs_by_status($this->jobsmodel::IN_PROGRESS);
		 $jobs = DB::select(" SELECT fin_jobs.job_title,fin_users.name as client_name ,fin_job_applications.amount,fin_services.name,u2.name as partner_name,fin_job_applications.id FROM fin_jobs INNER JOIN fin_job_applications ON fin_job_applications.job_id=fin_jobs.id and fin_jobs.status=1 INNER JOIN fin_users ON fin_users.id = fin_jobs.user_id INNER JOIN fin_services ON fin_jobs.service_type = fin_services.id INNER JOIN fin_users u2 ON u2.id = fin_job_applications.user_id ");
        return view('admin.jobs.inprogress',['data'=>$jobs]);
    }

    public function open_jobs(Request $request){
           $jobs =$this->jobsmodel->jobs_by_status($this->jobsmodel::OPEN);
        	return view('admin.jobs.open',['data'=>$jobs]);
    }
	
	public function postOngoingRefund( Request $request, $job_application_id ){
        
		try{
		$msg ='';
		$payments= Payment::where(["proposal_id"=>$job_application_id])->get();
		
		foreach( $payments as $payment ){
			$msg .=  "payment is ".$razor_payment_id = $payment->transaction_id;
			$payment_id = $payment->id;
			$job_id = $payment->job_id;
			$razorApi = new RazorApi(env('RAZOR_API_KEY'), env('RAZOR_API_SECRET'));
			//$payment  = $razorApi->payment->fetch($transactionId);
			$refund  = $razorApi->refund->create(["payment_id"=>$razor_payment_id]);
			
			$id = $refund->id;
			$amount = $refund->amount/100;
			$currency = $refund->currency;
			$status = $refund->status;
			
			//print_r($refund);
		
			$refundSubmission = new Refund;
            $refundSubmission->refund_id=$id;
			$refundSubmission->amount=$amount;
			$refundSubmission->currency=$currency;
			$refundSubmission->razor_payment_id=$razor_payment_id;
			$refundSubmission->status=$status;
			$refundSubmission->payment_id=$payment_id;
            $refundSubmission->save();
			
			// update payment_Status to -1(refunded) in payments table

			Payment::where(["proposal_id"=>$ids[1]])->update([ 'payment_status' => '-1' ]);
			Job::where(["id"=> $job_id ] )->update([ 'status' => '5' ]);
		}
		
		\Session::put('currentRoute', $request->route()->getName());
		$payload = [];
        $responseData = $this->callAPI('POST','/api/lead-refund/'.$ids[0].'/'.$ids[1],[],$payload);
        $refund = isset($responseData['result']) ? $responseData['result'] : [];
        //print_r($refund);
		
		}catch(\Exception $e){
			return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
			
		}        

    }
	
}
