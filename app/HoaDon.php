<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    //
    protected$table = "hoa_don";

    public function khoa_hoc()
    {
        return $this->belongsTo('App\KhoaHoc','khoahoc_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
