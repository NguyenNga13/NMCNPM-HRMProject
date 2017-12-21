<?php
namespace App\Manager;

use Carbon\Carbon;

use App\Model\EmpSalary;
use App\Model\EmpInsurance;
use App\Model\EmpAllowance;
use App\Model\EmpProfile;
use App\Model\Allowance;
use App\Model\PayScale;
use App\Model\EmpPaySheet;
use App\Model\EmpWorkDay;

use App\Manager\EmpSalaryManager;
use App\Manager\AllowanceManager;
use App\Manager\InsuranceManager;

/**
* 
*/
class EmpPaySheetManager
{
	
	function __construct()
	{
	}


	/**
	 * get paysheet of current month by id_emp
	 * 
	 * @param  [type] $id_emp [description]
	 * @return [type]         [description]
	 */
	public function getEmpPaySheet($id_emp)
	{
		$current =  Carbon::today();
		$month = $current->month;
		$year = $current->year;

		$paysheet = EmpPaySheet::where('emp_pay_sheets.id_emp', $id_emp)
		->whereYear('time', $year)
		->whereMonth('time', $month)
		->leftJoin('emp_profiles', 'emp_profiles.id', '=', 'emp_pay_sheets.id_emp')
		->leftJoin('emp_positions', function($join){
			$join->on('emp_profiles.id', '=', 'emp_positions.id_emp')
			->where('emp_positions.date_finish', '=', null)
			->where('emp_positions.status', '=', 1);
		})
		->leftJoin('positions', 'emp_positions.id_position', '=', 'positions.id')
		->leftJoin('departments', 'emp_positions.id_department', '=', 'departments.id')
		->leftJoin('emp_insurances', 'emp_profiles.id', '=', 'emp_insurances.id_emp')
		->select('emp_pay_sheets.*', 'emp_profiles.emp_code', 'emp_profiles.name', 'positions.position', 'departments.department', 'emp_insurances.insurance_code', 'emp_insurances.date_begin as date_begin_insurance' )
		->first();

		$workday = EmpWorkDay::where('id_emp', $id_emp)
		->whereYear('time', $year)
		->whereMonth('time', $month)
		->first();

		$paysheet['workday'] = $workday;

		return $paysheet;
	}

	public function getPaySheet($id)
	{
		$paysheet = EmpPaySheet::where('emp_pay_sheets.id', $id)
		->leftJoin('emp_profiles', 'emp_profiles.id', '=', 'emp_pay_sheets.id_emp')
		->leftJoin('emp_positions', function($join){
			$join->on('emp_profiles.id', '=', 'emp_positions.id_emp')
			->where('emp_positions.date_finish', '=', null)
			->where('emp_positions.status', '=', 1);
		})
		->leftJoin('positions', 'emp_positions.id_position', '=', 'positions.id')
		->leftJoin('departments', 'emp_positions.id_department', '=', 'departments.id')
		->leftJoin('emp_insurances', 'emp_profiles.id', '=', 'emp_insurances.id_emp')
		->select('emp_pay_sheets.*', 'emp_profiles.emp_code', 'emp_profiles.name', 'positions.position', 'departments.department', 'emp_insurances.insurance_code', 'emp_insurances.date_begin as date_begin_insurance' )
		->first();

		$date = strtotime($paysheet->time);
		$month = date('m', $date);
		$year = date('Y', $date);

		$workday = EmpWorkDay::where('id_emp', $paysheet->id_emp)
		->whereYear('time', $year)
		->whereMonth('time', $month)
		->first();

		$paysheet['workday'] = $workday;

		return $paysheet;
	}

	/**
	 * get list emp pay sheet in current month
	 */
	public function getListEmpPaySheet()
	{
		$current =  Carbon::today();
		$month = $current->month;
		$year = $current->year;

		$paysheet = EmpPaySheet::whereYear('time', $year)
		->whereMonth('time', $month)
		->leftJoin('emp_profiles', 'emp_profiles.id', '=', 'emp_pay_sheets.id_emp')
		->leftJoin('emp_positions', function($join){
			$join->on('emp_profiles.id', '=', 'emp_positions.id_emp')
			->where('emp_positions.date_finish', '=', null)
			->where('emp_positions.status', '=', 1);
		})
		->leftJoin('positions', 'emp_positions.id_position', '=', 'positions.id')
		->leftJoin('departments', 'emp_positions.id_department', '=', 'departments.id')
		->leftJoin('emp_insurances', 'emp_profiles.id', '=', 'emp_insurances.id_emp')
		->select('emp_pay_sheets.*', 'emp_profiles.emp_code', 'emp_profiles.name', 'positions.position', 'departments.department', 'emp_insurances.insurance_code', 'emp_insurances.date_begin as date_begin_insurance' )
		->get();
		foreach ($paysheet as $key => $value) {
			$workday = EmpWorkDay::where('id_emp', $value->id_emp)
			->whereYear('time', $year)
			->whereMonth('time', $month)
			->first();
			$value['workday'] = $workday;
		}

		return $paysheet;


	}

