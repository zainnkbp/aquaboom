<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_forgot_password_screen_can_be_rendered(): void
    {
        $response = $this->get('/forgot-password');
        $response->assertStatus(200);
        $response->assertSee('LUPA KATA SANDI');
    }

    public function test_reset_password_link_can_be_requested(): void
    {
        Mail::fake();

        $user = User::create([
            'name' => 'Reset Test Customer',
            'email' => 'reset_test_' . uniqid() . '@example.com',
            'phone' => '08123456789',
            'password' => Hash::make('oldpassword123'),
            'role' => User::ROLE_CUSTOMER,
        ]);

        $response = $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        $response->assertSessionHas('status');
        $this->assertDatabaseHas('password_reset_tokens', [
            'email' => $user->email,
        ]);
    }

    public function test_reset_password_screen_can_be_rendered_with_token(): void
    {
        $email = 'token_screen_' . uniqid() . '@example.com';
        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => Hash::make($token),
            'created_at' => now(),
        ]);

        $response = $this->get("/reset-password/{$token}?email=" . urlencode($email));
        $response->assertStatus(200);
        $response->assertSee('ATUR ULANG KATA SANDI');
    }

    public function test_password_can_be_reset_with_valid_token(): void
    {
        $user = User::create([
            'name' => 'Valid Reset User',
            'email' => 'valid_reset_' . uniqid() . '@example.com',
            'phone' => '08123456789',
            'password' => Hash::make('oldpassword123'),
            'role' => User::ROLE_CUSTOMER,
        ]);

        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => Hash::make($token),
            'created_at' => now(),
        ]);

        $response = $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'newsecretpassword123',
            'password_confirmation' => 'newsecretpassword123',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHas('status');

        $user->refresh();
        $this->assertTrue(Hash::check('newsecretpassword123', $user->password));
        $this->assertDatabaseMissing('password_reset_tokens', [
            'email' => $user->email,
        ]);
    }
}
