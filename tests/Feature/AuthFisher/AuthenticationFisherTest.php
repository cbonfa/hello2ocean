<?php

namespace Tests\Feature\AuthFisher;

use App\Models\Fisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationFisherTest extends TestCase
{
    use RefreshDatabase;

    protected $dropViews = true;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/fisher/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = Fisher::factory()->create();

        $response = $this->post('/fisher/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated('fisher');
        $response->assertRedirect(route('boat.index', absolute: false));
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = Fisher::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
