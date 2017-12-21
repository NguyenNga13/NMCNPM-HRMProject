<?php
namespace App\Manager;

use App\Model\EmpProfile;
use App\Model\Department;
use App\Model\EmpPosition;
use App\Model\EmpRelatives;

use App\Model\EmpSalary;
use App\Model\EmpInsurance;
use App\Model\EmpAllowance;

use App\Manager\AllowanceManager;




/**
* Class quản lý nhân viên
*/
class ProfileManager
{
	
	function __construct()
	{
	}

	/**
	 * Lấy danh sách  nhân viên
	 */
	public function getList()
	{
		$list = EmpProfile::leftJoin('emp_positions', function($join){
			$join->on('emp_profiles.id', '=', 'emp_positions.id_emp')
			->where('emp_positions.date_finish', '=', null)
			->where('emp_positions.status', '=', 1);
		})
		->leftJoin('positions', 'emp_positions.id_position', '=', 'positions.id')
		->leftJoin('departments', 'emp_positions.id_department', '=', 'departments.id')
		->select('emp_profiles.*', 'positions.position', 'departments.department')
		->get();
		return $list;
	}
	/**
	 * Lấy danh sách sơ lược thông tin nhân viên
	 */
	public function getEmpListByPosition()
	{
		$emp_list = EmpPosition::where('status', 1)->where('date_finish', Null)->orderBy('id', 'ASC')->get();
		return $emp_list;
	}

	/**
	 * Lấy chức vụ công tác hiện tại
	 */
	public function getEmpPositionCurrent($id){
		$emp_position = EmpPosition::where('id_emp', $id)->where('date_finish', Null)->where('status', 1)->first();
		return $emp_position;
	}

	public function getEmpPositionConcurrent($id){
		$emp_position = EmpPosition::where('id_emp', $id)->where('date_finish', Null)->where('status', 0)->first();
		return $emp_position;
	}

	/**
	 * Lấy danh sách chức vụ của nhân viên
	 */
	public function getPositionList($id)
	{
		$emp_position = EmpPosition::where('id_emp', $id)->get();
		return $emp_position;
	}

	/**
	 * Lấy danh sách nhân viên theo $id_department
	 */
	public function getEmpListByDepartmentId($id_department)
	{
		$emp_list = Department::find($id_department)->emp_profile;
		return $emp_list;
	}


	/**
	 * Lấy thông tin hồ sơ nhân viên
	 */
	public function getEmpProfile($id_emp)
	{
		$emp = EmpProfile::find($id_emp);
		return $emp;
	}
	public function getProfile($id)
	{
		$emp = EmpProfile::where('emp_profiles.id', '=', $id)
		->leftJoin('emp_positions', function($join){
			$join->on('emp_profiles.id', '=', 'emp_positions.id_emp')
			->where('emp_positions.date_finish', '=', null)
			->where('emp_positions.status', '=', 1);
		})
		->leftJoin('positions', 'emp_positions.id_position', '=', 'positions.id')
		->leftJoin('departments', 'emp_positions.id_department', '=', 'departments.id')
		->select('emp_profiles.*', 'positions.position', 'departments.department', 'emp_positions.id as id_position_current', 'emp_positions.date_begin', 'emp_positions.decided_number', 'emp_positions.note as note_position_current')
		->first();
		return $emp;
	}

	/**
	 * Thêm hồ sơ nhân viên
	 */

