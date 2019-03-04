<?php

namespace App\Http\Resources\CodeKhoaHoc;

use Illuminate\Http\Resources\Json\JsonResource;

class CodeKHResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
