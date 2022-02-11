<?php

namespace App\Http\Controllers\Frontend\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Validator;

class JobController extends ClientController{

    public function getIndex(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        return view('frontend.client.jobs.index');
    }

    public function getJobPostOne(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        $categories = $this->getServiceTypes();
        $icon_class = 'fa-files-o';
        $page_h1 = 'Post New Job';
        return view('frontend.client.jobs.create-job-step-first',compact('categories', 'page_h1', 'icon_class' ));
    }

    public function getJobPostTwo(Request $request, $catId,$subId=0 ){
        \Session::put('currentRoute', $request->route()->getName());
        $icon_class = 'fa-files-o';
        $page_h1 = 'Post New Job';
        if($catId >= 6){
            $catResp = $this->callAPI('GET','/api/sub-categories/'.$catId);
            $category = isset($catResp['result'][0]) ? $catResp['result'][0] : [];

            $freelancerResp = $this->callAPI('GET','/api/top-freelancers?service_type='.$catId);
            $freelancers = isset($freelancerResp['result']) ? $freelancerResp['result'] : [];
            return view('frontend.client.jobs.job-category-6',compact('catId','category','freelancers', 'page_h1', 'icon_class','subId'));
        }else{
            return view('frontend.client.jobs.job-category-'.$catId,compact('catId', 'page_h1', 'icon_class'));
        }
        
    }

    public function getJobList(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/client/leads');
        $leads = isset($responseData['result']) ? $responseData['result'] : [];
        $icon_class = 'fa-list';
        $page_h1 = 'Posted Jobs';
        return view('frontend.client.jobs.list', compact('leads', 'page_h1', 'icon_class'));
    }

