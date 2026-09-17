<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Terms & Policies - Jatra Hotels & Resorts | Aquaboom' : 'Syarat & Ketentuan - Jatra Hotels & Resorts | Aquaboom' }}</x-slot:title>

  <!-- Page Header -->
  <div class="pt-36 pb-20 bg-aqua-navy relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
      <img src="{{ asset('assets/img/default.jpeg') }}" alt="bg" class="w-full h-full object-cover" />
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-aqua-navy/60 to-aqua-navy"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
      <div class="flex items-center justify-center gap-3 mb-4">
        <div class="h-px w-10 bg-aqua-gold"></div>
        <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">
          {{ App::getLocale() === 'en' ? 'Official Online Booking Terms & Policies' : 'Syarat & Kebijakan Pemesanan Resmi' }}
        </span>
        <div class="h-px w-10 bg-aqua-gold"></div>
      </div>
      <h1 class="text-4xl md:text-6xl font-black text-white mb-4 uppercase tracking-tight">
        {{ App::getLocale() === 'en' ? 'TERMS & POLICIES' : 'SYARAT & KETENTUAN' }}
      </h1>
      <p class="text-base text-white/70 font-semibold max-w-3xl mx-auto leading-relaxed">
        {{ App::getLocale() === 'en'
            ? 'These Terms & Policies govern the use of the online booking services provided by Jatra Hotels & Resorts (“JHR”) and its managed properties including Aquaboom Waterpark, Astara Hotel, Pentacity Hotel, Grand Jatra Hotel, J Icon Hip Hotel, and Stark Boutique Hotel & Spa.'
            : 'Syarat & Ketentuan ini mengatur penggunaan layanan pemesanan online resmi yang disediakan oleh Jatra Hotels & Resorts (“JHR”) beserta unit properti yang dikelola termasuk Aquaboom Waterpark, Astara Hotel, Pentacity Hotel, Grand Jatra Hotel, J Icon Hip Hotel, dan Stark Boutique Hotel & Spa.' }}
      </p>
      <div class="mt-5 inline-flex items-center gap-2 bg-white/10 px-4 py-1.5 rounded-full text-xs font-bold text-aqua-gold/90 border border-white/10">
        <svg class="w-3.5 h-3.5 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ App::getLocale() === 'en' ? 'Effective Date: September 2026' : 'Berlaku Efektif: September 2026' }}</span>
      </div>
    </div>
  </div>

  <!-- Content Section -->
  <section class="py-20 bg-aqua-cream min-h-screen">
    <div class="max-w-5xl mx-auto px-6">
      
      <!-- Main Terms Container -->
      <div class="bg-white rounded-[32px] p-8 md:p-14 shadow-xl border border-aqua-cream-2 space-y-12 text-slate-700 leading-relaxed font-medium">
        
        <!-- Intro Notice Banner -->
        <div class="bg-gradient-to-r from-amber-50 via-orange-50 to-amber-50 border-2 border-amber-200/80 rounded-2xl p-6 flex flex-col sm:flex-row items-start sm:items-center gap-4">
          <div class="w-12 h-12 rounded-2xl bg-aqua-gold text-aqua-navy flex items-center justify-center shrink-0 shadow-md">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
          </div>
          <div>
            <h3 class="font-black text-amber-950 uppercase text-sm tracking-wider mb-1">
              {{ App::getLocale() === 'en' ? 'Binding Guest Agreement' : 'Perjanjian Resmi Pelanggan' }}
            </h3>
            <p class="text-xs text-amber-900/80 font-medium leading-relaxed">
              {{ App::getLocale() === 'en'
                  ? 'By accessing or using our online booking services, you acknowledge that you have read, understood, and agreed to be bound by these Terms & Policies and applicable property rules.'
                  : 'Dengan mengakses atau menggunakan layanan pemesanan online kami, Anda menyatakan telah membaca, memahami, dan menyetujui untuk terikat dengan Syarat & Kebijakan ini serta seluruh tata tertib properti yang berlaku.' }}
            </p>
          </div>
        </div>

        <!-- Section 1: General & Legal Entity -->
        <div class="space-y-4">
          <div class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-aqua-navy text-aqua-gold font-black text-sm flex items-center justify-center shrink-0 shadow-sm">1</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '1. General & Legal Entity' : '1. Umum & Entitas Hukum' }}
            </h2>
          </div>
          <p class="text-sm pl-4 sm:pl-12 text-slate-600 leading-relaxed">
            {{ App::getLocale() === 'en'
                ? 'These Online Booking Terms apply to all room reservations, ticket purchases, packages, and additional services made through the official website and online booking engine of Jatra Hotels & Resorts (“JHR”).'
                : 'Ketentuan Pemesanan Online ini berlaku untuk seluruh reservasi kamar, pembelian tiket, paket wisata, dan layanan tambahan yang dilakukan melalui situs web resmi dan mesin pemesanan online Jatra Hotels & Resorts (“JHR”).' }}
          </p>
          
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 ml-4 sm:ml-12 pt-2">
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 space-y-2">
              <span class="text-xs font-black uppercase text-aqua-azure tracking-wider block">Aquaboom & Astara Balikpapan</span>
              <p class="text-xs text-slate-600 font-semibold">
                <strong>Pengelola:</strong> Astara Hotel Balikpapan / BSB<br>
                <strong>Alamat:</strong> Balikpapan Superblock, Jl. Jend. Sudirman No. 47, Balikpapan 76114, Kalimantan Timur<br>
                <strong>WhatsApp CS:</strong> +62 811 5488 888 / +62 813 5143 5755
              </p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 space-y-2">
              <span class="text-xs font-black uppercase text-aqua-azure tracking-wider block">Stark Boutique Hotel & Spa Bali</span>
              <p class="text-xs text-slate-600 font-semibold">
                <strong>Badan Hukum:</strong> PT. Jatra Bali<br>
                <strong>Alamat:</strong> Jl. Kartika Plaza No. 20, Kuta, Bali 80361, Indonesia<br>
                <strong>Telepon / WA:</strong> +62 361 761888 / +62 811 376 1888<br>
                <strong>Email:</strong> rsv.bali@stark-hotel.com
              </p>
            </div>
          </div>
        </div>

        <!-- Section 2: Booking Agreement -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-aqua-navy text-aqua-gold font-black text-sm flex items-center justify-center shrink-0 shadow-sm">2</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '2. Booking Agreement' : '2. Perjanjian Pemesanan' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-12 text-sm list-disc marker:text-aqua-gold">
            <li>
              {{ App::getLocale() === 'en'
                  ? 'A booking becomes confirmed once the required booking information has been completed and the applicable payment or guarantee requirements have been fulfilled.'
                  : 'Pemesanan dinyatakan terkonfirmasi secara sah setelah seluruh informasi pemesanan yang diperlukan telah diisi dan syarat pembayaran atau jaminan telah dipenuhi.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'The booking confirmation with unique QR / Barcode will be displayed immediately upon successful transaction and sent to the email address provided by the guest.'
                  : 'Konfirmasi pemesanan (e-tiket/e-voucher) yang memuat QR Code unik akan ditampilkan di layar dan dikirimkan secara otomatis ke alamat email yang didaftarkan.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Guests are solely responsible for ensuring that all personal details (full name, phone/WA number, email address, visit date, ticket quantity, and room category) are true and accurate.'
                  : 'Pelanggan bertanggung jawab penuh untuk memastikan kebenaran seluruh data yang dimasukkan (nama lengkap, nomor HP/WA, email, tanggal kunjungan/menginap, dan jumlah pemesanan).' }}
            </li>
          </ul>
        </div>

        <!-- Section 3: Rates, Inclusions & Taxes -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-aqua-navy text-aqua-gold font-black text-sm flex items-center justify-center shrink-0 shadow-sm">3</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '3. Rates, Inclusions & Taxes' : '3. Tarif, Rincian Paket & Pajak' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-12 text-sm list-disc marker:text-aqua-gold">
            <li>
              {{ App::getLocale() === 'en'
                  ? 'All room rates and ticket prices displayed on the official booking engine are in Indonesian Rupiah (IDR) unless expressly stated otherwise.'
                  : 'Seluruh tarif kamar dan harga tiket yang tertera pada sistem pemesanan online disajikan dalam mata uang Rupiah Indonesia (IDR) kecuali dinyatakan lain.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Applicable taxes, service charges, government fees, and package inclusions will be transparently itemized during the booking checkout process.'
                  : 'Pajak yang berlaku, biaya layanan, dan fasilitas yang termasuk dalam paket akan diperinci secara transparan sebelum pembayaran diselesaikan.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Rates and promotional offers are subject to availability and seasonal adjustments. However, the price confirmed at the time of booking completion applies to that specific reservation.'
                  : 'Tarif promo dan harga seasonal dapat berubah sewaktu-waktu tanpa pemberitahuan sebelumnya. Namun, tarif yang telah terkonfirmasi pada saat transaksi berhasil tidak akan berubah.' }}
            </li>
          </ul>
        </div>

        <!-- Section 4: Payment Methods -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-aqua-navy text-aqua-gold font-black text-sm flex items-center justify-center shrink-0 shadow-sm">4</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '4. Payment Methods & Security' : '4. Metode Pembayaran & Keamanan' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-12 text-sm list-disc marker:text-aqua-gold">
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Supported online payment channels include QRIS, Bank Virtual Accounts (BCA, Mandiri, BRI, BNI, Permata, dll), E-Wallets (GoPay, OVO, ShopeePay, DANA), and Major Credit/Debit Cards via licensed payment gateways.'
                  : 'Metode pembayaran online yang didukung meliputi QRIS, Virtual Account Bank (BCA, Mandiri, BRI, BNI, Permata, dll), E-Wallet (GoPay, OVO, ShopeePay, DANA), serta Kartu Kredit/Debit berlogo Visa/Mastercard melalui payment gateway resmi berizin Bank Indonesia.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'For prepaid bookings and waterpark tickets, payment must be completed within the designated payment window time. Unpaid orders will be automatically cancelled by the system.'
                  : 'Untuk pemesanan prabayar dan tiket wahana air, pembayaran wajib diselesaikan dalam batas waktu (countdown timer) yang ditentukan. Pesanan yang melewati batas waktu akan otomatis dibatalkan.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'The hotel and waterpark do not store raw cardholder numbers or CVV codes. All transaction processing is encrypted under PCI-DSS standards.'
                  : 'Pihak hotel dan waterpark tidak menyimpan data rahasia kartu kredit (CVV/PIN). Seluruh transaksi dienkripsi dengan standar keamanan tinggi PCI-DSS.' }}
            </li>
          </ul>
        </div>

        <!-- Section 5: Check-in, Check-out & Admission -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-aqua-navy text-aqua-gold font-black text-sm flex items-center justify-center shrink-0 shadow-sm">5</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '5. Check-in, Check-out & Admission' : '5. Check-in, Check-out & Akses Masuk' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-12 text-sm list-disc marker:text-aqua-gold">
            <li>
              <strong class="text-aqua-navy">Hotel Check-in & Check-out:</strong> 
              {{ App::getLocale() === 'en'
                  ? 'Standard check-in is from 2:00 PM (14:00), and check-out is until 12:00 PM (12:00). Early check-in or late check-out is strictly subject to room availability and applicable surcharges.'
                  : 'Waktu standard check-in hotel adalah mulai pukul 14:00 WITA/WIB, dan check-out hingga pukul 12:00 WITA/WIB. Check-in lebih awal atau check-out lebih lambat bergantung pada ketersediaan kamar dan dapat dikenakan biaya tambahan.' }}
            </li>
            <li>
              <strong class="text-aqua-navy">Aquaboom Waterpark Admission:</strong> 
              {{ App::getLocale() === 'en'
                  ? 'Operational daily (Monday — Sunday & Public Holidays) from 09:00 WITA - 18:00 WITA. Last admission is strictly at 17:00 WITA. Tickets are single-entry on the specified visit date.'
                  : 'Buka setiap hari (Senin — Minggu & Libur Nasional) pukul 09:00 - 18:00 WITA. Batas masuk terakhir (last admission) pukul 17:00 WITA. Tiket berlaku untuk satu kali masuk (single entry) pada tanggal yang tertera.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Guests must present valid government-issued photo identification (KTP/Passport/SIM) at check-in or ticket scanning counters upon arrival.'
                  : 'Tamu wajib menunjukkan kartu identitas resmi yang masih berlaku (KTP/Paspor/SIM) saat proses check-in hotel atau scan tiket di loket masuk.' }}
            </li>
          </ul>
        </div>

        <!-- Section 6: Modification & Rescheduling -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-aqua-navy text-aqua-gold font-black text-sm flex items-center justify-center shrink-0 shadow-sm">6</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '6. Modification & Rescheduling' : '6. Perubahan Jadwal (Modification)' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-12 text-sm list-disc marker:text-aqua-gold">
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Modifications to confirmed reservations (dates, guest names, package types) are subject to the specific rate plan conditions, ticket validity, and current availability.'
                  : 'Perubahan pada pemesanan yang telah terkonfirmasi (tanggal, nama tamu, kategori paket) bergantung pada syarat paket yang dipilih dan ketersediaan kuota.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Date modifications that move a stay or visit from Weekday to Weekend/Public Holiday rates will require payment of the price difference before confirmation.'
                  : 'Perubahan tanggal kunjungan/menginap dari tarif Weekday ke Weekend atau Libur Nasional wajib menyelesaikan selisih harga sebelum perubahan disetujui.' }}
            </li>
          </ul>
        </div>

        <!-- Section 7: Cancellation & No-Show Policy -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-aqua-navy text-aqua-gold font-black text-sm flex items-center justify-center shrink-0 shadow-sm">7</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '7. Cancellation & No-Show Policy' : '7. Kebijakan Pembatalan & No-Show' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-12 text-sm list-disc marker:text-aqua-gold">
            <li>
              <strong class="text-red-600">
                {{ App::getLocale() === 'en'
                    ? 'Promotional tickets and special non-refundable rate plans cannot be cancelled, refunded, or cashed out under any circumstances once transaction is complete.'
                    : 'Tiket promo, tiket bundling flash sale, dan tarif non-refundable yang telah dibayar lunas tidak dapat dibatalkan, dikembalikan dananya (non-refundable), atau diuangkan kembali.' }}
              </strong>
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'In the event of a guest no-show on the scheduled visit date or stay period, the booking shall be considered consumed and 100% of the total amount charged.'
                  : 'Apabila tamu tidak hadir (no-show) pada tanggal kunjungan atau jadwal menginap yang telah ditentukan, pemesanan dianggap hangus tanpa kompensasi refund.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'In rare cases where refunds are officially authorized by management, processing timelines depend on the acquiring bank/payment provider (typically 7-14 business days).'
                  : 'Untuk kasus pembatalan resmi yang disetujui secara tertulis oleh manajemen, proses pengembalian dana mengikuti prosedur perbankan dan penyedia pembayaran (7-14 hari kerja).' }}
            </li>
          </ul>
        </div>

        <!-- Section 8: Information Accuracy & Property Rules -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-aqua-navy text-aqua-gold font-black text-sm flex items-center justify-center shrink-0 shadow-sm">8</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '8. Property Rules, Safety & Facility Policy' : '8. Tata Tertib, Keamanan & Fasilitas' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-12 text-sm list-disc marker:text-aqua-gold">
            <li>
              <strong class="text-red-600">
                {{ App::getLocale() === 'en'
                    ? 'Outside food and beverages are strictly prohibited inside Aquaboom Waterpark and hotel recreation areas (except infant baby food).'
                    : 'Dilarang membawa makanan dan minuman dari luar ke dalam area Aquaboom Waterpark dan area rekreasi hotel (kecuali makanan khusus bayi).' }}
              </strong>
            </li>
            <li>
              <strong class="text-aqua-navy">
                {{ App::getLocale() === 'en'
                    ? 'Non-Smoking Policy: Hotel guest rooms and waterpark zones are non-smoking. Smoking is strictly permitted only in designated open outdoor areas.'
                    : 'Kawasan Bebas Asap Rokok: Seluruh kamar hotel dan zona bermain air adalah area bebas asap rokok. Merokok hanya diperbolehkan di area terbuka khusus yang telah ditentukan.' }}
              </strong>
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Proper swimwear is required at all pool and waterslide facilities. Clothing with sharp metal buckles, zippers, or rivets is prohibited on slides.'
                  : 'Pengunjung wajib mengenakan pakaian renang yang pantas. Pakaian dengan kancing logam tajam atau ritsleting menonjol dilarang saat menggunakan seluncuran besar.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Management reserves the right to deny admission or escort out any individual endangering safety, violating rules, or causing public nuisance without refund.'
                  : 'Manajemen berhak menolak akses atau mengeluarkan pengunjung yang membahayakan keselamatan, melanggar norma ketertiban, atau merusak fasilitas tanpa kewajiban ganti rugi.' }}
            </li>
          </ul>
        </div>

        <!-- Contact & Help Box -->
        <div class="bg-aqua-navy text-white rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-lg">
          <div>
            <h4 class="text-base font-black text-aqua-gold uppercase mb-1">
              {{ App::getLocale() === 'en' ? 'Have questions regarding our terms?' : 'Butuh bantuan atau klarifikasi syarat pemesanan?' }}
            </h4>
            <p class="text-xs text-white/70 font-semibold">
              {{ App::getLocale() === 'en' ? 'Our reservations and guest care team is available 24 hours to assist you.' : 'Tim reservasi dan layanan tamu kami siap membantu Anda 24 jam.' }}
            </p>
          </div>
          <div class="flex items-center gap-3 shrink-0">
            <a href="https://wa.me/628115488888" target="_blank" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs uppercase px-5 py-3 rounded-xl transition-all shadow-md">
              <span>WhatsApp CS</span>
            </a>
            <a href="{{ route('ticket.buy') }}" class="inline-flex items-center gap-2 bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black text-xs uppercase tracking-wider px-6 py-3 rounded-xl transition-all shadow-md">
              <span>{{ App::getLocale() === 'en' ? 'Book Online' : 'Pesan Sekarang' }} &rarr;</span>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>
</x-layout>
