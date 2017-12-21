<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Manager\RelativesManager;
use App\Model\EmpRelative;
use App\Model\EmpProfile;

class RelativesController extends Controller
{
	private $relatives_manager;

	public function __construct()
	{
		$this->relatives_manager = new RelativesManager();
	}

	public function getDetail($id)
	{
		$relatives = $this->relatives_manager->detail($id);
		// return response()->json($relatives);
		// $relatives = EmpRelative::find($id);
		return response()->json(['relatives'=>$relatives, 'id_emp'=>convertIdEmp($relatives->emp_profile->id)]);

	}

	public function getAdd($id_emp)
	{
		$emp = EmpProfile::find($id_emp);
		return response()->json(['id_emp'=>convertIdEmp($emp->id), 'name_emp'=>$emp->name]);
	}

	
	public function postAdd(Request $request)
	{
		$relatives = $this->relatives_manager->add($request);
		return response()->json($relatives);
		// return redirect('hrm/emp/detail/'.invertIdEmp($request->id_emp))->with('notify', $message);
	}

	public function putEdit(Request $request, $id)
	{
		$relatives = $this->relatives_manager->edit($request, $id);
		// return redirect('hrm/emp/detail/'.invertIdEmp($request->id_emp))->with('notify', $message);
		return response()->json($relatives);
	}


	public function getDelete($id)
	{
		$relatives = $this->relatives_manager->delete($id);
		return response()->json($relatives);
	}
    
}
