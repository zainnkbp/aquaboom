<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Packages & Special Offers - Aquaboom Waterpark' : 'Paket Promo & Penawaran Spesial - Aquaboom Waterpark' }}</x-slot:title>

  <!-- Page Header -->
  <div class="pt-36 pb-20 bg-aqua-navy relative overflow-hidden">
    <div class="absolute inset-0 z-0">
      <img src="{{ asset('assets/img/default.jpeg') }}" alt="Packages Header" class="w-full h-full object-cover opacity-20 mix-blend-overlay" />
      <div class="absolute inset-0 bg-gradient-to-b from-waterbom-dark/80 to-waterbom-dark"></div>
    </div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
      <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase mb-4 block">
        {{ App::getLocale() === 'en' ? 'Exclusive Packages' : 'Paket Promo Eksklusif' }}
      </span>
      <h1 class="text-4xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight leading-tight">
        {!! App::getLocale() === 'en' ? 'PACKAGES &<br/><span class="gold-shimmer">SPECIAL OFFERS</span>' : 'PAKET PROMO &<br/><span class="gold-shimmer">PENAWARAN SPESIAL</span>' !!}
      </h1>
      <p class="text-base md:text-lg text-white/70 font-semibold max-w-3xl mx-auto leading-relaxed">
        {{ App::getLocale() === 'en'
          ? 'Aquaboom is the perfect rooftop destination for family outings, birthdays, gatherings, and special deals. Enjoy bundled value passes with included towels, lockers, and recreation vouchers!'
          : 'Aquaboom menghadirkan pilihan paket hemat terbaik untuk liburan keluarga, pasangan, hingga rombongan. Nikmati penawaran spesial hemat dengan bonus handuk, loker, dan voucher fasilitas!' }}
      </p>
      <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ url('/ticket') }}" class="inline-block bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-10 py-4 rounded-full uppercase tracking-wider text-sm transition-all shadow-lg shadow-amber-900/20">
          {{ App::getLocale() === 'en' ? 'Buy Tickets Online' : 'Beli Tiket Online' }}
        </a>
        <a href="{{ url('/gatherings') }}" class="inline-block bg-white/10 hover:bg-white/20 text-white border border-white/30 font-black px-10 py-4 rounded-full uppercase tracking-wider text-sm transition-all">
          {{ App::getLocale() === 'en' ? 'Group Gathering' : 'Paket Rombongan' }}
        </a>
      </div>
    </div>
  </div>

  <!-- Package Cards Grid -->
  <section class="py-24 bg-aqua-cream">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

      <!-- Section intro note -->
      <div class="text-center mb-16">
        <p class="text-slate-600 font-semibold text-sm max-w-2xl mx-auto">
          {{ App::getLocale() === 'en'
            ? 'Looking for regular daily passes? Visit our ticket booking page to select your dates directly. Check out our special bundled offers below:'
            : 'Mencari tiket masuk harian biasa? Kunjungi halaman tiket kami untuk langsung memilih tanggal kunjungan. Lihat pilihan paket bundling hemat di bawah ini:' }}
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

        @forelse($packages as $package)
          @php
            $buttonLink = url('/book');
            $buttonText = App::getLocale() === 'id' ? 'Beli Sekarang' : 'Book Now';
            $buttonClass = 'bg-aqua-navy hover:bg-black text-white';

            if ($package->inquiry_type === 'whatsapp') {
                $buttonText = App::getLocale() === 'id' ? 'Hubungi via WhatsApp' : 'Enquire via WhatsApp';
                $buttonClass = 'bg-emerald-600 hover:bg-emerald-700 text-white';
                $textParam = rawurlencode('Halo, saya tertarik dengan paket: ' . $package->name);
                $buttonLink = $package->inquiry_custom_link ?: "https://wa.me/628115472233?text={$textParam}";
            } elseif ($package->inquiry_type === 'email') {
                $buttonText = App::getLocale() === 'id' ? 'Hubungi via Email' : 'Enquire via Email';
                $buttonClass = 'bg-aqua-gold hover:bg-aqua-gold-2 text-white';
                $subjectParam = rawurlencode('Inquiry for ' . $package->name);
                $buttonLink = $package->inquiry_custom_link ?: "mailto:info@aquaboombsb.com?subject={$subjectParam}";
            }
          @endphp
          <div class="bg-white rounded-[28px] overflow-hidden shadow-xl border border-slate-100 flex flex-col group hover:-translate-y-2 transition-all duration-300">
            <!-- Image with Hover Overlay -->
            <div class="relative h-64 overflow-hidden bg-aqua-navy">
              <img src="{{ $package->image_url }}" alt="{{ $package->name }}" onerror="this.onerror=null; this.src='{{ asset('assets/img/default-package.svg') }}';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
              <!-- Hover Overlay -->
              <div class="absolute inset-0 bg-aqua-navy/75 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <p class="text-white text-base font-bold text-center px-6 mb-5">
                  {{ App::getLocale() === 'en' && $package->name_en ? $package->name_en : $package->name }}
                </p>
                <a href="{{ $buttonLink }}" target="{{ $package->inquiry_type !== 'none' ? '_blank' : '_self' }}" class="bg-white/20 hover:bg-aqua-gold border-2 border-white text-white font-black px-8 py-3 rounded-full text-sm uppercase tracking-wider transition-all">
                  {{ $buttonText }}
                </a>
              </div>
              <!-- Badge -->
              @if($package->is_discounted)
                <div class="absolute top-4 left-4 bg-aqua-gold text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
                  @if($package->discount_type === 'percentage')
                    Save {{ rtrim(rtrim(number_format((float) $package->discount_price, 2), '0'), '.') }}%
                  @else
                    Special Price
                  @endif
                </div>
              @endif
            </div>
            <!-- Card Content -->
            <div class="p-8 flex-1 flex flex-col justify-between">
              <div>
                <h3 class="text-2xl font-black text-aqua-navy mb-3 uppercase">
                  {{ App::getLocale() === 'en' && $package->name_en ? $package->name_en : $package->name }}
                </h3>
                @php
                  $pDesc = App::getLocale() === 'en' && $package->description_en ? $package->description_en : $package->description;
                  $hasPlus = str_contains($pDesc, ' + ');
                @endphp
                @if($hasPlus)
                  @php
                    $bList = explode(' + ', $pDesc);
                  @endphp
                  <ul class="space-y-2 mb-5">
                    @foreach($bList as $bItem)
                      <li class="flex items-start gap-2.5 text-xs font-semibold text-slate-700">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ trim($bItem) }}</span>
                      </li>
                    @endforeach
                  </ul>
                @else
                  <p class="text-slate-600 font-semibold text-sm leading-relaxed mb-5">
                    {{ $pDesc }}
                  </p>
                @endif
                
                @if($package->terms_and_conditions)
                  <div class="mb-6">
                    <p class="text-xs font-black text-aqua-navy uppercase tracking-widest mb-3">
                      {{ App::getLocale() === 'id' ? 'Syarat & Ketentuan:' : 'Terms & Conditions:' }}
                    </p>
                    <div class="prose prose-sm text-slate-600 font-semibold text-xs leading-relaxed max-h-36 overflow-y-auto pr-2">
                      {!! App::getLocale() === 'en' && $package->terms_and_conditions_en ? $package->terms_and_conditions_en : $package->terms_and_conditions !!}
                    </div>
                  </div>
                @endif

                <div class="bg-aqua-cream rounded-xl p-4 mb-6 text-sm">
                  @if($package->price > 0)
                    @if($package->is_discounted)
                      <div class="flex justify-between items-center mb-1">
                        <span class="text-slate-500 font-semibold">{{ App::getLocale() === 'en' ? 'Regular Price' : 'Harga Normal' }}</span>
                        <span class="text-slate-400 line-through font-bold">Rp {{ number_format((float) $package->price, 0, ',', '.') }}</span>
                      </div>
                    @endif
                    <div class="flex justify-between items-center">
                      <span class="text-aqua-navy font-black text-xs uppercase tracking-wider">
                        @if($package->type === 'gathering')
                          {{ App::getLocale() === 'en' ? 'Starts From' : 'Mulai Dari' }}
                        @elseif($package->type === 'bundle')
                          {{ App::getLocale() === 'en' ? 'Package Price' : 'Harga Paket' }}
                        @else
                          {{ App::getLocale() === 'en' ? 'Ticket Price' : 'Harga Tiket' }}
                        @endif
                      </span>
                      <div class="text-right">
                        <span class="text-aqua-gold text-xl font-black">
                          Rp {{ number_format((float) $package->effective_price, 0, ',', '.') }}
                          <span class="text-xs font-normal text-slate-500">
                            @if($package->type === 'gathering')
                              / {{ App::getLocale() === 'en' ? 'person' : 'orang' }}
                            @elseif($package->type === 'bundle')
                              / {{ App::getLocale() === 'en' ? 'package' : 'paket' }}
                            @else
                              / {{ App::getLocale() === 'en' ? 'ticket' : 'tiket' }}
                            @endif
                          </span>
                        </span>
                        @if(stripos($package->name, 'duo') !== false)
                          <div class="text-[11px] text-slate-500 font-bold">
                            {{ App::getLocale() === 'en' ? 'For 2 guests' : 'Untuk 2 orang' }}
                          </div>
                        @elseif(stripos($package->name, 'four pack') !== false || stripos($package->name, '4 pack') !== false)
                          <div class="text-[11px] text-slate-500 font-bold">
                            {{ App::getLocale() === 'en' ? 'For 4 guests' : 'Untuk 4 orang' }}
                          </div>
                        @endif
                      </div>
                    </div>
                  @else
                    <div class="text-center py-1 text-slate-500 font-bold italic text-xs">
                      {{ App::getLocale() === 'id' ? 'Harga: Hubungi Kami' : 'Price: Enquire for details' }}
                    </div>
                  @endif
                  @if($package->validity_type)
                    <p class="text-slate-400 text-[11px] font-semibold mt-2 italic">
                      @if($package->validity_type === 'weekday')
                        {{ App::getLocale() === 'en' ? '* Valid on Weekdays (Mon - Fri)' : '* Berlaku Hari Kerja (Senin - Jumat)' }}
                      @elseif($package->validity_type === 'weekend')
                        {{ App::getLocale() === 'en' ? '* Valid on Weekends & Public Holidays' : '* Berlaku Akhir Pekan (Sabtu, Minggu & Libur)' }}
                      @else
                        {{ App::getLocale() === 'en' ? '* Valid every day' : '* Berlaku setiap hari' }}
                      @endif
                    </p>
                  @endif
                  @if($package->sales_end)
                    <p class="text-rose-500 text-[11px] font-bold mt-1 italic">
                      * Promo berakhir s.d. {{ \Carbon\Carbon::parse($package->sales_end)->translatedFormat('d F Y H:i') }} WITA
                    </p>
                  @endif
                </div>
              </div>
              <a href="{{ $buttonLink }}" target="{{ $package->inquiry_type !== 'none' ? '_blank' : '_self' }}" class="block w-full text-center {{ $buttonClass }} font-black py-4 rounded-xl text-sm uppercase tracking-wider transition-all">
                {{ $buttonText }}
              </a>
            </div>
          </div>
        @empty
          <div class="col-span-full text-center py-12 text-slate-500 font-semibold">
            Belum ada paket / promo spesial saat ini.
          </div>
        @endforelse

      </div>

      </div>
    </div>
  </section>

  <!-- CTA Bottom Section -->
  <section class="py-20 bg-aqua-cream border-t border-slate-200">
    <div class="max-w-3xl mx-auto px-6 text-center">
      <span class="text-aqua-azure text-xs font-black tracking-widest uppercase mb-3 block">Still Unsure?</span>
      <h2 class="text-3xl md:text-4xl font-black text-aqua-navy uppercase mb-4">NEED A CUSTOM PACKAGE?</h2>
      <p class="text-slate-600 font-semibold text-sm max-w-xl mx-auto mb-8">
        Tidak menemukan paket yang sesuai? Hubungi tim kami dan kami akan membantu menyusun paket eksklusif sesuai kebutuhan Anda.
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="mailto:info@aquaboombsb.com" class="inline-block bg-aqua-navy hover:bg-black text-white font-black px-10 py-4 rounded-xl uppercase tracking-wider text-sm transition-all">
          Email Us
        </a>
        <a href="{{ url('/book') }}" class="inline-block bg-aqua-gold hover:bg-aqua-gold-2 text-white font-black px-10 py-4 rounded-xl uppercase tracking-wider text-sm transition-all shadow-lg shadow-orange-500/20">
          Book Standard Tickets
        </a>
      </div>
    </div>
  </section>

</x-layout>
