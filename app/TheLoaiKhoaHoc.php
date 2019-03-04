<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoaiKhoaHoc extends Model
{
    //
    protected $table = "the_loai_khoa_hoc";

    public function mang_khoa_hoc()
    {
        return $this->hasMany('App\MangKhoaHoc','theloaiKH_id','id');
    }
    public function khoa_hoc()
    {
        return $this->hasManyThrough('App\KhoaHoc','App\MangKhoaHoc','theloaiKH_id','mangKH_id','id');
    }
}
