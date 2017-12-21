<?php
namespace App\Manager;

use App\Model\EmpUpdateProfile;

/**
* Class quản lý thông tin nhân viên yêu cầu cập nhật profile
*/
class EmpUpdateProfileManager
{
	const UPDATE_PROFILE = 1;
	const UPDATE_RELATIVE = 2;
	const UPDATE_SPECIALIZED = 3;
	const UPDATE_LANGUAGE = 4;

	const UPDATE_STATUS_REJECT = -1;
	const UPDATE_STATUS_UNREAD = 0;
	const UPDATE_STATUS_ACCEPT = 1;
	const UPDATE_STATUS_LATER = 2;

	
	function __construct()
	{
	}

	public function add($id, $type, $request)
	{
		if(!empty($request))
		{
			$update = new EmpUpdateProfile;
			$update->id_user = $id;
			$update->type = $type;

			$household_address = json_encode(['address'=>$request->household_address,'district'=> $request->household_address_district,'province'=> $request->household_address_province]);
			$address = json_encode(['address'=>$request->address,'district'=> $request->address_district, 'province'=>$request->address_province]);
			$place_of_birth = json_encode(['address'=>$request->place_of_birth, 'district'=>$request->place_of_birth_district, 'province'=>$request->place_of_birth_province]);

			$content = json_encode([
				'emp_code'=>$request->emp_code,
				'gender'=>$request->gender,
				'date_of_birth' => $request->date_of_birth,
				'place_of_birth'=>$place_of_birth,
				'identity_card'=>$request->identity_card,
				'id_issued_by'=>$request->id_issued_by,
				'id_date_of_issued'=>$request->id_date_of_issued,
				'passport_number'=>$request->passport_number,
				'passport_issued_by'=>$request->passport_issued_by,
				'passport_date_of_issued'=>$request->passport_date_of_issued,
				'passport_expiration_date'=>$request->passport_expiration_date,
				'country'=>$request->country,
				'ethnic'=>$request->ethnic,
				'religion'=>$request->religion,
				'household_address'=>$household_address,
				'address'=>$address,
				'phone'=>$request->phone,
				'email'=>$request->email,
				'marial_status'=>$request->marial_status,
				'date_of_adherent'=>$request->date_of_adherent,
				'adherent_number'=>$request->adherent_number,
				'adherent_position'=>$request->adherent_position,
				'adherent_active_place'=>$request->adherent_active_place,
				'note'=>$request->note
			]);


			$update->content = $content;
			$update->save();
			return $update;
		}
		return null;

	}

	public function get($id){
		$update = EmpUpdateProfile::where('id', $id)->first();
		return $update;
	}

	public function accepted($id, $hrm)
	{
		$update = EmpUpdateProfile::find($id);
		$update->status = 1;
		$update->confirmed_by = $hrm;
		$update->save();
		return $update;
	}

	public function rejected($id, $hrm)
	{
		$update = EmpUpdateProfile::find($id);
		$update->status = (-1);
		$update->confirmed_by = $hrm;
		$update->save();
		return $update;
	}

	public function confirm($id, $id_hrm, $status)
	{
		$update = EmpUpdateProfile::find($id);
		$update->status = $status;
		$update->confirmed_by = $id_hrm;
		$update->save();
		return $update; 
	}

}