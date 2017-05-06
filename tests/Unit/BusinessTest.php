<?php

use App\Models\Business\Business;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class BusinessTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    function business_can_retrieve_stripe_credentials()
    {
        // Create a Business With Stripe Credentials
        $secret_key = 'sk_test_Eb4AaKxsbWa00R9Vt8bNJTkw';
        $publishable_key = 'pk_test_40LE79KgE1153YjxmHIAlKnO';
        $business = factory(Business::class)->create();
        $business->updateSettings([
            'publishable_key' => $publishable_key,
            'secret_key' => $secret_key
        ]);

        $credentials = $business->getStripeCredentials();

        $this->assertInstanceOf(App\ValueObjects\StripeCredentials::class, $credentials);
        $this->assertEquals($credentials->getSecretKey(), $secret_key);
        $this->assertEquals($credentials->getPublishableKey(), $publishable_key);
    }
}
