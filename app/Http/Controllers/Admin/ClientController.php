<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use validator;
use Session;
use App\User;
use App\Job;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
	public $client;
    public $jobs;
   	
	public function __construct()
    {
    	$this->client = new User();
        $this->jobs = new Job();
    }

    public function getrecord()
    {
    	$getrecord =  $this->client->get_client();
    	return view('admin.client.index')->with($getrecord);
    }

    public function view_profile($id)
    {
        $getrecord = $this->client->view_profile($id);
        $countjobs = $this->jobs->countjobs($id);
        $ongoing_jobs = $this->jobs->count_ongoing_jobs($id);
        $completed_jobs = $this->jobs->count_completed_jobs($id);
        $client_jobs = $this->jobs->get_jobs($id);
        $with = array(
            'total_jobs'=>$countjobs,
            'ongoing_jobs'=>$ongoing_jobs,
            'completed_jobs'=>$completed_jobs,
            'client_jobs'=>$client_jobs
        );
        return view('admin/client/profile')->with($getrecord)->with($with);
    }

    public function get_jobs($id)
    {
        $getrecord = $this->jobs->get_jobs($id);
        return view('admin/client/jobs')->with('data',$getrecord);
    }
}
