<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Privacy Policy - Aquaboom Waterpark Balikpapan' : 'Kebijakan Privasi - Aquaboom Waterpark Balikpapan' }}</x-slot:title>

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
          {{ App::getLocale() === 'en' ? 'Legal & Compliance' : 'Legal & Kepatuhan' }}
        </span>
        <div class="h-px w-10 bg-aqua-gold"></div>
      </div>
      <h1 class="text-4xl md:text-6xl font-black text-white mb-4 uppercase tracking-tight">
        {{ App::getLocale() === 'en' ? 'PRIVACY POLICY' : 'KEBIJAKAN PRIVASI' }}
      </h1>
      <p class="text-base text-white/60 font-semibold max-w-2xl mx-auto">
        {{ App::getLocale() === 'en'
            ? 'Aquaboom Balikpapan respects your privacy and is fully committed to safeguarding your personal data.'
            : 'Aquaboom Balikpapan menghargai privasi dan berkomitmen penuh untuk melindungi data pribadi customer.' }}
      </p>
      <div class="mt-4 inline-flex items-center gap-2 bg-white/10 px-4 py-1.5 rounded-full text-xs font-bold text-aqua-gold/90 border border-white/10">
        <svg class="w-3.5 h-3.5 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ App::getLocale() === 'en' ? 'Last Updated: September 2026' : 'Terakhir diperbarui: September 2026' }}</span>
      </div>
    </div>
  </div>

  <!-- Content Section -->
  <section class="py-20 bg-aqua-cream min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
      
      <!-- Privacy Card Container -->
      <div class="bg-white rounded-[32px] p-8 md:p-14 shadow-xl border border-aqua-cream-2 space-y-10 text-slate-700 leading-relaxed font-medium">
        
        <!-- Intro Banner -->
        <div class="bg-gradient-to-r from-emerald-50 via-teal-50 to-emerald-50 border-2 border-emerald-200/80 rounded-2xl p-6 flex flex-col sm:flex-row items-start sm:items-center gap-4">
          <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-md">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
          </div>
          <div>
            <h3 class="font-black text-emerald-950 uppercase text-sm tracking-wider mb-1">
              {{ App::getLocale() === 'en' ? 'Commitment to Data Protection' : 'Komitmen Perlindungan Data Pribadi' }}
            </h3>
            <p class="text-xs text-emerald-900/80 font-medium">
              {{ App::getLocale() === 'en'
                  ? 'This Privacy Policy explains how we collect, use, store, and protect the personal data you provide when making a booking or using our services.'
                  : 'Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi data pribadi yang diberikan oleh customer saat melakukan booking atau menggunakan layanan kami.' }}
            </p>
          </div>
        </div>

        <!-- Section 1 -->
        <div class="space-y-4">
          <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">1</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? 'Data We Collect' : 'Data yang Kami Kumpulkan' }}
            </h2>
          </div>
          <p class="text-sm text-slate-600">
            {{ App::getLocale() === 'en'
                ? 'Personal data we may collect from customers includes:'
                : 'Data pribadi yang dapat kami kumpulkan meliputi:' }}
          </p>
          <ul class="grid grid-cols-1 md:grid-cols-2 gap-2.5 text-xs font-semibold text-slate-700 pt-1">
            <li class="flex items-center gap-2 bg-slate-50 p-3 rounded-xl border border-slate-100">
              <span class="w-1.5 h-1.5 rounded-full bg-aqua-gold"></span>
              {{ App::getLocale() === 'en' ? 'Customer full name' : 'Nama customer' }}
            </li>
            <li class="flex items-center gap-2 bg-slate-50 p-3 rounded-xl border border-slate-100">
              <span class="w-1.5 h-1.5 rounded-full bg-aqua-gold"></span>
              {{ App::getLocale() === 'en' ? 'Phone or WhatsApp number' : 'Nomor telepon atau WhatsApp' }}
            </li>
            <li class="flex items-center gap-2 bg-slate-50 p-3 rounded-xl border border-slate-100">
              <span class="w-1.5 h-1.5 rounded-full bg-aqua-gold"></span>
              {{ App::getLocale() === 'en' ? 'Email address for e-ticket delivery' : 'Alamat email untuk pengiriman e-ticket' }}
            </li>
            <li class="flex items-center gap-2 bg-slate-50 p-3 rounded-xl border border-slate-100">
              <span class="w-1.5 h-1.5 rounded-full bg-aqua-gold"></span>
              {{ App::getLocale() === 'en' ? 'Number of visitors (pax) & visit date' : 'Jumlah pengunjung & tanggal kunjungan' }}
            </li>
            <li class="flex items-center gap-2 bg-slate-50 p-3 rounded-xl border border-slate-100">
              <span class="w-1.5 h-1.5 rounded-full bg-aqua-gold"></span>
              {{ App::getLocale() === 'en' ? 'Booking & transaction details' : 'Informasi booking dan riwayat transaksi' }}
            </li>
            <li class="flex items-center gap-2 bg-slate-50 p-3 rounded-xl border border-slate-100">
              <span class="w-1.5 h-1.5 rounded-full bg-aqua-gold"></span>
              {{ App::getLocale() === 'en' ? 'Payment status processed via payment gateway' : 'Informasi status pembayaran via payment gateway' }}
            </li>
          </ul>
        </div>

        <!-- Section 2 -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">2</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? 'Purposes of Data Use' : 'Tujuan Penggunaan Data' }}
            </h2>
          </div>
          <p class="text-sm text-slate-600">
            {{ App::getLocale() === 'en'
                ? 'Your personal data is used solely for the following legitimate purposes:'
                : 'Data pribadi Anda digunakan semata-mata untuk tujuan berikut:' }}
          </p>
          <div class="space-y-2 text-xs font-semibold text-slate-700">
            <div class="p-3 bg-slate-50 rounded-xl flex items-start gap-2.5">
              <svg class="w-4 h-4 text-emerald-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
              <span>{{ App::getLocale() === 'en' ? 'Processing and managing ticket bookings and wristband issuance.' : 'Memproses dan mengelola pemesanan tiket masuk dan wahana.' }}</span>
            </div>
            <div class="p-3 bg-slate-50 rounded-xl flex items-start gap-2.5">
              <svg class="w-4 h-4 text-emerald-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
              <span>{{ App::getLocale() === 'en' ? 'Delivering booking confirmations and official E-Tickets directly to your email.' : 'Mengirimkan konfirmasi booking dan E-Ticket resmi langsung ke email Anda.' }}</span>
            </div>
            <div class="p-3 bg-slate-50 rounded-xl flex items-start gap-2.5">
              <svg class="w-4 h-4 text-emerald-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
              <span>{{ App::getLocale() === 'en' ? 'Processing secure transactions and payment gateway verification.' : 'Memproses verifikasi transaksi pembayaran secara aman.' }}</span>
            </div>
            <div class="p-3 bg-slate-50 rounded-xl flex items-start gap-2.5">
              <svg class="w-4 h-4 text-emerald-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
              <span>{{ App::getLocale() === 'en' ? 'Customer service, inquiry resolution, and visitor support.' : 'Memberikan layanan pelanggan, menangani pertanyaan, dan keluhan pengunjung.' }}</span>
            </div>
            <div class="p-3 bg-slate-50 rounded-xl flex items-start gap-2.5">
              <svg class="w-4 h-4 text-emerald-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
              <span>{{ App::getLocale() === 'en' ? 'Maintaining security, preventing fraudulent activity, and fulfilling legal obligations.' : 'Menjaga keamanan taman rekreasi, mencegah penyalahgunaan tiket, serta mematuhi peraturan hukum.' }}</span>
            </div>
          </div>
        </div>

        <!-- Section 3 -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">3</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? 'Third-Party Data Sharing' : 'Pembagian Data kepada Pihak Ketiga' }}
            </h2>
          </div>
          <p class="text-sm text-slate-600">
            {{ App::getLocale() === 'en'
                ? 'In certain conditions, customer data may be shared with or processed by authorized third-party partners supporting our park operations:'
                : 'Dalam kondisi tertentu, data customer dapat diproses atau dibagikan kepada pihak ketiga tepercaya yang mendukung operasional layanan:' }}
          </p>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
              <strong class="font-bold text-aqua-navy block mb-1">💳 Payment Gateway (DOKU)</strong>
              <p class="text-slate-500">Memproses transaksi keuangan secara terenkripsi sesuai izin Bank Indonesia.</p>
            </div>
            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
              <strong class="font-bold text-aqua-navy block mb-1">🎫 Ticketing & QR Scanner</strong>
              <p class="text-slate-500">Memverifikasi keabsahan tiket saat check-in di loket pintu masuk.</p>
            </div>
            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
              <strong class="font-bold text-aqua-navy block mb-1">☁️ Cloud & Server Infrastructure</strong>
              <p class="text-slate-500">Penyedia komputasi awan dan database untuk memastikan uptime dan stabilitas sistem.</p>
            </div>
            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
              <strong class="font-bold text-aqua-navy block mb-1">📧 Email & Notification Service</strong>
              <p class="text-slate-500">Mengirimkan file e-ticket dan informasi operasional ke email pembeli.</p>
            </div>
          </div>
          <p class="text-xs text-slate-400 italic">
            * {{ App::getLocale() === 'en' ? 'Third parties may only use your data strictly in accordance with contractual service requirements.' : 'Pihak ketiga tersebut hanya dapat menggunakan data sesuai dengan kebutuhan layanan atau kewajiban yang berlaku.' }}
          </p>
        </div>

        <!-- Section 4 & 5 (Security & Storage) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-slate-100">
          <div class="space-y-3 bg-slate-50 p-6 rounded-3xl border border-slate-100">
            <div class="flex items-center gap-2.5">
              <span class="w-7 h-7 rounded-lg bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">4</span>
              <h3 class="text-lg font-black text-aqua-navy uppercase">
                {{ App::getLocale() === 'en' ? 'Data Security' : 'Keamanan Data' }}
              </h3>
            </div>
            <p class="text-xs text-slate-600 leading-relaxed">
              {{ App::getLocale() === 'en'
                  ? 'Aquaboom Balikpapan takes reasonable technical and organizational measures (including 256-bit SSL encryption) to protect customer data from unauthorized access, alteration, or disclosure.'
                  : 'Aquaboom Balikpapan mengambil langkah yang wajar untuk menjaga keamanan data pribadi customer dan mencegah akses, penggunaan, perubahan, pengungkapan, atau kehilangan data secara tidak sah (termasuk enkripsi 256-bit SSL).' }}
            </p>
          </div>

          <div class="space-y-3 bg-slate-50 p-6 rounded-3xl border border-slate-100">
            <div class="flex items-center gap-2.5">
              <span class="w-7 h-7 rounded-lg bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">5</span>
              <h3 class="text-lg font-black text-aqua-navy uppercase">
                {{ App::getLocale() === 'en' ? 'Data Retention' : 'Penyimpanan Data' }}
              </h3>
            </div>
            <p class="text-xs text-slate-600 leading-relaxed">
              {{ App::getLocale() === 'en'
                  ? 'Personal data will be stored as long as necessary to fulfill operational, administrative, transaction verification, and legal obligations, after which it will be safely purged or anonymized.'
                  : 'Data pribadi akan disimpan selama diperlukan untuk memenuhi tujuan pengumpulan data, kebutuhan operasional, administrasi, penyelesaian transaksi, serta kewajiban hukum yang berlaku.' }}
            </p>
          </div>
        </div>

        <!-- Section 6: Customer Rights -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">6</span>
            <h2 class="text-xl md:text-2xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? 'Customer Rights' : 'Hak Customer' }}
            </h2>
          </div>
          <p class="text-sm text-slate-600">
            {{ App::getLocale() === 'en'
                ? 'Under applicable personal data protection laws, customers hold rights to:'
                : 'Sesuai dengan ketentuan perlindungan data pribadi yang berlaku, customer memiliki hak untuk:' }}
          </p>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs font-semibold text-slate-700">
            <div class="flex items-center gap-2 bg-slate-50 p-3 rounded-xl border border-slate-100">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
              {{ App::getLocale() === 'en' ? 'Obtain information on data processing' : 'Memperoleh informasi pemrosesan data' }}
            </div>
            <div class="flex items-center gap-2 bg-slate-50 p-3 rounded-xl border border-slate-100">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
              {{ App::getLocale() === 'en' ? 'Request access to personal data' : 'Meminta akses terhadap data pribadi' }}
            </div>
            <div class="flex items-center gap-2 bg-slate-50 p-3 rounded-xl border border-slate-100">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
              {{ App::getLocale() === 'en' ? 'Request correction of inaccurate data' : 'Meminta perbaikan data yang tidak akurat' }}
            </div>
            <div class="flex items-center gap-2 bg-slate-50 p-3 rounded-xl border border-slate-100">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
              {{ App::getLocale() === 'en' ? 'Request deletion of data under certain terms' : 'Meminta penghapusan data dalam kondisi tertentu' }}
            </div>
          </div>
        </div>

        <!-- Section 7 & 8 (Cookies & Policy Changes) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-slate-100">
          <div class="space-y-3">
            <div class="flex items-center gap-2.5">
              <span class="w-7 h-7 rounded-lg bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">7</span>
              <h3 class="text-base font-black text-aqua-navy uppercase">
                {{ App::getLocale() === 'en' ? 'Cookies & Digital Tech' : 'Cookies & Teknologi Digital' }}
              </h3>
            </div>
            <p class="text-xs text-slate-600 leading-relaxed">
              {{ App::getLocale() === 'en'
                  ? 'Our website may use cookies to facilitate smooth navigation, understand traffic patterns, and improve your user experience.'
                  : 'Website kami dapat menggunakan cookies atau teknologi serupa untuk membantu menjalankan website, memahami analitik trafik, dan meningkatkan pengalaman pengguna.' }}
            </p>
          </div>

          <div class="space-y-3">
            <div class="flex items-center gap-2.5">
              <span class="w-7 h-7 rounded-lg bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">8</span>
              <h3 class="text-base font-black text-aqua-navy uppercase">
                {{ App::getLocale() === 'en' ? 'Policy Updates' : 'Perubahan Kebijakan' }}
              </h3>
            </div>
            <p class="text-xs text-slate-600 leading-relaxed">
              {{ App::getLocale() === 'en'
                  ? 'We may update this Privacy Policy from time to time to reflect operational or regulatory updates. The latest version will always be available here.'
                  : 'Aquaboom Balikpapan dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Versi terbaru akan selalu dipublikasikan melalui media resmi kami.' }}
            </p>
          </div>
        </div>

        <!-- Section 9: Contact Us Official Card -->
        <div class="pt-6 border-t border-slate-100">
          <div class="bg-aqua-navy text-white rounded-3xl p-8 md:p-10 border border-aqua-gold/20 shadow-xl space-y-6">
            <div class="flex items-center gap-3">
              <span class="w-8 h-8 rounded-xl bg-aqua-gold text-aqua-navy font-black text-xs flex items-center justify-center shrink-0">9</span>
              <h2 class="text-xl md:text-2xl font-black text-white uppercase tracking-tight">
                {{ App::getLocale() === 'en' ? 'Contact Us' : 'Hubungi Kami' }}
              </h2>
            </div>
            <p class="text-xs text-white/70 font-semibold leading-relaxed">
              {{ App::getLocale() === 'en'
                  ? 'For inquiries, requests, or complaints regarding personal data, please reach out to our official team:'
                  : 'Untuk pertanyaan, permintaan, atau keluhan terkait data pribadi, customer dapat menghubungi:' }}
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2 text-xs">
              <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
                <span class="text-aqua-gold text-[10px] font-black uppercase tracking-widest block mb-1">Email Resmi</span>
                <a href="mailto:info@aquaboom.co.id" class="text-white font-bold hover:text-aqua-gold transition-colors">info@aquaboom.co.id</a>
              </div>
              <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
                <span class="text-aqua-gold text-[10px] font-black uppercase tracking-widest block mb-1">WhatsApp / Phone</span>
                <a href="https://wa.me/628115900123" target="_blank" class="text-white font-bold hover:text-aqua-gold transition-colors">+62 811 5900 123</a>
              </div>
              <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
                <span class="text-aqua-gold text-[10px] font-black uppercase tracking-widest block mb-1">Lokasi Rooftop</span>
                <span class="text-white/80 font-semibold block leading-snug">Lantai 7, Pentacity Mall, BSB Balikpapan</span>
              </div>
            </div>
            <p class="text-[11px] text-white/40 italic pt-2 border-t border-white/10">
              {{ App::getLocale() === 'en'
                  ? '* By making a booking through the Aquaboom Balikpapan system, you acknowledge that you have read, understood, and agreed to this Privacy Policy.'
                  : '* Dengan melakukan booking melalui sistem Aquaboom Balikpapan, customer mengakui bahwa telah membaca, memahami, dan menyetujui Kebijakan Privasi ini.' }}
            </p>
          </div>
        </div>

      </div>

    </div>
  </section>

</x-layout>
