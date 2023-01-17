<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\Fisher;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationFisherTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected $dropViews = true;

    public function setup(): void
    {
        parent::setup();
        $this->user = Fisher::factory()->create();
    }    

    public function test_fisher_registration_screen_can_be_rendered()
    {
        $response = $this->actingAs($this->user)->get('/fisher/register');

        $response->assertStatus(200);
    }

    public function test_fisher_new_users_can_register()
    {
        $response = $this->actingAs($this->user)->post('/fisher/register', [
            'name' => 'Test Fisher',
            'email' => 'fisher@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::BOAT);
    }
}
