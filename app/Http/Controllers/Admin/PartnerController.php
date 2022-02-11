<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use validator;
use Session;
use App\User;
use App\JobApplication;
use App\Admin;
use App\BankDetail;
use App\Http\Controllers\Controller;
use Razorpay\Api\Api as RazorApi;
use GuzzleHttp\Client as GuzzleHttpClient;

class PartnerController extends Controller
{
	public $partner;
   	public $jobs;
    public $job;
    public $bank_details_model;

	public function __construct()
    {
    	$this->partner = new User();
        $this->jobs = new JobApplication();
        $this->job = new \App\Job();
        $this->BankDetail = new BankDetail();
    }

    public function getrecord()
    {
    	$where = array(
            'user_type'=>0
        );
        $getdata = User::withcount('CheckBankDetail')->where($where)->get();
        return view('admin.partner.partner')->with('data',$getdata);
    }

    public function get_filter_partner($service_type, $member_id_status = null )
    {
        if( $member_id_status ==  null ){
            $where = array(
                'user_type'=>0,
                'service_type'=>$service_type
            );
        }else{
            $where = array(
                'user_type'=>0,
                'service_type'=>$service_type,
                'member_id_status'=>$member_id_status
            );

        }
        $getdata = User::withcount('CheckBankDetail')->where($where)->get();
        return view('admin.partner.partner')->with('data',$getdata)->with('service_type',$service_type);
//        return view('admin.partner.partner', ['service_type' => $service_type, 'data' => $getdata ] );

    }

    public function view_profile($id)
    {
        $getrecord = $this->partner->view_partner_profile($id);
        $countjobs = $this->job->countjobs($id);
        $ongoing_jobs = $this->job->count_ongoing_jobs($id);
        $completed_jobs = $this->job->count_completed_jobs($id);
        $client_jobs = $this->job->get_jobs($id);

        //return $getrecord;
        $with = array(
            'total_jobs'=>$countjobs,
            'ongoing_jobs'=>$ongoing_jobs,
            'completed_jobs'=>$completed_jobs,
            'client_jobs'=>$client_jobs
        );
        return view('admin.partner.profile')->with('data',$getrecord['data'])->with($with);
    }

    public function edit_partner($id)
    {
        $getrecord = $this->partner->view_partner_profile($id);
        return view('admin.partner.edit_profile')->with('data',$getrecord['data']);
    }

    public function update_partner(Request $Request)
    {
        $partner = User::find($Request->id);
        $partner->subscription_id= $Request->subscription_id;
        $partner->account_id= $Request->account_id;
        $partner->member_id_status= $Request->member_id_status;
        $partner->save();
        $responce = array();
        $responce['isSuccess'] = true;
        $responce['message'] = 'Partner Updated Successfully';
        return redirect()->back()->with($responce);
    }

    public function view_bank_detail($id)
    {
        $bank_details = $this->BankDetail->getBankDetail($id);

        return view('admin.partner.bank_detail')->with('data',$bank_details);
    }

    public function update_bank_detail(Request $Request)
    {
        $bank_details_model = BankDetail::find($Request->id);
        $bank_details_model->name= $Request->name;
        $bank_details_model->ifsc= $Request->ifsc;
        $bank_details_model->acc_num= $Request->acc_num;
        $bank_details_model->bank_name= $Request->bank_name;
        $bank_details_model->save();
        $responce = array();
        $responce['isSuccess'] = true;
        $responce['message'] = 'Partner User Bank Detail Updated Successfully';
        return redirect()->back()->with($responce);
    }

    public function verify_session(Request $Request)
    {
        try{
             $admin = $Request->session()->get('admin_data');
             $ID = $admin->id;
             $adminDetail = Admin::where('id',$ID)->first();
            if ($Request->b_pwd == $adminDetail->password)
            {
                Session::put('bank_detail', 'yes');
                return redirect()->back()->with('verify_session','yes');
            }
            else
            {
                $responce = array();
                $responce['isSuccess'] = false;
                $responce['message'] = 'Wrong Password';
                return redirect()->back()->with($responce);
            }
        }catch(\Exception $e){
            $responce = array();
            $responce['isSuccess'] = false;
            $responce['message'] = $e->getMessage();
            return redirect()->back()->with($responce);
           
      }
       
    }

    public function getOthers($member_id_status="",$service_type=""){
        $where = array(
            'user_type'=>0,
            'member_id_status'=>$member_id_status
        );
        if($service_type == ""){
                $getdata = User::withcount('CheckBankDetail')->where($where)
                ->where('service_type','>',5)
                ->get();
        }else{
                $getdata = User::withcount('CheckBankDetail')->where($where)
                ->where('service_type','=',$service_type)
                ->get();
        }
        
        $services = \App\Service::where('id','>',5)->get();
       return view('admin.partner.partner-other')->with('data',$getdata)->with('services',$services)->with('member_id_status',$member_id_status)->with('service_type',$service_type);
    }
}
