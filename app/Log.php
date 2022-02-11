<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    public $job = null;

    protected $fillable = [
         'request','response'
    ];
     
}
