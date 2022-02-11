<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $table = 'refund_payment';
    public $job = null;

    protected $fillable = [
         'id','refund_id','amount','currency','razor_payment_id','status','payment_id'
    ];
     
}
