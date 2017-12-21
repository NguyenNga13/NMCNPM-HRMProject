<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Manager\EmpSalaryManager;
use App\Manager\PayScaleManager;
use App\Manager\InsuranceManager;
use App\Manager\AllowanceManager;


class SalaryController extends Controller
{
	private $salary_manager;
	private $payscale_manager;
	private $allowance_manager;
	private $insurance_manager;

	function __construct()
	{
		$this->salary_manager = new EmpSalaryManager();
		$this->payscale_manager = new PayScaleManager();
		$this->insurance_manager = new InsuranceManager();
		$this->allowance_manager = new AllowanceManager();
	}



	public function getList()
	{
		$allowance = $this->allowance_manager->getListAllowance();
		$pay_scale = $this->payscale_manager ->getListPayScale();
		$list_emp = $this->salary_manager->getListEmp();

		return view('hrm.salary.emp_salary_info.emp_salary_info', ['pay_scales'=>$pay_scale, 'allowances'=>$allowance, 'emp_salary'=>$list_emp]);
	}

	public function getEmpSalary($id, Request $request)
	{
		$emp = $this->salary_manager->getEmpSalary($id);
		// if($request->ajax()){
		// 	return response()->json($emp);
		// }
		$pay_scale = $this->payscale_manager ->getListPayScale();
		$allowance = $this->salary_manager->getAllowanceCodeByIdEmp($id);
		return view('hrm.salary.emp_salary_info.emp_salary_detail', ['emp'=>$emp, 'pay_scales'=>$pay_scale, 'emp_allowances'=>$allowance]);
		
		
	}

	public function getEmpAllowanceById($id)
	{
		$allowance = $this->salary_manager->getEmpAllowanceById($id);
		return response()->json($allowance);
	}

	public function postAddEmpAllowance(Request $request)
	{
		$allowance = $this->salary_manager->addEmpAllowance($request);
		return response()->json($allowance);
	}

	public function postEditEmpAllowance($id, Request $request)
	{
		$allowance = $this->salary_manager-> editEmpAllowance($id, $request);
		return response()->json($allowance);
	}

	public function postUpdateEmpAllowance($id, Request $request)
	{
		$allowance = $this->salary_manager->updateEmpAllowance($id, $request);
		return response()->json($allowance);
	}

	public function getDeleteEmpAllowance($id)
	{
		$allowance = $this->salary_manager->deleteEmpAllowance($id);
		return response()->json($allowance);
	}

	public function postEditEmpPayScale($id_emp, Request $request)
	{
		$scale = $this->salary_manager->editEmpPayScale($id_emp, $request);
		$ins='';
		if(isset($request->insurance_code)){
			$ins = $this->salary_manager->editEmpInsurance($id_emp, $request);
			// $ins="true";
		}

		return response()->json(['pay_scale'=>$scale, 'insurance'=>$ins]);
		// return response()->json($ins);

	}

	public function getEmpPayScale($id_emp)
	{
		// $scale = $this->salary_manager->getEmpPayScale($id_emp);
		$ins = $this->salary_manager->editEmpInsurance($id_emp);
		return response()->json($ins);
	}

	public function postUpdateEmpPayScale($id_emp, Request $request)
	{
		$scale = $this->salary_manager->updateEmpPayScale($id_emp, $request);
		$ins = '';
		if(isset($request->insurance_code)){
			$ins = $this->salary_manager->editEmpInsurance($id_emp, $request);
		}
		return response()->json(['pay_scale'=>$scale, 'insurance'=>$ins]);

	}

	public function getSearchEmp($code)
	{
		$emp = $this->salary_manager->searchEmp($code);
		return response()->json($emp);
		// if($emp){
		// 	return redirect('hrm/salary/emp/emp-salary/'.$emp->id);
		// }else{
		// 	return response()->json(0);
		// }
	}
}
