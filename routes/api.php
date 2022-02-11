<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
 //   return $request->user();
//});


Route::post('/signup','Api\AuthController@postSignup');
Route::post('/send-otp','Api\AuthController@postSendOtp');
Route::post('/verify-otp','Api\AuthController@postVerifyOtp');
Route::post('/verify-login','Api\AuthController@postVerifyLogin');
Route::post('/social-register','Api\AuthController@postSocialLogin');
Route::post('/verify-identity','Api\AuthController@postIdentity');
Route::post('/social-identity','Api\AuthController@postSocialIdentity');
Route::post('/check-social-identity','Api\AuthController@postCheckSocialIdentity');
Route::post('/forgot-password','Api\AuthController@postForgotPassword');

Route::get('/categories','Api\CommonController@getCategories');
Route::get('/sub-categories/{id}','Api\CommonController@getSubcategories');
Route::get('/top-freelancers','Api\CommonController@getTopFreelancers');
Route::get('/search','Api\CommonController@getSearch');
Route::post('/webhook/notification','Api\CommonController@postNotificationWebhook');

//Route::post('/forget-password','Api\AuthController@postForgotPassword');

Route::middleware(['apiauth'])->group(function () {
    
    Route::get('/get-profile','Api\ProfileController@getProfile');
    Route::get('/check-subscription','Api\ProfileController@getCheckSubscription');
    Route::post('/create-subscription','Api\ProfileController@postCreateSubscription');
    Route::post('/verify-payment','Api\ProfileController@postVerifyPayment');
    
    Route::post('/update-about-me','Api\ProfileController@postUpdateAboutMe');
    Route::post('/update-about','Api\ProfileController@postUpdateAbout');
    Route::post('/update-profile','Api\ProfileController@postUpdateProfile');
    
    //Route::post('/update-profile','Api\ProfileController@postUpdateProfile');

    Route::get('/get-bank-details','Api\ProfileController@getBankDetails');
    Route::post('/update-bank-details','Api\ProfileController@postUpdateBankDetails');

    Route::post('/notification-setting','Api\ProfileController@postNotificationSetting');

    Route::post('/upload-id-proof','Api\ProfileController@postIdProof');
    Route::get('/upload-id-proof','Api\ProfileController@getIdProof');
    
    Route::post('/contact-us','Api\CommonController@postContactUs');

    Route::post('/update-profile-image','Api\ProfileController@postUpdateProfileImage');
    Route::post('/lead-refund/{leadId}/{applicationId}','Api\LeadController@postProcessRefund');
    
    
    //Route::post('/get-photos','Api\ProfileController@getPhotos');
    //Route::post('/add-photos','Api\ProfileController@postPhotos');
     
     Route::get('/leads/{perpage?}/{term?}','Api\LeadController@getAll');
     Route::get('/notifications/{updateread?}','Api\NotificationController@getNew');
	 Route::get('/messages/{updateread?}','Api\NotificationController@getNewMessages');
     Route::get('/lead/{id}','Api\LeadController@getLeadById');
     Route::get('/lead/sent/proposals','Api\LeadController@getSentProposals');
     Route::get('/lead/proposals/payment','Api\LeadController@getPaidProposals');
     Route::get('/lead/proposals/pendingPayment','Api\LeadController@getPendingPayment');

     Route::get('/lead-with-submission/{leadId}/{applicationId}','Api\LeadController@getLeadWithReview');
     Route::post('/lead/{id}/send-proposal','Api\LeadController@postSendProposal');
     Route::get('/on-going','Api\LeadController@getOngoing');
     Route::post('/update-device-token','Api\ProfileController@postDeviceToken');
     Route::post('/lead/{leadId}/work-submission/{applicationId}','Api\LeadController@postSubmitWork');
     Route::get('/completed','Api\LeadController@getCompleted');
     Route::get('/refunded','Api\LeadController@getRefunded');
     
     
     
     Route::prefix('client')->group(function () {
         Route::post('/post-lead','Api\Client\LeadController@postLead');
         Route::post('/post-job','Api\Client\LeadController@postJob');
         Route::get('/leads','Api\Client\LeadController@getAllClientLeads');
         Route::get('/lead/proposals','Api\Client\LeadController@getAllProposals');
         Route::get('/lead/getPaidProposals','Api\Client\LeadController@getPaidProposals');
         
         Route::get('/job/cancel/{jobId}','Api\Client\LeadController@cancelJob');

         Route::get('/lead/{leadId}/proposals','Api\Client\LeadController@getAllProposalsByLead');
         Route::get('/lead/{leadId}/proposal/{applicationId}','Api\Client\LeadController@getLeadApplication');
         Route::post('/lead/{leadId}/proposal/{applicationId}/accept','Api\Client\LeadController@postAcceptProposal');
         Route::get('/on-going','Api\Client\LeadController@getOngoing');
         Route::get('/completed','Api\Client\LeadController@getCompleted');
         Route::get('/refunded','Api\Client\LeadController@getRefunded');
		 Route::get('/transactions','Api\Client\LeadController@getTransactions');
         Route::post('/lead/{leadId}/update-submission/{applicationId}','Api\Client\LeadController@postUpdateSubmission');
         Route::post('initiate-chat/{leadId}/{applicationId}','Api\Client\LeadController@postInitiateChat');
		 
		 Route::post('decline/{id}/proposal/{proposalId}','Api\Client\LeadController@postDeclineProposal');
		 Route::post('cancel/{id}','Api\Client\LeadController@cancelProposal');
     });
     
     
});


/*
$route['check']                = 'api/users/check';

############################# Other modules ####################################
$route['pushTest']                     = 'api/other/pushTest';
############################# Signup  Module ###################################
$route['signUp']                       = 'api/signup/signUp';
$route['login']                        = 'api/signup/loginByPassword';
$route['socialLogin']                  = 'api/signup/socialLogin';
$route['socialRegister']               = 'api/signup/socialRegister';
$route['forgetPassword']               = 'api/signup/forgetPassword';
$route['addFile']                      = 'api/signup/addFile';


############################ Profile  Module ###################################
$route['editProfile']                  = 'api/profile/editProfile';
$route['getProfile']                   = 'api/profile/getProfile';
$route['changePassword']               = 'api/profile/changePassword';
$route['changeSetting']                = 'api/profile/changeSetting';
$route['logout']                       = 'api/profile/logout';
$route['addPhotos']                    = 'api/profile/addPhotos';
$route['getPhotos']                    = 'api/profile/getPhotos';
$route['aboutMe']                      = 'api/profile/aboutMe';
$route['aboutDetail']                  = 'api/profile/aboutDetail';
$route['confirmWork']                  = 'api/profile/confirmWork';
$route['updatePaymentStatus']          = 'api/profile/updatePaymentStatus';
$route['updateServicePaymentStatus']   = 'api/profile/updateServicePaymentStatus';


$route['addService']                   = 'api/profile/addService';
$route['leads']                        = 'api/profile/leads';
$route['ongoing']                      = 'api/profile/ongoing';
$route['addBank']                      = 'api/profile/addBank';
$route['getBank']                      = 'api/profile/getBank';

###################### Notificatiion  Module ###################################
$route['getNotifications']             = 'api/profile/getNotifications';
$route['removeNotification']           = 'api/profile/removeNotification';
$route['takeWork']                     = 'api/profile/takeWork';


###################### Web  Module ###################################
$route['resetPasswordChange']          = 'api/signup/resetPasswordChange';
$route['resetPassword/(:any)']         = 'api/signup/resetPassword/$1';



$route['signup']                       = 'provider/signup/signUp';
*/
