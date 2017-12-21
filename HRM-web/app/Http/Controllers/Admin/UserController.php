<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Manager\UserManager;
use App\Manager\RoleManager;
use App\Manager\ProfileManager;

use Excel;

class UserController extends Controller
{
	

	private $user_manager;
	private $role_manager;

	function __construct()
	{
		$this->user_manager = new UserManager();
		$this->role_manager = new RoleManager();
	}








	public function getList()
	{
		$user = $this->user_manager->listUser();
		return view('admin.user.user', ['list_user'=>$user]);
	}

	public function getDetail($id)
	{
		$user = $this->user_manager->getUser($id);
		$role = $user->role;
		return response()->json($user);
	}

	public function getInfoUser($id)
	{
		$user = $this->user_manager->getUser($id);
		if($user){
			$profile_manager = new ProfileManager();
			$emp = $profile_manager->getProfile($id);
			return response()->json($emp);
		}
		return 0;
	}

	public function getRoleNotInUser($id)
	{
		$role = $this->role_manager->getRoleNotInUser($id);
		return response()->json($role);
	}

	public function getCreateEmpMail($emp_code){
		$mail = $this->user_manager->createEmpMail($emp_code);
		$response_code = 1;
		$data = '';

		if($mail == '0'){
			$data = "Mã nhân viên không tồn tại!";
			$response_code = 0;

		}elseif ($mail == '1') {
			$data = "Tài khoản đã tồn tại!";
			$response_code = 0;

		}else{
			$response_code = 1;
			$data = $mail;
		}
		return response()->json(['response_code'=>$response_code, 'data'=>$data]);
		// return $mail;
	}

	public function postAdd(Request $request){
		$user = $this->user_manager->addUser($request);
		$role = $request->role;
		$result = [];
		for($i = 0; $i < count($role); $i++){
			$result[$i] = $this->role_manager->addRoleUser($role[$i], $user->id);
		}

		return response()->json(['user'=>$user]);
	}

	public function putEdit($id_user, Request $request){
		$user = $this->user_manager->editUser($id_user, $request);
		$role = $request->role;
		$result = [];
		for($i = 0; $i < count($role); $i++){
			$result[$i] = $this->role_manager->addRoleUser($role[$i], $user->id);
		}

		return response()->json(['user'=>$user]);
	}

	public function getDelete($id)
	{
		$id_user = explode(",", $id);
		$user = [];
		for($i = 0; $i < count($id_user); $i++){
			// $role_user = $this->role_manager->deleteRoleUser(null, (int)$id_user[$i]);
			$user[$i] = $this->user_manager->deleteUser((int)$id_user[$i]);
		}
		return response()->json($user);
	}

	public function getDeleteRoleUser($id){
		$role_user = explode("-", $id);
		if(count($role_user) == 2){
			$id_role = $role_user[0];
			$id_user = $role_user[1];
			$role = $this->role_manager->deleteRoleUser($id_role, $id_user);
			return response()->json($role->role);
		}
		return 0;
	}




	public function getAddByFile()
	{
		$user = [];
		return view('admin.user.create', ['user'=>$user]);
	}


	public function postUploadFile(Request $request)
	{
		if($request->ajax()){


			if(Input::hasFile('upload-file')){
				$user = Excel::load(Input::file('upload-file'), function($reader){

				})->get();
				return response()->json(['response_code'=>1, 'data'=>$user]);
			}else{
				return response()->json(['response_code'=>0, 'data'=>'Không có file nào được chọn. Vui lòng tải lại.']);
			}
		}

		if(Input::hasFile('upload-file')){
			$user = Excel::load(Input::file('upload-file'), function($reader){})->get();
			// return redirect('admin/user/add-by-file')->with('user', $user);
			return view('admin.user.create', ['user'=>$user]);
		}
		return response()->json('Hello');

	}

	public function postAddUserByFile(Request $request)
	{
		$user = $this->user_manager->addUserFromFile($request);
		$role = $request->role;
		if($user > 0){
			for($i = 0; $i <count($role); $i++){
				$this->role_manager->addRoleUser($role[$i], $user);
			}
		}
		return response()->json($user);
	}

	public function getExcel()
	{
		// $user = [];
		// $i = 0;
		$user = Excel::load('excel/user/user.xlsx', function($reader) {
			// $reader->each(function($sheet){
			// 	foreach ($sheet->toArray() as $row) {
			// 		$user[$i] = $sheet->toArray();
			// 		$i++;
			// 	}
			// });

		})->get();
		return response()->json($user);
	}


}
