<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailBankAccount extends Mailable
{
    use Queueable, SerializesModels;
    public $GiangVien, $KhoaHoc;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($GiangVien, $KhoaHoc)
    {
        $this->GiangVien = $GiangVien;
        $this->KhoaHoc = $KhoaHoc;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.bank_account');
    }
}
