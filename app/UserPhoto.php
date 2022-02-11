<?php

namespace App;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    protected $table = 'user_photos';
    protected $fillable = ['user_id', 'image'];
    public $timestamps = false;
    public function getImageAttribute($value){
        return $value ? asset(Storage::url('../idproofs/'.$value)) : "";
    }
    
}
