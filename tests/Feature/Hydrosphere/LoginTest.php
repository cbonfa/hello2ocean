<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    public function test_login_redirect_to_hydrosphere_successfully(){
        User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password')
        ]);
        $response = $this->post('/hydrosphere/login', [
            'email' => 'test@test.com',
            'password' => 'password'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/hydrosphere');
        
    }

    public function test_auth_user_can_access_hydrosphere(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/hydrosphere');
        $response->assertStatus(200);
    }

    public function test_auth_user_cannot_access_hydrosphere(){
        $response = $this->get('/hydrosphere');
        $response->assertStatus(302);
        $response->assertRedirect('/hydrosphere/login');
    }
}
