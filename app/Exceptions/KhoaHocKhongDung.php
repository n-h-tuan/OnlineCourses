<?php

namespace App\Exceptions;

use Exception;

class KhoaHocKhongDung extends Exception
{
    public function render()
    {
        return response()->json([
            'error' => 'Khóa Học không thuộc Mảng Khóa Học này',
        ],401);
    }
    
}
