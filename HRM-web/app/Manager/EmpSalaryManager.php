<?php
namespace App\Manager;

use Carbon\Carbon;

use App\Model\EmpSalary;
use App\Model\EmpInsurance;
use App\Model\EmpAllowance;
use App\Model\EmpProfile;
use App\Model\Allowance;
use App\Model\PayScale;

/**
* class manage info of employee's salary: salary+allowance+insurance
*/
class EmpSalaryManager
{
	
	function __construct()
	{
	}

	/**
	 * add emp's salary
	 */
	public function addEmpSalary($request){
		$salary = new EmpSalary;
		$salary->id_emp = $request->id;
		$salary->pay_scale_code = $request->pay_scale_code;
	}

	public function getListEmp()
	{
		$list = EmpProfile::leftJoin('emp_positions', function($join){
			$join->on('emp_profiles.id', '=', 'emp_positions.id_emp')
			->where('emp_positions.date_finish', '=', null)
			->where('emp_positions.status', '=', 1);
		})
		->leftJoin('positions', 'emp_positions.id_position', '=', 'positions.id')
		->leftJoin('departments', 'emp_positions.id_department', '=', 'departments.id')
		->leftJoin('emp_insurances', 'emp_profiles.id', '=', 'emp_insurances.id_emp')
		->leftJoin('emp_salaries', function($join){
			$current_date =  Carbon::now()->format('Y-m-d');
			$join->on('emp_profiles.id', '=', 'emp_salaries.id_emp')
			->where([
				['applied_finish','=', null],
				['applied_begin', '<=', $current_date],
			])->orWhere([
				['applied_finish', '>', $current_date],
				['applied_begin', '<=', $current_date],
			]);
		})
		->select('emp_profiles.id','emp_profiles.emp_code', 'emp_profiles.name', 'positions.position', 'departments.department', 'emp_insurances.insurance_code', 'emp_salaries.pay_scale_code', 'emp_salaries.pay_range')
		->orderBy('emp_profiles.id', 'asc')
		->get();

		foreach ($list as $key => $value) {
			$allowance = $this->getAllowanceCodeByIdEmp($value->id);
			$value['allowance'] = $allowance;
		}
		return $list;
	}

	public function searchEmp($code)
	{
		$emp = EmpProfile::where('emp_code', '=', $code)->select('id')->first();
		return $emp;

	}

	public function getEmpSalary($id_emp)
	{
		$emp = EmpProfile::where('emp_profiles.id', '=', $id_emp)
		->leftJoin('emp_positions', function($join){
			$join->on('emp_profiles.id', '=', 'emp_positions.id_emp')
			->where('emp_positions.date_finish', '=', null)
			->where('emp_positions.status', '=', 1);
		})
		->leftJoin('positions', 'emp_positions.id_position', '=', 'positions.id')
		->leftJoin('departments', 'emp_positions.id_department', '=', 'departments.id')
		->leftJoin('emp_insurances', 'emp_profiles.id', '=', 'emp_insurances.id_emp')
		->leftJoin('emp_salaries', function($join){
			$current_date =  Carbon::now()->format('Y-m-d');
			$join->on('emp_profiles.id', '=', 'emp_salaries.id_emp')
			->where([
				['emp_salaries.applied_finish','=', null],
				['emp_salaries.applied_begin', '<=', $current_date],
			])->orWhere([
				['emp_salaries.applied_finish', '>', $current_date],
				['emp_salaries.applied_begin', '<=', $current_date],
			]);
		})
		->select('emp_profiles.id','emp_profiles.emp_code', 'emp_profiles.name', 'positions.position', 'departments.department', 'emp_insurances.insurance_code', 'emp_insurances.date_begin as date_begin_insurance', 'emp_salaries.pay_scale_code', 'emp_salaries.pay_range','emp_salaries.applied_begin as salary_begin', 'emp_salaries.applied_finish as salary_finish')
		->orderBy('emp_profiles.id', 'asc')
		->first();

		if($emp->pay_range != null && $emp->pay_scale_code != null){
			$range = $this->getRange($emp->pay_scale_code, $emp->pay_range);
			if($range != null){
				$emp['pay_rate'] = $range->rate;
				$emp['pay_value'] = $range->value;
			}else{
				$emp['pay_rate'] = '';
				$emp['pay_value'] = '';
			}
		}else{
			$emp['pay_rate'] = null;
			$emp['pay_value'] = null;
		}
				
		$allowance = $this->getAllowanceCodeByIdEmp($emp->id);
		$emp['allowance'] = $allowance;
		return $emp;
	}


