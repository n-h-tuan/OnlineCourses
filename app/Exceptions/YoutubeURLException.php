<?php

namespace App\Exceptions;

use Exception;

class YoutubeURLException extends Exception
{
    public function render()
    {
        return response()->json('Định dạng Youtube Video không chính xác');
    }
}
