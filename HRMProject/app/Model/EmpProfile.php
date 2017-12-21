<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmpProfile extends Model
{
    public function user()
    {
    	return $this->hasOne('App\User', 'id_emp', 'id');
    }

    public function department()
    {
    	return $this->belongsToMany('App\Model\Department', 'emp_positions', 'id_emp', 'id_department');
    }

    public function position()
    {
    	return $this->belongsToMany('App\Model\Position', 'emp_positions', 'id_emp', 'id_position');
    }

    public function emp_position()
    {
    	return $this->hasMany('App\Model\EmpPosition', 'id_emp', 'id');
    }

    public function emp_labor_contract()
    {
    	return $this->hasMany('App\Model\EmpLaborContract', 'id_emp', 'id');
    }

    public function emp_language()
    {
    	return $this->hasMany('App\Model\EmpLanguage', 'id_emp', 'id');
    }

    public function emp_relative()
    {
    	return $this->hasMany('App\Model\EmpRelative', 'id_emp', 'id');
    }

    public function emp_specialized()
    {
    	return $this->hasMany('App\Model\EmpSpecialized', 'id_emp', 'id');
    }
}
