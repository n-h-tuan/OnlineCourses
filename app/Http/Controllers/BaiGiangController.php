<?php

namespace App\Http\Controllers;

use App\BaiGiang;
use Illuminate\Http\Request;
use Excel;
use App\TheLoaiKhoaHoc;
use App\MangKhoaHoc;
use App\KhoaHoc;
use App\Imports\BaiGiangImport;
use App\Http\Resources\BaiGiang\BaiGiangCollection;
use App\Http\Resources\BaiGiang\BaiGiangResource;
use App\Http\Requests\BaiGiangRequest;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\KhoaHocKhongThuocGiangVien;
use App\HoaDon;
use App\Exceptions\NguoiDungChuaMuaKhoaHoc;
use App\Exceptions\BaiGiangKhongThuocKhoaHoc;
use App\Exceptions\YoutubeURLException;
use App\Http\Resources\BaiGiang\BaiGiangPublicResource;
class BaiGiangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('indexPublic');
        $this->middleware('isGiangVien')->except('index','show','indexPublic');
    }
    
    public function indexPublic(KhoaHoc $KhoaHoc)
    {
        return BaiGiangPublicResource::collection($KhoaHoc->bai_giang);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KhoaHoc $KhoaHoc)
    {
        // return BaiGiangCollection::collection($KhoaHoc->bai_giang)->sortBy('KhoaHoc_id');

        if(Auth::user()->level_id == 3)
        {
            if(!$this->NguoiDungMuaKhoaHoc($KhoaHoc))
            {
                return BaiGiangResource::collection($KhoaHoc->bai_giang)->sortBy('KhoaHoc_id');
            }
        }
        elseif(Auth::user()->level_id == 2)
        {
            if($this->KhoaHocThuocGiangVien($KhoaHoc))
            {
                return BaiGiangResource::collection($KhoaHoc->bai_giang)->sortBy('KhoaHoc_id');
            }
        }
        else 
        {
            return BaiGiangResource::collection($KhoaHoc->bai_giang)->sortBy('KhoaHoc_id');
        }
        // if(Auth::user()->level_id != 3)
        // {
        //     if(!$this->KhoaHocThuocGiangVien($KhoaHoc)||!$this->NguoiDungMuaKhoaHoc($KhoaHoc))
        //     {
        //         return BaiGiangResource::collection($KhoaHoc->bai_giang)->sortBy('KhoaHoc_id');
        //     }
                
        // }
        // // Nếu người dùng mua khóa học
        // else
        // {
        //     if(!$this->NguoiDungMuaKhoaHoc($KhoaHoc))
        //     {
        //         return BaiGiangResource::collection($KhoaHoc->bai_giang)->sortBy('KhoaHoc_id');
        //     }
        // }
        
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
     * Để giảng viên thêm Bài giảng, đầu tiên giảng viên tạo Khóa học, sau đó giảng viên mới được phép thêm Bài giảng.
     * Vì phải dùng id của Khóa Học vừa tạo thì mới thêm Bai Giang đưuọc
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Bắt buộc người dùng tạo khóa học trước rồi mới được thêm bài giảng

    public function store(KhoaHoc $KhoaHoc, BaiGiangRequest $request)
    {   
        $this->KhoaHocThuocGiangVien($KhoaHoc);
        try
        {
            foreach($request->data as $rq)
            {
                // $this->validateYoutubeURL($rq['EmbededURL']);
                $parts = parse_url($rq['EmbededURL']);
                if(($parts['host']!="www.youtube.com") && ($parts['host']!="youtu.be"))
                    return response()->json('Định dạng Youtube Video không đúng');
                $embedURL = $this->convertYoutube($rq['EmbededURL']);
                BaiGiang::create([
                    'KhoaHoc_id'=> $KhoaHoc->id,
                    'TenBaiGiang' => $rq['TenBaiGiang'],
                    'MoTa' => $rq['MoTa'],
                    'EmbededURL' => $embedURL,
                    'HocThu' => $rq['HocThu'],
                ]);
            }
            return response()->json([
                'data'=>"Thêm bài giảng thành công",
            ],200);
            // return count($request->data);
        }
        catch(\Exception $e)
        {
            
            // if($e->getCode() == 23000)
                return response()->json("EmbededURL đã tồn tại.");
            // else
            // return response()->json($e->getMessage());
            
        }
    }
  
    /**
     * Display the specified resource.
     *
     * @param  \App\BaiGiang  $baiGiang
     * @return \Illuminate\Http\Response
     */
    public function show(KhoaHoc $KhoaHoc, BaiGiang $BaiGiang)
    {
        // Nếu người dùng là giảng viên hoặc admin
        if(Auth::user()->level_id != 3)
        {
            if(!$this->KhoaHocThuocGiangVien($KhoaHoc))
            {
                $this->BaiGiangThuocKhoaHoc($KhoaHoc, $BaiGiang);
                return new BaiGiangResource($BaiGiang);
            }
                
        }
        // Nếu người dùng mua khóa học
        else
        {
            if(!$this->NguoiDungMuaKhoaHoc($KhoaHoc))
            {
                $this->BaiGiangThuocKhoaHoc($KhoaHoc, $BaiGiang);
                return new BaiGiangResource($BaiGiang);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BaiGiang  $baiGiang
     * @return \Illuminate\Http\Response
     */
    public function edit(BaiGiang $baiGiang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BaiGiang  $baiGiang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KhoaHoc $KhoaHoc, BaiGiang $BaiGiang)
    {
        $this->KhoaHocThuocGiangVien($KhoaHoc);
        $this->BaiGiangThuocKhoaHoc($KhoaHoc, $BaiGiang);
        $BaiGiang->TenBaiGiang = $request->TenBaiGiang;
        $BaiGiang->MoTa = $request->MoTa;
        $BaiGiang->EmbededURL = $request->EmbededURL;
        $BaiGiang->HocThu = $request->HocThu;
        $BaiGiang->save();

        return \response()->json(['data'=> "Cập nhất bài giảng $BaiGiang->TenBaiGiang thành công"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BaiGiang  $baiGiang
     * @return \Illuminate\Http\Response
     */
    public function destroy(KhoaHoc $KhoaHoc, BaiGiang $BaiGiang)
    {
        $this->KhoaHocThuocGiangVien($KhoaHoc);
        $this->BaiGiangThuocKhoaHoc($KhoaHoc, $BaiGiang);
        $BaiGiang->delete();
        return response()->json([
            'data'=>"Xóa thành công bài giảng $BaiGiang->TenBaiGiang",
        ],200);
    }
    public function importBaiGiang(Request $request, KhoaHoc $KhoaHoc)
    {
        $this->KhoaHocThuocGiangVien($KhoaHoc);
        $request->validate(
            [
                'file' => 'required|mimes:xlsx',
            ],
            [
                'file.required' => 'Bạn chưa chọn file',
                'file.mimes' => 'File bạn chọn không đúng định dạng'
            ]
        );
        if(!request()->file('file'))
        {    
            return response()->json("Bạn chưa chọn file"); 
        }
        $khoahoc_id = $KhoaHoc->id;
        // return $request->file;
        $import = Excel::import(new BaiGiangImport($khoahoc_id), request()->file('file'));
         
        return response()->json([
            'data' => 'Thêm danh sách bài giảng cho khóa học '.$KhoaHoc->TenKH.' thành công',
        ],200);
        // return response()->json([
        //         'data' => "This is khoahoc_id $khoahoc_id",
        //     ],200);
    }
    public function validateYoutubeURL($url)
    {
        $parts = parse_url($url);
        if(($parts['host']!="www.youtube.com") && ($parts['host']!="youtu.be"))
            // return $parts['host'];
            throw new YoutubeURLException;
    }
    public function KhoaHocThuocGiangVien(KhoaHoc $KhoaHoc)
    {
        $user = Auth::user();
        $giangvien = $user->giang_vien;
        $hoadon = HoaDon::where('KhoaHoc_id',$KhoaHoc->id)->where('user_id',$user->id)->where('TrangThai',1)->first();
        foreach($giangvien as $gv)
        {
            if($hoadon=="")
                if($KhoaHoc->GiangVien_id == $gv->id)
                    return true;
                else
                    throw new KhoaHocKhongThuocGiangVien;
            else
                return true;
        }
        
    }

    public function NguoiDungMuaKhoaHoc(KhoaHoc $KhoaHoc)
    {
        $user = Auth::user();
        //Lấy hóa đơn theo khóa học hiện hành, Nếu người dùng không có id trong hóa đơn này => Người dùng chưa mua khóa học
        $hoadon = HoaDon::where('KhoaHoc_id',$KhoaHoc->id)->where('user_id',$user->id)->where('TrangThai',1)->first();
        if($hoadon == "")
            throw new NguoiDungChuaMuaKhoaHoc;
    }
    // public function NguoiDungChuaMuaKhoaHoc()
    // {
    //     $user = Auth::user();
    //     $hoadon = HoaDon::where('KhoaHoc_id',28)->where('user_id',$user->id)->first(); 
    //     if($hoadon=="")
    //         throw new NguoiDungChuaMuaKhoaHoc;
    //     return $hoadon;
    // }

    public function BaiGiangThuocKhoaHoc(KhoaHoc $KhoaHoc, BaiGiang $BaiGiang)
    {
        if($BaiGiang->KhoaHoc_id != $KhoaHoc->id)
            throw new BaiGiangKhongThuocKhoaHoc();
    }
    public function convertYoutube($string) {
        return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "www.youtube.com/embed/$2",
            $string
        );
    }
}
