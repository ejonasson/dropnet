<?php

namespace App\Models\Emails;

use App\Mail\SequenceMail;
use App\Models\Customer\Customer;
use App\Models\Emails\Email;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Message extends Model
{
    public static function make()
    {
        $message = new self;
        $message->delivered = false;
        $message->opened = false;

        return $message;
    }

    /**
     * Sends this Email
     * @return void
     */
    public function send()
    {
        Mail::to($this->customer->email)->send(new SequenceMail($this->email, $this->customer));
    }

    public function email()
    {
        return $this->belongsTo(Email::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
