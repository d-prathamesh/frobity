<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerSubscription extends Model
{
    protected $table = 'partner_subscriptions';

    protected $fillable = ['transaction_id','amount','status','user_id','payment_at','expired_at'];
}
