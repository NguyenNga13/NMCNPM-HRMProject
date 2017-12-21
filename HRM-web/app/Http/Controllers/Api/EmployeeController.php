<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Manager\ProfileManager;
use App\Manager\EmpSalaryManager;
use App\Manager\PayScaleManager;

use App\Model\EmpProfile;
use App\Model\EmpPosition;
use App\Crypt\AESCipher;



class EmployeeController extends Controller
{
	private $emp_manager;

	public function __construct()
	{
		$this->emp_manager= new ProfileManager();
	}

	public function profile()
	{
		$user = Auth::user();
		$aesKey = $user->aes_key;

		// $profile = Auth::user()->emp_profile()->first();

		$string = AESCipher::encrypt($aesKey, $user->emp_profile);


		return response()->json(['data'=>$string], 200, [], JSON_NUMERIC_CHECK);
	}


	public function summary()
	{
		$user = Auth::user();
		$profile = $user->emp_profile;

		return response()->json(['data'=>['id'=>$profile->id, 'name'=>$profile->name, 'photo_card'=>$profile->photo_card]], 200, [], JSON_NUMERIC_CHECK);
	}

	// public function position()
	// {
	// 	$user = Auth::user()->first();

	// 	$pos = EmpPosition::where('id_emp', $user->name)->where('date_finish', Null)->where('status', 1)->first();

	// 	$department = $pos->department;
	// 	$position = $pos->position;

	// 	return response()->json(['data'=>$pos],  200, [], JSON_NUMERIC_CHECK);
	// }

	public function position()
	{
		$user = Auth::user();
		$current_pos = EmpPosition::where('id_emp', $user->id_emp)
									->join('positions', 'emp_positions.id_position', '=', 'positions.id')
									->leftJoin('departments', 'emp_positions.id_department', '=', 'departments.id')
									->select('emp_positions.*', 'positions.position', 'departments.department')
									->get();
		$aesKey = $user->aes_key;
		$data = AESCipher::encrypt($aesKey, $current_pos);

		return response()->json(['data'=>$data],  200, [], JSON_NUMERIC_CHECK);
	}

	public function relatives()
	{
		$user = Auth::user();
		$aesKey = $user->aes_key;

		$emp = $user->emp_profile;
		$data = AESCipher::encrypt($aesKey, $emp->emp_relative);
		return response()->json(['data'=>$data],  200, [], JSON_NUMERIC_CHECK);
	}

	public function degree()
	{
		$user = Auth::user();
		$aesKey = $user->aes_key;

		$emp = $user->emp_profile;

		$json = json_encode(['specialized' => $emp->emp_specialized, 'language' => $emp->emp_language]);
		$data = AESCipher::encrypt($aesKey, $json);

		return response()->json(['data'=>$data],  200, [], JSON_NUMERIC_CHECK);
	}

	public function salary()
	{
		$user = Auth::user();
		$aesKey = $user->aes_key;

		$salary_manager = new EmpSalaryManager();
		$emp_salary = $salary_manager->getEmpSalary($user->id_emp);

		$data = AESCipher::encrypt($aesKey, $emp_salary);

		// return response()->json(['data'=>$emp_salary],  200, [], JSON_NUMERIC_CHECK);
		return response()->json(['data'=>$data],  200, [], JSON_NUMERIC_CHECK);
	}

}
