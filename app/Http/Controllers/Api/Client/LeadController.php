<?php namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job;
use App\Http\Requests\LeadPostFormRequest;
use App\JobApplication;
use DB;
use App\Payment;
use App\Http\Requests\UpdateSubmissionFormRequest;
use App\EmailQueue;
use App\JobSubmission;
use App\Http\Requests\JobPostFormRequest;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewJobPostInvitation;
use Razorpay\Api\Api as RazorApi;

class LeadController extends Controller
{
	public function __construct(){
		 $this->middleware('clientOnly');
	}

    public function getAllClientLeads(Request $request){
        try{
        	$jobs = Job::with(['postedBy'=>function($q){
        		$q->select('id','email','name');
        	},'serviceType'=>function($q){
        		$q->select('id','name');
			},'serviceSubType'=>function($q){
        		$q->select('id','name');
			},'proposals'=>function($q){
				$q->select('id','job_id');
			}
			])->where('user_id',$request->user()->id)->orderBy('id','desc')->get();
        	return response(['isSuccess'=>true,"result"=>$jobs,"message"=>""]);
        }catch(\Exception $e){
        	return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
    }
	
	public function postLead(LeadPostFormRequest $request){
		
        $data = $request->only(["service_type","service_required","business_type", "annual_turnover","industry","requirement_qualification","city","longitude","latitude","query","job_title","budget", "tags"]);
        try{
        	$data['user_id'] = $request->user()->id;
        	$job = Job::create($data);
        	return response(['isSuccess'=>true,"result"=>[],"message"=>"Job posted successfully !"]);

        }catch(\Exception $e){

        	return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
    }
    
    public function getAllProposals(Request $request){
		try{
			
			$clientId = $request->user()->id;
			$proposals = JobApplication::with(['job'=>function($q){
				$q->select('id','job_title','service_type','service_required')->with(['serviceType'=>function($q){
					$q->select('id','name');
				},'serviceSubType'=>function($q){
					$q->select('id','name');
				}]);
			},'proposalBy'=>function($q){
				$q->select('id','name','mobile','professional_experience','bio','city');
			}])
			->select('id','proposal_summary','chat_initiated','amount','expected_days','created_at','job_id','user_id')
			->whereHas('job',function($q) use($clientId){
				$q->where('user_id',$clientId);
			})
			->where('proposal_status',JobApplication::PENDING)
			->get();
			return response(['isSuccess'=>true,"result"=>$proposals,"message"=>""]);
		}catch(\Exception $e){
			return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
		}

	}

	public function getAllProposalsByLead(Request $request,$leadId){
		try{
			$clientId = $request->user()->id;
			$proposals = JobApplication::with(['job'=>function($q){
				$q->select('id','job_title','service_type','service_sub_type')->with(['serviceType'=>function($q){
					$q->select('id','name');
				},'serviceSubType'=>function($q){
					$q->select('id','name');
				}]);
			},'proposalBy'=>function($q){
				$q->select('id','name','mobile','professional_experience','bio');
			}])
			->select('id','proposal_summary','amount','expected_days','created_at','job_id','user_id','chat_initiated')
			->whereHas('job',function($q)  use($leadId,$clientId){
				$q->where('id',$leadId)->where('user_id',$clientId);
			})
			->where('proposal_status',JobApplication::PENDING)
			->get();
			
			return response(['isSuccess'=>true,"result"=>$proposals,"message"=>""]);
		}catch(\Exception $e){
			return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],500);
		}

	}
	
	
	
	 public function getLeadApplication(Request $request,$leadId,$applicationId){
		try{
			
			$clientId = $request->user()->id;
			$proposal = JobApplication::with(['job'=>function($q){
				$q->select('id','city','job_title','status','service_type','service_required','service_sub_type')->with(['serviceType'=>function($q){
					$q->select('id','name');
				},'serviceSubType'=>function($q){
					$q->select('id','name');
				}]);
			},'proposalBy'=>function($q){
				$q->select('id','name','mobile','city','professional_experience','bio');
			},'fileattachments'=>function($q){
				$q->select('proposal_submission_id','file_name','file_size','file_id');
			}
			])
			
			->select('id','proposal_summary','proposal_status','amount','expected_days','created_at','job_id','user_id','chat_initiated')
			
			->whereHas('job',function($q) use($leadId,$clientId){
				$q->where('id',$leadId)->where('user_id',$clientId)->where('status',Job::OPEN);
			})
			->where('proposal_status',JobApplication::PENDING)
			->where('id',$applicationId)
			->first();
	
			if(!$proposal){
				return response(['isSuccess'=>false,"result"=>[],"message"=>'No proposal found'],404);
			}

			return response(['isSuccess'=>true,"result"=>$proposal,"message"=>""]);
		}catch(\Exception $e){
			
			return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
		}
	}

