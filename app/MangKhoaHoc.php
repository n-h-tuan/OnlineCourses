<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MangKhoaHoc extends Model
{
    //
    protected $table = "mang_khoa_hoc";

    public function the_loai_KH()
    {
        return $this->belongsTo('App\TheLoaiKH','theloaiKH_id','id');
    }

    public function khoa_hoc()
    {
        return $this->hasMany('App\KhoaHoc','mangKH_id','id');
    }
}
