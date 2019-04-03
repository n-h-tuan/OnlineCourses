<?php

namespace App\Http\Resources\TaiKhoanNganHang;

use Illuminate\Http\Resources\Json\JsonResource;

class TaiKhoanNganHangResource extends JsonResource
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
            'SoTaiKhoan'=>$this->SoTaiKhoan,
            'ChuTaiKhoan' => $this->ChuTaiKhoan,
            'NganHang' =>$this->ngan_hang->TenNganHang,
            'ChiNhanhNganHang' => $this->ChiNhanhNganHang,
        ];
    }
}
