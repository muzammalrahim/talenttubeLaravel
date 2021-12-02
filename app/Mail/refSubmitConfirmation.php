<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class refSubmitConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $jsname;
    public $refname;

    public function __construct($jsname, $refname)
    {
        $this->jsname = $jsname;
        $this->refname = $refname;
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
            ->subject($this->jsname)
            ->view('emails.user.refSubmitConfirmation'); // emails/user/refSubmitConfirmation
    }
}
