<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeKhoaHoc extends Model
{
    protected $table = "code_khoa_hoc";
    protected $fillable = ['code','KhoaHoc_id','TrangThai'];
    public function khoa_hoc()
    {
        return $this->belongsTo('App\KhoaHoc','KhoaHoc_id','id');
    }

    public function hoa_don()
    {
        return $this->hasOne('App\HoaDon','MaCode_id','id');
    }
}
