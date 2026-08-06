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
            ['name' => 'Aqua Play', 'description' => 'Area bermain air interaktif untuk anak-anak dengan berbagai perosotan mini, pancuran air, dan ember tumpah raksasa.', 'image_url' => 'https://picsum.photos/800/600?random=31', 'order_column' => 1],
            ['name' => 'Double Spin', 'description' => 'Seluncuran air spiral ganda yang menegangkan dengan tikungan tajam dan sensasi gravitasi tinggi.', 'image_url' => 'https://picsum.photos/800/600?random=32', 'order_column' => 2],
            ['name' => 'Tail Spin', 'description' => 'Rasakan sensasi terombang-ambing di seluncuran berbentuk corong raksasa sebelum mendarat dengan hempasan air yang menyegarkan.', 'image_url' => 'https://picsum.photos/800/600?random=33', 'order_column' => 3],
        ]);
        // Settings
        Setting::insert([
            ['key' => 'hero_video_url', 'value' => 'https://www.youtube.com/embed/2ugEGMhBPNE?autoplay=1&mute=1&loop=1&playlist=2ugEGMhBPNE&controls=0&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3&disablekb=1', 'group' => 'homepage', 'type' => 'url'],
            ['key' => 'hero_headline', 'value' => "WE ARE\n<span class=\"gold-shimmer\">OPEN DAILY</span>", 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'hero_subheadline', 'value' => '9 AM — 6 PM', 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'hero_description', 'value' => 'Aquaboom Waterpark — 7th Floor, Pentacity Mall BSB, Balikpapan. Taman air premium pertama di rooftop Kalimantan Timur.', 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'philosophy_text', 'value' => 'Menghadirkan kebahagiaan sejati dengan tetap menghormati harmoni alam sekitar. Setiap tetes air, senyum staf, dan wahana dirancang dengan kepedulian mendalam.', 'group' => 'about', 'type' => 'text'],
            ['key' => 'mission_text', 'value' => 'Terletak dengan anggun di atap Pentacity Mall - Balikpapan Superblock, Aquaboom menghadirkan standar baru rekreasi air urban. Kami menggabungkan keseruan seluncuran berkelas internasional dengan aksesibilitas dan kemewahan gaya hidup modern.', 'group' => 'about', 'type' => 'text'],
        ]);

        // FAQs
        Faq::insert([
            ['question' => 'What are your opening hours?', 'answer' => 'Kami buka setiap hari mulai pukul 09:00 WITA hingga 18:00 WITA. Kami menyarankan Anda datang lebih awal agar dapat menikmati seluruh wahana dengan puas.', 'sort_order' => 1, 'is_active' => true],
            ['question' => 'What is the swimwear policy?', 'answer' => 'Demi kenyamanan dan standar keselamatan, pengunjung wajib menggunakan pakaian renang berbahan nilon/spandex. Pakaian dengan kancing besi, ritsleting tebal, atau keliman logam dilarang di seluncuran besar.', 'sort_order' => 2, 'is_active' => true],
            ['question' => 'Can I bring outside food and drinks?', 'answer' => 'Untuk menjaga kebersihan dan higienitas area air, makanan dan minuman dari luar tidak diperkenankan dibawa masuk (kecuali air mineral botolan dan makanan bayi).', 'sort_order' => 3, 'is_active' => true],
            ['question' => 'Are there lockers and towel rentals?', 'answer' => 'Ya, kami menyediakan locker penyimpanan barang elektronik dengan keamanan tinggi dan penyewaan handuk bersih di dekat loket ruang bilas utama.', 'sort_order' => 4, 'is_active' => true],
        ]);

        // Awards
        Award::insert([
            ['title' => "Travelers' Choice", 'description' => 'Peringkat teratas sebagai destinasi favorit keluarga pilihan wisatawan regional.', 'icon' => 'travelers', 'sort_order' => 1, 'is_active' => true],
            ['title' => 'Best Rooftop Waterpark', 'description' => 'Penghargaan untuk inovasi arsitektur dan keselamatan rekreasi atas gedung terbaik.', 'icon' => 'rooftop', 'sort_order' => 2, 'is_active' => true],
            ['title' => 'Five-Star Hospitality', 'description' => 'Pengakuan atas dedikasi pelayanan ramah dan pemeliharaan fasilitas secara berkala.', 'icon' => 'hospitality', 'sort_order' => 3, 'is_active' => true],
        ]);

        // Facilities
        Facility::insert([
            ['name' => 'The Oasis Food Court', 'type' => 'dining', 'description' => 'Nikmati jus buah segar, makanan ringan favorit keluarga, hingga hidangan berat khas lokal. Berlokasi strategis tepat di sebelah kolam utama.', 'features' => json_encode(['Menu lokal & internasional', 'Minuman segar & mocktail tropis', 'Delivery ke gazebo tersedia']), 'image_url' => 'https://picsum.photos/800/600?random=10', 'is_active' => true],
            ['name' => 'BSB Mall Culinary', 'type' => 'dining', 'description' => 'Butuh pilihan kuliner tambahan? Cukup melangkah keluar ke area Pentacity & e-Walk Mall. Ratusan restoran ternama siap melengkapi petualangan Anda.', 'features' => json_encode(['Akses langsung dari Aquaboom ke area mall']), 'image_url' => 'https://picsum.photos/800/600?random=11', 'is_active' => true],
        ]);

        // Home Page Cards
        HomePageCard::insert([
            ['title' => 'Are you more thrill or chill?', 'description' => 'Explore our diverse collection of adrenaline-pumping slides or relaxing lazy rivers.', 'image_url' => 'https://picsum.photos/600/400?random=21', 'link' => '/explore', 'link_text' => 'Explore Attractions', 'sort_order' => 1, 'is_active' => true],
            ['title' => 'Check out our new Gazebos!', 'description' => 'Introducing new luxurious, private gazebos perfect for relaxing and dining with friends and family.', 'image_url' => 'https://picsum.photos/600/400?random=22', 'link' => '/explore#gazebos', 'link_text' => 'View Cabanas', 'sort_order' => 2, 'is_active' => true],
            ['title' => 'Time to Eat and Drink', 'description' => 'Indulge in a huge selection of freshly made tropical dishes and mocktails around the park.', 'image_url' => 'https://picsum.photos/600/400?random=23', 'link' => '/dining', 'link_text' => 'Browse Menu', 'sort_order' => 3, 'is_active' => true],
            ['title' => 'We Call It, Karmic Returns', 'description' => 'A recap of our environment & sustainability initiatives, saving water and conserving energy.', 'image_url' => 'https://picsum.photos/600/400?random=24', 'link' => '/about#sustainability', 'link_text' => 'Our Vision', 'sort_order' => 4, 'is_active' => true],
            ['title' => 'Find out more about us', 'description' => 'Learn about our heritage, founders, awards, and our incredible park team.', 'image_url' => 'https://picsum.photos/600/400?random=25', 'link' => '/about', 'link_text' => 'Read Our Story', 'sort_order' => 5, 'is_active' => true],
            ['title' => 'Still Have Questions?', 'description' => 'Get all the details about height requirements, lockers, food, and ticketing before you arrive.', 'image_url' => 'https://picsum.photos/600/400?random=26', 'link' => '/faq', 'link_text' => 'Find Answers', 'sort_order' => 6, 'is_active' => true],
        ]);
    }
}
