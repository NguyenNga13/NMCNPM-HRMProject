<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Model\EmpProfile;

use App\Manager\DegreeManager;



class DegreeController extends Controller
{
	private $degree_manager;

	public function __construct()
	{
		$this->degree_manager= new DegreeManager();
	}

	public function getAdd($id_emp)
	{
		$emp = EmpProfile::find($id_emp);
		return response()->json(['id_emp'=>convertIdEmp($emp->id), 'name_emp'=>$emp->name]);
	}

	public function detailSpecialized($id)
	{
		$specialized = $this->degree_manager->getSpecialized($id);
		return response()->json(['specialized'=>$specialized, 'id_emp'=>convertIdEmp($specialized->emp_profile->id)]);
	}


	public function addSpecialized(Request $request)
	{
		$specialized = $this->degree_manager->addSpecialized($request);
		return response()->json($specialized);
	}

	public function editSpecialized(Request $request, $id)
	{
		$specialized = $this->degree_manager->editSpecialized($request, $id);
		return response()->json($specialized);
		// return redirect('hrm/emp/detail/'.invertIdEmp($request->id_emp))->with('notify', $message);
	}

	public function deleteSpecialized($id)
	{
		$specialized = $this->degree_manager->deleteSpecialized($id);
		return response()->json($specialized);
	}

	public function detailLanguage($id)
	{
		$language = $this->degree_manager->getLanguage($id);
		// return response()->json(['language'=>$language, 'name_emp'=>$language->emp_profile->name, 'id_emp'=>convertIdEmp($language->emp_profile->id)]);
		return response()->json(['language'=>$language, 'id_emp'=>convertIdEmp($language->emp_profile->id)]);
	}

	// public function getAddLanguage($id_emp)
	// {
	// 	$emp = EmpProfile::find($id_emp);
	// 	return response()->json(['id_emp'=>convertIdEmp($emp->id), 'name_emp'=>$emp->name]);
	// }

	public function postAddLanguage(Request $request)
	{
		$language= $this->degree_manager->addLanguage($request);
		// return redirect('hrm/emp/detail/'.invertIdEmp($request->id_emp))->with('notify', $message);
		return response()->json($language);
	}

	public function editLanguage(Request $request, $id)
	{
		$language = $this->degree_manager->editLanguage($request, $id);
		// return redirect('hrm/emp/detail/'.invertIdEmp($request->id_emp))->with('notify', $message);
		return response()->json($language);
	}

	public function deleteLanguage($id)
	{
		$language = $this->degree_manager->deleteLanguage($id);
		return response()->json($language);
	}
}
