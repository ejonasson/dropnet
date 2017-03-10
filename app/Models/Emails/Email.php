<?php

namespace App\Models\Emails;

use App\Models\Customer\Customer;
use App\Models\Emails\Message;
use App\Models\Emails\Sequence;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['subject', 'body', 'delay', 'index'];

    public function createMessageForCustomer(Customer $customer)
    {
        $message                = Message::make();
        $message->email_id      = $this->id;
        $message->customer_id   = $customer->id;
        $message->delivery_time = Carbon::now()->addHours($this->delay);

        $message->save();
    }

    public function sequence()
    {
        return $this->belongsTo(Sequence::class);
    }

    public function messages()
    {
        return $this->HasMany(Message::class);
    }
}
