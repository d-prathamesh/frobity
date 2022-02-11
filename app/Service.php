<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    public function subcategories(){
        return $this->hasMany('App\Service','parent_id');
    }

    public function category(){
        return $this->belongsTo('App\Service','parent_id','id');
    }

    public function getImageUrlAttribute($value){
        return $value ? url('/cat/'.$value) : "";
    }
}
