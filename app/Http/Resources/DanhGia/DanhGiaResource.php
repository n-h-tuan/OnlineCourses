<?php

namespace App\Http\Resources\DanhGia;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use App\KhoaHoc;

class DanhGiaResource extends JsonResource
{
    protected $user, $KhoaHoc;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user_id = $this->hoa_don->user_id;
        $KhoaHoc_id = $this->hoa_don->KhoaHoc_id;
        $this->user = User::find($user_id)->name;
        $this->KhoaHoc = KhoaHoc::find($KhoaHoc_id)->TenKH;
        return [
            'id'=>$this->id,
            'user'=>$this->user,
            'KhoaHoc' => $this->KhoaHoc,
            // 'user_id'=>$this->hoa_don->user_id,
            // 'KhoaHoc_id' => $this->hoa_don->KhoaHoc_id,
            'TieuDe' => $this->TieuDe,
            'NoiDung' => $this->NoiDung,
            'Diem' => $this->Diem,
        ];
    }
}
