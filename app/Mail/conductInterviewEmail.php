<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class conductInterviewEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $empName;
    public $url;

    public function __construct($empName, $url)
    {
        $this->empName = $empName;
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
            ->subject($this->empName)
            ->view('emails.interviewInvitation.conductInterviewEmail'); // emails/interviewInvitation/conductInterviewEmail
    }
}
