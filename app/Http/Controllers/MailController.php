<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\MailSendCode;
use App\Http\Traits\MailTrait;
use App\User;

class MailController extends Controller
{
    use MailTrait;

    // public function SendCode()
    // {
    //     $code = "abcdef";
    //     Mail::to('nguyenledly1997@gmail.com')->send(new MailSendCode($code));

    //     return "Mail Sent!";
    // }

    public function Code()
    {
        $code = "123abcd";
        $email = "nguyenledly1997@gmail.com";
        $this->SendCode($code,$email);
        return "Mail Sent!";
    }
    public function VerifyEmail(User $User)
    {
        if($User->email_verified_at != "")
            return response()->json("Email bạn đã được xác thực."); 
        else
        {
            $User->email_verified_at = new \DateTime();
            $User->save();
            return response()->json([
                'data' => "Xác thực email $User->email thành công."
            ],200);
        }
    }
    public function ResetPasswordEmail(Request $request)
    {
        request()->validate(
            [
                'email' => 'required|email',
            ],
            []
        );
        $user = User::where('email',$request->email)->first();
        if($user == "")
            return response()->json("Người dùng không tồn tại"); 
        else 
        {
            $newPassword = \str_random(6);
            $user->password = bcrypt($newPassword);
            $user->save();

            $this->ResetPassword($newPassword, $request->email);

            return response()->json([
                'data' => "Email Reset Password Was Sent."
            ],200);
        }
    }
}
