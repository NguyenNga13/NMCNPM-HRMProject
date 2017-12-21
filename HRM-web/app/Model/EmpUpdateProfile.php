<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmpUpdateProfile extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User', 'confirmed_by', 'id');
    }

    public function notify()
    {
    	return $this->hasMany('App\Model\Notify', 'id_update', 'id');
    }
}
