<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegistrationTest extends DuskTestCase
{
    /**
     * Attempt to register our account
     * @test
     * @group wip
     */
    public function user_can_register_account()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                ->type('business', 'Test Business')
                ->type('email', 'ejonasson@gmail.com')
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->press('Register')
                ->assertSee('Dashboard');
        });
    }
}
