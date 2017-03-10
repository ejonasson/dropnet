<?php

namespace App\Listeners\Sequence;

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
    public function handle(FailedStripeInvoiceEvent $event)
    {
        $remote_id = $event->getInvoice()->remote_subscription_id;
        $customer = $event->getInvoice()->customer;
        $sequences = Sequence::where('remote_subscription_id', $remote_id)->get();

        $sequences->each(function ($sequence) use ($customer) {
            $sequence->queueEmailsForCustomer($customer);
        });
    }
}
