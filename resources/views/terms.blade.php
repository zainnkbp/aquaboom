<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Terms & Conditions - Aquaboom Waterpark Balikpapan' : 'Syarat & Ketentuan - Aquaboom Waterpark Balikpapan' }}</x-slot:title>

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
          {{ App::getLocale() === 'en' ? 'Official Booking Terms' : 'Ketentuan Resmi Booking' }}
        </span>
        <div class="h-px w-10 bg-aqua-gold"></div>
      </div>
      <h1 class="text-4xl md:text-6xl font-black text-white mb-4 uppercase tracking-tight">
        {{ App::getLocale() === 'en' ? 'TERMS & CONDITIONS' : 'SYARAT & KETENTUAN' }}
      </h1>
      <p class="text-base text-white/60 font-semibold max-w-2xl mx-auto">
        {{ App::getLocale() === 'en'
            ? 'By purchasing tickets to Aquaboom Balikpapan, customers are deemed to have read, understood, and agreed to all Terms & Conditions below.'
            : 'Dengan melakukan pembelian tiket Aquaboom Balikpapan, customer dianggap telah membaca, memahami, dan menyetujui seluruh Syarat & Ketentuan berikut:' }}
      </p>
      <div class="mt-4 inline-flex items-center gap-2 bg-white/10 px-4 py-1.5 rounded-full text-xs font-bold text-aqua-gold/90 border border-white/10">
        <svg class="w-3.5 h-3.5 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ App::getLocale() === 'en' ? 'Effective Date: September 2026' : 'Berlaku Efektif: September 2026' }}</span>
      </div>
    </div>
  </div>

  <!-- Content Section -->
  <section class="py-20 bg-aqua-cream min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
      
      <!-- Terms Card Container -->
      <div class="bg-white rounded-[32px] p-8 md:p-14 shadow-xl border border-aqua-cream-2 space-y-10 text-slate-700 leading-relaxed font-medium">
        
        <!-- Intro Banner -->
        <div class="bg-gradient-to-r from-amber-50 via-orange-50 to-amber-50 border-2 border-amber-200/80 rounded-2xl p-6 flex flex-col sm:flex-row items-start sm:items-center gap-4">
          <div class="w-12 h-12 rounded-2xl bg-aqua-gold text-aqua-navy flex items-center justify-center shrink-0 shadow-md">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
          </div>
          <div>
            <h3 class="font-black text-amber-950 uppercase text-sm tracking-wider mb-1">
              {{ App::getLocale() === 'en' ? 'Official Visitor Agreement' : 'Perjanjian Resmi Pengunjung' }}
            </h3>
            <p class="text-xs text-amber-900/80 font-medium leading-relaxed">
              {{ App::getLocale() === 'en'
                  ? 'All ticket purchases and admissions to Aquaboom Waterpark Balikpapan (Managed by Astara Hotel Balikpapan) are subject to these binding policies for mutual safety and comfort.'
                  : 'Seluruh pembelian tiket dan akses masuk ke Aquaboom Waterpark Balikpapan (Managed by Astara Hotel Balikpapan) tunduk pada ketentuan mengikat berikut demi keselamatan dan kenyamanan bersama.' }}
            </p>
          </div>
        </div>

        <!-- Section 1: Ketentuan Umum -->
        <div class="space-y-4">
          <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">1</span>
            <h2 class="text-xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '1. General Terms' : '1. Ketentuan Umum' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-11 text-sm list-disc marker:text-aqua-gold">
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Aquaboom Balikpapan tickets can only be used in accordance with the visit date specified on the ticket.'
                  : 'Tiket Aquaboom Balikpapan hanya dapat digunakan sesuai dengan tanggal kunjungan yang tercantum pada tiket.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Tickets must be presented upon entering the Aquaboom area, either in digital or printed format.'
                  : 'Tiket wajib ditunjukkan pada saat memasuki area Aquaboom, baik dalam bentuk digital maupun cetak.' }}
            </li>
            <li>
              <strong class="text-aqua-navy">
                {{ App::getLocale() === 'en'
                    ? 'Tickets that have been purchased and paid for cannot be cancelled, refunded, or cashed out under any circumstances, unless explicitly decided otherwise by Aquaboom Balikpapan management.'
                    : 'Tiket yang telah dibeli dan dibayar tidak dapat dibatalkan, dikembalikan (refund), atau diuangkan kembali, kecuali ditentukan lain oleh pihak manajemen Aquaboom Balikpapan.' }}
              </strong>
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Tickets cannot be transferred, resold, or exchanged without prior written consent from Aquaboom Balikpapan.'
                  : 'Tiket tidak dapat dipindahtangankan atau diperjualbelikan kembali tanpa persetujuan dari pihak Aquaboom Balikpapan.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Customers are solely responsible for ensuring all booking details provided are accurate, including full name, contact info, ticket quantities, and visit date.'
                  : 'Customer bertanggung jawab memastikan data booking yang diberikan sudah benar, termasuk nama lengkap, kontak, jumlah tiket, dan tanggal kunjungan.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Aquaboom Balikpapan reserves the right to deny entry if discrepancies, invalid tickets, or fraudulent indicators are detected.'
                  : 'Aquaboom Balikpapan berhak menolak akses masuk apabila terdapat ketidaksesuaian data, tiket tidak valid, atau terindikasi adanya kecurangan.' }}
            </li>
          </ul>
        </div>

        <!-- Section 2: Penggunaan Tiket & Akses Masuk -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">2</span>
            <h2 class="text-xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '2. Ticket Usage & Admission' : '2. Penggunaan Tiket & Akses Masuk' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-11 text-sm list-disc marker:text-aqua-gold">
            <li>
              {{ App::getLocale() === 'en'
                  ? 'One ticket is valid for one person (or according to the package purchased, e.g., Duo Pass for 2 persons, Four Pack for 4 persons) and is single-entry only on the specified date.'
                  : 'Satu tiket berlaku untuk satu orang (atau sesuai paket yang dibeli, misal Duo Pass untuk 2 orang, Four Pack untuk 4 orang) dan hanya dapat digunakan untuk satu kali masuk (single entry) pada tanggal yang sama.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Tickets must be scanned and validated by admission gate officers before visitors are permitted into the waterpark area.'
                  : 'Tiket harus di-scan oleh petugas di loket / gerbang masuk sebelum customer diperbolehkan masuk ke area waterpark.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'All visitors must comply with all operational, safety, and hygiene rules applicable at Aquaboom Balikpapan.'
                  : 'Pengunjung wajib mematuhi seluruh peraturan operasional, keamanan, dan keselamatan yang berlaku di Aquaboom Balikpapan.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Children under specific age / height requirements must be actively supervised by a responsible parent or adult guardian at all times.'
                  : 'Anak-anak di bawah batas usia tertentu harus didampingi oleh orang tua / orang dewasa yang bertanggung jawab selama berada di area Aquaboom.' }}
            </li>
          </ul>
        </div>

        <!-- Section 3: Jam Operasional & Batas Masuk -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">3</span>
            <h2 class="text-xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '3. Operational Hours & Admission Limits' : '3. Jam Operasional & Batas Masuk' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-11 text-sm list-disc marker:text-aqua-gold">
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Official operating hours of Aquaboom Balikpapan are every day (Monday — Sunday & Public Holidays) from 09:00 WITA - 18:00 WITA.'
                  : 'Jam operasional resmi Aquaboom Balikpapan adalah setiap hari (Senin — Minggu & Libur Nasional) mulai pukul 09:00 WITA - 18:00 WITA.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Last admission to the park is strictly at 17:00 WITA (1 hour before closing).'
                  : 'Batas masuk terakhir (last admission) adalah pukul 17:00 WITA (1 jam sebelum tutup).' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Aquaboom Balikpapan reserves the right to adjust operating hours or temporarily close attractions due to severe weather, technical maintenance, or safety protocols without obligation of refund.'
                  : 'Aquaboom Balikpapan berhak mengubah jam operasional atau menutup sebagian wahana sewaktu-waktu demi alasan keselamatan, cuaca ekstrem, atau perawatan teknis tanpa kewajiban pengembalian dana (refund).' }}
            </li>
          </ul>
        </div>

        <!-- Section 4: Kebijakan Fasilitas & Makanan -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">4</span>
            <h2 class="text-xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '4. Facility & Food Policy' : '4. Kebijakan Fasilitas & Makanan' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-11 text-sm list-disc marker:text-aqua-gold">
            <li>
              <strong class="text-red-600">
                {{ App::getLocale() === 'en'
                    ? 'Outside food and beverages are strictly prohibited inside the waterpark area (except dedicated infant food/formula).'
                    : 'Dilarang membawa makanan dan minuman dari luar ke dalam area waterpark, kecuali makanan khusus bayi.' }}
              </strong>
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Additional facilities such as lockers, gazebos, and swim tubes are optional and can be rented independently on-site or via the official online booking system.'
                  : 'Fasilitas tambahan seperti loker, gazebo, dan ban renang (tube) bersifat opsional dan dapat disewa secara mandiri di lokasi atau melalui sistem booking online resmi.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Visitors are fully responsible for their personal belongings. Aquaboom Balikpapan is not liable for any loss or damage to personal items.'
                  : 'Pengunjung bertanggung jawab penuh atas barang bawaan pribadi. Aquaboom Balikpapan tidak bertanggung jawab atas kehilangan atau kerusakan barang milik pengunjung.' }}
            </li>
          </ul>
        </div>

        <!-- Section 5: Keamanan, Keselamatan & Hak Manajemen -->
        <div class="space-y-4 pt-6 border-t border-slate-100">
          <div class="flex items-center gap-3">
            <span class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold font-black text-xs flex items-center justify-center shrink-0">5</span>
            <h2 class="text-xl font-black text-aqua-navy uppercase tracking-tight">
              {{ App::getLocale() === 'en' ? '5. Safety, Security & Management Rights' : '5. Keamanan, Keselamatan & Hak Manajemen' }}
            </h2>
          </div>
          <ul class="space-y-3 pl-4 sm:pl-11 text-sm list-disc marker:text-aqua-gold">
            <li>
              {{ App::getLocale() === 'en'
                  ? 'All visitors must wear proper swimwear and strictly obey instructions from certified lifeguards and safety officers at every slide and pool.'
                  : 'Pengunjung wajib mengenakan pakaian renang yang pantas dan mematuhi instruksi lifeguard / petugas keselamatan di setiap wahana dan kolam.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Visitors with medical conditions (heart conditions, pregnancy, neck/back injuries) are strongly advised not to ride high-thrill slides.'
                  : 'Pengunjung dengan kondisi medis tertentu (penyakit jantung, ibu hamil, cedera punggung/leher) disarankan tidak menaiki wahana seluncuran ekstrem.' }}
            </li>
            <li>
              {{ App::getLocale() === 'en'
                  ? 'Aquaboom Balikpapan reserves the right to escort out any visitor who endangers others, violates social conduct, or refuses safety directives, without refund.'
                  : 'Aquaboom Balikpapan berhak mengeluarkan pengunjung dari area waterpark apabila terbukti membahayakan keselamatan orang lain, melanggar norma kesopanan, atau menolak mematuhi arahan petugas, tanpa kewajiban pengembalian dana.' }}
            </li>
          </ul>
        </div>

        <!-- Summary / Bottom Box -->
        <div class="bg-aqua-navy text-white rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-lg">
          <div>
            <h4 class="text-base font-black text-aqua-gold uppercase mb-1">
              {{ App::getLocale() === 'en' ? 'Questions regarding our terms?' : 'Ada pertanyaan terkait ketentuan tiket?' }}
            </h4>
            <p class="text-xs text-white/70 font-semibold">
              {{ App::getLocale() === 'en' ? 'Our guest service team is ready to assist you anytime.' : 'Tim layanan pengunjung kami siap membantu Anda kapan saja.' }}
            </p>
          </div>
          <a href="{{ route('ticket.buy') }}" class="inline-flex items-center gap-2 bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black text-xs uppercase tracking-wider px-6 py-3.5 rounded-xl transition-all shadow-md shrink-0">
            <span>{{ App::getLocale() === 'en' ? 'Book Tickets Now' : 'Pesan Tiket Sekarang' }} &rarr;</span>
          </a>
        </div>

      </div>
    </div>
  </section>
</x-layout>
