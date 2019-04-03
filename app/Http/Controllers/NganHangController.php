<?php

namespace App\Http\Controllers;

use App\NganHang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NganHangImport;

class NganHangController extends Controller
{
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
        return NganHang::all();
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
    public function store(Request $request)
    {
        // $NganHang = NganHan::create($request->all());
        // return response()->json($NganHang);
        Excel::import(new NganHangImport, request()->file('file'));
        return response()->json([
            'data' => 'Import dữ liệu ngân hàng thành công',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NganHang  $nganHang
     * @return \Illuminate\Http\Response
     */
    public function show(NganHang $nganHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NganHang  $nganHang
     * @return \Illuminate\Http\Response
     */
    public function edit(NganHang $nganHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NganHang  $nganHang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NganHang $NganHang)
    {
        $NganHang->update($request->all());

        return response()->json([
            'data' => "Cập nhật thành công ngân hàng $NganHang->TenNganHang",
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NganHang  $nganHang
     * @return \Illuminate\Http\Response
     */
    public function destroy(NganHang $NganHang)
    {
        $NganHang->delete();
        return response()->json([
            'data' => "Xóa thành công ngân hàng $NganHang->TenNganHang",
        ],200);
    }
}
