<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TheLoaiKhoaHoc;

class MangKhoaHoc extends Model
{
    //
    protected $table = "mang_khoa_hoc";
    protected $fillable = ['TheLoaiKH_id','TenMangKH'];

    public function the_loai_khoa_hoc()
    {
        return $this->belongsTo('App\TheLoaiKhoaHoc','TheLoaiKH_id','id');
    }
    // public function the_loai_KH()
    // {
    //     return $this->belongsTo(TheLoaiKhoaHoc::class);
    // }
    public function khoa_hoc()
    {
        return $this->hasMany('App\KhoaHoc','MangKH_id','id');
    }
}
