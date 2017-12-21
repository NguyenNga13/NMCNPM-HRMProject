<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function emp_profile()
    {
    	return $this->belongsToMany('App\Model\EmpProfile', 'emp_positions', 'id_position', 'id_emp');
    }

    public function emp_position()
    {
    	return $this->hasMany('App\Model\EmpPosition', 'id_position', 'id');
    }
}
