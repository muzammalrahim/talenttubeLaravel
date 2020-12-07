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
    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->from('creativetechali@gmail.com')
            ->subject($this->name)
            ->view('emails.user.notificationEmail'); // emails/user/bulkEmail
    }
}
