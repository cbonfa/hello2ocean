<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected $dropViews = true;

    private $user;

    public function setup(): void
    {
        parent::setup();
        $this->user = User::factory()->create();
    }    

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->actingAs($this->user)->get('/hydrosphere/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->actingAs($this->user)->post('/hydrosphere/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
