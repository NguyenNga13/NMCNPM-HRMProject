<?php

namespace App\Http\Controllers\Hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Model\EmpPosition;
use App\Model\EmpProfile;
use App\Model\LaborContractType;

use App\Manager\ProfileManager;
use App\Manager\PositionManager;
use App\Manager\DepartmentManager;
use App\Manager\NotifyManager;
use App\Manager\UserManager;
use App\Manager\EmpUpdateProfileManager;
use App\Manager\RelativesManager;
use App\Manager\DegreeManager;
use App\Manager\EmpPositionManager;
use App\Manager\ContractManager;
use App\Manager\PermissionManager;

use App\Manager\AllowanceManager;
use App\Manager\InsuranceManager;
use App\Manager\PayScaleManager;

use App\Http\Controllers\Auth\JWTAuth\JwtAuth;

class HrmController extends Controller
{
	private $emp_manager;
	private $pos_manager;
	private $dep_manager;
	private $notify_manager;
	private $user_manager;
	private $emp_update_manager;
	private $relatives_manager;
	private $degree_manager;
	private $emp_pos_manager;
	private $contract_manager;
	private $allowance_manager;
	private $insurance_manager;
	private $payscale_manager;



	public function __construct()
	{
		$this->emp_manager= new ProfileManager();
		$this->relatives_manager = new RelativesManager();
		$this->degree_manager= new DegreeManager();
		$this->emp_pos_manager = new EmpPositionManager();
		$this->contract_manager = new ContractManager();

		$this->pos_manager= new PositionManager();
		$this->dep_manager= new DepartmentManager();
		$this->notify_manager = new NotifyManager();
		$this->user_manager = new UserManager();
		$this->emp_update_manager = new EmpUpdateProfileManager();

		$this->allowance_manager = new AllowanceManager();
		$this->insurance_manager = new InsuranceManager();
		$this->payscale_manager = new PayScaleManager();
	}


	public function testPermission()
	{
		// $auth = new Authorization();
		// $auth->issueToken();
		// $accessToken = $auth->getAccessToken();
		// $data = $auth->getUserData();
		// $permission = $auth->getUserPermission();
		// return response()->json(['access_token'=>$accessToken, 'data'=>$data, 'permission'=>$permission]);
	}

	public function test()
	{
		$auth = new JwtAuth();
		$data = $auth->getUserData();
		return response()->json($data);
	}

	/**
     * confirm update from employee
     *
     * @param string        $jwt            The JWT
     * @return object The JWT's payload as a PHP object
     *
     */
	public function confirmUpdate($id)
	{
		$hrm = Auth::user();
		$check = $this->user_manager->checkUserPermission($hrm->id, PermissionManager::ID_PERMISSION_CONFIRM_UPDATE_PROFILE);
		if($check){
			$notify = $this->notify_manager->get($id);
			if($notify->type == NotifyManager::NOTIFY_UPDATE_PROFILE){
				$user = $this->user_manager->getUser($notify->from);
				$profile = $this->emp_manager->getProfile($user->id_emp);

			// $profile = $user->emp_profile()->first();

				$update = $notify->emp_update_profile()->first();
				$content = json_decode($update->content);
				$confirmed_by = $notify->emp_update_profile()->first()->confirmed_by;

				if($confirmed_by){
					$confirmer = $this->user_manager->getUser($confirmed_by);
					$confirmed_by = $confirmer->emp_profile->emp_code;
				}

				return view('hrm.profile.update.update_profile', ['notify_update'=>$notify, 'confirmed_by'=>$confirmed_by, 'profile'=>$profile, 'update'=>$content]);
			}
		}else{
			return redirect('hrm/emp/list')->with('error', 'Bạn không có quyền xác nhận cập nhật hồ sơ cá nhân');
		}
		
	}

	public function confirmUpdateProfile(Request $request)
	{
		$hrm = Auth::user();
		$check = $this->user_manager->checkUserPermission($hrm->id, PermissionManager::ID_PERMISSION_CONFIRM_UPDATE_PROFILE);
		if($check){
			$profile = $this->emp_manager->updateByEmp($request);
			if($profile){
				$notify = $this->notify_manager->seen($request->id_notify);
				$update = $this->emp_update_manager->accepted($notify->id_update, 3);

				return redirect('hrm/emp/detail/'.$profile->id);
			}

		}else{
			return redirect('hrm/emp/list')->with('error', 'Bạn không có quyền xác nhận cập nhật hồ sơ cá nhân');
		}
	}

