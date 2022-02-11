<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    const OPEN = 0;
    const IN_PROGRESS = 1;
    const IN_REVIEW = 2;
    const COMPLETED = 3;
    const REFUNDED = 5;
    const CANCELLED = 4;

    protected $table = 'jobs';

    protected $fillable = ["service_type","service_sub_type","service_required","business_type", "annual_turnover","industry","requirement_qualification","city","longitude","latitude","query","job_title","user_id", "budget", "tags"];

	public function  jobclient(){
        return $this->belongsTo("App\User",'user_id','id');
    }

    public function jobservice(){
        return $this->belongsTo("App\Service","service_type","id");
    }

    public function jobapplication(){
        return $this->hasMany('App\JobApplication',"job_id","id");
    }
     public function  postedBy(){
     	return $this->belongsTo("App\User",'user_id','id');
     }

     public function  proposals(){
        return $this->hasMany("App\JobApplication");
    }

    public function  submissionHistory(){
        return $this->hasMany("App\JobSubmission");
    }
    
    
    public function  activeContract(){
        return $this->hasOne("App\JobApplication");
    }


     public function  serviceType(){
     	return $this->belongsTo("App\Service",'service_type','id');
     }

     public function  serviceSubType(){
        return $this->belongsTo("App\Service",'service_sub_type','id');
    }


     
     public function getBusinessTypeAttribute($value){
    	return $value ? $value : "";
    }

    public function getAnnualTurnoverAttribute($value){
    	return $value ? $value : "";
    }


    public function getIndustryAttribute($value){
    	return $value ? $value : "";
    }

    public function getRequirementQualificationAttribute($value){
    	return $value ? $value : "";
    }


    public function getLongitudeAttribute($value){
    	return $value ? $value : "";
    }

    public function getLatitudeAttribute($value){
    	return $value ? $value : "";
    }

    public function getQueryAttribute($value){
    	return $value ? $value : "";
    }

    public function getStatusAttribute($value){
        switch($value){
            case 0 : return 'Open';
            case 1 : return 'InProgress';
            case 2 : return 'InReview';
            case 3 : return 'Completed';
            case 4 : return 'Cancelled';
            case 5 : return 'Refunded';
        }
    }

    public function get_jobs($id)
    {
        $where = array(
            'user_id'=>$id
        );
        $getdata = Job::where($where)->get();

        return $getdata;
    }
     public function countjobs($id)
    {
        $where = array(
            'user_id'=>$id
        );
        $getdata = Job::where($where)->count();
        return $getdata;
    }

    public function count_ongoing_jobs($id)
    {
        $where = array(
            'user_id'=>$id,
            'status'=>1
        );
        $getdata = Job::where($where)->count();
        return $getdata;
    }

     public function count_completed_jobs($id)
    {
        $where = array(
            'user_id'=>$id,
            'status'=>3
        );
        $getdata = Job::where($where)->count();
        return $getdata;
    }
	
	public function jobs_by_status($status){
        $where = array(
            'status'=>$status
        );
        if($status == self::IN_PROGRESS){
             $getdata = Job::with('jobclient','jobservice')->whereHas('JobApplication',function($q){
                $q->with('Partner')->where(['proposal_status'=>1,'payment_status'=>1]);
             })->where($where)->get();
        
        }else if($status == self::COMPLETED){
             $getdata = Job::with('jobclient','jobservice')->whereHas('JobApplication',function($q){
                $q->with('Partner')->whereHas('jobpayments',function($q){
                    $q->where('transfer_status',1);
                })->where(['proposal_status'=>1,'payment_status'=>1]);
             })->where($where)->get();
        }else{
             $getdata = Job::with('jobclient','jobservice')->where($where)->get();
        
        }
		
		
		//$getdata_arr = $getdata->toArray();
		//echo "<pre>";
		//print_r($getdata_arr);echo "</pre>";
       return $getdata;
    }

    
}
