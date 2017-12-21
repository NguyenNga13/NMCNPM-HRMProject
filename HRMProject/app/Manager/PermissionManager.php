<?php
namespace App\Manager;

use App\Model\PermissionRole;
use App\Model\Permission;
use App\User;

/**
* Class manager permission data
*/
class PermissionManager
{

	const ID_PERMISSION_CREATE_PROFILE = 1;
	const ID_PERMISSION_UPDATE_PROFILE = 2;
	const ID_PERMISSION_DELETE_PROFILE = 3;
	const ID_PERMISSION_CONFIRM_UPDATE_PROFILE = 5;
	const ID_PERMISSION_MANAGE_INSURANCE = 17;
	const ID_PERMISSION_MANAGE_ROLE = 19;
	const ID_PERMISSION_CREATE_PAYSHEET = 20;
	const ID_PERMISSION_UPDATE_EMPSALARY = 21;
	const ID_PERMISSION_MANAGE_PAYSCALE = 22;
	const ID_PERMISSION_UPDATE_PAYSCALE = 23;
	const ID_PERMISSION_DELETE_PAYSCALE = 24;
	const ID_PERMISSION_MANAGE_POSITION = 30;
	const ID_PERMISSION_MANAGE_DEPARTMENT = 31;
	const ID_PERMISSION_VIEW_PAYSHEET = 32;
	const ID_PERMISSION_MANAGE_EMPWORK = 33;
	const ID_PERMISSION_CREATE_COMMENDATION = 34;
	const ID_PERMISSION_CREATE_DISCIPlINED = 35;
	const ID_PERMISSION_UPDATE_PROFILE_EMP = 36;
	const ID_PERMISSION_CREATE_PAYSCALE = 37;
	

	/**
	 * Lấy danh sách permission
	 */
	public function getList()
	{
		// $permissionList = Permission::orderBy('id', 'ASC')->get();
		$permissionList = Permission::orderBy('permission', 'ASC')->get();
		return $permissionList;
	}

	/**
	 * Lấy thông tin permission theo id
	 */
	public function getPermissionById($id_permission)
	{
		$permission = Permission::findOrFail($id_permission);
		return $permission;
	}

	/**
	 * Thêm permission
	 */
	public function addPermission($request)
	{
		$permission = new Permission();
		$permission->permission = $request->permission;
		$permission->description = $request->description;
		$permission->save();
		return $permission;
	}

	/**
	 * Xóa permission
	 */
	public function deletePermission($id_permission)
	{
		$permission = Permission::findOrFail($id_permission);
		$permission->delete();
		return $permission;
	}


	/**
	 * Sửa permission
	 */
	public function editPermission($id_permission, $request)
	{
		$permission = Permission::findOrFail($id_permission);
		$permission->permission = $request->permission;
		$permission->description = $request->description;
		$permission->save();
		return $permission;
	}



}