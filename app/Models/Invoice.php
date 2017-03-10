<?php

namespace App\Models;

use App\Models\Business\Business;
use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;

/**
 * @var  int id
 * @var  string remote_id
 * @var  int amount
 * @var  string currency
 * @var  string status
 * @var  datetime due_date
 * @var  int business_id
 * @var  string remote_customer_id
 * @var  string remote_subscription_id
 */
class Invoice extends Model
{

    protected $fillable = [
        'remote_id', 'amount', 'currency', 'status', 'due_date', 'remote_customer_id', 'remote_subscription_id', 'business_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
