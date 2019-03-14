<?php

namespace App\Http\Controllers;

use App\GiangVien;
use Illuminate\Http\Request;
use App\Http\Resources\GiangVien\GiangVienCollection;
use App\Http\Resources\GiangVien\GiangVienResource;
use App\Http\Requests\GiangVienRequest;
use App\User;
use Illuminate\Support\Facades\Auth;


class GiangVienController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
        $this->middleware('isGiangVien');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $User)
    {
        return GiangVienResource::collection($User->giang_vien);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function show(User $User, GiangVien $GiangVien)
    {
        // $giangVien = GiangVien::find($id);
        return new GiangVienResource($GiangVien);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function edit(GiangVien $giangVien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function update(GiangVienRequest $request, User $User, GiangVien $GiangVien)
    {
        $GiangVien->update($request->all());
        return response()->json([
            'data' => "Cập nhật thành công giảng viên $GiangVien->TenGiangVien",
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GiangVien  $giangVien
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User, GiangVien $GiangVien)
    {
        $GiangVien->delete();
        return response()->json([
            'data' => "Xoá thành công giảng viên $GiangVien->TenGiangVien",
        ]);
    }

    public function KiemTraThoiHanGV(Request $request, GiangVien $GiangVien, \Closure $next)
    {
        $currentDT = date('d-m-Y H:i:s');
        $NgayHetHan = Auth::user()->giang_vien->NgayHetHan;  
        if(strtotime($NgayHetHan) > strtotime($currentDT))
        {
            // return response()->json([
            //     'data' => "Thời gian là giảng viên vẫn còn",
            // ],200);
            return $next($request);
        }
        else {
            $user = User::find(Auth::id());
            $user->level_id=3;
            $GiangVien->TrangThai = 0;
            $user->save();
            $GiangVien->save();
            return response()->json([
                'data' => "Bạn đã hết thời hạn là giảng viên",
            ]);
        }
    }
}
