<?php

namespace App\Http\Controllers\Frontend\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;
use App\Payment;
use App\Refund;
use App\Job;
use Razorpay\Api\Api as RazorApi;
use DB;

class JobController extends PartnerController{

    public function getIndex(Request $request, $term=null ){
        \Session::put('currentRoute', $request->route()->getName());
        $perpage = 2;
        $listing_only = isset( $request->listing_only )?'1':'0';
        if(  $term != null ){
            $term_str = '/'.$term;
        }else{
            $term_str = '';
        }
        if( isset( $request->page ) ){
            $page_no = $request->page;
            $responseData = $this->callAPI('GET','/api/leads/'.$perpage.$term_str.'?page='.$page_no);
    }else{
            $responseData = $this->callAPI('GET','/api/leads/'.$perpage.$term_str );
        }


        $leads = isset($responseData['result']) ? $responseData['result'] : [];
        $links = isset($responseData['page_links']) ? $responseData['page_links'] : '';
        
        if( !$listing_only ){
            $page_h1 = 'Find Jobs';
            $icon_class = 'fa-files-o';
            return view('frontend.partner.jobs.index',['leads'=>$leads, 'page_h1' =>$page_h1, 'icon_class' => $icon_class, 'links' => $links ] );
        }else{
            return view('frontend.partner.jobs.listitemblock',compact('leads','links'));
        }
    }

