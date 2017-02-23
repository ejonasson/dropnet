<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Integrations\Stripe\Adapters\StripeTransactionAdapter;
use App\Integrations\Stripe\ApiResources\Event;
use App\Integrations\Stripe\Listeners\StripeInvoiceListener;
use App\ValueObjects\StripeWebhook;
use Illuminate\Http\Request;

class StripeWebhookController extends Controller
{
    /**
     * Retrieve and validate a stripe Event,
     * then pass it off to the right adaptor
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function receive(Request $request)
    {
        $id             = $request->get('id');
        $event          = Event::retrieve($id);

        if ($event->isInvoiceEvent()) {
            $listener = new StripeInvoiceListener(Business::current());
            $listener->handleInvoiceEvent($event);
        }

        // if ($event->isChargeEvent()) {
            // $transaction = StripeTransactionAdapter::fromStripeEvent($event);
            // $transaction->save();
        // }

        return response('OK', 200);
    }
}
