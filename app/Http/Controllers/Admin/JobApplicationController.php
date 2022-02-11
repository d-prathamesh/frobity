<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use Session;
use App\Http\Controllers\Controller;
use App\JobApplication;
use App\Job;
use App\Payment;
use Razorpay\Api\Api as RazorApi;

class JobApplicationController extends Controller
{
    public $job_application;   
   
   	
	public function __construct()
    {
    	$this->job_application = new JobApplication();
    }

    public function transferpending(){
       $transfer_pending_jobs =$this->job_application->get_transfer_pending_jobs();
       return view('admin.jobs.transfer_pending',['transfer_pending_jobs'=>$transfer_pending_jobs]);
    }

    public function transfer_amount(Request $request){
      try{
         $user = $request->user();
         $razorApi = new RazorApi(env('RAZOR_API_KEY'), env('RAZOR_API_SECRET'));
         $discount = env('DISCOUNT_PERCENTAGE');
         $payments = Payment::where(['proposal_id'=>$request->input('id'),'job_id'=>$request->input('job_id')])->first();
         $discount_amount =  ($payments->amount * $discount)/100;
         $transfer_amount =  $payments->amount - $discount_amount;
         $account_id = $request->input('account_id');
         if($account_id){
            $payment  = $razorApi->payment->fetch($payments->transaction_id);
             if($payment &&  (strtolower($payment->status == 'captured') || strtolower($payment->status) == 'authorized')){
                if(strtolower($payment->status) != 'captured'){
                    $paymentCaptured  = $razorApi->payment->fetch($payment->id)->capture(array('amount'=>$payment->amount));
                }
                $transfer  = $razorApi->payment->fetch($payments->transaction_id)->transfer(array('transfers' => [ ['account' => $account_id, 'amount' => $transfer_amount*100, 'currency' => 'INR']])); // Create transfer
             $transfers = $razorApi->payment->fetch($payments->transaction_id)->transfers(); 
             $transferData  = $transfers->items;
             $transfer_id = null;
             if(sizeof($transferData) > 0){
              $transfer_id = $transferData[sizeof($transferData) - 1]->id;
             }
             Payment::find($payments->id)->update(['transfer_status'=>1,'transfer_amount'=>$transfer_amount,'transfer_deduction'=>$discount_amount,'deduction_percentage'=>$discount,'transfer_id'=>$transfer_id ,'transfer_date'=>date('Y-m-d H:i:s')]);
             return response(['isSuccess'=>true,'payment_id'=>$payments->transaction_id,"message"=>"Payment Transfer Successfull"]);
            }else{
                return response(['isSuccess'=>false,"message"=>"Payment status is not authorised or captured"],500);
            }
            
         }else{
             return response(['isSuccess'=>false,'payment_id'=>$payments->transaction_id,"message"=>"Partner does not have a Razor pay Account ID"],500);
         }
         
         
      }catch(\Exception $e){
        return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
      }
         
    }

    
}
