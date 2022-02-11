<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    public $job = null;

    protected $fillable = [
         'id','notification_type','to_user_id','notification_title','notification_link'
    ];
     
}
