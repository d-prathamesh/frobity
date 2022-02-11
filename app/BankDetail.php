<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    protected $table = 'bank_details';


    public $timestamps = false;

    protected $attributes = [
        'acc_num' => "",
        'ifsc' => "",
        "bank_name"=>""
    ];

    protected $fillable = ['name','user_id'];
    protected $hidden = ['id','user_id'];

    public function getIfscAttribute($value){
    	return $value ? $value : "";
    }

    public function getAccNumAttribute($value){
    	return $value ? $value : "";
    }

    public function getBankNameAttribute($value){
    	return $value ? $value : "";
    }

    public function getBankDetail($id)
    {
        $where = array(
            'user_id'=>$id
        );
        $getdata = BankDetail::where($where)->first();

        return $getdata;
    }


}
