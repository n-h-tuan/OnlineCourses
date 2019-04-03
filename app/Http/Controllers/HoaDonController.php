<?php

namespace App\Http\Controllers;

use App\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\HoaDon\HoaDonResource;
use App\CodeKhoaHoc;
use App\KhoaHoc;

class HoaDonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('isAdmin')->except('index','store','NhapCode');
        // Đối với function store, cần phải thêm bảo mật.
    }
    /* B1: Người dùng bấm vào nút mua -> Chuyển hướng tới trang thanh toán
    B2: Chọn hình thức thanh toán -> ship COD, chuyển khoản
    B3: Điền thông tin cần thiết thanh toán
    B4:
        B4.1: Nếu thành công thì trả về trang hóa đơn, lưu lại hóa đơn.
        B4.2: Nếu ko thành công thì trả về trang báo lỗi đó, ko lưu lại gì. */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Này là Lịch sử thanh toán như trong MyClass
    public function index()
    {
        $user = Auth::id();
        $hoadon = HoaDon::where('user_id',$user)->get();
        return HoaDonResource::collection($hoadon);
    }

    public function adminIndex()
    {
        return HoaDonResource::collection(HoaDon::all());
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
        // Sau khi chuyển khoản thành công, trả về kết quả của bên phía ngân hàng - SUCCESS => thực hiện code
        $hoadon = new HoaDon;
        $hoadon->KhoaHoc_id = $request->KhoaHoc_id;
        $hoadon->user_id = Auth::id();
        $hoadon->ThanhToan_id = $request->ThanhToan_id;
        $hoadon->TongTien = $request->TongTien;
        $hoadon->save();
        // Tiến hành gửi mail đoạn code
        return response()->json([
            'data' => new HoaDonResource($hoadon),
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HoaDon  $hoaDon
     * @return \Illuminate\Http\Response
     */
    public function show(HoaDon $hoaDon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HoaDon  $hoaDon
     * @return \Illuminate\Http\Response
     */
    public function edit(HoaDon $hoaDon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HoaDon  $hoaDon
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, HoaDon $HoaDon)
    {
        
    }

    // sau khi người dùng nhập code để kích hoạt khóa học, thì update hóa đơn
    public function NhapCode(Request $request)
    {
        // Khi người dùng nhập code thành công, kích hoạt
        $request->validate(
            [
                'code' =>"required",
            ],
            []
        );
        $user = Auth::user();
        // Kiểm tra code còn tồn tại
        $code = CodeKhoaHoc::where('code',$request->code)->where('TrangThai',1)->first();
        if($code == "")
            return response()->json([
                'data' => "Code không tồn tại",
            ]);
        // Nếu code tồn tại, kiểm tra xem người dùng đã mua khóa học này chưa
        else
        {
            $hoadon = HoaDon::where('user_id',$user->id)->where('KhoaHoc_id',$code->KhoaHoc_id)->where('TrangThai',0)->first();
            if($hoadon=="")
            {
                // Trả về người dùng chưa mua khóa học
                return response()->json([
                    'data'=>'Bạn chưa mua khóa học',
                ],401);
            }
            else
            {
                // Tiến hành lưu khóa học và kích hoạt khóa học
                // $hoadon = HoaDon::where('user_id',$user->id)->where('KhoaHoc_id',$code->KhoaHoc_id)->where('TrangThai',0)->first();
                $hoadon->MaCode_id = $code->id;
                $hoadon->TrangThai = 1;
                $code->TrangThai = 0;
                $hoadon->save();
                $code->save();
                return response()->json([
                    'data' => 'Bạn đã mở khóa học <b>"'.$code->khoa_hoc->TenKH.'"</b>',
                ],200);
            }
            // return $hoaDon;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HoaDon  $hoaDon
     * @return \Illuminate\Http\Response
     */
    public function destroy(HoaDon $HoaDon)
    {
        $HoaDon->delete();
        return response()->json([
            'data'=>"Xóa thành công hóa đơn $HoaDon->id",
        ],200);
    }
}
