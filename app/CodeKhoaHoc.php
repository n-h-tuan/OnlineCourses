<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeKhoaHoc extends Model
{
    protected $table = "code_khoa_hoc";

    public function khoa_hoc()
    {
        return $this->belongsTo('App\KhoaHoc','khoahoc_id','id');
    }
}
