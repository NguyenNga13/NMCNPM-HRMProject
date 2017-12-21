<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

	 public function indexPermit()
    {
        return view('admin.permit.permit');
        
    }
    /**
    *Role management
    *
    */
    public function indexRole()
    {
        return view('admin.role.role');
        
    }


    

     public function indexUser()
    {
        return view('admin.user.emp');
        
    }
}
