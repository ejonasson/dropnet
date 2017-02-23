<?php

namespace App\Integrations\Stripe\Adapters;

use App\Models\Business\Business;
use App\Models\Transaction\Transaction;
use Stripe\Event;

/**
 * A Class for converting an incoming Stripe Invoice Object to A Normalized Transaction Object
 */
class StripeTransactionAdapter
{
    public static function fromStripeEvent(Event $event, Business $business = null)
    {
        $business                           = $business ?: Business::current();
        $charge                             = $event->data['object'];
        $transaction                        = Transaction::where('gateway_id', $charge->id)->first() ?: new Transaction;
        $transaction->gateway               = 'stripe';

        $transaction->gateway_id            = $charge->id;
        $transaction->amount                = $charge->amount;
        $transaction->currency              = $charge->currency;
        $transaction->remote_customer_id    = $charge->customer;
        $transaction->raw_notification      = json_encode($charge);
        $transaction->business_id           = $business->id;

        return $transaction;
    }
}
