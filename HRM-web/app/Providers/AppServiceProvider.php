<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use App\ACManager\NotifyManager;
use App\Model\Notify;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */



    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        // $notify_manager = new NotifyManager();
        // if(Auth::check()){
        //     $user = Auth::user();
        //     $notify = $notify_manager->getNotify($user->id);
        //     View::share('notify_user', $user);
        // }
        

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
