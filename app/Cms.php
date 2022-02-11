<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
     protected $table = 'cms';

	   protected $fillable = [
         'keyword','metadescrption','slug','title','content'
    ];
	
	public static function getuserData($id=0){
	 	if($id==0){
      $value=DB::table('cms')->orderBy('id', 'asc')->get(); 
    }else{
      $value=DB::table('cms')->where('id', $id)->first();
    }
    return $value;
  }

   public static function insertData($data){
	  DB::table('cms')->insert($data);
  }

  public static function updateData($editid,$data){
	  DB::table('cms')
      ->where('id', $editid)
      ->update($data);
  }

  public static function deleteData($id){
      DB::table('cms')->where('id', '=', $id)->delete();
  }
}
