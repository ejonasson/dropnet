<?php

namespace App\Integrations\Stripe\Events;

use App\Integrations\Interfaces\FailedInvoiceEvent;
use App\Integrations\Stripe\Events\StripeInvoiceEvent;

class FailedStripeInvoiceEvent extends StripeInvoiceEvent implements FailedInvoiceEvent
{
    public function getPlan()
    {
        return $this->invoice->remote_plan_id;
    }
}
