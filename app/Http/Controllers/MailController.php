<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\MailSendCode;
use App\Http\Traits\MailTrait;

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
}
