<?php

namespace App\Http\Resources\ThoiHanGV;

use Illuminate\Http\Resources\Json\JsonResource;

class ThoiHanGVResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'TenThoiHan' => $this->TenThoiHan,
            'SoNgay' => $this->SoNgay,
            'GiaTien' => $this->GiaTien
        ];
    }
}
