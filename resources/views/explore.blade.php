<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Explore Rides & Attractions - Aquaboom Waterpark' : 'Jelajahi Wahana & Atraksi Air - Aquaboom Waterpark' }}</x-slot:title>
  
  <!-- Page Header — Navy Dark Hero -->
  <div class="pt-36 pb-20 bg-aqua-navy relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
      <img src="{{ asset('assets/img/default.jpeg') }}" alt="bg" class="w-full h-full object-cover" />
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-aqua-navy/60 to-aqua-navy"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 text-center">
      <div class="flex items-center justify-center gap-3 mb-4">
        <div class="h-px w-10 bg-aqua-gold"></div>
        <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">Thrill & Chill</span>
        <div class="h-px w-10 bg-aqua-gold"></div>
      </div>
      <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">
        {{ App::getLocale() === 'id' ? 'WAHANA & ATRAKSI' : 'RIDES & ATTRACTIONS' }}
      </h1>
      <p class="text-base md:text-lg text-white/60 max-w-3xl mx-auto font-semibold leading-relaxed">
        {{ App::getLocale() === 'id' ? 'Jelajahi petualangan air kelas dunia. Dari seluncuran ekstrem yang memicu denyut nadi hingga kolam santai untuk melepas penat.' : 'Explore world-class water adventures. From pulse-racing extreme slides to relaxing pools to unwind.' }}
      </p>
    </div>
  </div>

  <!-- Rides Showcase Section -->
  <section class="py-24 bg-aqua-cream">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @foreach($wahanas as $wahana)
        <div class="group bg-white rounded-[32px] overflow-hidden shadow-lg border border-aqua-cream-2 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col">
          <div class="h-64 overflow-hidden relative">
            <img src="{{ $wahana->image_url }}" alt="{{ $wahana->name }}"
                 class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700"
                 onerror="this.onerror=null; this.src='{{ asset('assets/img/default-wahana.svg') }}';" />
            <div class="absolute inset-0 bg-gradient-to-t from-aqua-navy/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="absolute top-4 right-4 bg-aqua-navy text-aqua-gold px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider border border-aqua-gold/30">
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
            <div class="flex items-center text-aqua-azure text-sm font-black uppercase tracking-wider group-hover:text-aqua-gold transition-colors">
              {{ App::getLocale() === 'id' ? 'Lihat Detail' : 'View Details' }} &rarr;
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>



</x-layout>
