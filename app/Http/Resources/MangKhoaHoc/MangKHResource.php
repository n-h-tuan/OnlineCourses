<?php

namespace App\Http\Resources\MangKhoaHoc;

use Illuminate\Http\Resources\Json\JsonResource;

class MangKHResource extends JsonResource
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
            // 'TheLoaiKH' => $this->the_loai_khoa_hoc->TenTheLoai,
            'TheLoaiKH_id' => $this->TheLoaiKH_id,
            'TenMangKH' => $this->TenMangKH,
            'link' => route('MangKhoaHoc.show',['TheLoaiKhoaHoc'=>$this->TheLoaiKH_id, 'MangKhoaHoc'=>$this->id]),
        ];
    }
}
