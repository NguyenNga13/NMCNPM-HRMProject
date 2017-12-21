<?php
namespace App\Manager;

use App\Model\EmpSpecialized;
use App\Model\EmpLanguage;

/**
* Class quản lý trình độ, bằng cấp
*/
class DegreeManager
{
	
	function __construct()
	{
	}

	public function getSpecialized($id)
	{
		$specialized = EmpSpecialized::find($id);
		return $specialized;
	}

	public function addSpecialized($request)
	{
		if(!empty($request))
		{
			$specialized = new EmpSpecialized;
			$specialized->id_emp = invertIdEmp($request->id_emp);
			$specialized->specialized = $request->specialized;
			$specialized->degree = $request->degree;
			$specialized->training_type = $request->training_type;
			$specialized->level = $request->level;
			$specialized->issued_by = $request->issued_by;
			$specialized->date_of_issued = $request->date_of_issued;
			$specialized->begin = $request->begin;
			$specialized->finish = $request->finish;
			$specialized->note = $request->note;
			$specialized->save();
			return $specialized;
			// return "Tạo thành công trình độ chuyên môn của nhân viên ".$request->name_emp;
		}
		// return "Tạo trình độ chuyên môn của nhân viên ".$request->name_emp." thất bại!";
	}

	public function editSpecialized($request, $id)
	{
		if(!empty($request))
		{
			$specialized = EmpSpecialized::find($id);
			$specialized->specialized = $request->specialized;
			$specialized->degree = $request->degree;
			$specialized->training_type = $request->training_type;
			$specialized->level = $request->level;
			$specialized->issued_by = $request->issued_by;
			$specialized->date_of_issued = $request->date_of_issued;
			$specialized->begin = $request->begin;
			$specialized->finish = $request->finish;
			$specialized->note = $request->note;
			$specialized->save();

			return $specialized;
			// return "Sửa thành công trình độ chuyên môn của nhân viên ".$request->name_emp;
		}
		// return "Sửa trình độ chuyên môn của nhân viên ".$request->name_emp." thất bại!";
	}

	public function deleteSpecialized($id)
	{
		$specialized = EmpSpecialized::destroy($id);
		return $specialized;
	}

	public function getLanguage($id)
	{
		$language = EmpLanguage::find($id);
		return $language;
	}

	public function addLanguage($request)
	{
		if(!empty($request))
		{
			$language = new EmpLanguage;
			$language->id_emp = invertIdEmp($request->id_emp);
			$language->language = $request->language;
			$language->certificate_type = $request->certificate_type;
			$language->level = $request->level;
			$language->issued_by = $request->issued_by;
			$language->date_of_issued = $request->date_of_issued;
			$language->expire = $request->expire;
			$language->note = $request->note;
			$language->save();
			return $language;
			// return "Thêm thành công trình độ ngoại ngữ của nhân viên ".$request->name_emp;
		}
		// return "Thêm trình độ ngoại ngữ của nhân viên ".$request->name_emp." thất bại!";
	}



	public function editLanguage($request, $id)
	{
		if(!empty($request))
		{
			$language = EmpLanguage::find($id);
			$language->language = $request->language;
			$language->certificate_type = $request->certificate_type;
			$language->level = $request->level;
			$language->issued_by = $request->issued_by;
			$language->date_of_issued = $request->date_of_issued;
			$language->expire = $request->expire;
			$language->note = $request->note;
			$language->save();
			return $language;
		}
	}

	public function deleteLanguage($id)
	{
		$language = EmpLanguage::destroy($id);
		return $language;
	}

	
}