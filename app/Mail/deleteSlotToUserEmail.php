<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class deleteSlotToUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    public $position;

    public function __construct($company,$position)
    {
        $this->company = $company;
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
        return $this->from('creativedev33@gmail.com')
            ->subject('Booking update')
            ->view('emails.user.deleteSlotToUserEmail'); // emails/user/bookingNotification
    }
}
