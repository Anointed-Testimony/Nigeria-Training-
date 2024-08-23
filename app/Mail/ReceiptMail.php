<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReceiptMail extends Mailable
{
    use Queueable, SerializesModels;


    public $user;
    public $transactionDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $transactionDetails)
    {
        $this->user = $user;
        $this->transactionDetails = $transactionDetails;
    }

    public function build()
    {
        return $this->view('emails.course_payment_notification')
                    ->subject('Your Course Payment Receipt');
    }
}
