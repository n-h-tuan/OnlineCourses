<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CauHoi extends Model
{
    //
    protected $table = "cau_hoi";
    protected $fillable = ['BaiGiang_id','user_id','TieuDe','NoiDung','HinhAnh'];
    public function bai_giang()
    {
        return $this->belongsTo('App\BaiGiang','BaiGiang_id','id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
