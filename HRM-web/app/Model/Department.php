<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function emp_profile()
    {
    	return $this->belongsToMany('App\Model\EmpProfile', 'emp_positions', 'id_department', 'id_emp');
    }

    public function emp_position()
    {
    	return $this->hasMany('App\Model\EmpPosition', 'id_department', 'id');
    }
}
