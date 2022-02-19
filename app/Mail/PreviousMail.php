<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreviousMail extends Mailable
{
    use Queueable, SerializesModels;

    private $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $ticket = $this->ticket;
        return $this->markdown('emails.previous', compact('ticket'))->subject('「千葉大学教育学部音楽科卒業演奏会」について♪');
    }
}
