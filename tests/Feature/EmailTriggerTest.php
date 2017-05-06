<?php

namespace Feature;

use App\Integrations\Fake\FailedFakeInvoiceEvent;
use App\Integrations\Stripe\Events\FailedStripeInvoiceEvent;
use App\Mail\SequenceMail;
use App\Models\Business\Business;
use App\Models\Customer\Customer;
use App\Models\Emails\Email;
use App\Models\Emails\Sequence;
use App\Models\Invoice;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailTriggerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function stripe_payment_failure_event_triggers_sequence()
    {
        $secret_key = env('TEST_STRIPE_SECRET_KEY');
        $publishable_key = env('TEST_STRIPE_PUBLISHABLE_KEY');
        // Setup our data...
        Mail::fake();
        $business = factory(Business::class)->create();

        $sequence = factory(Sequence::class)->create([
            'business_id' => $business->id,
            'remote_plan_id' => 'SAMPLE_ID'
        ]);
        $emails = factory(Email::class)->create(['sequence_id' => $sequence->id]);
        $customer = factory(Customer::class)->create(['business_id' => $business->id]);
        $invoice = factory(Invoice::class)->create([
            'status' => 'failed',
            'customer_id' => $customer->id,
            'remote_plan_id' => 'SAMPLE_ID'
        ]);
        // Trigger our event...
        Event::fire(new FailedFakeInvoiceEvent($invoice));

        // Confirm an Email is Sent
        Mail::assertSent(SequenceMail::class);
    }
}
