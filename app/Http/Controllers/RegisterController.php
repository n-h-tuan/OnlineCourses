<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\User;
use App\Http\Resources\User\UserResource;
use Carbon\Carbon;
use JD\Cloudder\Facades\Cloudder;
use App\Http\Traits\MailTrait;

class RegisterController extends Controller
{
    use MailTrait;
    public function register(RegisterRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level_id = 3;
        $user->NgaySinh = $request->NgaySinh;
        $user->SoDienThoai = $request->SoDienThoai;

        // User không cần thêm ảnh mới khi tạo account 
        // Lưu Ảnh
        // if($request->hasFile('HinhAnh'))
        // {
        //     // $path = $request->file('HinhAnh')->store('user_image');
        //     $url = $this->LuuAnhUser($request);
        //     $user->HinhAnh = $url; 
        // }
        // else {
        $user->HinhAnh = "https://res.cloudinary.com/tuannguyen/image/upload/v1553498961/user/default.jpg";
        // }

        $user->save();

        // Tạo token cho user
        $this->createAPI($user);

        //Gửi mail xác thực
        $this->Verify($user, $user->email);

        // return response([
        //     'data' => new UserResource($user),
        // ],200);
        return response()->json([
            'data' => 
            [
                'message'=>'Verified Email Was Sent.',
                'resend_link'=>route('resend.verify',['User'=>$user]),
            ],
        ],200);
    }

    public function createAPI(User $user)
    {
        $tokenResult = $user->createToken('Personal Access Token'); 
        $api_token = $tokenResult->accessToken;
        $token_type = 'Bearer';
        $user->api_token = $api_token;
        $user->token_type = $token_type;
        $user->save();
    }

    public function LuuAnhUser(Request $request)
    {
        $file = $request->file('HinhAnh');

        $originalName = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME); // Chỉ lấy tên mà ko lấy extension
        $extensionFile = $file->getClientOriginalExtension();

        if($extensionFile != "jpg" && $extensionFile != "png" && $extensionFile != "jpeg")
            return response()->json("Hình ảnh không đúng định dạng, chỉ được chọn hình ảnh có đuôi .jpg, .png, .jpeg");
        
        $savedName = str_random(6)."_".$originalName; // Tạo ra tên để lưu trên cloud
        Cloudder::upload($file,$savedName,["crop"=>"scale", "width"=>170,"folder" => "user"]);
        list($width, $height) = getimagesize($file);
        $image_url= Cloudder::secureShow(Cloudder::getPublicId(), ["width" => $width, "format"=>"jpg"]);
        $url = $this->CatChuoiLayUrl($image_url);
        
        // Lưu hình vào source
        // $savedName = str_random(4)."_".$originalName;

        // while(file_exists("upload/user/".$savedName))
        //     $savedName = str_random(4)."_".$originalName;

        // $file->move("upload/user",$savedName);

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
