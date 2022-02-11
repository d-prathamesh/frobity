<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primarykey = 'id';
    protected $fillable = ['name','email','password'];

    public function login($email='',$password='')
    {  
    	$where = array(
    		'email'=>$email,
    	); 

        $getdata = Admin::where($where)->first();
       	$responce = array();
       if ($getdata)
    	{
    		if ($getdata->password == $password) {
    			$responce['isSuccess'] = true;
    			$responce['message'] = 'login Success';
    			$responce['data']= $getdata;
    		}
    		else
    		{
    			$responce['isSuccess'] = false;
    			$responce['message']='Wrong Password';
    		}
    	}
    	else{
    		$responce['isSuccess'] = false;
    		$responce['message']='Email id does not exist';
    	}
    	return $responce;
    }
}
