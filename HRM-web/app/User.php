<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function access()
    // {
    //     return $this->belongsTo('App\Model\Access', 'id_access', 'id');
    // }

    // public function empProfile()
    // {
    //     return $this->belongsTo('App\Model\EmpProfile', 'name', 'id');
    // }

    public function role()
    {
        return $this->belongsToMany('App\Model\Role', 'role_users', 'id_user', 'id_role');
    }

    public function emp_profile()
    {
        return $this->belongsTo('App\Model\EmpProfile', 'id_emp', 'id');
    }

    public function role_user()
    {
        return $this->hasMany('App\Model\RoleUser', 'id_user', 'id');
    }

    public function emp_update_profile()
    {
        return $this->hasMany('App\Model\EmpUpdateProfile', 'confirmed_by', 'id');
    }

    public function notify_send()
    {
        return $this->hasMany('App\Model\Notify', 'from', 'id');
    }

}