	public function getPaidProposals(Request $request){
		try{
			
			$clientId = $request->user()->id;
//			DB::enableQueryLog(); // Enable query log


			// Your Eloquent query executed by using get()

			$paidProposals = JobApplication::with(['jobpayments'=>function($q){
                return $q->where('payment_status','1');
            }])
			->whereHas('job',function($q) use($clientId){
				return $q->where('user_id',$clientId);
			})
			->get();

            $totalAmt = [];
            foreach( $paidProposals as $proposal ){
                $totalAmt[] = $proposal['jobpayments']['amount'];
                
            }


//			print_r( DB::getQueryLog() ); // Show results of log
			if(!$proposal){
				return response(['isSuccess'=>false,"result"=>[],"message"=>'No proposal found'],404);
			}

			return response(['isSuccess'=>true,"result"=>array_sum( $totalAmt ) ,"message"=>""]);
		}catch(\Exception $e){
			
			return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
		}
	}	
	
	public function postAcceptProposal(Request $request,$leadId,$applicationId){
		
		try{
			$transactionId = $request->input('transaction_id');
			$razorApi = new RazorApi(env('RAZOR_API_KEY'), env('RAZOR_API_SECRET'));
			$payment  = $razorApi->payment->fetch($transactionId);
	
		
		if($payment){
				DB::beginTransaction();
				$clientId = $request->user()->id;
				$proposal = JobApplication::with(['job'=>function($q){
					$q->select('id','job_title','status','service_type')->with(['serviceType'=>function($q){
						$q->select('id','name');
					}]);
				},'proposalBy'=>function($q){
					$q->select('id','name','mobile','professional_experience','bio');
				}])
				->select('id','proposal_summary','proposal_status','amount','expected_days','created_at','job_id','user_id')
				->whereHas('job',function($q) use($leadId,$clientId){
					$q->where('id',$leadId)->where('user_id',$clientId)->where('status',Job::OPEN);
				})
				->where('proposal_status',JobApplication::PENDING)
				->where('id',$applicationId)
				->first();
				
				if(!$proposal){
					return response(['isSuccess'=>false,"result"=>[],"message"=>'No proposal found'],404);
				}

				
				$paymentStatus = $payment->status;
				$paymentAmount = $payment->amount/100;


				if(($paymentStatus == "authorized" || $paymentStatus =='captured')){
					
					JobApplication::where('job_id',$leadId)->whereNotIn('id',[$applicationId])->update(['proposal_status'=>JobApplication::DECLINED]);
					$paymentStored = Payment::create(['job_id'=>$proposal->job_id,
							'proposal_id'=>$applicationId,
							'payment_status'=>1,
							'amount'=>$paymentAmount,
							'transaction_id'=>$request->input('transaction_id')
					]);

					if($paymentStored){
						$proposal->proposal_status =  1;
						$proposal->payment_status = 1;
						$proposal->payment_date = date('Y-m-d H:i:s');
						$proposal->save();
						
						$job = Job::find($proposal->job_id);
						$job->status = 1;
						$job->save();
						EmailQueue::create(['job_id'=>$job->id,'proposal_id'=>$proposal->id,'status'=>0,'type'=>'PROPOSAL_ACCEPTED']);
						DB::commit();
					}

					return response(['isSuccess'=>true,"result"=>[],"message"=>"Proposal accepted"]);
				}else{
					return response(['isSuccess'=>false,"result"=>[],"message"=>"Payment Failed !"],500);
				}
			}else{
				return response(['isSuccess'=>false,"result"=>[],"message"=>"Invalid Payment !"],500);
			}
		}catch(\Exception $e){
			DB::rollBack();
			return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
		}	
		
	}
	
	
	
