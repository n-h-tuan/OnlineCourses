<?php

namespace App\Http\Resources\KhoaHoc;

use Illuminate\Http\Resources\Json\JsonResource;

class KhoaHocCollection extends JsonResource
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
            'tenKH' => $this->tenKH,
            'giatien' => $this->giatien,
            'link' => 
            [
                'href' => route('KhoaHoc.show',$this->id),
        
            ],
        ];
    }
}
