<?php

namespace App\Http\Resources\GiangVien;

use Illuminate\Http\Resources\Json\JsonResource;

class GiangVienResource extends JsonResource
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
