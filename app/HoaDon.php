<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    //
    protected$table = "hoa_don";
    protected $fillable = ['KhoaHoc_id','user_id','ThanhToan_id','TongTien','MaCode_id','TrangThai'];
    public function khoa_hoc()
    {
        return $this->belongsTo('App\KhoaHoc','KhoaHoc_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function thanh_toan()
    {
        return $this->belongsTo('App\ThanhToan','ThanhToan_id','id');
    }
    public function code_khoa_hoc()
    {
        return $this->belongsTo('App\CodeKhoaHoc','MaCode_id','id');
    }
    
}
