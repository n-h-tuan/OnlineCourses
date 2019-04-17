<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    //
    protected $table = "danh_gia";
    protected $fillable = ['HoaDon_id','TieuDe','NoiDung','Diem'];

    public function user()
    {
        return $this->belongsTo('App\HoaDon','user_id','user_id');
    }

    public function khoa_hoc()
    {
        return $this->belongsTo('App\HoaDon','KhoaHoc_id','KhoaHoc_id');
    }
    public function hoa_don()
    {
        return $this->belongsTo('App\HoaDon','HoaDon_id','id');
    }
}
