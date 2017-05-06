<?php

namespace Tests\Unit;

use App\CardUpdateToken;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CardUpdateTokenTest extends TestCase
{
    /** @test */
    function hash_is_random_with_each_build()
    {
        $token1 = CardUpdateToken::generate();
        $token2 = CardUpdateToken::generate();
        $token3 = CardUpdateToken::generate();

        $this->assertNotEquals($token1->toString(), $token2->toString());
        $this->assertNotEquals($token2->toString(), $token3->toString());
        $this->assertNotEquals($token1->toString(), $token3->toString());
    }
}
