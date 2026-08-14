<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Faq;
use App\Models\Award;
use App\Models\Facility;
use App\Models\HomePageCard;
use App\Models\Wahana;
use App\Models\AddOn;
use App\Models\TicketPackage;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate tables to allow safe re-running
        Wahana::truncate();
        Setting::truncate();
        Faq::truncate();
        Award::truncate();
        Facility::truncate();
        AddOn::truncate();
        TicketPackage::truncate();

        // Add-ons Seeding
        AddOn::insert([
            ['name' => 'Sewa Gazebo Standard', 'description' => 'Gazebo nyaman kapasitas 4-6 orang untuk bersantai bersama keluarga, include stopkontak dan matras empuk.', 'price' => 150000.00, 'image' => 'https://picsum.photos/400/300?random=81', 'is_active' => true],
            ['name' => 'Single Tube (Ban Single)', 'description' => 'Sewa ban renang single untuk meluncur lebih cepat dan nyaman di wahana seluncuran.', 'price' => 30000.00, 'image' => 'https://picsum.photos/400/300?random=82', 'is_active' => true],
            ['name' => 'Double Tube (Ban Double)', 'description' => 'Sewa ban renang double untuk meluncur berpasangan bersama teman atau keluarga.', 'price' => 50000.00, 'image' => 'https://picsum.photos/400/300?random=83', 'is_active' => true],
            ['name' => 'Loker Premium', 'description' => 'Sewa loker ukuran besar dengan pengaman kunci digital RFID untuk kenyamanan barang bawaan Anda.', 'price' => 25000.00, 'image' => 'https://picsum.photos/400/300?random=84', 'is_active' => true],
        ]);

        // Wahanas
        Wahana::insert([
            ['name' => 'Giant Bucket Playground', 'description' => 'Area bermain air interaktif utama dengan ember tumpah raksasa dan berbagai seluncuran seru.', 'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/V1.jpg', 'order_column' => 1],
            ['name' => 'Rooftop Splash Pool', 'description' => 'Nikmati sensasi berenang yang menyenangkan langsung di rooftop dengan pemandangan kota Balikpapan.', 'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/V2.jpg', 'order_column' => 2],
            ['name' => 'Family Water Playground', 'description' => 'Wahana permainan air keluarga yang aman dan menyenangkan untuk anak-anak hingga dewasa.', 'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/V3.jpg', 'order_column' => 3],
        ]);

        // Settings
        Setting::insert([
            ['key' => 'hero_video_url', 'value' => 'https://www.youtube.com/embed/2ugEGMhBPNE?autoplay=1&mute=1&loop=1&playlist=2ugEGMhBPNE&controls=0&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3&disablekb=1', 'group' => 'homepage', 'type' => 'url'],
            ['key' => 'hero_video_file', 'value' => null, 'group' => 'homepage', 'type' => 'file'],
            ['key' => 'hero_headline', 'value' => "BUKA SETIAP HARI\n<span class=\"gold-shimmer\">DAILY OPEN</span>", 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'hero_subheadline', 'value' => 'Weekday: 10.00 - 18.00 | Weekend: 09.00 - 18.00', 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'hero_description', 'value' => 'Aquaboom Waterpark Balikpapan — Satu-satunya Waterpark yang berada di atas gedung bertingkat di Indonesia. Managed by Astara Hotel Balikpapan.', 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'philosophy_text', 'value' => 'Aquaboom Waterpark Balikpapan menghadirkan pengalaman rekreasi air urban yang unik. Berlokasi strategis di pusat kota Balikpapan (BSB Area), kami menawarkan keceriaan wahana air premium di atap gedung dengan pemandangan kota yang menakjubkan.', 'group' => 'about', 'type' => 'text'],
            ['key' => 'philosophy_video_url', 'value' => 'https://www.youtube.com/embed/2ugEGMhBPNE?autoplay=1&mute=1&loop=1&playlist=2ugEGMhBPNE', 'group' => 'about', 'type' => 'url'],
            ['key' => 'philosophy_video_file', 'value' => null, 'group' => 'about', 'type' => 'file'],
            ['key' => 'mission_text', 'value' => 'Terletak di Lantai 7 Astara Hotel - Balikpapan Superblock, Aquaboom menghadirkan standar baru rekreasi air perkotaan. Kami menggabungkan keseruan bermain air berkelas dengan aksesibilitas dan kenyamanan modern.', 'group' => 'about', 'type' => 'text'],
        ]);

        // FAQs
        Faq::insert([
            ['question' => 'Jam berapa jam operasional Aquaboom?', 'answer' => 'Kami buka setiap hari. Hari Biasa (Weekday) pukul 10:00 WITA - 18:00 WITA, dan Hari Libur/Akhir Pekan (Weekend) pukul 09:00 WITA - 18:00 WITA.', 'sort_order' => 1, 'is_active' => true],
            ['question' => 'Bagaimana ketentuan pakaian renang?', 'answer' => 'Demi kenyamanan dan keselamatan, pengunjung disarankan menggunakan pakaian renang yang nyaman. Pakaian dengan kancing besi menonjol atau ritsleting tajam dilarang di seluncuran besar.', 'sort_order' => 2, 'is_active' => true],
            ['question' => 'Apakah boleh membawa makanan dan minuman dari luar?', 'answer' => 'Makanan dan minuman dari luar tidak diperkenankan dibawa masuk ke area waterpark untuk menjaga kebersihan dan higienitas area kolam.', 'sort_order' => 3, 'is_active' => true],
            ['question' => 'Apakah tersedia penyewaan loker dan handuk?', 'answer' => 'Ya, kami menyediakan fasilitas penyewaan loker penyimpanan barang berharga serta penyewaan handuk bersih untuk kenyamanan kunjungan Anda.', 'sort_order' => 4, 'is_active' => true],
        ]);

        // Facilities
        Facility::insert([
            [
                'name' => 'Oasis Food Court',
                'type' => 'dining',
                'description' => 'Tempat menikmati aneka makanan ringan favorit, hidangan lezat khas lokal, dan minuman segar setelah bermain air.',
                'features' => json_encode(['Menu variatif', 'Minuman dingin segar', 'Area bersih nyaman']),
                'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/fasilitas.png',
                'is_active' => true
            ],
            [
                'name' => 'GAZEBO PRIBADI & CABANA',
                'type' => 'gazebo',
                'description' => 'Tingkatkan kenyamanan kunjungan Anda dengan menyewa Gazebo pribadi. Terletak di area teduh nan asri, lengkap dengan layanan pesan antar makanan, pengisian daya, dan privasi penuh.',
                'features' => json_encode([
                    'Layanan makanan & minuman langsung ke gazebo',
                    'Privasi & kenyamanan maksimal',
                    'Kapasitas 4–8 orang per gazebo'
                ]),
                'image_url' => 'https://picsum.photos/600/400?random=40',
                'is_active' => true
            ],
            [
                'name' => 'PENYEWAAN LOKER & HANDUK',
                'type' => 'general',
                'description' => 'Nikmati petualangan air tanpa rasa cemas. Kami menyediakan fasilitas loker otomatis dengan keamanan terintegrasi, serta penyewaan handuk bersih yang selalu disterilkan secara berkala.',
                'features' => json_encode([
                    'Sistem kunci loker menggunakan gelang RFID / pin',
                    'Handuk premium bersih & higienis',
                    'Lokasi loker strategis dekat ruang bilas'
                ]),
                'image_url' => 'https://picsum.photos/600/400?random=42',
                'is_active' => true
            ],
            [
                'name' => 'RUANG BILAS & RUANG GANTI',
                'type' => 'general',
                'description' => 'Ruang bilas dan ruang ganti premium kami dirancang dengan mengutamakan kebersihan dan kenyamanan. Dilengkapi dengan pancuran air hangat, bilik ganti pribadi yang luas, serta pengering rambut.',
                'features' => json_encode([
                    'Bilik shower pribadi dengan air hangat',
                    'Peralatan mandi lengkap (sabun & sampo cair)',
                    'Wastafel dan cermin rias berukuran besar'
                ]),
                'image_url' => 'https://picsum.photos/600/400?random=44',
                'is_active' => true
            ],
            [
                'name' => 'KLINIK PERTOLONGAN PERTAMA (P3K)',
                'type' => 'general',
                'description' => 'Keselamatan Anda adalah prioritas utama kami. Klinik P3K Aquaboom dilengkapi dengan peralatan medis darurat standar internasional serta dipandu oleh tim medis terlatih yang bersertifikasi.',
                'features' => json_encode([
                    'Perawat dan pertolongan medis siaga selama jam operasional',
                    'Obat-obatan umum dan peralatan bantuan darurat lengkap',
                    'Akses jalur evakuasi darurat yang cepat'
                ]),
                'image_url' => 'https://picsum.photos/600/400?random=46',
                'is_active' => true
            ],
            [
                'name' => 'MUSHOLA',
                'type' => 'general',
                'description' => 'Kami menyediakan ruang ibadah (Mushola) yang tenang, sejuk, dan bersih untuk menunjang kenyamanan ibadah Anda. Terpisah secara higienis antara area wudhu pria dan wanita.',
                'features' => json_encode([
                    'Tempat wudhu bersih terpisah gender',
                    'Dilengkapi sajadah, mukena, sarung, dan Al-Quran',
                    'Ruangan ber-AC yang nyaman'
                ]),
                'image_url' => 'https://picsum.photos/600/400?random=48',
                'is_active' => true
            ],
        ]);

        // Ticket Packages (Special Offers) Seeding
        TicketPackage::insert([
            [
                'name' => 'Tiket Regular Weekdays',
                'name_en' => 'Regular Weekday Ticket',
                'description' => 'Tiket masuk harian untuk hari Senin sampai Jumat. Jam operasional: 10:00 - 18:00 WITA.',
                'description_en' => 'Daily entry ticket valid from Monday to Friday. Operational hours: 10:00 - 18:00 WITA.',
                'price' => 95000.00,
                'discount_price' => null,
                'discount_type' => 'amount',
                'type' => 'regular',
                'validity_type' => 'weekday',
                'image_url' => 'https://picsum.photos/600/400?random=60',
                'inquiry_type' => 'none',
                'inquiry_custom_link' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Tiket Regular Weekend',
                'name_en' => 'Regular Weekend Ticket',
                'description' => 'Tiket masuk harian untuk hari Sabtu, Minggu, dan Libur Nasional. Jam operasional: 09:00 - 18:00 WITA.',
                'description_en' => 'Daily entry ticket valid on Saturday, Sunday, and National Holidays. Operational hours: 09:00 - 18:00 WITA.',
                'price' => 125000.00,
                'discount_price' => null,
                'discount_type' => 'amount',
                'type' => 'regular',
                'validity_type' => 'weekend',
                'image_url' => 'https://picsum.photos/600/400?random=61',
                'inquiry_type' => 'none',
                'inquiry_custom_link' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Duo Pass',
                'name_en' => 'Duo Pass',
                'description' => 'Tiket masuk untuk 2 orang + 2 handuk + 1 locker standar gratis + 30 menit foot massage masing-masing. Hemat hingga 15%!',
                'description_en' => 'Entry ticket for 2 people + 2 pool towels + 1 locker standard + 30 mins foot massage each. Save up to 15%!',
                'price' => 320000.00,
                'discount_price' => 270000.00,
                'discount_type' => 'amount',
                'type' => 'bundle',
                'validity_type' => 'all_days',
                'image_url' => 'https://picsum.photos/600/400?random=51',
                'inquiry_type' => 'none',
                'inquiry_custom_link' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Four Pack Pass',
                'name_en' => 'Four Pack Pass',
                'description' => 'Tiket masuk untuk 4 orang (dewasa/anak) + 4 handuk kolam gratis + 1 family locker + Voucher makanan Rp 100.000 + 10% off spa treatment per orang. Hemat hingga 25%!',
                'description_en' => 'Entry ticket for 4 people + 4 pool towels + 1 family locker + Food Voucher Rp 100.000 + 10% off spa treatment per person. Save up to 25%!',
                'price' => 600000.00,
                'discount_price' => 450000.00,
                'discount_type' => 'amount',
                'type' => 'bundle',
                'validity_type' => 'all_days',
                'image_url' => 'https://picsum.photos/600/400?random=52',
                'inquiry_type' => 'none',
                'inquiry_custom_link' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Birthday Package',
                'name_en' => 'Birthday Package',
                'description' => '10 tiket masuk + gazebo + dekorasi ulang tahun + kue ulang tahun + 10 minuman non-alkohol + special gift dari Aquaboom + voucher Rp 200.000 in-park.',
                'description_en' => '10 entry tickets + gazebo + birthday decoration + birthday cake + 10 non-alcoholic drinks + special gift + Rp 200.000 in-park credit.',
                'price' => 1800000.00,
                'discount_price' => null,
                'discount_type' => 'amount',
                'type' => 'bundle',
                'validity_type' => 'all_days',
                'image_url' => 'https://picsum.photos/600/400?random=53',
                'inquiry_type' => 'whatsapp',
                'inquiry_custom_link' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Unlimited Annual Pass',
                'name_en' => 'Unlimited Annual Pass',
                'description' => 'Akses tak terbatas selama 12 bulan penuh + 1 handuk gratis per kunjungan + 20% off untuk tambahan 4 teman per kunjungan + 10% off gazebo, locker & merchandise. Dewasa: Rp 780.000, Anak (2-11 th): Rp 660.000.',
                'description_en' => 'Unlimited 12-month access + 1 free towel per visit + 20% off for up to 4 friends per visit + 10% off gazebo, locker & merchandise. Adult: Rp 780,000, Child: Rp 660,000.',
                'price' => 780000.00,
                'discount_price' => null,
                'discount_type' => 'amount',
                'type' => 'bundle',
                'validity_type' => 'all_days',
                'image_url' => 'https://picsum.photos/600/400?random=54',
                'inquiry_type' => 'whatsapp',
                'inquiry_custom_link' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Return Day Pass',
                'name_en' => 'Return Day Pass',
                'description' => 'Hemat lebih dari 15% untuk kunjungan kedua Anda dalam 7 hari! Hanya bisa dibeli di loket dalam taman. Dewasa: Rp 63.000, Anak (2-11 th): Rp 50.000.',
                'description_en' => 'Save over 15% on your second visit within 7 days! Only available for purchase inside the park. Adult: Rp 63,000, Child: Rp 50,000.',
                'price' => 63000.00,
                'discount_price' => null,
                'discount_type' => 'amount',
                'type' => 'bundle',
                'validity_type' => 'all_days',
                'image_url' => 'https://picsum.photos/600/400?random=55',
                'inquiry_type' => 'none',
                'inquiry_custom_link' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Custom Group Package',
                'name_en' => 'Custom Group Package',
                'description' => 'Paket rombongan perusahaan, gathering tim, atau kunjungan sekolah/keluarga besar di atas 20 orang. Bisa kustom makanan, area eksklusif, & dedicated event coordinator.',
                'description_en' => 'Corporate gatherings, team events, or school/family trips of 20+ people. Custom meals, exclusive area reservations, & dedicated event coordinator available.',
                'price' => 0.00,
                'discount_price' => null,
                'discount_type' => 'amount',
                'type' => 'bundle',
                'validity_type' => 'all_days',
                'image_url' => 'https://picsum.photos/600/400?random=56',
                'inquiry_type' => 'whatsapp',
                'inquiry_custom_link' => null,
                'is_active' => true,
            ],
        ]);

        // Auto-reset PostgreSQL sequences to prevent duplicate key errors
        if (config('database.default') === 'pgsql') {
            $tables = ['wahanas', 'settings', 'faqs', 'awards', 'facilities', 'add_ons', 'ticket_packages', 'audit_logs'];
            foreach ($tables as $table) {
                try {
                    \Illuminate\Support\Facades\DB::statement("
                        SELECT setval(
                            pg_get_serial_sequence('{$table}', 'id'),
                            coalesce((SELECT max(id) FROM {$table}), 1)
                        )
                    ");
                } catch (\Exception $e) {
                    // Silently ignore if table doesn't have id serial
                }
            }
        }
    }
}
