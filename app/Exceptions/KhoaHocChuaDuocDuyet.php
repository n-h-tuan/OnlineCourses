<?php

namespace App\Exceptions;

use Exception;

class KhoaHocChuaDuocDuyet extends Exception
{
    public function render()
    {
        return response()->json('Khóa học chưa được duyệt');
    }
}
