<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{

	public function user_send()
	{
		return $this->belongsTo('App\User', 'from', 'id');
	}

	public function emp_update_profile()
	{
		return $this->belongsTo('App\Model\EmpUpdateProfile', 'id_update', 'id');
	}
    
}
