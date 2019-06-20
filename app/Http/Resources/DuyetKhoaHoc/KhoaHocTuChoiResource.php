<?php

namespace App\Http\Resources\DuyetKhoaHoc;

use Illuminate\Http\Resources\Json\JsonResource;

class KhoaHocTuChoiResource extends JsonResource
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
            'created_at' => date('d-m-Y H:i:s',strtotime($this->created_at)),
            'BaiGiang'=>$this->bai_giang,
        ];
    }
}
