<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use App\Models\Faq;
use App\Models\TicketPackage;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Setting::updateOrCreate(
            ['key' => 'hero_subheadline'],
            ['value' => 'Setiap Hari: 09.00 - 18.00 WITA', 'group' => 'homepage', 'type' => 'text']
        );

        Setting::updateOrCreate(
            ['key' => 'hero_subheadline_en'],
            ['value' => 'Daily: 09:00 AM - 6:00 PM WITA', 'group' => 'homepage', 'type' => 'text']
        );

        Setting::updateOrCreate(
            ['key' => 'hero_description'],
            ['value' => 'Aquaboom Waterpark Balikpapan — Waterpark ikonik di Balikpapan yang berada di 7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan. Managed by Astara Hotel Balikpapan.', 'group' => 'homepage', 'type' => 'text']
        );

        Setting::updateOrCreate(
            ['key' => 'hero_description_en'],
            ['value' => "Aquaboom Waterpark Balikpapan — Balikpapan's iconic waterpark located on 7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan. Managed by Astara Hotel Balikpapan.", 'group' => 'homepage', 'type' => 'text']
        );

        if (\Illuminate\Support\Facades\Schema::hasTable('home_page_cards')) {
            \Illuminate\Support\Facades\DB::table('home_page_cards')
                ->where('description', 'like', '%Indonesia%')
                ->orWhere('description', 'like', '%satu-satunya%')
                ->update([
                    'description' => 'Aquaboom Waterpark Balikpapan — Waterpark ikonik di Balikpapan yang menghadirkan keseruan rekreasi air premium di 7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan.'
                ]);
        }

        Setting::updateOrCreate(
            ['key' => 'philosophy_text'],
            ['value' => 'Aquaboom Waterpark Balikpapan menghadirkan pengalaman rekreasi air urban yang unik di Balikpapan. Berlokasi strategis di pusat kota Balikpapan (BSB Area), kami menawarkan keceriaan wahana air premium di 7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan.', 'group' => 'about', 'type' => 'text']
        );

        Setting::updateOrCreate(
            ['key' => 'philosophy_text_en'],
            ['value' => 'Aquaboom Waterpark Balikpapan brings a unique urban water recreation experience in Balikpapan. Strategically located in the heart of Balikpapan (BSB Area), we offer the joy of premium water slides on 7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan.', 'group' => 'about', 'type' => 'text']
        );

        Setting::updateOrCreate(
            ['key' => 'mission_text'],
            ['value' => 'Terletak di Lantai 7 (Shared Common Area Astara Hotel & Pentacity Hotel Balikpapan) - Balikpapan Superblock, Aquaboom menghadirkan standar baru rekreasi air perkotaan di Balikpapan. Kami menggabungkan keseruan bermain air berkelas dengan aksesibilitas dan kenyamanan modern.', 'group' => 'about', 'type' => 'text']
        );

        Setting::updateOrCreate(
            ['key' => 'mission_text_en'],
            ['value' => 'Located on the 7th Floor (Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan) - Balikpapan Superblock, Aquaboom presents a new standard of urban water recreation in Balikpapan. We combine the excitement of high-class water play with accessibility and modern comfort.', 'group' => 'about', 'type' => 'text']
        );

        Faq::where('question', 'like', '%jam operasional%')->orWhere('question_en', 'like', '%operational hours%')->update([
            'answer' => 'Kami buka setiap hari (Senin — Minggu & Libur Nasional) mulai pukul 09:00 WITA - 18:00 WITA (Batas masuk terakhir pukul 17:00 WITA).',
            'answer_en' => 'We are open daily (Monday — Sunday & Public Holidays) from 09:00 WITA - 18:00 WITA (Last admission at 17:00 WITA).'
        ]);

        TicketPackage::where('id', 1)->update([
            'description' => 'Tiket masuk harian untuk hari Senin sampai Jumat. Jam operasional: 09:00 - 18:00 WITA.',
            'description_en' => 'Daily entry ticket valid from Monday to Friday. Operational hours: 09:00 - 18:00 WITA.'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
