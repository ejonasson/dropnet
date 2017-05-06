<?php

namespace Tests\Unit;

use App\Models\Business\Business;
use App\Models\Customer\Customer;
use App\Models\Invoice;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_retrieve_business_through_invoice()
    {
        $business = factory(Business::class)->create();
        $customer = factory(Customer::class)->create(['business_id' => $business->id]);
        $invoice = factory(Invoice::class)->create([
            'customer_id' => $customer->id,
        ]);

        $this->assertEquals($business->id, $invoice->business->id);
    }
}