	public function addEmpProfile($request)
	{
		if(!empty($request)){
			$emp_profile = new EmpProfile;
			$emp_profile->emp_code = $request->id;
			$emp_profile->name = $request->last_name." ".$request->middle_name." ".$request->first_name ;
			$emp_profile->profile_number = $request->profile_number;
			$emp_profile->date_begin = $request->date_join;
			$emp_profile->gender = $request->gender;
			$emp_profile->date_of_birth = $request->date_of_birth;
			$emp_profile->place_of_birth = json_encode(['address'=>$request->place_of_birth, 'district'=>$request->place_of_birth_district, 'province'=>$request->place_of_birth_province]);
			// $emp_profile->place_of_birth = joinAddress($request->place_of_birth, $request->place_of_birth_district, $request->place_of_birth_province);
			$emp_profile->identity_card = $request->identity_card;
			$emp_profile->id_issued_by = $request->id_issued_by;
			$emp_profile->id_date_of_issued = $request->id_date_of_issued;
			$emp_profile->passport_number = $request->passport_number;
			$emp_profile->passport_issued_by = $request->passport_issued_by;
			$emp_profile->passport_date_of_issued = $request->passport_date_of_issued;
			$emp_profile->passport_expiration_date = $request->passport_expiration_date;
			$emp_profile->country = $request->country;
			$emp_profile->ethnic =$request->ethnic;
			$emp_profile->religion = $request->religion;
			$emp_profile->household_address = json_encode(['address'=>$request->household_address,'district'=> $request->household_address_district,'province'=> $request->household_address_province]);
			$emp_profile->address = json_encode(['address'=>$request->address,'district'=> $request->address_district, 'province'=>$request->address_province]);
			$emp_profile->phone = $request->phone;
			$emp_profile->email = $request->email;
			$emp_profile->marial_status = $request->marial_status;
			$emp_profile->date_of_adherent = $request->date_of_adherent;
			$emp_profile->adherent_number = $request->adherent_number;
			$emp_profile->adherent_position = $request->adherent_position;
			$emp_profile->adherent_active_place = $request->adherent_active_place;

			$emp_profile->note = $request->note;

			if($request->hasFile('cardimage'))
			{
				$file = $request->file('cardimage');

			// kiểm tra định dạng file
				$format = $file->getClientOriginalExtension();
				if($format != 'jpg' && $format != 'png' && $format !='jepg')
				{
					return redirect('hrm/emp/emp_add')->with('notify', 'Định dạng hình ảnh không được hỗ trợ. Các định dạng file được hỗ trợ png/jpg/jepg.');
				}

			// lưu tên file với mã nhân viên đc tạo
			// Lấy tên file
				$image = $file->getClientOriginalName();

				$file->move("image/employee/cardimage/", $image);
				$emp_profile->photo_card = $image;
			}else{
				$emp_profile->photo_card = "";
			}
			$emp_profile->save();

			// $emp = EmpProfile::all()->last();
			$id_emp = $emp_profile->id;

			// add position for emp
			if($request->position){
				$emp_position = new EmpPosition;
				$emp_position->id_emp = $id_emp;
				$emp_position->id_position = $request->position;
				$emp_position->id_department = $request->department;
				$emp_position->date_begin = $request->date_begin;
				$emp_position->decided_number = $request->decided_number;
				$emp_position->status = $request->status;
				$emp_position->note = $request->position_note;
				$emp_position->save();
			}

			// add insurance for emp
			if($request->bhxh){
				$insurance = new EmpInsurance;
				$insurance->id_emp = $id_emp;
				$insurance->insurance_code = $request->bhxh;
				$insurance->date_begin = $request->date_begin_insurance;
				$insurance->save();
			}

			if($request->pay_scale){
				$salary = new EmpSalary;
				$salary->id_emp = $id_emp;
				$salary->pay_scale_code = $request->pay_scale;
				$salary->pay_range = $request->pay_range;
				$salary->applied_begin = $request->date_join;
				$salary->save();
			}


			// add allowances for emp
			$allowance_manager = new AllowanceManager();
			$list_allowance = $allowance_manager->getListAllowance();
			foreach ($list_allowance as $key => $value) {
				$code = $value->allowance_code;
				$level = $code.'_level';
				if(isset($request->$code)){
					$allowance = new EmpAllowance;
					$allowance->id_emp = $id_emp;
					$allowance->allowance_code = $request->$code;
					$allowance->allowance_level = $request->$level;
					$allowance->applied_begin = $request->date_join;
					$allowance->save();
				}
			}
			
			return $id_emp;
		}
		return 0;

	}


