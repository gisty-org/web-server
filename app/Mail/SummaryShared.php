<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SummaryShared extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $receiver;
    public $summary;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sender, $receiver, $summary)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->summary = $summary;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Summary Shared')->view('emails.summaryshared');
    }
}
