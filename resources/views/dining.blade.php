<x-layout>
  <x-slot:title>Eat & Drink - Aquaboom Waterpark</x-slot:title>
  
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
            <img src="{{ $dining->image_url }}" alt="{{ $dining->name }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700" />
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
              <a href="#" class="inline-block bg-aqua-azure hover:bg-aqua-azure-2 text-white font-black px-10 py-4 rounded-xl uppercase tracking-wider text-sm transition-all shadow-md">
                {{ App::getLocale() === 'id' ? 'Lihat Detail Menu' : 'View Menu Details' }}
              </a>
            @endif
          @endif
        </div>
      </div>
      @endforeach

    </div>
  </section>

</x-layout>
