<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    const PENDING = 0;
    const ACCEPTED = 1;
    const DECLINED = 2;
    protected $table = 'job_applications';
    public $job = null;

    protected $fillable = [
         'user_id','proposal_summary','amount','expected_days','proposal_status',
         'job_id',
     ];
     
    public function getProposalSummaryAttribute($value){
    	return $value ? $value : "";
    }
    public function fileattachments(){
        return $this->hasOne('App\ProposalSubmissionFile','proposal_submission_id','id');
    }
	public function  jobpartner(){
        return $this->belongsTo("App\User",'user_id','id');
    }
	
    public function get_job_detail()
    {
        return $this->hasOne('App\Job','id','job_id');
    }
	 public function jobpayments()
    {
        return $this->hasOne('App\Payment','job_id','job_id');
    }
	
    public function  job(){
        return $this->belongsTo("App\Job",'job_id','id');
    }

    public function  proposalBy(){
        return $this->belongsTo("App\User",'user_id','id');
    }
    
    public function  contractor(){
        return $this->belongsTo("App\User",'user_id','id');
    }

    public function getProposalStatusAttribute($value){
        switch($value){
            case 0 : return 'Pending';
            case 1 : return 'Accepted';
            case 2 : return 'Declined';
            case 3 : return 'Completed';
        }
    }

    public function get_transfer_pending_jobs(){
        $where = array(
            'proposal_status'=>1,
            'payment_status' => 1,            
        );
        $data = JobApplication::with('jobpartner')->whereHas('get_job_detail',function($q){
            $q->where('status',3);
        })->whereHas('jobpayments',function($q){
              $q->whereNull('transfer_status');
        })->where($where)->get();
        return $data;
    }
}
