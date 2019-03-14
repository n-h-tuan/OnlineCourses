<?php

namespace App\Exceptions;

use Exception;

class MangKhoaHocKhongDung extends Exception
{
    public function render()
    {
        return \response()->json([
            'error' => 'Mảng Khóa Học không thuộc Thể Loại Khóa Học này',
        ]);
    }
}
