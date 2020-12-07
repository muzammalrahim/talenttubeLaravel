<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class saveSlotUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    public $position;
    public function __construct($name, $position)
    {
        $this->name = $name;
        $this->position = $position;
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
            ->view('emails.user.bookingNotification'); // emails/user/bookingNotification
    }
}
