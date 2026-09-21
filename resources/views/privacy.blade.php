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
              {{ App::getLocale() === 'en' ? 'Customer Personal Data Protection Policy' : 'Kebijakan Perlindungan Data Pribadi Customer' }}
            </h3>
            <p class="text-xs text-emerald-900/80 font-medium">
              {{ App::getLocale() === 'en'
                  ? 'This Privacy Policy explains the collection, use, third-party processing, and legal rights of personal data for reservations and services at Aquaboom Balikpapan.'
                  : 'Kebijakan Privasi ini menjelaskan pengumpulan, penggunaan, pemrosesan pihak ketiga, serta hak hukum atas data pribadi untuk reservasi dan layanan di Aquaboom Balikpapan.' }}
            </p>
          </div>
        </div>

        @if(App::getLocale() === 'en')
        <!-- ENGLISH VERSION -->
        <div class="space-y-8">
          <!-- Bab 1 -->
          <div class="space-y-3">
            <div class="flex items-center gap-3">
              <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">1</span>
              <h2 class="text-xl font-black text-aqua-navy uppercase tracking-tight">Customer Data Processing</h2>
            </div>
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-2 text-xs font-semibold text-slate-700">
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-aqua-gold mt-1.5 shrink-0"></span>
                <span>By making a booking, the customer consents to the collection and processing of personal data required for reservation and services at Aquaboom Balikpapan.</span>
              </p>
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-aqua-gold mt-1.5 shrink-0"></span>
                <span>Customer data may include name, phone number, email address, number of visitors (pax), transaction details, and other information necessary for the booking process.</span>
              </p>
            </div>
          </div>

          <!-- Bab 2 -->
          <div class="space-y-3 pt-6 border-t border-slate-100">
            <div class="flex items-center gap-3">
              <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">2</span>
              <h2 class="text-xl font-black text-aqua-navy uppercase tracking-tight">Purpose & Limitations of Data Use</h2>
            </div>
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-2 text-xs font-semibold text-slate-700">
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>
                <span>Data is strictly used for booking processing, payment verification, ticket confirmation & delivery, customer service, security, administration, and service quality improvement.</span>
              </p>
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>
                <span>Customer data will NOT be used for any other purposes beyond service requirements without a valid legal basis or explicit prior consent.</span>
              </p>
            </div>
          </div>

          <!-- Bab 3 -->
          <div class="space-y-3 pt-6 border-t border-slate-100">
            <div class="flex items-center gap-3">
              <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">3</span>
              <h2 class="text-xl font-black text-aqua-navy uppercase tracking-tight">Third-Party Sharing & Customer Rights</h2>
            </div>
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-2 text-xs font-semibold text-slate-700">
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 shrink-0"></span>
                <span>Customer data may be shared with authorized third parties involved in the booking or payment process (such as the DOKU payment gateway) while upholding strict personal data protection standards.</span>
              </p>
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 shrink-0"></span>
                <span>Customers maintain legal rights over their personal data in compliance with applicable laws and regulations.</span>
              </p>
            </div>
          </div>

          <!-- Bab 4 -->
          <div class="space-y-3 pt-6 border-t border-slate-100">
            <div class="flex items-center gap-3">
              <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">4</span>
              <h2 class="text-xl font-black text-aqua-navy uppercase tracking-tight">Consent & Responsibility</h2>
            </div>
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-2 text-xs font-semibold text-slate-700">
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                <span>By completing the booking process, the customer declares that the provided information is true, accurate, and valid.</span>
              </p>
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                <span>The customer agrees to the Terms & Conditions and Privacy Policy applicable at Aquaboom Balikpapan.</span>
              </p>
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                <span>This consent is effective from the booking initiation and throughout the period required for service fulfillment.</span>
              </p>
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                <span>The customer holds full responsibility for the accuracy of all data submitted during reservation.</span>
              </p>
            </div>
          </div>
        </div>
        @else
        <!-- INDONESIAN VERSION -->
        <div class="space-y-8">
          <!-- Bab 1 -->
          <div class="space-y-3">
            <div class="flex items-center gap-3">
              <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">1</span>
              <h2 class="text-xl font-black text-aqua-navy uppercase tracking-tight">Pemrosesan Data Customer</h2>
            </div>
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-2 text-xs font-semibold text-slate-700">
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-aqua-gold mt-1.5 shrink-0"></span>
                <span>Dengan melakukan booking, customer menyetujui pengumpulan dan pemrosesan data pribadi yang diperlukan untuk keperluan reservasi dan layanan Aquaboom Balikpapan.</span>
              </p>
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-aqua-gold mt-1.5 shrink-0"></span>
                <span>Data customer dapat meliputi nama, nomor telepon, alamat email, jumlah pengunjung, informasi transaksi, serta data lain yang diperlukan untuk proses booking.</span>
              </p>
            </div>
          </div>

          <!-- Bab 2 -->
          <div class="space-y-3 pt-6 border-t border-slate-100">
            <div class="flex items-center gap-3">
              <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">2</span>
              <h2 class="text-xl font-black text-aqua-navy uppercase tracking-tight">Tujuan & Batasan Penggunaan Data</h2>
            </div>
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-2 text-xs font-semibold text-slate-700">
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>
                <span>Data digunakan untuk keperluan pemrosesan booking, pembayaran, konfirmasi tiket, pelayanan customer, keamanan, administrasi, dan peningkatan kualitas layanan.</span>
              </p>
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>
                <span>Data customer tidak akan digunakan untuk tujuan lain di luar kebutuhan layanan tanpa dasar yang sah atau persetujuan yang diperlukan.</span>
              </p>
            </div>
          </div>

          <!-- Bab 3 -->
          <div class="space-y-3 pt-6 border-t border-slate-100">
            <div class="flex items-center gap-3">
              <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">3</span>
              <h2 class="text-xl font-black text-aqua-navy uppercase tracking-tight">Pembagian Data kepada Pihak Ketiga & Hak Customer</h2>
            </div>
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-2 text-xs font-semibold text-slate-700">
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 shrink-0"></span>
                <span>Data customer dapat dibagikan kepada pihak ketiga yang terkait dengan proses booking atau pembayaran (seperti payment gateway DOKU) dengan tetap memperhatikan perlindungan data pribadi.</span>
              </p>
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 shrink-0"></span>
                <span>Customer memiliki hak atas data pribadinya sesuai dengan ketentuan peraturan perundang-undangan yang berlaku.</span>
              </p>
            </div>
          </div>

          <!-- Bab 4 -->
          <div class="space-y-3 pt-6 border-t border-slate-100">
            <div class="flex items-center gap-3">
              <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">4</span>
              <h2 class="text-xl font-black text-aqua-navy uppercase tracking-tight">Persetujuan & Tanggung Jawab Customer</h2>
            </div>
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-2 text-xs font-semibold text-slate-700">
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                <span>Dengan menyelesaikan proses booking, customer menyatakan bahwa data yang diberikan adalah benar dan sah.</span>
              </p>
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                <span>Customer menyetujui syarat & ketentuan serta kebijakan privasi yang berlaku di Aquaboom Balikpapan.</span>
              </p>
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                <span>Persetujuan ini berlaku sejak proses booking dilakukan dan selama data diperlukan untuk penyediaan layanan.</span>
              </p>
              <p class="flex items-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                <span>Customer bertanggung jawab atas keakuratan data yang diberikan pada saat pemesanan.</span>
              </p>
            </div>
          </div>
        </div>
        @endif

        <!-- Contact Us Official Card -->
        <div class="pt-6 border-t border-slate-100">
          <div class="bg-aqua-navy text-white rounded-3xl p-8 md:p-10 border border-aqua-gold/20 shadow-xl space-y-6">
            <div class="flex items-center gap-3">
              <span class="w-8 h-8 rounded-xl bg-aqua-gold text-aqua-navy font-black text-xs flex items-center justify-center shrink-0">📞</span>
              <h2 class="text-xl md:text-2xl font-black text-white uppercase tracking-tight">
                {{ App::getLocale() === 'en' ? 'Official Inquiries' : 'Layanan Informasi Resmi' }}
              </h2>
            </div>
            <p class="text-xs text-white/70 font-semibold leading-relaxed">
              {{ App::getLocale() === 'en'
                  ? 'For questions, requests, or confirmations regarding tickets and personal data, please contact our official desk:'
                  : 'Untuk pertanyaan, permintaan, atau konfirmasi terkait tiket dan data pribadi, customer dapat menghubungi:' }}
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2 text-xs">
              <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
                <span class="text-aqua-gold text-[10px] font-black uppercase tracking-widest block mb-1">Email Resmi</span>
                <a href="mailto:info@aquaboom.co.id" class="text-white font-bold hover:text-aqua-gold transition-colors">info@aquaboom.co.id</a>
              </div>
              <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
                <span class="text-aqua-gold text-[10px] font-black uppercase tracking-widest block mb-1">WhatsApp CS</span>
                <a href="https://wa.me/628115900123" target="_blank" class="text-white font-bold hover:text-aqua-gold transition-colors">+62 811 5900 123</a>
              </div>
              <div class="bg-white/5 p-4 rounded-2xl border border-white/10">
                <span class="text-aqua-gold text-[10px] font-black uppercase tracking-widest block mb-1">Lokasi</span>
                <span class="text-white/80 font-semibold block leading-snug">7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan (BSB)</span>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

</x-layout>