    public function getJobDetail(Request $request,$leadId){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/lead/'.$leadId);
        $lead = isset($responseData['result']) ? $responseData['result'] : [];
        if(empty($lead)){
            \Session::flash('errorMessage', $responseData['message']); 
            return \Redirect::back()->withErrors(['errorMessage'=>'No lead found']);
        }
        $user = $this->getAuth();
        $proposals = array_filter($lead['proposals'],function($item) use ($user){
            return $item['user_id'] == $user['id'];
        });
        $proposals = array_values($proposals);
        
        $proposalByUser = count($proposals) > 0 ? $proposals[0] : [];
            $page_h1 = 'Job Details';
            $icon_class = 'fa-files-o';
        
        return view('frontend.partner.jobs.detail',compact('lead','proposalByUser','page_h1','icon_class'));
    }
    public function postSendProposal(Request $request,$leadId){
        
        Validator::make($request->all(), [
            'amount'=>'required|numeric',
            'expected_days'=>'required|numeric'
        ])->validate();

//        $filecode = file_get_contents($request->file('attachment'));
        $filedata = array();
        $files = $request->file('attachments');
        if ( $files )
        {
            foreach ($files as $value) 
            {
                $filecode = file_get_contents($value);
                $filedetail['filebase64code'] = base64_encode($filecode);
                $filedetail['file_name'] = $value->getClientOriginalName();
                $filedetail['file_type'] = $value->getClientOriginalExtension();
                $filedetail['file_size'] = $value->getClientSize();

                array_push($filedata, $filedetail);
            }
        }        
        
        $payload = ['amount'=>$request->amount,
            'expected_days'=>$request->expected_days,
            'proposal_summary'=>$request->proposal_summary,
            'attachments' =>  $filedata  ] ;


        $responseData = $this->callAPI('POST','api/lead/'.$leadId.'/send-proposal',[],$payload);
        
        if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            return \Redirect::back()->withInput($payload)->withErrors(['amount'=>$responseData['message']]);
        }
        else{
            \Session::flash('successMessage', $responseData['message']); 
            return redirect()->route('web.partner.jobs');
        }

       

    }

    public function getSentProposals(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','api/lead/sent/proposals');
        $proposals = isset($responseData['result']) ? $responseData['result'] : []; 
            $page_h1 = 'Proposals';
            $icon_class = 'fa-files-o';
                
        return view('frontend.partner.jobs.sent-proposals',compact('proposals','page_h1','icon_class'));
    }

    public function getOngoing(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/on-going');
        $ongoingJobs = isset($responseData['result']) ? $responseData['result'] : [];
        //dd($ongoingJobs);
        $page_h1 = 'Ongoing Jobs';
        $icon_class = 'fa-align-left';

        return view('frontend.partner.jobs.on-going',compact('ongoingJobs','page_h1','icon_class'));
    
    }

    public function getOngoingDetail(Request $request,$leadProId){
        $ids = explode('-',$leadProId);

        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/lead-with-submission/'.$ids[0].'/'.$ids[1]);
        $ongoings = isset($responseData['result']) ? $responseData['result'] : [];
        $lead = isset($ongoings[0]) ? $ongoings[0] : [];
        //dd($lead);
            $page_h1 = 'Details';
            $icon_class = 'fa-files-o';
                

        return view('frontend.partner.jobs.on-going-detail',compact('lead','leadProId','page_h1','icon_class'));        
    }
	
    public function postOngoingRefund( Request $request, $leadProId ){
        $ids = explode('-',$leadProId);
		try{
		$msg ='';
		$payments= Payment::where(["proposal_id"=>$ids[1]])->get();
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
		
		//echo "in job controller";
		//print_r($ids);

        \Session::put('currentRoute', $request->route()->getName());
		$payload = [];
        $responseData = $this->callAPI('POST','/api/lead-refund/'.$ids[0].'/'.$ids[1],[],$payload);
        $refund = isset($responseData['result']) ? $responseData['result'] : [];
        //print_r($refund);
        
		}catch(\Exception $e){
			return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
		}        

    }

    public function postSubmitwork(Request $request,$leadProId){

        $ids = explode('-',$leadProId);

        Validator::make($request->all(), [
            'message'=>'required',
        ])->validate();

        $imgdata = array();
    	if ($files = $request->file('attachments'))
    	{
    		foreach ($files as $value) 
	    	{
	    		$imgcode = file_get_contents($value);
	    		$filedetail['filebase64code'] = base64_encode($imgcode);
	    		$filedetail['file_name'] = $value->getClientOriginalName();
	    		$filedetail['file_type'] = $value->getClientOriginalExtension();
	    		$filedetail['file_size'] = $value->getClientSize();

	    		array_push($imgdata, $filedetail);
	    	}
        }
        
    	$payload = array(
    		'message'=>$request->message,
    		'attachments'=>$imgdata,
        );
        
        $responseData = $this->callAPI('POST','api/lead/'.$ids[0].'/work-submission/'.$ids[1],[],$payload);
        
        if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            return \Redirect::back()->withInput($payload)->withErrors(['message'=>$responseData['message']]);
        }
        else{
            \Session::flash('successMessage', $responseData['message']); 
            return redirect()->route('web.partner.ongoing.jobs');
        }
    }

    public function getCompleted(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/completed');
        $completedJobs = isset($responseData['result']) ? $responseData['result'] : [];
        
        $page_h1 = 'Completed Jobs';
        $icon_class = 'fa-check-square-o';
        return view('frontend.partner.jobs.completed',compact('completedJobs','page_h1','icon_class'));
    
    }
    public function getRefunded(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/refunded');
        //echo "response ".print_r($responseData,true);
		$refundedJobs = isset($responseData['result']) ? $responseData['result'] : [];
        
        $page_h1 = 'Refunded Jobs';
        $icon_class = 'fa-check-square-o';
        return view('frontend.partner.jobs.refunded',compact('refundedJobs','page_h1','icon_class'));
    
    }
	
	public function download($id)
		{
		  try
		  {
			
				$resltFile = DB::table('proposal_submissions_files')->where('file_id',$id)->first();
				$headers = array(
						
						'Content-Type: image/*,.pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
					);
				
				
				//$pathToFile = public_path().'/attachments/' . $resltFile->file_id;
				$pathToFile ='../public/attachments/' . $resltFile->file_id;
				$download_name = $resltFile->file_name;
				return response()->download($pathToFile,$download_name,$headers);
			
		  }

		  catch(ModelNotFoundException $e)
		  {
			Session::flash('flash_message', "An error has occurred processing your request, please try again later.");
			return redirect()->back();
		  }
		}
	
	 
}