<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class AuthPasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_request_a_password_reset_link_and_reset_password(): void
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'student@example.com',
            'password' => Hash::make('oldpassword123'),
        ]);

        $this->from('/login')
            ->post('/forgot-password', ['email' => $user->email])
            ->assertRedirect('/login');

        Notification::assertSentTo($user, CustomResetPasswordNotification::class);

        $token = Password::createToken($user);

        $this->from('/reset-password/' . $token . '?email=' . urlencode($user->email))
            ->post('/reset-password', [
                'token' => $token,
                'email' => $user->email,
                'password' => 'newPassword123',
                'password_confirmation' => 'newPassword123',
            ])
            ->assertRedirect('/login');

        $this->assertTrue(Hash::check('newPassword123', $user->fresh()->password));
    }

    public function test_password_reset_requires_matching_confirmation(): void
    {
        $user = User::factory()->create([
            'email' => 'student2@example.com',
            'password' => Hash::make('oldpassword123'),
        ]);

        $token = Password::createToken($user);

        $this->from('/reset-password/' . $token . '?email=' . urlencode($user->email))
            ->post('/reset-password', [
                'token' => $token,
                'email' => $user->email,
                'password' => 'newPassword123',
                'password_confirmation' => 'differentPassword123',
            ])
            ->assertSessionHasErrors('password');

        $this->assertTrue(Hash::check('oldpassword123', $user->fresh()->password));
    }
}
