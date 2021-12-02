<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class confirmSlotMailToJobSeeker extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $bookingTitle;
    public $companyname;
    public $position;
    public $instruction;
    public $timepicker;
    public $timepicker1;
    public $datepicker;
    public function __construct($name,$bookingTitle,$companyname, $position,$instruction,$timepicker,$timepicker1,$datepicker)
    {
        $this->name = $name;
        $this->bookingTitle = $bookingTitle;
        $this->companyname = $companyname;
        $this->position = $position;
        $this->instruction = $instruction;
        $this->timepicker = $timepicker;
        $this->timepicker1 = $timepicker1;
        $this->datepicker = $datepicker;

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
            ->view('emails.user.confirmSlotJobseeker'); // emails/user/confirmSlotJobseeker
    }
}
