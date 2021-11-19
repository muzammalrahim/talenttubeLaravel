<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class testEmail12 extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        
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
        ->view('emails.user.testEmail'); // emails/user/testEmail
    }
}
