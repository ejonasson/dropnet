<?php

namespace App\Integrations\Stripe\Adapters;

use App\Models\Business\Business;
use App\Models\Invoice;
use Carbon\Carbon;
use Stripe\Invoice as StripeInvoice;

/**
 * A Class for converting an incoming Stripe Invoice Object to A Normalized Transaction Object
 */
class StripeInvoiceAdapter
{
    public static function fromStripeInvoice(StripeInvoice $stripe_invoice, Business $business = null)
    {
        $business                        = $business ?: Business::current();
        $invoice                         = Invoice::where('remote_id', $stripe_invoice->id)->get()->first() ?: new Invoice;
        $invoice->remote_id              = $stripe_invoice->id;
        $invoice->amount                 = $stripe_invoice->amount_due;
        $invoice->currency               = $stripe_invoice->currency;
        $invoice->status                 = $stripe_invoice->paid ? 'complete' : 'unpaid';
        $invoice->date_due               = Carbon::createFromTimestampUTC($stripe_invoice->period_end);
        $invoice->business_id            = $business->id;
        $invoice->remote_customer_id     = $stripe_invoice->customer;
        $invoice->remote_subscription_id  = $stripe_invoice->subscription;

        return $invoice;
    }
}
