<?php

namespace App\Http\Resources\KhoaHoc;

use Illuminate\Http\Resources\Json\JsonResource;

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
            // 'mangKH' => $this->mang_khoa_hoc->tenmangKH,
            // 'giangvien' =>$this->giang_vien->TenGiangVien,
            'mangKH_id' => $this->mangKH_id,
            'giangvien_id' => $this->giangvien_id,
            'hinhanh' => $this->hinhanh,
            'tenKH' => $this->tenKH,
            'tomtat' => $this->tomtat,
            'giatien' => $this->giatien,
            'danhgia' =>$this->danhgia,
            'soluotxem' => $this->soluotxem,
        ];
        // return parent::toArray($request);
    }
}
