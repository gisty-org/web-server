<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestOTP extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $otp;
    public $time;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$otp,$time)
    {
        $this->user = $user;
        $this->otp = $otp;
        $this->time = $time;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Request for Password Reset')->view('emails.requestotp');
    }
}
