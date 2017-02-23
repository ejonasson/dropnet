<?php

namespace App\Integrations\Stripe\Listeners;

use App\Contracts\InvoiceListener;
use App\Integrations\Stripe\Adapters\StripeInvoiceAdapter;
use App\Integrations\Stripe\Events\FailedStripeInvoiceEvent;
use App\Integrations\Stripe\Events\SuccessfulStripeInvoiceEvent;
use App\Models\Invoice;
use Illuminate\Support\Facades\Event;

class StripeInvoiceListener implements InvoiceListener
{
    /**
     * The method for receiving an un-sorted invoice event
     * Could be a success, failure, etc
     */
    public function handleInvoiceEvent($event)
    {
        switch ($event->type) {
            case 'invoice.payment_succeeded':
                $this->handleSuccessfulInvoice($event->data['object']);
                break;
            case 'invoice.payment_failed':
                $this->handleFailedInvoice($event->data['object']);
                break;
            default:
                # code...
                break;
        }
    }

    /**
     * Process a successful invoice
     * @param  $invoice The Invoice received from the API
     * @return Invoice
     */
    public function handleSuccessfulInvoice($invoice): Invoice
    {
        $invoice = StripeInvoiceAdapter::fromStripeInvoice($invoice);
        $invoice->save();

        Event::fire(new SuccessfulStripeInvoiceEvent($invoice));

        return $invoice;
    }

    /**
     * Process a failed invoice
     * @param  invoice $invoice the Invoice received from the API
     * @return Invoice
     */
    public function handleFailedInvoice($invoice): Invoice
    {
        $invoice = StripeInvoiceAdapter::fromStripeInvoice($invoice);
        $invoice->save();

        Event::fire(new FailedStripeInvoiceEvent($invoice));

        return $invoice;
    }
}
