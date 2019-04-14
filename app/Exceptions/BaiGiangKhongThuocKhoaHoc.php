<?php

namespace App\Exceptions;

use Exception;

class BaiGiangKhongThuocKhoaHoc extends Exception
{
    public function render()
    {
        return response()->json("Bài giảng không thuộc khóa học này");
    }
}
