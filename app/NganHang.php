<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NganHang extends Model
{
    protected $table = "ngan_hang";
    protected $fillable = ['TenNganHang'];

    public function tai_khoan_ngan_hang()
    {
        return $this->hasMany('App\TaiKhoanNganHang','NganHang_id','id');
    }
}
