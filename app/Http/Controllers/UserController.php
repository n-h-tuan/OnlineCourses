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
use App\Exceptions\isUserException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Superbalist\LaravelGoogleCloudStorage\GoogleCloudStorageServiceProvider;
use JD\Cloudder\Facades\Cloudder;
use App\HoaDon;
use App\KhoaHoc;
use App\Http\Resources\User\KhoaHocCuaToiCollection;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index','testgcs0','testCloudiary');
        $this->middleware('isAdmin')->only('destroy');
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
        if(Auth::user()->level_id == 1)
            return new UserResource($User);
        else
        {
            $this->KiemTraUserHienTai($User);
            // $user = User::find($id);
            return new UserResource($User);
        }
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
    public function update(Request $request, User $User)
    {
        $this->KiemTraUserHienTai($User);
        $request->validate(
            [
                'name' => "required|min:3|max:50",
            ],
            [
                'name.required' => "Bạn chưa nhập tên",
                'name.min' => "Tên nằm trong khoảng 3-50 ký tự",
                'name.max' => "Tên nằm trong khoảng 3-50 ký tự",
            ]
        );
        $User->name = $request->name;

        //Lưu ảnh
        if($request->hasFile('HinhAnh'))
        {
            $url = $this->LuuAnhUser($request);
            $User->HinhAnh = $url;
        }
        
        // Nếu User check button đổi password thì thực hiện đổi password
        if($request->CheckPassword=="on")
        {
            $request->validate(
                [
                    'PasswordHienTai' => 'required|min:6',
                    'PasswordMoi' => 'required|min:6',
                    'PasswordMoiNhapLai' =>'required|min:6|same:PasswordMoi',
                ],[]
            );
            if(Hash::check($request->PasswordHienTai, $User->password))
            {
                $User->password = bcrypt($request->PasswordMoi);
            }
        }
        $User->save();

        // $User->password = bcrypt($request->password); // Sau này làm có quy trình kiểm tra mk hiện tại , r mới đổi mk
        return response()->json([
            'data'=>"Cập nhật thành công ".$User->name,
        ],200);

        // if(Hash::check($request->PasswordHienTai, $User->password))
        //     echo "TRUE <br>";
        // else
        //     echo "FALSE";
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        if(Auth::user()->level_id==1)
        {
            $User->delete();
            return response()->json([
                'data' => "Xóa thành công ".$User->name,
            ]);
        }
        else
        {
            $this->KiemTraUserHienTai($User);
            $User->delete();
            return response()->json([
                'data' => "Xóa thành công ".$User->name,
            ]);
        }
    }

    public function TroThanhGiangVien(GiangVienRequest $request)
    {
        // SAU KHI USER THANH TOÁN THÌ MỚI TIẾN HÀNH THỰC HIỆN FUNCTION NÀY
        if(Auth::check())
        {
            $user = User::find(Auth::id());
            if(Auth::user()->level_id == 3)
            {
                // Nếu KHÔNG tồn tại User này trong table giang_vien => Tao GiangVien mới
                if(count($user->giang_vien) <= 0) 
                {
                    $giangVien = new GiangVien;
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
                    $giangVien->NgayHetHan = $this->tinhNgayHetHan($dt, $giangVien->thoi_han_gv->SoNgay);
                    $giangVien->save();

                    return response([
                        'data' => new GiangVienResource($giangVien),
                    ]);
                }
                //Nếu đã tồn tại User này trong bảng GiangVien thì cập nhật Ngày Hết Hạn và thoihan_id mới
                else 
                {
                    $giangVien = $user->giang_vien;
                    foreach($giangVien as $gv)
                    {
                        $gv->ThoiHanGV_id = $request->ThoiHanGV_id;
                        $gv->TrangThai = 1;
                        $user->level_id = 2;
                        $gv->save();
                        $user->save();
                        $dt = date('d-m-Y H:i:s');
                        $gv->NgayHetHan = $this->tinhNgayHetHan($dt, $gv->thoi_han_gv->SoNgay);
                        $gv->save();
            
                        return response([
                            'data' => new GiangVienResource($gv),
                        ]);
                    }
                }
            }
            else
            {
                return response()->json([
                    'data' => 'Bạn đã là giảng viên',
                ],402);
            }
        }
        else
            return response()->json([
                'data' => "Bạn chưa đăng nhập",
            ],401);
    }

    public function tinhNgayHetHan($dt, $soNgay)
    {
        return date('d-m-Y H:i:s',strtotime($dt.' + '.$soNgay.' days'));
    }

    public function KiemTraUserHienTai(User $User)
    {
        if((Auth::id() != $User->id))
            throw new isUserException;
    }

    public function LuuAnhUser(Request $request)
    {
        $file = $request->file('HinhAnh');

        $originalName = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
        $extensionFile = $file->getClientOriginalExtension();

        if($extensionFile != "jpg" && $extensionFile != "png" && $extensionFile != "jpeg")
            return response()->json([
                'data'=>"Hình ảnh không đúng định dạng, chỉ được chọn hình ảnh có đuôi .jpg, .png, .jpeg",
            ]);

        //Lưu ảnh lên Cloudinary
        $savedName = str_random(6)."_".$originalName;
        Cloudder::upload($file,$savedName,["crop"=>"scale", "width"=>170,"folder" => "user"]);
        list($width, $height) = getimagesize($file);
        $image_url= Cloudder::secureShow(Cloudder::getPublicId(), ["width" => $width, "format"=>"jpg"]);
        $url = $this->CatChuoiLayUrl($image_url);

        // $savedName = str_random(4)."_".$originalName;

        // while(file_exists("upload/user/".$savedName))
        //     $savedName = str_random(4)."_".$originalName;

        // $file->move("upload/user",$savedName);

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

    public function KhoaHocCuaToi()
    {
        $user_id = Auth::user()->id;
        $hoadon_khoahoc_id = HoaDon::select('KhoaHoc_id')->where('user_id',$user_id)->where('TrangThai',1)->get();
        $collection = collect();
        foreach($hoadon_khoahoc_id as $kh_id)
        {
            $khoahoc = KhoaHoc::find($kh_id);
            foreach($khoahoc as $kh)
            {
                $collection->add($kh);
            }
        }
        return KhoaHocCuaToiCollection::collection($collection);

    }
    public function testgcs(Request $request)
    {
        $path = $request->file('HinhAnh');
        $disk = Storage::disk('googlecs')->put('user_image', $path);
        return $path;
    }
    public function testCloudiary(Request $request)
    {
        // $this->validate($request,[
        //     'image_name'=>'required|mimes:jpeg,bmp,jpg,png|between:1, 6000',
        // ]);
 
        // $name = $request->file('image_name')->getClientOriginalName();
        $image_name = $request->file('HinhAnh');
            
        //Crop ảnh trước khi public
        // \Cloudinary\Uploader::upload("sample.jpg", array("crop"=>"limit", "tags"=>"samples", "width"=>3000, "height"=>2000));
        
        // Chọn folder để đưa ảnh vào
        // Cloudinary\Uploader::upload("myImage.jpg", array("folder" => "my_folder/my_sub_folder/", "public_id" => "my_image", "overwrite" => TRUE, "resource_type" => "image"));
        
        Cloudder::upload($image_name,null,["crop"=>"scale", "width"=>170,"folder" => "khoa_hoc"]);
        
        list($width, $height) = getimagesize($image_name);

        $image_url= Cloudder::secureShow(Cloudder::getPublicId(), ["width" => $width, "format"=>"jpg"]);
        
        $url = $this->CatChuoiLayUrl($image_url);
       //save to uploads directory
    //    $image->move(public_path("uploads"), $name);

       //Save images
    //    $this->saveImages($request, $image_url);

 
        // return redirect()->back()->with('status', 'Image Uploaded Successfully');
            return $url;
    }
    
    
}
