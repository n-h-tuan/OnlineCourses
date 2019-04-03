<?php

namespace App\Exceptions;

use Exception;

class CommentKhongThuocUser extends Exception
{
    public function render()
    {
        return response()->json([
            'data' => "Bạn không đủ quyền thực hiện chức năng này",
        ],401);
    }
}
