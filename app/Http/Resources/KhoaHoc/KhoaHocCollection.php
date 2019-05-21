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
        $dg_arr = [];
    	$danh_gia = $this->DanhGia;
    	for($i=0; $i<$danh_gia; $i++)
    	{
    		$dg_arr[] = $danh_gia;
    	}
        return [
            'id' => $this->id,
            'MangKH_id' => $this->MangKH_id,
            'TenKH' => $this->TenKH,
            'GiaTien' => $this->GiaTien,
            'GiamGia' =>$this->GiamGia,
            'ThanhTien' =>$this->ThanhTien,
            'DanhGia' => $dg_arr,
            'SoLuotXem' =>$this->SoLuotXem,
            'HinhAnh' =>$this->HinhAnh,
            'GiangVien' => $this->giang_vien->TenGiangVien,
        ];
    }
}
