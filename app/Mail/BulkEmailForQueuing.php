<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BulkEmailForQueuing extends Mailable
{
    use Queueable, SerializesModels;

    public $bulkEmail;

    public function __construct($bulkEmail)
    {
        $this->bulkEmail = $bulkEmail;
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
            ->subject($this->bulkEmail->title)
            ->view('emails.user.bulkEmail'); // emails/user/bulkEmail
    }
}
