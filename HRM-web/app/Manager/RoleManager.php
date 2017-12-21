<?php
namespace App\Manager;

use App\Model\Role;
use App\Model\RoleUser;
use App\Model\PermissionRole;
use App\Model\Permission;
use App\User;

/**
* 
*/
class RoleManager
{
	
	/**
	 * Lấy danh sách role
	 */
	public function list()
	{
		// $roleList = Role::orderBy('id', 'DESC')->get();
		$roleList = Role::all();
		return $roleList;
	}


	/**
	 * Lấy thông tin role theo id
	 */
	public function getRoleById($id_role)
	{
		$role = Role::findOrFail($id_role);
		return $role;
	}

	/**
	 * Thêm role
	 */
	public function addRole($request)
	{
		$role = new Role;
		$role->role = $request->role;
		$role->description = $request->description;
		$role->save();
		return $role;
	}

	/**
	 * Xóa role
	 */
	public function deleteRole($id_role)
	{
		$role = Role::findOrFail($id_role);
		$role->delete();
		return $role;
	}


	/**
	 * Sửa role
	 */
	public function editRole($id_role, $request)
	{
		$role = Role::findOrFail($id_role);
		$role->role = $request->role;
		$role->description = $request->description;
		$role->save();
		return $role;
	}


	public function getListPermissionNotInRole($id_role)
	{
		if($id_role == 0){
			$permission = Permission::orderBy('permission', 'ASC')->get();
			return $permission;
		}
		$permission_role = PermissionRole::where('id_role', '=', $id_role)
		->select('id_permission')->get();
		
		$permission = Permission::whereNotIn('id', $permission_role)->orderBy('permission', 'ASC')->get();
		return $permission;

	}

	/**
	 * get role not in user
	 * 
	 * @param  [type] $id_user [description]
	 * @return [type]          [description]
	 */
	public function getRoleNotInUser($id_user)
	{
		if($id_user == 0){
			$role = Role::all();
			return $role;
		}

		$role_user = RoleUser::where('id_user', '=', $id_user)
		->select('id_role')->get();
		$role = Role::whereNotIn('id', $role_user)->get();
		return $role;
	}


	/**
	 * thêm role_user = thêm role cho user
	 */
	public function addRoleUser($id_role, $id_user)
	{
		$role_user = new RoleUser();
		$role_user->id_role = $id_role;
		$role_user->id_user = $id_user;
		$role_user->save();
	}


	/**
	 * Lấy danh sách user thuộc role
	 */
	public function getUserOfRoleById($id_role)
	{
		$userList = User::join('role_user', 'users.id', '=', 'role_user.id_user')
		->where('role_user.id_role', '=', $id_role)
		->get();
		return $userList;
	}


	/**
	 * Xóa role_user
	 */
	public function deleteRoleUser($id_role, $id_user)
	{
		if($id_role != null && $id_user != null)
		{
			$result = RoleUser::where('id_role', '=', $id_role)
			->where('id_user', '=', $id_user)->first();
			$result->delete();
			return $result;
		}
		else if($id_role != null && $id_user == null)
		{
			$result = RoleUser::where('id_role', '=', $id_role)->delete();
			return $result;
		}
		else if($id_role == null && $id_user != null)
		{
			$result = RoleUser::where('id_user', '=', $id_user)->delete();
			return $result;
		}
		else
		{
			return 0;//"Tham số không hợp lệ"
		}
	}

	/**
	 * Thêm permission_role
	 */
	public function addPermissionRole($id_permission, $id_role)
	{
		$permission_role = new PermissionRole;
		$permission_role->id_permission = $id_permission;
		$permission_role->id_role = $id_role;
		$permission_role->save();
		return $permission_role;
	}

	/**
	 * Xóa permission_role
	 */
	public function deletePermissionRole($id_permission, $id_role)
	{
		if($id_role != null && $id_permission != null)
		{
			$result = PermissionRole::where('id_role', '=', $id_role)
			->where('id_permission','=', $id_permission)->first();
			$result->delete();
			return $result;
		}
		elseif ($id_role != null && $id_permission == null) {
			$result = PermissionRole::where('id_role', '=', $id_role)->delete();
			return $result;
		}
		elseif ($id_role == null && $id_permission != null) {
			$result = PermissionRole::where('id_permission', '=', $id_permission)->delete();
			return $result;
		}
		else{
			// return "Tham số không hợp lệ";
			return 0;
		}
	}


	/**
	 * Lấy danh sách permission của role
	 */
	public function getPermissionOfRoleById($id_role)
	{
		$permissionList = PermissionRole::where('id_role', '=', $id_role)->get();
		return $permissionList;
	}
}