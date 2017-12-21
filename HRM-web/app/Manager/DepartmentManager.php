<?php
namespace App\Manager;

use App\Model\Department;
use App\Model\EmpPosition;
use Illuminate\Support\Facades\DB;


/**
* Class quản lý phòng ban
*/
class DepartmentManager
{
	
	function __construct()
	{
	}

	/**
	 * Lấy danh sách phòng ban và nhân viên
	 */
	public function getList()
	{
		$dep = Department::LeftJoin('emp_positions',function($join){
			$join->on('departments.id', '=', 'emp_positions.id_department')
			->where('emp_positions.id_position', '=', 4)
			->where('emp_positions.date_finish', '=', null);	
		})
		->leftJoin('emp_profiles', 'emp_positions.id_emp', '=', 'emp_profiles.id')
		->select('departments.*','emp_profiles.name', 'emp_positions.id_position' )
		->get();
		return $dep;

	}


	/**
	 * get list of dep_code and name
	 * @return [type] [description]
	 */
	public function getListDep()
	{
		$dep = Department::select('id', 'department')->get();
		return $dep;
	}

	/**
	 * get dep by name
	 */
	public function getDepByName($dep)
	{
		$dep = Department::where('department', $dep)->first();
		return $dep;
	}



	/**
	 * Lấy thông tin phòng ban
	 */
	public function getDetail($id)
	{
		$dep = Department::find($id);
		return $dep;
	}

	/**
	 * Lấy danh sách nhân viên hiện tại
	 */
	public function getEmpList($id)
	{
		$emp_list = EmpPosition::where('id_department', $id)->where('date_finish', null)->get();
		return $emp_list;
	}

	

	/**
	 * Tạo phòng ban
	 */
	public function add($request)
	{
		if(!empty($request)){
			$dep = new Department;
			$dep->department = $request->department;
			$dep->date_established = $request->date_established;
			$dep->decided_established = $request->decided_established;
			$dep->telephone = $request->telephone;
			$dep->fax = $request->fax;
			$dep->email = $request->email;
			$dep->location = $request->location;
			$dep->description = $request->description;
			$dep->save();

			$last = Department::all()->last();
			$id = $last->id;
			return $id;
		}
		return 0;
	}


	/**
	 * Sửa phòng ban
	 */
	public function edit($request)
	{
		$dep = Department::findOrFail($request->id);
		$dep->department = $request->department;
		$dep->date_established = $request->date_established;
		$dep->decided_established = $request->decided_established;
		$dep->telephone = $request->telephone;
		$dep->fax = $request->fax;
		$dep->email = $request->email;
		$dep->location = $request->location;
		$dep->description = $request->description;
		$dep->save();
	}

	/**
	 * Xóa phòng ban
	 */
	public function delete($id)
	{
		Department::findOrFail($id)->delete();
	}

}
?>