<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class acceptInterviewInvitationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $company;
    public $url;

    public function __construct($name, $company,$url)
    {
        $this->name = $name;
        $this->company = $company;
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
        return $this->from('creativedev22@gmail.com')
            ->subject($this->name)
            ->view('emails.interviewInvitation.acceptInterviewInvitation'); // emails/interviewInvitation/acceptInterviewInvitation
    }
}
