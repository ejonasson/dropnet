<?php

use App\Integrations\Stripe\Adapters\StripeTransactionAdapter;
use App\Models\Transaction\Transaction;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ReceiveStripePaymentNotificationTest extends TestCase
{
    use DatabaseTransactions;
    public function setUp()
    {
        parent::setUp();
        \Stripe\Stripe::setApiKey(env('TEST_STRIPE_SECRET_KEY'));
    }

    /**
     * @test
     * @group stripe
     */
    public function test_stripe_event_creates_new_transaction()
    {
        $test_secret_key = env('TEST_STRIPE_SECRET_KEY');
        $sample_event_id = env('TEST_STRIPE_EVENT_ID');

        // Create our transaction
        $event = \Stripe\Event::retrieve($sample_event_id);
        $business       = factory(App\Models\Business\Business::class)->make();
        $business->save();
        $transaction    = StripeTransactionAdapter::fromStripeEvent($event, $business);
        $transaction->save();

        // Get what should be the charge ID
        $charge         = $event->data['object'];
        $charge_id      = $charge->id;
        $transaction    = Transaction::where('gateway_id', $charge_id)->first();
        $this->assertNotNull($transaction);
        $this->assertEquals($charge_id, $transaction->gateway_id);
        $this->assertEquals($charge->amount, $transaction->amount);
        $this->assertEquals($charge->currency, $transaction->currency);
        $this->assertEquals($charge->customer, $transaction->remote_customer_id);
        $this->assertEquals($business->id, $transaction->business_id);
    }
}
