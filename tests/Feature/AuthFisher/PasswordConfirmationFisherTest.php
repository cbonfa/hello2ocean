<?php

namespace Tests\Feature\AuthFisher;

use App\Models\Fisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationFisherTest extends TestCase
{
    use RefreshDatabase;

    protected $dropViews = true;

    public function confirm_fisher_password_screen_can_be_rendered()
    {
        $user = Fisher::factory()->create();

        $response = $this->actingAs($user)->get('/hydrosphere/confirm-password');

        $response->assertStatus(200);
    }

    public function password_fisher_can_be_confirmed()
    {
        $user = Fisher::factory()->create();

        $response = $this->actingAs($user)->post('/hydrosphere/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function password_fisher_is_not_confirmed_with_invalid_password()
    {
        $user = Fisher::factory()->create();

        $response = $this->actingAs($user)->post('/hydrosphere/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
