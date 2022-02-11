<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use Session;
use App\Admin;
use App\Http\Controllers\Controller;
use DB;
use App\Cms;

class AdminController extends Controller
{
	public $admin;
   	
	public function __construct()
    {
    	$this->admin = new Admin();
    }

    public function login_form()
    {
    	return view('admin/login');
    }

    public function login(Request $Request)
    {
        //return $Request->all();
    	$validator= Validator::make($Request->all(),[
    		'email'=>'required',
    		'password'=>'required'
    	],[
    		'email.required'=>'Email Id is required',
    		'password.required'=>'Password Is required'
    	]);

    	if ($validator->fails())
    	{  
    		return redirect()->back()->withErrors($validator)->withInput();
    	}
    
    	$admin_data =  $this->admin->login($Request->email,$Request->password);
    	if($admin_data['isSuccess'])
    	{
    		session::put('admin_data',$admin_data['data']);	
    	}
    	
    	return redirect()->back()->with($admin_data);
    }

    public function logout()
    {
    	Session::flush();
     	return redirect()->route('login_form');
    }
	
	public function cmsstore(Request $request)
    {
		$title = $request->input('title');
		$keyword = $request->input('keyword');
        $metadescrption = $request->input('metadescrption');
        $slug = $request->input('slug');
		$content = $request->input('wysiwyg-editor');

         if($keyword !='' && $metadescrption !='' && $slug != '' && $title != ''){
            $data = array('keyword'=>$keyword,"metadescrption"=>$metadescrption,"slug"=>$slug,"content"=>$content,'title'=>$title);
 
            // Insert
            Cms::insertData($data);
            Session::flash('message','Insert successfully.');
         }	
		return redirect()->action('Admin\AdminController@list_all_cms',['id'=>0]);
	}
	
	public function list_all_cms($id=0){
    // Fetch all records
    $userData['data'] = Cms::getuserData();
	$userData['edit'] = $id;

    // Fetch edit record
    if($id>0){
      $userData['editData'] = Cms::getuserData($id);
    }
    // Pass to view
    return view('admin.cms')->with("userData",$userData);
   }
  
  
   public function cmsupdate(Request $request){
	
      // Update record
      if($request->input('editid') !=null ){
		$title = $request->input('new_title');  
        $keyword = $request->input('new_keyword');
        $metadescrption = $request->input('new_metadescrption');
		$slug = $request->input('new_slug');
		$content =  $request->input('new_content');
        $editid = $request->input('editid');
	
       if($keyword !='' && $metadescrption != '' && $slug != '' && $title != ''){
           $data = array('keyword'=>$keyword,"metadescrption"=>$metadescrption,"slug"=>$slug,"content"=>$content,'title'=>$title);
	       // Update
			Cms::updateData($editid, $data);
			Session::flash('message','Update successfully.');
 
        }
      }
    return redirect()->action('Admin\AdminController@list_all_cms',['id'=>0]);
   }

  public function deleteUser($id){
    if($id != 0){
      // Delete
			Cms::deleteData($id);
			Session::flash('message','Delete successfully.');
    }
    return redirect()->action('Admin\AdminController@list_all_cms',['id'=>0]);
  }
	
}
