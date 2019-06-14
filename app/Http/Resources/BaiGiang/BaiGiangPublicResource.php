<?php

namespace App\Http\Resources\BaiGiang;

use Illuminate\Http\Resources\Json\JsonResource;

class BaiGiangPublicResource extends JsonResource
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
            'TenBaiGiang'=>$this->TenBaiGiang,
            'EmbededURL' => ($this->HocThu==0) ? null : $this->EmbededURL, 
        ];
    }
}
