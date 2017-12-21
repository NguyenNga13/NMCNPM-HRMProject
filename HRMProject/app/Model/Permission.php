<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function role()
    {
    	return $this->belongsToMany('App\Model\Role', 'permission_roles', 'id_permission', 'id_role' );
    }

    public function permission_role()
    {
    	return $this->hasMany('App\Model\PermissionRole', 'id_permission', 'id');
    }
}
