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
        $objKhoaHoc = $this->khoa_hoc;
        return [
            'id' => $this->id,
            'TheLoaiKH' => $this->the_loai_khoa_hoc->TenTheLoai,
            'TenMangKH' => $this->TenMangKH,
            'KhoaHoc' => $this->khoa_hoc
        ];
    }
}
