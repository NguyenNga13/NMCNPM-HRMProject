<?php
namespace App\Manager;

use App\User;
use App\Model\RoleUser;
use App\Model\EmpProfile;
use App\Model\Role;
use App\Model\Notify;
use App\Model\EmpUpdateProfile;


use App\Crypt\AESCipher;

/**
* 
*/
class UserManager
{
	const ADMIN_POSITION =1; 	//Quản trị viên
	const HRM_POSITION =2;   	//Quản lý nhân sự
	const EMPLOYEE_POSITION =3; //Nhân viên - chung
	const FRESHER_POSITION =4; //Nhân viên - chung

	public function listUser()
	{
		$user = User::all();
		return $user;

	}



	public function addUser($request)
	{

		$emp = EmpProfile::where('emp_code', '=', $request->name)->first();
		if($emp == NULL)
			return "Không tồn tại nhân viên";

		if(User::where('id_emp', '=', $emp->id)->first()){
			return "Tài khoản đã tồn tại";
		}

		$user = new User;
		$user->id_emp = $emp->id;
		$user->position = $request->position;
		$user->name = $request->name;
		$user->password = bcrypt($request->name);
		$user->email = $request->email;
		$user->active = $request->active;
		$user->aes_key = AESCipher::create_key($request->name);
		$user->save();
		return $user; 
	}


	public function addUserFromFile($request)
	{
		$emp = EmpProfile::where('emp_code', '=', $request->emp_code)->first();
		if($emp == NULL)
			return -1; //Không tồn tại nhân viên

		if(User::where('id_emp', '=', $emp->id)->first()){
			return 0; //Tài khoản đã tồn tại
		}

		$user = new User;
		$user->id_emp = $emp->id;
		$position = trim($request->position);

		if($position == 'Nhân viên')
			$user->position = 3;
		elseif ($position == "Quản lý nhân sự") {
			$user->position =2;
		}elseif ($position == "Quản trị viên") {
			$user->position =1;
		}else{
			$user->position = 4;
		}

		$user->name = $request->emp_code;
		$user->email = $this->createMail($request->name);
		$user->password = bcrypt($request->emp_code);
		$user->aes_key = AESCipher::create_key($request->emp_code);
		$user->save();
		return $user->id;
	}


	/**
	 * Sửa thông tin user
	 */
	public function editUser($id_user, $request)
	{
		$user = User::find($id_user);
		$user->position = $request->position;
		$user->active = $request->active;
		$user->save();
		return $user;
	}

	/**
	 * Xóa tài khoản người dùng
	 */
	public function deleteUser($id_user)
	{
		RoleUser::where('id_user', '=', $id_user)->delete();
		EmpUpdateProfile::where('id_user', '=', $id_user)->delete();
		Notify::where('from', '=', $id_user)->delete();

		$user = User::findOrFail($id_user);
		$user->delete();
		return $user;
	}

	/**
	 * Lấy thông tin user bằng id
	 */
	public function getUser($id_user)
	{
		$user = User::findOrFail($id_user);
		return $user;
	}

	/**
	 * get all permission of user
	 */
	public function getPermissionOfUser($id_user)
	{

		// $permission = User::where('users.id', '=', $id_user)
		// ->join('role_users', 'users.id', '=', 'role_users.id_user')
		$permission = RoleUser::where('id_user', '=', $id_user)
		->join('roles', 'role_users.id_role', '=', 'roles.id')
		->join('permission_roles', 'roles.id', '=', 'permission_roles.id_role')
		->join('permissions', 'permission_roles.id_permission', '=', 'permissions.id')
		->select('permissions.id', 'permissions.permission')
		->get();
		return $permission;
	}


	/**
	 * get all permission of user
	 * @return [] $id_permission
	 */
	public function getIdPermissionOfUser($id_user)
	{
		$permission = RoleUser::where('id_user', '=', $id_user)
		->join('roles', 'role_users.id_role', '=', 'roles.id')
		->join('permission_roles', 'roles.id', '=', 'permission_roles.id_role')
		->join('permissions', 'permission_roles.id_permission', '=', 'permissions.id')
		->select('permissions.id')
		->get();
		return $permission;
	}

	/**
	 * check user has a permission
	 */
	public function checkUserPermission($id_user, $id_permission)
	{
		$permission = $this->getPermissionOfUser($id_user);
		foreach ($permission as $key => $value) {
			if($id_permission == $value->id){
				return 1;
			}
		}
		return 0;
	}


	

	/**
	 * create internal mail from emp_code
	 * 
	 * @param  [type] $emp_code [description]
	 * @return [type]           [description]
	 */
	public function createEmpMail($emp_code)
	{
		$emp = EmpProfile::where('emp_code', '=', $emp_code)->first();
		if($emp){
			$user = User::where('name', '=', $emp_code)->first();
			if($user){
				return 1;
			}else{
				$name = $emp->name;
				$mail = $this->createMail($name);
				return $mail;
			}
		}else{
			return 0;
		}
		
	}

	/**
	 * create internal mail by name
	 * 
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	function createMail($name)
	{
		$name = stripUnicode(trim($name));
		$arr = explode(' ', $name);
		$length = count($arr);

		$mail = $arr[$length-1];
		for ($i=0; $i < $length-1; $i++) { 
			$mail = $mail.substr($arr[$i], 0, 1);
		}
		$i = 1;
		$mail = strtolower($mail);
		while (User::where('email', $mail.'@hrm.vn')->first()) {
			$mail = $mail.(string)$i;
			$i++;
		}
		return strtolower($mail."@hrm.vn");
	}
}