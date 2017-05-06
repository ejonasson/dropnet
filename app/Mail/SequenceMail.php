<?php

namespace App\Mail;

use App\Models\Customer\Customer;
use App\Models\Emails\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SequenceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Email $email, Customer $customer)
    {
        $this->email = $email;
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@example.com')
            ->subject($this->email->subject)
            ->view('emails.sequence');
    }
}
