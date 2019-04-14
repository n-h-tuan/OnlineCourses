<?php

namespace App\Exceptions;

use Exception;

class NguoiDungChuaMuaKhoaHoc extends Exception
{
    public function render()
    {
        return \response()->json("Bạn chưa mua khóa học này");
    }
}
