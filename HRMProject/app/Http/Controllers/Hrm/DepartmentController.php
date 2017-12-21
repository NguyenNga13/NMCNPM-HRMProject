<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Manager\DepartmentManager;

class DepartmentController extends Controller
{
    private $dep_manager;

    public function __construct()
	{
		$this->dep_manager= new DepartmentManager();
	}

	/**
	 * Danh sách phòng ban
	 */
	public function getList()
	{
		$dep_list = $this->dep_manager->getList();

		return view('hrm.organize.department.list', ['dep_list'=>$dep_list]);
	}

	/**
	 * Chi tiết phòng ban
	 */
	public function getDetail($id)
	{
		$dep_list = $this->dep_manager->getList();
		$dep = $this->dep_manager->getDetail($id);
		$emp_list = $this->dep_manager->getEmpList($id);
		
		return view('hrm.organize.department.detail', ['dep_list'=>$dep_list, 'dep_info'=>$dep, 'emp_list'=>$emp_list]);
	}

	/**
	 * Thêm phòng ban
	 */
	public function postAdd(Request $request)
	{
		$result = $this->dep_manager->add($request);
		if($result)
			return redirect('hrm/organize/dep_detail/'.$result)->with('notify', 'Thêm thành công');
		else
			return redirect('hrm/organize/dep_list')->with('notify', 'Thêm thất bại');
	}


	/**
	 * Sửa phòng ban
	 */
	public function postEdit(Request $request)
	{
		$this->dep_manager->edit($request);
		return redirect('hrm/organize/dep_detail/'.$request->id)->with('notify', 'Sửa thành công thông tin phòng ban');
	}

	/**
	 * Xóa phòng ban
	 */
	public function getDelete($id)
	{
		$this->dep_manager->delete($id);
		return redirect('hrm/organize/dep_list')->with('notify', 'Xóa thành công');
	}

	/**
	 * get list dep
	 * @return [] department
	 */
	public function getListDep()
    {
    	// $dep_manager = new DepartmentManager();
    	$dep = $this->dep_manager->getListDep();
    	return response()->json($dep);
    }

    /**
     * get dep by name
     * @return json department
     */
    public function getDepByName($name)
    {
    	$dep = $this->dep_manager->getDepByName($name);
    	return response()->json($dep);
    }

    /**
     * get dep by id
     * json
     */
    public function getDepById($id)
    {
    	$dep = $this->dep_manager->getDetail($id);
    	return response()->json($dep);
    }






}
