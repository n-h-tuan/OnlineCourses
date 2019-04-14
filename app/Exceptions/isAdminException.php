<?php

namespace App\Exceptions;

use Exception;

class isAdminException extends Exception
{
    public function render()
    {
        return response()->json("Bạn không đủ quyền để thực hiện chức năng này");
    }
}
