<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    public function role()
    {
    	return $this->belongsTo('App\Model\Role', 'id_role', 'id');
    }

    public function permission()
    {
    	return $this->belongsTo('App\Model\Permission', 'id_permission', 'id');
    }
}
