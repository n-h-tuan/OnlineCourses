<?php

namespace App\Http\Resources\CauHoi;

use Illuminate\Http\Resources\Json\JsonResource;

class CauHoiResource extends JsonResource
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
            // 'BaiGiang_id' => $this->BaiGiang_id,
            // 'user_id' => $this->user_id,
            'BaiGiang' => $this->bai_giang->TenBaiGiang,
            'user' => $this->user->name,
            'TieuDe' => $this->TieuDe,
            'NoiDung' => $this->NoiDung,
            'HinhAnh' => $this->HinhAnh,
        ];
    }
}
