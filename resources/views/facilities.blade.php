<x-layout>
  <x-slot:title>Premium Facilities - Aquaboom Waterpark</x-slot:title>
  
  <!-- Page Header -->
  <div class="pt-36 pb-20 bg-aqua-navy relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
      <img src="{{ asset('assets/img/default.jpeg') }}" alt="bg" class="w-full h-full object-cover" />
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-aqua-navy/60 to-aqua-navy"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 text-center">
      <div class="flex items-center justify-center gap-3 mb-4">
        <div class="h-px w-10 bg-aqua-gold"></div>
        <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">Comfort & Convenience</span>
        <div class="h-px w-10 bg-aqua-gold"></div>
      </div>
      <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">
        {{ App::getLocale() === 'id' ? 'FASILITAS PREMIUM' : 'PREMIUM FACILITIES' }}
      </h1>
      <p class="text-base md:text-lg text-white/60 max-w-3xl mx-auto font-semibold leading-relaxed">
        {{ App::getLocale() === 'id' ? 'Kenyamanan paripurna untuk pengalaman rekreasi tanpa batas. Kami menyediakan segala kebutuhan dasar dan premium Anda selama berada di area Aquaboom.' : 'Ultimate comfort for an boundless recreation experience. We provide all your basic and premium needs during your time at Aquaboom.' }}
      </p>
    </div>
  </div>

  <!-- Facilities Wrapper -->
  <div class="bg-aqua-cream flex flex-col gap-28" style="padding-top: 7rem; padding-bottom: 5rem;">

    @foreach($facilities as $facility)
      <section class="max-w-7xl mx-auto px-6 lg:px-10 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          {{-- Text content - odd is left (order 1), even is right (order 2 on desktop) --}}
          <div class="lg:col-span-5 {{ $loop->even ? 'lg:order-2' : 'lg:order-1' }}">
            <div class="flex items-center gap-3 mb-4">
              <div class="h-px w-10 bg-aqua-gold"></div>
              <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">
                {{ $facility->type === 'gazebo' ? 'VIP Experience' : 'Premium Facility' }}
              </span>
            </div>
            <h2 class="text-4xl lg:text-5xl font-black text-aqua-navy uppercase mb-6 leading-tight">
              {{ App::getLocale() === 'en' && $facility->name_en ? $facility->name_en : $facility->name }}
            </h2>
            <p class="text-slate-600 text-base leading-relaxed font-semibold mb-6">
              {{ App::getLocale() === 'en' && $facility->description_en ? $facility->description_en : $facility->description }}
            </p>

            @php
              $featuresList = (App::getLocale() === 'en' && $facility->features_en) ? $facility->features_en : $facility->features;
            @endphp

            @if($featuresList && is_array($featuresList))
              <ul class="space-y-2 text-sm text-slate-600 font-semibold mb-8">
                @foreach($featuresList as $feature)
                  <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ $feature }}
                  </li>
                @endforeach
              </ul>
            @endif

            @if($facility->type === 'gazebo')
              <a href="{{ url('/ticket') }}" class="inline-block bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-8 py-4 rounded-xl shadow-lg shadow-amber-900/20 uppercase tracking-wider text-sm transition-all">
                {{ App::getLocale() === 'id' ? 'Pesan Gazebo' : 'Book a Gazebo' }}
              </a>
            @endif
          </div>

          {{-- Image block - odd is right (order 2), even is left (order 1 on desktop) --}}
          <div class="lg:col-span-7 {{ $loop->even ? 'lg:order-1' : 'lg:order-2' }}">
            <div class="rounded-3xl overflow-hidden shadow-2xl h-[350px] lg:h-[450px] ring-1 ring-aqua-gold/20">
              <img src="{{ $facility->image_url }}" 
                   alt="{{ $facility->name }}" 
                   onerror="this.onerror=null; this.src='{{ asset('assets/img/default-facility.svg') }}';"
                   class="w-full h-full object-cover hover:scale-102 transition-transform duration-700" />
            </div>
          </div>

        </div>
      </section>
    @endforeach

  </div>

</x-layout>
