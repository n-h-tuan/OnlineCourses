<?php

namespace App\Http\Resources\ThanhToan;

use Illuminate\Http\Resources\Json\JsonResource;

class ThanhToanResource extends JsonResource
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
