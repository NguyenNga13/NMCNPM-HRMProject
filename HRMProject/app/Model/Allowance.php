<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    public function allowance_level()
    {
    	return $this->hasMany('App\Model\AllowanceLevel', 'id_allowance', 'id');
    }
}
