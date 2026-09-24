<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Setting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $settings = [
            [
                'key' => 'top_promo_is_active',
                'value' => '1',
                'group' => 'homepage',
                'type' => 'text',
            ],
            [
                'key' => 'top_promo_badge',
                'value' => 'PROMO',
                'group' => 'homepage',
                'type' => 'text',
            ],
            [
                'key' => 'top_promo_text',
                'value' => '🎉 Paket Promo Corporate & Family Gathering (Min. 10 Pax) — Konsultasi Sekarang!',
                'group' => 'homepage',
                'type' => 'text',
            ],
            [
                'key' => 'top_promo_text_en',
                'value' => '🎉 Special Corporate & Group Gathering Rates (Min. 10 Pax) — Inquire Now!',
                'group' => 'homepage',
                'type' => 'text',
            ],
            [
                'key' => 'top_promo_link',
                'value' => '/gatherings',
                'group' => 'homepage',
                'type' => 'text',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Setting::whereIn('key', [
            'top_promo_is_active',
            'top_promo_badge',
            'top_promo_text',
            'top_promo_text_en',
            'top_promo_link',
        ])->delete();
    }
};
