 <?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', "Frontend\HomeController@homeAction")->name('web.home');
//Route::get('/pages/{slugName?}', 'Frontend\HomeController@homeAction')->name('category');

Route::get('/auth/{type}/otp', "Frontend\AuthController@getOtp")->name('web.otp');
Route::get('/auth/{type}/email-otp', "Frontend\AuthController@getEmailOtp")->name('web.email.otp');

Route::post('/auth/{type}/send-otp', "Frontend\AuthController@postSendOtp")->name('web.send-otp');
Route::post('/auth/{type}/send-email-otp', "Frontend\AuthController@postEmailSendOtp")->name('web.send-email-otp');

Route::get('/auth/{type}/getLoginWithEmail', "Frontend\AuthController@getLoginWithEmail")->name('web.getLoginWithEmail');
Route::post('/auth/{type}/postLoginWithEmail', "Frontend\AuthController@postLoginWithEmail")->name('web.postLoginWithEmail');


Route::get('/auth/{type}/verify-otp', "Frontend\AuthController@getVerifyOtp")->name('web.get-verify-otp');
Route::post('/auth/{type}/verify-otp', "Frontend\AuthController@postVerifyOtp")->name('web.post-verify-otp');
Route::get('/auth/{type}/register', "Frontend\AuthController@getRegister")->name('web.get.register');
Route::post('/auth/{type}/register', "Frontend\AuthController@postRegister")->name('web.post.register');
Route::get('/auth/{type}/google-signin', "Frontend\AuthController@getRegister")->name('web.get.google.register');
Route::get('/logout/{type}', "Frontend\AuthController@logoutAction")->name('web.logout');

Route::get('/logout/{type}', "Frontend\AuthController@logoutAction")->name('web.logout');

//Route::get('/privacy-policy', "Frontend\HomeController@privacy_policy")->name('web.privacy_policy');
//Route::get('/refund-policy', "Frontend\HomeController@refund_policy")->name('web.privacy_policy');
//Route::get('/terms-of-services', "Frontend\HomeController@terms_of_services")->name('web.privacy_policy');

Route::get('/cms_desc', "Frontend\HomeController@cms_key_desc");
Route::get('intellectual-property-law/{intellectual-property-law}', "Frontend\HomeController@page")->name('web.page');
Route::get('freelance-tax-and-accountants-work/{freelance-tax-and-accountants-work}', "Frontend\HomeController@page")->name('web.page');
Route::get('hire-freelance-web-designer/{hire-freelance-web-designer}', "Frontend\HomeController@page")->name('web.page');
Route::get('freelance-wordpress-web-developer/{freelance-wordpress-web-developer}', "Frontend\HomeController@page")->name('web.page');
Route::get('freelance-platform-for-web-developers/{freelance-platform-for-web-developers}', "Frontend\HomeController@page")->name('web.page');
Route::get('freelance-chartered-accountant/{freelance-chartered-accountant}', "Frontend\HomeController@page")->name('web.page');
Route::get('privacy-policy/{privacy-policy}', "Frontend\HomeController@page")->name('web.page');
Route::get('refund-policy/{refund-policy}', "Frontend\HomeController@page")->name('web.page');
Route::get('terms-of-services/{terms-of-services}', "Frontend\HomeController@page")->name('web.page');


Route::get('/contact', 'Frontend\HomeController@contact')->name('contact');
Route::post('/contact', 'Frontend\HomeController@contactPost')->name('contactPost');
Route::get('/thank_you_page', 'Frontend\HomeController@thank_you_page')->name('thank_you_page');
Route::get('/sitemap', "Frontend\HomeController@sitemap");
Route::get('/top-freelancer-by-city/{city}', "Frontend\HomeController@top_freelancer_by_city");
Route::get('/profile/{id}','Frontend\HomeController@view_profile')->name('top_freelancer_by_city_view_profile');



