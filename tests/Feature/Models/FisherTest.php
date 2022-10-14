<?php

namespace Tests\Feature\Models;

use App\Models\Fisher;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class FisherTest extends TestCase
{
    use DatabaseTransactions;

    public function test_fisher_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('fishers', [
            'id','name', 'nick', 'sign_in_count',
            'email', 'email_verified_at', 'last_sign_in_at', 
            'password', 'language_id'
        ]), 1);
    }

    public function teste_create_fisher(){
        $this->assertInstanceOf(Fisher::class, Fisher::factory()->create()); 
    }

    public function test_return_waves(){
        $this->markTestIncomplete('Inclomplete: must be revisited');
    }

}
