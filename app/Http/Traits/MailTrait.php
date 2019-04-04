<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailSendCode;


trait MailTrait{
    public function SendCode($code, $email)
    {
        // $code = "$code";
        Mail::to($email)->send(new MailSendCode($code));
        // return "Mail Sent!";
    }
}