	public function addEmpPaySheet($id_emp)
	{
		$current =  Carbon::today();
		$month = $current->month;
		$year = $current->year;

		// check paysheet exist 
		$exist = EmpPaySheet::where('id_emp', $id_emp)
		->whereYear('time', $year)
		->whereMonth('time', $month)
		->select('id')
		->first();
		if($exist){
			return (2);
		}


		$salary_manager = new EmpSalaryManager();
		$emp_salary = $salary_manager->getEmpSalary($id_emp);

		$pay_value = $emp_salary->pay_value;
		if($pay_value == null){
			return 0; //0: when hasn't pay_value
		}
		$allowance = $emp_salary->allowance;

		$sum = (int)$pay_value;
		foreach ($allowance as $key => $value) {
			if($value->allowance_value){
				$sum += (int)($value->allowance_value);
			}elseif($value->allowance_value == null && $value->allowance_rate != null) {
				$sum += (int)((float)($value->allowance_rate) * (float)$pay_value);
			}
		}
		$emp_salary['sum'] = $sum;

		$workday = EmpWorkDay::where('id_emp', $id_emp)
		->whereYear('time', $year)
		->whereMonth('time', $month)
		->first();

		if(!$workday){
			return 1; //not has worday
		}

		$emp_workday = $workday->man_day +  $workday->holiday_leave_day +  $workday->paid_leave_day +  $workday->sick_leave_day;
		$month_workday = $this->getWorkDateByMonth($month);
		$real_income = (int)($sum*$emp_workday/$month_workday);

		$emp_salary['workday'] = $emp_workday;
		$emp_salary['total_income'] = $real_income;

		$ins = [];
		$ins_pay = 0;

		//count insurance if has insurance code
		if($emp_salary->insurance_code){
			$ins_manager = new InsuranceManager();
			$ins_list = $ins_manager->getListInsurance();

			foreach ($ins_list as $key => $value) {
				$pay = $sum *($value->rate_for_laborer)/100;
				$ins[$value->id] = $pay;
				$ins_pay += $pay;
			}
		}
		
		$emp_salary['ins_pay'] = $ins_pay;
		$emp_salary['ins'] = $ins;
		$real_salary = $real_income -(int)$ins_pay;

		$paysheet = new EmpPaySheet;
		$paysheet->id_emp = $id_emp;
		$paysheet->time = $current->format('Y-m-d');
		$paysheet->pay_value = $pay_value;
		$paysheet->allowances = $allowance;
		$paysheet->total_income = $sum;
		$paysheet->real_income = $real_income;
		if($emp_salary->insurance_code){
			$paysheet->bhxh = $ins[1];
			$paysheet->bhyt = $ins[2];
			$paysheet->bhtn = $ins[3];
		}
		$paysheet->salary = $real_salary;
		$paysheet->save();

		return $this->getPaySheet($paysheet->id);
	}


	public function getEmpWorkday($id_emp)
	{
		$current =  Carbon::today();
		$month = $current->month;
		$year = $current->year;

		$workday = EmpWorkDay::where('id_emp', $id_emp)
		->whereYear('time', $year)
		->whereMonth('time', $month)
		->first();

		// $emp_workday = $workday->man_day +  $workday->holiday_leave_day +  $workday->paid_leave_day +  $workday->sick_leave_day;
		return $workday;
	}

	public function getWorkDateByMonth($month)
	{
		if($month == 1 || $month == 3|| $month == 5|| $month == 7|| $month == 8 ||$month == 10 || $month == 12 ){
			return 27;
		}else if($month == 2){
			return 24;
		}else{
			return 26;
		}
	}

}