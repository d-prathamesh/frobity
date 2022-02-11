<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job;
use App\Http\Requests\SendProposalFormRequest;
use App\JobApplication;
use DB;
use App\JobSubmission;
use App\Http\Requests\WorkSubmissionFormRequest;
use App\EmailQueue;
use App\JobSubmissionFile;
use App\ProposalSubmissionFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Notification;
use App\Messages;

class NotificationController extends Controller
{
    
    public function getNew( Request $request, $updateread = 0 ){
        $userId = $request->user()->id;
           // return response(['isSuccess'=>true,"result"=>"user_id is ".$userId, "message"=>""]);
        try{


            $in_up = 0;
			if( $updateread == 1 ){
                $notifications = Notification::
                where('is_read',0)
                ->where('to_user_id',$userId)
                ->orderBy('id','desc')->get();
                $in_up = 1;
                $notifications_ups = Notification:: where('to_user_id',$userId)->update(['is_read'=>1]);
            }
			elseif( $updateread == 2 ){ // sshow all notifications
                $notifications = Notification::
                where('to_user_id',$userId)
                ->orderBy('id','desc')->get();
                $in_up = 2;
                $notifications_ups = Notification:: where('to_user_id',$userId)->update(['is_read'=>1]);
            } else{
                $notifications = Notification::
                where('is_read',0)
                ->where('to_user_id',$userId)
                ->orderBy('id','desc')->get();
                $in_up = 0;
            }
			/*
            if( $updateread == 1 ){
                $notifications = Notification::
                where('is_read',0)
                ->where('to_user_id',$userId)
                ->orderBy('id','desc')->get();
                $in_up = 1;
                $notifications_ups = Notification:: where('to_user_id',$userId)->update(['is_read'=>1]);
            }
            if( $updateread == 2 ){ // sshow all notifications
                $notifications = Notification::
                where('to_user_id',$userId)
                ->orderBy('id','desc')->get();
                $in_up = 1;
                $notifications_ups = Notification:: where('to_user_id',$userId)->update(['is_read'=>1]);
            }else{
                $notifications = Notification::
                where('is_read',0)
                ->where('to_user_id',$userId)
                ->orderBy('id','desc')->get();
                $in_up = 0;
            }*/
			
            return response(['isSuccess'=>true,"result"=>$notifications, "message"=>"in up $in_up "]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
    }
	
	public function getNewMessages( Request $request, $updateread = 0){
        $userId = $request->user()->id;
		
		 //return response(['isSuccess'=>true,"result"=>"user_id is ".$read, "message"=>""]);
		 
        try{
			//$result = DB::select("SELECT E.id,E.user_id,E.status,D.job_id,D.user_id ,D.message FROM fin_jobs E JOIN fin_job_submissions D ON (E.id = D.job_id and D.user_id <> E.user_id) and (E.status = 1 or E.status=2) and D.is_read =0");	
			
            $in_up = 0;
			
           if( $updateread == 1 ){
                $messages = Messages::
                where('is_read',0)
                ->where('to_user_id',$userId)
			    ->orderBy('id','desc')->get();
                $in_up = 1;
                $messages_ups = Messages:: where('to_user_id',$userId)->update(['is_read'=>1]);
            }
			elseif( $updateread == 2 ){ // sshow all notifications
                $messages = Messages::
                where('to_user_id',$userId)
			    ->orderBy('id','desc')->get();
                $in_up = 2;
                $messages_ups = Messages:: where('to_user_id',$userId)->update(['is_read'=>1]);
            } else {
                $messages = Messages::
                where('is_read',0)
                ->where('to_user_id',$userId)
			    ->orderBy('id','desc')->get();
                $in_up = 0;
	        }
			
			/*
            if( $updateread == 1 ){
                $messages = Messages::
                where('is_read',0)
                ->where('to_user_id',$userId)
			    ->orderBy('id','desc')->get();
                $in_up = 1;
                $messages_ups = Messages:: where('to_user_id',$userId)->update(['is_read'=>1]);
            }
            if( $updateread == 2 ){ // sshow all notifications
                $messages = Messages::
                where('to_user_id',$userId)
			    ->orderBy('id','desc')->get();
                $in_up = 1;
                $messages_ups = Messages:: where('to_user_id',$userId)->update(['is_read'=>1]);
            }else{
                $messages = Messages::
                where('is_read',0)
                ->where('to_user_id',$userId)
			    ->orderBy('id','desc')->get();
                $in_up = 0;
	        }
			*/
            return response(['isSuccess'=>true,"result"=>$messages, "message"=>"in up $in_up "]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
    }
	
	
	
    public function getLeadById(Request $request,$id){
        try{
        	$job = Job::with(['postedBy'=>function($q){
        		$q->select('id','email','name');
        	},'serviceType'=>function($q){
        		$q->select('id','name');
            },'proposals'=>function($q){
                $q->select('id','job_id','user_id','amount','expected_days','proposal_summary','chat_initiated');
            }
            ])->where('id',$id)->where('status',Job::OPEN)->first();

            if($job){
                return response(['isSuccess'=>true,"result"=>$job,"message"=>""]);
            }else{
                return response(['isSuccess'=>false,"result"=>[],"message"=>"Lead no longer available"],404);
            }
        	
        }catch(\Exception $e){
        	return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
    }

    public function getLeadWithReview(Request $request,$leadId,$applicationId){
        try{
        
            $jobsInProgress = Job::with(['activeContract'=>function($q){
				$q->with(['contractor'=>function($qr){
					$qr->select('id','email','name','city');
				}])->select('id','job_id','user_id');
                
            },'serviceType'=>function($q){},
                'submissionHistory'=>function($q){
                        $q->with(['user'=>function($c){
                            $c->select('id','name','email','user_type');
                        },'attachments'=>function($d){

                        }]);
                }    
            ])->whereHas('activeContract',function($q) use($leadId,$applicationId) {
                $q->where('proposal_status',1)->where('job_id',$leadId)->where('id',$applicationId);
            })->whereIn('status',[Job::IN_PROGRESS,Job::IN_REVIEW])->get();
            return response(['isSuccess'=>true,"result"=>$jobsInProgress,"message"=>""]);

        }catch(\Exception $e){
             return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
    }

    public function postSendProposal(SendProposalFormRequest $request,$id){
        try{
            $job = Job::find($id);
            if(!$job){
                return response(['isSuccess'=>false,"result"=>[],"message"=>"Job no longer available"],404);
            }

            $existingProposal = JobApplication::where('user_id',$request->user()->id)->where('job_id',$id)->count();
            if($existingProposal > 0){
                return response(['isSuccess'=>false,"result"=>[],"message"=>"Job Proposal Already sent"],400);
            }
            
            $files = $request->input('attachments');
            $attachments = [];
            if(is_array($files)){
                foreach($files as $file){
                    $decoded = base64_decode($file['filebase64code']);
                    $safeName = str_random(50).'.'.$file['file_type'];
                    Storage::disk('public')->put('attachments/'.$safeName, $decoded);
                    $attachments[]=[
                    'file_name'=>$file['file_name'],
                    'file_size'=>$file['file_size'],
                    'file_id'=>$safeName
                    ];
                }
            }
            $data = $request->only(['amount','expected_days','proposal_summary']);
            $data['job_id'] = $job->id;
            $data['user_id'] = $request->user()->id;
            $data['proposal_status'] = 0;
            $job_application = JobApplication::create($data);
            if( $job_application ){
                if( count( $attachments ) ){
                    foreach($attachments as $attachment){
                        $attachment['proposal_submission_id']=$job_application->id;
                        ProposalSubmissionFile::create($attachment);
                    }
                }
                return response(['isSuccess'=>true,"result"=>[],"message"=>"Job proposal sent successfully"]);
            }else{
                return response(['isSuccess'=>false,"result"=>[],"message"=>"Unable to post your proposal"],400);
            }
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }    
    }

    public function getOngoing(Request $request){
        try{
        $partnerId = $request->user()->id;
        $jobsInProgress = Job::with(['postedBy'=>function($query){
            $query->select('id','name','city','mobile');
        },'proposals'=>function($q) use($partnerId){
            $q->where('user_id',$partnerId);
        },'serviceType'=>function($q){},
            'activeContract'=>function($q) use($partnerId){
                $q->where('user_id',$partnerId);
                $q->where('proposal_status',1);
            }])->whereHas('proposals',function($q) use($partnerId) {
            $q->where('user_id',$partnerId)
                ->where('proposal_status',1);
        })->whereIn('status',[Job::IN_PROGRESS,Job::IN_REVIEW])->get();
        return response(['isSuccess'=>true,"result"=>$jobsInProgress,"message"=>""]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
    }

    public function postSubmitWork(WorkSubmissionFormRequest $request,$leadId,$applicationId){
        try{
            $user = $request->user();
            $message = $request->input('message');
            $files = $request->input('attachments');
 
            $job = Job::where('status',JOB::IN_PROGRESS)->where('id',$leadId)->first();
            if($job){
                $jobProposal =  JobApplication::where('id',$applicationId)->where('user_id',$user->id)->where('proposal_status',1)->where('job_id',$leadId)->first();
                if($jobProposal){

                    $attachments = [];
                    if(is_array($files)){
                        foreach($files as $file){
                            $decoded = base64_decode($file['filebase64code']);
                            $safeName = str_random(50).'.'.$file['file_type'];
                            Storage::disk('public')->put('attachments/'.$safeName, $decoded);
                            $attachments[]=[
                            'file_name'=>$file['file_name'],
                            'file_size'=>$file['file_size'],
                            'file_id'=>$safeName
                            ];
                        }
                    }

                    $jobSubmission = new JobSubmission;
                    $jobSubmission->user_id=$user->id;
                    $jobSubmission->message = $request->input('message');
                    $jobSubmission->action = 'Submission';
                    $jobSubmission->job_id = $job->id;
                    $jobSubmission->job_application_id =  $jobProposal->id;
                    $jobSubmission->save();

                    $job->status = Job::IN_REVIEW;
                    $job->save();

                    foreach($attachments as $attachment){
                        $attachment['job_submission_id']=$jobSubmission->id;
                        JobSubmissionFile::create($attachment);
                    }

                    EmailQueue::create(['job_id'=>$job->id,'proposal_id'=>$jobProposal->id,'status'=>0,'type'=>'WORK_SUBMISSION']);

                    return response(['isSuccess'=>true,"result"=>[],"message"=>"Submitted successfully"]);
                }else{
                     return response(['isSuccess'=>false,"result"=>[],"message"=>"No proposal data found"],400);
                }
            }else{
                 return response(['isSuccess'=>false,"result"=>[],"message"=>"No Job data found"],400);
            }
        }catch(\Exception $e){
             return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
    }

    public function getSentProposals(Request $request){
        try{
            
            $user = $request->user();
            $jobProposals =  JobApplication::with(['proposalBy'=>function($q){
                return $q->select('id','name');
            },'job'=>function($q){
                return $q->with(['postedBy'=>function($qs){
                    return $qs->select('id','name');
                }])->select('id','user_id','job_title','city');
            }])->where('user_id',$user->id)->orderBy('id','desc')->get(['id','user_id','job_id','created_at','chat_initiated']);
            
            return response(['isSuccess'=>true,"result"=>$jobProposals,"message"=>""]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
    }

    public function getPaidProposals( Request $request ) {
        try{
            
           $user = $request->user();
            $jobProposals =  JobApplication::with(['jobpayments'=>function($q){
                return $q->where('payment_status','1');
            }])->where('user_id',$user->id)->orderBy('id','desc')->get();
            $totalAmt = [];
            foreach( $jobProposals as $proposal ){
                $totalAmt[] = $proposal['jobpayments']['amount'];
            }

            return response(['isSuccess'=>true,"result"=>array_sum( $totalAmt ),"message"=>""]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }

    }
    public function getPendingPayment( Request $request ) {
        try{
            $user = $request->user();
            $jobProposals = JobApplication::with(['jobpayments'=>function($q){
                return $q->where('payment_status','1')->where('transfer_amount','0');
            }])
            ->where('user_id',$user->id)->orderBy('id','desc')
            ->get();
            $totalAmt = [];
            foreach( $jobProposals as $proposal ){
                $totalAmt[] = $proposal['jobpayments']['amount'];
            }
            return response(['isSuccess'=>true,"result"=>array_sum( $totalAmt ),"message"=>""]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
    }

    public function getCompleted(Request $request){
        try{
        $partnerId = $request->user()->id;
        $jobsInProgress = Job::with(['postedBy'=>function($query){
            $query->select('id','name','city','mobile');
        },'serviceType'=>function($q){},
            'activeContract'=>function($q) use($partnerId){
                $q->where('user_id',$partnerId);
                $q->where('proposal_status',1);
            }])->whereHas('proposals',function($q) use($partnerId) {
            $q->where('user_id',$partnerId)
                ->where('proposal_status',1);
        })->whereIn('status',[Job::COMPLETED])->get();
        return response(['isSuccess'=>true,"result"=>$jobsInProgress,"message"=>""]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
    }
}