	/**
	 * get range of pay scale by pay_scale_code
	 */
	function getRange($pay_scale_code, $pay_range)
	{
		$current_date =  Carbon::now()->format('Y-m-d');
		$scale = PayScale::where([
			['pay_scale_code', '=', $pay_scale_code],
			['applied_finish','=', null],
			['applied_begin', '<=', $current_date],
		])->orWhere([
			['pay_scale_code', '=', $pay_scale_code],
			['applied_finish', '>', $current_date],
			['applied_begin', '<=', $current_date],
		])->first();
		$range = json_decode($scale->range);
		foreach ($range as $key => $value) {
			if($value->level == $pay_range){
				return $value;
			}
		}
		return null;
	}


	/**
	 * get current allowance of employee by id_emp
	 */
	public function getAllowanceCodeByIdEmp($id_emp)
	{
		$current_date =  Carbon::now()->format('Y-m-d');

		$code = EmpAllowance::where([
			['id_emp', '=', $id_emp],
			['emp_allowances.applied_finish','=', null],
			['emp_allowances.applied_begin', '<=', $current_date],
		])
		->orWhere([
			['id_emp', '=', $id_emp],
			['emp_allowances.applied_finish', '>', $current_date],
			['emp_allowances.applied_begin', '<=', $current_date],
		])->join('allowances', 'emp_allowances.allowance_code', '=', 'allowances.allowance_code')
		->select('emp_allowances.id', 'allowances.allowance', 'emp_allowances.allowance_code', 'emp_allowances.allowance_level', 'emp_allowances.applied_begin as allowance_begin', 'emp_allowances.applied_finish as allowance_finish')
		->get();
		foreach ($code as $key => $value) {
			$val = $this->getAllowanceValue($value->allowance_code, $value->allowance_level);
			$value['allowance_rate'] = $val->rate;
			$value['allowance_value'] = $val->value;
		}
		return $code;
	}

	function getAllowanceValue($allowance_code, $allowance_level)
	{
		$current_date =  Carbon::now()->format('Y-m-d');
		$allowance = Allowance::where([
			['allowance_code', '=', $allowance_code],
			['applied_finish','=', null],
			['applied_begin', '<=', $current_date],
		])->orWhere([
			['allowance_code', '=', $allowance_code],
			['applied_finish', '>', $current_date],
			['applied_begin', '<=', $current_date],
		])->first();
		$val = json_decode($allowance->value);
		foreach ($val as $key => $value) {
			if($value->level == $allowance_level){
				return $value;
			}
		}
		return null;
	}

	/**
	 * get current pay scale of employee
	 */
	public function getEmpPayScale($id_emp)
	{
		$current_date =  Carbon::now()->format('Y-m-d');
		$scale = EmpSalary::where([
			['id_emp', '=', $id_emp],
			['applied_finish','=', null],
			['applied_begin', '<=', $current_date],
		])->orWhere([
			['id_emp', '=', $id_emp],
			['applied_finish', '>', $current_date],
			['applied_begin', '<=', $current_date],
		])->first();
		return $scale;
	}

	/**
	 * get emp allowance by id
	 */
	public function getEmpAllowanceById($id)
	{
		$allowance = EmpAllowance::find($id);
		return $allowance;
	}

	/**
	 * get list current allowance of employee
	 */
	public function getEmpAllowance($id_emp)
	{
		$current_date =  Carbon::now()->format('Y-m-d');
		$allowance = EmpAllowance::where([
			['id_emp', '=', $id_emp],
			['applied_finish','=', null],
			['applied_begin', '<=', $current_date],
		])->orWhere([
			['id_emp', '=', $id_emp],
			['applied_finish', '>', $current_date],
			['applied_begin', '<=', $current_date],
		])->get();
		return $allowance;
	}

	/**
	 * edit emp's pay scale when something wrong 
	 */
	public function editEmpPayScale($id_emp, $data)
	{

		$scale = $this->getEmpPayScale($id_emp);

		if($scale){
			$scale->pay_scale_code = $data->pay_scale_code;
			$scale->pay_range = $data->pay_range;
			$scale->applied_begin = $data->applied_begin;
			$scale->applied_finish = $data->applied_finish;
			$scale->save();
			return $scale;
		}else{
			return 0;
		}
		return $scale;
	}

	/**
	 * update emp's pay scale when has change
	 */
	public function updateEmpPayScale($id_emp, $data)
	{
		$old = $this->getEmpPayScale($id_emp);
		if($old){
			$old->applied_finish = $data->applied_begin;
			$old->save(); 
		}
		$scale = new EmpSalary;
		$scale->id_emp = $id_emp;
		$scale->pay_scale_code = $data->pay_scale_code;
		$scale->pay_range = $data->pay_range;
		$scale->applied_begin = $data->applied_begin;
		$scale->applied_finish = $data->applied_finish;
		$scale->save();
		return $scale;
	}