	public function postDeclineProposal(Request $request, $id, $proposalId){
		//print_r($_REQUEST);
		//echo "id in lead controller" . $id;
		//echo "proposl id in lead controller" . $proposalId;
		//die();
//		return response( ["id"=>$id] );
		
		try{
				$clientId = $request->user()->id;
//				return response( ["id"=>$id, 'cid' => $clientId ] );
				$proposal = JobApplication::with(['job'=>function($q){
					$q->select('id','job_title','status','service_type')->with(['serviceType'=>function($q){
						$q->select('id','name');
					}]);
				},'proposalBy'=>function($q){
					$q->select('id','name','mobile','professional_experience','bio');
				}])
				->select('id','proposal_summary','proposal_status','amount','expected_days','created_at','job_id','user_id')
				->whereHas('job',function($q) use($id,$clientId){
					$q->where('id',$id)->where('user_id',$clientId)->where('status',Job::OPEN);
				})
				->where('proposal_status',JobApplication::PENDING)
				->where('id',$proposalId)
				->first();
				
				if(!$proposal){
					return response(['isSuccess'=>false,"result"=>[],"message"=>'No proposal found'],404);
				}

//					JobApplication::where('job_id',$id)->whereNotIn('id',[$proposalId])->update(['proposal_status'=>JobApplication::DECLINED]);
					
						$proposal->proposal_status = JobApplication::DECLINED;
						$proposal->save();
						
						//$job = Job::find($proposal->job_id);
//						$job->status = 0;
	//					$job->save();
						EmailQueue::create(['job_id'=>$proposal->job_id,'proposal_id'=>$proposal->id,'status'=>0,'type'=>'PROPOSAL_DECLINED']);
						DB::commit();
					

					return response(['isSuccess'=>true,"result"=>[],"message"=>"Proposal declined"]);
				
			
		}catch(\Exception $e){
			DB::rollBack();
			return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
		}	
		
	}
	
