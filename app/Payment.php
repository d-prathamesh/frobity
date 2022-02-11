<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    public $job = null;

    protected $fillable = [
         'job_id','proposal_id','amount','payment_status','transaction_id'
    ];
     
}
