<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiangVien extends Model
{
    //
    protected $table = "giang_vien";
    protected $fillable = ['user_id','TenGiangVien','TomTat','SoLuongHocVien','SoLuongKhoaHoc','ThoiHanGV_id','NgayHetHan'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function thoi_han_gv()
    {
        return $this->belongsTo('App\ThoiHanGV','ThoiHanGV_id','id');
    }

    public function khoa_hoc()
    {
        return $this->hasMany('App\KhoaHoc','GiangVien_id','id');
    }
    
    public function bai_giang()
    {
        return $this->hasManyThrough('App\BaiGiang','App\KhoaHoc','GiangVien_id','KhoaHoc_id','id');
    }
}
