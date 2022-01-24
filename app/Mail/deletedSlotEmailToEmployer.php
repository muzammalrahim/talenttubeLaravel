<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class deletedSlotEmailToEmployer extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $position;
    public $starttime;
    public $endtime;
    public $date;
    public $jobseeker_name;

    public function __construct($name,$position,$starttime,$endtime,$date,$jobseeker_name)
    {
        $this->name = $name;
        $this->position = $position;
        $this->starttime = $starttime;
        $this->endtime = $endtime;
        $this->date = $date;
        $this->jobseeker_name = $jobseeker_name;


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
            ->view('emails.user.deletedSlotEmailToEmployer'); // emails/user/deletedSlotEmailToEmployer
    }
}
