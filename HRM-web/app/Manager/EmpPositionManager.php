<?php
namespace App\Manager;

use App\Model\EmpProfile;
use App\Model\Department;
use App\Model\EmpPosition;
use App\Model\Position;

/**
 * Class quản lý chức vụ nhân viên
 */
class EmpPositionManager
{
	
	function __construct()
	{
		# code...
	}


	public function detail($id)
	{



		// $list = EmpProfile::leftJoin('emp_positions', function($join){
		// 	$join->on('emp_profiles.id', '=', 'emp_positions.id_emp')
		// 		->where('emp_positions.date_finish', '=', null)
		// 		->where('emp_positions.status', '=', 1);
		// })
		// ->leftJoin('positions', 'emp_positions.id_position', '=', 'positions.id')
		// ->leftJoin('departments', 'emp_positions.id_department', '=', 'departments.id')
		// ->select('emp_profiles.*', 'positions.position', 'departments.department')
		// ->get();

		// return $list;



		$position = EmpPosition::find($id);
		return $position;
	}

	public function current($id_emp)
	{
		$position = EmpPosition::where('id_emp', $id_emp)->where('date_finish', Null)->where('status', 1)->first();
		return $position;
	}



	/**
	 * Thêm chức vụ mới
	 * if(chức vụ chính thức) -> kết thúc chức vụ chính thức trc đó
	 */
	public function add($request)
	{
		if(!empty($request)){
			$pos = new EmpPosition;
			$pos->id_emp = invertIdEmp($request->id_emp);
			$pos->id_position = $request->new_position;
			$pos->id_department = $request->new_department;
			$pos->decided_number = $request->new_decided_number;
			$pos->status = $request->new_status;
			$pos->date_begin = $request->new_date_begin;
			$pos->date_finish = $request->new_date_finish;
			$pos->note = $request->new_note; 
			$pos->save();
			return $pos;
		}
		// return "Tạo chức vụ mới thất bại";
	}

	public function edit($request, $id){
		if(!empty($request)){
			$position = EmpPosition::find($id);
			$position->id_position = $request->id_position;
			$position->id_department = $request->id_department;
			$position->decided_number = $request->decided_number;
			$position->status = $request->status;
			$position->date_begin = $request->date_begin;
			$position->date_finish = $request->date_finish;
			$position->note = $request->note;
			$position->save();
			return $position;
		}
		
	}

	public function delete($id)
	{
		$position = EmpPosition::destroy($id);
		return $position;

	}


}

