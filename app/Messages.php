<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'job_submissions';
    public $job = null;

    protected $fillable = [
         'id','user_id','message','job_id','to_user_id','job_title'
    ];
     
}
