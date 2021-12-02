<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class declineRefereeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $refName;

    public function __construct($userName, $refName)
    {
        $this->userName = $userName;
        $this->refName = $refName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->from(CONSTANTS['MAIL_FROM_ADDRESS'])
            ->subject($this->userName)
            ->view('emails.user.declineEmail'); // emails/user/declineEmail
    }
}
