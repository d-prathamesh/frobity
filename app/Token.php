<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
	protected $table = 'tokens';

	protected $fillable = [ 'access_token', 'user_id', 'refresh_token', 'expires_in' ];

	public function user () {
		return $this->belongsTo('App\User', 'user_id', 'id');
	}
}