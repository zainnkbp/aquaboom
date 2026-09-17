-- ============================================================================
-- AQUABOOM & JATRA HOTELS & RESORTS - COMPLETE FAQ DATABASE DUMP
-- Compatible with MariaDB / MySQL (utf8mb4, 767-byte safe, ROW_FORMAT=DYNAMIC)
-- Generated: 2026-09-17
-- ============================================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------
-- Table structure for `faqs`
-- ---------------------------------------------------------
DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` longtext NOT NULL,
  `question_en` longtext NULL,
  `answer` longtext NOT NULL,
  `answer_en` longtext NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ---------------------------------------------------------
-- Dumping data for table `faqs` (21 rows)
-- ---------------------------------------------------------
INSERT INTO `faqs` (`id`, `question`, `question_en`, `answer`, `answer_en`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 
 'Jam berapa jam operasional Aquaboom Waterpark?', 
 'What are the operational hours of Aquaboom Waterpark?', 
 'Kami buka setiap hari (Senin — Minggu & Libur Nasional) mulai pukul 09:00 WITA - 18:00 WITA (Batas masuk terakhir pukul 17:00 WITA).', 
 'We are open daily (Monday — Sunday & Public Holidays) from 09:00 WITA - 18:00 WITA (Last admission at 17:00 WITA).', 
 1, 1, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(2, 
 'Bagaimana ketentuan pakaian renang di Aquaboom?', 
 'What is the swimming attire policy at Aquaboom?', 
 'Demi kenyamanan dan keselamatan, pengunjung disarankan menggunakan pakaian renang yang nyaman. Pakaian dengan kancing besi menonjol atau ritsleting tajam dilarang di seluncuran besar.', 
 'For comfort and safety, guests are advised to wear proper swimwear. Attire with protruding metal buttons or sharp zippers is prohibited on large slides.', 
 1, 2, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(3, 
 'Apakah boleh membawa makanan dan minuman dari luar ke Aquaboom?', 
 'Can we bring outside food and drinks into Aquaboom?', 
 'Makanan dan minuman dari luar tidak diperkenankan dibawa masuk ke area waterpark untuk menjaga kebersihan dan higienitas area kolam.', 
 'Outside food and beverages are not allowed inside the waterpark area to maintain the hygiene and cleanliness of the pool area.', 
 1, 3, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(4, 
 'Apakah tersedia penyewaan loker dan handuk?', 
 'Are towel and locker rentals available?', 
 'Ya, kami menyediakan fasilitas penyewaan loker penyimpanan barang berharga serta penyewaan handuk bersih untuk kenyamanan kunjungan Anda.', 
 'Yes, we provide locker rentals for securing valuables as well as clean towel rentals for your convenience.', 
 1, 4, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(5, 
 '[Astara Hotel] Jam berapa waktu check-in dan check-out di Astara Hotel Balikpapan?', 
 '[Astara Hotel] What time is check-in and check-out at Astara Hotel Balikpapan?', 
 'Check-in dimulai pukul 14:00 WITA, dan check-out hingga pukul 12:00 WITA. Resepsionis kami melayani 24 jam.', 
 'Check-in is from 2:00 PM, and check-out is until 12:00 PM. Our reception is available 24 hours.', 
 1, 5, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(6, 
 '[Astara Hotel] Di mana lokasi Astara Hotel Balikpapan dan atraksi apa saja di sekitarnya?', 
 '[Astara Hotel] Where is Astara Hotel located and what attractions are nearby?', 
 'Astara Hotel berlokasi di Balikpapan Superblock, tepat di atas Pentacity Shopping Venue. Lokasinya terhubung langsung dengan Pentacity Mall, e-Walk Mall, AQUAboom Waterpark, Marquee On 7 Pool Club, Pantai BSB, Score Sport Lounge, dan Embassy Club.', 
 'The hotel is located in Balikpapan Superblock, above Pentacity Shopping Venue. Nearby attractions include Pentacity Shopping Venue, e-Walk Mall, AQUAboom Waterpark, Marquee On 7 Pool Club, Pantai BSB, Score Sport Lounge, and Embassy Club.', 
 1, 6, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(7, 
 '[Astara Hotel] Fasilitas rekreasi dan kebugaran apa saja yang tersedia di Astara Hotel?', 
 '[Astara Hotel] What recreational and fitness facilities are available at Astara Hotel?', 
 'Tamu dapat menikmati kolam renang hotel, akses ke CNC Fitness Center, Aqva Restaurant, serta akses mudah ke AQUAboom Waterpark dan berbagai tempat hiburan di kawasan BSB.', 
 'Guests can enjoy the hotel swimming pool, access to the CNC Fitness Center, Aqva Restaurant, and direct access to AQUAboom Waterpark and BSB entertainment venues.', 
 1, 7, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(8, 
 '[Grand Jatra Hotel Balikpapan] Jam berapa check-in & check-out dan apa saja fasilitas unggulan di Grand Jatra Hotel Balikpapan?', 
 '[Grand Jatra Hotel Balikpapan] What are the check-in times and featured facilities at Grand Jatra Hotel Balikpapan?', 
 'Check-in dari pukul 14:00 dan check-out hingga pukul 12:00. Fasilitas meliputi Sky Pool dengan panorama kota, Japonica Fitness Centre, Japonica Spa, The Bellagio Restaurant, dan J Cuvee Lounge.', 
 'Check-in is from 2:00 PM and check-out is until 12:00 PM. Facilities include the rooftop Sky Pool with city views, Japonica Fitness Centre, Japonica Spa, The Bellagio Restaurant, and J Cuvee Lounge.', 
 1, 8, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(9, 
 '[Grand Jatra Hotel Balikpapan] Tipe kamar apa saja yang tersedia di Grand Jatra Hotel Balikpapan?', 
 '[Grand Jatra Hotel Balikpapan] What room types are available at Grand Jatra Hotel Balikpapan?', 
 'Kami menyediakan berbagai pilihan kamar mulai dari Superior, Executive, Deluxe, Business Suite, hingga Junior Suite untuk kebutuhan bisnis maupun liburan keluarga.', 
 'We offer Superior, Executive, Deluxe, Business Suite, Junior Suite, and other room categories designed for both business travelers and families.', 
 1, 9, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(10, 
 '[Pentacity Hotel Balikpapan] Di mana lokasi Pentacity Hotel dan bagaimana akses ke AQUAboom Waterpark?', 
 '[Pentacity Hotel Balikpapan] Where is Pentacity Hotel located and how is the access to AQUAboom Waterpark?', 
 'Pentacity Hotel terletak di Balikpapan Superblock tepat di atas Pentacity Shopping Venue, berjarak hanya sekitar 50 meter dari AQUAboom Waterpark, 2 menit dari e-Walk Mall, dan 200 meter dari Pantai BSB.', 
 'Pentacity Hotel is located above Pentacity Shopping Venue in Balikpapan Superblock, approximately 50 meters from AQUAboom Waterpark, 2 minutes from e-Walk Mall, and 200 meters from Pantai BSB.', 
 1, 10, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(11, 
 '[Pentacity Hotel Balikpapan] Fasilitas kuliner dan kebugaran apa saja yang tersedia di Pentacity Hotel?', 
 '[Pentacity Hotel Balikpapan] What dining and fitness facilities are available at Pentacity Hotel?', 
 'Tamu dapat menikmati hidangan di Lagoon Grill Restaurant, bersantai di Marquee On 7, serta menggunakan fasilitas kolam renang dan CNC Fitness Center.', 
 'Guests can enjoy dining at Lagoon Grill Restaurant, relaxing at Marquee On 7, and using the swimming pool and CNC Fitness Center.', 
 1, 11, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(12, 
 '[J Icon Hip Hotel] Apa keunggulan dan tipe kamar yang ditawarkan di J Icon Hip Hotel Balikpapan?', 
 '[J Icon Hip Hotel] What features and room types are offered at J Icon Hip Hotel Balikpapan?', 
 'J Icon menawarkan kamar urban modern yang kompak dan stylish seperti Square Room, Square Twin Room, dan Square Plus Room (kapasitas 2 orang), berlokasi menempel dengan e-Walk Mall dengan H.O.B Café & Bar tepat di atas hotel.', 
 'J Icon offers compact, stylish urban rooms including Square Room, Square Twin Room, and Square Plus Room (up to 2 guests), located directly adjacent to e-Walk Mall with H.O.B Café & Bar directly above the hotel.', 
 1, 12, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(13, 
 '[J Icon Hip Hotel] Apakah tamu J Icon dapat mengakses kolam renang dan fasilitas kebugaran?', 
 '[J Icon Hip Hotel] Can J Icon guests access swimming pool and fitness facilities?', 
 'Ya, tamu J Icon dapat mengakses fasilitas Japonica Fitness Centre & Spa di Grand Jatra Hotel terdekat serta fasilitas kompleks Jatra Hotels & Resorts sesuai ketentuan akses yang berlaku.', 
 'Yes, guests can access selected facilities including Japonica Fitness Centre and Japonica Spa at the nearby Grand Jatra Hotel, subject to applicable access conditions.', 
 1, 13, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(14, 
 '[Stark Boutique Hotel Bali] Jam berapa check-in & check-out dan di mana alamat Stark Boutique Hotel & Spa?', 
 '[Stark Boutique Hotel Bali] What time is check-in and check-out and where is Stark Boutique Hotel & Spa located?', 
 'Check-in dari pukul 14:00 dan check-out hingga pukul 12:00 (resepsionis 24 jam). Beralamat di Jl. Kartika Plaza No. 20, Kuta, Bali 80361, Indonesia (+62 361 761888 / WhatsApp: +62 811 376 1888).', 
 'Check-in is from 2:00 PM and check-out is until 12:00 PM (24-hour reception). Located at Jl. Kartika Plaza No. 20, Kuta, Bali 80361, Indonesia (+62 361 761888 / WhatsApp: +62 811 376 1888).', 
 1, 14, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(15, 
 '[Stark Boutique Hotel Bali] Apakah Stark Boutique Hotel memiliki kolam renang dan restoran?', 
 '[Stark Boutique Hotel Bali] Does Stark Boutique Hotel have a swimming pool and dining facilities?', 
 'Ya, tersedia rooftop SkyPool dengan pemandangan panorama sekitar, Sky Pool Bar, Warung Koffie Batavia, serta Stark Craft Beer Garden dengan pertunjukan live music di malam hari.', 
 'Yes. Guests can enjoy our rooftop SkyPool with panoramic views, Sky Pool Bar, Warung Koffie Batavia, and Stark Craft Beer Garden with live music in the evening.', 
 1, 15, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(16, 
 '[Stark Boutique Hotel Bali] Berapa jarak Stark Boutique Hotel dari Bandara Ngurah Rai dan pantai terdekat?', 
 '[Stark Boutique Hotel Bali] How far is Stark Boutique Hotel from Ngurah Rai Airport and nearby beaches?', 
 'Bandara Internasional Ngurah Rai hanya sekitar 10 menit dengan mobil. Pantai Segara (Pantai Jerman) sekitar 5 menit jalan kaki, Discovery Mall 7 menit, dan Pantai Kuta / Waterbom Bali sekitar 10 menit jalan kaki.', 
 'Ngurah Rai International Airport is approximately 10 minutes by car. Segara Beach (Pantai Jerman) is a 5-minute walk, Discovery Shopping Mall is 7 minutes, and Kuta Beach / Waterbom Bali is around a 10-minute walk.', 
 1, 16, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(17, 
 '[Stark Boutique Hotel Bali] Tipe kamar apa saja yang ada di Stark Boutique Hotel dan apakah ada kamar berjendela / jacuzzi?', 
 '[Stark Boutique Hotel Bali] What room types are available at Stark Boutique Hotel and are there rooms with views or jacuzzi?', 
 'Tersedia tipe Superior (tanpa jendela), Executive, Deluxe (pilihan city view), dan Grand Deluxe dengan fasilitas private jacuzzi. Seluruh area dalam kamar adalah non-smoking (merokok hanya diperbolehkan di area terbuka).', 
 'We offer Superior (no-window), Executive, Deluxe (city view option), and Grand Deluxe with a private jacuzzi. All guest rooms are non-smoking (smoking is only permitted in designated open-space areas).', 
 1, 17, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(18, 
 '[Grand Jatra Hotel Pekanbaru] Di mana lokasi Grand Jatra Hotel Pekanbaru dan apa fasilitas utamanya?', 
 '[Grand Jatra Hotel Pekanbaru] Where is Grand Jatra Hotel Pekanbaru located and what are its main facilities?', 
 'Terletak di pusat kota Pekanbaru di Jl. Tengku Zainal Abidin (terkoneksi langsung dengan Mall Pekanbaru). Dilengkapi Sky Pool, Japonica Gym, restoran, ruang meeting/event, dan layanan room service 24 jam.', 
 'Located in the heart of Pekanbaru on Jl. Tengku Zainal Abidin (direct access to Mall Pekanbaru). Features Sky Pool, Japonica Gym, dining venues, meeting/event facilities, and 24-hour room service.', 
 1, 18, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(19, 
 '[Jatra Hotels & Resorts] Apakah saya bisa memesan tiket waterpark atau kamar hotel langsung melalui website resmi?', 
 '[Jatra Hotels & Resorts] Can I book waterpark tickets or hotel rooms directly through the official website?', 
 'Ya, Anda dapat melakukan pemesanan tiket online langsung dengan konfirmasi instan melalui website resmi kami atau menghubungi layanan pelanggan via WhatsApp.', 
 'Yes. You can book directly through our official website with instant confirmation or contact our customer support team for assistance.', 
 1, 19, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(20, 
 '[Jatra Hotels & Resorts] Bagaimana kebijakan pembatalan (cancellation) dan perubahan (reschedule/modification) reservasi?', 
 '[Jatra Hotels & Resorts] What is the cancellation and modification policy for bookings?', 
 'Kebijakan pembatalan dan perubahan bergantung pada paket/rate plan yang dipilih saat pemesanan. Untuk tiket promosi dan tarif tertentu bersifat non-refundable sesuai ketentuan pemesanan yang tertera pada konfirmasi reservasi.', 
 'Cancellation and modification policies depend on the rate plan and booking channel selected. Non-refundable and special promotional rates apply as stated in your booking confirmation.', 
 1, 20, '2026-09-17 16:30:00', '2026-09-17 16:30:00'),

(21, 
 '[Jatra Hotels & Resorts] Metode pembayaran apa saja yang didukung untuk transaksi online?', 
 '[Jatra Hotels & Resorts] What payment methods are supported for online booking transactions?', 
 'Kami menerima berbagai metode pembayaran online yang aman dan terenkripsi seperti QRIS, Virtual Account bank terkemuka, E-Wallet, dan Kartu Kredit melalui payment gateway resmi berizin.', 
 'We support secure online payment methods including QRIS, Bank Virtual Accounts, E-Wallets, and Credit Cards processed via licensed payment gateway partners.', 
 1, 21, '2026-09-17 16:30:00', '2026-09-17 16:30:00');

SET FOREIGN_KEY_CHECKS = 1;
