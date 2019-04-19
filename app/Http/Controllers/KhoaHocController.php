<?php

namespace App\Http\Controllers;

use App\KhoaHoc;
use Illuminate\Http\Request;
use App\TheLoaiKhoaHoc;
use App\MangKhoaHoc;
use App\Http\Resources\KhoaHoc\KhoaHocCollection;
use App\Http\Resources\KhoaHoc\KhoaHocResource;
use App\Exceptions\KhoaHocKhongDung;
use App\Http\Requests\KhoaHocRequest;
use Illuminate\Validation\ValidationData;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\KhoaHocKhongThuocGiangVien;
use App\Http\Requests\KhoaHocUpdateRequest;
use JD\Cloudder\Facades\Cloudder;
use App\GiangVien;
use App\TaiKhoanNganHang;
use App\Http\Traits\MailTrait;
class KhoaHocController extends Controller
{
    use MailTrait;
    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
        $this->middleware('isAdmin')->only('indexAdmin');
        $this->middleware('isGiangVien')->except('index','show');
    }
    public function indexAdmin(MangKhoaHoc $MangKhoaHoc)
    {
        return KhoaHocCollection::collection($MangKhoaHoc->khoa_hoc);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index(MangKhoaHoc $MangKhoaHoc)
    {
        // $khoaHocAll = $MangKhoaHoc->khoa_hoc;
        // $collection = collect();
        // // Kiểm tra Khóa học thuộc về GV có còn thời hạn không, nếu không thì ko hiển thị
        // foreach($khoaHocAll as $kh)
        // {
        //     if( $kh->giang_vien->TrangThai == 1)
        //         $collection->add($kh);
        // }
        
        // return KhoaHocCollection::collection($collection);
        return KhoaHocCollection::collection($MangKhoaHoc->khoa_hoc);
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
    public function store(KhoaHocRequest $request, MangKhoaHoc $MangKhoaHoc)
    {
        $giangvien = GiangVien::where('user_id',Auth::id())->first();
        $KhoaHoc = new KhoaHoc;
        $KhoaHoc->MangKH_id = $MangKhoaHoc->id;
        $KhoaHoc->GiangVien_id = $giangvien->id;
        $KhoaHoc->TenKH = $request->TenKH;
        $KhoaHoc->TomTat = $request->TomTat;
        $KhoaHoc->GiaTien = $request->GiaTien;
        $KhoaHoc->ThanhTien = $request->GiaTien;

        //Luu Hinh Anh
        if($request->hasFile('HinhAnh'))
        {
            $url = $this->LuuAnhKhoaHoc($request);
            $KhoaHoc->HinhAnh = $url;
        }

        $KhoaHoc->save();
        
        // Cập nhật số lượng khóa học của Giảng viên
        $this->CapNhatSoLuongKhoaHoc($giangvien);
        
        //Kiểm tra xem người dùng này đã khai báo tài khoản ngân hàng hay chưa? Nếu chưa sẽ gửi mail
        $bankAccount = TaiKhoanNganHang::where('user_id',Auth::id())->first();
        if($bankAccount == "")
        {
            $this->BankAccount($giangvien,$KhoaHoc,Auth::user()->email);
        }

        return response([
            'data' => new KhoaHocResource($KhoaHoc),
        ],200);
    }

    public function show(MangKhoaHoc $MangKhoaHoc, KhoaHoc $KhoaHoc)
    {
        
        // $khoaHoc = KhoaHoc::find($id);
        // $this->KiemTraKhoaHoc($MangKhoaHoc, $KhoaHoc);
        
        // if($KhoaHoc->giang_vien->TrangThai != 1)
        // {
        //     return response()->json([
        //         'data' => 'Khóa học đã hết thời hạn',
        //     ],Response::HTTP_UNAUTHORIZED);
        // }
        // else
        // {
            $this->KiemTraKhoaHoc($MangKhoaHoc, $KhoaHoc);
            views($KhoaHoc)->delayInSession(3)->record();
            $KhoaHoc->SoLuotXem = views($KhoaHoc)->count();
            $KhoaHoc->save();
            return new KhoaHocResource($KhoaHoc);
        // }   
        // return $khoaHoc;
        
    }
    
    
    public function edit(KhoaHoc $khoaHoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KhoaHoc  $khoaHoc
     * @return \Illuminate\Http\Response
     */
    public function update(KhoaHocUpdateRequest $request, MangKhoaHoc $MangKhoaHoc, KhoaHoc $KhoaHoc)
    {
        $this->KiemTraKhoaHoc($MangKhoaHoc, $KhoaHoc);
        $this->KhoaHocThuocGiangVien($KhoaHoc);
        $KhoaHoc->update($request->all());
        $KhoaHoc->ThanhTien = \round((1-($request->GiamGia)/100) * $request->GiaTien);
        // Tìm giải pháp để lưu ảnh ko bị lặp khi người dùng muốn đổi ảnh
        if($request->hasFile('HinhAnh'))
        {
            $url = $this->LuuAnhKhoaHoc($request);
            $KhoaHoc->HinhAnh = $url;
        }
        
        $KhoaHoc->save();
        return response([
            'data' => "Cập nhật thành công ".$KhoaHoc->TenKH,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KhoaHoc  $khoaHoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(MangKhoaHoc $MangKhoaHoc, KhoaHoc $KhoaHoc)
    {
        $this->KiemTraKhoaHoc($MangKhoaHoc, $KhoaHoc);
        $this->KhoaHocThuocGiangVien($KhoaHoc);
        $KhoaHoc->delete();
        return response([
            'data' => "Xóa thành công ".$KhoaHoc->TenKH,
        ],200);
    }

    public function KiemTraKhoaHoc(MangKhoaHoc $MangKhoaHoc, KhoaHoc $KhoaHoc)
    {
        if($KhoaHoc->MangKH_id != $MangKhoaHoc->id)
            throw new KhoaHocKhongDung;
    }

    public function KhoaHocThuocGiangVien(KhoaHoc $KhoaHoc)
    {
        $user = Auth::user();
        $giangvien = $user->giang_vien;
        foreach($giangvien as $gv)
        {
            if($KhoaHoc->GiangVien_id != $gv->id)
                throw new KhoaHocKhongThuocGiangVien;
        }
        
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
        Cloudder::upload($file,$savedName,["crop"=>"scale", "width"=>340,"folder" => "khoa_hoc"]);
        list($width, $height) = getimagesize($file);
        $image_url= Cloudder::secureShow(Cloudder::getPublicId(), ["width" => $width, "format"=>"jpg"]);
        $url = $this->CatChuoiLayUrl($image_url);
        
        // ---Lưu ảnh vào source---
        // $savedName = str_random(4)."_".$originalName;

        // while(file_exists("upload/khoa_hoc/".$savedName))
        //     $savedName = str_random(4)."_".$originalName;

        // $file->move("upload/khoa_hoc",$savedName);

        // return $savedName;
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

    public function CapNhatSoLuongKhoaHoc($GiangVien)
    {
        $soLuongKhoaHoc = 1 + $GiangVien->SoLuongKhoaHoc;
        $GiangVien->SoLuongKhoaHoc = $soLuongKhoaHoc;
        $GiangVien->save();
    }
    
}
