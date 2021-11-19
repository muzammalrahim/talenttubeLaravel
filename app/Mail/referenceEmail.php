<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class referenceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $username;
    public $referenceName;
    public $userId;
    public $refURL;

    public function __construct($name, $username, $referenceName,$userId,$refURL)
    {
        $this->name = $name;
        $this->username = $username;
        $this->userId = $userId;
        $this->referenceName = $referenceName;
        $this->refURL = $refURL;
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
            ->view('emails.user.referenceEmail'); // emails/user/referenceEmail
    }
}
