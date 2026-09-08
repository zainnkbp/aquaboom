<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Aquaboom Waterpark - The Premier Rooftop Waterpark in Balikpapan' : 'Aquaboom Waterpark - Waterpark Rooftop Pertama di Balikpapan' }}</x-slot:title>

  {{-- ============================================================ --}}
  {{-- HERO: Fullscreen Video Background (Navy-Gold Luxury Edition) --}}
  {{-- ============================================================ --}}
  <section id="hero" class="relative bg-aqua-navy overflow-hidden min-h-screen lg:h-screen lg:max-h-[900px] flex flex-col justify-center py-16 lg:py-0"
    x-data="{ videoLoaded: false }">

    {{-- Video Background --}}
    <div class="absolute inset-0 w-full h-full z-0">
      {{-- Mobile Static Background (Visible on mobile, hidden on desktop) --}}
      <div class="absolute inset-0 bg-cover bg-center lg:hidden"
        style="background-image: url('{{ asset('assets/img/aquaboom.jpeg') }}');"></div>

      {{-- Desktop Video Background (Hidden on mobile, visible on desktop) --}}
      <div class="relative w-full h-full pointer-events-none overflow-hidden hidden lg:block">
        @if(!empty($settings['hero_video_file']))
          <video autoplay loop muted playsinline class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full object-cover" x-on:play="videoLoaded = true">
            <source src="{{ asset('uploads/' . $settings['hero_video_file']) }}" type="video/mp4">
          </video>
        @else
          <iframe
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[177.78vh] min-w-full min-h-[56.25vw] h-auto"
            src="{!! $settings['hero_video_url'] ?? 'https://www.youtube.com/embed/2ugEGMhBPNE?autoplay=1&mute=1&loop=1&playlist=2ugEGMhBPNE&controls=0&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3&disablekb=1' !!}"
            title="Aquaboom Waterpark" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen
            x-on:load="videoLoaded = true"></iframe>
        @endif

        {{-- Fallback image shown until video loads --}}
        <div class="absolute inset-0 bg-cover bg-center"
          style="background-image: url('{{ asset('assets/img/aquaboom.jpeg') }}');" x-show="!videoLoaded"></div>
      </div>

      {{-- Deep Navy Overlay: left darker for text readability, right lighter for cinematic feel --}}
      <div class="absolute inset-0 video-hero-overlay z-10"></div>

      {{-- Bottom fade into page body --}}
      <div class="absolute bottom-0 left-0 right-0 h-40 bg-gradient-to-t from-aqua-navy to-transparent z-10"></div>
    </div>

    {{-- Hero Content --}}
    <div class="relative z-20 max-w-7xl mx-auto px-6 lg:px-14 flex flex-col justify-center items-start pt-24 pb-12 w-full">

      {{-- Gold eyebrow --}}
      <div class="flex items-center gap-3 mb-6 flex-wrap">
        <div class="h-px w-12 bg-aqua-gold hidden sm:block"></div>
        <span class="text-aqua-gold text-[10px] sm:text-xs font-black tracking-[0.2em] sm:tracking-[0.3em] uppercase">
          {{ App::getLocale() === 'en' ? "Balikpapan's Rooftop Waterpark" : "Waterpark Rooftop di Balikpapan" }}
        </span>
      </div>

      {{-- Main headline --}}
      <h1 class="text-4xl sm:text-6xl md:text-8xl lg:text-[7rem] font-black leading-none mb-6 uppercase text-white tracking-tight">
        {!! App::getLocale() === 'en' && !empty($settings['hero_headline_en']) ? $settings['hero_headline_en'] : ($settings['hero_headline'] ?? 'WATERPARK DI ATAS KOTA<br/><span class="gold-shimmer">ROOFTOP BALIKPAPAN</span>') !!}
      </h1>

      {{-- Sub-headline / Operating Hours Quick Note --}}
      <p class="text-sm sm:text-base md:text-xl font-bold text-aqua-gold uppercase tracking-wider mb-4 bg-aqua-navy/70 border border-aqua-gold/30 px-5 py-2.5 rounded-full inline-block backdrop-blur-sm">
        {!! App::getLocale() === 'en' && !empty($settings['hero_subheadline_en']) ? $settings['hero_subheadline_en'] : ($settings['hero_subheadline'] ?? 'Senin–Jumat: 10.00–18.00 | Sabtu, Minggu & Libur: 09.00–18.00 WITA') !!}
      </p>
      <p class="text-base text-white/70 font-semibold max-w-xl mb-10 leading-relaxed">
        {!! App::getLocale() === 'en' && !empty($settings['hero_description_en']) ? $settings['hero_description_en'] : ($settings['hero_description'] ?? 'Nikmati sensasi bermain air di lantai 7 Pentacity Mall BSB dengan pemandangan kota Balikpapan. Menghadirkan seluncuran seru, kolam keluarga, dan fasilitas rekreasi premium. Managed by Astara Hotel Balikpapan.') !!}
      </p>

      {{-- CTA Buttons --}}
      <div class="flex flex-col sm:flex-row gap-4">
        <a href="{{ url('/ticket') }}"
          class="inline-flex items-center justify-center gap-3 bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-10 py-5 rounded-full text-base shadow-2xl shadow-amber-900/30 transform hover:-translate-y-1 transition-all uppercase tracking-wider">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
              d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
          </svg>
          {{ App::getLocale() === 'en' ? 'BUY TICKETS' : 'BELI TIKET' }}
        </a>
        <a href="{{ url('/explore') }}"
          class="inline-flex items-center justify-center gap-3 bg-white/10 hover:bg-white/20 text-white border border-white/30 font-black px-10 py-5 rounded-full text-base transform hover:-translate-y-1 transition-all uppercase tracking-wider backdrop-blur-sm">
          {{ App::getLocale() === 'en' ? 'EXPLORE THE PARK' : 'LIHAT WAHANA' }} &rarr;
        </a>
      </div>

      {{-- Trust badges --}}
      <div class="flex flex-wrap items-center gap-6 mt-12">
        <div class="flex items-center gap-2 text-white/70 text-xs font-bold uppercase tracking-wider">
          <svg class="w-4 h-4 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
          </svg>
          {{ App::getLocale() === 'en' ? '7th Floor Rooftop, Pentacity Mall' : 'Rooftop Lantai 7 Pentacity Mall' }}
        </div>
        <div class="w-px h-4 bg-white/20 hidden md:block"></div>
        <div class="flex items-center gap-2 text-white/70 text-xs font-bold uppercase tracking-wider">
          <svg class="w-4 h-4 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
          </svg>
          {{ App::getLocale() === 'en' ? 'Trained Lifeguards & Safety First' : 'Lifeguard Terlatih & Prioritas Keselamatan' }}
        </div>
        <div class="w-px h-4 bg-white/20 hidden md:block"></div>
        <div class="flex items-center gap-2 text-white/70 text-xs font-bold uppercase tracking-wider">
          <svg class="w-4 h-4 text-aqua-gold" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
          </svg>
          {{ App::getLocale() === 'en' ? 'Managed by Astara Hotel BSB' : 'Dikelola oleh Astara Hotel BSB' }}
        </div>
      </div>

    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center gap-2 animate-bounce">
      <span class="text-white/30 text-[10px] font-black uppercase tracking-widest">Scroll</span>
      <svg class="w-5 h-5 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </div>

  </section>

  {{-- ============================================================ --}}
  {{-- PROMO TICKER BAR (High Energy Conversion Ribbon)             --}}
  {{-- ============================================================ --}}
  <section class="bg-gradient-to-r from-aqua-navy via-[#173837] to-aqua-navy py-6 border-y border-aqua-gold/20 relative z-20 shadow-xl">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center text-center md:text-left">
        <div class="flex items-center justify-center md:justify-start gap-4">
          <div class="w-12 h-12 rounded-2xl bg-aqua-gold/15 text-aqua-gold flex items-center justify-center shrink-0 border border-aqua-gold/30">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
            </svg>
          </div>
          <div>
            <div class="text-white font-black text-sm uppercase tracking-wide">
              {{ App::getLocale() === 'en' ? 'Book Online & Save More' : 'Pesan Online Lebih Hemat' }}
            </div>
            <div class="text-white/60 text-xs font-semibold">
              {{ App::getLocale() === 'en' ? 'Skip the counter queues, e-tickets sent instantly to WhatsApp & Email.' : 'Hindari antrean loket, e-tiket langsung kirim ke WhatsApp & Email.' }}
            </div>
          </div>
        </div>

        <div class="flex items-center justify-center md:justify-start gap-4">
          <div class="w-12 h-12 rounded-2xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0 border border-emerald-500/30">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
          <div>
            <div class="text-white font-black text-sm uppercase tracking-wide">
              {{ App::getLocale() === 'en' ? 'Corporate & Group Gathering' : 'Gathering Kantor & Rombongan' }}
            </div>
            <div class="text-white/60 text-xs font-semibold">
              {{ App::getLocale() === 'en' ? 'Special group rates starting from 10+ pax with dedicated event support.' : 'Diskon rombongan mulai 10+ orang & fasilitas pendukung acara lengkap.' }}
            </div>
          </div>
        </div>

        <div class="flex justify-center md:justify-end">
          <a href="{{ url('/ticket') }}" class="bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-6 py-3 rounded-full text-xs uppercase tracking-wider transition-all shadow-md transform hover:scale-105">
            {{ App::getLocale() === 'en' ? 'View Offers Today →' : 'Cek Promo Hari Ini →' }}
          </a>
        </div>
      </div>
    </div>
  </section>

  {{-- ============================================================ --}}
  {{-- FEATURED TICKETS & PROMO DEALS SECTION (Direct Conversion)   --}}
  {{-- ============================================================ --}}
  <section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      <div class="text-center mb-16">
        <div class="flex items-center justify-center gap-3 mb-4">
          <div class="h-px w-10 bg-aqua-gold"></div>
          <span class="text-aqua-gold text-xs font-black tracking-widest uppercase">
            {{ App::getLocale() === 'en' ? 'Best Value Tickets' : 'Pilihan Tiket & Promo Terbaik' }}
          </span>
          <div class="h-px w-10 bg-aqua-gold"></div>
        </div>
        <h2 class="text-3xl md:text-5xl font-black text-aqua-navy uppercase tracking-tight">
          {{ App::getLocale() === 'en' ? 'FEATURED ADMISSION TICKETS' : 'TIKET MASUK & PENAWARAN SPESIAL' }}
        </h2>
        <p class="mt-4 text-slate-500 text-base font-semibold max-w-2xl mx-auto">
          {{ App::getLocale() === 'en'
            ? 'Choose your preferred package and enjoy seamless entry to all slides, pools, and water attractions.'
            : 'Pilih tiket masuk atau promo favorit Anda untuk menikmati seluruh seluncuran, kolam arus, dan wahana rooftop.' }}
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @if(isset($featuredPackages) && $featuredPackages->count() > 0)
          @foreach($featuredPackages as $pkg)
            @php
              $salesWa = preg_replace('/[^0-9]/', '', $settings['contact_whatsapp'] ?? '628115472233');
              if (str_starts_with($salesWa, '0')) {
                  $salesWa = '62' . substr($salesWa, 1);
              }
              $textParam = rawurlencode('Halo, saya tertarik dengan tiket/paket: ' . $pkg->name);
              
              if ($pkg->type === 'gathering') {
                  $buttonLink = url('/gatherings');
                  $buttonText = App::getLocale() === 'id' ? 'Konsultasi Gathering' : 'Enquire Gathering';
                  $buttonClass = 'bg-emerald-600 hover:bg-emerald-700 text-white';
                  $hoverBtnClass = 'bg-emerald-600 hover:bg-emerald-700 text-white';
              } elseif ($pkg->inquiry_type === 'whatsapp') {
                  $buttonLink = $pkg->inquiry_custom_link ?: "https://wa.me/{$salesWa}?text={$textParam}";
                  $buttonText = App::getLocale() === 'id' ? 'Hubungi WhatsApp' : 'Enquire via WhatsApp';
                  $buttonClass = 'bg-emerald-600 hover:bg-emerald-700 text-white';
                  $hoverBtnClass = 'bg-emerald-600 hover:bg-emerald-700 text-white';
              } else {
                  $buttonLink = url('/ticket');
                  $buttonText = App::getLocale() === 'id' ? 'Beli Tiket Online' : 'Buy Ticket Online';
                  $buttonClass = 'bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy';
                  $hoverBtnClass = 'bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy';
              }
            @endphp
            <div class="bg-white rounded-[28px] overflow-hidden shadow-xl border border-slate-100 flex flex-col group hover:-translate-y-2 transition-all duration-300">
              <!-- Image with Hover Overlay -->
              <div class="relative h-60 overflow-hidden bg-aqua-navy">
                <img src="{{ $pkg->image_url }}" alt="{{ $pkg->name }}" onerror="this.onerror=null; this.src='{{ asset('assets/img/default.jpeg') }}';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                
                <!-- Hover Overlay -->
                <div class="absolute inset-0 bg-aqua-navy/75 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                  <p class="text-white text-sm font-bold text-center px-6 mb-4">
                    {{ App::getLocale() === 'en' && $pkg->name_en ? $pkg->name_en : $pkg->name }}
                  </p>
                  <a href="{{ $buttonLink }}" target="{{ $pkg->inquiry_type === 'whatsapp' ? '_blank' : '_self' }}" class="{{ $hoverBtnClass }} font-black px-7 py-2.5 rounded-full text-xs uppercase tracking-wider transition-all shadow-md">
                    {{ $buttonText }}
                  </a>
                </div>

                <!-- Badges -->
                @if($pkg->is_discounted)
                  <div class="absolute top-4 left-4 bg-rose-600 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest shadow-md">
                    @if($pkg->discount_type === 'percentage')
                      Save {{ rtrim(rtrim(number_format((float) $pkg->discount_price, 2), '0'), '.') }}%
                    @else
                      Promo Hemat
                    @endif
                  </div>
                @endif

                <div class="absolute top-4 right-4 bg-aqua-navy/80 text-aqua-gold text-[10px] font-black px-3 py-1 rounded-full backdrop-blur-sm border border-aqua-gold/30 uppercase">
                  @if(App::getLocale() === 'en')
                    {{ $pkg->validity_type === 'weekday' ? 'Weekday' : ($pkg->validity_type === 'weekend' ? 'Weekend' : 'All Days') }}
                  @else
                    {{ $pkg->validity_type === 'weekday' ? 'Hari Kerja' : ($pkg->validity_type === 'weekend' ? 'Akhir Pekan' : 'Semua Hari') }}
                  @endif
                </div>
              </div>

              <!-- Card Content -->
              <div class="p-7 flex-1 flex flex-col justify-between">
                <div>
                  <h3 class="text-xl font-black text-aqua-navy mb-2 uppercase line-clamp-2">
                    {{ App::getLocale() === 'en' && $pkg->name_en ? $pkg->name_en : $pkg->name }}
                  </h3>
                  <p class="text-slate-500 text-xs font-semibold leading-relaxed mb-5 line-clamp-3">
                    {{ App::getLocale() === 'en' && $pkg->description_en ? $pkg->description_en : $pkg->description }}
                  </p>

                  <div class="bg-aqua-cream rounded-xl p-3.5 mb-5 text-sm">
                    @if($pkg->price > 0)
                      @if($pkg->is_discounted)
                        <div class="flex justify-between items-center mb-1">
                          <span class="text-slate-500 text-xs font-semibold">{{ App::getLocale() === 'en' ? 'Regular Price' : 'Harga Normal' }}</span>
                          <span class="text-slate-400 line-through text-xs font-bold">Rp {{ number_format((float) $pkg->price, 0, ',', '.') }}</span>
                        </div>
                      @endif
                      <div class="flex justify-between items-center">
                        <span class="text-aqua-navy font-black text-xs uppercase tracking-wider">
                          @if($pkg->type === 'gathering')
                            {{ App::getLocale() === 'en' ? 'Starts From' : 'Mulai Dari' }}
                          @elseif($pkg->type === 'bundle')
                            {{ App::getLocale() === 'en' ? 'Package Price' : 'Harga Paket' }}
                          @else
                            {{ App::getLocale() === 'en' ? 'Ticket Price' : 'Harga Tiket' }}
                          @endif
                        </span>
                        <div class="text-right">
                          <div class="text-aqua-gold text-lg font-black leading-tight">
                            Rp {{ number_format((float) $pkg->effective_price, 0, ',', '.') }}
                            <span class="text-[10px] font-normal text-slate-500">
                              @if($pkg->type === 'gathering')
                                / {{ App::getLocale() === 'en' ? 'person' : 'orang' }}
                              @elseif($pkg->type === 'bundle')
                                / {{ App::getLocale() === 'en' ? 'package' : 'paket' }}
                              @else
                                / {{ App::getLocale() === 'en' ? 'ticket' : 'tiket' }}
                              @endif
                            </span>
                          </div>
                          @if(stripos($pkg->name, 'duo') !== false)
                            <div class="text-[10px] text-slate-500 font-bold">
                              {{ App::getLocale() === 'en' ? 'For 2 guests' : 'Untuk 2 orang' }}
                            </div>
                          @elseif(stripos($pkg->name, 'four pack') !== false || stripos($pkg->name, '4 pack') !== false)
                            <div class="text-[10px] text-slate-500 font-bold">
                              {{ App::getLocale() === 'en' ? 'For 4 guests' : 'Untuk 4 orang' }}
                            </div>
                          @endif
                        </div>
                      </div>
                    @else
                      <div class="text-center py-1">
                        <span class="text-emerald-700 font-black text-xs uppercase tracking-wider">
                          {{ App::getLocale() === 'id' ? 'Penawaran Kustom / By Request' : 'Custom Quote on Request' }}
                        </span>
                      </div>
                    @endif
                  </div>
                </div>

                <a href="{{ $buttonLink }}" target="{{ $pkg->inquiry_type === 'whatsapp' ? '_blank' : '_self' }}" class="block w-full text-center {{ $buttonClass }} font-black py-3.5 rounded-xl text-xs uppercase tracking-wider transition-all shadow-md">
                  {{ $buttonText }}
                </a>
              </div>
            </div>
          @endforeach
        @endif
      </div>

      <div class="text-center mt-12">
        <a href="{{ url('/ticket') }}" class="inline-flex items-center gap-2 text-aqua-navy font-black hover:text-aqua-gold text-sm uppercase tracking-wider transition-colors border-b-2 border-aqua-gold pb-1">
          {{ App::getLocale() === 'en' ? 'Explore All Ticket Options & Facility Add-Ons' : 'Lihat Semua Pilihan Tiket & Add-On Fasilitas' }} &rarr;
        </a>
      </div>
    </div>
  </section>

  {{-- ============================================================ --}}
  {{-- CORPORATE & GROUP GATHERING SHOWCASE BANNER (High Impact B2B) --}}
  {{-- ============================================================ --}}
  <section class="py-20 bg-aqua-navy text-white relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full border border-aqua-gold/10 pointer-events-none"></div>
    <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full border border-aqua-gold/10 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-10 relative z-10">
      <div class="bg-gradient-to-r from-[#173837] via-aqua-navy to-[#173837] rounded-[36px] p-8 md:p-16 border border-aqua-gold/30 shadow-2xl relative overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
          <div class="lg:col-span-7">
            <div class="flex items-center gap-3 mb-4">
              <span class="bg-aqua-gold text-aqua-navy text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider">
                {{ App::getLocale() === 'en' ? 'Group & Corporate Events' : 'Event & Gathering Rombongan' }}
              </span>
            </div>
            <h2 class="text-3xl md:text-5xl font-black uppercase mb-6 leading-tight">
              {!! App::getLocale() === 'en' ? 'Plan Your Corporate &<br/><span class="gold-shimmer">Family Gathering Event</span>' : 'Rencanakan Acara Kantor &<br/><span class="gold-shimmer">Gathering Keluarga Anda</span>' !!}
            </h2>
            <p class="text-white/70 text-sm md:text-base font-semibold leading-relaxed mb-8 max-w-xl">
              {{ App::getLocale() === 'en'
                ? 'Exclusive rooftop venue on the 7th floor of Pentacity Mall BSB. Complete with private gazebo rentals, professional sound system & mic, team-building facilitators, and delicious buffet dining packages.'
                : 'Venue rooftop eksklusif di lantai 7 Pentacity Mall BSB. Lengkap dengan fasilitas sewa gazebo pribadi, sound system & mic, pemandu fun team building games, dan paket makan siang buffet.' }}
            </p>

            @php
              $salesWaHome = preg_replace('/[^0-9]/', '', $settings['contact_whatsapp'] ?? '628115472233');
              if (str_starts_with($salesWaHome, '0')) {
                  $salesWaHome = '62' . substr($salesWaHome, 1);
              }
            @endphp
            <div class="flex flex-wrap gap-4 items-center">
              <a href="{{ url('/gatherings') }}" class="inline-flex items-center gap-3 bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-8 py-4 rounded-full uppercase tracking-wider text-xs transition-all shadow-xl shadow-amber-900/30 transform hover:-translate-y-1">
                {{ App::getLocale() === 'en' ? 'View Gathering Packages' : 'Lihat Paket Gathering Lengkap' }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
              </a>
              <a href="https://wa.me/{{ $salesWaHome }}?text=Halo%20Tim%20Sales%20Aquaboom,%20saya%20ingin%20konsultasi%20penawaran%20corporate/family%20gathering" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-black px-6 py-4 rounded-full uppercase tracking-wider text-xs transition-all shadow-md">
                {{ App::getLocale() === 'en' ? 'Chat Sales on WhatsApp' : 'Chat Tim Sales WhatsApp' }}
              </a>
            </div>
          </div>

          <div class="lg:col-span-5">
            <div class="grid grid-cols-2 gap-4">
              <div class="bg-white/5 border border-white/10 rounded-2xl p-5 backdrop-blur-sm">
                <div class="text-2xl font-black text-aqua-gold mb-1">Outing</div>
                <div class="text-xs text-white/70 font-semibold">{{ App::getLocale() === 'en' ? 'Corporate & Business Gathering' : 'Corporate & BUMN Outing Kantor' }}</div>
              </div>
              <div class="bg-white/5 border border-white/10 rounded-2xl p-5 backdrop-blur-sm">
                <div class="text-2xl font-black text-aqua-gold mb-1">Family</div>
                <div class="text-xs text-white/70 font-semibold">{{ App::getLocale() === 'en' ? 'Family Reunion & Socials' : 'Arisan & Reuni Keluarga Besar' }}</div>
              </div>
              <div class="bg-white/5 border border-white/10 rounded-2xl p-5 backdrop-blur-sm">
                <div class="text-2xl font-black text-aqua-gold mb-1">School</div>
                <div class="text-xs text-white/70 font-semibold">{{ App::getLocale() === 'en' ? 'Study Tour & Field Trip' : 'Study Tour & Field Trip Siswa' }}</div>
              </div>
              <div class="bg-white/5 border border-white/10 rounded-2xl p-5 backdrop-blur-sm">
                <div class="text-2xl font-black text-aqua-gold mb-1">Birthday</div>
                <div class="text-xs text-white/70 font-semibold">{{ App::getLocale() === 'en' ? 'Poolside Birthday Party' : 'Poolside Birthday Party Anak' }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ============================================================ --}}
  {{-- DYNAMIC WATER RIDES — Ivory Cream Background                 --}}
  {{-- ============================================================ --}}
  <section id="rides" class="py-24 bg-aqua-cream">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      <div class="mb-16 text-center">
        <div class="flex items-center justify-center gap-4 mb-4">
          <div class="h-px w-16 bg-aqua-gold"></div>
          <span class="text-aqua-gold text-xs font-black tracking-widest uppercase">
            {{ App::getLocale() === 'en' ? 'Rooftop Attractions' : 'Wahana & Atraksi Rooftop' }}
          </span>
          <div class="h-px w-16 bg-aqua-gold"></div>
        </div>
        <h2 class="text-3xl md:text-6xl font-black text-aqua-navy uppercase tracking-tight">
          {{ App::getLocale() === 'en' ? 'DYNAMIC WATER RIDES' : 'WAHANA AIR POPULER' }}
        </h2>
        <p class="mt-4 text-slate-500 text-lg font-semibold max-w-2xl mx-auto">
          {{ App::getLocale() === 'en' 
            ? 'Discover exciting rooftop slides and family splash pools designed for memorable adventures and fun.' 
            : 'Temukan seluncuran seru dan kolam rekreasi yang dirancang khusus untuk petualangan keluarga di atas kota.' }}
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        @foreach($wahanas as $wahana)
          <div
            class="group bg-white rounded-[32px] overflow-hidden shadow-lg border border-aqua-cream-2 hover:shadow-2xl transition-all duration-300 flex flex-col">
            <div class="h-64 overflow-hidden relative">
              <img src="{{ $wahana->image_url }}" alt="{{ $wahana->name }}"
                onerror="this.onerror=null; this.src='{{ asset('assets/img/default-wahana.svg') }}';"
                class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" />
              <div
                class="absolute top-4 right-4 bg-aqua-navy text-aqua-gold px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider border border-aqua-gold/30">
                {{ $wahana->thrill_level ?? 'Ride' }}
              </div>
            </div>
            <div class="p-8 flex-1 flex flex-col justify-between">
              <div>
                <h3 class="text-2xl font-black text-aqua-navy mb-3 uppercase">
                  {{ App::getLocale() === 'en' && $wahana->name_en ? $wahana->name_en : $wahana->name }}
                </h3>
                <p class="text-slate-500 text-sm font-medium leading-relaxed mb-6">
                  {{ App::getLocale() === 'en' && $wahana->description_en ? $wahana->description_en : $wahana->description }}
                </p>
              </div>
              <a href="{{ url('/explore') }}"
                class="flex items-center text-aqua-azure text-sm font-black uppercase tracking-wider group-hover:text-aqua-gold transition-colors">
                {{ App::getLocale() === 'en' ? 'Explore rides' : 'Lihat wahana' }} &rarr;
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- ============================================================ --}}
  {{-- VIDEO / PHILOSOPHY SECTION — Navy Dark Background            --}}
  {{-- ============================================================ --}}
  <section id="philosophy" class="py-24 bg-aqua-navy text-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        {{-- Text Details --}}
        <div class="lg:col-span-4">
          <div class="flex items-center gap-3 mb-4">
            <div class="h-px w-10 bg-aqua-gold"></div>
            <span class="text-aqua-gold text-xs font-black tracking-widest uppercase">
              {{ App::getLocale() === 'en' ? 'About Aquaboom' : 'Tentang Aquaboom' }}
            </span>
          </div>
          <h2 class="text-3xl lg:text-5xl font-black uppercase mb-6 leading-tight">
            {!! App::getLocale() === 'en' ? 'OUR<br/>WATERPARK<br/><span class="gold-shimmer">EXPERIENCE</span>' : 'PENGALAMAN<br/>REKREASI<br/><span class="gold-shimmer">AQUABOOM</span>' !!}
          </h2>
          <p class="text-white/60 text-base leading-relaxed font-semibold">
            {!! App::getLocale() === 'en' && !empty($settings['philosophy_text_en']) ? $settings['philosophy_text_en'] : ($settings['philosophy_text'] ?? 'Menghadirkan kebahagiaan sejati dengan tetap menghormati harmoni alam sekitar. Setiap tetes air, senyum staf, dan wahana dirancang dengan kepedulian mendalam.') !!}
          </p>
          <div class="mt-8 grid grid-cols-2 gap-4">
            <div class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center">
              <div class="text-3xl font-black text-aqua-gold mb-1">50K+</div>
              <div class="text-white/50 text-xs font-bold uppercase tracking-wider">
                {{ App::getLocale() === 'en' ? 'Happy Visitors' : 'Pengunjung Puas' }}
              </div>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center">
              <div class="text-3xl font-black text-aqua-gold mb-1">4.8★</div>
              <div class="text-white/50 text-xs font-bold uppercase tracking-wider">
                {{ App::getLocale() === 'en' ? 'Guest Rating' : 'Rating Pengunjung' }}
              </div>
            </div>
          </div>
        </div>

        {{-- Video Box --}}
        <div class="lg:col-span-8">
          <div
            class="rounded-3xl overflow-hidden shadow-2xl relative aspect-video border border-white/10 ring-1 ring-aqua-gold/30">
            @if(!empty($settings['philosophy_video_file']))
              <video class="w-full h-full object-cover" controls>
                <source src="{{ asset('uploads/' . $settings['philosophy_video_file']) }}" type="video/mp4">
              </video>
            @else
              <iframe class="w-full h-full" src="{!! $settings['philosophy_video_url'] ?? 'https://www.youtube.com/embed/2ugEGMhBPNE?autoplay=1&mute=1&loop=1&playlist=2ugEGMhBPNE' !!}"
                title="Aquaboom Waterpark Company Video" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            @endif
          </div>
          <p class="text-white/30 text-xs font-semibold mt-4 text-right">
            © Aquaboom Balikpapan — {{ App::getLocale() === 'en' ? 'Official Waterpark Tour' : 'Video Resmi Wahana' }}
          </p>
        </div>
      </div>
    </div>
  </section>

  {{-- ============================================================ --}}
  {{-- CONNECT & SOCIAL PROOF SECTION (High Conversion Engagement)  --}}
  {{-- ============================================================ --}}
  <section id="connect" class="py-20 bg-aqua-navy text-white relative overflow-hidden border-t border-aqua-gold/20">
    <div class="absolute -top-20 -right-20 w-96 h-96 rounded-full border border-aqua-gold/10 pointer-events-none"></div>
    <div class="absolute -bottom-20 -left-20 w-80 h-80 rounded-full border border-aqua-gold/10 pointer-events-none"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
      <div class="flex items-center justify-center gap-4 mb-4">
        <div class="h-px w-12 bg-aqua-gold/60"></div>
        <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">
          {{ App::getLocale() === 'en' ? 'Stay Connected' : 'Informasi & Promo' }}
        </span>
        <div class="h-px w-12 bg-aqua-gold/60"></div>
      </div>
      <h2 class="text-3xl md:text-5xl font-black uppercase mb-4 leading-tight">
        {!! App::getLocale() === 'en' ? 'NEED ASSISTANCE OR SPECIAL OFFERS?' : 'BUTUH BANTUAN ATAU PENAWARAN KHUSUS?' !!}<br />
        <span class="gold-shimmer">{!! App::getLocale() === 'en' ? 'TALK TO OUR TEAM DIRECTLY' : 'HUBUNGI TIM RESMI AQUABOOM' !!}</span>
      </h2>
      <p class="text-white/60 text-sm md:text-base font-semibold max-w-2xl mx-auto mb-10 leading-relaxed">
        {{ App::getLocale() === 'en'
          ? 'Get real-time operational updates, check group availability, or consult your event plans directly with our guest services via WhatsApp and Instagram.'
          : 'Dapatkan informasi jadwal operasional terkini, cek kuota rombongan, atau konsultasi rencana acara Anda langsung dengan tim customer care kami.' }}
      </p>

      <div class="flex flex-wrap items-center justify-center gap-4">
        <a href="https://wa.me/{{ $salesWaHome }}?text=Halo%20Aquaboom,%20saya%20ingin%20tanya%20informasi%20tiket%20dan%20kunjungan"
          target="_blank"
          class="inline-flex items-center gap-3 bg-emerald-500 hover:bg-emerald-600 text-white font-black px-8 py-4 rounded-full text-sm uppercase tracking-wider transition-all shadow-xl shadow-emerald-950/30 transform hover:-translate-y-0.5">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
          </svg>
          {{ App::getLocale() === 'en' ? 'WhatsApp Concierge' : 'WhatsApp Tim Reservasi' }}
        </a>
        <a href="https://instagram.com/aquaboom.bsb"
          target="_blank"
          class="inline-flex items-center gap-3 bg-gradient-to-r from-pink-600 via-rose-500 to-amber-500 hover:opacity-90 text-white font-black px-8 py-4 rounded-full text-sm uppercase tracking-wider transition-all shadow-xl shadow-rose-950/30 transform hover:-translate-y-0.5">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
          </svg>
          {{ App::getLocale() === 'en' ? 'Follow @aquaboom.bsb' : 'Ikuti @aquaboom.bsb' }}
        </a>
        <a href="{{ url('/ticket') }}"
          class="inline-flex items-center gap-2 bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-8 py-4 rounded-full text-sm uppercase tracking-wider transition-all shadow-xl shadow-amber-900/20 transform hover:-translate-y-0.5">
          {{ App::getLocale() === 'en' ? 'Book Tickets Online' : 'Beli Tiket Online' }} &rarr;
        </a>
      </div>
    </div>
  </section>

</x-layout>