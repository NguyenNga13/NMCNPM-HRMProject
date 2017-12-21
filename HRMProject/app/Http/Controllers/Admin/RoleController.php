<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Manager\RoleManager;

class RoleController extends Controller
{
    private $role_manager;

    public function __construct()
    {
    	$this->role_manager = new RoleManager();
    }

    public function getList()
    {
    	$role = $this->role_manager->list();
    	return view('admin.role.role', ['role'=>$role]);
    }

    public function getDetail($id_role)
    {
    	$role = $this->role_manager->getRoleById($id_role);
        $permission = $role->permission;
        return response()->json($role);
    }

    public function getListPermissionNotInRole($id_role){
        $permission = $this->role_manager->getListPermissionNotInRole($id_role);
        return response()->json($permission);

    }

    public function postAdd(Request $request)
    {
        $role = $this->role_manager->addRole($request);
        $permission = $request->permission;
        $result = [];
        
        for($i = 0; $i < count($permission); $i++){
            $result[$i] = $this->role_manager->addPermissionRole($permission[$i], $role->id);
        }
        
        return response()->json(['role'=>$role,'permission'=>$result]);
    }

    public function postEdit($id_role, Request $request)
    {

        $role = $this->role_manager->editRole($id_role, $request);
        $permission = $request->permission;
        $result = [];

        for($i = 0; $i < count($permission); $i++){
            $result[$i] = $this->role_manager->addPermissionRole($permission[$i], $role->id);
        }

        return response()->json(['role'=>$role,'permission'=>$result]);
    }

    public function getDelete($id_role)
    {
        $permission = $this->role_manager->deletePermissionRole(null, $id_role);
        $user = $this->role_manager->deleteRoleUser($id_role, null);
        $role = $this->role_manager->deleteRole($id_role);

        return response()->json($role);
    }

    public function getDeleteList($list_id)
    {
        $id_role = explode(",", $list_id);
        $role = [];
        for ($i=0; $i < count($id_role) ; $i++) { 
           $permission = $this->role_manager->deletePermissionRole(null, (int)$id_role[$i]);
           $user = $this->role_manager->deleteRoleUser((int)$id_role[$i], null);
           $role[$i] = $this->role_manager->deleteRole((int)$id_role[$i]);
       }
       return response()->json($role);
   }

   public function getDeletePermissionRole($id)
   {
    $permission_role = explode("-", $id);
    if(count($permission_role) == 2){
        $id_permission = $permission_role[0];
        $id_role = $permission_role[1];
        $permission = $this->role_manager->deletePermissionRole($id_permission, $id_role);
        return response()->json($permission->permission);
    }
    return 0;

}
}
