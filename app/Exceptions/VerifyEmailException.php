<?php

namespace App\Exceptions;

use Exception;

class VerifyEmailException extends Exception
{
    public function render()
    {
        return \response()->json('Vui lòng xác thực email của bạn.');
    }
}
