<?php

namespace App\Http\Controllers;

use App\KhoaHoc;
use Illuminate\Http\Request;
use App\TheLoaiKhoaHoc;
use App\MangKhoaHoc;
use App\Http\Resources\KhoaHoc\KhoaHocCollection;
use App\Http\Resources\KhoaHoc\KhoaHocResource;
use App\Exceptions\KhoaHocKhongDung;
use App\Http\Requests\KhoaHocRequest;

class KhoaHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TheLoaiKhoaHoc $TheLoaiKhoaHoc, MangKhoaHoc $MangKhoaHoc)
    {
        return KhoaHocCollection::collection($MangKhoaHoc->khoa_hoc);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KhoaHocRequest $request)
    {
        $KhoaHoc = KhoaHoc::create($request->all());
        return response([
            'data' => new KhoaHocResource($KhoaHoc),
        ],200);
    }

    public function show(TheLoaiKhoaHoc $TheLoaiKhoaHoc, MangKhoaHoc $MangKhoaHoc, KhoaHoc $KhoaHoc)
    {
        // $khoaHoc = KhoaHoc::find($id);
        $this->KiemTraKhoaHoc($MangKhoaHoc, $KhoaHoc);
        return new KhoaHocResource($KhoaHoc);
        // return $khoaHoc;
    }

    
    public function edit(KhoaHoc $khoaHoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KhoaHoc  $khoaHoc
     * @return \Illuminate\Http\Response
     */
    public function update(KhoaHocRequest $request, TheLoaiKhoaHoc $TheLoaiKhoaHoc, MangKhoaHoc $MangKhoaHoc, KhoaHoc $KhoaHoc)
    {
        $KhoaHoc->update($request->all());
        return response([
            'data' => "Cập nhật thành công ".$KhoaHoc->TenKH,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KhoaHoc  $khoaHoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(TheLoaiKhoaHoc $TheLoaiKhoaHoc, MangKhoaHoc $MangKhoaHoc, KhoaHoc $KhoaHoc)
    {
        $KhoaHoc->delete();
        return response([
            'data' => "Xóa thành công ".$KhoaHoc->TenKH,
        ],200);
    }

    public function KiemTraKhoaHoc(MangKhoaHoc $MangKhoaHoc, KhoaHoc $KhoaHoc)
    {
        if($KhoaHoc->MangKH_id != $MangKhoaHoc->id)
            throw new KhoaHocKhongDung;
    }
}
