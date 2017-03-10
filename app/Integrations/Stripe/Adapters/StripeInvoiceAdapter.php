<?php

namespace App\Integrations\Stripe\Adapters;

use App\Integrations\Stripe\Api;
use App\Models\Business\Business;
use App\Models\Customer\Customer;
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
        $invoice                         = Invoice::where('remote_id', $stripe_invoice->id)->get()->first() ?: new Invoice;
        $invoice->remote_id              = $stripe_invoice->id;
        $invoice->amount                 = $stripe_invoice->amount_due;
        $invoice->currency               = $stripe_invoice->currency;
        $invoice->status                 = $stripe_invoice->paid ? 'complete' : 'unpaid';
        $invoice->date_due               = Carbon::createFromTimestampUTC($stripe_invoice->period_end);
        $invoice->remote_customer_id     = $stripe_invoice->customer;
        $invoice->remote_subscription_id  = $stripe_invoice->subscription;

        $invoice->customer_id = self::getCustomerIdForInvoice($stripe_invoice, $business);

        return $invoice;
    }

    public static function getCustomerIdForInvoice(StripeInvoice $invoice, Business $business = null)
    {
        $business  = $business ?: Business::current();

        $api            = new Api;
        $stripeCustomer = $api->getCustomer($invoice['customer']);
        $metadata       = $stripeCustomer['metadata'];
        $customer       = Customer::where('remote_id', $invoice['customer'])->first();
        $customer       = $customer ?: new Customer;

        $customer->first_name = $metadata['first_name'];
        $customer->last_name = $metadata['last_name'];
        $customer->email = $metadata['email'];
        $customer->remote_id = $invoice['customer'];
        $customer->business_id = $business->id;
        $customer->save();

        return $customer->id;
    }
}
