<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    public function role()
    {
    	return $this->belongsTo('App\Model\Role', 'id_role', 'id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'id_user', 'id');
    }
}
