<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Manager\UserManager;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            $user = Auth::user();
            if($user->position == UserManager::ADMIN_POSITION){
                return $next($request);
            }else{
                return redirect('login')->with('error', 'Bạn không có quyền truy nhập tài nguyên này. Đăng nhập với tư cách Quản trị viên?');
            }
            
        }else{
            return redirect('login')->with('error', 'Chưa đăng nhập');
        }
        
    }
}
