<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiangVien extends Model
{
    //
    protected $table = "giang_vien";

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function thoi_han_gv()
    {
        return $this->belongsTo('App\ThoiHanGV','thoihanGV_id','id');
    }

    public function khoa_hoc()
    {
        return $this->hasMany('App\KhoaHoc','giangvien_id','id');
    }
    
    public function bai_giang()
    {
        return $this->hasManyThrough('App\BaiGiang','App\KhoaHoc','giangvien_id','khoahoc_id','id');
    }
}
