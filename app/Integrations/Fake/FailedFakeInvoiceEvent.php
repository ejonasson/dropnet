<?php

namespace App\Integrations\Fake;

use App\Integrations\Interfaces\FailedInvoiceEvent;
use App\Models\Invoice;
use Illuminate\Queue\SerializesModels;

class FailedFakeInvoiceEvent implements FailedInvoiceEvent
{
    use SerializesModels;

    public $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Gets the value of invoice.
     *
     * @return mixed
     */
    public function getInvoice()
    {
        return $this->invoice;
    }
}
