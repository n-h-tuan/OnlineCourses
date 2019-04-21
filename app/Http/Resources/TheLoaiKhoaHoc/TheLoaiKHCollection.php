<?php

namespace App\Http\Resources\TheLoaiKhoaHoc;

use Illuminate\Http\Resources\Json\JsonResource;

class TheLoaiKHCollection extends JsonResource
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
            'TenTheLoai' =>$this->TenTheLoai,
        ];
    }
}
