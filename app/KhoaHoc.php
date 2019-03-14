<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhoaHoc extends Model
{
    //
    protected $table = "khoa_hoc";
    protected $fillable = ['MangKH_id','GiangVien_id','HinhAnh','TenKH','TomTat','GiaTien','DanhGia','SoLuotXem'];
    public function giang_vien()
    {
        return $this->belongsTo('App\GiangVien','GiangVien_id','id');
    }

    public function mang_khoa_hoc()
    {
        return $this->belongsTo('App\MangKhoaHoc','MangKH_id','id');
    }

    public function hoa_don()
    {
        return $this->hasMany('App\HoaDon','KhoaHoc_id','id');
    }
    
    public function comment()
    {
        return $this->hasMany('App\Comment','KhoaHoc_id','id');
    }

    public function bai_giang()
    {
        return $this->hasMany('App\BaiGiang','KhoaHoc_id','id');
    }

    public function code_KH()
    {
        return $this->hasMany('App\CodeKhoaHoc','KhoaHoc_id','id');
    }
}
