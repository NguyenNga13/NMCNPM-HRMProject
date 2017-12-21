<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Manager\ContractManager;
use App\Model\EmpProfile;
use App\Model\LaborContractType;

class ContractController extends Controller
{
	private $contract_manager;

	public function __construct()
	{
		$this->contract_manager = new ContractManager();
	}

	/**
	 * Lấy danh sách hợp đồng
	 */
	public function getList()
	{
		$contract_list = $this->contract_manager->list();
		$contract_type = LaborContractType::all();
		return view('hrm.contract.list', ['contract_list'=>$contract_list, 'contract_type'=>$contract_type]);
	}

	/**
	 * Lấy chi tiết hợp đồng theo số hợp đồng contract_number
	 */
	public function getDetailByContractNumber($number)
	{
		$contract = $this->contract_manager->getDetailByContractNumber($number);
		return response()->json(['contract'=>$contract, 'id_emp'=>convertIdEmp($contract->emp_profile->id)]);

	}

	/**
	 * Lấy chi tiết hợp đồng theo id
	 */
	public function getDetail($id)
	{
		$contract = $this->contract_manager->detail($id);
		return response()->json(['contract'=>$contract, 'id_emp'=>convertIdEmp($contract->emp_profile->id)]);
		
	}


	/**
	 * Thêm hợp đồng cho nhân viên đã biết bởi mã nhân viên
	 */
	public function getAdd($id_emp)
	{
		$emp = EmpProfile::find($id_emp);
		return response()->json(['id_emp'=>convertIdEmp($emp->id), 'name_emp'=>$emp->name]);
	}

	public function postAdd(Request $request)
	{
		$contract = $this->contract_manager->add($request);
		if($contract == '0'){
			return response()->json(['success'=>0, 'messenger'=>'Định dạng không hỗ trợ']);
		}
		return response()->json($contract);
	}

	/**
	 * Cập nhật thông tin hợp đồng
	 */
	public function putEdit(Request $request, $id)
	{
		$contract = $this->contract_manager->edit($request, $id);
		if($contract == '0'){
			return response()->json(['success'=>0, 'messenger'=>'Định dạng không hỗ trợ']);
		}
		$type = $contract->contract_type;
		return response()->json($contract);
	}

	/**
	 * Xóa hợp đồng
	 */
	public function getDelete($id)
	{
		$contract = $this->contract_manager->delete($id);
		return response()->json($contract);
	}
}
