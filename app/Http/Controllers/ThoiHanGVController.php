<?php

namespace App\Http\Controllers;

use App\ThoiHanGV;
use Illuminate\Http\Request;
use App\Http\Resources\ThoiHanGV\ThoiHanGVResource;
use App\Http\Requests\ThoiHanGVRequest;

class ThoiHanGVController extends Controller
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
        return ThoiHanGVResource::collection(ThoiHanGV::all());
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
    public function store(ThoiHanGVRequest $request)
    {
        $thoiHanGV = ThoiHanGV::create($request->all());

        return response([
            'data'=>new ThoiHanGVResource($thoiHanGV),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ThoiHanGV  $thoiHanGV
     * @return \Illuminate\Http\Response
     */
    public function show(ThoiHanGV $thoiHanGV)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ThoiHanGV  $thoiHanGV
     * @return \Illuminate\Http\Response
     */
    public function edit(ThoiHanGV $thoiHanGV)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ThoiHanGV  $thoiHanGV
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ThoiHanGV $ThoiHanGV)
    {
        $request->validate(
            [
                'TenThoiHan' => 'required|unique:thoi_han_gv,TenThoiHan,'.$ThoiHanGV->id,
                'SoNgay' => "required",
                'GiaTien' => "required",    
            ],
            [

            ]
        );
        $ThoiHanGV->update($request->all());

        return response()->json([
            'data'=>"Cập nhật thành công thời hạn giảng viên $ThoiHanGV->TenThoiHan",
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ThoiHanGV  $thoiHanGV
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThoiHanGV $ThoiHanGV)
    {
        $ThoiHanGV->delete();

        return response()->json([
            'data' => "Xóa thành công thời hạn giảng viên $ThoiHanGV->TenThoiHan",
        ],200);
    }
}
