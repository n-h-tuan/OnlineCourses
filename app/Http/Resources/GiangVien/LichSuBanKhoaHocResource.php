<?php

namespace App\Http\Resources\GiangVien;

use Illuminate\Http\Resources\Json\JsonResource;

class LichSuBanKhoaHocResource extends JsonResource
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
            'KhoaHoc' => $this->khoa_hoc->TenKH,
            'user' => $this->user->name,
            'TongTien' => $this->TongTien,
            'created_at' =>($this->created_at)=="" ? null : date('d-m-Y H:i:s',strtotime($this->created_at)),
        ];
    }
}
