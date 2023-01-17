<?php

namespace Tests\Feature\Auth;

use App\Models\Fisher;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetFisherTest extends TestCase
{
    use RefreshDatabase;

    public function fisher_reset_password_link_screen_can_be_rendered()
    {
        $response = $this->get('/fisher/forgot-password');

        $response->assertStatus(200);
    }

    public function fisher_reset_password_link_can_be_requested()
    {
        Notification::fake();

        $user = Fisher::factory()->create();

        $this->post('/fisher/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function fisher_reset_password_screen_can_be_rendered()
    {
        Notification::fake();

        $user = Fisher::factory()->create();

        $this->post('/fisher/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $response = $this->get('/fisher/reset-password/'.$notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    public function fisher_password_can_be_reset_with_valid_token()
    {
        Notification::fake();

        $user = Fisher::factory()->create();

        $this->post('/fisher/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $response = $this->post('/fisher/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response->assertSessionHasNoErrors();

            return true;
        });
    }
}
