<?php

namespace App\Integrations\Interfaces;

interface FailedInvoiceEvent
{
    public function getInvoice();
}
