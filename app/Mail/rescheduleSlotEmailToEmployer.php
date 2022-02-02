<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class rescheduleSlotEmailToEmployer extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $position;
    public $starttime;
    public $date;
    public $old_starttime;
    public $old_date;
    public $jobseeker;

    public function __construct($name,$position,$starttime,$date,$old_starttime,$old_date,$jobseeker)
    {
        $this->name = $name;
        $this->position = $position;
        $this->starttime = $starttime;
        $this->date = $date;
        $this->old_starttime = $old_starttime;
        $this->old_date = $old_date;
        $this->jobseeker = $jobseeker;
        


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
            ->subject('Booking update')
            ->view('emails.user.rescheduleSlotEmailToEmployer'); // emails/user/rescheduleSlotEmailToEmployer
    }
}
