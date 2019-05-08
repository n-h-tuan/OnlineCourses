<?php

namespace App\Http\Resources\KhoaHoc;

use Illuminate\Http\Resources\Json\JsonResource;

class KhoaHocCollection extends JsonResource
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
            'MangKH_id' => $this->MangKH_id,
            'TenKH' => $this->TenKH,
            'GiaTien' => $this->GiaTien,
            'HinhAnh' =>$this->HinhAnh,
            'GiangVien_id' => $this->giang_vien->TenGiangVien,
        ];
    }
}
