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
            'MangKH_id' => $this->MangKH_id,
            'TenKH' => $this->TenKH,
            'GiaTien' => $this->ThanhTien,
            'HinhAnh' =>$this->HinhAnh,
            'GiangVien' => $this->giang_vien->TenGiangVien,
        ];
    }
}
