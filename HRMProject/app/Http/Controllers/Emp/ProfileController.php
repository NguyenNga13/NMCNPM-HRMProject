<?php

namespace App\Http\Controllers\Emp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Manager\ProfileManager;
use App\Manager\PositionManager;
use App\Manager\DepartmentManager;
use App\Manager\EmpUpdateProfileManager;
use App\Manager\NotifyManager;
use App\Model\LaborContractType;

class ProfileController extends Controller
{
	private $emp_manager;
	private $pos_manager;
	private $dep_manager;
	private $emp_update_manager;
	private $notify_manager;



	

	// const NOTIFY_UPDATE = 1;
	// const NOTIFY_MAIL = 2;

	public function __construct()
	{
		$this->emp_manager= new ProfileManager();
		$this->pos_manager= new PositionManager();
		$this->dep_manager= new DepartmentManager();
		$this->emp_update_manager = new EmpUpdateProfileManager();
		$this->notify_manager = new NotifyManager();
	}

	public function getProfile()
	{
		if(Auth::check()){
			$user = Auth::user();
			$emp = $this->emp_manager->getProfile($user->id_emp);
			$pos_list = $this->pos_manager->getList();
			$dep_list = $this->dep_manager->getList();

    	// $profile = Auth::user()->emp_profile()->get();
    	// return response()->json(['data'=>$profile], 200, [], JSON_NUMERIC_CHECK);

			return view('emp.profile.profile', ['emp'=>$emp, 'pos_list'=>$pos_list, 'dep_list'=>$dep_list]);
			// return response()->json(['emp'=>$emp, 'pos_list'=>$pos_list, 'dep_list'=>$dep_list]);
		}else{
			return redirect('login')->with('notify', "Chua dang nhap");
		}

	}


	public function postUpdateProfile(Request $request)
	{
		$this->validate($request, 
			['confirm'=>'required',
		], [
			'confirm.required'=>'Bạn cần xác nhận trước khi cập nhật',
		]);
		if(Auth::check()){
			$user = Auth::user();
			$update = $this->emp_update_manager->add($user->id, EmpUpdateProfileManager::UPDATE_PROFILE, $request);
			$data = ['type'=>NotifyManager::NOTIFY_UPDATE_PROFILE, 'from'=>$user->id, 'to'=>null,'id_update'=> $update->id, 'id_mail'=>null, 'notify'=>"Gửi yêu cầu cập nhật thông tin cá nhân"];
			$notify = $this->notify_manager->add($data);
			if($update){
				return redirect('emp/profile')->with('notify', "Yêu cầu cập nhật hồ sơ cá nhân đã được gửi đi. Bạn có thể tiếp tục hoạt động trong trang hồ sơ như bình thường.");
			}else{
				return redirect('emp/profile')->with('notify', "Gửi yêu cầu cập nhật hồ sơ không thành công. Bạn có thể thao tác lại.");
			}

		}else{
			return redirect('login')->with('Bạn chưa đăng nhập');
		}



	}
}
