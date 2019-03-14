<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\User\UserCollection;
use App\User;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\UserRequest;
use App\Http\Requests\GiangVienRequest;
use App\Http\Resources\GiangVien\GiangVienResource;
use Illuminate\Support\Facades\Auth;
use App\GiangVien;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api')->except('index','show');
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->middleware('auth:api');
        return UserCollection::collection(User::all());
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        // $user = User::find($id);
        return new UserResource($User);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $User)
    {
        $User->name = $request->name;
        $User->password = bcrypt($request->password); // Sau này làm có quy trình kiểm tra mk hiện tại , r mới đổi mk
        return response()->json([
            'data'=>"Cập nhật thành công ".$User->name,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        $User->delete();
        return response()->json([
            'data' => "Xóa thành công ".$User->name,
        ]);
    }

    public function becomeInstructor(GiangVienRequest $request)
    {
        
        if(Auth::check())
        {
            if(Auth::user()->level_id == 3)
            {
                $user = User::find(Auth::id());
                $giangVien = new GiangVien();
                $giangVien->user_id = Auth::id();

                if($request->TenGiangVien!="")
                    $giangVien->TenGiangVien = $request->TenGiangVien;
                else
                    $giangVien->TenGiangVien = Auth::user()->name;
                
                $giangVien->TomTat = $request->TomTat;
                $giangVien->ThoiHanGV_id = $request->ThoiHanGV_id;
                $giangVien->SoLuongHocVien = 0;
                $giangVien->SoLuongKhoaHoc = 0;
                $user->level_id = 2;
                $giangVien->save();
                $user->save();
                //Sau khi lưu giảng viên mới, trỏ tới bảng Thời hạn GV để lấy giá trị
                $dt = date('d-m-Y H:i:s');
                $giangVien->NgayHetHan = date('d-m-Y H:i:s',strtotime($dt.' + '.$giangVien->thoi_han_gv->SoNgay.' days'));
                $giangVien->save();

                return response([
                    'data' => new GiangVienResource($giangVien),
                ]);

            }
            else
            {
                return response()->json([
                    'data' => 'Bạn đã là giảng viên',
                ],200);
            }
        }
        else
            return response()->json([
                'data' => "Bạn chưa đăng nhập",
            ],202);
    }
}
