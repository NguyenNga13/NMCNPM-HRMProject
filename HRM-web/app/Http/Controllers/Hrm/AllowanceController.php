<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Manager\AllowanceManager;


class AllowanceController extends Controller
{
	private $allowance_manager;

	function __construct()
	{
		$this->allowance_manager = new AllowanceManager();
	}
    

    public function getListAllowance()
    {
    	$allowance = $this->allowance_manager->getListAllowance();

    	// return response()->json($allowance); 
    	return view('hrm.salary.allowance.allowance', ['allowance'=>$allowance]);
    }

    public function getJsonListAllowance()
    {
        $allowance = $this->allowance_manager->getListAllowance();
        return response()->json($allowance);
    }


    public function getNewAllowanceCode($name)
    {
    	$code = $this->allowance_manager->createAllowanceCode($name);
    	return response()->json($code);
    }

    public function postAddAllowance(Request $request)
    {
    	$allowance = $this->allowance_manager->addAllowance($request);
    	return response()->json($allowance);

    }

    public function putUpdateAllowance($id, Request $request)
    {
    	$allowance = $this->allowance_manager->updateAllowance($id, $request);
    	return response()->json($allowance);

    }

    public function putEditAllowance($id, Request $request)
    {
    	$allowance = $this->allowance_manager->editAllowance($id, $request);
    	return response()->json($allowance);

    }

    public function postAddAllowanceLevel(Request $request)
    {
    	$level = $this->allowance_manager->addAllowanceLevel($request);
    	return response()->json($level);
    }

    /**
     * get list level of allowance
     */
    public function getLevelOfAllowance($id)
    {
    	$level = $this->allowance_manager->getLevelOfAllowance($id);
    	return response()->json($level);
    }

    /**
     * get level of allowance by code
     */
    public function getLevelOfAllowanceByCode($code)
    {
        $level = $this->allowance_manager->getLevelOfAllowanceByCode($code);
        return response()->json($level);
    }

    /**
     * get allowance 
     */
    public function getAllowance($id)
    {
    	$allowance = $this->allowance_manager->getAllowance($id);
    	return response()->json($allowance);
    }

    /**
     * delete allowance
     */
    public function getDelete($id)
    {
    	$allowance = $this->allowance_manager->deleteAllowance($id);
    	return response()->json($allowance);
    }
}
