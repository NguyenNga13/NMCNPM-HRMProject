<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmpPosition extends Model
{
    public function emp_profile()
    {
    	return $this->belongsTo('App\Model\EmpProfile', 'id_emp', 'id');
    }

    public function position()
    {
    	return $this->belongsTo('App\Model\Position', 'id_position', 'id');
    }

    public function department()
    {
    	return $this->belongsTo('App\Model\Department', 'id_department', 'id');
    }
}
