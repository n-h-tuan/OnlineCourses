<?php

namespace App\Http\Controllers;

use App\CauHoi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CauHoi\CauHoiResource;
use App\HoaDon;
use App\BaiGiang;
use App\KhoaHoc;
use App\Http\Requests\CauHoiRequest;
use App\Exceptions\isUserException;
use App\Exceptions\NguoiDungChuaMuaKhoaHoc;
use JD\Cloudder\Facades\Cloudder;

class CauHoiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BaiGiang $BaiGiang)
    {
        return CauHoiResource::collection($BaiGiang->cau_hoi);
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
    public function store(CauHoiRequest $request, BaiGiang $BaiGiang)
    {
        $kq = $this->UserMuaKhoaHoc($BaiGiang);
        $cauhoi = new CauHoi;
        $cauhoi->user_id = Auth::id();
        $cauhoi->BaiGiang_id = $BaiGiang->id;
        $cauhoi->TieuDe = $request->TieuDe;
        $cauhoi->NoiDung = $request->NoiDung;

        if($request->hasFile('HinhAnh'))
        {
            $url = $this->LuuAnhKhoaHoc($request);
            $cauhoi->HinhAnh = $url;
        }

        $cauhoi->save();
        return response()->json([
            'data' => new CauHoiResource($cauhoi),
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CauHoi  $cauHoi
     * @return \Illuminate\Http\Response
     */
    public function show(CauHoi $cauHoi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CauHoi  $cauHoi
     * @return \Illuminate\Http\Response
     */
    public function edit(CauHoi $cauHoi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CauHoi  $cauHoi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BaiGiang $BaiGiang, CauHoi $CauHoi)
    {
        $this->CauHoiThuocUser($CauHoi);
        request()->validate(
            [
                'TieuDe' => "required|min:5",
                'NoiDung' => "required|min:5|max:500",
                'HinhAnh' => "mimes:jpeg,png",
            ],
            []
        );
        $CauHoi->TieuDe = $request->TieuDe;
        $CauHoi->NoiDung = $request->NoiDung;
        if($request->hasFile('HinhAnh'))
        {
            $url = $this->LuuAnhKhoaHoc($request);
            $CauHoi->HinhAnh = $url;
        }

        $CauHoi->save();
        return response()->json([
            'data' => 'Cập nhật câu hỏi thành công',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CauHoi  $cauHoi
     * @return \Illuminate\Http\Response
     */
    public function destroy(BaiGiang $BaiGiang, CauHoi $CauHoi)
    {
        if((Auth::user()->level_id == 1))
        {
            $CauHoi->delete();
            return response()->json([
                'data'=>'Xóa thành công câu hỏi',
            ],200);
        }
        $this->CauHoiThuocUser($CauHoi);
        $CauHoi->delete();
            return response()->json([
                'data'=>'Xóa thành công câu hỏi',
            ],200);
    }

    public function UserMuaKhoaHoc(BaiGiang $BaiGiang)
    {
        $user = Auth::user();
        $khoahoc_id = $BaiGiang->KhoaHoc_id;
        $hoadon = HoaDon::where('user_id',$user->id)->where('KhoaHoc_id',$khoahoc_id)->where('TrangThai',1)->first();
        if($hoadon=="")
            throw new NguoiDungChuaMuaKhoaHoc();
    }
    public function CauHoiThuocUser(CauHoi $CauHoi)
    {
        if($CauHoi->user_id != Auth::id())
            throw new isUserException();
    }
    public function LuuAnhKhoaHoc(Request $request)
    {
        $file = $request->file('HinhAnh');

        $originalName = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
        $extensionFile = $file->getClientOriginalExtension();

        if($extensionFile != "jpg" && $extensionFile != "png" && $extensionFile != "jpeg")
            return response()->json([
                'data'=>"Hình ảnh không đúng định dạng, chỉ được chọn hình ảnh có đuôi .jpg, .png, .jpeg",
            ]);
        
        // ---Lưu ảnh lên Cloudinary---   
        $savedName = str_random(6)."_".$originalName; 
        Cloudder::upload($file,$savedName,["crop"=>"scale", "width"=>340,"folder" => "cau_hoi"]);
        list($width, $height) = getimagesize($file);
        $image_url= Cloudder::secureShow(Cloudder::getPublicId(), ["width" => $width, "format"=>"jpg"]);
        $url = $this->CatChuoiLayUrl($image_url);
        
        return $url;
    }

    public function CatChuoiLayUrl($str)
    {
        $viTriC_fit = strpos($str, "c_fit" );
        $str1 = substr($str,0,$viTriC_fit); // Cắt tới chữ upload/
        $viTriv1 = strpos($str,"v1/");
        $str2 = substr($str,$viTriv1); // Lấy chuỗi từ v1 trở đi

        $finalString = $str1.$str2;
        return $finalString;
    }
  
    
}
