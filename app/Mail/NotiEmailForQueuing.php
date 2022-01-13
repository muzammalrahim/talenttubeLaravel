<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotiEmailForQueuing extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $url;
    public $employerName;
    public $positionname;
    public function __construct($name, $url, $employerName, $positionname)
    {
        $this->name = $name;
        $this->url = $url;
        $this->employerName = $employerName;
        $this->positionname = $positionname;
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
            ->view('emails.user.notificationEmail'); // emails/user/notificationEmail
    }
}