	public function editEmpProfile($request)
	{
		if(!empty($request)){
			$emp_profile = EmpProfile::find(invertIdEmp($request->id));
			if($emp_profile == Null)
				return "Không tồn tại hồ sơ";

			$emp_profile->name = $request->last_name." ".$request->middle_name." ".$request->first_name ;
			$emp_profile->profile_number = $request->profile_number;
			$emp_profile->gender = $request->gender;
			$emp_profile->date_of_birth = $request->date_of_birth;
			// $emp_profile->place_of_birth = joinAddress($request->place_of_birth, $request->place_of_birth_district, $request->place_of_birth_province);
			$emp_profile->place_of_birth = json_encode(['address'=>$request->place_of_birth, 'district'=>$request->place_of_birth_district, 'province'=>$request->place_of_birth_province]);
			$emp_profile->identity_card = $request->identity_card;
			$emp_profile->id_issued_by = $request->id_issued_by;
			$emp_profile->id_date_of_issued = $request->id_date_of_issued;
			$emp_profile->passport_number = $request->passport_number;
			$emp_profile->passport_issued_by = $request->passport_issued_by;
			$emp_profile->passport_date_of_issued = $request->passport_date_of_issued;
			$emp_profile->passport_expiration_date = $request->passport_expiration_date;
			$emp_profile->country = $request->country;
			$emp_profile->ethnic =$request->ethnic;
			$emp_profile->religion = $request->religion;
			// $emp_profile->household_address = joinAddress($request->household_address, $request->household_address_district, $request->household_address_province);
			$emp_profile->household_address = json_encode(['address'=>$request->household_address,'district'=> $request->household_address_district,'province'=> $request->household_address_province]);
			// $emp_profile->address = joinAddress($request->address, $request->address_district, $request->address_province);
			$emp_profile->address = json_encode(['address'=>$request->address,'district'=> $request->address_district, 'province'=>$request->address_province]);
			$emp_profile->phone = $request->phone;
			$emp_profile->email = $request->email;
			$emp_profile->marial_status = $request->marial_status;
			$emp_profile->date_of_adherent = $request->date_of_adherent;
			$emp_profile->adherent_number = $request->adherent_number;
			$emp_profile->adherent_position = $request->adherent_position;
			$emp_profile->adherent_active_place = $request->adherent_active_place;
			$emp_profile->note = $request->note;

			// if($request->hasFile('cardimage'))
			// {
			// 	$file = $request->file('cardimage');

			// // kiểm tra định dạng file
			// 	$format = $file->getClientOriginalExtension();
			// 	if($format != 'jpg' && $format != 'png' && $format !='jepg')
			// 	{
			// 		return redirect('hrm/emp/emp_add')->with('notify', 'Định dạng hình ảnh không được hỗ trợ. Các định dạng file được hỗ trợ png/jpg/jepg.');
			// 	}

			// // lưu tên file với mã nhân viên đc tạo
			// // Lấy tên file
			// 	$image = $file->getClientOriginalName();

			// 	$file->move("image/employee/cardimage/", $image);
			// 	$emp_profile->photo_card = $image;
			// }else{
			// 	$emp_profile->photo_card = "";
			// }
			$emp_profile->save();
			return "Sửa thành công hồ sơ cá nhân nhân viên ".$request->name;
		}

	}

	public function updateByEmp($request)
	{
		if(!empty($request))
		{
			$emp_profile = EmpProfile::where('emp_code', $request->emp_code)->first();

			$emp_profile->gender = $request->gender;
			$emp_profile->date_of_birth = $request->date_of_birth;
			$emp_profile->place_of_birth = $request->place_of_birth;
			$emp_profile->identity_card = $request->identity_card;
			$emp_profile->id_issued_by = $request->id_issued_by;
			$emp_profile->id_date_of_issued = $request->id_date_of_issued;
			$emp_profile->passport_number = $request->passport_number;
			$emp_profile->passport_issued_by = $request->passport_issued_by;
			$emp_profile->passport_date_of_issued = $request->passport_date_of_issued;
			$emp_profile->passport_expiration_date = $request->passport_expiration_date;
			$emp_profile->country = $request->country;
			$emp_profile->ethnic =$request->ethnic;
			$emp_profile->religion = $request->religion;
			$emp_profile->household_address = $request->household_address;
			$emp_profile->address = $request->address;
			$emp_profile->phone = $request->phone;
			$emp_profile->email = $request->email;
			$emp_profile->marial_status = $request->marial_status;
			$emp_profile->date_of_adherent = $request->date_of_adherent;
			$emp_profile->adherent_number = $request->adherent_number;
			$emp_profile->adherent_position = $request->adherent_position;
			$emp_profile->adherent_active_place = $request->adherent_active_place;
			$emp_profile->note = $request->note;
			$emp_profile->save();
			return $emp_profile;
		}
		return null;
	}

	/**
	 * get emp by name
	 */
	public function getEmpCodeByName($name)
	{
		$emp = EmpProfile::where('name', $name)->select('id','emp_code')->get();
		return $emp;
	}

	/**
	 * get name by emp_code
	 */
	public function getEmpNameByCode($code)
	{
		$emp = EmpProfile::where('emp_code', $code)->select('id','name')->first();
		return $emp;
	}




	/**
	 * create emp_code for new emp
	 * @return [type] [description]
	 */
	public function createEmpCode()
	{
		$emp = EmpProfile::all()->last();
		$id = $emp->id + 1;
		$code = convertIdEmp($id);
		return $code;
	}

}