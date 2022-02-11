<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProposalAcceptanceNotification extends Mailable
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
        return $this->view('emails.proposal-acceptance')->with([
            'job' => $this->job,
            'proposal'=>$this->proposal
        ]);
    }
}
