<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Manager\ProfileManager;
use App\Manager\PositionManager;
use App\Manager\DepartmentManager;
use App\Model\LaborContractType;
use App\Manager\NotifyManager;
use App\Manager\PermissionManager;

use App\Http\Controllers\Auth\JWTAuth\JwtAuth;

class ProfileController extends Controller
{
	private $emp_manager;
	private $pos_manager;
	private $dep_manager;
	private $notify_manager;

    public function __construct()
	{
		$this->emp_manager= new ProfileManager();
		$this->pos_manager= new PositionManager();
		$this->dep_manager= new DepartmentManager();
		$this->notify_manager = new NotifyManager();
	}

	/**
	 * Danh sách nhân viên
	 */
	public function getList()
	{
		$list = $this->emp_manager->getList();
		$emp_list = $this->emp_manager->getEmpListByPosition();
		return view('hrm.profile.list', ['emp_position_list'=>$emp_list, 'emp_list'=>$list]);
	}

	/**
	 * Chi tiết nhân viên
	 */
	public function getDetail($id)
	{
		$emp_profile = $this->emp_manager->getProfile($id);
		// $emp = $this->emp_manager->getEmpProfile($id);
		// $emp_current = $this->emp_manager->getEmpPositionCurrent($id);
		$emp_concurrent = $this->emp_manager->getEmpPositionConcurrent($id);
		// $emp_pos_list = $this->emp_manager->getPositionList($id);
		$pos_list = $this->pos_manager->getList();
		$dep_list = $this->dep_manager->getList();
		$contract_type = LaborContractType::all();
		// return view('hrm.profile.detail', ['emp'=>$emp_profile, 'emp_position'=>$emp_current, 'emp_concurrent'=>$emp_concurrent,'emp_pos_list'=>$emp_pos_list, 'pos_list'=>$pos_list, 'dep_list'=>$dep_list]);
		return view('hrm.profile.profile', ['emp'=>$emp_profile, 'emp_concurrent'=>$emp_concurrent, 'pos_list'=>$pos_list, 'dep_list'=>$dep_list, 'contract_type'=>$contract_type]);
	}

	/**
	 * Thêm nhân viên
	 */
	public function getAdd()
	{
		$auth = new JwtAuth();
		$check = $auth->checkPermission(PermissionManager::ID_PERMISSION_CREATE_PROFILE);
		if(!$check){
			return redirect('hrm/emp/list')->with('error', 'Bạn không có quyền tạo hồ sơ nhân viên!');
		}
		

		$pos_list = $this->pos_manager->getList();
		$dep_list = $this->dep_manager->getList();
		$new_code = $this->emp_manager->createEmpCode();
		return view('hrm.profile.add', ['pos_list'=>$pos_list, 'dep_list'=>$dep_list, 'new_code'=>$new_code]);
	}

	/**
	 * Thêm nhân viên
	 */
	public function postAdd(Request $request)
	{
		// $this->validate($request, [
		// 	'profile_number'=>'required|unique:emp_profiles,profile_number',
		// 	'position'=>'required',
		// 	'decided_number'=>'required',
		// 	'identity_card'=>'unique:emp_profiles,identity_card',
		// 	'passport_number'=>'unique:emp_profiles,passport_number'
		// 	], [
		// 	'profile_number.required'=>'Nhập số hồ sơ',
		// 	'position.required'=>'Nhập chức vụ nhân viên',
		// 	'position.required'=>'Nhập số quyết định tuyển dụng/bổ nhiệm',
		// 	'identity_card.unique'=>'Số CMT trùng',
		// 	'passport_number.unique'=>'Số hộ chiếu trùng'
		// 	]);
		// 	
		


		// return response()->json($request);

		$result = $this->emp_manager->addEmpProfile($request);
		if($result)
			return redirect('hrm/emp/detail/'.$result)->with('notify', 'Tạo hồ sơ nhân viên thành công');
		else
			return redirect('hrm/emp/add')->with('error', 'Tạo hồ sơ nhân viên không thành công');
	}

	/**
	 * Sửa hồ sơ nhân viên
	 */
	public function postEdit(Request $request)
	{
		$message = $this->emp_manager->editEmpProfile($request);
		return redirect('hrm/emp/detail/'.invertIdEmp($request->id))->with('notify', $message);
	}

	// public function confirmUpdate($id)
	// {
	// 	$notify = $this->notify_manager->get($id);


	// 	if($type == NotifyManager::NOTIFY_UPDATE_PROFILE){
			
	// 		return view('hrm.profile.update.update_profile');
	// 	}

	// }

}
