<?php

namespace App\Models\Emails\Observers;

use App\Models\Emails\Message;
use Carbon\Carbon;

class MessageObserver
{
    /**
     * Listen to the Message created event.
     *
     * @param  Message  $message
     * @return void
     */
    public function created(Message $message)
    {
        // If the message has a send time of now or earlier, send this message right away
        if ($message->delivery_time->lte(Carbon::now())) {
            $message->send();
        }
    }

    /**
     * Listen to the Message deleting event.
     *
     * @param  Message  $message
     * @return void
     */
    public function deleting(Message $message)
    {
        //
    }
}
