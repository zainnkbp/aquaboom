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
        <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">{{ App::getLocale() === 'en' ? 'Thrill & Chill' : 'Keseruan & Relaksasi' }}</span>
        <div class="h-px w-10 bg-aqua-gold"></div>
      </div>
      <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">
        {{ App::getLocale() === 'id' ? 'WAHANA & ATRAKSI' : 'RIDES & ATTRACTIONS' }}
      </h1>
      <p class="text-base md:text-lg text-white/60 max-w-3xl mx-auto font-semibold leading-relaxed">
        {{ App::getLocale() === 'id' ? 'Jelajahi petualangan air kelas dunia. Dari seluncuran seru yang memicu denyut nadi hingga kolam santai untuk melepas penat di 7F - Shared Common Area Balikpapan Superblock.' : 'Explore world-class water adventures. From exciting slides to relaxing pools on 7F - Shared Common Area Balikpapan Superblock.' }}
      </p>
    </div>
  </div>

  <!-- Rides Showcase Section with Interactive Modal -->
  <section 
    x-data="{
      isModalOpen: false,
      activeWahana: null,
      openDetail(wahana) {
        this.activeWahana = wahana;
        this.isModalOpen = true;
      },
      closeDetail() {
        this.isModalOpen = false;
      }
    }"
    @keydown.escape.window="closeDetail()"
    class="py-24 bg-aqua-cream relative"
  >
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @foreach($wahanas as $wahana)
        @php
          $wData = [
            'name' => App::getLocale() === 'en' && $wahana->name_en ? $wahana->name_en : $wahana->name,
            'description' => App::getLocale() === 'en' && $wahana->description_en ? $wahana->description_en : $wahana->description,
            'image_url' => $wahana->image_url,
            'thrill_level' => $wahana->thrill_level ?? 'Ride',
          ];
        @endphp
        <div 
          @click="openDetail(@js($wData))"
          class="group bg-white rounded-[32px] overflow-hidden shadow-lg border border-aqua-cream-2 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col cursor-pointer"
        >
          <div class="h-64 overflow-hidden relative">
            <img src="{{ $wahana->image_url }}" alt="{{ $wahana->name }}"
                 class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700"
                 onerror="this.onerror=null; this.src='{{ asset('assets/img/default-wahana.svg') }}';" />
            <div class="absolute inset-0 bg-gradient-to-t from-aqua-navy/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="absolute top-4 right-4 bg-aqua-navy text-aqua-gold px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider border border-aqua-gold/30 shadow-md">
              {{ $wahana->thrill_level ?? 'Ride' }}
            </div>
          </div>
          <div class="p-8 flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-2xl font-black text-aqua-navy mb-3 uppercase group-hover:text-aqua-azure transition-colors">
                {{ App::getLocale() === 'en' && $wahana->name_en ? $wahana->name_en : $wahana->name }}
              </h3>
              <p class="text-slate-500 text-sm font-medium leading-relaxed mb-6 line-clamp-3">
                {{ App::getLocale() === 'en' && $wahana->description_en ? $wahana->description_en : $wahana->description }}
              </p>
            </div>
            <div class="flex items-center gap-2 text-aqua-azure group-hover:text-aqua-gold text-sm font-black uppercase tracking-wider transition-colors pt-2 border-t border-slate-100">
              <span>{{ App::getLocale() === 'id' ? 'Lihat Detail' : 'View Details' }}</span>
              <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- Quick View / Detail Modal -->
    <div 
      x-show="isModalOpen" 
      x-cloak
      style="display: none;"
      class="fixed inset-0 z-[160] flex items-center justify-center p-4 sm:p-6"
    >
      <!-- Backdrop -->
      <div 
        x-show="isModalOpen"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="closeDetail()"
        class="fixed inset-0 bg-aqua-navy/80 backdrop-blur-md cursor-pointer"
      ></div>

      <!-- Modal Card -->
      <div 
        x-show="isModalOpen"
        x-transition:enter="ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="relative bg-white rounded-[32px] shadow-2xl border border-aqua-gold/30 max-w-2xl w-full overflow-hidden z-10 flex flex-col max-h-[90vh]"
      >
        <!-- Header Image with Thrill Badge & Close Button -->
        <div class="relative h-64 sm:h-80 w-full overflow-hidden shrink-0 bg-slate-900">
          <template x-if="activeWahana">
            <img :src="activeWahana.image_url" :alt="activeWahana.name" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='{{ asset('assets/img/default-wahana.svg') }}';" />
          </template>
          <div class="absolute inset-0 bg-gradient-to-t from-aqua-navy via-aqua-navy/30 to-transparent"></div>
          
          <!-- Thrill Badge -->
          <div class="absolute top-5 left-5 bg-aqua-navy/90 backdrop-blur-md text-aqua-gold px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider border border-aqua-gold/40 shadow-lg">
            <span x-text="activeWahana ? activeWahana.thrill_level : 'Ride'"></span>
          </div>

          <!-- Close Button -->
          <button 
            type="button" 
            @click="closeDetail()"
            class="absolute top-5 right-5 w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 text-white flex items-center justify-center backdrop-blur-md transition-all shadow-md active:scale-95 cursor-pointer"
            aria-label="Close modal"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>

          <!-- Bottom Title Overlay -->
          <div class="absolute bottom-5 left-6 right-6 text-white">
            <span class="text-aqua-gold text-[10px] font-black uppercase tracking-[0.25em] block mb-1">
              {{ App::getLocale() === 'en' ? 'Aquaboom Waterpark Attraction' : 'Wahana Aquaboom Waterpark' }}
            </span>
            <h3 class="text-2xl sm:text-3xl font-black uppercase tracking-tight" x-text="activeWahana ? activeWahana.name : ''"></h3>
          </div>
        </div>

        <!-- Body & Specs -->
        <div class="p-6 sm:p-8 overflow-y-auto space-y-6 flex-1">
          <!-- Description -->
          <p class="text-slate-600 text-sm sm:text-base font-medium leading-relaxed" x-text="activeWahana ? activeWahana.description : ''"></p>

          <!-- Specs Badges Grid -->
          <div class="grid grid-cols-2 gap-3 pt-2">
            <div class="bg-aqua-cream p-4 rounded-2xl border border-aqua-gold/15 flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-aqua-gold/20 text-aqua-gold flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              </div>
              <div>
                <div class="text-[10px] font-black text-slate-400 uppercase tracking-wider">{{ App::getLocale() === 'en' ? 'Location' : 'Lokasi' }}</div>
                <div class="text-xs font-black text-aqua-navy">7F Shared Common Area</div>
              </div>
            </div>

            <div class="bg-aqua-cream p-4 rounded-2xl border border-aqua-gold/15 flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-aqua-gold/20 text-aqua-gold flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
              </div>
              <div>
                <div class="text-[10px] font-black text-slate-400 uppercase tracking-wider">{{ App::getLocale() === 'en' ? 'Safety' : 'Keamanan' }}</div>
                <div class="text-xs font-black text-aqua-navy">{{ App::getLocale() === 'en' ? 'Lifeguard on Duty' : 'Lifeguard Siaga' }}</div>
              </div>
            </div>
          </div>

          <!-- Safety Tips Note -->
          <div class="bg-amber-50 border border-amber-200/80 rounded-2xl p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="text-xs font-semibold text-amber-900 leading-relaxed">
              {{ App::getLocale() === 'en' 
                  ? 'Please wear proper swimwear. Children must be supervised by adults at all times.' 
                  : 'Wajib mengenakan pakaian renang yang pantas. Anak-anak wajib selalu dalam pengawasan orang dewasa.' }}
            </div>
          </div>
        </div>

        <!-- Footer Actions -->
        <div class="p-6 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 shrink-0">
          <div class="text-xs font-bold text-slate-500">
            {{ App::getLocale() === 'en' ? 'Includes full waterpark admission' : 'Termasuk tiket terusan wahana air' }}
          </div>
          <div class="flex items-center gap-3 w-full sm:w-auto">
            <button 
              type="button" 
              @click="closeDetail()" 
              class="w-full sm:w-auto px-5 py-3.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 font-bold text-xs uppercase tracking-wider transition-colors cursor-pointer"
            >
              {{ App::getLocale() === 'en' ? 'Close' : 'Tutup' }}
            </button>
            <a 
              href="{{ route('ticket.buy') }}#packages" 
              class="w-full sm:w-auto text-center bg-aqua-navy hover:bg-aqua-navy-2 text-aqua-gold hover:text-white font-black text-xs uppercase tracking-wider px-6 py-3.5 rounded-xl transition-all shadow-md border border-aqua-gold/30 hover:border-aqua-gold cursor-pointer whitespace-nowrap"
            >
              {{ App::getLocale() === 'en' ? 'Book Tickets Now →' : 'Pesan Tiket Sekarang →' }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

</x-layout>
