<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WorkSubmissionNotification extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $job;
    protected $proposal;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job,$proposal)
    {
        $this->job = $job;
        $this->proposal = $proposal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.work-submission')->with([
            'job' => $this->job,
            'proposal'=>$this->proposal

        ]);
    }
}
