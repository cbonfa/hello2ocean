<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminWaveCrudTest extends TestCase
{
    use DatabaseTransactions;

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

}
