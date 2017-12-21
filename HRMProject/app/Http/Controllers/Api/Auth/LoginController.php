<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Crypt\AESCipher;


class LoginController extends Controller
{

	private $client;

	public function __construct()
	{
		$this->client = Client::find(1);
	}
	public function login(Request $request)
	{

		$this->validate($request, [
			'username' =>'required',
			'password' =>'required'
		]);

		$username = request('username');
		$userpassword = request('password');

		$user = User::where('email', '=', $username)->first();
		$key_password = $user->aes_key; //get aes key of user
		$password = AESCipher::decrypt($key_password, $userpassword); //decrypt password of request from client
		// $key_password = decrypt($user->password);

		// $password = AESCipher::decrypt($key_password, $userpassword);


		$params = [
			'grant_type' => 'password',
			'client_id' => $this->client->id,
			'client_secret' => $this->client->secret,
			'username' => $username,
			'password' => $password,
			'scope' => '*'
		];

		$request->request->add($params);

		$proxy = Request::create('oauth/token', 'POST');

		return Route::dispatch($proxy);



	}

	public function refresh(Request $request)
	{
		$this->validate($request, [
			'refresh_token' => 'required'
		]);

		$params = [
			'grant_type' => 'refresh_token',
			'client_id' => $this->client->id,
			'client_secret' => $this->client->secret,
			'username' => request('username'),
			'password' => request('password')
		];

		$request->request->add($params);

		$proxy = Request::create('oauth/token', 'POST');

		return Route::dispatch($proxy);

	}

	public function logout()
	{
		$accessToken = Auth::user()->token();
		DB::table('oauth_refresh_tokens')
			->where('access_token_id', $accessToken->id)
			->update(['revoked'=>true]);
		$accessToken->revoke();
		return response()->json(["token"=>$accessToken], 204);
	}
}
