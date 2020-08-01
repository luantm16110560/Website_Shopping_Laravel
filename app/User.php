<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps=false;
    protected $fillable = [
        'name', 'email', 'phone','address','status','provider', 'provider_id','user_city'
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
    protected $casts = [
        'email_verified_at' => 'datetime',
        'cus_infor'=>'array'
    ];
    public function like()
    {
        return $this->hasMany('App\Like');
    }
    public function user_review()
    {
        return $this->hasMany('App\User_Review');
    }
    public function listcard()
    {
        return $this->hasMany('App\ListCard');
    }
}
