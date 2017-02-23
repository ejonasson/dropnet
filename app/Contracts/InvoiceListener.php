<?php

namespace App\Contracts;

use App\Models\Invoice;

interface InvoiceListener
{
    /**
     * The method for receiving an un-sorted invoice event
     * Could be a success, failure, etc
     */
    public function handleInvoiceEvent($event);

    /**
     * Process a successful invoice
     * @param  $invoice The Invoice received from the API
     * @return Invoice
     */
    public function handleSuccessfulInvoice($invoice): Invoice;

    /**
     * Process a failed invoice
     * @param  invoice $invoice the Invoice received from the API
     * @return Invoice
     */
    public function handleFailedInvoice($invoice): Invoice;
}
