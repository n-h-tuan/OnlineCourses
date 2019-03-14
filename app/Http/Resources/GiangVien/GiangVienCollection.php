<?php

namespace App\Http\Resources\GiangVien;

use Illuminate\Http\Resources\Json\JsonResource;

class GiangVienCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'TenGiangVien' => $this->TenGiangVien,
            // 'href' => route('GiangVien.show',$this->id),
        ];
    }
}