Route::group(['prefix' => 'partner',  'middleware' => 'partnerauth'],function () {
    Route::get('/dashboard','Frontend\Partner\DashboardController@getIndex')->name('web.partner.dashboard');
    Route::get('/notifcations','Frontend\Partner\PartnerController@getNotifications')->name('web.getpartner.notifications');
    Route::post('/notifcations','Frontend\Partner\PartnerController@postGetNotifications')->name('web.partner.notifications');
	Route::get('/messages','Frontend\Partner\PartnerController@getMessages')->name('web.getpartner.messages');
	Route::post('/messages','Frontend\Partner\PartnerController@postGetMessages')->name('web.partner.messages');
    Route::get('/find-jobs/detail/{leadId}','Frontend\Partner\JobController@getJobDetail')->name('web.partner.job.detail');
    Route::get('/find-jobs/{perpage?}/{term?}','Frontend\Partner\JobController@getIndex')->name('web.partner.jobs');
    Route::post('/jobs/{leadId}/send-proposal','Frontend\Partner\JobController@postSendProposal')->name('web.partner.job.send-proposal');
    Route::get('/sent-proposals','Frontend\Partner\JobController@getSentProposals')->name('web.partner.job.sent-proposal');
    Route::get('/ongoing-jobs','Frontend\Partner\JobController@getOngoing')->name('web.partner.ongoing.jobs');
    Route::get('/completed-jobs','Frontend\Partner\JobController@getCompleted')->name('web.partner.completed.jobs');
    Route::get('/refunded-jobs','Frontend\Partner\JobController@getRefunded')->name('web.partner.refunded.jobs');
    Route::get('/ongoing-jobs/{leadProId}','Frontend\Partner\JobController@getOngoingDetail')->name('web.partner.ongoing.jobs.detail');
    Route::post('/ongoing-jobs/{leadProId}','Frontend\Partner\JobController@postOngoingRefund')->name('web.partner.ongoing.jobs.refund');
	
    Route::post('/ongoing-jobs/{leadProId}/submit-work','Frontend\Partner\JobController@postSubmitwork')->name('web.partner.ongoing.jobs.work-submit');
    Route::get('/setting/notification','Frontend\Partner\SettingController@getNotificationSetting')->name('web.partner.setting.notification');
    Route::post('/setting/save-notification','Frontend\Partner\SettingController@postNotificationSetting')->name('web.partner.setting.save-notification');
    Route::get('/setting/profile','Frontend\Partner\SettingController@getProfile')->name('web.partner.setting.profile');
    Route::post('/setting/save-profile','Frontend\Partner\SettingController@postProfile')->name('web.partner.setting.save-profile');
    Route::get('/setting/bank','Frontend\Partner\SettingController@getBank')->name('web.partner.setting.bank');
    Route::post('/setting/save-bank','Frontend\Partner\SettingController@postBank')->name('web.partner.setting.save-bank');
    Route::get('/setting/change-password','Frontend\Partner\SettingController@getChangePassword')->name('web.partner.setting.password');
    Route::get('/setting/aboutme','Frontend\Partner\SettingController@getAboutme')->name('web.partner.setting.aboutme');
    Route::post('/setting/save-aboutme','Frontend\Partner\SettingController@postAboutme')->name('web.partner.setting.save-aboutme');
    Route::get('/setting/identity','Frontend\Partner\SettingController@getIdentity')->name('web.partner.setting.identity');
    Route::post('/setting/save-identity','Frontend\Partner\SettingController@postIdentity')->name('web.partner.setting.save-identity');
    Route::post('/setting/save-profile-picture','Frontend\Partner\SettingController@postProfilePicture')->name('web.partner.setting.save-profile-picture');
	Route::get('/download/{id}','Frontend\Partner\JobController@download')->name('web.partner.download');

});

Route::group(['prefix' => 'client',  'middleware' => 'clientauth'],function () {
	Route::get('/setting/profile','Frontend\Client\SettingController@getProfile')->name('web.client.setting.profile');
	Route::post('/setting/save-profile','Frontend\Client\SettingController@postProfile')->name('web.client.setting.save-profile');
	Route::post('/setting/save-profile-picture','Frontend\Client\SettingController@postProfilePicture')->name('web.client.setting.save-profile-picture');
	Route::get('/notifcations','Frontend\Client\ClientController@getNotifications')->name('web.getclient.notifications');
    Route::post('/notifcations','Frontend\Client\ClientController@postGetNotifications')->name('web.client.notifications');
    Route::get('/messages','Frontend\Client\ClientController@getMessages')->name('web.getclient.messages');
	Route::post('/messages','Frontend\Client\ClientController@postGetMessages')->name('web.client.messages');
	Route::get('/dashboard','Frontend\Client\DashboardController@getIndex')->name('web.client.dashboard');
    Route::get('/jobs/post/step-first','Frontend\Client\JobController@getJobPostOne')->name('web.client.get.new.job.step1');
    Route::get('/jobs/post/step-second/{catId}/{subId?}','Frontend\Client\JobController@getJobPostTwo')->name('web.client.get.new.job.step2');
    Route::post('/jobs/post-a-lead','Frontend\Client\JobController@postLead')->name('web.client.post.new.lead');
    Route::post('/jobs/post-a-job','Frontend\Client\JobController@postJob')->name('web.client.post.new.job');
    Route::get('/jobs/cancel/{id}','Frontend\Client\JobController@cancelJob')->name('web.client.cancel.job');
    Route::get('/jobs/posted','Frontend\Client\JobController@getJobList')->name('web.client.posted.jobs');
    Route::get('/jobs/proposals','Frontend\Client\JobController@getProposals')->name('web.client.posted.jobs.proposals');
    Route::get('/jobs/{id}/proposal/{proposalId}','Frontend\Client\JobController@getProposalDetail')->name('web.client.posted.jobs.proposal-detail');

    Route::get('/jobs/{id}/proposals','Frontend\Client\JobController@getProposalsByLead')->name('web.client.jobs.proposals');

    Route::get('/ongoing-jobs','Frontend\Client\JobController@getOngoing')->name('web.client.ongoing.jobs');
    Route::get('/completed-jobs','Frontend\Client\JobController@getCompleted')->name('web.client.completed.jobs');
    Route::get('/refunded-jobs','Frontend\Client\JobController@getRefunded')->name('web.client.refunded.jobs');
	Route::get('/transactions','Frontend\Client\JobController@getTransactions')->name('web.client.transactions');
    Route::post('/jobs/{id}/proposal/{proposalId}','Frontend\Client\JobController@postProposalAccept')->name('web.client.posted.jobs.proposal');
    Route::get('/ongoing-jobs/{leadProId}','Frontend\Client\JobController@getOngoingDetail')->name('web.client.ongoing.jobs.detail');
    Route::post('/ongoing-jobs/{leadProId}/update-work','Frontend\Client\JobController@postUpdatework')->name('web.client.ongoing.jobs.update-work');
    Route::post('/jobs/{id}/proposal/{proposalId}/initiate-chat','Frontend\Client\JobController@postInitiateChat')->name('web.client.initiate-chat');
		
	Route::get('/jobs/{id}/proposal/{proposalId}/decline','Frontend\Client\JobController@postProposalDecline')->name('web.client.decline');
	Route::get('/download/{id}','Frontend\Client\JobController@download')->name('web.client.download');
});

