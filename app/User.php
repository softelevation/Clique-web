<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    const ADMIN_TYPE = '1';
    const USER_TYPE = '0';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile'
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    public function roles()
    {
        /**
        * The roles that belong to the user.
        */
        return $this->belongsToMany('App\Role')->withTimestamps()->withPivot('role_id');
    }


    public function is_user()
    {
        return $this->roles->first()->type == self::USER_TYPE;
    }

    public function is_admin()
    {
       return $this->roles->first()->type == self::ADMIN_TYPE;
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }
    
    public function temp_profile()
    {
        return $this->hasOne('App\TempProfile');
    }

}
