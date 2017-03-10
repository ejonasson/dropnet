<?php

namespace App\Integrations\Stripe\Events;

use App\Models\Invoice;
use Illuminate\Queue\SerializesModels;

abstract class StripeInvoiceEvent
{
    use SerializesModels;

    protected $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function getInvoice()
    {
        return $this->invoice;
    }
}
