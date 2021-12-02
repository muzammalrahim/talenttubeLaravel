<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class complete_account_steps extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    // public $refname;

    public function __construct($name)
    {
        $this->name = $name;
        // $this->refname = $refname;
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
            ->subject($this->name)
            ->view('emails.user.complete_account_steps'); // emails/user/complete_account_steps
    }
}
