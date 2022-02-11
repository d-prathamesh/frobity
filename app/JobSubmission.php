<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSubmission extends Model
{
     protected $table = 'job_submissions';


     public function  user(){
        return $this->belongsTo("App\User",'user_id','id');
    }

    public function attachments(){
        return $this->hasMany('App\JobSubmissionFile','job_submission_id');
    }
}
