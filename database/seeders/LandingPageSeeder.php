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
            [
                'name' => 'Sewa Gazebo Standard',
                'name_en' => 'Standard Gazebo Rental',
                'description' => 'Gazebo nyaman kapasitas 4-6 orang untuk bersantai bersama keluarga, include stopkontak dan matras empuk.',
                'description_en' => 'Comfortable private gazebo for 4-6 guests to relax with family, includes power outlet and soft cushioned mat.',
                'price' => 150000.00,
                'image' => 'assets/img/aquaboom.jpeg',
                'is_active' => true
            ],
            [
                'name' => 'Single Tube (Ban Single)',
                'name_en' => 'Single Tube Rental',
                'description' => 'Sewa ban renang single untuk meluncur lebih cepat dan nyaman di wahana seluncuran.',
                'description_en' => 'Single inflatable swim tube rental for faster, smoother, and more comfortable rides on the water slides.',
                'price' => 30000.00,
                'image' => 'assets/img/aquaboom.jpeg',
                'is_active' => true
            ],
            [
                'name' => 'Double Tube (Ban Double)',
                'name_en' => 'Double Tube Rental',
                'description' => 'Sewa ban renang double untuk meluncur berpasangan bersama teman atau keluarga.',
                'description_en' => 'Tandem double swim tube rental to slide together with a partner, friend, or family member.',
                'price' => 50000.00,
                'image' => 'assets/img/aquaboom.jpeg',
                'is_active' => true
            ],
            [
                'name' => 'Loker Premium',
                'name_en' => 'Premium Locker Rental',
                'description' => 'Sewa loker ukuran besar dengan pengaman kunci digital RFID untuk kenyamanan barang bawaan Anda.',
                'description_en' => 'Large-capacity secure locker with digital RFID keycard lock for maximum peace of mind regarding your belongings.',
                'price' => 25000.00,
                'image' => 'assets/img/aquaboom.jpeg',
                'is_active' => true
            ],
        ]);

        // Wahanas
        Wahana::insert([
            ['name' => 'Giant Bucket Playground', 'name_en' => 'Giant Bucket Playground', 'description' => 'Area bermain air interaktif utama dengan ember tumpah raksasa dan berbagai seluncuran seru.', 'description_en' => 'Main interactive water play area with a giant spilling bucket and various exciting slides.', 'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/V1.jpg', 'order_column' => 1],
            ['name' => 'Splash & Leisure Pool', 'name_en' => 'Splash & Leisure Pool', 'description' => 'Nikmati sensasi berenang santai yang menyenangkan di 7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan dengan pemandangan kota Balikpapan.', 'description_en' => 'Enjoy the sensation of relaxing swimming on 7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan with Balikpapan city views.', 'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/V2.jpg', 'order_column' => 2],
            ['name' => 'Family Water Playground', 'name_en' => 'Family Water Playground', 'description' => 'Wahana permainan air keluarga yang aman dan menyenangkan untuk anak-anak hingga dewasa.', 'description_en' => 'Safe and fun family water play ride for children to adults.', 'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/V3.jpg', 'order_column' => 3],
        ]);

        // Settings
        Setting::insert([
            ['key' => 'hero_video_url', 'value' => 'https://www.youtube.com/embed/2ugEGMhBPNE?autoplay=1&mute=1&loop=1&playlist=2ugEGMhBPNE&controls=0&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3&disablekb=1', 'group' => 'homepage', 'type' => 'url'],
            ['key' => 'hero_video_file', 'value' => null, 'group' => 'homepage', 'type' => 'file'],
            ['key' => 'hero_headline', 'value' => "KAMI BUKA<br/><span class=\"gold-shimmer\">SETIAP HARI</span>", 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'hero_headline_en', 'value' => "WE ARE<br/><span class=\"gold-shimmer\">OPEN DAILY</span>", 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'hero_subheadline', 'value' => 'Setiap Hari: 09.00 - 18.00 WITA', 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'hero_subheadline_en', 'value' => 'Daily: 09:00 AM - 6:00 PM WITA', 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'hero_description', 'value' => 'Aquaboom Waterpark Balikpapan — Pengalaman rekreasi air yang unik di 7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan. Managed by Astara Hotel Balikpapan.', 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'hero_description_en', 'value' => 'Aquaboom Waterpark Balikpapan — A unique waterpark experience on 7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan. Managed by Astara Hotel Balikpapan.', 'group' => 'homepage', 'type' => 'text'],
            ['key' => 'philosophy_text', 'value' => 'Aquaboom Waterpark Balikpapan menghadirkan pengalaman rekreasi air urban yang unik di Balikpapan. Berlokasi strategis di pusat kota Balikpapan (BSB Area), kami menawarkan keceriaan wahana air premium di 7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan.', 'group' => 'about', 'type' => 'text'],
            ['key' => 'philosophy_text_en', 'value' => 'Aquaboom Waterpark Balikpapan brings a unique urban water recreation experience in Balikpapan. Strategically located in the heart of Balikpapan (BSB Area), we offer the joy of premium water slides on 7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan.', 'group' => 'about', 'type' => 'text'],
            ['key' => 'philosophy_video_url', 'value' => 'https://www.youtube.com/embed/2ugEGMhBPNE?rel=0', 'group' => 'about', 'type' => 'url'],
            ['key' => 'philosophy_video_file', 'value' => null, 'group' => 'about', 'type' => 'file'],
            ['key' => 'mission_text', 'value' => 'Terletak di Lantai 7 (Shared Common Area Astara Hotel & Pentacity Hotel Balikpapan) - Balikpapan Superblock, Aquaboom menghadirkan standar baru rekreasi air perkotaan di Balikpapan. Kami menggabungkan keseruan bermain air berkelas dengan aksesibilitas dan kenyamanan modern.', 'group' => 'about', 'type' => 'text'],
            ['key' => 'mission_text_en', 'value' => 'Located on the 7th Floor (Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan) - Balikpapan Superblock, Aquaboom presents a new standard of urban water recreation in Balikpapan. We combine the excitement of high-class water play with accessibility and modern comfort.', 'group' => 'about', 'type' => 'text'],
        ]);

        // FAQs
        Faq::insert([
            [
                'question' => 'Jam berapa jam operasional Aquaboom Waterpark?', 
                'question_en' => 'What are the operational hours of Aquaboom Waterpark?',
                'answer' => 'Kami buka setiap hari (Senin — Minggu & Libur Nasional) mulai pukul 09:00 WITA - 18:00 WITA (Batas masuk terakhir pukul 17:00 WITA).', 
                'answer_en' => 'We are open daily (Monday — Sunday & Public Holidays) from 09:00 WITA - 18:00 WITA (Last admission at 17:00 WITA).',
                'sort_order' => 1, 
                'is_active' => true
            ],
            [
                'question' => 'Bagaimana ketentuan pakaian renang di Aquaboom?', 
                'question_en' => 'What is the swimming attire policy at Aquaboom?',
                'answer' => 'Demi kenyamanan dan keselamatan, pengunjung disarankan menggunakan pakaian renang yang nyaman. Pakaian dengan kancing besi menonjol atau ritsleting tajam dilarang di seluncuran besar.', 
                'answer_en' => 'For comfort and safety, guests are advised to wear proper swimwear. Attire with protruding metal buttons or sharp zippers is prohibited on large slides.',
                'sort_order' => 2, 
                'is_active' => true
            ],
            [
                'question' => 'Apakah boleh membawa makanan dan minuman dari luar ke Aquaboom?', 
                'question_en' => 'Can we bring outside food and drinks into Aquaboom?',
                'answer' => 'Makanan dan minuman dari luar tidak diperkenankan dibawa masuk ke area waterpark untuk menjaga kebersihan dan higienitas area kolam.', 
                'answer_en' => 'Outside food and beverages are not allowed inside the waterpark area to maintain the hygiene and cleanliness of the pool area.',
                'sort_order' => 3, 
                'is_active' => true
            ],
            [
                'question' => 'Apakah tersedia penyewaan loker dan handuk?', 
                'question_en' => 'Are towel and locker rentals available?',
                'answer' => 'Ya, kami menyediakan fasilitas penyewaan loker penyimpanan barang berharga serta penyewaan handuk bersih untuk kenyamanan kunjungan Anda.', 
                'answer_en' => 'Yes, we provide locker rentals for securing valuables as well as clean towel rentals for your convenience.',
                'sort_order' => 4, 
                'is_active' => true
            ],
            [
                'question' => '[Astara Hotel] Jam berapa waktu check-in dan check-out di Astara Hotel Balikpapan?',
                'question_en' => '[Astara Hotel] What time is check-in and check-out at Astara Hotel Balikpapan?',
                'answer' => 'Check-in dimulai pukul 14:00 WITA, dan check-out hingga pukul 12:00 WITA. Resepsionis kami melayani 24 jam.',
                'answer_en' => 'Check-in is from 2:00 PM, and check-out is until 12:00 PM. Our reception is available 24 hours.',
                'sort_order' => 5,
                'is_active' => true
            ],
            [
                'question' => '[Astara Hotel] Di mana lokasi Astara Hotel Balikpapan dan atraksi apa saja di sekitarnya?',
                'question_en' => '[Astara Hotel] Where is Astara Hotel located and what attractions are nearby?',
                'answer' => 'Astara Hotel berlokasi di Balikpapan Superblock, tepat di atas Pentacity Shopping Venue. Lokasinya terhubung langsung dengan Pentacity Mall, e-Walk Mall, AQUAboom Waterpark, Marquee On 7 Pool Club, Pantai BSB, Score Sport Lounge, dan Embassy Club.',
                'answer_en' => 'The hotel is located in Balikpapan Superblock, above Pentacity Shopping Venue. Nearby attractions include Pentacity Shopping Venue, e-Walk Mall, AQUAboom Waterpark, Marquee On 7 Pool Club, Pantai BSB, Score Sport Lounge, and Embassy Club.',
                'sort_order' => 6,
                'is_active' => true
            ],
            [
                'question' => '[Astara Hotel] Fasilitas rekreasi dan kebugaran apa saja yang tersedia di Astara Hotel?',
                'question_en' => '[Astara Hotel] What recreational and fitness facilities are available at Astara Hotel?',
                'answer' => 'Tamu dapat menikmati kolam renang hotel, akses ke CNC Fitness Center, Aqva Restaurant, serta akses mudah ke AQUAboom Waterpark dan berbagai tempat hiburan di kawasan BSB.',
                'answer_en' => 'Guests can enjoy the hotel swimming pool, access to the CNC Fitness Center, Aqva Restaurant, and direct access to AQUAboom Waterpark and BSB entertainment venues.',
                'sort_order' => 7,
                'is_active' => true
            ],
            [
                'question' => '[Grand Jatra Hotel Balikpapan] Jam berapa check-in & check-out dan apa saja fasilitas unggulan di Grand Jatra Hotel Balikpapan?',
                'question_en' => '[Grand Jatra Hotel Balikpapan] What are the check-in times and featured facilities at Grand Jatra Hotel Balikpapan?',
                'answer' => 'Check-in dari pukul 14:00 dan check-out hingga pukul 12:00. Fasilitas meliputi Sky Pool dengan panorama kota, Japonica Fitness Centre, Japonica Spa, The Bellagio Restaurant, dan J Cuvee Lounge.',
                'answer_en' => 'Check-in is from 2:00 PM and check-out is until 12:00 PM. Facilities include the rooftop Sky Pool with city views, Japonica Fitness Centre, Japonica Spa, The Bellagio Restaurant, and J Cuvee Lounge.',
                'sort_order' => 8,
                'is_active' => true
            ],
            [
                'question' => '[Grand Jatra Hotel Balikpapan] Tipe kamar apa saja yang tersedia di Grand Jatra Hotel Balikpapan?',
                'question_en' => '[Grand Jatra Hotel Balikpapan] What room types are available at Grand Jatra Hotel Balikpapan?',
                'answer' => 'Kami menyediakan berbagai pilihan kamar mulai dari Superior, Executive, Deluxe, Business Suite, hingga Junior Suite untuk kebutuhan bisnis maupun liburan keluarga.',
                'answer_en' => 'We offer Superior, Executive, Deluxe, Business Suite, Junior Suite, and other room categories designed for both business travelers and families.',
                'sort_order' => 9,
                'is_active' => true
            ],
            [
                'question' => '[Pentacity Hotel Balikpapan] Di mana lokasi Pentacity Hotel dan bagaimana akses ke AQUAboom Waterpark?',
                'question_en' => '[Pentacity Hotel Balikpapan] Where is Pentacity Hotel located and how is the access to AQUAboom Waterpark?',
                'answer' => 'Pentacity Hotel terletak di Balikpapan Superblock tepat di atas Pentacity Shopping Venue, berjarak hanya sekitar 50 meter dari AQUAboom Waterpark, 2 menit dari e-Walk Mall, dan 200 meter dari Pantai BSB.',
                'answer_en' => 'Pentacity Hotel is located above Pentacity Shopping Venue in Balikpapan Superblock, approximately 50 meters from AQUAboom Waterpark, 2 minutes from e-Walk Mall, and 200 meters from Pantai BSB.',
                'sort_order' => 10,
                'is_active' => true
            ],
            [
                'question' => '[Pentacity Hotel Balikpapan] Fasilitas kuliner dan kebugaran apa saja yang tersedia di Pentacity Hotel?',
                'question_en' => '[Pentacity Hotel Balikpapan] What dining and fitness facilities are available at Pentacity Hotel?',
                'answer' => 'Tamu dapat menikmati hidangan di Lagoon Grill Restaurant, bersantai di Marquee On 7, serta menggunakan fasilitas kolam renang dan CNC Fitness Center.',
                'answer_en' => 'Guests can enjoy dining at Lagoon Grill Restaurant, relaxing at Marquee On 7, and using the swimming pool and CNC Fitness Center.',
                'sort_order' => 11,
                'is_active' => true
            ],
            [
                'question' => '[J Icon Hip Hotel] Apa keunggulan dan tipe kamar yang ditawarkan di J Icon Hip Hotel Balikpapan?',
                'question_en' => '[J Icon Hip Hotel] What features and room types are offered at J Icon Hip Hotel Balikpapan?',
                'answer' => 'J Icon menawarkan kamar urban modern yang kompak dan stylish seperti Square Room, Square Twin Room, dan Square Plus Room (kapasitas 2 orang), berlokasi menempel dengan e-Walk Mall dengan H.O.B Café & Bar tepat di atas hotel.',
                'answer_en' => 'J Icon offers compact, stylish urban rooms including Square Room, Square Twin Room, and Square Plus Room (up to 2 guests), located directly adjacent to e-Walk Mall with H.O.B Café & Bar directly above the hotel.',
                'sort_order' => 12,
                'is_active' => true
            ],
            [
                'question' => '[J Icon Hip Hotel] Apakah tamu J Icon dapat mengakses kolam renang dan fasilitas kebugaran?',
                'question_en' => '[J Icon Hip Hotel] Can J Icon guests access swimming pool and fitness facilities?',
                'answer' => 'Ya, tamu J Icon dapat mengakses fasilitas Japonica Fitness Centre & Spa di Grand Jatra Hotel terdekat serta fasilitas kompleks Jatra Hotels & Resorts sesuai ketentuan akses yang berlaku.',
                'answer_en' => 'Yes, guests can access selected facilities including Japonica Fitness Centre and Japonica Spa at the nearby Grand Jatra Hotel, subject to applicable access conditions.',
                'sort_order' => 13,
                'is_active' => true
            ],
            [
                'question' => '[Stark Boutique Hotel Bali] Jam berapa check-in & check-out dan di mana alamat Stark Boutique Hotel & Spa?',
                'question_en' => '[Stark Boutique Hotel Bali] What time is check-in and check-out and where is Stark Boutique Hotel & Spa located?',
                'answer' => 'Check-in dari pukul 14:00 dan check-out hingga pukul 12:00 (resepsionis 24 jam). Beralamat di Jl. Kartika Plaza No. 20, Kuta, Bali 80361, Indonesia (+62 361 761888 / WhatsApp: +62 811 376 1888).',
                'answer_en' => 'Check-in is from 2:00 PM and check-out is until 12:00 PM (24-hour reception). Located at Jl. Kartika Plaza No. 20, Kuta, Bali 80361, Indonesia (+62 361 761888 / WhatsApp: +62 811 376 1888).',
                'sort_order' => 14,
                'is_active' => true
            ],
            [
                'question' => '[Stark Boutique Hotel Bali] Apakah Stark Boutique Hotel memiliki kolam renang dan restoran?',
                'question_en' => '[Stark Boutique Hotel Bali] Does Stark Boutique Hotel have a swimming pool and dining facilities?',
                'answer' => 'Ya, tersedia rooftop SkyPool dengan pemandangan panorama sekitar, Sky Pool Bar, Warung Koffie Batavia, serta Stark Craft Beer Garden dengan pertunjukan live music di malam hari.',
                'answer_en' => 'Yes. Guests can enjoy our rooftop SkyPool with panoramic views, Sky Pool Bar, Warung Koffie Batavia, and Stark Craft Beer Garden with live music in the evening.',
                'sort_order' => 15,
                'is_active' => true
            ],
            [
                'question' => '[Stark Boutique Hotel Bali] Berapa jarak Stark Boutique Hotel dari Bandara Ngurah Rai dan pantai terdekat?',
                'question_en' => '[Stark Boutique Hotel Bali] How far is Stark Boutique Hotel from Ngurah Rai Airport and nearby beaches?',
                'answer' => 'Bandara Internasional Ngurah Rai hanya sekitar 10 menit dengan mobil. Pantai Segara (Pantai Jerman) sekitar 5 menit jalan kaki, Discovery Mall 7 menit, dan Pantai Kuta / Waterbom Bali sekitar 10 menit jalan kaki.',
                'answer_en' => 'Ngurah Rai International Airport is approximately 10 minutes by car. Segara Beach (Pantai Jerman) is a 5-minute walk, Discovery Shopping Mall is 7 minutes, and Kuta Beach / Waterbom Bali is around a 10-minute walk.',
                'sort_order' => 16,
                'is_active' => true
            ],
            [
                'question' => '[Stark Boutique Hotel Bali] Tipe kamar apa saja yang ada di Stark Boutique Hotel dan apakah ada kamar berjendela / jacuzzi?',
                'question_en' => '[Stark Boutique Hotel Bali] What room types are available at Stark Boutique Hotel and are there rooms with views or jacuzzi?',
                'answer' => 'Tersedia tipe Superior (tanpa jendela), Executive, Deluxe (pilihan city view), dan Grand Deluxe dengan fasilitas private jacuzzi. Seluruh area dalam kamar adalah non-smoking (merokok hanya diperbolehkan di area terbuka).',
                'answer_en' => 'We offer Superior (no-window), Executive, Deluxe (city view option), and Grand Deluxe with a private jacuzzi. All guest rooms are non-smoking (smoking is only permitted in designated open-space areas).',
                'sort_order' => 17,
                'is_active' => true
            ],
            [
                'question' => '[Grand Jatra Hotel Pekanbaru] Di mana lokasi Grand Jatra Hotel Pekanbaru dan apa fasilitas utamanya?',
                'question_en' => '[Grand Jatra Hotel Pekanbaru] Where is Grand Jatra Hotel Pekanbaru located and what are its main facilities?',
                'answer' => 'Terletak di pusat kota Pekanbaru di Jl. Tengku Zainal Abidin (terkoneksi langsung dengan Mall Pekanbaru). Dilengkapi Sky Pool, Japonica Gym, restoran, ruang meeting/event, dan layanan room service 24 jam.',
                'answer_en' => 'Located in the heart of Pekanbaru on Jl. Tengku Zainal Abidin (direct access to Mall Pekanbaru). Features Sky Pool, Japonica Gym, dining venues, meeting/event facilities, and 24-hour room service.',
                'sort_order' => 18,
                'is_active' => true
            ],
            [
                'question' => '[Jatra Hotels & Resorts] Apakah saya bisa memesan tiket waterpark atau kamar hotel langsung melalui website resmi?',
                'question_en' => '[Jatra Hotels & Resorts] Can I book waterpark tickets or hotel rooms directly through the official website?',
                'answer' => 'Ya, Anda dapat melakukan pemesanan tiket online langsung dengan konfirmasi instan melalui website resmi kami atau menghubungi layanan pelanggan via WhatsApp.',
                'answer_en' => 'Yes. You can book directly through our official website with instant confirmation or contact our customer support team for assistance.',
                'sort_order' => 19,
                'is_active' => true
            ],
            [
                'question' => '[Jatra Hotels & Resorts] Bagaimana kebijakan pembatalan (cancellation) dan perubahan (reschedule/modification) reservasi?',
                'question_en' => '[Jatra Hotels & Resorts] What is the cancellation and modification policy for bookings?',
                'answer' => 'Kebijakan pembatalan dan perubahan bergantung pada paket/rate plan yang dipilih saat pemesanan. Untuk tiket promosi dan tarif tertentu bersifat non-refundable sesuai ketentuan pemesanan yang tertera pada konfirmasi reservasi.',
                'answer_en' => 'Cancellation and modification policies depend on the rate plan and booking channel selected. Non-refundable and special promotional rates apply as stated in your booking confirmation.',
                'sort_order' => 20,
                'is_active' => true
            ],
            [
                'question' => '[Jatra Hotels & Resorts] Metode pembayaran apa saja yang didukung untuk transaksi online?',
                'question_en' => '[Jatra Hotels & Resorts] What payment methods are supported for online booking transactions?',
                'answer' => 'Kami menerima berbagai metode pembayaran online yang aman dan terenkripsi seperti QRIS, Virtual Account bank terkemuka, E-Wallet, dan Kartu Kredit melalui payment gateway resmi berizin.',
                'answer_en' => 'We support secure online payment methods including QRIS, Bank Virtual Accounts, E-Wallets, and Credit Cards processed via licensed payment gateway partners.',
                'sort_order' => 21,
                'is_active' => true
            ],
        ]);

        // Facilities
        Facility::insert([
            [
                'name' => 'Oasis Food Court',
                'name_en' => 'Oasis Food Court',
                'type' => 'dining',
                'description' => 'Tempat menikmati aneka makanan ringan favorit, hidangan lezat khas lokal, dan minuman segar setelah bermain air.',
                'description_en' => 'A place to enjoy various favorite snacks, delicious local dishes, and fresh drinks after playing in the water.',
                'features' => json_encode(['Menu variatif', 'Minuman dingin segar', 'Area bersih nyaman']),
                'features_en' => json_encode(['Varied menu', 'Fresh cold drinks', 'Clean & comfortable area']),
                'menu_items' => json_encode([
                    'dining-menus/01M1BCTTDQWETSW9NMWYF62QYN.webp'
                ]),
                'image_url' => 'https://aquaboombsb.com/wp-content/uploads/2023/12/fasilitas.png',
                'is_active' => true
            ],
            [
                'name' => 'GAZEBO PRIBADI & CABANA',
                'name_en' => 'PRIVATE GAZEBO & CABANA',
                'type' => 'gazebo',
                'description' => 'Tingkatkan kenyamanan kunjungan Anda dengan menyewa Gazebo pribadi. Terletak di area teduh nan asri, lengkap dengan layanan pesan antar makanan, pengisian daya, dan privasi penuh.',
                'description_en' => 'Enhance your visit comfort by renting a private Gazebo. Located in a shady, lush area, complete with food delivery service, charging outlets, and full privacy.',
                'features' => json_encode([
                    'Layanan makanan & minuman langsung ke gazebo',
                    'Privasi & kenyamanan maksimal',
                    'Kapasitas 4–8 orang per gazebo'
                ]),
                'features_en' => json_encode([
                    'Food & beverage service directly to the gazebo',
                    'Maximum privacy & comfort',
                    'Capacity of 4–8 people per gazebo'
                ]),
                'menu_items' => null,
                'image_url' => 'https://picsum.photos/600/400?random=40',
                'is_active' => true
            ],
            [
                'name' => 'PENYEWAAN LOKER & HANDUK',
                'name_en' => 'LOCKER & TOWEL RENTAL',
                'type' => 'general',
                'description' => 'Nikmati petualangan air tanpa rasa cemas. Kami menyediakan fasilitas loker otomatis dengan keamanan terintegrasi, serta penyewaan handuk bersih yang selalu disterilkan secara berkala.',
                'description_en' => 'Enjoy water adventures without worries. We provide automated locker facilities with integrated security, and clean towels sterilized regularly.',
                'features' => json_encode([
                    'Sistem kunci loker menggunakan gelang RFID / pin',
                    'Handuk premium bersih & higienis',
                    'Lokasi loker strategis dekat ruang bilas'
                ]),
                'features_en' => json_encode([
                    'Locker locking system using RFID wristband / pin',
                    'Premium, clean & hygienic towels',
                    'Strategic locker locations near the shower rooms'
                ]),
                'menu_items' => null,
                'image_url' => 'https://picsum.photos/600/400?random=42',
                'is_active' => true
            ],
            [
                'name' => 'RUANG BILAS & RUANG GANTI',
                'name_en' => 'SHOWER & CHANGING ROOMS',
                'type' => 'general',
                'description' => 'Ruang bilas dan ruang ganti premium kami dirancang dengan mengutamakan kebersihan dan kenyamanan. Dilengkapi dengan pancuran air hangat, bilik ganti pribadi yang luas, serta pengering rambut.',
                'description_en' => 'Our premium shower and changing rooms are designed with hygiene and comfort in mind. Equipped with hot showers, spacious private changing stalls, and hair dryers.',
                'features' => json_encode([
                    'Bilik shower pribadi dengan air hangat',
                    'Peralatan mandi lengkap (sabun & sampo cair)',
                    'Wastafel dan cermin rias berukuran besar'
                ]),
                'features_en' => json_encode([
                    'Private shower stalls with hot water',
                    'Complete toiletries (liquid soap & shampoo)',
                    'Large washbasin and vanity mirrors'
                ]),
                'menu_items' => null,
                'image_url' => 'https://picsum.photos/600/400?random=44',
                'is_active' => true
            ],
            [
                'name' => 'KLINIK PERTOLONGAN PERTAMA (P3K)',
                'name_en' => 'FIRST AID CLINIC',
                'type' => 'general',
                'description' => 'Keselamatan Anda adalah prioritas utama kami. Klinik P3K Aquaboom dilengkapi dengan peralatan medis darurat standar internasional serta dipandu oleh tim medis terlatih yang bersertifikasi.',
                'description_en' => 'Your safety is our top priority. Aquaboom\'s First Aid Clinic is equipped with standard international emergency medical supplies and guided by certified trained medical staff.',
                'features' => json_encode([
                    'Perawat dan pertolongan medis siaga selama jam operasional',
                    'Obat-obatan umum dan peralatan bantuan darurat lengkap',
                    'Akses jalur evakuasi darurat yang cepat'
                ]),
                'features_en' => json_encode([
                    'Nurses and medical assistance standby during operating hours',
                    'General medicines and complete emergency aid equipment',
                    'Fast emergency evacuation access route'
                ]),
                'menu_items' => null,
                'image_url' => 'https://picsum.photos/600/400?random=46',
                'is_active' => true
            ],
            [
                'name' => 'MUSHOLA',
                'name_en' => 'PRAYER ROOM (MUSHOLA)',
                'type' => 'general',
                'description' => 'Kami menyediakan ruang ibadah (Mushola) yang tenang, sejuk, dan bersih untuk menunjang kenyamanan ibadah Anda. Terpisah secara higienis antara area wudhu pria dan wanita.',
                'description_en' => 'We provide a quiet, cool, and clean prayer room (Mushola) for your worship comfort. Hygienically separated ablution areas for men and women.',
                'features' => json_encode([
                    'Tempat wudhu bersih terpisah gender',
                    'Dilengkapi sajadah, mukena, sarung, dan Al-Quran',
                    'Ruangan ber-AC yang nyaman'
                ]),
                'features_en' => json_encode([
                    'Clean gender-segregated ablution areas',
                    'Equipped with prayer mats, female prayer robes, sarongs, and Al-Quran',
                    'Comfortable air-conditioned room'
                ]),
                'menu_items' => null,
                'image_url' => 'https://picsum.photos/600/400?random=48',
                'is_active' => true
            ],
        ]);

        // Ticket Packages (Special Offers) Seeding
        TicketPackage::insert([
            [
                'name' => 'Tiket Regular Weekdays',
                'name_en' => 'Regular Weekday Ticket',
                'description' => 'Tiket masuk harian untuk hari Senin sampai Jumat. Jam operasional: 09:00 - 18:00 WITA.',
                'description_en' => 'Daily entry ticket valid from Monday to Friday. Operational hours: 09:00 - 18:00 WITA.',
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
