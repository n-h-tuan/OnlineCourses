<?php

namespace App\Http\Resources\HoaDon;

use Illuminate\Http\Resources\Json\JsonResource;
use App\KhoaHoc;

class HoaDonResourceReport extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $khoahoc = KhoaHoc::find($this->KhoaHoc_id);
        $giangvien = $khoahoc->giang_vien->user_id;
        return [
            'id' => $this->id,
            'user' =>$this->user->name,
            'KhoaHoc' => $this->khoa_hoc->TenKH,
            'GiangVien' => "user_id: $giangvien",
            'ThanhToan' =>$this->thanh_toan->HinhThucThanhToan,
            'TongTien' =>$this->TongTien,
            'TienChuyen' => round(0.8 * $this->TongTien), 
            'MaCode' =>($this->MaCode_id)=="" ? null : $this->code_khoa_hoc->code,
            'ThoiGian' => date('d-m-Y H:i:s',strtotime($this->created_at)),
        ];
    }
}
