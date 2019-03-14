<?php

namespace App\Http\Resources\GiangVien;

use Illuminate\Http\Resources\Json\JsonResource;

class GiangVienResource extends JsonResource
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
            'user_id' => $this->user_id,
            'TenGiangVien' => $this->TenGiangVien,
            'TomTat' => $this->TomTat,
            'HinhAnh' => $this->user->HinhAnh,
            'SoLuongHocVien' => $this->SoLuongHocVien,
            'SoLuongKhoaHoc' => $this->SoLuongKhoaHoc,
            'ThoiHanGV' => $this->thoi_han_gv->TenThoiHan,
            'NgayHetHan' => $this->NgayHetHan,
            
            // 'NgayHetHan' =>date('d-m-Y H:i:s',strtotime(date('d-m-Y H:i:s',strtotime($this->created_at)).' + '.$this->thoi_han_gv->songay.' days')),
            // 'created_at' => date('d-m-Y H:i:s',strtotime($this->created_at)),
        ];
    }
}
