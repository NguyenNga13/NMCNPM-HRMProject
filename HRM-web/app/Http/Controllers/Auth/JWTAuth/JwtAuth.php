<?php

namespace App\Http\Controllers\Auth\JWTAuth;

use App\Http\Controllers\Auth\JWTAuth\Jwt;
use Auth;
use App\Manager\UserManager;

use Cookie;

/**
* 
*/
class JwtAuth
{
	private $secret = "";
	
	function __construct()
	{
		if(!Auth::check()){
			// Cookie::queue(Cookie::forget('accessToken'));
		}else{
			$this->secret = Auth::user()->aes_key;
		}
		// 
	}

	/**
	 * allocation access token
	 * 
	 */
	public function allocateAccessToken()
	{
		if(Auth::check()){

			$accessToken = $this->getAccessToken();

			if(!isset($accessToken) || (isset($accessToken) && $this->checkExpire() == true)){
				$user 		= Auth::user();

				$user_manager = new UserManager();
				$permission = $user_manager->getIdPermissionOfUser($user->id);

				$data = array(
					'iss'		=>	'hrm.demo.com',
					'id'		=>	$user->id,
					'name'		=>	$user->name,
					'permission'=>	$permission,
					'expire'	=>	time() + 3600,
				);

				$jwt = Jwt::Instance();
				$accessToken = $jwt->encode($data, $this->secret);
				$this->setAccessToken($accessToken);
				$accessToken = $this->getAccessToken();
			}
		}
	}

	/**
	 * check duration 
	 * @return boolean true if access token was expried
	 *                 false if access token is activing
	 */
	public function checkExpire()
	{
		$data = $this->getUserData();
		$expire = $data->expire;
		if(time() - $expire >= 0){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * get access token from cookie
	 * @return $accessToken
	 */
	public function getAccessToken()
	{
		$accessToken = isset($_COOKIE['accessToken']) ? $_COOKIE['accessToken'] :null;
		return $accessToken;
	}

	/**
	 * set access token to cookie
	 * @param  $accessToken 
	 */
	public function setAccessToken($accessToken)
	{
		setcookie('accessToken', $accessToken, time() + 3600, '/');
		$_COOKIE['accessToken'] = $accessToken;
	}


	/**
	 * get user's data
	 * @return $userData
	 */
	public function getUserData()
	{
		$accessToken = $this->getAccessToken();
		if(isset($accessToken)){
			$jwt = Jwt::Instance();
			$data = $jwt->decode($accessToken, $this->secret, array('HS256'));
			return $data;
		}

	}

	/**
	 * get user's permissions
	 * @return [] permission
	 */
	public function getUserPermission()
	{
		$data = $this->getUserData();
		$permission = ($data->permission);
		return $permission;
	}

	/**
	 * check permission are granted to user
	 * @param  $id_permission id of permission
	 * @return [boolean]      return true if permission are granted to user or access token are expire and return false if not
	 */
	public function checkPermission($id_permission)
	{
		$permission = $this->getUserPermission();
		if((!$this->checkExpire()) ){
			foreach ($permission as $key => $value) {
				if($id_permission == $value->id){
					return true;
				}
			}
		}else{
			return false;
		}
	}
	

}

?>