	public function cancelProposal($id){
		//print_r($_REQUEST);
		//echo "id in lead controller" . $id;
		//echo "proposl id in lead controller" . $proposalId;
		//die();
//		return response( ["id"=>$id] );
		
		try{
				//$clientId = $request->user()->id;
//				return response( ["id"=>$id, 'cid' => $clientId ] );
						$this->job = Job::where('id', $id)->first();
						$this->job->status = 4;
						$this->job->save();
						//EmailQueue::create(['job_id'=>$job_id,'status'=>0,'type'=>'PROPOSAL_CANCLED']);
						DB::commit();
					

					return response(['isSuccess'=>true,"result"=>[],"message"=>"Proposal Cancled"]);
				
			
		}catch(\Exception $e){
			DB::rollBack();
			return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
		}	
		
	}
	
	
	
	
	public function getOngoing(Request $request){
        
	try{
            $clientId = $request->user()->id;
            $jobsInProgress = Job::with(['activeContract'=>function($q){
				$q->with(['contractor'=>function($qr){
					$qr->select('id','email','name','city','mobile');
				}
				])->select('id','job_id','user_id');
                
            },'serviceType'=>function($q){},'submissionHistory'=>function($q){
				$q->with(['user'=>function($c){
					$c->select('id','name','email','user_type');
				},'attachments'=>function($d){

				}]);
		}])->whereHas('activeContract',function($q) {
                $q->where('proposal_status',1);
            })->where('user_id',$clientId)->whereIn('status',[Job::IN_PROGRESS,Job::IN_REVIEW])->get();
            return response(['isSuccess'=>true,"result"=>$jobsInProgress,"message"=>""]);
        }catch(\Exception $e){
            return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
    }

    public function postUpdateSubmission(UpdateSubmissionFormRequest $request,$leadId,$applicationId){
    	try{
            $user = $request->user();
            $message = $request->input('message');
            $job = Job::whereIn('status',[Job::IN_PROGRESS,Job::IN_REVIEW])->where('id',$leadId)->first();
            if($job){
                $jobProposal =  JobApplication::where('id',$applicationId)->where('proposal_status',1)->where('job_id',$leadId)->first();
                if($jobProposal){
                    $jobSubmission = new JobSubmission;
                    $jobSubmission->user_id=$user->id;
                    $jobSubmission->message = $request->input('message');
                    $jobSubmission->action = $request->input('action');
                    $jobSubmission->job_id = $job->id;
                    $jobSubmission->job_application_id =  $jobProposal->id;
					$jobSubmission->to_user_id =  $jobProposal->user_id;
					$jobSubmission->job_title =  $job->job_title;
                    $jobSubmission->save();

                    $job->status = $jobSubmission->action == 'accept' ? Job::COMPLETED : Job::IN_PROGRESS;
                    $job->save();
                    if($jobSubmission->action == 'accept'){
                    	EmailQueue::create(['job_id'=>$job->id,'proposal_id'=>$jobProposal->id,'status'=>0,'type'=>'ACCEPT_SUBMISSION']);
                    }else{
                    	EmailQueue::create(['job_id'=>$job->id,'proposal_id'=>$jobProposal->id,'status'=>0,'type'=>'REJECT_SUBMISSION']);
                    }
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
	
	public function postJob(JobPostFormRequest $request){

		$data = $request->only(['job_title','service_type','service_sub_type','query','budget', 'tags']);
		$usersIds = $request->input('users');
		
		try{
        	$data['user_id'] = $request->user()->id;
			$job = Job::create($data);
			
			try{
				if(!empty($usersIds)){
					$userId = explode(',',$usersIds);
					$users = User::whereIn('id',$userId)->get();
					foreach($users as $user){
						Mail::to($user->email)
						->send(new NewJobPostInvitation($job));
					}
				}
                
            }catch(\Exception $e){
				return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
            }
        	return response(['isSuccess'=>true,"result"=>[],"message"=>"Job posted successfully !"]);

        }catch(\Exception $e){

        	return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
		
	}

	public function getCompleted(Request $request){
        
		try{
				$clientId = $request->user()->id;
				$jobsInProgress = Job::with(['activeContract'=>function($q){
					$q->with(['contractor'=>function($qr){
						$qr->select('id','email','name','city','mobile');
					}
					])->select('id','job_id','user_id');
					
				},'serviceType'=>function($q){},'submissionHistory'=>function($q){
					$q->with(['user'=>function($c){
						$c->select('id','name','email','user_type');
					},'attachments'=>function($d){
	
					}]);
			}])->whereHas('activeContract',function($q) {
					$q->where('proposal_status',1);
				})->where('user_id',$clientId)->whereIn('status',[Job::COMPLETED])->get();
				return response(['isSuccess'=>true,"result"=>$jobsInProgress,"message"=>""]);
			}catch(\Exception $e){
				return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
			}
		}

	public function getRefunded(Request $request){
        
		try{
				$clientId = $request->user()->id;
				$jobsInProgress = Job::with(['activeContract'=>function($q){
					$q->with(['contractor'=>function($qr){
						$qr->select('id','email','name','city','mobile');
					}
					])->select('id','job_id','user_id');
					
				},'serviceType'=>function($q){},'submissionHistory'=>function($q){
					$q->with(['user'=>function($c){
						$c->select('id','name','email','user_type');
					},'attachments'=>function($d){
	
					}]);
			}])->whereHas('activeContract',function($q) {
					$q->where('proposal_status',1);
				})->where('user_id',$clientId)->whereIn('status',[Job::REFUNDED])->get();
				return response(['isSuccess'=>true,"result"=>$jobsInProgress,"message"=>""]);
			}catch(\Exception $e){
				return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
			}
		}
		
		public function postInitiateChat(Request $request,$leadId,$applicationId){
			try{
			
				$clientId = $request->user()->id;
				$proposal = JobApplication::whereIn('proposal_status',[JobApplication::PENDING,JobApplication::ACCEPTED])
				->where('id',$applicationId)
				->where('job_id',$leadId)
				->first();
	
				if(!$proposal){
					return response(['isSuccess'=>false,"result"=>[],"message"=>'No proposal found'],404);
				}

				$proposal->chat_initiated = 1;
				$proposal->save();
	
				return response(['isSuccess'=>true,"result"=>[],"message"=>"Chat initiated successfully"]);
			}catch(\Exception $e){
				return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
			}
		}
		
		public function getTransactions(Request $request){
        try{
				$clientId = $request->user()->id;
				//$transactions = Payment::all();
                //->orderBy('id','desc')->get();
				$transactions = DB::select(" SELECT fin_jobs.job_title,fin_payments.payment_status,fin_payments.transaction_id,fin_payments.amount FROM fin_jobs inner JOIN fin_payments WHERE fin_jobs.id = fin_payments.job_id and fin_jobs.user_id = '$clientId' ");
				
				
				
        	return response(['isSuccess'=>true,"result"=>$transactions,"message"=>""]);
        }catch(\Exception $e){
        	return response(['isSuccess'=>false,"result"=>[],"message"=>$e->getMessage()],400);
        }
    }
	
	
	
}
