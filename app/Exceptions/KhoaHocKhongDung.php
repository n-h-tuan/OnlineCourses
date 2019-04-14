<?php

namespace App\Exceptions;

use Exception;

class KhoaHocKhongDung extends Exception
{
    public function render()
    {
        return response()->json('Khóa Học không thuộc Mảng Khóa Học này');
    }
    
}
