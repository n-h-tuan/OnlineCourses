<?php

namespace App\Http\Resources\DuyetKhoaHoc;

use Illuminate\Http\Resources\Json\JsonResource;

class DuyetKhoaHocResource extends JsonResource
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
            'id'=>$this->id,
            'GiangVien'=>$this->giang_vien->TenGiangVien,
            'TenKH'=>$this->TenKH,
            'GiaTien'=>$this->GiaTien,
            'BaiGiang'=>$this->bai_giang,
        ];
    }
}
