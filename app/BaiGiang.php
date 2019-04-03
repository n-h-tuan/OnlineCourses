<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaiGiang extends Model
{
    //
    protected $table = "bai_giang";
    protected $fillable = ['KhoaHoc_id','TenBaiGiang','MoTa','EmbededURL'];
    public function khoa_hoc()
    {
        return $this->belongsTo('App\KhoaHoc','KhoaHoc_id','id');
    }
    public function cau_hoi()
    {
        return $this->hasMany('App\CauHoi','BaiGiang_id','id');
    }
}
