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
        $message->sent = false;

        return $message;
    }

    /**
     * Send this Email,
     * and mark it as sent
     * @return void
     */
    public function send()
    {
        Mail::to($this->customer->email)->send(new SequenceMail($this->email, $this->customer));
        $this->sent = true;
        $this->save();
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
