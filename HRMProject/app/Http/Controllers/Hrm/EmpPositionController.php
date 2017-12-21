<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Manager\EmpPositionManager;



/**
 * Danh sách nhân viên
 */
class EmpPositionController extends Controller
{
	private $emp_pos_manager;

	public function __construct()
	{
		$this->emp_pos_manager = new EmpPositionManager();
	}

	/*
	 *
	 */
	public function getDetail($id)
	{
		$position = $this->emp_pos_manager->detail($id);
		$emp = $position->emp_profile;
		return response()->json(["position" => $position, "id_emp" =>convertIdEmp($emp->id)]);
		// return response()->json($position);
	}

	public function getAdd($id_emp)
	{
		$position = $this->emp_pos_manager->current($id_emp);
		$emp = $position->emp_profile;
		return response()->json(['id_emp'=>convertIdEmp($emp->id), 'name_emp'=>$emp->name, 'position'=>$position]);
	}

	public function postAdd(Request $request){
		$old = $this->emp_pos_manager->edit($request, $request->id);
		$new = $this->emp_pos_manager->add($request);
		$old_pos = $old->position;
		$old_dep = $old->department;
		$new_pos = $new->position;
		$new_dep = $new->department;
		return response()->json(['old'=>$old, 'new'=>$new]);
	}

	public function putEdit(Request $request, $id)
	{
		$position = $this->emp_pos_manager->edit($request, $id);
		$pos = $position->position;
		$dep = $position->department;
		return response()->json($position);
	}

	public function getDelete($id)
	{
		$position = $this->emp_pos_manager->delete($id);
		return response()->json($position);
	}
}
