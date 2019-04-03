<?php

namespace App\Http\Controllers;

use App\TaiKhoanNganHang;
use Illuminate\Http\Request;
use App\Http\Resources\TaiKhoanNganHang\TaiKhoanNganHangResource;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\isUserException;
use App\Http\Requests\TaiKhoanNganHangRequest;

class TaiKhoanNganHangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('isAdmin')->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TaiKhoanNganHangResource::collection(TaiKhoanNganHang::all());
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
    public function store(TaiKhoanNganHangRequest $request)
    {
        $TaiKhoanNganHang = new TaiKhoanNganHang;
        $TaiKhoanNganHang->user_id = Auth::id();
        $TaiKhoanNganHang->SoTaiKhoan = $request->SoTaiKhoan;
        $TaiKhoanNganHang->ChuTaiKhoan = $request->ChuTaiKhoan;
        $TaiKhoanNganHang->NganHang_id = $request->NganHang_id;
        $TaiKhoanNganHang->ChiNhanhNganHang = $request->ChiNhanhNganHang;
        $TaiKhoanNganHang->save();

        return response([
            'data' => new TaiKhoanNganHangResource($TaiKhoanNganHang),
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaiKhoanNganHang  $TaiKhoanNganHang
     * @return \Illuminate\Http\Response
     */
    public function show(TaiKhoanNganHang $TaiKhoanNganHang)
    {
        if(Auth::user()->level_id==1)
            return response([
                'data'=> new TaiKhoanNganHangResource($TaiKhoanNganHang),
            ],200);
        $this->KiemTraUser($TaiKhoanNganHang);
        return response([
            'data'=> new TaiKhoanNganHangResource($TaiKhoanNganHang),
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaiKhoanNganHang  $TaiKhoanNganHang
     * @return \Illuminate\Http\Response
     */
    public function edit(TaiKhoanNganHang $TaiKhoanNganHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaiKhoanNganHang  $TaiKhoanNganHang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaiKhoanNganHang $TaiKhoanNganHang)
    {
        $this->KiemTraUser($TaiKhoanNganHang);
        request()->validate(
            [
                'SoTaiKhoan'=>"required|string|min:12|max:19|unique:tai_khoan_ngan_hang,SoTaiKhoan,".$TaiKhoanNganHang->id,
                'ChuTaiKhoan' => 'required|min:5',
                'NganHang_id' =>'required',
                'ChiNhanhNganHang' => 'required|min:5',
            ],
            []
        );
        $TaiKhoanNganHang->SoTaiKhoan = $request->SoTaiKhoan;
        $TaiKhoanNganHang->ChuTaiKhoan = $request->ChuTaiKhoan;
        $TaiKhoanNganHang->NganHang_id = $request->NganHang_id;
        $TaiKhoanNganHang->ChiNhanhNganHang = $request->ChiNhanhNganHang;
        $TaiKhoanNganHang->save();

        return response()->json([
            'data' => "Cập nhật thành công tài khoản $TaiKhoanNganHang->ChuTaiKhoan",
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaiKhoanNganHang  $TaiKhoanNganHang
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaiKhoanNganHang $TaiKhoanNganHang)
    {
        $this->KiemTraUser($TaiKhoanNganHang);
        $TaiKhoanNganHang->delete();

        return response()->json([
            'data' => "Xóa thành công tài khoản ngân hàng $TaiKhoanNganHang->ChuTaiKhoan",
        ],200);
    }

    public function KiemTraUser(TaiKhoanNganHang $TaiKhoanNganHang)
    {
        $user = Auth::user();
        if($user->id != $TaiKhoanNganHang->user_id)
            throw new isUserException;
    }
}
