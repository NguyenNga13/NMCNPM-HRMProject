<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Manager\EmpPaySheetManager;
use App\Manager\AllowanceManager;
use App\Manager\InsuranceManager;
use App\Manager\PermissionManager;
use App\Manager\DepartmentManager;
use App\Manager\ProfileManager;

use App\Http\Controllers\Auth\JWTAuth\JwtAuth;

class PaySheetController extends Controller
{
	private $paysheet_manager;
	private $allowance_manager;

	private $jwtAuth;

	function __construct()
	{
		$jwtAuth = new JwtAuth();
		$jwtAuth->allocateAccessToken();
		$this->paysheet_manager = new EmpPaySheetManager();
		$this->allowance_manager = new AllowanceManager();


	}

	public function getPaySheetTable()
	{
		$allowance = $this->allowance_manager->getListAllowance();
		$paysheet = $this->paysheet_manager->getListEmpPaySheet();
		return view('hrm.salary.paysheet.paysheets', ['allowances'=>$allowance, 'paysheets'=>$paysheet]);
	}

	public function getAddPaySheet()
	{
    	// $permission = $this->jwtAuth->getUserData();
		$auth = new JwtAuth();
		$user = $auth->getUserData();
		$data = $auth->getUserPermission();
		$check = $auth->checkPermission(PermissionManager::ID_PERMISSION_CREATE_PAYSHEET);
		return response()->json(['data'=>$user, 'check'=>$check]);
	}

	public function getPaySheetByEmp($id_emp)
	{
		$sheet = $this->paysheet_manager->getEmpPaySheet($id_emp);
		return view('hrm.salary.paysheet.emp_paysheet', ['sheet'=>$sheet]);
	}

	public function getAddEmpPaySheet($id_emp)
	{
		$sheet = $this->paysheet_manager->addEmpPaySheet($id_emp);
		if(is_integer($sheet)){
			if($sheet == 1){
				return redirect('hrm/salary/paysheet/table')->with('error', 'Thông tin ngày công trong tháng của nhân viên chưa được cập nhật!');
			}else if($sheet == 0){
				return redirect('hrm/salary/paysheet/table')->with('error', 'Nhân viên không có thông tin lương!');
			}else if($sheet == (2)){
				return redirect('hrm/salary/paysheet/table')->with('error', 'Bảng lương nhân viên trong tháng đã được tạo!');
			}

		}else{
			return redirect('hrm/salary/paysheet/emp-paysheet/'.$id_emp);
		}
	}

    /**
     * get pay sheet by id's pay sheet
     */
    public function getPaySheet($id)
    {
    	$sheet = $this->paysheet_manager->getPaySheet($id);
    	return view('hrm.salary.paysheet.emp_paysheet', ['sheet'=>$sheet]);
    }

    /**
     * get list of dep
     * 
     * @return [type] [description]
     */
    public function getListDep()
    {
    	$dep_manager = new DepartmentManager();
    	$dep = $dep_manager->getListDep();
    	return response()->json($dep);
    }

    /**
     * get name's dep by id
     * 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getDepById($id)
    {
    	$dep_manager = new DepartmentManager();
    	$dep = $dep_manager->getDetail($id);
    	return response()->json($dep->department);
    }

    /**
     * get id_dep by name
     * 
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public function getDepByName($name)
    {
    	$dep_manager = new DepartmentManager();
    	$dep = $dep_manager->getDepByName($name);
    	return response()->json($dep->id);
    }


    /**
     * get emp_code by emp_name
     */
    public function getEmpCodeByName($name)
    {
    	$emp_manager = new ProfileManager();
    	$code = $emp_manager->getEmpCodeByName($name);
    	return response()->json($code);
    }

    /**
     * get emp_name by code
     */
    public function getEmpNameByCode($code)
    {
    	$emp_manager = new ProfileManager();
    	$emp = $emp_manager->getEmpNameByCode($code);
    	return response()->json($emp);
    }

}
