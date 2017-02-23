<?php

namespace App\Models\Emails;

use App\Models\Emails\Sequence;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['subject', 'body', 'delay', 'index'];

    public function sequence()
    {
        return $this->belongsTo(Sequence::class);
    }
}
