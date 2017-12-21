<?php
namespace App\Manager;

use App\Model\EmpSpecialized;
use App\Model\EmpLaborContract;

/**
* Class quản lý hợp đồng
*/
class ContractManager
{

	
	function __construct()
	{
	}

	public function list()
	{
		$list = EmpLaborContract::all();
		return $list;
	}

	public function detail($id)
	{
		$contract = EmpLaborContract::find($id);
		return $contract;
	}

	public function getDetailBycontractNumber($number)
	{
		$contract = EmpLaborContract::where('contract_number', '=', $number)->first();
		return $contract;
	}

	public function add($request)
	{
		if(!empty($request)){
			$contract = new EmpLaborContract;
			$contract->id_emp = invertIdEmp($request->id_emp);
			$contract->contract_number = $request->contract_number;
			$contract->original_contract_number = $request->original_contract_number;
			$contract->classify = $request->classify;
			$contract->decided_number = $request->decided_number;
			$contract->id_contract_type = $request->id_contract_type;
			$contract->duration = $request->duration;
			$contract->delegate = $request->delegate;
			$contract->date_signed = $request->date_signed;
			$contract->date_begin = $request->date_begin;
			$contract->date_finish = $request->date_finish;
			$contract->salary = $request->salary;
			// $contract->content = 

			if($request->hasFile('content')){
				$file = $request->file('content');

				$format = $file->getClientOriginalExtension();
				if($format != 'pdf' && $format != 'doc' && $format != 'txt')
				{
					return 0;
				}

				// $doc = $file->getClientOriginalName();
				$name = $request->id_emp."_".$request->contract_number;
				if(file_exists("doc/labor_contract".$name)){
					$name = $name.'('.str_random(2).')';
				}
				$file->move("doc/labor_contract/", $name);
				$contract->content = $name;
			}
			$contract->note = $request->note;
			$contract->save();
			return $contract;
		}
	}


	public function edit($request, $id)
	{
		if(!empty($request))
		{
			$contract = EmpLaborContract::find($id);
			$contract->id_emp = invertIdEmp($request->id_emp);
			$contract->contract_number = $request->contract_number;
			$contract->original_contract_number = $request->original_contract_number;
			$contract->classify = $request->classify;
			$contract->decided_number = $request->decided_number;
			$contract->id_contract_type = $request->id_contract_type;
			$contract->duration = $request->duration;
			$contract->delegate = $request->delegate;
			$contract->date_signed = $request->date_signed;
			$contract->date_begin = $request->date_begin;
			$contract->date_finish = $request->date_finish;
			$contract->salary = $request->salary;

			if($request->hasFile('content')){
				$file = $request->file('content');

				$format = $file->getClientOriginalExtension();
				if($format != 'pdf' && $format != 'doc'  && $format != 'txt')
				{
					return 0;
				}

				// $doc = $file->getClientOriginalName();
				$name = $request->id_emp."_".$request->contract_number;
				if(file_exists("doc/labor_contract".$name)){
					$name = $name.'_'.rand(1, 100);
				}
				$file->move("doc/labor_contract/", $name);
				unlink("doc/labor_contract/".$contract->content);
				$contract->content = $name;
			}
			$contract->note = $request->note;
			$contract->save();
			return $contract;
		}
	}


	public function delete($id)
	{
		$contract = EmpLaborContract::destroy($id);
		return $contract;
	}
}