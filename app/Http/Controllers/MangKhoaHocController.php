<?php

namespace App\Http\Controllers;

use App\MangKhoaHoc;
use Illuminate\Http\Request;
use App\Http\Resources\MangKhoaHoc\MangKHResource;
use App\TheLoaiKhoaHoc;
use App\Exceptions\MangKhoaHocKhongDung;
use App\Http\Requests\MangKHRequest;

class MangKhoaHocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TheLoaiKhoaHoc $TheLoaiKhoaHoc)
    {
        // $theLoaiKhoaHoc = TheLoaiKhoaHoc::find($TheLoaiKhoaHoc);
        return MangKHResource::collection($TheLoaiKhoaHoc->mang_khoa_hoc);
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
    public function store(MangKHRequest $request)
    {
        $MangKhoaHoc = MangKhoaHoc::create($request->all());
        return response([
            'data' => new MangKHResource($MangKhoaHoc),
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MangKhoaHoc  $mangKhoaHoc
     * @return \Illuminate\Http\Response
     */
    public function show(TheLoaiKhoaHoc $TheLoaiKhoaHoc, MangKhoaHoc $MangKhoaHoc)
    {
        $this->KiemTraMangKhoaHoc($TheLoaiKhoaHoc, $MangKhoaHoc);
        return new MangKHResource($MangKhoaHoc);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MangKhoaHoc  $mangKhoaHoc
     * @return \Illuminate\Http\Response
     */
    public function edit(MangKhoaHoc $mangKhoaHoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MangKhoaHoc  $mangKhoaHoc
     * @return \Illuminate\Http\Response
     */
    public function update(MangKHRequest $request, TheLoaiKhoaHoc $TheLoaiKhoaHoc, MangKhoaHoc $MangKhoaHoc)
    {
        $MangKhoaHoc->update($request->all());
        return response()->json([
            'data' => "Cập nhật thành công ".$MangKhoaHoc->TenMangKH,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MangKhoaHoc  $mangKhoaHoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(TheLoaiKhoaHoc $TheLoaiKhoaHoc, MangKhoaHoc $MangKhoaHoc)
    {
        $MangKhoaHoc->delete();
        return response()->json([
            'data' => "Xóa thành công ".$MangKhoaHoc->TenMangKH,
        ],200);
    }

    public function KiemTraMangKhoaHoc(TheLoaiKhoaHoc $TheLoaiKhoaHoc, MangKhoaHoc $MangKhoaHoc)
    {
        if($MangKhoaHoc->TheLoaiKH_id != $TheLoaiKhoaHoc->id)
        throw new MangKhoaHocKhongDung;
    }
}
