<?php

namespace App\Http\Controllers;

use App\ThanhToan;
use Illuminate\Http\Request;
use App\Http\Resources\ThanhToan\ThanhToanResource;
use App\Http\Requests\ThanhToanRequest;

class ThanhToanController extends Controller
{
    // Chỉ admin có quyền
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
        $this->middleware('isAdmin')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ThanhToanResource::collection(ThanhToan::all());
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
    public function store(ThanhToanRequest $request)
    {
        $thanhToan = ThanhToan::create($request->all());

        return response([
            'data' => new ThanhToanResource($thanhToan),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ThanhToan  $thanhToan
     * @return \Illuminate\Http\Response
     */
    public function show(ThanhToan $thanhToan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ThanhToan  $thanhToan
     * @return \Illuminate\Http\Response
     */
    public function edit(ThanhToan $thanhToan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ThanhToan  $thanhToan
     * @return \Illuminate\Http\Response
     */
    public function update(ThanhToanRequest $request, ThanhToan $ThanhToan)
    {
        $ThanhToan->update($request->all());

        return response()->json([
            'data' => "Cập nhật thành công thanh toán $ThanhToan->HinhThucThanhToan",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ThanhToan  $thanhToan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThanhToan $ThanhToan)
    {
        $ThanhToan->delete();

        return response()->json([
            'data'=>"Xóa thành công thanh toán $ThanhToan->HinhThucThanhToan",
        ]);
    }
}
