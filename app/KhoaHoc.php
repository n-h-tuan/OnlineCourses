<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhoaHoc extends Model
{
    //
    protected $table = "khoa_hoc";

    public function giang_vien()
    {
        return $this->belongsTo('App\GiangVien','giangvien_id','id');
    }

    public function mang_khoa_hoc()
    {
        return $this->belongsTo('App\MangKhoaHoc','mangKH_id','id');
    }

    public function hoa_don()
    {
        return $this->hasMany('App\HoaDon','khoahoc_id','id');
    }
    
    public function comment()
    {
        return $this->hasMany('App\Comment','khoahoc_id','id');
    }

    public function bai_giang()
    {
        return $this->hasMany('App\BaiGiang','khoahoc_id','id');
    }

    public function code_KH()
    {
        return $this->hasMany('App\CodeKhoaHoc','khoahoc_id','id');
    }
}
