<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Cookie;

use Illuminate\Http\Request;
use App\User;
use App\Manager\UserManager;
use App\Http\Controllers\Auth\JWTAuth\JwtAuth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, 
            [
                'username'=>'required',
                'password'=>'required|min:3|max:32'
            ],[
                'username.required'=>'Chưa nhập tên đăng nhập',
                'password.required'=>'Chưa nhập mật khẩu',
                'password.min'=>'Mật khẩu không được nhỏ hơn 3 ký tự',
                'password.max'=>'Mật khẩu không được lớn hơn 32 ký tự'
            ]);

        // return response()->json($request);

        if(Auth::attempt(['email'=>$request->username, 'password'=>$request->password])){

            $jwtAuth = new JwtAuth();
            $jwtAuth->allocateAccessToken();

            $user = Auth::user();
            $emp = $user->emp_profile;
            // return response()->json(['request'=>$request->position, 'user'=>$user]);
            if($request->position == UserManager::ADMIN_POSITION){
                if($user->position == UserManager::ADMIN_POSITION){
                    return redirect('admin/user');
                }else{
                    return redirect('login')->with('error', 'Đăng nhập không thành công! Bạn không có quyền đăng nhập dành cho Quản trị viên');
                }
            }elseif ($request->position == UserManager::HRM_POSITION) {
                if($user->position == UserManager::HRM_POSITION){
                    return redirect('hrm/emp/list');
                }else{
                    return redirect('login')->with('error', 'Đăng nhập không thành công! Bạn không có quyền đăng nhập dành cho Quản lý nhân sự');
                }
            }else{
                return redirect('emp/profile');
            }
        }else{
            return redirect('login')->with('error', 'Đăng nhập không thành công!');
        }
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect('login')->with('notify', 'Đã đăng xuất')->withCookie(Cookie::forget('accessToken'));;
    }
}
