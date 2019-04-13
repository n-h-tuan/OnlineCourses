<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionCustom
{
    public function apiExceptions($request, $ex)
    {
        if($this->isHttpException($ex))
            {
                return $this->HttpException();
            }
            
        if($this->isModelException($ex))
            {
                return $this->ModelException(); 
            }
        return parent::render($request, $ex);
    }

    protected function isModelException($ex)
    {
        return $ex instanceof ModelNotFoundException;
    }

    protected function isHttpException($ex)
    {
        return $ex instanceof NotFoundHttpException;
    }

    protected function HttpException()
    {
        return response()->json([
            'errors' => "Incorrect Http",
        ],404);
    }

    protected function ModelException()
    {
        return response()->json([
            'errors' => "Model Not Found",
        ],404);
    }
}