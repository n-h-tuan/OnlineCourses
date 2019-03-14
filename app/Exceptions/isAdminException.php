<?php

namespace App\Exceptions;

use Exception;

class isAdminException extends Exception
{
    public function render()
    {
        return response()->json([
            'data' => "Bạn không đủ quyền để thực hiện chức năng này",
        ],401);
    }
}
