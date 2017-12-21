<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Manager\UserManager;

class EmployeeLoginMiddleware
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
            if(Auth::user()->position == UserManager::EMPLOYEE_POSITION || Auth::user()->position == UserManager::HRM_POSITION || Auth::user()->position == UserManager::ADMIN_POSITION)
                return $next($request);
            else
                return redirect('login')->with('notify', 'Đăng nhập không hợp lệ');
            $user = Auth::user();//kiểm tra quuyền rồi chuyển hướng đăng nhập

            
        }else{
            return redirect('login')->with('notify', 'Bạn chưa đăng nhập');
        }

    }
}
