<?php

namespace Tests\Feature;

use App\Models\AddOn;
use App\Models\Holiday;
use App\Models\User;
use App\Models\TicketPackage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class NewFeaturesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test Fitur 1: Add-On Dynamic Pricing (Weekday vs Weekend / Holiday)
     */
    public function test_addon_dynamic_pricing_calculation(): void
    {
        $addon = AddOn::create([
            'name' => 'Gazebo VIP Test',
            'price' => 150000,
            'weekend_price' => 200000,
            'is_active' => true,
        ]);

        // 1. Monday (Weekday)
        $monday = '2026-09-21'; // Monday
        $this->assertEquals(150000, $addon->getEffectivePriceForDate($monday));

        // 2. Sunday (Weekend)
        $sunday = '2026-09-27'; // Sunday
        $this->assertEquals(200000, $addon->getEffectivePriceForDate($sunday));

        // 3. Fallback when weekend_price is NULL
        $addonNoWeekend = AddOn::create([
            'name' => 'Loker Biasa',
            'price' => 25000,
            'weekend_price' => null,
            'is_active' => true,
        ]);
        $this->assertEquals(25000, $addonNoWeekend->getEffectivePriceForDate($sunday));

        // Cleanup
        $addon->delete();
        $addonNoWeekend->delete();
    }

    /**
     * Test Fitur 3: Google Analytics Tag in Public Layout & Ticket
     */
    public function test_google_analytics_script_rendered(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('G-N1FGBG39DB');
        $response->assertSee('https://www.googletagmanager.com/gtag/js?id=G-N1FGBG39DB', false);
    }

    /**
     * Test Fitur 4: Google OAuth Redirect Route
     */
    public function test_google_oauth_routes_exist(): void
    {
        // When credentials are not yet configured in test env, it should gracefully redirect with error message
        $response = $this->get('/auth/google');
        $response->assertRedirect('/login');

        // Route name resolution
        $this->assertTrue(\Illuminate\Support\Facades\Route::has('auth.google'));
        $this->assertTrue(\Illuminate\Support\Facades\Route::has('auth.google.callback'));
    }

    /**
     * Test Fitur 5: Email Verification System
     */
    public function test_email_verification_routes_and_notification(): void
    {
        Notification::fake();

        $user = User::create([
            'name' => 'Test Verif Customer',
            'email' => 'verif_test_' . uniqid() . '@example.com',
            'phone' => '081299887766',
            'password' => bcrypt('password123'),
            'role' => User::ROLE_CUSTOMER,
        ]);

        $user->sendEmailVerificationNotification();

        Notification::assertSentTo($user, \App\Notifications\AquaboomVerifyEmail::class);

        $user->delete();
    }

    /**
     * Test Fitur 6: Customer Phone retention on Registration & Profile
     */
    public function test_customer_phone_saved_on_registration(): void
    {
        $email = 'reg_phone_' . uniqid() . '@example.com';
        $response = $this->post('/register', [
            'name' => 'John Doe Phone',
            'email' => $email,
            'phone' => '081234567890',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/ticket');

        $user = User::where('email', $email)->first();
        $this->assertNotNull($user);
        $this->assertEquals('081234567890', $user->phone);

        $user->delete();
    }
}
