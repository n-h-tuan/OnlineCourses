<?php

namespace App\Http\Controllers;

use App\TheLoaiKhoaHoc;
use Illuminate\Http\Request;
use App\Http\Resources\TheLoaiKhoaHoc\TheLoaiKHResource;
use App\Http\Requests\TheLoaiKHRequest;
use App\Http\Resources\TheLoaiKhoaHoc\TheLoaiKHCollection;

class TheLoaiKhoaHocController extends Controller
{
    // Nhớ phân quyền
    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
        $this->middleware('isAdmin')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TheLoaiKHCollection::collection(TheLoaiKhoaHoc::all());
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
    public function store(TheLoaiKHRequest $request)
    {
        $TheLoaiKH = TheLoaiKhoaHoc::create($request->all());
        return response([
            'data' => new TheLoaiKHResource($TheLoaiKH),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TheLoaiKhoaHoc  $theLoaiKhoaHoc
     * @return \Illuminate\Http\Response
     */
    public function show(TheLoaiKhoaHoc $TheLoaiKhoaHoc)
    {
        // $theLoaiKhoaHoc = TheLoaiKhoaHoc::find($id);
        return new TheLoaiKHResource($TheLoaiKhoaHoc);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TheLoaiKhoaHoc  $theLoaiKhoaHoc
     * @return \Illuminate\Http\Response
     */
    public function edit(TheLoaiKhoaHoc $theLoaiKhoaHoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TheLoaiKhoaHoc  $theLoaiKhoaHoc
     * @return \Illuminate\Http\Response
     */
    public function update(TheLoaiKHRequest $request, TheLoaiKhoaHoc $TheLoaiKhoaHoc)
    {
        $TheLoaiKhoaHoc->update($request->all());
        return response()->json([
            'data' => 'Cập nhật thành công',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TheLoaiKhoaHoc  $theLoaiKhoaHoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(TheLoaiKhoaHoc $TheLoaiKhoaHoc)
    {
        $TheLoaiKhoaHoc->delete();
        return response()->json([
            'data' => "Xóa thành công",
        ],200);
    }
}
