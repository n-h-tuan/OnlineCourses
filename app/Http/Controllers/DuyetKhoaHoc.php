<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KhoaHoc;
use App\Http\Resources\DuyetKhoaHoc\DuyetKhoaHocResource;
use App\Http\Resources\User\KhoaHocCuaToiCollection;

class DuyetKhoaHoc extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('isAdmin');
    }
    public function index()
    {
        $khoahoc = KhoaHoc::where('TrangThai',0)->get();
        return DuyetKhoaHocResource::collection($khoahoc);
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'KhoaHoc_id' => 'required',
            ],
            [
                'KhoaHoc_id.required' => "KhoaHoc_id không được rỗng",
            ]
        );
        $khoahoc = KhoaHoc::find($request->KhoaHoc_id);
        $khoahoc->TrangThai = 1;
        $khoahoc->save();

        //Cập nhật khóa học
        $GiangVien = \App\GiangVien::find($khoahoc->GiangVien_id);
        $this->CapNhatSoLuongKhoaHoc($GiangVien);

        return response()->json([
            'data' => "Duyệt thành công khóa học $khoahoc->TenKH",
        ]);
    }
    
    public function CapNhatSoLuongKhoaHoc($GiangVien)
    {
        $soLuongKhoaHoc = 1 + $GiangVien->SoLuongKhoaHoc;
        $GiangVien->SoLuongKhoaHoc = $soLuongKhoaHoc;
        $GiangVien->save();
    }
    public function DanhSachKhoaHocNgungKinhDoanh()
    {
        $khoahoc = KhoaHoc::where('TrangThai',-1)->get();
        return KhoaHocCuaToiCollection::collection($khoahoc);
    }
}
