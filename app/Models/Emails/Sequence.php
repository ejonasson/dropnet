<?php

namespace App\Models\Emails;

use App\Models\Business\Business;
use App\Models\Emails\Email;
use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    protected $fillable = ['name', 'remote_subscription_id'];

    /**
     * Add an array of emails for this Sequence
     * @param  array  $emails
     * @return self
     */
    public function insertEmails(array $emails)
    {
        foreach ($emails as $new_email) {
            $email = new Email;
            $email->sequence_id = $this->id;
            $email->subject     = $new_email['subject'];
            $email->body        = $new_email['content'];
            $email->delay       = $new_email['sendDelay'];
            $email->index       = $new_email['index'];
            $email->save();
        }

        return $this;
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }
}
