<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSummary extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $summary;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$summary)
    {
        $this->user = $user;
        $this->summary = $summary;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Summary Created')->view('emails.newsummary');
    }
}