//Route::get('/', function () {
 //   return view('welcome');
//});


Route::get('/logs','Api\CommonController@getLogs');

Route::group(['prefix'=>'admin'],function ()
{   
	Route::group(['middleware' => 'AdminLogin'], function () 
	{
		Route::get('/', function () {
		    return view('admin/dashboard');
		})->name('dashboard');
		
		
		/*Route::get('/cms_content', function () {
		    return view('admin/cms');
		})->name('cms');
		*/
		Route::get('/cms_content/{id?}', 'Admin\AdminController@list_all_cms')->name('cms');
		Route::post('/cms_add_content', 'Admin\AdminController@cmsstore')->name('cms_add');
		Route::post('/cms_update_content', 'Admin\AdminController@cmsupdate')->name('cms_update');
		Route::get('/cms_delete_content/{id}', 'Admin\AdminController@deleteUser')->name('cms_delete');;
		
		Route::group(['prefix'=>'jobs'],function ()
		{
			Route::get('/completed_jobs','Admin\JobsController@completed_jobs')->name('completed_jobs');
			Route::get('/refunded_jobs','Admin\JobsController@refunded_jobs')->name('refunded_jobs');
			Route::get('/inprogress_jobs','Admin\JobsController@inprogress_jobs')->name('inprogress_jobs');
			Route::get('/open_jobs','Admin\JobsController@open_jobs')->name('open_jobs');
			
			Route::post('/inprogress_jobs/{job_application_id}','Admin\JobsController@postOngoingRefund')->name('refund_payments_admin');
			
		});

		Route::group(['prefix'=>'jobapplication'],function ()
		{
			Route::get('/','Admin\JobApplicationController@transferpending')->name('transfer_pending_jobs');
			Route::post('/transferamount','Admin\JobApplicationController@transfer_amount')->name('transfer_amount');
			
		});

        Route::group(['prefix'=>'partner'],function ()
        {
            Route::get('/others/{member_id_status?}/{service_type?}','Admin\PartnerController@getOthers')->name('others');
            Route::get('/','Admin\PartnerController@getrecord')->name('get_partner');
            Route::get('/profile/{id}','Admin\PartnerController@view_profile')->name('partner_view_profile');
            Route::get('/edit_partner/{id}','Admin\PartnerController@edit_partner')->name('edit_partner');
            Route::post('/update_partner','Admin\PartnerController@update_partner')->name('update_partner');
            Route::get('/view_bank_detail/{id}','Admin\PartnerController@view_bank_detail')->name('view_bank_detail');
            Route::get('/get_filter_partner/{service_type}/{member_id_status?}','Admin\PartnerController@get_filter_partner')->name('get_filter_partner');

            Route::post('/verify_session','Admin\PartnerController@verify_session')->name('verify_session');
        });

        Route::group(['prefix'=>'client'],function ()
        {
            Route::get('/','Admin\ClientController@getrecord')->name('get_client');
            Route::get('/profile/{id}','Admin\ClientController@view_profile')->name('admin_client_view_profile');
            Route::get('/profile/edit/{id}','Admin\ClientController@edit_profile')->name('admin_client_edit_profile');
            Route::get('/jobs/{id}','Admin\ClientController@get_jobs')->name('client_jobs');
        });
		
		Route::get('/logout','Admin\AdminController@logout')->name('admin_logout');
	});

	Route::group(['middleware' => 'AdminAlreadyLogin'], function () 
	{ 
		Route::get('/login','Admin\AdminController@login_form')->name('login_form');
		Route::post('/login','Admin\AdminController@login')->name('admin_login');	
	});
});

Route::get('{page}', "Frontend\HomeController@page")->name('web.page');