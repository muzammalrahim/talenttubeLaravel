<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class referenceEmailtoEmployer extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $username;
    public function __construct($name, $username)
    {
        $this->name = $name;
        $this->username = $username;
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
            ->view('emails.user.referenceEmailToEmployer'); // emails/user/referenceEmailToEmployer
    }
}
