<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailQueue extends Model
{
    protected $table = 'emails_queue';
    protected $fillable = [
    	'type','job_id','proposal_id','status'
    ];
    public $timestamps = false;
}
