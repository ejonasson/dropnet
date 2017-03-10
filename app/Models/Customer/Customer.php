<?php

namespace App\Models\Customer;

use App\Models\Business\Business;
use App\Models\Emails\Message;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
