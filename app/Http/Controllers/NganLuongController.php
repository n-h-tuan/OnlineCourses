<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\HoaDon;
use App\KhoaHoc;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\MailTrait;
use App\CodeKhoaHoc;


class NganLuongController extends Controller
{
    use MailTrait;

    public function __construct()
    {
        $this->middleware('auth:api')->only('ThanhToan');
        $this->middleware('VerifyEmail')->only('ThanhToan');
    }
    /**
     * Người dùng gửi thông tin Khóa Học gồm:
     *TenKH
     *GiaTien
     *GiamGia
     */
    
    public function ThanhToan(Request $request)
    {
        // $client = new Client();//(['base_uri' => 'https://sandbox.nganluong.vn:8088/nl35/checkout.php/?']);
        request()->validate(
            [
                'KhoaHoc_id' =>'required',
                'HoTenBuyer' => 'required',
                'EmailBuyer' =>'required|email',
                'DienThoaiBuyer' => 'required',
                'DiaChiBuyer' => 'required',
            ],
            []
        );
        $KhoaHoc = \App\KhoaHoc::find($request->KhoaHoc_id);
        $user_id = Auth::id();
        $KhoaHoc_id = $KhoaHoc->id;

        // $merchant_site_code="47460";
        // $secure_pass = '4be98d7f90be6e3573cc90cf4ea05d9e';
        $merchant_site_code="47523";
        $secure_pass = 'ebef6c593dc3332e9cf7ddda34c1d540';
        $return_url=route('return.url',['KhoaHoc'=>$KhoaHoc_id,'User'=>$user_id]);
        $receiver_email = "dtonlinecourse@gmail.com";
        $transaction_info = "Thanh toán khóa học $KhoaHoc->TenKH";
        $order_code = $KhoaHoc->TenKH;
        $price = $KhoaHoc->ThanhTien;
        // $price = 2000;
        $currency = "vnd";
        $quantity = 1;
        $tax = 0;
        $discount = 0;
        $fee_cal = 0;
        $fee_shipping = 0;
        $order_description = "Thanh toán khóa học $KhoaHoc->TenKH";
        $buyer_info = "$request->HoTenBuyer*|*$request->EmailBuyer*|*$request->DienThoaiBuyer*|*$request->DiaChiBuyer";
        $affiliate_code ="";
        $lang = "vi";
        $string_secure_code = $merchant_site_code.' '.$return_url.' '.$receiver_email.' '.$transaction_info.' '.$order_code.' '.$price.' '.$currency.' '.$quantity.' '.$tax.' '.$discount.' '.$fee_cal.' '.$fee_shipping.' '.$order_description.' '.$buyer_info.' '.$affiliate_code.' '.$secure_pass;
        $secure_code = md5($string_secure_code);

        $request_string = "https://sandbox.nganluong.vn:8088/nl35/checkout.php?merchant_site_code=$merchant_site_code&return_url=$return_url&receiver=$receiver_email&transaction_info=$transaction_info&order_code=$order_code&price=$price&currency=$currency&quantity=$quantity&tax=$tax&discount=$discount&fee_cal=$fee_cal&fee_shipping=$fee_shipping&order_description=$order_description&buyer_info=$buyer_info&affiliate_code=$affiliate_code&lang=$lang&secure_code=$secure_code&cancel_url=";
        
        // $client->request('GET',"$request_string");

        return redirect($request_string);
        // return $request_string;
    }

    public function KetQuaTraVe(Request $request, KhoaHoc $KhoaHoc, User $User)
    {
        $parram_return = array(
            'transaction_info' => $request->transaction_info,
            'order_code' => $request->order_code,
            'price' => $request->price,
            'payment_id' => $request->payment_id,
            'payment_type' => $request->payment_type,
            'error_text' => $request->error_text,
            // 'merchant_site_code' => '47460',
            // 'secure_pass' => '4be98d7f90be6e3573cc90cf4ea05d9e',
            'merchant_site_code' => '47523',
            'secure_pass' => 'ebef6c593dc3332e9cf7ddda34c1d540',
        );

        $secure_code = $request->secure_code;
        
        $string_verify_secure_code = ' '.implode(' ', $parram_return);
        $verify_secure_code = md5($string_verify_secure_code);

        //Nếu thành công, record lại giao dịch vào hóa đơn
        if($verify_secure_code == $secure_code)
        {
            $TenKhoaHoc = $KhoaHoc->TenKH;
            // Thêm hóa đơn
            $hoadon = $this->ThemHoaDon($KhoaHoc, $User);
            
            // Tiến hành gửi code sang cho user.
            $code_object = $this->GetCode($KhoaHoc->id);
            // $code_khoa_hoc = $code_object->code; 
            $email = $User->email;
            $this->SendCode($code_object,$email);

            // Cập nhật số lượng học viên cho giảng viên
            $this->CapNhatSoLuongHocVien($KhoaHoc);
 
            // return response()->json([
            //     'data'=>
            //     [
            //         'message' => "Bạn đã thực hiện giao dịch cho khóa học <b>$TenKhoaHoc</b>, một mã code đã được gửi về email $email. Sử dụng mã code đó để kích hoạt khóa học. Xin cám ơn.",
            //         'resend_link' => route('resend.code',['Code'=>$code_object->id, 'Email'=>$email]),
            //     ],
            // ],200);
            return view('payment',['TenKH'=>$TenKhoaHoc,'email'=>$email,'code_id'=>$code_object->id]);
        }
        else
            return response()->json("Giao dịch thất bại!"); 
    }

    public function ThemHoaDon(KhoaHoc $KhoaHoc, User $User)
    {
        $hoadon = new HoaDon;
        // $user = Auth::user();
        $hoadon->KhoaHoc_id = $KhoaHoc->id;
        $hoadon->user_id = $User->id;
        $hoadon->ThanhToan_id = 1;
        $hoadon->TongTien = $KhoaHoc->ThanhTien;
        $hoadon->save();
        
        return $hoadon;
    }

    public function GetCode($KhoaHoc_id)
    {
        $code = CodeKhoaHoc::where('KhoaHoc_id',$KhoaHoc_id)->where('TrangThai',1)->first();
        return $code;
    }

    public function CapNhatSoLuongHocVien($KhoaHoc)
    {
        $giangvien = \App\GiangVien::find($KhoaHoc->GiangVien_id);
        $soLuongHocVien = 1 + $giangvien->SoLuongHocVien;
        $giangvien->SoLuongHocVien = $soLuongHocVien;
        $giangvien->save();
    }
}
