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
        HomePageCard::truncate();
        AddOn::truncate();

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
            ['key' => 'hero_headline', 'value' => "BUKA SETIAP HARI\n<span class=\"gold-shimmer\">DAILY OPEN</span>", 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'hero_subheadline', 'value' => 'Weekday: 10.00 - 18.00 | Weekend: 09.00 - 18.00', 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'hero_description', 'value' => 'Aquaboom Waterpark Balikpapan — Satu-satunya Waterpark yang berada di atas gedung bertingkat di Indonesia. Managed by Astara Hotel Balikpapan.', 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'philosophy_text', 'value' => 'Aquaboom Waterpark Balikpapan menghadirkan pengalaman rekreasi air urban yang unik. Berlokasi strategis di pusat kota Balikpapan (BSB Area), kami menawarkan keceriaan wahana air premium di atap gedung dengan pemandangan kota yang menakjubkan.', 'group' => 'about', 'type' => 'text'],
            ['key' => 'mission_text', 'value' => 'Terletak di Lantai 7 Astara Hotel - Balikpapan Superblock, Aquaboom menghadirkan standar baru rekreasi air perkotaan. Kami menggabungkan keseruan bermain air berkelas dengan aksesibilitas dan kenyamanan modern.', 'group' => 'about', 'type' => 'text'],
        ]);

        // FAQs
        Faq::insert([
            ['question' => 'Jam berapa jam operasional Aquaboom?', 'answer' => 'Kami buka setiap hari. Hari Biasa (Weekday) pukul 10:00 WITA - 18:00 WITA, dan Hari Libur/Akhir Pekan (Weekend) pukul 09:00 WITA - 18:00 WITA.', 'sort_order' => 1, 'is_active' => true],
            ['question' => 'Bagaimana ketentuan pakaian renang?', 'answer' => 'Demi kenyamanan dan keselamatan, pengunjung disarankan menggunakan pakaian renang yang nyaman. Pakaian dengan kancing besi menonjol atau ritsleting tajam dilarang di seluncuran besar.', 'sort_order' => 2, 'is_active' => true],
            ['question' => 'Apakah boleh membawa makanan dan minuman dari luar?', 'answer' => 'Makanan dan minuman dari luar tidak diperkenankan dibawa masuk ke area waterpark untuk menjaga kebersihan dan higienitas area kolam.', 'sort_order' => 3, 'is_active' => true],
            ['question' => 'Apakah tersedia penyewaan loker dan handuk?', 'answer' => 'Ya, kami menyediakan fasilitas penyewaan loker penyimpanan barang berharga serta penyewaan handuk bersih untuk kenyamanan kunjungan Anda.', 'sort_order' => 4, 'is_active' => true],
        ]);

        // Awards (Kosong karena tidak ada di web resmi)
        // Award::insert([]);

        // Facilities
        Facility::insert([
            ['name' => 'Oasis Food Court', 'type' => 'dining', 'description' => 'Tempat menikmati aneka makanan ringan favorit, hidangan lezat khas lokal, dan minuman segar setelah bermain air.', 'features' => json_encode(['Menu variatif', 'Minuman dingin segar', 'Area bersih nyaman']), 'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/fasilitas.png', 'is_active' => true],
        ]);

        // Home Page Cards
        HomePageCard::insert([
            ['title' => 'Pilih Tiket Masuk', 'description' => 'Beli tiket masuk lebih mudah secara online melalui website kami untuk menikmati keseruan tak terbatas.', 'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/Tiket.png', 'link' => '/ticket', 'link_text' => 'Pesan Tiket', 'sort_order' => 1, 'is_active' => true],
            ['title' => 'Tentang Kami', 'description' => 'Aquaboom Waterpark Balikpapan adalah satu-satunya waterpark di Indonesia yang berada di atas gedung bertingkat.', 'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/V1.jpg', 'link' => '/about', 'link_text' => 'Baca Selengkapnya', 'sort_order' => 2, 'is_active' => true],
            ['title' => 'Petunjuk Arah & Lokasi', 'description' => 'Berlokasi strategis di Lantai 7 Astara Hotel, kawasan Balikpapan Super Block (BSB), Jl. Jenderal Sudirman No. 47.', 'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/V2.jpg', 'link' => '/about#lokasi', 'link_text' => 'Lihat Lokasi', 'sort_order' => 3, 'is_active' => true],
            ['title' => 'Fasilitas Lengkap', 'description' => 'Nikmati kenyamanan fasilitas hotel bintang 4, Musholla, Kamar Bilas bersih, Toilet, hingga Gazebo nyaman untuk bersantai.', 'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/fasilitas.png', 'link' => '/facilities', 'link_text' => 'Lihat Fasilitas', 'sort_order' => 4, 'is_active' => true],
            ['title' => 'Tanya Jawab (FAQ)', 'description' => 'Dapatkan jawaban lengkap mengenai ketentuan pakaian renang, penyimpanan loker, makanan, dan persyaratan lainnya.', 'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/funfact.png', 'link' => '/faq', 'link_text' => 'Lihat FAQ', 'sort_order' => 5, 'is_active' => true],
        ]);
    }
}
