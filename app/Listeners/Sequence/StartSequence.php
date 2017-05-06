<?php

namespace App\Listeners\Sequence;

use App\Integrations\Interfaces\FailedInvoiceEvent;
use App\Integrations\Stripe\Api;
use App\Integrations\Stripe\Events\FailedStripeInvoiceEvent;
use App\Models\Emails\Sequence;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StartSequence
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FailedStripeInvoiceEvent  $event
     * @return void
     */
    public function handle(FailedInvoiceEvent $event)
    {
        $plan_id        = $event->getInvoice()->remote_plan_id;
        $customer       = $event->getInvoice()->customer;

        $sequences = Sequence::where('remote_plan_id', $plan_id)->get();

        $sequences->each(function ($sequence) use ($customer) {
            $sequence->queueEmailsForCustomer($customer);
        });
    }
}
