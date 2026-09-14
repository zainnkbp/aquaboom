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
        $setting = Setting::where('key', 'philosophy_video_url')->first();
        if ($setting && !empty($setting->value)) {
            $cleanUrl = preg_replace('/[&?]loop=[0-9]/', '', $setting->value);
            $cleanUrl = preg_replace('/[&?]playlist=[^&]+/', '', $cleanUrl);
            $cleanUrl = preg_replace('/[&?]autoplay=[0-9]/', '', $cleanUrl);
            $cleanUrl = preg_replace('/[&?]mute=[0-9]/', '', $cleanUrl);
            // Ensure proper query string separator
            $cleanUrl = rtrim($cleanUrl, '?&');
            if (!str_contains($cleanUrl, '?')) {
                $cleanUrl .= '?rel=0';
            } elseif (!str_contains($cleanUrl, 'rel=')) {
                $cleanUrl .= '&rel=0';
            }
            $setting->update(['value' => $cleanUrl]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Safe rollback
        $setting = Setting::where('key', 'philosophy_video_url')->first();
        if ($setting) {
            $setting->update(['value' => 'https://www.youtube.com/embed/2ugEGMhBPNE?autoplay=1&mute=1&loop=1&playlist=2ugEGMhBPNE']);
        }
    }
};
