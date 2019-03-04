<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    //
    protected $table = "danh_gia";

    public function user()
    {
        return $this->belongsTo('App\HoaDon','user_id','user_id');
    }

    public function khoa_hoc()
    {
        return $this->belongsTo('App\HoaDon','khoahoc_id','khoahoc_id');
    }
}
