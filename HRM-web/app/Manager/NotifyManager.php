<?php
namespace App\Manager;

use App\Model\Notify;
use App\Manager\UserManager;
use App\Manager\PermissionManager;


/**
* Class quản lý thông báo
*/
class NotifyManager
{
	
	const NOTIFY_UPDATE_PROFILE = 1;
	const NOTIFY_UPDATE_RELATIVES = 2;
	const NOTIFY_UPDATE_SPECIALIZED = 3;
	const NOTIFY_UPDATE_LANGUAGE = 4;
	const NOTIFY_MAIL = 5;

	const TYPE_UPDATE_PROFILE = 'profile';
	const TYPE_UPDATE_RELATIVES = 'relatives';
	const TYPE_UPDATE_LANGUAGE = 'language';
	const TYPE_UPDATE_SPECIALIZED = 'specialized';

	
	function __construct()
	{
		# code...
	}

	public function add($data)
	{
		if(!empty($data)){
			$notify = new Notify;
			$notify->type = $data['type'];
			$notify->from = $data['from'];
			$notify->to = $data['to'];
			$notify->id_update = $data['id_update'];
			$notify->id_mail = $data['id_mail'];
			$notify->notify = $data['notify'];
			$notify->save();
			return $notify;
		}
		return null;
	}

	public function addNotify($type, $from, $to, $id_update, $notify)
	{
		$notify = new Notify;
		$notify->type = (int)$type;
		$notify->from = (int)$from;
		$notify->to = (int)$to;
		$notify->id_update = (int)$id_update;
		$notify->notify = $notify;
		$notify->save();
		return $notify;

	}

	public function get($id)
	{
		$notify = Notify::where('id', '=' ,$id)->first();
		return $notify;
	}

	public function seen($id){
		$notify = Notify::find($id);
		$notify->status = 1;
		$notify->save();
		return $notify;
	}
	public function getNotifyForEmp($id)
	{
		$notify = Notify::where('to', '=', $id)
		->where('status', '=', 0)
		->leftJoin('users', 'notifies.from', '=', 'users.id')
		->leftJoin('emp_profiles', 'users.name', '=', 'emp_profiles.emp_code')
		->select('notifies.*', 'users.email', 'emp_profiles.name', 'emp_profiles.photo_card')
		->orderBy('created_at', 'DESC')
		->get();
		return $notify;
	}

	public function getNotifyForHrm($id_user)
	{
		$user_manager = new UserManager();
		$notify_update = [];
		if($user_manager->checkUserPermission($id_user, PermissionManager::ID_PERMISSION_CONFIRM_UPDATE_PROFILE)){
			$notify_update = Notify::where('status', '=', 0)
		->whereIn('type',[ NotifyManager::NOTIFY_UPDATE_PROFILE, NotifyManager::NOTIFY_UPDATE_LANGUAGE, NotifyManager::NOTIFY_UPDATE_SPECIALIZED,  NotifyManager::NOTIFY_UPDATE_RELATIVES])
		->leftJoin('users', 'notifies.from', '=', 'users.id')
		->leftJoin('emp_profiles', 'users.name', '=', 'emp_profiles.emp_code')
		->select('notifies.*', 'emp_profiles.emp_code', 'emp_profiles.name', 'emp_profiles.photo_card')
		->orderBy('created_at', 'DESC');

		}
		$notify = Notify::where('type', '=', '')
		->leftJoin('users', 'notifies.from', '=', 'users.id')
		->leftJoin('emp_profiles', 'users.name', '=', 'emp_profiles.emp_code')
		->select('notifies.*', 'emp_profiles.emp_code', 'emp_profiles.name', 'emp_profiles.photo_card')
		->orderBy('created_at', 'DESC')
		->union($notify_update)
		->get();




		// $notify = Notify::where('status', '=', 0)
		// ->whereIn('type',[ NotifyManager::NOTIFY_UPDATE_PROFILE, NotifyManager::NOTIFY_UPDATE_LANGUAGE, NotifyManager::NOTIFY_UPDATE_SPECIALIZED,  NotifyManager::NOTIFY_UPDATE_RELATIVES])
		// ->leftJoin('users', 'notifies.from', '=', 'users.id')
		// ->leftJoin('emp_profiles', 'users.name', '=', 'emp_profiles.emp_code')
		// ->select('notifies.*', 'emp_profiles.emp_code', 'emp_profiles.name', 'emp_profiles.photo_card')
		// ->orderBy('created_at', 'DESC')
		// ->get();
		return $notify;
	}

	/**
	 * get notify of user by id_user
	 */
	public function getNotify($id_user)
	{
		$user_manager = new UserManager();
		$notify_update = [];
		if($user_manager->checkUserPermission($id_user, PermissionManager::ID_PERMISSION_CONFIRM_UPDATE_PROFILE)){
			$notify_update = Notify::where('status', '=', 0)
		->whereIn('type',[ NotifyManager::NOTIFY_UPDATE_PROFILE, NotifyManager::NOTIFY_UPDATE_LANGUAGE, NotifyManager::NOTIFY_UPDATE_SPECIALIZED,  NotifyManager::NOTIFY_UPDATE_RELATIVES])
		->leftJoin('users', 'notifies.from', '=', 'users.id')
		->leftJoin('emp_profiles', 'users.id_emp', '=', 'emp_profiles.id')
		->select('notifies.*', 'emp_profiles.emp_code', 'emp_profiles.name', 'emp_profiles.photo_card');
		}

		// select other notify with permission here 
		$notify_create_user = [];

		//select personal notify
		$notify = Notify::where('to', '=', $id_user)
		->where('status', '=', 0)
		->leftJoin('users', 'notifies.from', '=', 'users.id')
		->leftJoin('emp_profiles', 'users.id_emp', '=', 'emp_profiles.id')
		->select('notifies.*', 'emp_profiles.emp_code', 'emp_profiles.name', 'emp_profiles.photo_card');
		if(count($notify_update) >0){
			$notify->union($notify_update);
		}
		return $notify->orderBy('created_at', 'DESC')->get();

	}


}