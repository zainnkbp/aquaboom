<x-layout>

  {{-- ============================================================ --}}
  {{-- HERO: Fullscreen Video Background (Navy-Gold Luxury Edition) --}}
  {{-- ============================================================ --}}
  <section id="hero" class="relative bg-aqua-navy overflow-hidden min-h-screen lg:h-screen lg:max-h-[900px] flex flex-col justify-center py-16 lg:py-0"
    x-data="{ videoLoaded: false }">

    {{-- Video Background --}}
    <div class="absolute inset-0 w-full h-full z-0">
      {{-- YouTube embed or Local Video as background --}}
      {{-- Mobile Static Background (Visible on mobile, hidden on desktop) --}}
      <div class="absolute inset-0 bg-cover bg-center lg:hidden"
        style="background-image: url('{{ asset('assets/img/default.jpeg') }}');"></div>

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
          style="background-image: url('{{ asset('assets/img/default.jpeg') }}');" x-show="!videoLoaded"></div>
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
          {{ App::getLocale() === 'en' ? 'The Only Rooftop Waterpark in Indonesia' : 'Satu-satunya Rooftop Waterpark di Indonesia' }}
        </span>
      </div>

      {{-- Main headline --}}
      <h1 class="text-4xl sm:text-6xl md:text-8xl lg:text-[7rem] font-black leading-none mb-6 uppercase text-white tracking-tight">
        {!! App::getLocale() === 'en' && !empty($settings['hero_headline_en']) ? $settings['hero_headline_en'] : ($settings['hero_headline'] ?? 'WE ARE<br/><span class="gold-shimmer">OPEN DAILY</span>') !!}
      </h1>

      {{-- Sub-headline --}}
      <p class="text-xl md:text-2xl font-black text-white/80 uppercase tracking-widest mb-3">
        {!! App::getLocale() === 'en' && !empty($settings['hero_subheadline_en']) ? $settings['hero_subheadline_en'] : ($settings['hero_subheadline'] ?? '9 AM — 6 PM') !!}
      </p>
      <p class="text-base text-white/55 font-semibold max-w-lg mb-10 leading-relaxed">
        {!! App::getLocale() === 'en' && !empty($settings['hero_description_en']) ? $settings['hero_description_en'] : ($settings['hero_description'] ?? 'Aquaboom Waterpark — 7th Floor, Pentacity Mall BSB, Balikpapan. Taman air premium pertama di rooftop Kalimantan Timur.') !!}
      </p>

      {{-- CTA Buttons --}}
      <div class="flex flex-col sm:flex-row gap-4">
        <a href="{{ url('/ticket') }}"
          class="inline-flex items-center gap-3 bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-10 py-5 rounded-full text-base shadow-2xl shadow-amber-900/30 transform hover:-translate-y-1 transition-all uppercase tracking-wider">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
              d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
          </svg>
          BUY TICKETS NOW
        </a>
        <a href="{{ url('/explore') }}"
          class="inline-flex items-center gap-3 bg-white/10 hover:bg-white/20 text-white border border-white/30 font-black px-10 py-5 rounded-full text-base transform hover:-translate-y-1 transition-all uppercase tracking-wider backdrop-blur-sm">
          Explore Rides &rarr;
        </a>
      </div>

      {{-- Trust badges --}}
      <div class="flex flex-wrap items-center gap-6 mt-12">
        <div class="flex items-center gap-2 text-white/50 text-xs font-bold uppercase tracking-wider">
          <svg class="w-4 h-4 text-aqua-gold" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
          </svg>
          Premium Experience
        </div>
        <div class="w-px h-4 bg-white/20 hidden md:block"></div>
        <div class="flex items-center gap-2 text-white/50 text-xs font-bold uppercase tracking-wider">
          <svg class="w-4 h-4 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
          </svg>
          Safe & Certified
        </div>
        <div class="w-px h-4 bg-white/20 hidden md:block"></div>
        <div class="flex items-center gap-2 text-white/50 text-xs font-bold uppercase tracking-wider">
          <svg class="w-4 h-4 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
          </svg>
          7th Floor, BSB Mall
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
  {{-- VIDEO / PHILOSOPHY SECTION — Navy Dark Background --}}
  {{-- ============================================================ --}}
  <section id="philosophy" class="py-24 bg-aqua-navy text-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        {{-- Text Details --}}
        <div class="lg:col-span-4">
          <div class="flex items-center gap-3 mb-4">
            <div class="h-px w-10 bg-aqua-gold"></div>
            <span class="text-aqua-gold text-xs font-black tracking-widest uppercase">Corporate Identity</span>
          </div>
          <h2 class="text-3xl lg:text-5xl font-black uppercase mb-6 leading-tight">
            OUR<br />COMPANY<br />
            <span class="gold-shimmer">PHILOSOPHY</span>
          </h2>
          <p class="text-white/60 text-base leading-relaxed font-semibold">
            {!! App::getLocale() === 'en' && !empty($settings['philosophy_text_en']) ? $settings['philosophy_text_en'] : ($settings['philosophy_text'] ?? 'Menghadirkan kebahagiaan sejati dengan tetap menghormati harmoni alam sekitar. Setiap tetes air, senyum staf, dan wahana dirancang dengan kepedulian mendalam.') !!}
          </p>
          <div class="mt-8 grid grid-cols-2 gap-4">
            <div class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center">
              <div class="text-3xl font-black text-aqua-gold mb-1">50K+</div>
              <div class="text-white/50 text-xs font-bold uppercase tracking-wider">
                {{ App::getLocale() === 'en' ? 'Visitors' : 'Pengunjung' }}
              </div>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center">
              <div class="text-3xl font-black text-aqua-gold mb-1">4★</div>
              <div class="text-white/50 text-xs font-bold uppercase tracking-wider">
                {{ App::getLocale() === 'en' ? 'Hotel Grade' : 'Kualitas Hotel' }}
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
          <p class="text-white/30 text-xs font-semibold mt-4 text-right">© Aquaboom Balikpapan — Company Profile Video
          </p>
        </div>
      </div>
    </div>
  </section>

  {{-- ============================================================ --}}
  {{-- DYNAMIC WATER RIDES — Ivory Cream Background --}}
  {{-- ============================================================ --}}
  <section id="rides" class="py-24 bg-aqua-cream">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      <div class="mb-16 text-center">
        <div class="flex items-center justify-center gap-4 mb-4">
          <div class="h-px w-16 bg-aqua-gold"></div>
          <span class="text-aqua-gold text-xs font-black tracking-widest uppercase">World-Class Attractions</span>
          <div class="h-px w-16 bg-aqua-gold"></div>
        </div>
        <h2 class="text-3xl md:text-6xl font-black text-aqua-navy uppercase tracking-tight">
          {{ App::getLocale() === 'en' ? 'DYNAMIC WATER RIDES' : 'WAHANA AIR DINAMIS' }}
        </h2>
        <p class="mt-4 text-slate-500 text-lg font-semibold max-w-2xl mx-auto">
          {{ App::getLocale() === 'en' 
            ? 'Discover world-class slides curated specifically for family adventures and adrenaline junkies alike.' 
            : 'Temukan seluncuran kelas dunia yang dirancang khusus untuk petualangan keluarga dan pemacu adrenalin.' }}
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
              <div
                class="flex items-center text-aqua-azure text-sm font-black uppercase tracking-wider group-hover:text-aqua-gold transition-colors">
                {{ App::getLocale() === 'en' ? 'Learn more' : 'Info Selengkapnya' }} &rarr;
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- ============================================================ --}}
  {{-- NEWSLETTER — Navy Dark Background with Gold Accents --}}
  {{-- ============================================================ --}}
  <section id="newsletter" class="py-24 bg-aqua-navy text-white relative overflow-hidden">
    {{-- Decorative gold ring --}}
    <div class="absolute -top-20 -right-20 w-96 h-96 rounded-full border border-aqua-gold/10"></div>
    <div class="absolute -bottom-20 -left-20 w-80 h-80 rounded-full border border-aqua-gold/10"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
      <div class="flex items-center justify-center gap-4 mb-4">
        <div class="h-px w-12 bg-aqua-gold/60"></div>
        <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">
          {{ App::getLocale() === 'en' ? 'Exclusive Members' : 'Anggota Eksklusif' }}
        </span>
        <div class="h-px w-12 bg-aqua-gold/60"></div>
      </div>
      <h2 class="text-3xl md:text-6xl font-black uppercase mb-8 leading-tight">
        {!! App::getLocale() === 'en' ? 'SIGN UP FOR' : 'DAFTAR UNTUK' !!}<br />
        <span class="gold-shimmer">{!! App::getLocale() === 'en' ? 'SPECIAL PROMOTIONS' : 'PROMO SPESIAL' !!}</span>
      </h2>

      {{-- Newsletter Form --}}
      <form action="#" method="POST" class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-5 max-w-4xl mx-auto text-left">
        <div>
          <label class="block text-xs font-black uppercase tracking-wider text-white/50 mb-2">
            {{ App::getLocale() === 'en' ? 'Your Name' : 'Nama Anda' }}
          </label>
          <input type="text" placeholder="{{ App::getLocale() === 'en' ? 'Full name' : 'Nama lengkap' }}"
            class="w-full bg-white/5 text-white placeholder-white/30 border border-white/10 px-6 py-4 rounded-xl focus:outline-none focus:border-aqua-gold font-medium transition-colors"
            required />
        </div>
        <div>
          <label class="block text-xs font-black uppercase tracking-wider text-white/50 mb-2">
            {{ App::getLocale() === 'en' ? 'Email Address' : 'Alamat Email' }}
          </label>
          <input type="email" placeholder="example@email.com"
            class="w-full bg-white/5 text-white placeholder-white/30 border border-white/10 px-6 py-4 rounded-xl focus:outline-none focus:border-aqua-gold font-medium transition-colors"
            required />
        </div>
        <div class="flex flex-col justify-end">
          <button type="submit"
            class="w-full bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black py-4 rounded-xl transition-all shadow-lg shadow-amber-900/20 uppercase tracking-wider">
            {{ App::getLocale() === 'en' ? 'SUBSCRIBE' : 'LANGGANAN' }}
          </button>
        </div>
      </form>
      <p class="text-white/30 text-xs mt-6 font-semibold">
        {{ App::getLocale() === 'en' ? 'We respect your privacy. Unsubscribe at any time.' : 'Kami menjaga privasi Anda. Batalkan langganan kapan saja.' }}
      </p>
    </div>
  </section>

</x-layout>