<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaiGiang extends Model
{
    //
    protected $table = "bai_giang";
    public function khoa_hoc()
    {
        return $this->belongsTo('App\KhoaHoc','khoahoc_id','id');
    }
    public function cau_hoi()
    {
        return $this->hasMany('App\CauHoi','baigiang_id','id');
    }
}
