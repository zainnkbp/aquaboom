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
          @php
            $displayPackages = isset($specialPackages) ? $specialPackages : \App\Models\TicketPackage::where('is_active', true)->whereIn('type', ['bundle', 'flash_sale'])->orderBy('sort_order', 'asc')->get();
          @endphp

          @forelse($displayPackages as $package)
            @php
              $buttonLink = url('/book');
              $buttonText = App::getLocale() === 'id' ? 'Beli Sekarang' : 'Book Now';
              $buttonClass = 'bg-aqua-navy hover:bg-aqua-navy-2 text-white';

              if ($package->inquiry_type === 'whatsapp') {
                  $buttonText = App::getLocale() === 'id' ? 'Hubungi WhatsApp' : 'Enquire via WhatsApp';
                  $buttonClass = 'bg-emerald-600 hover:bg-emerald-700 text-white';
                  $textParam = rawurlencode('Halo, saya tertarik dengan paket: ' . $package->name);
                  $buttonLink = $package->inquiry_custom_link ?: "https://wa.me/628115472233?text={$textParam}";
              } elseif ($package->inquiry_type === 'email') {
                  $buttonText = App::getLocale() === 'id' ? 'Hubungi Email' : 'Enquire via Email';
                  $buttonClass = 'bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy';
                  $subjectParam = rawurlencode('Inquiry for ' . $package->name);
                  $buttonLink = $package->inquiry_custom_link ?: "mailto:info@aquaboombsb.com?subject={$subjectParam}";
              }
            @endphp
            <div class="bg-white rounded-[28px] overflow-hidden shadow-xl border border-aqua-cream-2 flex flex-col group hover:-translate-y-2 transition-all duration-300">
              <div class="relative h-52 overflow-hidden bg-aqua-navy">
                <img src="{{ $package->image_url }}" alt="{{ $package->name }}" onerror="this.onerror=null; this.src='{{ asset('assets/img/default-package.svg') }}';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                <div class="absolute inset-0 bg-aqua-navy/70 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                  <p class="text-white text-sm font-bold text-center px-5 mb-4">{{ App::getLocale() === 'en' && $package->name_en ? $package->name_en : $package->name }}</p>
                  <a href="{{ $buttonLink }}" target="{{ $package->inquiry_type !== 'none' ? '_blank' : '_self' }}" class="bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-7 py-2.5 rounded-full text-sm uppercase tracking-wider transition-all">{{ $buttonText }}</a>
                </div>
                @if($package->is_discounted)
                  <div class="absolute top-3 left-3 bg-aqua-gold text-aqua-navy text-[9px] font-black px-2.5 py-1 rounded-full uppercase tracking-widest">
                    @if($package->discount_type === 'percentage')
                      Save {{ rtrim(rtrim(number_format((float) $package->discount_price, 2), '0'), '.') }}%
                    @else
                      Special Price
                    @endif
                  </div>
                @endif
              </div>
              <div class="p-7 flex-1 flex flex-col justify-between">
                <div>
                  <h3 class="text-lg font-black text-aqua-navy mb-2 uppercase">
                    {{ App::getLocale() === 'en' && $package->name_en ? $package->name_en : $package->name }}
                  </h3>
                  <p class="text-slate-500 text-xs font-semibold leading-relaxed mb-4">
                    {{ App::getLocale() === 'en' && $package->description_en ? $package->description_en : $package->description }}
                  </p>
                  <div class="flex items-center justify-between bg-aqua-cream rounded-xl p-3 mb-1">
                    <span class="text-aqua-navy font-black text-sm">
                      {{ App::getLocale() === 'id' ? 'Harga Paket' : 'Package Price' }}
                    </span>
                    <span class="text-aqua-gold font-black text-lg">
                      Rp {{ number_format($package->effective_price, 0, ',', '.') }}
                    </span>
                  </div>
                </div>
                <a href="{{ $buttonLink }}" target="{{ $package->inquiry_type !== 'none' ? '_blank' : '_self' }}" class="mt-4 block w-full text-center {{ $buttonClass }} font-black py-3.5 rounded-xl text-sm uppercase tracking-wider transition-all">{{ $buttonText }}</a>
              </div>
            </div>
          @empty
            <div class="col-span-3 text-center py-12 text-slate-400 font-semibold italic text-sm">
              {{ App::getLocale() === 'id' ? 'Belum ada paket khusus yang aktif saat ini.' : 'No special packages currently active.' }}
            </div>
          @endforelse
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
