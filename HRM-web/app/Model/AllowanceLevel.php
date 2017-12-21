<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AllowanceLevel extends Model
{
    public function allowance()
    {
    	return $this->belongsTo('App\Model\Allowance', 'id_allowance', 'id');
    }
}
