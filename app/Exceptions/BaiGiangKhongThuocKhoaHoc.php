<?php

namespace App\Exceptions;

use Exception;

class BaiGiangKhongThuocKhoaHoc extends Exception
{
    public function render()
    {
        return response()->json([
            'data'=>"Bài giảng không thuộc khóa học này",
        ],401);
    }
}
