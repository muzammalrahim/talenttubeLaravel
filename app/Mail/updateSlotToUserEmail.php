<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class updateSlotToUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $interviewID;
    public $positionNameInSlot;
    public $companyNameInSlot;


    public $newStartTime;
    public $newEndTime;
    public $newdate;

    public function __construct($interviewID,$positionNameInSlot,$companyNameInSlot,$newStartTime,$newEndTime,$newdate)
    {
        $this->interview = $interviewID;
        $this->positionNameInSlot = $positionNameInSlot;
        $this->companyNameInSlot = $companyNameInSlot;

        $this->newStartTime = $newStartTime;
        $this->newEndTime = $newEndTime;
        $this->newdate = $newdate;
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
            ->view('emails.user.updateSlotNotification'); // emails/user/updateSlotNotification
    }
}
