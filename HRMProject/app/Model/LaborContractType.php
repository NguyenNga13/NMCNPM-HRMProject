<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LaborContractType extends Model
{
    public function emp_contract()
    {
    	return $this->hasOne('App\Model\EmpLaborContract', 'id_contract_type', 'id');
    }
}
