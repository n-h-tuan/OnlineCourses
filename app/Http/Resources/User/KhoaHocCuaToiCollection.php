<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class KhoaHocCuaToiCollection extends JsonResource
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
            'TenKH' => $this->TenKH,
            'GiaTien' => $this->GiaTien,
            'HinhAnh' =>$this->HinhAnh,
            'GiangVien_id' => $this->GiangVien_id,
        ];
    }
}
