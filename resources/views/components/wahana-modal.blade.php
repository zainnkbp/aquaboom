<div 
  x-data="{
    isModalOpen: false,
    activeWahana: null,
    openModal(data) {
      this.activeWahana = data;
      this.isModalOpen = true;
      document.body.classList.add('overflow-hidden');
    },
    closeModal() {
      this.isModalOpen = false;
      document.body.classList.remove('overflow-hidden');
    }
  }"
  @open-wahana-modal.window="openModal($event.detail)"
  @keydown.escape.window="closeModal()"
>
  <!-- Global Wahana Detail Modal Overlay -->
  <div 
    x-show="isModalOpen" 
    x-cloak
    style="display: none; z-index: 999999 !important;"
    class="fixed inset-0 overflow-y-auto"
  >
    <!-- Dark Backdrop with Blur -->
    <div 
      x-show="isModalOpen"
      x-transition:enter="ease-out duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="ease-in duration-200"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      @click="closeModal()"
      class="fixed inset-0 bg-aqua-navy/85 backdrop-blur-md cursor-pointer"
      style="z-index: 1;"
    ></div>

    <!-- Centering flex container with top/bottom padding to prevent clipping -->
    <div class="flex min-h-full items-center justify-center p-4 sm:p-6 text-center" style="position: relative; z-index: 2;">
      <!-- Modal Card -->
      <div 
        x-show="isModalOpen"
        x-transition:enter="ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        @click.stop
        class="relative bg-white rounded-[28px] sm:rounded-[32px] shadow-2xl border border-aqua-gold/40 max-w-2xl w-full overflow-hidden text-left my-8 flex flex-col"
      >
        <!-- Header Image with Floating Badges & Close Button -->
        <div class="relative h-60 sm:h-72 w-full overflow-hidden bg-slate-900 shrink-0">
          <template x-if="activeWahana && activeWahana.image_url">
            <img :src="activeWahana.image_url" :alt="activeWahana ? activeWahana.name : ''" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='{{ asset('assets/img/default-wahana.svg') }}';" />
          </template>
          <div class="absolute inset-0 bg-gradient-to-t from-aqua-navy/70 via-transparent to-black/30"></div>
          
          <!-- Thrill Level Badge -->
          <div class="absolute top-4 sm:top-5 left-4 sm:left-5 bg-aqua-navy/90 backdrop-blur-md text-aqua-gold px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider border border-aqua-gold/40 shadow-lg z-20">
            <span x-text="activeWahana ? activeWahana.thrill_level : 'Ride'"></span>
          </div>

          <!-- Prominent Close Button (X) -->
          <button 
            type="button" 
            @click="closeModal()"
            class="absolute top-4 sm:top-5 right-4 sm:right-5 w-10 h-10 rounded-full bg-black/60 hover:bg-black/80 text-white flex items-center justify-center backdrop-blur-md transition-all shadow-xl active:scale-95 cursor-pointer z-20 border border-white/25"
            aria-label="Tutup modal"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>

        <!-- Body Content -->
        <div class="p-6 sm:p-8 space-y-6">
          <!-- Ride Title & Eyebrow -->
          <div>
            <div class="flex items-center gap-2 mb-1.5">
              <span class="inline-block w-2 h-2 rounded-full bg-aqua-gold"></span>
              <span class="text-aqua-gold text-[11px] font-black uppercase tracking-widest">
                {{ App::getLocale() === 'en' ? 'Aquaboom Waterpark Attraction' : 'Wahana Air Aquaboom Waterpark' }}
              </span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-black text-aqua-navy uppercase tracking-tight" x-text="activeWahana ? activeWahana.name : ''"></h3>
          </div>

          <!-- Description -->
          <p class="text-slate-600 text-sm sm:text-base font-medium leading-relaxed" x-text="activeWahana ? activeWahana.description : ''"></p>

          <!-- Specs Badges Grid -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
            <div class="bg-aqua-cream p-4 rounded-2xl border border-aqua-gold/20 flex items-center gap-3.5">
              <div class="w-10 h-10 rounded-xl bg-aqua-gold/20 text-aqua-gold flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              </div>
              <div>
                <div class="text-[10px] font-black text-slate-400 uppercase tracking-wider">{{ App::getLocale() === 'en' ? 'Location' : 'Lokasi' }}</div>
                <div class="text-xs font-black text-aqua-navy">7F Shared Common Area</div>
              </div>
            </div>

            <div class="bg-aqua-cream p-4 rounded-2xl border border-aqua-gold/20 flex items-center gap-3.5">
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
          <div class="bg-amber-50 border border-amber-200/90 rounded-2xl p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="text-xs font-semibold text-amber-900 leading-relaxed">
              {{ App::getLocale() === 'en' 
                  ? 'Please wear proper swimwear. Children must be supervised by adults at all times.' 
                  : 'Wajib mengenakan pakaian renang yang pantas. Anak-anak wajib selalu dalam pengawasan orang dewasa.' }}
            </div>
          </div>
        </div>

        <!-- Footer Actions -->
        <div class="p-6 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 shrink-0 rounded-b-[28px] sm:rounded-b-[32px]">
          <div class="text-xs font-bold text-slate-500">
            {{ App::getLocale() === 'en' ? 'Includes full waterpark admission' : 'Termasuk tiket terusan wahana air' }}
          </div>
          <div class="flex items-center gap-3 w-full sm:w-auto">
            <button 
              type="button" 
              @click="closeModal()" 
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
  </div>
</div>
