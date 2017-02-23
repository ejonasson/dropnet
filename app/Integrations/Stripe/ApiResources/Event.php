<?php

namespace App\Integrations\Stripe\ApiResources;

use Stripe\Event as StripeEvent;

class Event extends StripeEvent
{
    /**
     * Check if this event is a charge event
     * @return boolean
     */
    public function isChargeEvent()
    {
        $type_parts = explode('.', $this->type);
        return $type_parts[0] === 'charge';
    }

    public function isInvoiceEvent()
    {
        $type_parts = explode('.', $this->type);
        return $type_parts[0] === 'invoice';
    }
}
