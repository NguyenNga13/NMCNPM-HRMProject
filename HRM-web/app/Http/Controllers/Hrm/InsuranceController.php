<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Manager\InsuranceManager;

class InsuranceController extends Controller
{
	private $insurance_manager;

	function __construct()
	{
		$this->insurance_manager = new InsuranceManager();
	}



	public function getList()
	{
		$insurance = $this->insurance_manager->getListInsurance();
		return view('hrm.insurance.insurance', ['insurance'=>$insurance]);
	}

	public function getDetail($id)
	{
		$insurance = $this->insurance_manager->getDetail($id);
		return response()->json($insurance);
	}


	public function postAdd(Request $request)
	{
		$insurance = $this->insurance_manager->addInsurance($request);
		if($insurance == '0')
			return response()->json(['response'=>0, 'data'=>'Bảo hiểm này đã tồn tại.']);
		return response()->json(['response'=>1, 'data'=>$insurance]);
	}

	public function putUpdate($id, Request $request)
	{
		$insurance = $this->insurance_manager->updateInsurance($id, $request);
		if($insurance == '0')
			return response()->json(['response'=>0, 'data'=>'Không tìm thấy']);
		return response()->json(['response'=>1, 'data'=>$insurance]);
	}

	public function getDelete($id)
	{
		$id_insurance = explode(',', $id);
		$insurance = [];
		for($i = 0; $i < count($id_insurance); $i++){
			$insurance[$i] = $this->insurance_manager->deleteInsurance((int)$id_insurance[$i]);
		}

		return response()->json($insurance);
	}
}
