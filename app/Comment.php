<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = "comment";

    public function user()
    {
        return $this->belongsTo('App/User','user_id','id');
    }

    public function khoa_hoc()
    {
        return $this->belongsTo('App\KhoaHoc','khoahoc_id','id');
    }
}