    public function postJob(Request $request){
            
        Validator::make($request->all(), [
            "job_title"=>"required",
            "service_type"=>'required|numeric',
            "service_sub_type"=>'required|numeric',
            "budget"=>'required|numeric',
        ])->validate();

        $payload = $request->all();
    	if ($request->service_required!='') {
    		$payload['service_required'] = implode(',',$request->service_required);
        }
        
        $responseData = $this->callAPI('POST','/api/client/post-job',[],$payload);
        if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            return \Redirect::back()->withErrors(['job_title'=>$responseData['message']]);
        }
        else{
            return redirect()->route('web.client.posted.jobs');
        }

    }

    public function postLead(Request $request){

        Validator::make($request->all(), [
            "job_title"=>"required",
            "service_type"=>'required|numeric',
            "service_required"=>'required',
            "budget"=>"required",
        ])->validate();

        $payload = $request->all();
    	if ($request->service_required!='') {
    		$payload['service_required'] = implode(',',$request->service_required);
        }
        
        $responseData = $this->callAPI('POST','/api/client/post-lead',[],$payload);
        if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            return \Redirect::back()->withErrors(['job_title'=>$responseData['message']]);
        }
        else{
            return redirect()->route('web.client.posted.jobs');
        }
    }

    public function getProposals(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/client/lead/proposals');
       
        $proposals = isset($responseData['result']) ? $responseData['result'] : [];
        $icon_class = 'fa-clone';
        $page_h1 = 'Proposals';
        return view('frontend.client.jobs.proposals', compact('proposals', 'page_h1', 'icon_class'));
    }

    public function getProposalsByLead(Request $request,$leadId){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/client/lead/'.$leadId.'/proposals');
        $proposals = isset($responseData['result']) ? $responseData['result'] : [];
        $icon_class = 'fa-clone';
        $page_h1 = 'Proposals';

        return view('frontend.client.jobs.proposals', compact('proposals'));
    }


    public function getProposalDetail(Request $request, $id, $proposalId){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/client/lead/'.$id.'/proposal/'.$proposalId);
        $proposal = isset($responseData['result']) ? $responseData['result'] : [];
        $icon_class = 'fa-clone';
        $page_h1 = 'Proposals';
        
        return view('frontend.client.jobs.proposal-detail',compact('proposal','id','proposalId', 'page_h1', 'icon_class'));
    }

    public function postProposalAccept(Request $request,$id,$proposalId){

        Validator::make($request->all(), [
            "transaction_id"=>"required",
            "amount"=>'required',
        ])->validate();

        $payload = $request->only(['payment_status','transaction_id','amount']);
        $responseData = $this->callAPI('POST','/api/client/lead/'.$id.'/proposal/'.$proposalId.'/accept',[],$payload,1);
        if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            return \Redirect::back()->withErrors(['job_title'=>$responseData['message']]);
        }
        else{
            \Session::flash('successMessage', $responseData['message']); 
            return redirect()->route('web.client.ongoing.jobs');
        }

    }
	
	public function postProposalDecline(Request $request,$id,$proposalId){
		//print_r($_REQUEST);
		//echo "id in job controller" . $id;
		//echo "proposl id in job controller" . $proposalId;
		//die();
		$payload = [];
        $responseData = $this->callAPI('POST','/api/client/decline/'.$id.'/proposal/'.$proposalId, [], $payload );
//        print_r($responseData);
	//	die();
		if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            return \Redirect::back()->withErrors(['job_title'=>$responseData['message']]);
        }
        else{
            \Session::flash('successMessage', $responseData['message']); 
            return \Redirect::back();//redirect()->route('web.client.ongoing.jobs');
        }

    }
	
	
	public function cancelJob(Request $request,$id){
		//print_r($_REQUEST);
		//echo "id in job controller" . $id;
		//echo "proposl id in job controller" . $proposalId;
		//die();
		$payload = [];
        $responseData = $this->callAPI('POST','/api/client/cancel/'.$id, [], $payload );
//        print_r($responseData);
	//	die();
		if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            return \Redirect::back()->withErrors(['job_title'=>$responseData['message']]);
        }
        else{
            \Session::flash('successMessage', $responseData['message']); 
            return \Redirect::back();//redirect()->route('web.client.ongoing.jobs');
        }

    }

    public function getOngoing(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/client/on-going');
        $ongoingJobs = isset($responseData['result']) ? $responseData['result'] : [];
        //dd($ongoingJobs);
        $icon_class = 'fa-align-left';
        $page_h1 = 'Ongoing Jobs';

        return view('frontend.client.jobs.on-going',compact('ongoingJobs', 'page_h1', 'icon_class'));
    
    }

    public function getOngoingDetail(Request $request,$leadProId){
        $ids = explode('-',$leadProId);

        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/lead-with-submission/'.$ids[0].'/'.$ids[1]);
        $ongoings = isset($responseData['result']) ? $responseData['result'] : [];
        $lead = isset($ongoings[0]) ? $ongoings[0] : [];
        //dd($lead);
        $icon_class = 'fa-align-left';
        $page_h1 = 'Ongoing Jobs';

        return view('frontend.client.jobs.on-going-detail',compact('lead','leadProId', 'page_h1', 'icon_class'));        
    }

    public function postUpdatework(Request $request,$leadProId){
       
        $ids = explode('-',$leadProId);

        Validator::make($request->all(), [
            'message'=>'required',
            'action'=>'required'
        ])->validate();
        
        $payload = $request->only(['message','action']);
        
        $responseData = $this->callAPI('POST','api/client/lead/'.$ids[0].'/update-submission/'.$ids[1],[],$payload);
        
        if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            return \Redirect::back()->withInput($payload)->withErrors(['message'=>$responseData['message']]);
        }
        else{
            \Session::flash('successMessage', $responseData['message']); 
            return redirect()->route('web.client.ongoing.jobs');
        }
    }

    public function getCompleted(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/client/completed');
        $completedJobs = isset($responseData['result']) ? $responseData['result'] : [];
        $icon_class = 'fa-check-square-o';
        $page_h1 = 'Completed Jobs';
        return view('frontend.client.jobs.completed',compact('completedJobs', 'page_h1', 'icon_class'));
    
    }

    public function getRefunded(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/client/refunded');
        $refundedJobs = isset($responseData['result']) ? $responseData['result'] : [];
        $icon_class = 'fa-check-square-o';
        $page_h1 = 'Refunded Jobs';
        return view('frontend.client.jobs.refunded',compact('refundedJobs', 'page_h1', 'icon_class'));
    
    }
	
	public function getTransactions(Request $request){
        \Session::put('currentRoute', $request->route()->getName());
        $responseData = $this->callAPI('GET','/api/client/transactions');
        $transactions = isset($responseData['result']) ? $responseData['result'] : [];
        $icon_class = 'fa-check-square-o';
        $page_h1 = 'Transactions';
        return view('frontend.client.jobs.transactions',compact('transactions', 'page_h1', 'icon_class'));
    
    }

    public function postInitiateChat(Request $request,$leadId,$proposalId){

        $responseData = $this->callAPI('POST','/api/client/initiate-chat/'.$leadId.'/'.$proposalId,[],[]);
        if(!$responseData['isSuccess']){
            \Session::flash('errorMessage', $responseData['message']); 
            return \Redirect::back()->withErrors(['job_title'=>$responseData['message']]);
        }
        else{
            \Session::flash('successMessage', $responseData['message']); 
            return redirect()->route('web.client.posted.jobs.proposal-detail',['id'=>$leadId,'proposalId'=>$proposalId]);
        }
    }
	
	public function download($id)
		{
		  try
		  {
				$resltFile = DB::table('proposal_submissions_files')->where('file_id',$id)->first();
				$headers = array(
						'Content-Type: image/*,.pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
					);
				$pathToFile = 'attachments/' . $resltFile->file_id;
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