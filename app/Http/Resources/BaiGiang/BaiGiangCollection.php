<?php

namespace App\Http\Resources\BaiGiang;

use Illuminate\Http\Resources\Json\JsonResource;

class BaiGiangCollection extends JsonResource
{

    protected $_theloai_id = null;
    protected $_mang_id = null;
    public function theloai($theloai_id)
    {
        $this->_theloai_id = $theloai_id;
        return $this;
    }
    public function mang($mang)
    {
        $this->_mang_id = $mang;
        return $this;
    }
    // public function __construct($theloai_id, $mang_id)
    // {
    //     $this->_theloai_id = $theloai_id;
    //     $this->_mang_id = $mang_id;
    // } 
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
            'TenBaiGiang' => $this->TenBaiGiang,
            // 'ChiTiet' => route('BaiGiang.show',['TheLoaiKhoaHoc'=>$this->_theloai_id,'MangKhoaHoc'=>$this->_mang_id,'KhoaHoc'=>$this->KhoaHoc_id,'BaiGiang'=>$this->id]),
        ];
    }
}
