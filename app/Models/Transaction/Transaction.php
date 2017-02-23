<?php

namespace App\Models\Transaction;

use Models\Business\Business;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'gateway', 'gateway_id', 'currency', 'amount', 'remote_customer_id', 'subscription_id', 'raw_notification'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
