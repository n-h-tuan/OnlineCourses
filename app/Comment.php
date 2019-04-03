<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = "comment";
    protected $fillable = ['user_id','KhoaHoc_id','NoiDung'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function khoa_hoc()
    {
        return $this->belongsTo('App\KhoaHoc','KhoaHoc_id','id');
    }
}