	/**
	 * edit emp's allowance when something wrong 
	 */
	public function editEmpAllowance($id, $data)
	{
		$allowance = EmpAllowance::find($id);

		if($allowance){
			$allowance->allowance_code = $data->allowance_code;
			$allowance->allowance_level = $data->allowance_level;
			$allowance->applied_begin = $data->applied_begin;
			$allowance->applied_finish = $data->applied_finish;
			$allowance->note = $data->note;
			$allowance->save();
			$al = Allowance::where('allowance_code', '=', $allowance->allowance_code)->select('allowance')->first();
			$allowance['allowance'] = $al->allowance;
			return $allowance;
		}
		return 0;


		// $current_date =  Carbon::now()->format('Y-m-d');

		// $list = $this->getEmpAllowance($id_emp);
		// foreach ($list as $key => $value) {
		// 	if(array_key_exists($value->allowance_code, $data)){
		// 		$allowance = $data[$value->allowance_code];
		// 		$value->allowance_level = $allowance->allowance_level;
		// 		$value->applied_begin = $allowance->applied_begin;
		// 		$value->save();
		// 	}else{
		// 		$value->applied_finish = $current_date;
		// 		$value->save();
		// 	}
		// }
	}

	/**
	 * update emp's allowance when has change 
	 */
	public function updateEmpAllowance($id, $data)
	{
		$old = EmpAllowance::find($id);
		if($old){
			$old->applied_finish = $data->applied_begin;
			$old->save();
		}
		$allowance = new EmpAllowance;
		$allowance->id_emp = $data->id_emp;
		$allowance->allowance_code = $data->allowance_code;
		$allowance->allowance_level = $data->allowance_level;
		$allowance->applied_begin = $data->applied_begin;
		$allowance->applied_finish = $data->applied_finish;
		$allowance->note = $data->note;
		$allowance->save();
		$al = Allowance::where('allowance_code', '=', $allowance->allowance_code)->select('allowance')->first();
		$allowance['allowance'] = $al->allowance;
		return $allowance;
	}

	/**
	 * delete emp's allowance when update was wrong=>edit emp's allowance last:applied_finish = '';
	 */
	public function deleteEmpAllowance($id){
		$allowance = EmpAllowance::find($id);
		$allowance->delete();
		$last = EmpAllowance::where([
			['allowance_code', '=', $allowance->allowance_code],
			['id_emp', '=', $allowance->id_emp],
		])->orderBy('created_at', 'desc')->first();
		if($last){
			$last->applied_finish = null;
			$last->save();

			$al = Allowance::where('allowance_code', '=', $last->allowance_code)->select('allowance')->first();
			$last['allowance'] = $al->allowance;
			$last['last'] = 'true';
			return $last;
		}
		$allowance['last'] = 'false';
		return $allowance;
	}

	/**
	 * add emp's allowance
	 */
	public function addEmpAllowance($data)
	{
		$allowance = new EmpAllowance;
		$allowance->id_emp = $data->id_emp;
		$allowance->allowance_code = $data->allowance_code;
		$allowance->allowance_level = $data->allowance_level;
		$allowance->applied_begin = $data->applied_begin;
		$allowance->applied_finish = $data->applied_finish;
		$allowance->note = $data->note;
		$allowance->save();
		$al = Allowance::where('allowance_code', '=', $allowance->allowance_code)->select('allowance')->first();
		$allowance['allowance'] = $al->allowance;
		return $allowance;
		// $result = $allowance->join('allowances', 'allowances.allowance_code', '=', 'emp_allowances.allowance_code')->select('emp_allowances.*', 'allowances.allowance')->first();
		// 	return $result;
	}



	/**
	 * edit info emp's insurance
	 */
	public function editEmpInsurance($id_emp, $data)
	{
		$ins = EmpInsurance::where('id_emp', '=', $id_emp)->first();
		if($ins){
			$ins->insurance_code = $data->insurance_code;
			$ins->date_begin = $data->date_begin_insurance;
			$ins->save();
			return $ins;
		}else{
			$insurance = new EmpInsurance;
			$insurance->id_emp = $id_emp;
			$insurance->insurance_code = $data->insurance_code;
			$insurance->date_begin = $data->date_begin_insurance;
			$insurance->save();
			return $insurance;
		}
		// return $ins;
	}

}
