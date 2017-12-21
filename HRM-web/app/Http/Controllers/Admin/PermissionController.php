<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Manager\PermissionManager;

/**
 * Class handle the request of Permission
 */
class PermissionController extends Controller
{
	private $permission_manager;

	public function __construct()
    {
    	$this->permission_manager = new PermissionManager();
    }

    /**
     * get list of permission
     * 
     * @return [type] [description]
     */
    public function getList()
    {
    	$permission = $this->permission_manager->getList();
    	return view('admin.permit.permit', ['permission'=>$permission]);
    }

    /**
     * get permission's detail info
     * 
     * @param  [type] $id_permission [description]
     * @return [type]                [description]
     */
    public function getDetail($id_permission)
    {
    	$permission = $this->permission_manager->getPermissionById($id_permission);
    	return response()->json($permission);
    }

    /**
     * add permission
     * 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postAdd(Request $request)
    {
    	$permission = $this->permission_manager->addPermission($request);
    	return response()->json($permission);
    }

    /**
     * update pemission's info
     * 
     * @param  [type]  $id_permission [description]
     * @param  Request $request       [description]
     * @return [type]                 [description]
     */
    public function postEdit($id_permission, Request $request)
    {
    	$permission = $this->permission_manager->editPermission($id_permission, $request);
    	return response()->json($permission);
    }

    /**
     *  delete permission
     * 
     * @param  [type] $id_permission [description]
     * @return [type]                [description]
     */
    public function getDelete($id_permission)
    {
    	$permission = $this->permission_manager->deletePermission($id_permission);
    	return response()->json($permission);
    }


    /**
     * delete list of permission
     * 
     * @param  [string] $list: list of permission'id to delete
     * @return [json]
     */
    public function getDeleteList($list)
    {
    	$id_list = explode(",", $list);
    	$permission = [];
    	for($i = 0; $i < count($id_list); $i++){
    		$permission[$i] = $this->permission_manager->deletePermission((int)$id_list[$i]);
    	}

    	return response()->json($permission);
    }


    
}
