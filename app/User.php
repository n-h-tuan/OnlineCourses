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
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $table = "users";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function level()
    {
        return $this->belongsTo('App\Level','level_id','id');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment','user_id','id');
    }

    public function cau_hoi()
    {
        return $this->hasMany('App\CauHoi','user_id','id');
    }
    
    public function hoa_don()
    {
        return $this->hasMany('App\HoaDon','user_id','id');
    }
}
