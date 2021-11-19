<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class rejectInterviewInvitationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $company;

    public function __construct($name, $company)
    {
        $this->name = $name;
        $this->company = $company;

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
            ->view('emails.interviewInvitation.rejectInterviewInvitation'); // emails/interviewInvitation/rejectInterviewInvitation
    }
}
