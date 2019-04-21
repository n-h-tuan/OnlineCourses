<?php

namespace App\Http\Resources\MangKhoaHoc;

use Illuminate\Http\Resources\Json\JsonResource;

class MangKHCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'TheLoaiKH_id' => $this->TheLoaiKH_id,
            'TenMangKH' => $this->TenMangKH,
        ];
    }
}
