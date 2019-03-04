<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CauHoi extends Model
{
    //
    protected $table = "cau_hoi";

    public function bai_giang()
    {
        return $this->belongsTo('App\BaiGiang','baigiang_id','id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\HoaDon','user_id','user_id');
    }
}
