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
    public function __construct($name, $url, $employerName,$positionname)
    {
        $this->name = $name;
        $this->url = $url;
        $this->positionname = $positionname;
        $this->employerName = $employerName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->from('creativedev22@gmail.com')
            ->subject($this->name)
            ->view('emails.user.notificationEmail'); // emails/user/notificationEmail
    }
}
