<?php
namespace App\Manager;

use App\Model\EmpRelative;


/**
* Class quản lý nhân viên
*/
class RelativesManager
{
	
	function __construct()
	{
	}

	public function detail($id)
	{
		$relatives = EmpRelative::find($id);
		return $relatives;
	}

	/**
	 * Thêm quan hệ gia đình
	 */
	public function add($request)
	{
		if(!empty($request)){
			$relatives = new EmpRelative;
			$relatives->id_emp = invertIdEmp($request->id_emp);
			$relatives->name = $request->name;
			$relatives->relationship = $request->relationship;
			$relatives->date_of_birth = $request->date_of_birth;
			$relatives->career = $request->career;
			$relatives->workplace = $request->workplace;
			$relatives->address = json_encode(['address'=>$request->address, 'district'=>$request->address_district, 'province'=>$request->address_province]);
			$relatives->phone = $request->phone;
			$relatives->save();
			return $relatives;
			// return "Thêm thành công quan hệ gia đình nhân viên ".$request->name_emp;
		}
			// return "Thêm quan hệ gia đình nhân viên ".$request->name_emp." thất bại!";

	}

	/**
	 * Sửa thông tin quan hệ gia đình
	 */
	public function edit($request, $id)
	{
		if(!empty($request)){
			// $relatives = EmpRelatives::find($request->id);
			$relatives = EmpRelative::find($id);
			$relatives->name = $request->name;
			$relatives->relationship = $request->relationship;
			$relatives->date_of_birth = $request->date_of_birth;
			$relatives->career = $request->career;
			$relatives->workplace = $request->workplace;
			$relatives->address = json_encode(['address'=>$request->address, 'district'=>$request->address_district, 'province'=>$request->address_province]);
			$relatives->phone = $request->phone;
			$relatives->save();
			// return "Sửa thành công quan hệ gia đình nhân viên ".$request->name_emp;
			return $relatives;
		}
		
		// return "Sửa quan hệ gia đình nhân viên ".$request->name_emp." thất bại!";
	}


	public function delete($id)
	{
		$relatives = EmpRelative::destroy($id);
		return $relatives;
	}

}