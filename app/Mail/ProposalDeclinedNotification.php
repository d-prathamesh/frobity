<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProposalDeclinedNotification extends Mailable
{
    use Queueable, SerializesModels;
    //protected $job;
	protected $job;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job)
    {
        $this->job = $job;
	}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.job-decline')->with([
            
            'job_title' => $this->job->job_title,
        ]);
    }
}
