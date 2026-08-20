<x-layout>
  <x-slot:title>Tickets & Pricing - Aquaboom Waterpark</x-slot:title>

  <!-- Page Header -->
  <div class="pt-36 pb-20 bg-aqua-navy relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
      <img src="https://picsum.photos/1920/600?random=70" alt="bg" class="w-full h-full object-cover" />
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-aqua-navy/60 to-aqua-navy"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
      <div class="flex items-center justify-center gap-3 mb-4">
        <div class="h-px w-10 bg-aqua-gold"></div>
        <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">Secure Online</span>
        <div class="h-px w-10 bg-aqua-gold"></div>
      </div>
      <h1 class="text-5xl md:text-7xl font-black text-white mb-4 uppercase tracking-tight">
        {{ App::getLocale() === 'id' ? 'TIKET & HARGA' : 'TICKETS & PRICING' }}
      </h1>
      <p class="text-base text-white/60 font-semibold max-w-2xl mx-auto">
        {{ App::getLocale() === 'id' ? 'Beli tiket online sekarang dan langsung masuk tanpa antre di loket!' : 'Buy tickets online now and skip the queue at the counter!' }}
      </p>
    </div>
  </div>

  <!-- Main Section -->
  <section class="py-20 bg-aqua-cream">
    <div class="max-w-5xl mx-auto px-6">

      <!-- Ticket Checkout Flow (Livewire) -->
      <div id="packages" class="mb-16 bg-white rounded-[32px] overflow-hidden shadow-xl border border-aqua-cream-2">
        @livewire('checkout')
      </div>

      <!-- Info Bar -->
      <div class="bg-aqua-navy rounded-[28px] p-10 grid grid-cols-1 md:grid-cols-3 gap-8 text-white text-center mb-16 border border-aqua-gold/20">
        <div>
          <div class="text-aqua-gold text-3xl font-black mb-1">09:00</div>
          <div class="text-xs font-black uppercase tracking-widest text-white/40">
            {{ App::getLocale() === 'id' ? 'Buka' : 'Open' }}
          </div>
          <div class="text-sm font-semibold text-white/60 mt-1">
            {{ App::getLocale() === 'id' ? 'Setiap hari' : 'Every day' }}
          </div>
        </div>
        <div class="border-y md:border-y-0 md:border-x border-aqua-gold/15 py-6 md:py-0">
          <div class="text-aqua-gold text-3xl font-black mb-1">18:00</div>
          <div class="text-xs font-black uppercase tracking-widest text-white/40">
            {{ App::getLocale() === 'id' ? 'Tutup' : 'Close' }}
          </div>
          <div class="text-sm font-semibold text-white/60 mt-1">
            {{ App::getLocale() === 'id' ? 'Tiket terakhir 17:00' : 'Last admission 17:00' }}
          </div>
        </div>
        <div>
          <div class="text-aqua-gold text-3xl font-black mb-1">7th</div>
          <div class="text-xs font-black uppercase tracking-widest text-white/40">
            {{ App::getLocale() === 'id' ? 'Lantai' : 'Floor' }}
          </div>
          <div class="text-sm font-semibold text-white/60 mt-1">Pentacity Mall, BSB</div>
        </div>
      </div>

      {{-- ============ SPECIAL PACKAGES SECTION (integrated from /packages) ============ --}}
      <div class="mb-16">
        <div class="text-center mb-10">
          <div class="flex items-center justify-center gap-3 mb-3">
            <div class="h-px w-10 bg-aqua-gold"></div>
            <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">Special Deals</span>
            <div class="h-px w-10 bg-aqua-gold"></div>
          </div>
          <h2 class="text-3xl md:text-4xl font-black text-aqua-navy uppercase mb-3">
            {{ App::getLocale() === 'id' ? 'PAKET & PENAWARAN KHUSUS' : 'PACKAGES & SPECIAL OFFERS' }}
          </h2>
          <p class="text-slate-500 font-semibold text-sm max-w-xl mx-auto">
            {{ App::getLocale() === 'id' ? 'Aquaboom menyediakan paket khusus untuk acara ulang tahun, gathering keluarga, outing kantor, dan grup besar. Hemat lebih banyak dengan paket bundling!' : 'Aquaboom provides special packages for birthday events, family gatherings, corporate outings, and large groups. Save more with bundle packages!' }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

          <!-- Duo Pass -->
          <div class="bg-white rounded-[28px] overflow-hidden shadow-xl border border-aqua-cream-2 flex flex-col group hover:-translate-y-2 transition-all duration-300">
            <div class="relative h-52 overflow-hidden">
              <img src="https://picsum.photos/600/400?random=51" alt="Duo Pass" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
              <div class="absolute inset-0 bg-aqua-navy/70 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <p class="text-white text-sm font-bold text-center px-5 mb-4">Slide with a friend & save up to 15%!</p>
                <a href="#packages" class="bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-7 py-2.5 rounded-full text-sm uppercase tracking-wider transition-all">BOOK NOW</a>
              </div>
              <div class="absolute top-3 left-3 bg-aqua-gold text-aqua-navy text-[9px] font-black px-2.5 py-1 rounded-full uppercase tracking-widest">Save 15%</div>
            </div>
            <div class="p-7 flex-1 flex flex-col justify-between">
              <div>
                <h3 class="text-lg font-black text-aqua-navy mb-2 uppercase">Duo Pass</h3>
                <p class="text-slate-500 text-xs font-semibold leading-relaxed mb-4">Tiket 2 orang + 2 handuk + 1 locker + 30 menit foot massage masing-masing.</p>
                <div class="flex items-center justify-between bg-aqua-cream rounded-xl p-3 mb-1">
                  <span class="text-aqua-navy font-black text-sm">Harga Paket</span>
                  <span class="text-aqua-gold font-black text-lg">Rp 270.000</span>
                </div>
              </div>
              <a href="#packages" class="mt-4 block w-full text-center bg-aqua-navy hover:bg-aqua-navy-2 text-white font-black py-3.5 rounded-xl text-sm uppercase tracking-wider transition-all">Book Now</a>
            </div>
          </div>

          <!-- Birthday Package -->
          <div class="bg-white rounded-[28px] overflow-hidden shadow-xl border border-aqua-gold/30 flex flex-col group hover:-translate-y-2 transition-all duration-300 ring-1 ring-aqua-gold/30">
            <div class="relative h-52 overflow-hidden">
              <img src="https://picsum.photos/600/400?random=53" alt="Birthday Package" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
              <div class="absolute inset-0 bg-aqua-navy/70 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <p class="text-white text-sm font-bold text-center px-5 mb-4">Celebrate your special day!</p>
                <a href="mailto:info@aquaboombsb.com?subject=Birthday Package" class="bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-7 py-2.5 rounded-full text-sm uppercase tracking-wider transition-all">ENQUIRE NOW</a>
              </div>
              <div class="absolute top-3 left-3 bg-aqua-gold text-aqua-navy text-[9px] font-black px-2.5 py-1 rounded-full uppercase tracking-widest">🎂 Birthday</div>
              <div class="absolute top-3 right-3 bg-white/90 text-aqua-navy text-[9px] font-black px-2.5 py-1 rounded-full uppercase tracking-widest">Populer</div>
            </div>
            <div class="p-7 flex-1 flex flex-col justify-between">
              <div>
                <h3 class="text-lg font-black text-aqua-navy mb-2 uppercase">Birthday Package</h3>
                <p class="text-slate-500 text-xs font-semibold leading-relaxed mb-4">10 tiket + gazebo + dekorasi + kue + 10 minuman + special gift dari Aquaboom.</p>
                <div class="flex items-center justify-between bg-aqua-cream rounded-xl p-3 mb-1">
                  <span class="text-aqua-navy font-black text-sm">Harga Paket</span>
                  <span class="text-aqua-gold font-black text-lg">Rp 1.800.000</span>
                </div>
              </div>
              <a href="mailto:info@aquaboombsb.com?subject=Birthday Package" class="mt-4 block w-full text-center bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black py-3.5 rounded-xl text-sm uppercase tracking-wider transition-all">Enquire Now</a>
            </div>
          </div>

          <!-- Annual Pass -->
          <div class="bg-aqua-navy rounded-[28px] overflow-hidden shadow-xl flex flex-col group hover:-translate-y-2 transition-all duration-300">
            <div class="relative h-52 overflow-hidden">
              <img src="https://picsum.photos/600/400?random=54" alt="Annual Pass" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-60" />
              <div class="absolute inset-0 bg-aqua-navy/60 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <p class="text-white text-sm font-bold text-center px-5 mb-4">Unlimited thrills all year!</p>
                <a href="mailto:info@aquaboombsb.com?subject=Annual Pass" class="bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-7 py-2.5 rounded-full text-sm uppercase tracking-wider transition-all">ENQUIRE NOW</a>
              </div>
              <div class="absolute top-3 left-3 bg-aqua-gold/20 border border-aqua-gold/50 text-aqua-gold text-[9px] font-black px-2.5 py-1 rounded-full uppercase tracking-widest">Annual Pass</div>
            </div>
            <div class="p-7 flex-1 flex flex-col justify-between">
              <div>
                <h3 class="text-lg font-black text-white mb-2 uppercase">Unlimited Annual Pass</h3>
                <p class="text-white/60 text-xs font-semibold leading-relaxed mb-4">Akses tak terbatas 12 bulan + handuk gratis + 20% off untuk 4 teman per kunjungan.</p>
                <div class="bg-white/10 border border-aqua-gold/20 rounded-xl p-3">
                  <div class="flex justify-between"><span class="text-white/70 text-xs font-bold">Dewasa</span><span class="text-aqua-gold font-black">Rp 780.000</span></div>
                  <div class="flex justify-between mt-1"><span class="text-white/70 text-xs font-bold">Anak (2-11 th)</span><span class="text-aqua-gold font-black">Rp 660.000</span></div>
                </div>
              </div>
              <a href="mailto:info@aquaboombsb.com?subject=Annual Pass" class="mt-4 block w-full text-center bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black py-3.5 rounded-xl text-sm uppercase tracking-wider transition-all">Enquire Now</a>
            </div>
          </div>

        </div>

        <!-- View All Packages CTA -->
        <div class="mt-8 text-center">
          <a href="{{ url('/packages') }}" class="inline-flex items-center gap-2 text-aqua-azure hover:text-aqua-gold font-black text-sm uppercase tracking-wider transition-colors">
            View All 6 Packages &rarr;
          </a>
        </div>
      </div>

      {{-- CTA Bottom --}}
      <div class="bg-aqua-navy rounded-[28px] p-12 text-center border border-aqua-gold/20">
        <div class="flex items-center justify-center gap-3 mb-3">
          <div class="h-px w-8 bg-aqua-gold/50"></div>
          <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">Skip the Queue</span>
          <div class="h-px w-8 bg-aqua-gold/50"></div>
        </div>
        <h3 class="text-3xl font-black text-white uppercase mb-4">
          {{ App::getLocale() === 'id' ? 'Beli Online, Langsung Masuk!' : 'Buy Online, Skip the Line!' }}
        </h3>
        <p class="text-white/60 font-semibold text-sm max-w-lg mx-auto mb-8">
          {{ App::getLocale() === 'id' ? 'Pilih tanggal, pilih jumlah tiket, bayar online, dan tunjukkan QR Code e-ticket Anda di loket. Tidak perlu antre!' : 'Choose date, select ticket quantity, pay online, and present your e-ticket QR Code at the gate. No queues!' }}
        </p>
        <a href="#packages" class="inline-block bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-12 py-5 rounded-xl shadow-lg shadow-amber-900/20 uppercase tracking-wider text-sm transition-all transform hover:-translate-y-0.5">
          {{ App::getLocale() === 'id' ? 'BELI TIKET ONLINE SEKARANG !' : 'BUY TICKETS ONLINE NOW !' }}
        </a>
      </div>

    </div>
  </section>

</x-layout>
