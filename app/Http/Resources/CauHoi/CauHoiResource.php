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
        return parent::toArray($request);
    }
}
