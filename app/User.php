<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','level_id','provider','provider_id','HinhAnh',
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

    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

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
    public function giang_vien()
    {
        return $this->hasMany('App\GiangVien','user_id','id');
        // Quan hệ giữa User và GiangVien là 1-1 : 1 User chỉ là 1 Gv và ngược lại.
        // Tuy nhiên phải có User thì mới có GiangVien nên User là cha.
    }
    
}
