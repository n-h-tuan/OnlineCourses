<?php

namespace App\Exceptions;

use Exception;

class CommentKhongThuocUser extends Exception
{
    public function render()
    {
        return response()->json("Bạn không đủ quyền thực hiện chức năng này");
    }
}
