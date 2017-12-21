<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmpLaborContract extends Model
{
    public function emp_profile()
    {
    	return $this->belongsTo('App\Model\EmpProfile', 'id_emp', 'id');
    }

    public function contract_type()
    {
    	return $this->belongsTo('App\Model\LaborContractType', 'id_contract_type', 'id');
    }
}
