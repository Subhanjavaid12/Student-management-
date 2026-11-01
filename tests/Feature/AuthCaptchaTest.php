<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthCaptchaTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_rejects_lowercase_input_for_an_uppercase_captcha(): void
    {
        $this->withSession(['login_captcha' => 'HPK'])
            ->post('/login', [
                'captcha' => 'hpk',
            ])
            ->assertSessionHasErrors('captcha');
    }

    public function test_login_accepts_exact_case_for_an_uppercase_captcha(): void
    {
        $user = User::factory()->create([
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
        ]);

        $this->withSession(['login_captcha' => 'HPK'])
            ->post('/login', [
                'captcha' => 'HPK',
                'email' => $user->email,
                'password' => 'password',
            ])
            ->assertRedirect(route('dashboard'))
            ->assertSessionHasNoErrors();

        $this->assertAuthenticatedAs($user);
    }
}
