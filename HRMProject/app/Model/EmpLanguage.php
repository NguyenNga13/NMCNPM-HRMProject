<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmpLanguage extends Model
{
    public function emp_profile()
    {
    	return $this->belongsTo('App\Model\EmpProfile', 'id_emp', 'id');
    }
}
