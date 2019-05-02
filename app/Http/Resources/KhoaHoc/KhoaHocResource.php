<?php

namespace App\Http\Resources\KhoaHoc;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BaiGiang\BaiGiangCollection;

class KhoaHocResource extends JsonResource
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
            'MangKH' => $this->mang_khoa_hoc->TenMangKH,
            'GiangVien' =>$this->giang_vien->TenGiangVien,
            // 'MangKH_id' => $this->MangKH_id,
            // 'GiangVien_id' => $this->GiangVien_id,
            'HinhAnh' => $this->HinhAnh,
            'TenKH' => $this->TenKH,
            'TomTat' => $this->TomTat,
            'GiaTien' => $this->GiaTien,
            'DanhGia' =>$this->DanhGia,
            'SoLuotXem' => $this->SoLuotXem,
            // 'BaiGiang'=> $this->bai_giang,
        ];
        // return parent::toArray($request);
    }
}
