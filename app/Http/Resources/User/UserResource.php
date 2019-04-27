<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'level_id' => $this->level_id,
            'provider' => $this->provider,
            'provider_id' => $this->provider_id,
            'HinhAnh' => $this->HinhAnh,
            'NgaySinh' =>$this->NgaySinh,
            'SoDienThoai' => $this->SoDienThoai,
            'api_token' => $this->api_token,
        ];
    }
}