	public function postSendMessage(Request $request)
	{
		$hrm = Auth::user();
		$check = $this->user_manager->checkUserPermission($hrm->id, PermissionManager::ID_PERMISSION_CONFIRM_UPDATE_PROFILE);
		if($check){
			$seen = $this->notify_manager->seen($request->id_notify);
			$message = $request->message;

			if($request->type == 'reject'){
				$update = $this->emp_update_manager->confirm($request->for, $hrm->id, EmpUpdateProfileManager::UPDATE_STATUS_REJECT);
				if($request->message == ''){
					$message = 'Yêu cầu cập nhật hồ sơ cá nhân lúc '.$update->created_at.' bị từ chối';
				}
			}else{
				$update = $this->emp_update_manager->confirm($request->for, $hrm->id, EmpUpdateProfileManager::UPDATE_STATUS_LATER);
				if($request->message == ''){
					$message = 'Yêu cầu cập nhật hồ sơ cá nhân lúc '.$update->created_at.' đang chờ duyệt';
				}
			}

			$data = ['type'=>NotifyManager::NOTIFY_MAIL, 'from'=>$hrm->id, 'to'=>$request->to,'id_update'=> $request->for, 'id_mail'=>null, 'notify'=>$message];
			$notify = $this->notify_manager->add($data);

			return response()->json(['response_code'=>1, 'data'=>$notify, 'confirmed_by'=>$hrm->emp_profile->emp_code]);

		}else{
			return response()->json(['response_code'=>-1, 'data'=>'Bạn không có quyền xác nhận cập nhật hồ sơ cá nhân']);
		}
	}



	/**
	 * get list position and department
	 */
	public function getPosDept()
	{
		$pos_list = $this->pos_manager->getList();
		$dep_list = $this->dep_manager->getList();
		return response()->json(['positions'=>$pos_list, 'departments'=>$dep_list]);
	}

	/**
	 * get salary source: pay scale + allowance + insurance 
	 */
	public function getSalarySource()
	{
		$scale = $this->payscale_manager->getListPayScale();
		$allowance = $this->allowance_manager->getListAllowance();
		$insurance = $this->insurance_manager->getListInsurance();
		return response()->json(['scale'=>$scale, 'allowance'=>$allowance, 'insurance'=>$insurance]);

	}








	 /**
	 * Danh sách chức vụ
	 */
	 public function getPositionList()
	 {
	 	$pos_list = $this->pos_manager->getList();

	 	return view('hrm.organize.position.list', ['pos_list'=>$pos_list]);
	 }

    /**
     * Thêm chức vụ
     */
    public function postAddPosition(Request $request)
    {
    	$result = $this->pos_manager->add($request);
    	if($result)
    		return redirect('hrm/organize/pos_list')->with('notify', 'Thêm thành công');
    	else
    		return redirect('hrm/organize/pos_list')->with('notify', 'Thêm thất bại');

    }

    /**
     * Sửa chức vụ
     */
    public function postEditPosition(Request $request)
    {
    	$this->pos_manager->edit($request);
    	return redirect('hrm/organize/pos_list')->with('notify', 'Sửa thành công thông tin chức vụ');
    }

    /**
     * Xóa chức vụ
     */
    public function getDeletePosition($id)
    {
    	$this->pos_manager->delete($id);
    	return redirect('hrm/organize/pos_list')->with('notify', 'Xóa thành công');
    }



    /**
	 * Danh sách phòng ban
	 */
    public function getDepartmentList()
    {
    	$dep_list = $this->dep_manager->getList();

    	return view('hrm.organize.department.list', ['dep_list'=>$dep_list]);
    }

	/**
	 * Chi tiết phòng ban
	 */
	public function getDepartmentDetail($id)
	{
		$dep_list = $this->dep_manager->getList();
		$dep = $this->dep_manager->getDetail($id);
		$emp_list = $this->dep_manager->getEmpList($id);
		
		return view('hrm.organize.department.detail', ['dep_list'=>$dep_list, 'dep_info'=>$dep, 'emp_list'=>$emp_list]);
	}

	/**
	 * Thêm phòng ban
	 */
	public function postAddDepartment(Request $request)
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
	public function postEditDepartment(Request $request)
	{
		$this->dep_manager->edit($request);
		return redirect('hrm/organize/dep_detail/'.$request->id)->with('notify', 'Sửa thành công thông tin phòng ban');
	}

	/**
	 * Xóa phòng ban
	 */
	public function getDeleteDepartment($id)
	{
		$this->dep_manager->delete($id);
		return redirect('hrm/organize/dep_list')->with('notify', 'Xóa thành công');
	}








}
