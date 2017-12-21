<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permission()
    {
    	return $this->belongsToMany('App\Model\Permission', 'permission_roles', 'id_role', 'id_permission');
    }

    public function user()
    {
    	return $this->belongsToMany('App\User', 'role_users', 'id_role', 'id_user');
    }

    public function role_user()
    {
    	return $this->hasMany('App\Model\RoleUser', 'id_role', 'id');
    }

    public function permission_role()
    {
    	return $this->hasMany('App\Model\PermissionRole', 'id_role', 'id');
    }
}
