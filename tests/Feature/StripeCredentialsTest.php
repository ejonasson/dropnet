<?php

namespace Tests\Feature;

use App\ValueObjects\StripeCredentials;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class StripeCredentialsTest extends TestCase
{
    /** @test */
    public function stripe_credentails_object_is_created_properly()
    {
        $secret_key = 'sk_test_Eb4AaKxsbWa00R9Vt8bNJTkw';
        $publishable_key = 'pk_test_40LE79KgE1153YjxmHIAlKnO';

        $stripe = new StripeCredentials($secret_key, $publishable_key);

        $this->assertEquals('test', $stripe->getMode());
        $this->assertEquals('sk_test_Eb4AaKxsbWa00R9Vt8bNJTkw', $stripe->getSecretKey());
        $this->assertEquals('pk_test_40LE79KgE1153YjxmHIAlKnO', $stripe->getPublishableKey());
    }
}
