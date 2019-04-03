<?php

namespace App\Http\Resources\HoaDon;

use Illuminate\Http\Resources\Json\JsonResource;

class HoaDonResource extends JsonResource
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
            'user' =>$this->user->name,
            'KhoaHoc' => $this->khoa_hoc->TenKH,
            'ThanhToan' =>$this->thanh_toan->HinhThucThanhToan,
            'TongTien' =>$this->TongTien,
            'MaCode' =>($this->MaCode_id)=="" ? null : $this->code_khoa_hoc->code,
            'TrangThai' => ($this->TrangThai)==0 ? "Chưa kích hoạt" : "Đã kích hoạt",
        ];
    }
}
