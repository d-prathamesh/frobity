<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use App\BankDetail;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','device_type','device_token','device_id',
        'user_type','api_token','mobile',"service_type",'token','otp','otp_expires_at','social_id','social_handler','service_sub_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','otp','otp_expires_at','device_id','device_type','device_token','updated_at','created_at'
    ];

    protected $casts = [
        'sms_alert'=>'string',
        "email_alert"=>"string",
        "service_type"=>"string",
        "user_type"=>"string"
    ];


    

    public function getCityAttribute($value){
        return  $value ? $value : "";
    }

    public function getGenderAttribute($value){
        return  $value ? $value : "";
    }


    public function getBioAttribute($value){
        return  $value ? $value : "";
    }

    public function getProfessionalExperienceAttribute($value){
        return  $value ? $value : "";
    }

    public function getAddressAttribute($value){
        return  $value ? $value : "";
    }


    public function getIdProofAttribute($value){
        return $value ? asset(Storage::url('idproofs/'.$value)) : "";
    }

    public function getSocialIdAttribute($value){
        return  $value ? $value : "";
    }
    public function getMobileVerifiedAttribute($value){
        return  $value ? "1" : "0";
    }

    public function getLongitudeAttribute($value){
        return  $value ? $value : "";
    }

    public function getLatitudeAttribute($value){
        return  $value ? $value : "";
    }

    public function getServiceOfferedAttribute($value){
        return  $value ? $value : "";
    }

    public function getMemberIdAttribute($value){
        return  $value ? $value : "";
    }

    public function getImageAttribute($value){
        return $value ? asset(Storage::url('../profile-images/'.$value)) : "";
    }

    
    public function getJobs()
    {
        return $this->hasMany('App\Job','user_id');
    }

     public function get_partner()
    {
        $where = array(
            'user_type'=>0
        );
        $getdata = User::where($where)->get();

        $response = array();
        if ($getdata)
        {   
            $response['isSuccess'] = true;
            $response['message'] = '';
            $response['data']= $getdata;
        }
        else{
            $response['isSuccess'] = false;
            $response['message']='No Records Found';
        }
        return $response;
    }


    public function get_client()
    {
        $where = array(
            'user_type'=>1
        );
        $getdata = User::where($where)->get();

        $responce = array();
        if ($getdata)
        {   
            $responce['isSuccess'] = true;
            $responce['message'] = '';
            $responce['data']= $getdata;
        }
        else{
            $responce['isSuccess'] = false;
            $responce['message']='No Records Found';
        }
        return $responce;
    }

    public function view_profile($id)
    {
        $where = array(
            'user_type'=>1,
            'id'=>$id
        );
        $getdata = User::where($where)->first();

        $responce = array();
        if ($getdata)
        {   
            $responce['isSuccess'] = true;
            $responce['message'] = '';
            $responce['data']= $getdata;
        }
        else{
            $responce['isSuccess'] = false;
            $responce['message']='No Records Found';
        }
        return $responce;
    }

    public function view_partner_profile($id)
    {
        $where = array(
            'user_type'=>0,
            'id'=>$id
        );
        $getdata = User::where($where)->first();

        $responce = array();
        if ($getdata)
        {   
            $responce['isSuccess'] = true;
            $responce['message'] = '';
            $responce['data']= $getdata;
        }
        else{
            $responce['isSuccess'] = false;
            $responce['message']='No Records Found';
        }
        return $responce;
    }

    public function bankDetail(){
       return $this->hasOne('App\BankDetail');
    }

     public function CheckBankDetail()
    {
        return $this->hasOne('App\BankDetail','user_id','id');
    }

    public function addBank(){
        $bank = BankDetail::create(['user_id'=>$this->id,'name'=>$this->name]);
        return $bank;
    }

    public function updateBank($payload){
        $bankDetails = $this->bankDetail;
        if(!$bankDetails){
            $bankDetails = new BankDetail;
            $bankDetails->user_id = $this->id;
        }
        $bankDetails->bank_name = $payload['bank_name'];
        $bankDetails->name = $payload['name'];
        $bankDetails->ifsc = $payload['ifsc'];
        $bankDetails->acc_num = $payload['acc_num'];
        $bankDetails->save();
        return $bankDetails;

    }




}
