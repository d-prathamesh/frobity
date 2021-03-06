<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\EmailQueue;
use App\Mail\NewJobNotification;
use App\Job;
use App\Notification;
use App\JobApplication;
use Illuminate\Support\Facades\Mail;
use App\User;
use DB;
use App\Services\FcmService;


use App\Mail\NewProposalNotification;
use App\Mail\ProposalAcceptanceNotification;
use App\Mail\WorkAcceptanceNotification;
use App\Mail\WorkRejectionNotification;
use App\Mail\WorkSubmissionNotification;
use App\Mail\ProposalDeclinedNotification;

class NotificationProcessor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends email and push notifications in background';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function getTokens($job){
        $tokens = [];
        $results = [];
        // if($job->service_type < 6 && $job->longitude && $job->latitude){
        //     $results = DB::select("SELECT device_token, 3956 * 2 * ASIN(SQRT(POWER(SIN(({$job->latitude}-ABS(latitude)) * PI()/180 / 2), 2) + COS({$job->latitude} * PI()/180 ) * COS(ABS(latitude) * PI()/180) * POWER(SIN(({$job->longitude}-longitude) * PI()/180 / 2), 2) )) AS distance FROM fin_users where service_type = '{$job->service_type}' and device_token IS NOT NULL having distance < 20");
           
        // }else if($job->service_type >=6){
        //     $results = DB::select("SELECT device_token FROM fin_users where service_type = '{$job->service_type}' and device_token IS NOT NULL");
        // }
        $results = DB::select("SELECT device_token FROM fin_users where service_type = '{$job->service_type}' and device_token IS NOT NULL");

        if(!empty($results)){
            $tokens = array_filter(array_column($results,'device_token'));
        }
        return $tokens;
    }

    public function getEmails($job){
        $emails = [];
        $results = [];
        /*if($job->service_type < 6 && $job->longitude && $job->latitude){
            $results = DB::select("SELECT email, 3956 * 2 * ASIN(SQRT(POWER(SIN(({$job->latitude}-ABS(latitude)) * PI()/180 / 2), 2) + COS({$job->latitude} * PI()/180 ) * COS(ABS(latitude) * PI()/180) * POWER(SIN(({$job->longitude}-longitude) * PI()/180 / 2), 2) )) AS distance FROM fin_users where email_alert='1' AND service_type = '{$job->service_type}' having distance < 20");
            
        }else if($job->service_type >=6){
            $results = DB::select("SELECT email FROM fin_users where service_type = '{$job->service_type}'");
        }*/
        $results = DB::select("SELECT email FROM fin_users where service_type = '{$job->service_type}'");
        

        if(!empty($results)){
            $emails = array_column($results,'email');
        }
        return $emails;
    }

    public function newJobEmail($job){
        $users = $this->getEmails($job);
        
        try{
            if(!empty($users)){
                //Mail::to('no-reply@hirebunny.com')
		//		Mail::to('sudhirpur123@gmail.com')
				Mail::to('milind.d@sukanyasoftwares.com')
//                Mail::to('no-reply@frobity.com')
                ->bcc($users)
                ->send(new NewJobNotification($job));
                $this->info('Success: Email Notification sent');
            }
        }catch(\Exception $e){
            
        }
       
    }

    public function newJobNotification($job){
        $tokens = $this->getTokens($job);
        try{
            if(!empty($tokens)){
                $payload = [];
                $payload['notification']     = array(
                    "body"             => $job->postedBy->name.' request for '.$job->serviceType->name. "in {$job->city} location",
                    "title"            => "Service request",
                );

                $payload['data']  = array(
                    'title'=>"Service request",
                    "type"=>"SERVICE_REQUEST",
                    "message"=> $job->postedBy->name.' request for '.$job->serviceType->name. "in {$job->city} location",
                    "leadId"=> "{$job->id}",
                );

                FcmService::sendPushNotification('PARTNER',$tokens,$payload);
//				Notification::insert(['notification_type'=>'new_job', 'to_user_id'=>$job->user_id, 'notification_title'=>'New job posted', 'notification_link' => 'http:hirebunny.com' ]);
					
				
			
            }
            
        }catch(\Exception $e){
            
        }
		
    }

    public function newProposalNotification($job,$proposal = null){
        
        try{
            $payload = [];
            $payload['notification']     = array(
                 "body"             => "You have recieved proposal for {$job->serviceType->name}",
                 "title"            => "New Proposal recieved",
            );

            $payload['data']  = array(
                'title'=>"New Proposal recieved",
                "type"=>"PROPOSAL_RECIEVED",
                "message"=> "You have recieved proposal for {$job->serviceType->name}",
                "leadId"=> "{$job->id}",
            );
           // Notification::insert(['notification_type'=>'new_proposal', 'to_user_id'=>$job->user_id, 'notification_title'=>'Your job received a new proposal', 'notification_link' => route('web.client.posted.jobs.proposal-detail',[ 'id' => $job->id, 'proposalId' => $proposal->id ]) ]);
				
            FcmService::sendPushNotification('CLIENT',[$job->postedBy->device_token],$payload);
            
        }catch(\Exception $e){
            mail("sudhirpur123@gmail.com","error ", "Err message ".$e->getMessage()." - ".json_encode($proposal)." - ".json_encode($job) );
        }
        if($proposal){
            try{
				//Mail::to('sudhirpur123@gmail.com')->send(new NewProposalNotification($job,$proposal));
				Mail::to('milind.d@sukanyasoftwares.com')->send(new NewProposalNotification($job,$proposal));
                Mail::to($job->postedBy->email)
                    ->send(new NewProposalNotification($job,$proposal));
            }catch(\Exception $e){
                $this->error($e->getMessage());
            }
        }
    }

    public function proposalAcceptedNotification($job,$proposal = null){
        if($proposal)
        {
            try{
                $payload = [];
                $payload['notification']     = array(
                    "body"             => "Your proposal has been accepted for {$job->serviceType->name}",
                    "title"            => "Proposal accepted",
                );

                $payload['data']  = array(
                    'title'=>"Proposal accepted",
                    "type"=>"PROPOSAL_ACCEPTED",
                    "message"=> "Your proposal has been accepted for {$job->serviceType->name}",
                    "leadId"=> "{$job->id}",
                );
 				
			//Notification::insert(['notification_type'=>'proposal accepted', 'to_user_id'=>$proposal->user_id, 'notification_title'=>'Your proposal accepted', 'notification_link' => 'http:hirebunny.com' ]);
		
               FcmService::sendPushNotification('PARTNER',[$proposal->proposalBy->device_token],$payload);
                
            }catch(\Exception $e){
                
            }
            
            try{
				//Mail::to('sudhirpur123@gmail.com')->send(new ProposalAcceptanceNotification($job,$proposal));
				Mail::to('milind.d@sukanyasoftwares')->send(new ProposalAcceptanceNotification($job,$proposal));
                Mail::to($proposal->proposalBy->email)
                    ->send(new ProposalAcceptanceNotification($job,$proposal));
            }catch(\Exception $e){
                $this->error($e->getMessage());
            }
        }
    }
	
	
	public function proposalDeclinedNotification($job,$proposal = null){
        if($proposal)
        {
            try{
                $payload = [];
                $payload['notification']     = array(
                    "body"             => "Your proposal has been declined for {$job->serviceType->name}",
                    "title"            => "Proposal declined",
                );

                $payload['data']  = array(
                    'title'=>"Proposal declined",
                    "type"=>"PROPOSAL_DECLINED",
                    "message"=> "Your proposal has been declined for {$job->serviceType->name}",
                    "leadId"=> "{$job->id}",
                );
 				
			//Notification::insert(['notification_type'=>'proposal accepted', 'to_user_id'=>$proposal->user_id, 'notification_title'=>'Your proposal accepted', 'notification_link' => 'http:hirebunny.com' ]);
		
               FcmService::sendPushNotification('PARTNER',[$proposal->proposalBy->device_token],$payload);
                
            }catch(\Exception $e){
                
            }
            
            try{
				//Mail::to('sudhirpur123@gmail.com')->send(new proposalDeclinedNotification($job,$proposal));
				Mail::to('milind.d@sukanyasoftwares.com')->send(new proposalDeclinedNotification($job,$proposal));
                Mail::to($proposal->proposalBy->email)
                    ->send(new proposalDeclinedNotification($job,$proposal));
            }catch(\Exception $e){
                $this->error($e->getMessage());
            }
        }
    }
	

    public function workSubmissionNotification($job,$proposal = null){
        if($proposal){
            try{
                $payload = [];
                $payload['notification']     = array(
                    "body"             => "{$proposal->postedBy->name} has sent submission request for {$job->serviceType->name}",
                    "title"            => "Work Submission",
                );

                $payload['data']  = array(
                    'title'=>"Work Submission",
                    "type"=>"WORK_SUBMISSION",
                    "message"=> "{$proposal->postedBy->name} has sent submission request for {$job->serviceType->name}",
                    "leadId"=> "{$job->id}",
                );
                FcmService::sendPushNotification('CLIENT',[$job->postedBy->device_token],$payload);
			//	Notification::insert(['notification_type'=>'Work Submission', 'to_user_id'=>$proposal->user_id, 'notification_title'=>'Your Work Submission request ', 'notification_link' => 'http:hirebunny.com' ]);
                
            }catch(\Exception $e){
                
            }
            
            try{
				//Mail::to('sudhirpur123@gmail.com')->send(new WorkSubmissionNotification($job,$proposal));
				Mail::to('milind.d@sukanyasoftwares.com')->send(new WorkSubmissionNotification($job,$proposal));
                Mail::to($job->postedBy->email)
                    ->send(new WorkSubmissionNotification($job,$proposal));
            }catch(\Exception $e){
                $this->error($e->getMessage());
            }
        }
        
    }

    public function workAcceptanceNotification($job,$proposal = null){
        if($proposal)
        {
            try{
                $payload = [];
                $payload['notification']     = array(
                    "body"             => "Your work has been accepted for {$job->serviceType->name}",
                    "title"            => "Work accepted",
                );

                $payload['data']  = array(
                    'title'=>"Work accepted",
                    "type"=>"WORK_ACCEPTED",
                    "message"=> "Your work has been accepted for {$job->serviceType->name}",
                    "leadId"=> "{$job->id}",
                );
                FcmService::sendPushNotification('PARTNER',[$proposal->proposalBy->device_token],$payload);
				//Notification::insert(['notification_type'=>'Work accepted', 'to_user_id'=>$proposal->user_id, 'notification_title'=>'Your work has been accepted', 'notification_link' => 'http:hirebunny.com' ]);
                
            }catch(\Exception $e){
                
            }
            
            try{
				//Mail::to('sudhirpur123@gmail.com')->send(new WorkAcceptanceNotification($job,$proposal));
				Mail::to('milind.d@sukanyasoftwares.com')->send(new WorkAcceptanceNotification($job,$proposal));
                Mail::to($proposal->proposalBy->email)
                    ->send(new WorkAcceptanceNotification($job,$proposal));
            }catch(\Exception $e){
                $this->error($e->getMessage());
            }
        }
    }

    public function workRejectionNotification($job,$proposal = null){
        if($proposal)
        {
            try{
                $payload = [];
                $payload['notification']     = array(
                    "body"             => "{$job->postedBy->name} has not approved your current work submission for {$job->serviceType->name}",
                    "title"            => "Work submission update",
                );

                $payload['data']  = array(
                    'title'=>"Work submission update",
                    "type"=>"WORK_SUBMISSION_UPDATE",
                    "message"=> "{$job->postedBy->name} has not approved your current work submission for {$job->serviceType->name}",
                    "leadId"=> "{$job->id}",
                );
                FcmService::sendPushNotification('PARTNER',[$proposal->proposalBy->device_token],$payload);
                
            }catch(\Exception $e){
                
            }
            
            try{
				//Mail::to('sudhirpur123@gmail.com')->send(new WorkRejectionNotification($job,$proposal));
				Mail::to('milind.d@sukanyasoftwares.com')->send(new WorkRejectionNotification($job,$proposal));
                Mail::to($proposal->proposalBy->email)
                    ->send(new WorkRejectionNotification($job,$proposal));
            }catch(\Exception $e){
                $this->error($e->getMessage());
            }
        }
    }

    public function handle()
    {
        $notifications = EmailQueue::where('status',0)->take(25)->get();
        foreach($notifications as $notification){
            $job  = Job::find($notification->job_id);
            try{
                if($job){
                    switch($notification->type){
                        case 'NEW_JOB':
                            /**Notification to partner app*/
							//'notification_link' => route('web.client.posted.jobs',[ 'id' => $job->id ])
                            $this->newJobEmail($job);
                            $this->newJobNotification($job);
                            break;
                        case 'JOB_PROPOSAL':
                            /** Notification to client app*/
							
                            $proposal = JobApplication::find($notification->proposal_id);
					Notification::insert(['notification_type'=>'new_proposal', 'to_user_id'=>$job->user_id, 'notification_title'=>"Your job {$job->job_title} received a new proposal", 'notification_link' => route('web.client.posted.jobs.proposal-detail',[ 'id' => $job->id, 'proposalId' => $notification->proposal_id ]) ]);
                            
                            $this->newProposalNotification($job,$proposal);

                            break;
                        case 'PROPOSAL_ACCEPTED':
                            $proposal = JobApplication::find($notification->proposal_id);
                            $this->proposalAcceptedNotification($job,$proposal);
                    Notification::insert(['notification_type'=>'new_proposal', 'to_user_id'=>$proposal->user_id, 'notification_title'=>"Your proposal for job {$job->job_title} accepted", 'notification_link' => route('web.client.posted.jobs.proposal-detail',[ 'id' => $job->id, 'proposalId' => $notification->proposal_id ]) ]);
                            /**Notification to partner app*/
                            break;
							
						case 'PROPOSAL_DECLINED':
                            $proposal = JobApplication::find($notification->proposal_id);
                            $this->proposalDeclinedNotification($job,$proposal);
                    Notification::insert(['notification_type'=>'new_proposal', 'to_user_id'=>$proposal->user_id, 'notification_title'=>"Your proposal for job {$job->job_title} declined", 'notification_link' => route('web.client.posted.jobs.proposal-detail',[ 'id' => $job->id, 'proposalId' => $notification->proposal_id ]) ]);
                            /**Notification to partner app*/
                            break;
							
                        case 'WORK_SUBMISSION':
                            $proposal = JobApplication::find($notification->proposal_id);
                            $this->workSubmissionNotification($job,$proposal);
                    Notification::insert(['notification_type'=>'new_proposal', 'to_user_id'=>$job->user_id, 'notification_title'=>"Your work for job {$job->job_title} has been accepted", 'notification_link' => route('web.client.posted.jobs.proposal-detail',[ 'id' => $job->id, 'proposalId' => $notification->proposal_id ]) ]);
                            /** Notification to client app*/
                            break;
                        case 'ACCEPT_SUBMISSION':
                            $proposal = JobApplication::find($notification->proposal_id);
                            $this->workAcceptanceNotification($job,$proposal);
                    Notification::insert(['notification_type'=>'new_proposal', 'to_user_id'=>$proposal->user_id, 'notification_title'=>"Your work for job {$job->job_title} submission request is accepted.", 'notification_link' => route('web.client.posted.jobs.proposal-detail',[ 'id' => $job->id, 'proposalId' => $notification->proposal_id ]) ]);
                            /**Notification to partner app*/
                            break;
                        case 'REJECT_SUBMISSION':
                            $proposal = JobApplication::find($notification->proposal_id);
                            $this->workRejectionNotification($job,$proposal);
                            /**Notification to partner app*/
                    Notification::insert(['notification_type'=>'new_proposal', 'to_user_id'=>$proposal->user_id, 'notification_title'=>"Your work for job {$job->job_title} submission request is rejected.", 'notification_link' => route('web.client.posted.jobs.proposal-detail',[ 'id' => $job->id, 'proposalId' => $notification->proposal_id ]) ]);
                            break;

                    }
                    $notification->status = 1;
                    $notification->save();
                }
            }catch(\Exception $e){
                $this->info("Error : Unable to send notification ",$e->getMessage());
                $notification->status = 2;
                $notification->save();
            }   
        }
        
    }
}
