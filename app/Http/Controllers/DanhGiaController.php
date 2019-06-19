<?php

namespace App\Http\Controllers;

use App\DanhGia;
use Illuminate\Http\Request;
use App\Http\Resources\DanhGia\DanhGiaResource;
use App\Http\Requests\DanhGiaRequest;
use App\HoaDon;
use App\KhoaHoc;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\NguoiDungChuaMuaKhoaHoc;
use App\Exceptions\isUserException;

class DanhGiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show','CapNhatDiemDanhGiaKhoaHoc');
        $this->middleware('isAdmin')->only('DanhGiaAll');
        
    }
    public function DanhGiaAll()
    {
        return DanhGiaResource::collection(DanhGia::all()->sortByDesc('created_at'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KhoaHoc $KhoaHoc)
    {
        return DanhGiaResource::collection($KhoaHoc->danh_gia->sortByDesc('created_at'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 
     * Người dùng gửi request: KhoaHoc_id, TieuDe, NoiDung, Diem
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DanhGiaRequest $request, KhoaHoc $KhoaHoc)
    {
        $hoadon = $this->UserMuaKhoaHoc($KhoaHoc->id);
        if($hoadon != "")
        {
            $isExistDanhGia = DanhGia::where('HoaDon_id',$hoadon->id)->first();
            if($isExistDanhGia != "")
                return response()->json('Bạn đã đánh giá khóa học này');
            else{
                $DanhGia = new DanhGia;
                $DanhGia->HoaDon_id = $hoadon->id;
                $DanhGia->TieuDe = $request->TieuDe;
                $DanhGia->NoiDung = $request->NoiDung;
                $DanhGia->Diem = $request->Diem;
                $DanhGia->save();
                $this->CapNhatDiemDanhGiaKhoaHoc($KhoaHoc);
                return response([
                    'data' => new DanhGiaResource($DanhGia),
                ],200);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DanhGia  $danhGia
     * @return \Illuminate\Http\Response
     */
    public function show(KhoaHoc $KhoaHoc, DanhGia $DanhGium)
    {
        return new DanhGiaResource($DanhGium);
        // return $DanhGium;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DanhGia  $danhGia
     * @return \Illuminate\Http\Response
     */
    public function edit(DanhGia $danhGia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DanhGia  $danhGia
     * @return \Illuminate\Http\Response
     */
    public function update(DanhGiaRequest $request, KhoaHoc $KhoaHoc, DanhGia $DanhGium)
    {
        $this->DanhGiaThuocUser($DanhGium);
        $DanhGium->update($request->all());
        $this->CapNhatDiemDanhGiaKhoaHoc($KhoaHoc);
        return response()->json([
            'data'=>'Cập nhật thành công',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DanhGia  $danhGia
     * @return \Illuminate\Http\Response
     */
    public function destroy(KhoaHoc $KhoaHoc, DanhGia $DanhGium)
    {
        if(Auth::user()->level_id==1 || !$this->DanhGiaThuocUser($DanhGium))
        {
            $DanhGium->delete();
            return response()->json([
                'data'=>'Xóa thành công đánh giá',
            ],200);
        }
    }
    public function UserMuaKhoaHoc($KhoaHoc_id)
    {
        $user = Auth::user();
        $hoadon = HoaDon::where('user_id',$user->id)->where('KhoaHoc_id',$KhoaHoc_id)->where('TrangThai',1)->first();
        if($hoadon == "")
            throw new NguoiDungChuaMuaKhoaHoc;
        else
            return $hoadon;
    }

    public function DanhGiaThuocUser($DanhGium)
    {
        $user = Auth::user();
        if($user->id != $DanhGium->hoa_don->user_id)
            throw new isUserException();
    }
    public function CapNhatDiemDanhGiaKhoaHoc(KhoaHoc $KhoaHoc)
    {
        $diem = 0;
        $danhgia = $KhoaHoc->danh_gia;
        foreach($danhgia as $dg)
        {
            $diem = $diem + $dg->Diem;
        }
        $diemAverage = round($diem/count($danhgia),1);
        $KhoaHoc->DanhGia = $diemAverage;
        $KhoaHoc->save();
    }

}
