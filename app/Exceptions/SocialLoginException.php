<?php

namespace App\Exceptions;

use Exception;

class SocialLoginException extends Exception
{
    public function render(){
        return response()->json('Email đã tồn tại');
    }
}
