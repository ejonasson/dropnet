<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class CreateSequenceTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * @test
     * @group sequences
     */
    public function user_can_create_new_sequence()
    {
        $this->browse(function ($browser) {
            $browser->visit('/test/sequence')
                ->assertSee('Add New Sequence')
                ->clickLink('Add New Sequence')
                ->assertPathIs('/test/sequence/create');
        });
    }
}
