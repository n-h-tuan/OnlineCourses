<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaiKhoanNganHang extends Model
{
    protected $table = "tai_khoan_ngan_hang";
    protected $fillable = ['user_id','SoTaiKhoan','ChuTaiKhoan','NganHang_id','ChiNhanhNganHang'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function ngan_hang()
    {
        return $this->belongsTo('App\NganHang','NganHang_id','id');
    }
}
