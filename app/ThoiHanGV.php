<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThoiHanGV extends Model
{
    //
    protected $table = "thoi_han_gv";
    protected $fillable = ['TenThoiHan','SoNgay','GiaTien'];
}
