<x-layout>
  <x-slot:title>Eat & Drink - Aquaboom Waterpark</x-slot:title>
  
  <div x-data="{ activeMenu: null, activeDiningName: '', isMenuOpen: false }">
    <!-- Page Header -->
    <div class="pt-36 pb-20 bg-aqua-navy relative overflow-hidden">
      <div class="absolute inset-0 opacity-10">
        <img src="https://picsum.photos/1920/600?random=61" alt="bg" class="w-full h-full object-cover" />
      </div>
      <div class="absolute inset-0 bg-gradient-to-b from-aqua-navy/60 to-aqua-navy"></div>
      <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 text-center">
        <div class="flex items-center justify-center gap-3 mb-4">
          <div class="h-px w-10 bg-aqua-gold"></div>
          <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">Gastronomy</span>
          <div class="h-px w-10 bg-aqua-gold"></div>
        </div>
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">
          {{ App::getLocale() === 'id' ? 'MAKANAN & MINUMAN' : 'EAT & DRINK' }}
        </h1>
        <p class="text-base md:text-lg text-white/60 max-w-3xl mx-auto font-semibold leading-relaxed">
          {{ App::getLocale() === 'id' ? 'Manjakan selera setelah bermain air dengan aneka hidangan lezat. Pilihan lokal hingga internasional disajikan dengan standar kebersihan tertinggi.' : 'Indulge your appetite after playing in the water with a variety of delicious dishes. Local to international options served with the highest hygiene standards.' }}
        </p>
      </div>
    </div>

    <!-- Dining Areas -->
    <section class="py-24 bg-aqua-cream">
      <div class="max-w-7xl mx-auto px-6 lg:px-10">
        
        @foreach($dinings as $dining)
        <div class="flex flex-col {{ $loop->even ? 'lg:flex-row-reverse' : 'lg:flex-row' }} gap-12 items-center mb-20 bg-white rounded-[32px] overflow-hidden shadow-xl border border-aqua-cream-2 p-8 lg:p-12 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
          <div class="w-full lg:w-1/2">
            <div class="relative h-[400px] rounded-[24px] overflow-hidden ring-1 ring-aqua-gold/20">
              <img src="{{ $dining->image_url }}" alt="{{ $dining->name }}" onerror="this.onerror=null; this.src='{{ asset('assets/img/default-facility.svg') }}';" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700" />
            </div>
          </div>
          <div class="w-full lg:w-1/2 {{ $loop->even ? 'lg:pr-10' : 'lg:pl-10' }}">
            <div class="flex items-center gap-3 mb-4">
              <div class="h-px w-8 bg-aqua-gold"></div>
              <span class="text-aqua-gold text-xs font-black uppercase tracking-[0.2em]">{{ $loop->even ? (App::getLocale() === 'id' ? 'Akses Terintegrasi' : 'Integrated Access') : (App::getLocale() === 'id' ? 'Kuliner Tepi Kolam' : 'Poolside Dining') }}</span>
            </div>
            <h2 class="text-4xl lg:text-5xl font-black text-aqua-navy mb-6 uppercase leading-tight">
              {{ App::getLocale() === 'en' && $dining->name_en ? $dining->name_en : $dining->name }}
            </h2>
            <p class="text-slate-600 text-base font-semibold leading-relaxed mb-6">
              {{ App::getLocale() === 'en' && $dining->description_en ? $dining->description_en : $dining->description }}
            </p>
            
            @php
              $featuresList = (App::getLocale() === 'en' && $dining->features_en) ? $dining->features_en : $dining->features;
            @endphp

            @if($featuresList && is_array($featuresList))
              @if($loop->even)
                <div class="bg-aqua-navy rounded-2xl p-5 inline-flex items-center gap-4">
                  <svg class="w-6 h-6 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                  <span class="text-white/80 text-sm font-semibold">{{ $featuresList[0] ?? '' }}</span>
                </div>
              @else
                <ul class="space-y-2 text-sm text-slate-600 font-semibold mb-8">
                  @foreach($featuresList as $feature)
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>{{ $feature }}</li>
                  @endforeach
                </ul>
              @endif
            @endif

            @if(!empty($dining->menu_items) && is_array($dining->menu_items))
              @php
                $isNewFormat = !empty($dining->menu_items) && is_string($dining->menu_items[0]);
              @endphp

              @if($isNewFormat)
                <div class="mt-8 w-full">
                  <span class="text-xs font-black text-aqua-gold uppercase tracking-wider block mb-4">
                    {{ App::getLocale() === 'id' ? 'Buku Menu & Daftar Harga' : 'Menu Book & Pricing' }}
                  </span>
                  <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($dining->menu_items as $menuImage)
                      @php
                        $imageUrl = Str::startsWith($menuImage, ['http://', 'https://']) ? $menuImage : asset('uploads/' . $menuImage);
                      @endphp
                      <div 
                        @click="activeMenu = '{{ $imageUrl }}'; activeDiningName = '{{ App::getLocale() === 'en' && $dining->name_en ? $dining->name_en : $dining->name }}'; isMenuOpen = true" 
                        class="group relative aspect-[3/4] rounded-2xl overflow-hidden cursor-pointer shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 ring-1 ring-slate-100 bg-slate-100"
                      >
                        <img src="{{ $imageUrl }}" alt="Menu" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500" />
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @else
                <button 
                  @click="activeMenu = {{ json_encode($dining->menu_items) }}; activeDiningName = '{{ App::getLocale() === 'en' && $dining->name_en ? $dining->name_en : $dining->name }}'; isMenuOpen = true"
                  class="inline-block bg-aqua-azure hover:bg-aqua-azure-2 text-white font-black px-10 py-4 rounded-xl uppercase tracking-wider text-sm transition-all shadow-md mt-4"
                >
                  {{ App::getLocale() === 'id' ? 'Lihat Detail Menu' : 'View Menu Details' }}
                </button>
              @endif
            @endif
          </div>
        </div>
        @endforeach

      </div>
    </section>

    <!-- Alpine Modal for Dining Menu / Image Lightbox -->
    <div 
      x-show="isMenuOpen" 
      class="fixed inset-0 z-[150] flex items-center justify-center p-4"
      style="display: none;"
    >
      <!-- Backdrop -->
      <div 
        x-show="isMenuOpen"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="isMenuOpen = false" 
        class="absolute inset-0 bg-aqua-navy/90 backdrop-blur-md"
      ></div>

      <!-- Lightbox Content (If activeMenu is a string image URL) -->
      <template x-if="activeMenu && typeof activeMenu === 'string'">
        <div 
          x-show="isMenuOpen"
          x-transition:enter="ease-out duration-300 transform"
          x-transition:enter-start="opacity-0 scale-95"
          x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="ease-in duration-200 transform"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-95"
          class="relative max-w-4xl max-h-[90vh] overflow-hidden z-10 flex flex-col items-center"
        >
          <img :src="activeMenu" class="max-w-full max-h-[85vh] object-contain rounded-2xl shadow-2xl ring-1 ring-white/10" />
          <button 
            @click="isMenuOpen = false"
            class="absolute top-4 right-4 text-white hover:text-aqua-gold transition-colors bg-black/60 hover:bg-black/80 p-3 rounded-full border border-white/10 shadow-lg"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </template>

      <!-- Old Style Modal Content (If activeMenu is an array of objects) -->
      <template x-if="activeMenu && typeof activeMenu === 'object'">
        <div 
          x-show="isMenuOpen"
          x-transition:enter="ease-out duration-300 transform"
          x-transition:enter-start="opacity-0 scale-95 translate-y-4"
          x-transition:enter-end="opacity-100 scale-100 translate-y-0"
          x-transition:leave="ease-in duration-200 transform"
          x-transition:leave-start="opacity-100 scale-100 translate-y-0"
          x-transition:leave-end="opacity-0 scale-95 translate-y-4"
          class="bg-white rounded-[32px] w-full max-w-3xl max-h-[85vh] overflow-hidden shadow-2xl relative z-10 flex flex-col border border-slate-100"
        >
          <!-- Header -->
          <div class="p-6 md:p-8 border-b border-slate-100 flex justify-between items-center bg-aqua-navy text-white shrink-0">
            <div>
              <span class="text-aqua-gold text-[10px] font-black uppercase tracking-widest block mb-1">
                {{ App::getLocale() === 'en' ? 'CULINARY MENU' : 'DAFTAR MENU KULINER' }}
              </span>
              <h3 class="text-2xl md:text-3xl font-black uppercase tracking-tight text-white" x-text="activeDiningName"></h3>
            </div>
            <button 
              @click="isMenuOpen = false"
              class="text-white/80 hover:text-aqua-gold transition-colors bg-white/10 hover:bg-white/20 p-3 rounded-full border border-white/10"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- Menu Items List -->
          <div class="flex-1 overflow-y-auto p-6 md:p-8 bg-aqua-cream/50 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <template x-for="(item, idx) in activeMenu" :key="idx">
                <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex gap-4 hover:shadow-md transition-shadow duration-200">
                  <div class="w-20 h-20 rounded-xl overflow-hidden bg-aqua-cream flex-shrink-0 border border-slate-100">
                    <template x-if="item.image_url">
                      <img :src="'/uploads/' + item.image_url" class="w-full h-full object-cover" />
                    </template>
                  </div>
                  <div class="flex-1 flex flex-col justify-between">
                    <div>
                      <h4 class="font-black text-base text-aqua-navy" x-text="('{{ App::getLocale() }}' === 'en' && item.name_en) ? item.name_en : item.name"></h4>
                      <p class="text-xs text-slate-400 font-semibold leading-relaxed mt-1" x-text="('{{ App::getLocale() }}' === 'en' && item.description_en) ? item.description_en : item.description"></p>
                    </div>
                    <div class="text-aqua-gold font-black text-sm mt-3">
                      Rp <span x-text="new Intl.NumberFormat('id-ID').format(item.price)"></span>
                    </div>
                  </div>
                </div>
              </template>
            </div>
          </div>
        </div>
      </template>
    </div>
  </div>

</x-layout>
