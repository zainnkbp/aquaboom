<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Data Protection & Privacy Policy - Jatra Hotels & Resorts | Aquaboom' : 'Kebijakan Perlindungan Data & Privasi - Jatra Hotels & Resorts | Aquaboom' }}</x-slot:title>

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
          {{ App::getLocale() === 'en' ? 'Compliance with Indonesian PDP Law No. 27/2022' : 'Kepatuhan UU Perlindungan Data Pribadi No. 27/2022' }}
        </span>
        <div class="h-px w-10 bg-aqua-gold"></div>
      </div>
      <h1 class="text-4xl md:text-6xl font-black text-white mb-4 uppercase tracking-tight">
        {{ App::getLocale() === 'en' ? 'DATA PROTECTION & PRIVACY' : 'PERLINDUNGAN DATA & PRIVASI' }}
      </h1>
      <p class="text-base text-white/70 font-semibold max-w-3xl mx-auto leading-relaxed">
        {{ App::getLocale() === 'en'
            ? 'Jatra Hotels & Resorts (“JHR”) and Aquaboom Balikpapan respect the privacy of our guests and are dedicated to safeguarding your personal data in accordance with applicable data protection laws of the Republic of Indonesia.'
            : 'Jatra Hotels & Resorts (“JHR”) dan Aquaboom Balikpapan menghormati privasi para tamu dan berkomitmen penuh untuk melindungi data pribadi Anda sesuai peraturan perundang-undangan Republik Indonesia yang berlaku.' }}
      </p>
      <div class="mt-5 inline-flex items-center gap-2 bg-white/10 px-4 py-1.5 rounded-full text-xs font-bold text-aqua-gold/90 border border-white/10">
        <svg class="w-3.5 h-3.5 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ App::getLocale() === 'en' ? 'Last Revised: September 2026' : 'Terakhir Diperbarui: September 2026' }}</span>
      </div>
    </div>
  </div>

  <!-- Content Section -->
  <section class="py-20 bg-aqua-cream min-h-screen">
    <div class="max-w-5xl mx-auto px-6">
      
      <!-- Main Privacy Container -->
      <div class="bg-white rounded-[32px] p-8 md:p-14 shadow-xl border border-aqua-cream-2 space-y-12 text-slate-700 leading-relaxed font-medium">
        
        <!-- Intro Banner -->
        <div class="bg-gradient-to-r from-emerald-50 via-teal-50 to-emerald-50 border-2 border-emerald-200/80 rounded-2xl p-6 flex flex-col sm:flex-row items-start sm:items-center gap-4">
          <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-md">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
          </div>
          <div>
            <h3 class="font-black text-emerald-950 uppercase text-sm tracking-wider mb-1">
              {{ App::getLocale() === 'en' ? 'Commitment to Guest Privacy' : 'Komitmen Perlindungan Privasi Tamu' }}
            </h3>
            <p class="text-xs text-emerald-900/80 font-medium leading-relaxed">
              {{ App::getLocale() === 'en'
                  ? 'Personal data is processed in strict compliance with Law No. 27 of 2022 concerning Personal Data Protection (UU PDP). We collect only information reasonably necessary for booking fulfillment and hospitality management.'
                  : 'Data pribadi diproses sesuai dengan Undang-Undang No. 27 Tahun 2022 tentang Perlindungan Data Pribadi (UU PDP). Kami hanya mengumpulkan informasi yang diperlukan untuk pemenuhan pemesanan dan layanan perhotelan.' }}
            </p>
          </div>
        </div>

        <!-- Section 1: Data We Collect -->
        <div class="space-y-4">
          <div class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-aqua-navy text-aqua-gold font-black text-sm flex items-center justify-center shrink-0 shadow-sm">1</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '1. Personal Data We Collect' : '1. Data Pribadi yang Kami Kumpulkan' }}
            </h2>
          </div>
          <p class="text-sm pl-4 sm:pl-12 text-slate-600">
            {{ App::getLocale() === 'en'
                ? 'Depending on the booking, service requested, or communication channel used, we may collect:'
                : 'Bergantung pada jenis pemesanan, layanan yang diminta, atau saluran komunikasi yang digunakan, data yang kami kumpulkan meliputi:' }}
          </p>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3 pl-4 sm:pl-12 pt-2">
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 flex items-start gap-3">
              <div class="w-2 h-2 rounded-full bg-aqua-azure mt-2 shrink-0"></div>
              <span class="text-xs font-semibold text-slate-700"><strong>{{ App::getLocale() === 'en' ? 'Identity Data:' : 'Data Identitas:' }}</strong> {{ App::getLocale() === 'en' ? 'Full name, nationality, identification number (KTP / Passport) when required.' : 'Nama lengkap, kewarganegaraan, nomor identitas resmi (KTP/Paspor) saat check-in.' }}</span>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 flex items-start gap-3">
              <div class="w-2 h-2 rounded-full bg-aqua-azure mt-2 shrink-0"></div>
              <span class="text-xs font-semibold text-slate-700"><strong>{{ App::getLocale() === 'en' ? 'Contact Details:' : 'Kontak:' }}</strong> {{ App::getLocale() === 'en' ? 'Email address, phone number, and WhatsApp number.' : 'Alamat email aktif, nomor telepon seluler, dan nomor WhatsApp.' }}</span>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 flex items-start gap-3">
              <div class="w-2 h-2 rounded-full bg-aqua-azure mt-2 shrink-0"></div>
              <span class="text-xs font-semibold text-slate-700"><strong>{{ App::getLocale() === 'en' ? 'Reservation Details:' : 'Data Reservasi:' }}</strong> {{ App::getLocale() === 'en' ? 'Stay dates, visit dates, room types, ticket packages, guest count, and preferences.' : 'Tanggal kunjungan/menginap, tipe kamar, paket tiket, jumlah pengunjung, dan preferensi khusus.' }}</span>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 flex items-start gap-3">
              <div class="w-2 h-2 rounded-full bg-aqua-azure mt-2 shrink-0"></div>
              <span class="text-xs font-semibold text-slate-700"><strong>{{ App::getLocale() === 'en' ? 'Transaction Metadata:' : 'Transaksi:' }}</strong> {{ App::getLocale() === 'en' ? 'Payment method, payment status, transaction ID, and billing amount.' : 'Metode pembayaran, status pembayaran, Order ID, dan nilai nominal transaksi.' }}</span>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 flex items-start gap-3 md:col-span-2">
              <div class="w-2 h-2 rounded-full bg-aqua-azure mt-2 shrink-0"></div>
              <span class="text-xs font-semibold text-slate-700"><strong>{{ App::getLocale() === 'en' ? 'Technical & Activity Data:' : 'Data Teknis:' }}</strong> {{ App::getLocale() === 'en' ? 'IP address, browser type, device information, operating system, and cookie interactions.' : 'Alamat IP, tipe peramban (browser), informasi perangkat, sistem operasi, dan log aktivitas cookies.' }}</span>
            </div>
          </div>
        </div>

        <!-- Section 2: How We Use Personal Data -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-aqua-navy text-aqua-gold font-black text-sm flex items-center justify-center shrink-0 shadow-sm">2</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '2. How We Use Personal Data' : '2. Tujuan Pemrosesan Data Pribadi' }}
            </h2>
          </div>
          <ul class="space-y-2.5 pl-4 sm:pl-12 text-sm list-disc marker:text-aqua-gold">
            <li>{{ App::getLocale() === 'en' ? 'Process, confirm, and manage room reservations and waterpark tickets.' : 'Memproses, memvalidasi, dan mengelola pemesanan kamar hotel dan tiket wahana air.' }}</li>
            <li>{{ App::getLocale() === 'en' ? 'Issue and deliver e-tickets, payment receipts, and QR admission codes.' : 'Menerbitkan dan mengirimkan e-tiket, bukti pembayaran, dan QR code akses masuk.' }}</li>
            <li>{{ App::getLocale() === 'en' ? 'Communicate with guests regarding bookings, schedule updates, or inquiries.' : 'Berkomunikasi dengan tamu mengenai status reservasi, perubahan jadwal, atau pertanyaan layanan.' }}</li>
            <li>{{ App::getLocale() === 'en' ? 'Verify identity upon arrival to prevent fraudulent ticket redemptions.' : 'Melakukan verifikasi identitas di gerbang masuk demi mencegah penyalahgunaan tiket.' }}</li>
            <li>{{ App::getLocale() === 'en' ? 'Comply with legal, taxation, regulatory, and public safety obligations.' : 'Memenuhi kewajiban perpajakan, audit akuntansi, dan regulasi pemerintah Republik Indonesia.' }}</li>
          </ul>
        </div>

        <!-- Section 3: Payment Data & Security -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-aqua-navy text-aqua-gold font-black text-sm flex items-center justify-center shrink-0 shadow-sm">3</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '3. Payment Information & Security' : '3. Informasi Pembayaran & Keamanan Transaksi' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-12 text-sm list-disc marker:text-aqua-gold">
            <li>
              {{ App::getLocale() === 'en'
                  ? 'All online payments are securely processed through authorized, licensed Payment Service Providers (Payment Gateways) supervised by Bank Indonesia.'
                  : 'Seluruh pembayaran elektronik diproses secara aman melalui Penyedia Jasa Pembayaran (Payment Gateway) resmi berizin dan diawasi oleh Bank Indonesia.' }}
            </li>
            <li>
              <strong class="text-aqua-navy">
                {{ App::getLocale() === 'en'
                    ? 'Jatra Hotels & Resorts and Aquaboom do not intentionally store full credit card numbers, CVV/CVC codes, or banking PINs on our servers.'
                    : 'Jatra Hotels & Resorts dan Aquaboom tidak menyimpan nomor lengkap kartu kredit, kode keamanan CVV/CVC, ataupun PIN perbankan pelanggan di server kami.' }}
              </strong>
            </li>
          </ul>
        </div>

        <!-- Section 4: Sharing & Third Parties -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-aqua-navy text-aqua-gold font-black text-sm flex items-center justify-center shrink-0 shadow-sm">4</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '4. Sharing of Personal Data' : '4. Pengungkapan & Pihak Ketiga' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-12 text-sm list-disc marker:text-aqua-gold">
            <li>
              <strong class="text-emerald-700">
                {{ App::getLocale() === 'en'
                    ? 'We DO NOT SELL, rent, or trade personal data to third parties under any circumstances.'
                    : 'Kami TIDAK AKAN PERNAH MENJUAL, menyewakan, atau memperdagangkan data pribadi Anda kepada pihak ketiga mana pun.' }}
              </strong>
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Personal data is shared only with authorized partners (such as payment gateway providers, email delivery infrastructure, and cloud hosting servers) strictly as necessary to deliver our booking services.'
                  : 'Data pribadi hanya dibagikan kepada mitra pemroses resmi (penyedia payment gateway, sistem pengiriman email konfirmasi, dan infrastruktur cloud server) semata-mata untuk kelancaran layanan pemesanan.' }}
            </li>
          </ul>
        </div>

        <!-- Section 5: Data Subject Rights -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-aqua-navy text-aqua-gold font-black text-sm flex items-center justify-center shrink-0 shadow-sm">5</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '5. Your Data Protection Rights' : '5. Hak-Hak Pemilik Data Pribadi' }}
            </h2>
          </div>
          <p class="text-sm pl-4 sm:pl-12 text-slate-600">
            {{ App::getLocale() === 'en'
                ? 'Under Indonesian PDP Law No. 27/2022, guests possess the following fundamental rights regarding their personal data:'
                : 'Berdasarkan UU PDP No. 27 Tahun 2022, Anda memiliki hak-hak hukum atas data pribadi Anda, termasuk:' }}
          </p>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pl-4 sm:pl-12 pt-2">
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
              <span class="text-xs font-bold text-aqua-navy uppercase block mb-1">1. {{ App::getLocale() === 'en' ? 'Right of Access' : 'Hak Akses' }}</span>
              <p class="text-xs text-slate-600">{{ App::getLocale() === 'en' ? 'Request copies of personal data stored in our systems.' : 'Meminta salinan data pribadi yang kami kelola.' }}</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
              <span class="text-xs font-bold text-aqua-navy uppercase block mb-1">2. {{ App::getLocale() === 'en' ? 'Right to Rectification' : 'Hak Perbaikan' }}</span>
              <p class="text-xs text-slate-600">{{ App::getLocale() === 'en' ? 'Request corrections of incomplete or inaccurate information.' : 'Meminta pembaruan jika terdapat data yang tidak akurat.' }}</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
              <span class="text-xs font-bold text-aqua-navy uppercase block mb-1">3. {{ App::getLocale() === 'en' ? 'Right to Erasure' : 'Hak Penghapusan' }}</span>
              <p class="text-xs text-slate-600">{{ App::getLocale() === 'en' ? 'Request deletion of personal data when no longer legally required.' : 'Meminta penghapusan data sesuai batasan retensi hukum.' }}</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
              <span class="text-xs font-bold text-aqua-navy uppercase block mb-1">4. {{ App::getLocale() === 'en' ? 'Withdrawal of Consent' : 'Penarikan Persetujuan' }}</span>
              <p class="text-xs text-slate-600">{{ App::getLocale() === 'en' ? 'Withdraw marketing consent or unsubscribe at any time.' : 'Menarik kembali persetujuan promosi/newsletter kapan saja.' }}</p>
            </div>
          </div>
        </div>

        <!-- Section 6: Data Retention & Security -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-9 h-9 rounded-xl bg-aqua-navy text-aqua-gold font-black text-sm flex items-center justify-center shrink-0 shadow-sm">6</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '6. Data Retention & Safeguards' : '6. Retensi & Perlindungan Keamanan Data' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-12 text-sm list-disc marker:text-aqua-gold">
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Personal data is retained only for as long as necessary to fulfill reservation management, accounting, tax, and legal requirements.'
                  : 'Data pribadi disimpan hanya selama diperlukan untuk pemenuhan reservasi, pelaporan pajak, dan audit kepatuhan hukum yang sah.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'We implement robust technical and organizational security measures (including SSL encryption, strict role-based access control, and firewalls) to safeguard against unauthorized access, loss, or data breaches.'
                  : 'Kami menerapkan protokol keamanan teknis dan organisasional berlapis (termasuk enkripsi SSL/TLS, pembatasan hak akses berbasis peran, dan audit keamanan berkala) guna mencegah kebocoran data.' }}
            </li>
          </ul>
        </div>

        <!-- Contact & Privacy Officer Box -->
        <div class="bg-aqua-navy text-white rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-lg">
          <div>
            <h4 class="text-base font-black text-aqua-gold uppercase mb-1">
              {{ App::getLocale() === 'en' ? 'Data Protection Officer (DPO)' : 'Petugas Perlindungan Data Pribadi' }}
            </h4>
            <p class="text-xs text-white/70 font-semibold">
              {{ App::getLocale() === 'en'
                  ? 'For inquiries or data subject access requests, please contact: dpo@jatrahotels.com / WhatsApp: +62 811 5488 888'
                  : 'Untuk pertanyaan atau pengajuan hak data pribadi, hubungi: dpo@jatrahotels.com / WhatsApp: +62 811 5488 888' }}
            </p>
          </div>
          <a href="mailto:dpo@jatrahotels.com" class="inline-flex items-center gap-2 bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black text-xs uppercase tracking-wider px-6 py-3.5 rounded-xl transition-all shadow-md shrink-0">
            <span>{{ App::getLocale() === 'en' ? 'Contact DPO' : 'Hubungi DPO' }} &rarr;</span>
          </a>
        </div>

      </div>
    </div>
  </section>
</x-layout>
