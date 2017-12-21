<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Manager\NotifyManager;
use App\Manager\EmpUpdateProfileManager;

class NotifyController extends Controller
{
    private $notify_manager;
    private $emp_update_manager;

    function __construct()
    {
    	$this->notify_manager = new NotifyManager();
    	$this->emp_update_manager = new EmpUpdateProfileManager();
    }

    public function getNotify($id)
    {
    	$notify = $this->notify_manager->get($id);
    	$type = $notify->type;

    	if($type == NotifyManager::NOTIFY_UPDATE_PROFILE){
    		// $update = $this->emp_update_manager->get($notify->id_update);
    		return redirect('hrm/emp/update/'.$notify->id);
    	}


    }
}
