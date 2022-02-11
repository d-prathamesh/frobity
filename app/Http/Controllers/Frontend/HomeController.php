<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use DB;
use App\Cms;
use App\User;
use App\JobApplication;
use App\Job;
use App\BankDetail;
use App\Mail\ContactNotification;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller {
	
	
   public function homeAction(){
	    $navclass = 'home';
        $categories = $this->getServiceTypes();
		$range = [200, 300, 400, 500, 600,700, 800, 900];
		return view('frontend.home',compact( 'categories', 'range', 'navclass' ) );
   }
   /* 	
   public function privacy_policy(){
		$cms_content_values = DB::table('cms')->where('slug','privacy_policy')->get();
        return view('frontend.privacy_policy')->with('cms_content_values',$cms_content_values);
   }
   public function terms_of_services(){
	    $cms_content_values = DB::table('cms')->where('slug','terms_of_services')->get();
        return view('frontend.terms_of_services')->with('cms_content_values',$cms_content_values);
   }
   public function refund_policy(){
	    $cms_content_values = DB::table('cms')->where('slug','refund_policy')->get();
        return view('frontend.refund_policy')->with('cms_content_values',$cms_content_values);
   }
   */
   public function page($page){
	    $cms_content_values = DB::table('cms')->where('slug',$page)->get();
        return view('frontend.page')->with('cms_content_values',$cms_content_values)->with('slug',$page);
   }
   
    public function contact(){
	    return view('frontend.contact_us');
    }
	
	public function thank_you_page(){
        return view('frontend.thank_you_page');
    }

	
    public function contactPost(Request $request){
        $this->validate($request, [
                        'name' => 'required',
                        'email' => 'required|email',
                        'comment' => 'required',
						'g-recaptcha-response' => 'required'
			      ]);
				
		$job = array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'comment' => $request->get('comment') );
		Mail::to('milind.d@sukanyasoftwares.com')->send(new ContactNotification($job));
		
		return redirect()->route('thank_you_page');
		//return view('frontend.thank_you_page');
    }
	
	public function sitemap(){
		$sitemap_pages = DB::table('cms')->orderBy('created_at', 'desc')->get();
        return view('sitemap')->with('sitemap_pages',$sitemap_pages);
    }
	
	public function top_freelancer_by_city($city){
		$getdata = DB::select(" select * from fin_users where find_in_set('$city',city) and user_type = 0 ");
		//$getdata = DB::select(" select E.id,E.name,E.city,D.image from fin_users E LEFT JOIN fin_user_photos D ON (E.id = D.user_id ) where find_in_set('$city',E.city) and user_type = 0 ");
		return view('frontend.freelancer_by_city')->with('data',$getdata)->with('city',$city);
    }
	
	public function view_profile($id)
    {
    	$where = array(
            'user_type'=>0,
            'id'=>$id
        );
        $getrecord = User::where($where)->first();

	   
		$countjobs = DB::select(" SELECT count(*) as countjobs FROM  fin_job_applications where fin_job_applications.user_id = '$id' and fin_job_applications.proposal_status = 1");
		
		$ongoing_jobs = DB::select(" SELECT count(*) as ongoing_jobs FROM fin_jobs INNER JOIN fin_job_applications ON fin_job_applications.job_id=fin_jobs.id and fin_job_applications.user_id = '$id' and (fin_jobs.status=1 or fin_jobs.status=2)");
		
		$completed_jobs = DB::select(" SELECT count(*) as completed_jobs FROM fin_jobs INNER JOIN fin_job_applications ON fin_job_applications.job_id=fin_jobs.id and fin_job_applications.user_id = '$id' and fin_jobs.status=3");
	   
		$client_jobs = DB::select(" SELECT E.job_title,E.service_required ,E.status,D.amount,D.expected_days,D.proposal_status,D.payment_status FROM fin_jobs E JOIN fin_job_applications D ON (E.id = D.job_id and D.user_id = '$id')");
	   
	   
	   $with = array(
            'total_jobs'=>$countjobs[0]->countjobs,
            'ongoing_jobs'=>$ongoing_jobs[0]->ongoing_jobs,
            'completed_jobs'=>$completed_jobs[0]->completed_jobs,
            'client_jobs'=>$client_jobs
        );
        return view('frontend.partner.profile')->with('data',$getrecord)->with($with);
    }
	
}
