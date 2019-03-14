<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MangKhoaHoc;


class TheLoaiKhoaHoc extends Model
{
    //
    protected $table = "the_loai_khoa_hoc";
    protected $fillable = ['TenTheLoai'];

    public function mang_khoa_hoc()
    {
        return $this->hasMany('App\MangKhoaHoc','TheLoaiKH_id','id');
    }
    // public function mang_khoa_hoc()
    // {
    //     return $this->hasMany(MangKhoaHoc::class);
    // }
    public function khoa_hoc()
    {
        return $this->hasManyThrough('App\KhoaHoc','App\MangKhoaHoc','TheLoaiKH_id','MangKH_id','id');
    }
}
