<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThanhToan extends Model
{
    //
    protected $table = "thanh_toan";
    protected $fillable = ['HinhThucThanhToan'];
}
