<form wire:submit.prevent="openConfirmationModal" 
      x-data="{ 
          activeTermsModal: null, 
          activeTermsName: '', 
          activeTermsDesc: '', 
          activeTermsHtml: '', 
          activeTermsBenefits: [],
          openPassInfo(id, name, benefits, desc, tnc) {
              this.activeTermsModal = id;
              this.activeTermsName = name;
              this.activeTermsBenefits = Array.isArray(benefits) ? benefits : [];
              this.activeTermsDesc = desc || '';
              this.activeTermsHtml = tnc || '';
          }
      }" 
      class="flex flex-col h-full bg-white font-sans relative">
    
    <!-- Top Bar -->
    <div class="px-4 md:px-10 py-4 bg-aqua-navy text-white flex justify-between items-center border-b border-aqua-gold/20">
        <span class="text-sm font-black tracking-widest uppercase">
            {{ $locale === 'id' ? 'FORMULIR PEMESANAN TIKET' : 'TICKET BOOKING FORM' }}
        </span>
    </div>

    <!-- Step 1: Visit Date -->
    <div id="step-1-date" class="px-3 md:px-10 py-3.5 md:py-8 bg-aqua-cream border-b border-slate-100 scroll-mt-20 md:scroll-mt-24">
        <div class="max-w-5xl mx-auto">
            <div class="flex items-center gap-2 md:gap-3 mb-2.5 md:mb-6">
                <div class="h-px w-6 md:w-8 bg-aqua-gold"></div>
                <span class="text-aqua-gold text-[10px] md:text-xs font-black uppercase tracking-[0.2em]">Step 1</span>
                <span class="text-aqua-navy text-xs md:text-sm font-black uppercase tracking-wide">
                    {{ $locale === 'id' ? 'PILIH TANGGAL KUNJUNGAN' : 'SELECT VISIT DATE' }}
                </span>
            </div>
            
            <div class="flex items-center gap-2 md:gap-4 overflow-x-auto pb-1 md:pb-2 snap-x scrollbar-hide">
                <button type="button" 
                     wire:click="$set('visit_date', '{{ date('Y-m-d') }}')" 
                     @click="setTimeout(() => { document.getElementById('step-2-tickets')?.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 150)"
                     class="py-2 px-4 md:py-3.5 md:px-8 rounded-full md:rounded-2xl cursor-pointer transition-all duration-300 whitespace-nowrap snap-start shrink-0 text-xs md:text-sm font-bold border md:border-2
                     {{ $visit_date === date('Y-m-d') ? 'border-aqua-gold bg-aqua-navy text-white shadow-sm md:shadow-md' : 'bg-white border-slate-200 text-slate-600 hover:border-aqua-gold/50' }}">
                    {{ $locale === 'id' ? 'Hari Ini' : 'Today' }}
                </button>
                <button type="button" 
                     wire:click="$set('visit_date', '{{ date('Y-m-d', strtotime('+1 day')) }}')" 
                     @click="setTimeout(() => { document.getElementById('step-2-tickets')?.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 150)"
                     class="py-2 px-4 md:py-3.5 md:px-8 rounded-full md:rounded-2xl cursor-pointer transition-all duration-300 whitespace-nowrap snap-start shrink-0 text-xs md:text-sm font-bold border md:border-2
                     {{ $visit_date === date('Y-m-d', strtotime('+1 day')) ? 'border-aqua-gold bg-aqua-navy text-white shadow-sm md:shadow-md' : 'bg-white border-slate-200 text-slate-600 hover:border-aqua-gold/50' }}">
                    {{ $locale === 'id' ? 'Besok' : 'Tomorrow' }}
                </button>
                <div x-data @click="$refs.datePicker.showPicker()" 
                     class="relative py-2 px-4 md:py-3.5 md:px-8 rounded-full md:rounded-2xl cursor-pointer transition-all duration-300 whitespace-nowrap flex items-center gap-1.5 md:gap-2.5 snap-start shrink-0 text-xs md:text-sm font-bold border md:border-2
                     {{ ($visit_date && $visit_date !== date('Y-m-d') && $visit_date !== date('Y-m-d', strtotime('+1 day'))) ? 'border-aqua-gold bg-aqua-navy text-white shadow-sm md:shadow-md' : 'bg-white border-slate-200 text-slate-600 hover:border-aqua-gold/50' }}">
                    <svg class="w-3.5 h-3.5 md:w-4 md:h-4 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>{{ ($visit_date && $visit_date !== date('Y-m-d') && $visit_date !== date('Y-m-d', strtotime('+1 day'))) ? \Carbon\Carbon::parse($visit_date)->format('d M Y') : ($locale === 'id' ? 'Tanggal Lain' : 'Other Date') }}</span>
                    <input x-ref="datePicker" type="date" wire:model.live="visit_date" 
                           @change="setTimeout(() => { document.getElementById('step-2-tickets')?.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 150)"
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+6 months')) }}" />
                </div>
            </div>
            @error('visit_date') <span class="text-red-500 text-xs md:text-sm mt-2 md:mt-3 block font-semibold bg-red-50 p-2.5 md:p-4 rounded-xl md:rounded-2xl border border-red-100">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- Step 2: Choose Tickets (Waterbom Bali Style Wristband Passes) -->
    <div id="step-2-tickets" class="px-3 md:px-10 py-5 md:py-10 max-w-5xl mx-auto w-full scroll-mt-20 md:scroll-mt-24">
        <div class="flex items-center justify-between gap-3 mb-4 md:mb-6">
            <div class="flex items-center gap-2 md:gap-3">
                <div class="h-px w-6 md:w-8 bg-aqua-gold"></div>
                <span class="text-aqua-gold text-[10px] md:text-xs font-black uppercase tracking-[0.2em]">Step 2</span>
                <span class="text-aqua-navy text-xs md:text-sm font-black uppercase tracking-wide">
                    {{ $locale === 'id' ? 'PILIH GELANG MASUK (PASS TIKET)' : 'SELECT WRISTBAND PASS' }}
                </span>
            </div>
            <span class="hidden sm:inline-flex items-center gap-1.5 text-[11px] font-bold text-slate-500 bg-slate-100 px-3 py-1 rounded-full">
                <svg class="w-3.5 h-3.5 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ $locale === 'id' ? 'Gelang waterproof ditukar di loket tiket' : 'Wristbands collected at admission counter' }}
            </span>
        </div>

        {{-- Peak Season / Holiday Notification Banner --}}
        @if($holidayInfo)
            @if(!empty($holidayInfo['is_peak_season']))
                <!-- Peak Season Liburan Sekolah / Nataru Alert -->
                <div class="mb-5 md:mb-6 rounded-2xl md:rounded-3xl p-4 md:p-5 bg-gradient-to-r from-amber-500 via-orange-500 to-rose-600 text-white shadow-lg relative overflow-hidden flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 border border-amber-300/30">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-2xl shrink-0 shadow-inner">
                            ⭐
                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-[10px] md:text-xs font-black uppercase tracking-wider bg-white/25 px-2.5 py-0.5 rounded-full shadow-sm">Periode Peak Season</span>
                                <h4 class="font-extrabold text-sm md:text-base leading-tight">{{ $holidayInfo['name'] }}</h4>
                            </div>
                            <p class="text-xs md:text-sm text-white/95 mt-1 font-medium">{{ $holidayInfo['note'] }}</p>
                        </div>
                    </div>
                    <div class="shrink-0 self-end sm:self-center">
                        <span class="inline-flex items-center gap-1.5 text-[11px] md:text-xs font-black uppercase tracking-wider bg-white text-orange-600 px-3.5 py-1.5 rounded-full shadow-md">
                            <span class="w-2 h-2 rounded-full bg-orange-500 animate-ping"></span>
                            Tarif Liburan & Peak Season
                        </span>
                    </div>
                </div>
            @elseif($holidayInfo['type'] === 'national_holiday' || $holidayInfo['type'] === 'joint_leave')
                <!-- National Holiday Alert -->
                <div class="mb-5 md:mb-6 rounded-2xl md:rounded-3xl p-4 md:p-5 bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-lg relative overflow-hidden flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 border border-red-300/30">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-2xl shrink-0 shadow-inner">
                            🔴
                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-[10px] md:text-xs font-black uppercase tracking-wider bg-white/25 px-2.5 py-0.5 rounded-full shadow-sm">Hari Libur Nasional</span>
                                <h4 class="font-extrabold text-sm md:text-base leading-tight">{{ $holidayInfo['name'] }}</h4>
                            </div>
                            <p class="text-xs md:text-sm text-white/95 mt-1 font-medium">{{ $holidayInfo['note'] }}</p>
                        </div>
                    </div>
                    <div class="shrink-0 self-end sm:self-center">
                        <span class="inline-flex items-center gap-1.5 text-[11px] md:text-xs font-black uppercase tracking-wider bg-white text-rose-700 px-3.5 py-1.5 rounded-full shadow-md">
                            Tarif Libur Berlaku
                        </span>
                    </div>
                </div>
            @endif
        @endif

        @if($packages->isEmpty())
            <div class="bg-white rounded-2xl md:rounded-3xl p-8 md:p-16 text-center shadow-xl border border-slate-100">
                <p class="text-base md:text-lg font-bold text-aqua-navy">
                    {{ $locale === 'id' ? 'Maaf, tidak ada tiket yang tersedia untuk tanggal ini.' : 'Sorry, no tickets are available for this date.' }}
                </p>
            </div>
        @else
            <!-- Waterbom Bali Style Hybrid Wristband Passes -->
            <div class="flex flex-col gap-4 md:gap-5">
                @foreach($packages as $pkg)
                    @php
                        $isWeekend = Str::contains(strtolower($pkg->name), 'weekend');
                        $isGroup = Str::contains(strtolower($pkg->name), 'group') || Str::contains(strtolower($pkg->name), 'rombongan');
                        $isDuo = Str::contains(strtolower($pkg->name), 'duo');
                        $isFour = Str::contains(strtolower($pkg->name), 'four');
                        $isPeak = $pkg->validity_type === 'peak_season' || (!empty($holidayInfo['is_peak_season']));
                        
                        $qty = $quantities[$pkg->id] ?? 0;
                        
                        // Dynamic pricing label
                        $pricingLabel = $locale === 'id' ? 'per orang' : 'per person';
                        if ($isDuo) {
                            $pricingLabel = $locale === 'id' ? 'per 2 orang' : 'per 2 people';
                        } elseif ($isFour) {
                            $pricingLabel = $locale === 'id' ? 'per 4 orang' : 'per 4 people';
                        } elseif ($isGroup) {
                            $pricingLabel = $locale === 'id' ? 'per orang (min. 10)' : 'per person (min. 10)';
                        }

                        // Color theme per ticket type (Waterbom Orange, Azure Blue, Rose, Emerald)
                        $baseGradient = 'from-amber-600 via-orange-600 to-orange-700'; // Default Warm Orange
                        
                        if ($pkg->validity_type === 'weekday') {
                            $baseGradient = 'from-sky-700 via-blue-800 to-indigo-900';
                        } elseif ($isPeak) {
                            $baseGradient = 'from-rose-600 via-red-600 to-amber-700';
                        } elseif ($isDuo) {
                            $baseGradient = 'from-pink-600 via-rose-600 to-purple-800';
                        } elseif ($isFour) {
                            $baseGradient = 'from-emerald-700 via-teal-800 to-cyan-900';
                        }
                    @endphp

                    <!-- Waterbom Bali Inspired Wristband Ribbon Pass -->
                    <div class="relative rounded-2xl md:rounded-3xl border-2 transition-all duration-300 overflow-hidden shadow-md hover:shadow-xl group
                         {{ $qty > 0 ? 'border-aqua-gold ring-4 ring-aqua-gold/40 shadow-2xl scale-[1.008]' : 'border-slate-300/80 hover:border-aqua-gold/70' }}"
                         style="min-height: 115px;">
                        
                        <!-- Background: 
                             1. Full Banner Image (jika diupload admin seperti tikett.png)
                             2. Normal Image with Dark Scrim Overlay
                             3. Themed Gradient with Dark Overlay (jika tidak ada gambar)
                        -->
                        @if($pkg->banner_image_url)
                            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-[1.02]" 
                                 style="background-image: url('{{ $pkg->banner_image_url }}');"></div>
                            <!-- Soft scrim so text, info icon, price, and gold button are ultra-readable -->
                            <div class="absolute inset-0 bg-gradient-to-r from-black/45 via-black/15 to-black/40"></div>
                        @elseif($pkg->image_url && !str_contains($pkg->image_url, 'default'))
                            <div class="absolute inset-0 bg-cover bg-right md:bg-center transition-transform duration-700 group-hover:scale-105" 
                                 style="background-image: url('{{ $pkg->image_url }}');"></div>
                            <!-- Contrast Scrim: Solid black overlay on left, fading to photo on right -->
                            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/85 md:via-slate-950/75 to-slate-900/35"></div>
                        @else
                            <div class="absolute inset-0 bg-gradient-to-r {{ $baseGradient }}"></div>
                            <div class="absolute inset-0 bg-black/40"></div>
                        @endif

                        <!-- Wristband Perforation / Clip Notch on Left Side -->
                        <div class="absolute top-0 left-0 bottom-0 w-3 bg-aqua-gold flex flex-col justify-around items-center py-2">
                            <span class="w-1 h-2 bg-black/30 rounded-full"></span>
                            <span class="w-1 h-2 bg-black/30 rounded-full"></span>
                            <span class="w-1 h-2 bg-black/30 rounded-full"></span>
                        </div>

                        <!-- Inner Content Layout -->
                        <div class="relative z-10 pl-5 md:pl-7 pr-3.5 md:pr-6 py-4 md:py-4.5 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3.5 md:gap-5">
                            
                            <!-- Left: Header, Subtitle, & Info Button -->
                            <div class="flex-1 min-w-0 pr-0 md:pr-4">
                                
                                <!-- Category Tag & Promo Badges -->
                                <div class="flex items-center gap-1.5 md:gap-2 flex-wrap mb-1">
                                    <span class="text-[9px] md:text-[10px] font-black uppercase px-2 py-0.5 rounded-md tracking-wider bg-black/45 text-white backdrop-blur-xs border border-white/25 shadow-xs">
                                        {{ $pkg->validity_type === 'weekday' ? 'Weekday Pass' : ($pkg->validity_type === 'weekend' ? 'Weekend Pass' : ($pkg->validity_type === 'peak_season' ? 'Peak Season Pass' : 'All-Day Pass')) }}
                                    </span>
                                    @if($isWeekend && !$isPeak)
                                        <span class="text-[9px] md:text-[10px] font-black uppercase px-2 py-0.5 rounded-md bg-aqua-gold text-aqua-navy tracking-wider shadow-xs">
                                            Populer
                                        </span>
                                    @elseif($isPeak)
                                        <span class="text-[9px] md:text-[10px] font-black uppercase px-2 py-0.5 rounded-md bg-rose-500 text-white tracking-wider shadow-xs">
                                            Musim Liburan
                                        </span>
                                    @endif
                                </div>

                                <!-- Big Bold Title (Waterbom Style) -->
                                <h3 class="text-base sm:text-lg md:text-xl font-black text-white tracking-tight uppercase leading-snug drop-shadow-md">
                                    {{ $locale === 'en' && $pkg->name_en ? $pkg->name_en : $pkg->name }}
                                </h3>

                                <!-- Subtitle / Benefit Description (Checklist Pills / Clean Text) -->
                                @php
                                    $pkgBenefits = $pkg->getBenefitsList($locale);
                                @endphp
                                @if(count($pkgBenefits) > 1)
                                    <div class="flex flex-wrap items-center gap-1.5 mt-1 max-w-xl">
                                        @foreach(array_slice($pkgBenefits, 0, 3) as $bItem)
                                            <span class="inline-flex items-center gap-1 text-[10px] md:text-[11px] font-bold text-white bg-black/45 backdrop-blur-xs px-2 py-0.5 rounded-md border border-white/20 drop-shadow-xs">
                                                <svg class="w-3 h-3 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                <span>{{ $bItem }}</span>
                                            </span>
                                        @endforeach
                                        @if(count($pkgBenefits) > 3)
                                            <span class="text-[10px] text-white/85 font-bold drop-shadow-xs bg-black/35 px-1.5 py-0.5 rounded border border-white/10">
                                                +{{ count($pkgBenefits) - 3 }} {{ $locale === 'en' ? 'more' : 'lainnya' }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <p class="text-white/90 text-[11px] md:text-xs font-semibold leading-relaxed line-clamp-2 mt-0.5 max-w-xl drop-shadow-sm">
                                        {{ $locale === 'en' ? $pkg->clean_description_en : $pkg->clean_description }}
                                    </p>
                                @endif
                            </div>

                            <!-- Right: [ i ] Info Icon + Price + Aqua Gold [ SELECT v ] / Stepper -->
                            <div class="flex items-center justify-between md:justify-end gap-3 md:gap-5 pt-2.5 md:pt-0 border-t md:border-t-0 border-white/20 shrink-0">
                                
                                <!-- Waterbom Bali Style [ i ] Info Button -->
                                <button type="button" 
                                        @click="openPassInfo({{ $pkg->id }}, '{{ addslashes($locale === 'en' && $pkg->name_en ? $pkg->name_en : $pkg->name) }}', {{ json_encode($pkgBenefits) }}, '{{ addslashes($locale === 'en' ? $pkg->clean_description_en : $pkg->clean_description) }}', '{{ addslashes($locale === 'en' && $pkg->terms_and_conditions_en ? $pkg->terms_and_conditions_en : ($pkg->terms_and_conditions ?: 'Tiket gelang berlaku 1 hari penuh untuk akses ke seluruh wahana air Aquaboom Balikpapan.')) }}')"
                                        title="{{ $locale === 'id' ? 'Klik untuk info fasilitas & S&K lengkap' : 'Click for terms & details' }}"
                                        class="w-8 h-8 md:w-9 md:h-9 bg-white text-slate-900 hover:bg-aqua-gold hover:text-aqua-navy font-black text-sm md:text-base flex items-center justify-center rounded-lg md:rounded-xl shadow-md transition-all cursor-pointer shrink-0 border border-black/10 active:scale-95">
                                    <span>i</span>
                                </button>

                                <!-- Price Block -->
                                <div class="text-left md:text-right">
                                    <span class="block text-[10px] md:text-[11px] font-bold text-white/85 uppercase tracking-wider drop-shadow-xs">
                                        {{ $locale === 'id' ? 'Mulai dari' : 'Start from' }} {{ $pricingLabel }}
                                    </span>
                                    <div class="text-lg sm:text-xl md:text-2xl font-black text-white tracking-tight leading-none mt-0.5 drop-shadow-md">
                                        Rp {{ number_format($pkg->effective_price, 0, ',', '.') }}
                                    </div>
                                    @if($pkg->price && $pkg->price > $pkg->effective_price)
                                        <span class="text-[11px] text-white/70 line-through font-semibold">
                                            Rp {{ number_format($pkg->price, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Action: Aqua Gold [ SELECT v ] or Touch-Friendly Stepper -->
                                <div class="shrink-0">
                                    @if($qty === 0)
                                        <button type="button" 
                                            wire:click="incrementQuantity({{ $pkg->id }})" 
                                            class="inline-flex items-center justify-center gap-1.5 bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy px-4 md:px-6 py-2.5 md:py-3 rounded-xl md:rounded-2xl font-black text-xs md:text-sm uppercase tracking-wider transition-all duration-200 shadow-lg hover:shadow-aqua-gold/40 cursor-pointer active:scale-95 border border-aqua-gold-2/50">
                                            <span>{{ $locale === 'id' ? 'SELECT' : 'SELECT' }}</span>
                                            <svg class="w-3.5 h-3.5 text-aqua-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                        </button>
                                    @else
                                        <div class="flex items-center bg-white/95 backdrop-blur-md rounded-xl md:rounded-2xl p-1 md:p-1.5 border-2 border-aqua-gold shadow-xl">
                                            <button type="button" wire:click="decrementQuantity({{ $pkg->id }})" 
                                                class="w-8 h-8 md:w-9 md:h-9 rounded-lg flex items-center justify-center bg-slate-100 text-aqua-navy hover:bg-slate-200 shadow-xs font-black text-lg transition-all cursor-pointer active:scale-90">
                                                -
                                            </button>
                                            <span class="text-sm md:text-base font-black text-aqua-navy w-8 md:w-9 text-center select-none">{{ $qty }}</span>
                                            <button type="button" wire:click="incrementQuantity({{ $pkg->id }})" 
                                                class="w-8 h-8 md:w-9 md:h-9 rounded-lg flex items-center justify-center bg-aqua-navy text-aqua-gold hover:bg-aqua-navy-2 shadow-xs font-black text-lg transition-all cursor-pointer active:scale-90">
                                                +
                                            </button>
                                        </div>
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            @error('quantities') <span class="text-red-500 text-sm mt-3 block font-semibold bg-red-50 p-4 rounded-2xl border border-red-100">{{ $message }}</span> @enderror
        @endif
    </div>

    <!-- Step 3: Add-Ons (Compact Visual Facility Cards) -->
    <div id="step-3-addons" class="px-3 md:px-10 py-8 md:py-12 bg-aqua-cream border-t border-b border-slate-100 scroll-mt-20 md:scroll-mt-24">
        <div class="max-w-5xl mx-auto">
            <div class="flex items-center justify-between gap-3 mb-6 md:mb-8">
                <div class="flex items-center gap-2 md:gap-3">
                    <div class="h-px w-6 md:w-8 bg-aqua-gold"></div>
                    <span class="text-aqua-gold text-[10px] md:text-xs font-black uppercase tracking-[0.2em]">Step 3</span>
                    <span class="text-aqua-navy text-xs md:text-sm font-black uppercase tracking-wide">
                        {{ $locale === 'id' ? 'FASILITAS SEWA & ADD-ON (OPSIONAL)' : 'RENTAL FACILITIES & ADD-ONS (OPTIONAL)' }}
                    </span>
                </div>
                <span class="text-[11px] font-bold text-slate-500 bg-white px-3 py-1 rounded-full border border-slate-200/80 shadow-xs hidden sm:inline-block">
                    {{ $locale === 'id' ? 'Bisa disewa saat ini atau di lokasi' : 'Available online or on-site' }}
                </span>
            </div>

            <!-- Compact 3-Column Add-On Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">
                @foreach($addons as $addon)
                    @php
                        $addonQty = $addon_quantities[$addon->id] ?? 0;
                    @endphp
                    <div class="bg-white p-4 md:p-5 rounded-2xl md:rounded-3xl border-2 transition-all duration-200 flex flex-col justify-between
                         {{ $addonQty > 0 ? 'border-aqua-gold ring-2 ring-aqua-gold/20 shadow-md bg-amber-50/15' : 'border-slate-200/80 hover:border-slate-300 shadow-xs hover:shadow-sm' }}">
                        
                        <div>
                            <div class="relative w-full h-36 md:h-40 rounded-xl md:rounded-2xl overflow-hidden bg-slate-100 mb-3 border border-slate-100">
                                <img src="{{ $addon->image_url }}" alt="{{ $addon->name }}" onerror="this.onerror=null; this.src='{{ asset('assets/img/default-addon.svg') }}';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                <span class="absolute top-2 right-2 bg-aqua-navy/85 backdrop-blur-xs text-white text-[9px] font-black uppercase px-2 py-0.5 rounded-md shadow-xs">
                                    Fasilitas Sewa
                                </span>
                            </div>

                            <h4 class="font-black text-aqua-navy text-sm md:text-base leading-snug line-clamp-1">
                                {{ $locale === 'en' && $addon->name_en ? $addon->name_en : $addon->name }}
                            </h4>
                            <p class="text-slate-500 text-[11px] font-medium leading-relaxed line-clamp-2 mt-1">
                                {!! strip_tags($locale === 'en' && $addon->description_en ? $addon->description_en : $addon->description) !!}
                            </p>
                        </div>

                        <div class="flex items-center justify-between mt-4 pt-3 border-t border-slate-100">
                            <div>
                                <span class="block text-[9px] font-bold text-slate-400 uppercase tracking-wider">Tarif Sewa</span>
                                <span class="text-sm md:text-base font-black text-aqua-gold">
                                    Rp {{ number_format($addon->price, 0, ',', '.') }}
                                </span>
                            </div>

                            <div>
                                @if($addonQty === 0)
                                    <button type="button" wire:click="incrementAddonQuantity({{ $addon->id }})" 
                                        class="inline-flex items-center gap-1 bg-slate-100 hover:bg-aqua-navy hover:text-white text-aqua-navy text-xs font-black uppercase px-3.5 py-2 rounded-xl border border-slate-200 transition-all cursor-pointer">
                                        <span>+ Sewa</span>
                                    </button>
                                @else
                                    <div class="flex items-center bg-aqua-cream rounded-xl p-1 border border-aqua-gold/50 shadow-xs">
                                        <button type="button" wire:click="decrementAddonQuantity({{ $addon->id }})" class="w-7 h-7 rounded-lg bg-white text-aqua-navy hover:bg-slate-100 shadow-xs font-black text-sm transition-all cursor-pointer">-</button>
                                        <span class="text-xs font-black text-aqua-navy w-6 text-center select-none">{{ $addonQty }}</span>
                                        <button type="button" wire:click="incrementAddonQuantity({{ $addon->id }})" class="w-7 h-7 rounded-lg bg-aqua-navy text-aqua-gold hover:bg-aqua-navy-2 shadow-xs font-black text-sm transition-all cursor-pointer">+</button>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- Quick Action to Continue to Step 4 -->
            <div class="mt-6 md:mt-8 flex justify-end">
                <button type="button" 
                        onclick="document.getElementById('step-4-contact')?.scrollIntoView({ behavior: 'smooth', block: 'start' })"
                        class="inline-flex items-center gap-2 bg-white hover:bg-aqua-navy hover:text-white border border-slate-200 hover:border-aqua-navy text-slate-700 font-bold text-xs uppercase px-6 py-3.5 rounded-xl transition-all shadow-sm group">
                    <span>{{ $locale === 'id' ? 'Lanjut ke Data Pemesan' : 'Continue to Visitor Info' }}</span>
                    <svg class="w-4 h-4 text-aqua-gold group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Step 4: Contact Information -->
    <div id="step-4-contact" class="px-4 md:px-10 pt-12 pb-28 md:pb-36 max-w-5xl mx-auto w-full scroll-mt-24">
        <div class="flex items-center gap-3 mb-8">
            <div class="h-px w-8 bg-aqua-gold"></div>
            <span class="text-aqua-gold text-xs font-black uppercase tracking-[0.2em]">Step 4</span>
            <span class="text-aqua-navy text-sm font-black uppercase tracking-wide">
                {{ $locale === 'id' ? 'INFORMASI KONTAK' : 'CONTACT INFORMATION' }}
            </span>
        </div>

        <!-- Contact Form Fields -->
        <div class="bg-aqua-cream p-5 md:p-10 rounded-[32px] border border-slate-200/60 space-y-6 shadow-sm mb-10">
            <div>
                <label for="name" class="block text-xs font-black text-aqua-navy uppercase tracking-widest mb-3">
                    {{ $locale === 'id' ? 'Nama Lengkap' : 'Full Name' }}
                </label>
                <input type="text" wire:model.live.debounce.300ms="customer_name" id="name" class="block w-full px-5 py-4 rounded-2xl border border-slate-200 bg-white text-aqua-navy focus:outline-none focus:border-aqua-gold focus:ring-2 focus:ring-aqua-gold/20 transition-all text-base font-semibold placeholder-slate-400" placeholder="e.g. John Doe" required />
                @error('customer_name') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-xs font-black text-aqua-navy uppercase tracking-widest mb-3">
                        {{ $locale === 'id' ? 'Alamat Email' : 'Email Address' }}
                    </label>
                    <input type="email" wire:model.live.debounce.300ms="customer_email" id="email" class="block w-full px-5 py-4 rounded-2xl border border-slate-200 bg-white text-aqua-navy focus:outline-none focus:border-aqua-gold focus:ring-2 focus:ring-aqua-gold/20 transition-all text-base font-semibold placeholder-slate-400" placeholder="e.g. john@example.com" required />
                    @error('customer_email') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="phone" class="block text-xs font-black text-aqua-navy uppercase tracking-widest mb-3">
                        {{ $locale === 'id' ? 'Nomor WhatsApp' : 'WhatsApp Number' }}
                    </label>
                    <input type="tel" wire:model.live.debounce.300ms="customer_phone" id="phone" class="block w-full px-5 py-4 rounded-2xl border border-slate-200 bg-white text-aqua-navy focus:outline-none focus:border-aqua-gold focus:ring-2 focus:ring-aqua-gold/20 transition-all text-base font-semibold placeholder-slate-400" placeholder="e.g. 08123456789" required />
                    @error('customer_phone') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Promo Code -->
        <div class="mb-10">
            <div class="flex items-center gap-3 mb-6">
                <div class="h-px w-8 bg-aqua-gold"></div>
                <span class="text-aqua-gold text-xs font-black uppercase tracking-[0.2em]">Promo</span>
                <span class="text-aqua-navy text-sm font-black uppercase tracking-wide">
                    {{ $locale === 'id' ? 'KODE VOUCHER (OPSIONAL)' : 'PROMO CODE (OPTIONAL)' }}
                </span>
            </div>

            <div class="bg-aqua-cream p-6 rounded-[28px] border border-slate-100 flex flex-col md:flex-row gap-4 items-center">
                @if($appliedPromo)
                    <div class="flex-1 flex justify-between items-center w-full bg-emerald-50 p-4 rounded-2xl border border-emerald-100">
                        <div class="flex items-center gap-3 text-emerald-700 font-bold text-sm">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                            {{ $locale === 'id' ? 'Promo Aktif' : 'Voucher Active' }}: {{ $appliedPromo->code }}
                        </div>
                        <button type="button" wire:click="removePromo" class="text-xs font-black uppercase tracking-wider text-red-500 hover:text-red-600 bg-white shadow-sm border border-slate-100 px-4 py-2 rounded-xl transition-all">
                            {{ $locale === 'id' ? 'Batal' : 'Cancel' }}
                        </button>
                    </div>
                @else
                    <input type="text" wire:model="promo_code" id="promo_code" wire:keydown.enter.prevent="applyPromo" class="flex-1 w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-white text-aqua-navy focus:outline-none focus:border-aqua-gold transition-all text-sm font-black uppercase placeholder-slate-400" placeholder="{{ $locale === 'id' ? 'Masukkan Kode Promo' : 'Enter Promo Code' }}">
                    <button type="button" wire:click="applyPromo" wire:loading.attr="disabled" wire:target="applyPromo" class="w-full md:w-auto bg-aqua-navy text-aqua-gold hover:bg-aqua-navy-2 px-8 py-3.5 rounded-xl font-black text-sm uppercase tracking-widest transition-all">
                        <span wire:loading.remove wire:target="applyPromo">{{ $locale === 'id' ? 'Gunakan' : 'Apply' }}</span>
                        <span wire:loading wire:target="applyPromo">...</span>
                    </button>
                @endif
            </div>
            @if($promoError)
                <span class="text-red-500 text-xs font-bold mt-2 block px-2">{{ $promoError }}</span>
            @endif
        </div>

        <!-- Terms Acceptance with Forced Popup -->
        <div id="terms_section"
             x-data="{ 
                termsModalOpen: false, 
                activeTab: 'terms',
                termsAccepted: @entangle('termsAccepted'),
                openTerms(tab = 'terms') {
                    this.activeTab = tab;
                    this.termsModalOpen = true;
                    document.body.classList.add('overflow-hidden');
                    window.dispatchEvent(new CustomEvent('hide-chat-assistant'));
                    this.$nextTick(() => {
                        const modalScroll = document.getElementById('terms_modal_scroll');
                        if (modalScroll) modalScroll.scrollTop = 0;
                    });
                },
                closeTerms() {
                    this.termsModalOpen = false;
                    document.body.classList.remove('overflow-hidden');
                    window.dispatchEvent(new CustomEvent('show-chat-assistant'));
                }
             }" 
             @open-terms-modal.window="openTerms('terms')"
             @keydown.escape.window="closeTerms()"
             class="mb-12 transition-all duration-300 rounded-[28px]">
            <div @click="openTerms('terms')" class="flex items-start gap-4 bg-aqua-cream/50 p-6 rounded-[24px] border border-aqua-gold/20 cursor-pointer hover:bg-aqua-cream transition-colors">
                <div class="relative flex items-start pt-1">
                    <input type="checkbox" 
                        @click.prevent
                        class="w-6 h-6 rounded-md border-aqua-gold/30 text-aqua-gold focus:ring-aqua-gold cursor-pointer transition-colors bg-white border-2" 
                        id="terms_checkbox"
                        :checked="termsAccepted">
                </div>
                <div class="text-xs font-semibold text-slate-600 leading-relaxed select-none">
                    @if($locale === 'id')
                        Saya menyetujui <span @click.stop="openTerms('terms')" class="text-aqua-gold font-black hover:text-aqua-gold-2 transition-all uppercase underline cursor-pointer">Syarat & Ketentuan</span> serta <span @click.stop="openTerms('privacy')" class="text-aqua-gold font-black hover:text-aqua-gold-2 transition-all uppercase underline cursor-pointer">Kebijakan Privasi</span> yang berlaku di Aquaboom Waterpark.
                    @else
                        I agree to the <span @click.stop="openTerms('terms')" class="text-aqua-gold font-black hover:text-aqua-gold-2 transition-all uppercase underline cursor-pointer">Terms & Conditions</span> and <span @click.stop="openTerms('privacy')" class="text-aqua-gold font-black hover:text-aqua-gold-2 transition-all uppercase underline cursor-pointer">Privacy Policy</span> governing Aquaboom Waterpark.
                    @endif
                </div>
            </div>
            
            <!-- S&K & Kebijakan Privasi Modal Pop-up (Teleported to body for 100% viewport centering) -->
            <template x-teleport="body">
                <div x-show="termsModalOpen" @click.stop style="display: none;" class="fixed inset-0 z-[200] flex items-center justify-center p-4 md:p-6">
                    <div x-show="termsModalOpen" x-transition.opacity @click="closeTerms()" class="absolute inset-0 bg-aqua-navy/70 backdrop-blur-md"></div>
                    <div x-show="termsModalOpen" x-transition class="relative bg-white w-full max-w-2xl rounded-[32px] shadow-2xl p-6 md:p-8 max-h-[85vh] flex flex-col border border-aqua-gold/20 overflow-hidden">
                        
                        <!-- Modal Header -->
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100 shrink-0">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-2xl bg-amber-500/10 border border-aqua-gold/30 flex items-center justify-center shrink-0">
                                    <svg x-show="activeTab === 'terms'" class="w-6 h-6 text-aqua-gold" style="color: #F09628 !important; stroke: #F09628 !important;" fill="none" stroke="#F09628" stroke-width="2.2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <svg x-show="activeTab === 'privacy'" class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-base md:text-lg font-black text-aqua-navy uppercase tracking-tight">
                                        <span x-show="activeTab === 'terms'">{{ $locale === 'id' ? 'Syarat & Ketentuan Booking Tiket' : 'Ticket Booking Terms & Conditions' }}</span>
                                        <span x-show="activeTab === 'privacy'">{{ $locale === 'id' ? 'Kebijakan Privasi & Data' : 'Privacy & Data Protection Policy' }}</span>
                                    </h4>
                                    <span class="text-xs text-aqua-gold font-bold uppercase tracking-wider">Aquaboom Balikpapan</span>
                                </div>
                            </div>
                            <button type="button" @click="closeTerms()" class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition-colors cursor-pointer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <!-- Document Switcher Tabs -->
                        <div class="flex items-center gap-1.5 p-1 bg-slate-100/90 rounded-2xl border border-slate-200/80 my-3 shrink-0">
                            <button type="button" 
                                    @click="activeTab = 'terms'; $nextTick(() => { document.getElementById('terms_modal_scroll').scrollTop = 0; })"
                                    :class="activeTab === 'terms' ? 'bg-white text-aqua-navy shadow-sm font-black border border-slate-200/80' : 'text-slate-500 hover:text-slate-800 font-bold'"
                                    class="flex-1 py-2 px-3 rounded-xl text-xs uppercase tracking-wider transition-all flex items-center justify-center gap-2 cursor-pointer">
                                <svg class="w-4 h-4 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <span>{{ $locale === 'id' ? 'Syarat & Ketentuan' : 'Terms & Conditions' }}</span>
                            </button>
                            <button type="button" 
                                    @click="activeTab = 'privacy'; $nextTick(() => { document.getElementById('terms_modal_scroll').scrollTop = 0; })"
                                    :class="activeTab === 'privacy' ? 'bg-white text-aqua-navy shadow-sm font-black border border-slate-200/80' : 'text-slate-500 hover:text-slate-800 font-bold'"
                                    class="flex-1 py-2 px-3 rounded-xl text-xs uppercase tracking-wider transition-all flex items-center justify-center gap-2 cursor-pointer">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                <span>{{ $locale === 'id' ? 'Kebijakan Privasi' : 'Privacy Policy' }}</span>
                            </button>
                        </div>
                        
                        <!-- Scrollable Modal Body -->
                        <div id="terms_modal_scroll" class="flex-1 overflow-y-auto py-2 pr-2 text-xs md:text-sm text-slate-600 leading-relaxed font-semibold">

                            <!-- TAB 1: SYARAT & KETENTUAN -->
                            <div x-show="activeTab === 'terms'" class="space-y-6">
                                <div class="bg-amber-500/5 border border-amber-500/20 rounded-2xl p-4 text-xs font-medium text-slate-700">
                                    {{ $locale === 'id' 
                                        ? 'Dengan melakukan pembelian tiket Aquaboom Balikpapan, customer dianggap telah membaca, memahami, dan menyetujui seluruh Syarat & Ketentuan berikut:'
                                        : 'By purchasing Aquaboom Balikpapan tickets, customers are deemed to have read, understood, and agreed to all of the following Terms & Conditions:'
                                    }}
                                </div>

                                <!-- 1. Ketentuan Umum -->
                                <div class="space-y-2">
                                    <h5 class="font-black text-aqua-navy uppercase text-xs flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-md bg-aqua-navy text-white text-[10px] flex items-center justify-center font-bold">1</span>
                                        {{ $locale === 'id' ? 'Ketentuan Umum' : 'General Rules' }}
                                    </h5>
                                    <ul class="list-disc list-outside pl-5 space-y-1.5 text-xs text-slate-600">
                                        <li>{{ $locale === 'id' ? 'Tiket Aquaboom Balikpapan hanya dapat digunakan sesuai dengan tanggal kunjungan yang tercantum pada tiket.' : 'Tickets are only valid for the visit date specified on the ticket.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Tiket wajib ditunjukkan pada saat memasuki area Aquaboom, baik dalam bentuk digital maupun cetak.' : 'Tickets must be presented upon entering Aquaboom, in either digital or printed form.' }}</li>
                                        <li><strong>{{ $locale === 'id' ? 'Tiket yang telah dibeli dan dibayar tidak dapat dibatalkan, dikembalikan (refund), atau diuangkan kembali' : 'Tickets purchased and paid for are non-refundable, non-cancellable, and non-redeemable for cash' }}</strong>{{ $locale === 'id' ? ', kecuali ditentukan lain oleh pihak Aquaboom Balikpapan.' : ', unless otherwise specified by Aquaboom Balikpapan management.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Tiket tidak dapat dipindahtangankan atau diperjualbelikan kembali tanpa persetujuan dari pihak Aquaboom Balikpapan.' : 'Tickets may not be transferred or resold without prior consent from Aquaboom Balikpapan.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Customer bertanggung jawab memastikan data booking yang diberikan sudah benar, termasuk nama, jumlah tiket, tanggal kunjungan, dan informasi lainnya.' : 'Customers are responsible for ensuring all booking information (name, ticket count, visit date) is accurate.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Aquaboom Balikpapan berhak menolak akses masuk apabila terdapat ketidaksesuaian data, tiket tidak valid, atau terdapat indikasi penyalahgunaan tiket.' : 'Aquaboom Balikpapan reserves the right to deny entry if there is data discrepancy, invalid ticket, or ticket abuse indication.' }}</li>
                                    </ul>
                                </div>

                                <!-- 2. Keselamatan dan Peraturan Kolam -->
                                <div class="space-y-2">
                                    <h5 class="font-black text-aqua-navy uppercase text-xs flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-md bg-aqua-navy text-white text-[10px] flex items-center justify-center font-bold">2</span>
                                        {{ $locale === 'id' ? 'Keselamatan dan Peraturan Kolam' : 'Pool Safety & Regulations' }}
                                    </h5>
                                    <ul class="list-disc list-outside pl-5 space-y-1.5 text-xs text-slate-600">
                                        <li>{{ $locale === 'id' ? 'Pengunjung wajib mengikuti seluruh peraturan keselamatan dan instruksi dari Lifeguard serta petugas Aquaboom Balikpapan.' : 'Visitors must follow all safety guidelines and instructions from Lifeguards and park staff.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Pengunjung wajib menggunakan fasilitas sesuai dengan ketentuan usia, tinggi badan, berat badan, atau persyaratan keselamatan yang berlaku pada masing-masing wahana.' : 'Visitors must abide by age, height, weight, and safety requirements for each specific ride/attraction.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Anak-anak wajib berada dalam pengawasan orang tua atau pendamping setiap saat.' : 'Children must be under parent or guardian supervision at all times.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Pengunjung dilarang melakukan tindakan yang dapat membahayakan diri sendiri maupun pengunjung lainnya.' : 'Dangerous behavior endangering oneself or other guests is strictly prohibited.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Penggunaan fasilitas atau wahana yang tidak sesuai dengan petunjuk keselamatan menjadi tanggung jawab pengunjung.' : 'Improper use of facilities against safety instructions is entirely the visitor\'s responsibility.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Aquaboom Balikpapan berhak menghentikan penggunaan wahana atau meminta pengunjung meninggalkan area apabila melanggar peraturan keselamatan.' : 'Aquaboom Balikpapan reserves the right to suspend ride use or request guests to leave the premises if violating safety rules.' }}</li>
                                    </ul>
                                </div>

                                <!-- 3. Barang Pribadi -->
                                <div class="space-y-2">
                                    <h5 class="font-black text-aqua-navy uppercase text-xs flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-md bg-aqua-navy text-white text-[10px] flex items-center justify-center font-bold">3</span>
                                        {{ $locale === 'id' ? 'Barang Pribadi' : 'Personal Belongings' }}
                                    </h5>
                                    <ul class="list-disc list-outside pl-5 space-y-1.5 text-xs text-slate-600">
                                        <li>{{ $locale === 'id' ? 'Pengunjung bertanggung jawab atas barang pribadi yang dibawa ke area Aquaboom.' : 'Guests are solely responsible for personal items brought into the waterpark area.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Aquaboom Balikpapan tidak bertanggung jawab atas kehilangan, kerusakan, atau tertukarnya barang pribadi yang disebabkan oleh kelalaian pengunjung.' : 'Aquaboom Balikpapan is not liable for loss, damage, or theft of personal items caused by guest negligence.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Pengunjung disarankan menyimpan barang berharga pada tempat penyimpanan (loker) yang telah disediakan.' : 'Guests are strongly advised to secure valuables in available rental lockers.' }}</li>
                                    </ul>
                                </div>

                                <!-- 4. Ketentuan Pakaian dan Barang yang Dibawa -->
                                <div class="space-y-2">
                                    <h5 class="font-black text-aqua-navy uppercase text-xs flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-md bg-aqua-navy text-white text-[10px] flex items-center justify-center font-bold">4</span>
                                        {{ $locale === 'id' ? 'Ketentuan Pakaian dan Barang yang Dibawa' : 'Attire & Items Policy' }}
                                    </h5>
                                    <ul class="list-disc list-outside pl-5 space-y-1.5 text-xs text-slate-600">
                                        <li>{{ $locale === 'id' ? 'Pengunjung wajib menggunakan pakaian yang sesuai untuk aktivitas kolam dan wahana air (baju renang/swimwear).' : 'Proper swimwear suitable for pool and water slide activities is mandatory.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Penggunaan barang atau perlengkapan tertentu dapat dibatasi demi keselamatan pengunjung dan kelancaran operasional.' : 'Certain equipment or accessories may be restricted for safety and operational considerations.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Makanan dan minuman dari luar dapat dibatasi sesuai dengan peraturan yang berlaku di area Aquaboom.' : 'Outside food and beverages are subject to park regulations and restrictions.' }}</li>
                                    </ul>
                                </div>

                                <!-- 5. Operasional dan Kondisi Wahana -->
                                <div class="space-y-2">
                                    <h5 class="font-black text-aqua-navy uppercase text-xs flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-md bg-aqua-navy text-white text-[10px] flex items-center justify-center font-bold">5</span>
                                        {{ $locale === 'id' ? 'Operasional dan Kondisi Wahana' : 'Operations & Ride Conditions' }}
                                    </h5>
                                    <ul class="list-disc list-outside pl-5 space-y-1.5 text-xs text-slate-600">
                                        <li>{{ $locale === 'id' ? 'Jam operasional dapat berubah sewaktu-waktu berdasarkan kondisi operasional, cuaca, pemeliharaan, keamanan, atau keadaan lainnya.' : 'Operating hours may vary based on maintenance, weather, security, or other operational circumstances.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Beberapa wahana atau fasilitas dapat ditutup sementara untuk pemeliharaan, perbaikan, kondisi cuaca, atau alasan keselamatan.' : 'Select rides or attractions may temporarily close for maintenance, repairs, or safety.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Penutupan sementara wahana tertentu tidak otomatis memberikan hak refund atau kompensasi atas tiket yang telah dibeli.' : 'Temporary attraction closure does not entitle guests to automatic refunds or compensation.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Dalam kondisi tertentu, Aquaboom Balikpapan dapat melakukan perubahan atau pembatasan operasional demi keselamatan dan kenyamanan pengunjung.' : 'Aquaboom Balikpapan reserves the right to modify operations for safety and convenience.' }}</li>
                                    </ul>
                                </div>

                                <!-- 6. Cuaca dan Keadaan Khusus -->
                                <div class="space-y-2">
                                    <h5 class="font-black text-aqua-navy uppercase text-xs flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-md bg-aqua-navy text-white text-[10px] flex items-center justify-center font-bold">6</span>
                                        {{ $locale === 'id' ? 'Cuaca dan Keadaan Khusus' : 'Weather & Force Majeure' }}
                                    </h5>
                                    <ul class="list-disc list-outside pl-5 space-y-1.5 text-xs text-slate-600">
                                        <li>{{ $locale === 'id' ? 'Operasional fasilitas outdoor dapat dipengaruhi oleh kondisi cuaca.' : 'Outdoor facility operations may be impacted by weather conditions.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Apabila terjadi hujan lebat, petir, atau kondisi lain yang dianggap membahayakan, beberapa wahana dapat dihentikan sementara.' : 'In case of heavy rain, lightning, or severe conditions, attractions may temporarily pause.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Keputusan terkait penghentian atau pembukaan kembali wahana berdasarkan kondisi keselamatan merupakan kewenangan manajemen Aquaboom Balikpapan.' : 'Decisions to suspend or resume rides remain the sole discretion of Aquaboom Balikpapan management.' }}</li>
                                    </ul>
                                </div>

                                <!-- 7. Tanggung Jawab Pengunjung -->
                                <div class="space-y-2">
                                    <h5 class="font-black text-aqua-navy uppercase text-xs flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-md bg-aqua-navy text-white text-[10px] flex items-center justify-center font-bold">7</span>
                                        {{ $locale === 'id' ? 'Tanggung Jawab Pengunjung' : 'Visitor Responsibility' }}
                                    </h5>
                                    <ul class="list-disc list-outside pl-5 space-y-1.5 text-xs text-slate-600">
                                        <li>{{ $locale === 'id' ? 'Pengunjung wajib menjaga kebersihan, fasilitas, dan lingkungan Aquaboom Balikpapan.' : 'Visitors must maintain cleanliness and respect park facilities and surrounding environment.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Kerusakan fasilitas yang disebabkan oleh tindakan sengaja atau kelalaian pengunjung dapat dikenakan biaya penggantian sesuai dengan tingkat kerusakan.' : 'Damages caused intentionally or by gross negligence are subject to replacement charges.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Pengunjung wajib menghormati pengunjung lain dan mengikuti arahan petugas selama berada di area Aquaboom.' : 'Guests must respect others and adhere to staff directions throughout their visit.' }}</li>
                                    </ul>
                                </div>

                                <!-- 8. Pemrosesan Data Customer -->
                                <div class="space-y-2">
                                    <h5 class="font-black text-aqua-navy uppercase text-xs flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-md bg-aqua-navy text-white text-[10px] flex items-center justify-center font-bold">8</span>
                                        {{ $locale === 'id' ? 'Pemrosesan Data Customer' : 'Customer Data Processing' }}
                                    </h5>
                                    <ul class="list-disc list-outside pl-5 space-y-1.5 text-xs text-slate-600">
                                        <li>{{ $locale === 'id' ? 'Dengan melakukan booking, customer menyetujui pengumpulan dan pemrosesan data pribadi yang diperlukan untuk keperluan reservasi dan layanan Aquaboom Balikpapan.' : 'By booking, customers consent to personal data collection and processing necessary for reservations.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Data customer dapat meliputi nama, nomor telepon, alamat email, jumlah pengunjung, informasi transaksi, serta data lain yang diperlukan untuk proses booking.' : 'Data collected includes name, phone number, email, guest count, and transaction details.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Data digunakan untuk keperluan pemrosesan booking, pembayaran, konfirmasi tiket, pelayanan customer, keamanan, administrasi, dan peningkatan kualitas layanan.' : 'Data is used for order processing, payment, verification, customer support, security, and service improvements.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Data customer tidak akan digunakan untuk tujuan lain di luar kebutuhan layanan tanpa dasar yang sah atau persetujuan yang diperlukan.' : 'Data will not be used for unrelated purposes without lawful basis or customer consent.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Data customer dapat dibagikan kepada pihak ketiga yang terkait dengan proses booking atau pembayaran (seperti payment gateway DOKU) dengan tetap memperhatikan perlindungan data pribadi.' : 'Data may be shared with verified service partners (e.g. licensed payment gateways) strictly for order fulfillment.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Customer memiliki hak atas data pribadinya sesuai dengan ketentuan peraturan perundang-undangan yang berlaku.' : 'Customers retain their data subject rights under applicable laws.' }}</li>
                                    </ul>
                                </div>

                                <!-- 9. Persetujuan -->
                                <div class="space-y-2">
                                    <h5 class="font-black text-aqua-navy uppercase text-xs flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-md bg-aqua-navy text-white text-[10px] flex items-center justify-center font-bold">9</span>
                                        {{ $locale === 'id' ? 'Persetujuan' : 'Agreement & Acceptance' }}
                                    </h5>
                                    <p class="text-xs text-slate-500 mb-1">
                                        {{ $locale === 'id' ? 'Dengan menyelesaikan proses booking dan pembayaran, customer menyatakan bahwa:' : 'By completing the booking and payment process, customers state that:' }}
                                    </p>
                                    <ul class="list-disc list-outside pl-5 space-y-1.5 text-xs text-slate-600">
                                        <li>{{ $locale === 'id' ? 'Data yang diberikan adalah benar dan akurat.' : 'All information provided is true, valid, and accurate.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Customer telah membaca dan memahami Syarat & Ketentuan ini.' : 'Customer has read and understood these Terms & Conditions in full.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Customer menyetujui pemrosesan data pribadi sebagaimana dijelaskan dalam Privacy Policy Aquaboom Balikpapan.' : 'Customer consents to personal data processing as detailed in the Privacy Policy.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Customer bersedia mengikuti seluruh peraturan, ketentuan keselamatan, dan instruksi petugas selama berada di area Aquaboom Balikpapan.' : 'Customer agrees to obey all park guidelines, safety rules, and staff instructions.' }}</li>
                                    </ul>
                                    <p class="text-[11px] text-slate-400 italic pt-2">
                                        {{ $locale === 'id' 
                                            ? 'Aquaboom Balikpapan berhak melakukan perubahan terhadap Syarat & Ketentuan ini apabila diperlukan. Perubahan akan berlaku sejak dipublikasikan melalui media resmi Aquaboom Balikpapan.'
                                            : 'Aquaboom Balikpapan reserves the right to update these Terms & Conditions when necessary, effective upon publication on official channels.'
                                        }}
                                    </p>
                                </div>

                                <!-- Tambahan Syarat Khusus Tiket yang Dipilih (Jika Ada) -->
                                @php $hasSelectedTerms = false; @endphp
                                @foreach($packages as $pkg)
                                    @if(($quantities[$pkg->id] ?? 0) > 0 && ($pkg->terms_and_conditions || $pkg->terms_and_conditions_en))
                                        @if(!$hasSelectedTerms)
                                            <div class="pt-4 border-t border-slate-200">
                                                <div class="flex items-center gap-2 mb-3">
                                                    <span class="bg-aqua-gold text-aqua-navy text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider">
                                                        {{ $locale === 'id' ? 'Ketentuan Tambahan Tiket' : 'Specific Ticket Policies' }}
                                                    </span>
                                                </div>
                                            </div>
                                            @php $hasSelectedTerms = true; @endphp
                                        @endif
                                        <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-4 space-y-2">
                                            <h6 class="font-black text-aqua-navy uppercase text-xs flex items-center gap-2">
                                                <svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="#F09628" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                                                <span>{{ $locale === 'en' && $pkg->name_en ? $pkg->name_en : $pkg->name }}</span>
                                            </h6>
                                            <div class="text-xs text-slate-600 leading-relaxed pl-6">
                                                {!! nl2br(e($locale === 'en' && $pkg->terms_and_conditions_en ? $pkg->terms_and_conditions_en : $pkg->terms_and_conditions)) !!}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- TAB 2: KEBIJAKAN PRIVASI -->
                            <div x-show="activeTab === 'privacy'" class="space-y-6">
                                <!-- Intro Banner -->
                                <div class="bg-gradient-to-r from-emerald-50 via-teal-50 to-emerald-50 border border-emerald-200/80 rounded-2xl p-4 flex items-start sm:items-center gap-3.5">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    </div>
                                    <div class="text-xs">
                                        <h5 class="font-black text-emerald-950 uppercase tracking-wide">
                                            {{ $locale === 'id' ? 'Komitmen Perlindungan Data Pribadi' : 'Commitment to Data Protection' }}
                                        </h5>
                                        <p class="text-emerald-800/80 font-medium mt-0.5">
                                            {{ $locale === 'id'
                                                ? 'Aquaboom Balikpapan menghargai privasi dan berkomitmen penuh untuk melindungi data pribadi yang Anda berikan saat melakukan reservasi tiket.'
                                                : 'Aquaboom Balikpapan respects your privacy and is fully committed to safeguarding the personal data provided during booking.' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- 1. Data yang Dikumpulkan -->
                                <div class="space-y-2">
                                    <h5 class="font-black text-aqua-navy uppercase text-xs flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-md bg-aqua-navy text-white text-[10px] flex items-center justify-center font-bold">1</span>
                                        {{ $locale === 'id' ? 'Data yang Kami Kumpulkan' : 'Data We Collect' }}
                                    </h5>
                                    <ul class="list-disc list-outside pl-5 space-y-1.5 text-xs text-slate-600">
                                        <li><strong>{{ $locale === 'id' ? 'Nama Pengunjung:' : 'Visitor Name:' }}</strong> {{ $locale === 'id' ? 'Untuk identifikasi kepemilikan tiket dan verifikasi tiket di loket scan.' : 'Used for ticket ownership identification and entrance verification.' }}</li>
                                        <li><strong>{{ $locale === 'id' ? 'Nomor Telepon / WhatsApp:' : 'Phone / WhatsApp:' }}</strong> {{ $locale === 'id' ? 'Untuk pengiriman notifikasi status booking dan customer care.' : 'For booking status alerts and visitor customer care.' }}</li>
                                        <li><strong>{{ $locale === 'id' ? 'Alamat Email:' : 'Email Address:' }}</strong> {{ $locale === 'id' ? 'Untuk pengiriman E-Ticket resmi ber-barcode PDF secara otomatis.' : 'For instant official barcode E-Ticket delivery via PDF.' }}</li>
                                        <li><strong>{{ $locale === 'id' ? 'Informasi Transaksi:' : 'Transaction Details:' }}</strong> {{ $locale === 'id' ? 'Nomor invoice, tanggal kunjungan, rincian tiket & sewa fasilitas (tanpa menyimpan nomor kartu kredit/PIN).' : 'Invoice ID, visit date, itemized packages & rentals (card numbers/PINs are never stored).' }}</li>
                                    </ul>
                                </div>

                                <!-- 2. Tujuan Penggunaan Data -->
                                <div class="space-y-2">
                                    <h5 class="font-black text-aqua-navy uppercase text-xs flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-md bg-aqua-navy text-white text-[10px] flex items-center justify-center font-bold">2</span>
                                        {{ $locale === 'id' ? 'Tujuan Penggunaan Data' : 'Purposes of Data Use' }}
                                    </h5>
                                    <ul class="list-disc list-outside pl-5 space-y-1.5 text-xs text-slate-600">
                                        <li>{{ $locale === 'id' ? 'Memproses dan mengelola pemesanan tiket masuk, wahana, dan fasilitas tambahan.' : 'Processing and managing ticket bookings and wristband issuance.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Mengirimkan konfirmasi booking dan E-Ticket resmi langsung ke email pembeli.' : 'Delivering booking confirmations and official E-Tickets directly to customer email.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Memproses verifikasi transaksi pembayaran secara aman melalui payment gateway resmi.' : 'Processing secure transactions and payment gateway verification.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Memberikan layanan pelanggan, menangani pertanyaan, serta verifikasi saat kedatangan.' : 'Providing customer support, answering inquiries, and entrance validation.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Menjaga keamanan area rekreasi dan mencegah penyalahgunaan atau pemalsuan tiket.' : 'Ensuring park safety, preventing fraudulent transactions, and fulfilling legal duties.' }}</li>
                                    </ul>
                                </div>

                                <!-- 3. Pembagian Data kepada Pihak Ketiga -->
                                <div class="space-y-2">
                                    <h5 class="font-black text-aqua-navy uppercase text-xs flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-md bg-aqua-navy text-white text-[10px] flex items-center justify-center font-bold">3</span>
                                        {{ $locale === 'id' ? 'Pembagian Data kepada Pihak Ketiga' : 'Third-Party Data Sharing' }}
                                    </h5>
                                    <ul class="list-disc list-outside pl-5 space-y-1.5 text-xs text-slate-600">
                                        <li><strong>{{ $locale === 'id' ? 'DOKU Payment Gateway:' : 'DOKU Payment Gateway:' }}</strong> {{ $locale === 'id' ? 'Data transaksi diteruskan ke sistem DOKU yang berlisensi resmi Bank Indonesia untuk pemrosesan pembayaran terenkripsi.' : 'Transaction data is securely shared with DOKU (licensed by Bank Indonesia) for encrypted payment processing.' }}</li>
                                        <li><strong>{{ $locale === 'id' ? 'Infrastruktur Cloud & Server:' : 'Cloud & Infrastructure:' }}</strong> {{ $locale === 'id' ? 'Penyedia server hosting aman bersertifikasi untuk menjaga ketersediaan layanan dan penyimpanan basis data.' : 'Certified cloud hosting providers to ensure database security and uptime.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Kami tidak pernah memperjualbelikan atau menyewakan data pribadi Anda kepada pihak mana pun untuk keperluan pemasaran pihak ketiga.' : 'We strictly never sell or rent your personal data to any third party for marketing purposes.' }}</li>
                                    </ul>
                                </div>

                                <!-- 4. Keamanan Data & Hak Customer -->
                                <div class="space-y-2">
                                    <h5 class="font-black text-aqua-navy uppercase text-xs flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-md bg-aqua-navy text-white text-[10px] flex items-center justify-center font-bold">4</span>
                                        {{ $locale === 'id' ? 'Keamanan Data & Hak Anda' : 'Data Security & Customer Rights' }}
                                    </h5>
                                    <ul class="list-disc list-outside pl-5 space-y-1.5 text-xs text-slate-600">
                                        <li>{{ $locale === 'id' ? 'Seluruh transmisi data dienkripsi dengan standar SSL/TLS 256-bit berkeamanan tinggi.' : 'All data transmission is encrypted using high-grade 256-bit SSL/TLS protocol.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Customer berhak meminta informasi, perbaikan, atau penghapusan data pribadi sesuai dengan Undang-Undang Perlindungan Data Pribadi (UU PDP) yang berlaku di Indonesia.' : 'Customers have the right to access, update, or request deletion of their data in accordance with applicable PDP laws.' }}</li>
                                        <li>{{ $locale === 'id' ? 'Pertanyaan atau permohonan terkait privasi dapat disampaikan melalui WhatsApp resmi Customer Service Aquaboom Balikpapan.' : 'Inquiries regarding privacy can be submitted directly via Aquaboom Balikpapan Customer Service.' }}</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        
                        <!-- Modal Footer Action -->
                        <div class="pt-4 border-t border-slate-100 shrink-0">
                            <button type="button" 
                                @click="termsAccepted = true; @this.set('termsAccepted', true); closeTerms();" 
                                class="w-full bg-aqua-navy hover:bg-aqua-navy-2 text-aqua-gold font-black py-4 rounded-2xl text-sm uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2.5 border border-aqua-gold/30 hover:border-aqua-gold cursor-pointer">
                                <svg class="w-5 h-5 text-aqua-gold" style="color: #F09628 !important; stroke: #F09628 !important;" fill="none" stroke="#F09628" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>{{ $locale === 'id' ? 'Saya Membaca & Menyetujui' : 'I Read & Agree' }}</span>
                            </button>
                        </div>

                    </div>
                </div>
            </template>
        </div>
        @error('termsAccepted') <span class="text-red-500 text-xs font-bold mb-6 block">{{ $message }}</span> @enderror

        <!-- Billing Summary & Submit -->
        <div class="bg-aqua-navy text-white rounded-[32px] p-5 md:p-10 border border-aqua-gold/20 shadow-xl">
            <h4 class="text-xs font-black uppercase text-aqua-gold tracking-widest mb-6 pb-4 border-b border-white/10">
                {{ $locale === 'id' ? 'RINCIAN PEMBAYARAN' : 'BILLING SUMMARY' }}
            </h4>
            
            <div class="space-y-4 mb-8 text-sm font-semibold text-white/70">
                <!-- Ticket Subtotal -->
                <div class="flex justify-between">
                    <span>{{ $locale === 'id' ? 'Subtotal Tiket' : 'Ticket Subtotal' }}</span>
                    <span class="text-white">Rp {{ number_format($this->ticketSubtotal, 0, ',', '.') }}</span>
                </div>
                <!-- Add-on Subtotal -->
                @if($this->addonSubtotal > 0)
                    <div class="flex justify-between">
                        <span>{{ $locale === 'id' ? 'Subtotal Fasilitas Tambahan' : 'Add-on Subtotal' }}</span>
                        <span class="text-white">Rp {{ number_format($this->addonSubtotal, 0, ',', '.') }}</span>
                    </div>
                @endif
                <!-- Discount -->
                @if($appliedPromo)
                    <div class="flex justify-between text-emerald-400">
                        <span>{{ $locale === 'id' ? 'Potongan Promo' : 'Promo Discount' }}</span>
                        <span>- Rp {{ number_format($this->discountAmount, 0, ',', '.') }}</span>
                    </div>
                @endif
            </div>
            
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 pt-6 border-t border-white/10">
                <div>
                    <span class="text-white/40 font-black uppercase text-[10px] tracking-widest block mb-1">
                        {{ $locale === 'id' ? 'TOTAL AKHIR' : 'GRAND TOTAL' }}
                    </span>
                    <span class="text-3xl md:text-4xl font-black text-aqua-gold tracking-tight">
                        Rp {{ number_format($this->totalPrice, 0, ',', '.') }}
                    </span>
                </div>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="w-full md:w-auto bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black text-base px-12 py-5 rounded-2xl transition-all shadow-lg hover:shadow-amber-500/20 disabled:opacity-50 disabled:cursor-not-allowed uppercase tracking-widest flex items-center justify-center gap-2"
                >
                    <span wire:loading.remove wire:target="openConfirmationModal">
                        {{ $locale === 'id' ? 'Bayar Sekarang' : 'Pay Now' }} &rarr;
                    </span>
                    <span wire:loading wire:target="openConfirmationModal" class="inline-flex items-center gap-2">
                        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-aqua-navy" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        {{ $locale === 'id' ? 'Memeriksa...' : 'Checking...' }}
                    </span>
                </button>
            </div>
        </div>

    </div>

    <!-- Sticky Bottom Price Summary Bar (Booking.com / OTA Best Practice) -->
    <!-- Sticky Bottom Price Summary Bar & Expandable Cart Bottom Sheet -->
    @if($this->totalTickets > 0)
        <div x-data="{ 
                isExpanded: false,
                startY: 0,
                termsAccepted: @entangle('termsAccepted'),
                handleTouchStart(e) {
                    this.startY = e.touches[0].clientY;
                },
                handleTouchMove(e) {
                    if (e.cancelable) e.preventDefault();
                },
                handleTouchEnd(e) {
                    const diff = this.startY - e.changedTouches[0].clientY;
                    if (diff > 35) this.setExpanded(true);
                    if (diff < -35) this.setExpanded(false);
                },
                setExpanded(val) {
                    this.isExpanded = val;
                    if (val) {
                        document.body.classList.add('overflow-hidden');
                    } else {
                        document.body.classList.remove('overflow-hidden');
                    }
                    window.dispatchEvent(new CustomEvent('cart-drawer-toggle', { detail: { open: val } }));
                },
                focusElement(el) {
                    if (!el) return;
                    el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    setTimeout(() => {
                        el.focus({ preventScroll: true });
                        el.classList.add('ring-4', 'ring-aqua-gold/60', 'transition-all', 'duration-300');
                        setTimeout(() => el.classList.remove('ring-4', 'ring-aqua-gold/60'), 1500);
                    }, 350);
                },
                handleContinue() {
                    if (this.isExpanded) {
                        this.setExpanded(false);
                    }

                    const step3 = document.getElementById('step-3-addons');
                    const nameInput = document.getElementById('name');
                    const emailInput = document.getElementById('email');
                    const phoneInput = document.getElementById('phone');
                    const termsSection = document.getElementById('terms_section');

                    // 1. If user is above Add-ons section, scroll to Add-ons
                    if (step3) {
                        const rect3 = step3.getBoundingClientRect();
                        if (rect3.top > 350) {
                            step3.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            return;
                        }
                    }

                    // 2. Check Name
                    if (!nameInput || !nameInput.value.trim()) {
                        this.focusElement(nameInput);
                        return;
                    }

                    // 3. Check Email
                    if (!emailInput || !emailInput.value.trim() || !emailInput.value.includes('@')) {
                        this.focusElement(emailInput);
                        return;
                    }

                    // 4. Check Phone
                    if (!phoneInput || !phoneInput.value.trim()) {
                        this.focusElement(phoneInput);
                        return;
                    }

                    // 5. Check Terms & Conditions (Opens centered modal directly)
                    if (!this.termsAccepted) {
                        window.dispatchEvent(new CustomEvent('open-terms-modal'));
                        return;
                    }

                    // 6. If all filled & terms checked -> Bayar Sekarang!
                    $wire.openConfirmationModal();
                }
             }"
             x-init="window.dispatchEvent(new CustomEvent('sticky-price-bar-toggle', { detail: { active: true } }))"
             @keydown.escape.window="setExpanded(false)"
             class="relative">

            <!-- Backdrop (when expanded) -->
            <div x-show="isExpanded" 
                 x-cloak
                 style="display: none; z-index: 140 !important;"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="setExpanded(false)"
                 class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm cursor-pointer">
            </div>

            <!-- Drawer Bottom Sheet (Slides up from bottom) -->
            <div x-show="isExpanded"
                 x-cloak
                 style="display: none; z-index: 150 !important;"
                 x-transition:enter="transform transition ease-out duration-300"
                 x-transition:enter-start="translate-y-full opacity-0"
                 x-transition:enter-end="translate-y-0 opacity-100"
                 x-transition:leave="transform transition ease-in duration-200"
                 x-transition:leave-start="translate-y-0 opacity-100"
                 x-transition:leave-end="translate-y-full opacity-0"
                 class="fixed inset-x-0 bottom-0 max-h-[85vh] sm:max-h-[75vh] bg-white rounded-t-[28px] sm:rounded-t-[36px] shadow-[0_-15px_40px_-10px_rgba(0,0,0,0.3)] border-t border-aqua-gold/30 flex flex-col overflow-hidden overscroll-contain">
                
                <!-- Drawer Top Drag Handle & Header -->
                <div @touchstart="handleTouchStart($event)" 
                     @touchmove="handleTouchMove($event)"
                     @touchend="handleTouchEnd($event)" 
                     style="touch-action: none;"
                     class="pt-3 pb-4 px-5 sm:px-8 border-b border-slate-100 shrink-0 bg-slate-50/70 select-none">
                    <!-- Mobile drag pill indicator -->
                    <div class="w-12 h-1.5 bg-slate-300 hover:bg-aqua-gold rounded-full mx-auto mb-3 cursor-pointer transition-colors"
                         @click="setExpanded(false)"></div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-xl bg-aqua-navy text-aqua-gold flex items-center justify-center font-black text-sm">
                                🛒
                            </div>
                            <div>
                                <h3 class="text-sm sm:text-base font-black text-aqua-navy uppercase tracking-tight">
                                    {{ $locale === 'id' ? 'Rincian Pesanan' : 'Cart Summary' }}
                                </h3>
                                <p class="text-[10px] sm:text-xs text-slate-500 font-semibold">
                                    {{ $this->totalTickets }} {{ $locale === 'id' ? 'Tiket' : 'Ticket(s)' }}@if($this->totalAddons > 0), {{ $this->totalAddons }} Add-on @endif
                                </p>
                            </div>
                        </div>

                        <button type="button" 
                                @click="setExpanded(false)"
                                class="text-slate-400 hover:text-aqua-navy p-2 rounded-xl hover:bg-slate-200/60 transition-colors cursor-pointer flex items-center gap-1 text-xs font-bold uppercase tracking-wider"
                                aria-label="Tutup Rincian">
                            <span>{{ $locale === 'id' ? 'Tutup' : 'Close' }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Scrollable Item List with Live Qty Steppers -->
                <div class="p-5 sm:p-8 overflow-y-auto flex-1 space-y-6 divide-y divide-slate-100">
                    <!-- Section: Tiket -->
                    <div class="space-y-3">
                        <div class="text-[11px] font-black text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                            <span>🎟️</span>
                            <span>{{ $locale === 'id' ? 'Tiket Masuk Terpilih' : 'Selected Tickets' }}</span>
                        </div>

                        <div class="space-y-3">
                            @foreach($packages as $pkg)
                                @php $qty = $quantities[$pkg->id] ?? 0; @endphp
                                @if($qty > 0)
                                    <div class="bg-aqua-cream/50 rounded-2xl p-4 border border-aqua-gold/20 flex items-center justify-between gap-3">
                                        <div class="min-w-0 flex-1">
                                            <h4 class="text-xs sm:text-sm font-black text-aqua-navy uppercase truncate">
                                                {{ $locale === 'en' && $pkg->name_en ? $pkg->name_en : $pkg->name }}
                                            </h4>
                                            <div class="text-[11px] text-slate-500 font-semibold mt-0.5">
                                                Rp {{ number_format($pkg->effective_price, 0, ',', '.') }} / tiket
                                            </div>
                                            <div class="text-xs font-black text-aqua-navy mt-1">
                                                Subtotal: <span class="text-aqua-azure">Rp {{ number_format($pkg->effective_price * $qty, 0, ',', '.') }}</span>
                                            </div>
                                        </div>

                                        <!-- Stepper [-] [qty] [+] -->
                                        <div class="flex items-center bg-white rounded-xl p-1 border border-aqua-gold/30 shadow-sm shrink-0">
                                            <button type="button" 
                                                    wire:click="decrementQuantity({{ $pkg->id }})" 
                                                    class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-50 text-aqua-navy hover:bg-slate-200 font-black text-base transition-colors cursor-pointer">
                                                -
                                            </button>
                                            <span class="text-xs font-black text-aqua-navy w-7 text-center">{{ $qty }}</span>
                                            <button type="button" 
                                                    wire:click="incrementQuantity({{ $pkg->id }})" 
                                                    class="w-8 h-8 rounded-lg flex items-center justify-center bg-aqua-navy text-aqua-gold hover:bg-aqua-navy-2 font-black text-base transition-colors cursor-pointer">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Section: Add-ons (if any selected) -->
                    @if($this->totalAddons > 0)
                        <div class="pt-5 space-y-3">
                            <div class="text-[11px] font-black text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                                <span>🏖️</span>
                                <span>{{ $locale === 'id' ? 'Fasilitas Tambahan / Add-ons' : 'Additional Facilities' }}</span>
                            </div>

                            <div class="space-y-3">
                                @foreach($addons as $addon)
                                    @php $aQty = $addon_quantities[$addon->id] ?? 0; @endphp
                                    @if($aQty > 0)
                                        <div class="bg-aqua-cream/50 rounded-2xl p-4 border border-aqua-gold/20 flex items-center justify-between gap-3">
                                            <div class="min-w-0 flex-1">
                                                <h4 class="text-xs sm:text-sm font-black text-aqua-navy uppercase truncate">
                                                    {{ $locale === 'en' && $addon->name_en ? $addon->name_en : $addon->name }}
                                                </h4>
                                                <div class="text-[11px] text-slate-500 font-semibold mt-0.5">
                                                    Rp {{ number_format($addon->price, 0, ',', '.') }} / unit
                                                </div>
                                                <div class="text-xs font-black text-aqua-navy mt-1">
                                                    Subtotal: <span class="text-aqua-azure">Rp {{ number_format($addon->price * $aQty, 0, ',', '.') }}</span>
                                                </div>
                                            </div>

                                            <!-- Stepper [-] [qty] [+] -->
                                            <div class="flex items-center bg-white rounded-xl p-1 border border-aqua-gold/30 shadow-sm shrink-0">
                                                <button type="button" 
                                                        wire:click="decrementAddonQuantity({{ $addon->id }})" 
                                                        class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-50 text-aqua-navy hover:bg-slate-200 font-black text-base transition-colors cursor-pointer">
                                                    -
                                                </button>
                                                <span class="text-xs font-black text-aqua-navy w-7 text-center">{{ $aQty }}</span>
                                                <button type="button" 
                                                        wire:click="incrementAddonQuantity({{ $addon->id }})" 
                                                        class="w-8 h-8 rounded-lg flex items-center justify-center bg-aqua-navy text-aqua-gold hover:bg-aqua-navy-2 font-black text-base transition-colors cursor-pointer">
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Section: Calculation Breakdown -->
                    <div class="pt-5 space-y-2 text-xs font-semibold">
                        <div class="flex justify-between text-slate-600">
                            <span>{{ $locale === 'id' ? 'Subtotal Tiket' : 'Ticket Subtotal' }}</span>
                            <span class="font-black text-aqua-navy">Rp {{ number_format($this->ticketSubtotal, 0, ',', '.') }}</span>
                        </div>
                        @if($this->addonSubtotal > 0)
                            <div class="flex justify-between text-slate-600">
                                <span>{{ $locale === 'id' ? 'Subtotal Fasilitas Tambahan' : 'Add-on Subtotal' }}</span>
                                <span class="font-black text-aqua-navy">Rp {{ number_format($this->addonSubtotal, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        @if($this->discountAmount > 0)
                            <div class="flex justify-between text-emerald-600">
                                <span>{{ $locale === 'id' ? 'Diskon Promo' : 'Promo Discount' }}</span>
                                <span class="font-black">- Rp {{ number_format($this->discountAmount, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        <div class="pt-2 border-t border-slate-100 flex justify-between text-sm sm:text-base font-black text-aqua-navy">
                            <span>{{ $locale === 'id' ? 'Total Pembayaran' : 'Total Amount' }}</span>
                            <span class="text-aqua-azure">Rp {{ number_format($this->totalPrice, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Drawer Footer (Integrated Action inside Drawer) -->
                <div class="p-4 sm:px-8 sm:py-5 bg-slate-50 border-t border-slate-200 shrink-0 flex items-center justify-between gap-4">
                    <div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-wider">
                            {{ $locale === 'id' ? 'Total Harga' : 'Total Price' }}
                        </div>
                        <div class="text-xl sm:text-2xl font-black text-aqua-navy">
                            Rp {{ number_format($this->totalPrice, 0, ',', '.') }}
                        </div>
                    </div>
                    <button type="button" 
                            @click="handleContinue()"
                            :class="termsAccepted 
                                ? 'bg-gradient-to-r from-amber-400 via-aqua-gold to-amber-500 hover:from-amber-500 hover:to-amber-500 text-aqua-navy font-black shadow-lg shadow-amber-500/30 ring-2 ring-amber-400' 
                                : 'bg-aqua-navy hover:bg-aqua-navy-2 text-aqua-gold hover:text-white border border-aqua-gold/30 hover:border-aqua-gold shadow-md'"
                            class="text-xs sm:text-sm uppercase tracking-wider px-6 sm:px-8 py-3.5 rounded-xl sm:rounded-2xl transition-all shadow-md hover:shadow-lg flex items-center gap-2 active:scale-95 cursor-pointer">
                        <template x-if="!termsAccepted">
                            <span class="flex items-center gap-1.5">
                                <span>{{ $locale === 'id' ? 'Lanjut' : 'Continue' }}</span>
                                <svg class="w-4 h-4 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        </template>
                        <template x-if="termsAccepted">
                            <span class="flex items-center gap-1.5 font-black">
                                <span>{{ $locale === 'id' ? 'Bayar Sekarang' : 'Pay Now' }}</span>
                                <svg class="w-4 h-4 text-aqua-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        </template>
                    </button>
                </div>
            </div>

            <!-- Sticky Bottom Bar (Always visible at bottom when items > 0) -->
            <div class="fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-[0_-10px_30px_-5px_rgba(0,0,0,0.15)] transition-all duration-300 animate-in slide-in-from-bottom-5">
                
                <!-- Mobile Drag Handle Bar & Gold Strip (Touch Action None for Mobile Swipe) -->
                <div class="relative cursor-pointer select-none" 
                     @touchstart="handleTouchStart($event)" 
                     @touchmove="handleTouchMove($event)"
                     @touchend="handleTouchEnd($event)"
                     style="touch-action: none;"
                     @click="setExpanded(!isExpanded)">
                    <!-- Top Gold/Accent Highlight Strip -->
                    <div class="bg-gradient-to-r from-aqua-gold via-amber-400 to-aqua-gold h-1 w-full"></div>
                    <!-- Mobile drag handle pill -->
                    <div class="py-2 flex justify-center lg:hidden">
                        <div class="w-12 h-1.5 bg-slate-300 hover:bg-aqua-gold rounded-full transition-colors"></div>
                    </div>
                </div>
                
                @php
                    $selectedSummaryList = [];
                    foreach($packages as $pkg) {
                        $q = $quantities[$pkg->id] ?? 0;
                        if ($q > 0) {
                            $pName = ($locale === 'en' && $pkg->name_en) ? $pkg->name_en : $pkg->name;
                            $selectedSummaryList[] = $q . 'x ' . $pName;
                        }
                    }
                    if ($this->totalAddons > 0) {
                        $selectedSummaryList[] = $this->totalAddons . ' Add-on';
                    }
                    $purchasedItemsText = implode(' • ', $selectedSummaryList);
                @endphp
                
                <div class="max-w-5xl mx-auto px-4 sm:px-6 py-2.5 sm:py-3.5 flex items-center justify-between gap-3 sm:gap-6">
                    <!-- Left: Price & Breakdown + Toggle Button -->
                    <div class="flex-1 min-w-0 pr-2">
                        <!-- Top Line: Item(s) Purchased Summary (Replaces 'Bebas Antre di Loket' for clean mobile responsiveness) -->
                        <div class="flex items-center gap-1.5 mb-1 cursor-pointer overflow-hidden" @click="setExpanded(!isExpanded)">
                            <span class="text-xs text-aqua-gold shrink-0">🎟️</span>
                            <span class="text-[11px] sm:text-xs font-bold text-slate-600 truncate block">
                                {{ $purchasedItemsText ?: ($this->totalTickets . ' ' . ($locale === 'id' ? 'Tiket' : 'Tickets')) }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                            <div class="flex items-baseline gap-1.5 cursor-pointer" @click="setExpanded(!isExpanded)">
                                <span class="text-xl sm:text-2xl md:text-3xl font-black text-aqua-navy tracking-tight">
                                    Rp {{ number_format($this->totalPrice, 0, ',', '.') }}
                                </span>
                            </div>

                            <!-- Desktop & Mobile Toggle Button -->
                            <button type="button" 
                                    @click="setExpanded(!isExpanded)"
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-aqua-gold/20 text-aqua-navy text-[10px] sm:text-xs font-black uppercase tracking-wider transition-colors border border-slate-200 hover:border-aqua-gold/40 cursor-pointer shrink-0">
                                <span x-text="isExpanded ? '{{ $locale === 'id' ? 'Tutup' : 'Hide' }}' : '{{ $locale === 'id' ? 'Rincian' : 'Details' }}'"></span>
                                <svg class="w-3 h-3 transition-transform duration-200 text-aqua-gold" 
                                     :class="{'rotate-180': isExpanded}" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Right: CTA Button -->
                    <div class="shrink-0 flex items-center">
                        <button type="button" 
                                @click="handleContinue()"
                                :class="termsAccepted 
                                    ? 'bg-gradient-to-r from-amber-400 via-aqua-gold to-amber-500 hover:from-amber-500 hover:to-amber-500 text-aqua-navy font-black shadow-lg shadow-amber-500/30 ring-2 ring-amber-400' 
                                    : 'bg-aqua-navy hover:bg-aqua-navy-2 text-aqua-gold hover:text-white border border-aqua-gold/30 hover:border-aqua-gold shadow-md'"
                                class="text-xs sm:text-sm uppercase tracking-wider px-5 sm:px-8 py-3 sm:py-3.5 rounded-xl sm:rounded-2xl transition-all shadow-md hover:shadow-lg flex items-center gap-1.5 sm:gap-2 active:scale-95 cursor-pointer">
                            <template x-if="!termsAccepted">
                                <span class="flex items-center gap-1.5 sm:gap-2">
                                    <span>{{ $locale === 'id' ? 'Lanjut' : 'Continue' }}</span>
                                    <svg class="w-4 h-4 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </span>
                            </template>
                            <template x-if="termsAccepted">
                                <span class="flex items-center gap-1.5 sm:gap-2 font-black">
                                    <span>{{ $locale === 'id' ? 'Bayar Sekarang' : 'Pay Now' }}</span>
                                    <svg class="w-4 h-4 text-aqua-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </span>
                            </template>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div x-data x-init="window.dispatchEvent(new CustomEvent('sticky-price-bar-toggle', { detail: { active: false } }))" class="hidden"></div>
    @endif

    <!-- Modal Konfirmasi Pembayaran & Ringkasan Transparan -->
    @if($showConfirmationModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 md:p-6 bg-slate-950/80 backdrop-blur-md overflow-y-auto"
             x-data
             x-init="document.body.classList.add('overflow-hidden'); window.dispatchEvent(new CustomEvent('hide-chat-assistant'))"
             @keydown.escape.window="$wire.closeConfirmationModal(); document.body.classList.remove('overflow-hidden'); window.dispatchEvent(new CustomEvent('show-chat-assistant'))">
            <div class="bg-white rounded-[32px] max-w-2xl w-full p-6 md:p-8 shadow-2xl border border-slate-100 relative my-auto max-h-[92vh] flex flex-col overflow-hidden animate-in fade-in zoom-in-95 duration-200"
                 @click.away="$wire.closeConfirmationModal(); document.body.classList.remove('overflow-hidden'); window.dispatchEvent(new CustomEvent('show-chat-assistant'))">
                
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-aqua-navy text-aqua-gold flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-base md:text-lg font-black text-aqua-navy uppercase tracking-tight">
                                {{ $locale === 'id' ? 'Konfirmasi Pemesanan & Pembayaran' : 'Order & Payment Confirmation' }}
                            </h3>
                            <p class="text-xs text-slate-500 font-semibold">
                                {{ $locale === 'id' ? 'Periksa rincian sebelum diarahkan ke gateway pembayaran DOKU' : 'Review your order before proceeding to DOKU secure gateway' }}
                            </p>
                        </div>
                    </div>
                    <button type="button" wire:click="closeConfirmationModal" class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition-colors">
                        ✕
                    </button>
                </div>

                <!-- Modal Scrollable Content -->
                <div class="flex-1 overflow-y-auto py-5 pr-1 space-y-6 text-sm">

                    <!-- Customer & Visit Information -->
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 space-y-2.5">
                        <div class="text-[11px] font-black uppercase text-slate-400 tracking-wider">
                            {{ $locale === 'id' ? 'Informasi Pengunjung' : 'Visitor Information' }}
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
                            <div>
                                <span class="text-slate-400 block">{{ $locale === 'id' ? 'Nama Pengunjung:' : 'Visitor Name:' }}</span>
                                <strong class="text-aqua-navy font-bold text-sm">{{ $customer_name }}</strong>
                            </div>
                            <div>
                                <span class="text-slate-400 block">{{ $locale === 'id' ? 'Tanggal Kunjungan:' : 'Visit Date:' }}</span>
                                <strong class="text-aqua-gold font-bold text-sm">{{ \Carbon\Carbon::parse($visit_date)->translatedFormat('l, d F Y') }}</strong>
                            </div>
                            <div>
                                <span class="text-slate-400 block">{{ $locale === 'id' ? 'Email (Pengiriman E-Ticket):' : 'Email (Ticket Delivery):' }}</span>
                                <strong class="text-slate-800 font-semibold">{{ $customer_email }}</strong>
                            </div>
                            <div>
                                <span class="text-slate-400 block">{{ $locale === 'id' ? 'No. WhatsApp / HP:' : 'WhatsApp / Phone:' }}</span>
                                <strong class="text-slate-800 font-semibold">{{ $customer_phone }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Itemized Transparent Breakdown -->
                    <div>
                        <div class="text-[11px] font-black uppercase text-slate-400 tracking-wider mb-2.5">
                            {{ $locale === 'id' ? 'Rincian Item & Harga Transparan' : 'Transparent Itemized Breakdown' }}
                        </div>
                        <div class="bg-white rounded-2xl border border-slate-200 divide-y divide-slate-100 overflow-hidden shadow-sm">
                            
                            <!-- Selected Tickets -->
                            @foreach($packages as $pkg)
                                @php $qty = $quantities[$pkg->id] ?? 0; @endphp
                                @if($qty > 0)
                                    <div class="p-3.5 flex justify-between items-center text-xs">
                                        <div>
                                            <strong class="text-slate-900 block font-bold">
                                                {{ $locale === 'en' && $pkg->name_en ? $pkg->name_en : $pkg->name }}
                                            </strong>
                                            <span class="text-slate-400 text-[11px]">
                                                {{ $qty }}x @ Rp {{ number_format($pkg->effective_price, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        <span class="font-black text-slate-900 text-sm">
                                            Rp {{ number_format($pkg->effective_price * $qty, 0, ',', '.') }}
                                        </span>
                                    </div>
                                @endif
                            @endforeach

                            <!-- Selected AddOns -->
                            @if($addons)
                                @foreach($addons as $addon)
                                    @php $qty = $addon_quantities[$addon->id] ?? 0; @endphp
                                    @if($qty > 0)
                                        <div class="p-3.5 flex justify-between items-center text-xs bg-slate-50/50">
                                            <div>
                                                <strong class="text-slate-800 block font-bold">
                                                    {{ $locale === 'en' && $addon->name_en ? $addon->name_en : $addon->name }}
                                                </strong>
                                                <span class="text-slate-400 text-[11px]">
                                                    {{ $qty }}x Sewa @ Rp {{ number_format($addon->price, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <span class="font-black text-slate-900 text-sm">
                                                Rp {{ number_format($addon->price * $qty, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                            <!-- Applied Promo Discount -->
                            @if($appliedPromo)
                                <div class="p-3.5 flex justify-between items-center text-xs bg-emerald-50 text-emerald-700 font-bold">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                        <span>{{ $locale === 'id' ? 'Diskon Voucher Promo (' . $appliedPromo->code . ')' : 'Promo Discount (' . $appliedPromo->code . ')' }}</span>
                                    </div>
                                    <span class="font-black text-sm">
                                        - Rp {{ number_format($this->discountAmount, 0, ',', '.') }}
                                    </span>
                                </div>
                            @endif

                            <!-- Grand Total Box -->
                            <div class="p-4 bg-aqua-navy text-white flex justify-between items-center">
                                <div>
                                    <span class="text-[10px] font-black uppercase text-aqua-gold tracking-widest block">
                                        {{ $locale === 'id' ? 'TOTAL AKHIR DIBAYAR' : 'TOTAL AMOUNT TO PAY' }}
                                    </span>
                                    <span class="text-[11px] text-white/50 font-medium">
                                        {{ $locale === 'id' ? 'Tanpa Biaya Tersembunyi' : 'No Hidden Convenience Fees' }}
                                    </span>
                                </div>
                                <span class="text-2xl font-black text-aqua-gold tracking-tight">
                                    Rp {{ number_format($this->totalPrice, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Modal Actions Footer -->
                <div class="pt-4 border-t border-slate-100 flex flex-col-reverse sm:flex-row items-center justify-end gap-3 shrink-0">
                    <button type="button" 
                            wire:click="closeConfirmationModal"
                            class="w-full sm:w-auto px-6 py-3.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 font-bold text-xs uppercase tracking-wider transition-colors">
                        {{ $locale === 'id' ? 'Ubah Pesanan' : 'Edit Order' }}
                    </button>
                    <button type="button"
                            wire:click="submit"
                            wire:loading.attr="disabled"
                            class="w-full sm:w-auto bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-black text-xs uppercase px-8 py-3.5 rounded-xl transition-all shadow-lg hover:shadow-amber-500/20 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2 tracking-wider">
                        <span wire:loading.remove wire:target="submit">
                            {{ $locale === 'id' ? 'Lanjut ke Pembayaran DOKU' : 'Proceed to DOKU Payment' }} &rarr;
                        </span>
                        <span wire:loading wire:target="submit" class="inline-flex items-center gap-2">
                            <svg class="animate-spin -ml-1 mr-1 h-4 w-4 text-slate-950" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            {{ $locale === 'id' ? 'Mengarahkan ke DOKU...' : 'Connecting to DOKU...' }}
                        </span>
                    </button>
                </div>

            </div>
        </div>
    </div>
    @endif

    <!-- Modal: Info Fasilitas & Syarat Ketentuan Gelang Tiket (Waterbom Bali Style) -->
    <div x-show="activeTermsModal !== null" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-aqua-navy/70 backdrop-blur-sm">
        
        <div @click.away="activeTermsModal = null" 
             x-show="activeTermsModal !== null"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-white rounded-3xl max-w-lg w-full max-h-[90vh] flex flex-col shadow-2xl border border-aqua-gold/30 overflow-hidden">
            
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-aqua-navy text-white flex items-center justify-between border-b border-aqua-gold/20">
                <div class="flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-xl bg-aqua-gold/20 text-aqua-gold flex items-center justify-center font-black text-sm">i</span>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-aqua-gold">Informasi Gelang Pass</span>
                        <h4 class="font-black text-base leading-tight" x-text="activeTermsName"></h4>
                    </div>
                </div>
                <button type="button" @click="activeTermsModal = null" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center font-bold text-lg transition-colors cursor-pointer">
                    &times;
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto space-y-5 text-slate-600 text-xs md:text-sm leading-relaxed">
                <!-- Fasilitas & Akses Termasuk (Checklist Centang) -->
                <div x-show="Array.isArray($data.activeTermsBenefits) && $data.activeTermsBenefits.length > 0">
                    <div class="flex items-center justify-between mb-3">
                        <h5 class="font-black text-aqua-navy text-xs uppercase tracking-wider flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span>{{ $locale === 'en' ? 'Included Benefits & Access' : 'Fasilitas & Akses Termasuk' }}</span>
                        </h5>
                        <span class="text-[10px] font-black uppercase text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-2.5 py-0.5 rounded-full tracking-wider" x-text="(Array.isArray($data.activeTermsBenefits) ? $data.activeTermsBenefits.length : 0) + ' {{ $locale === 'en' ? 'Benefits' : 'Fasilitas' }}'"></span>
                    </div>

                    <!-- Checklist Cards with Centang -->
                    <div class="space-y-2">
                        <template x-for="(benefit, bIdx) in (Array.isArray($data.activeTermsBenefits) ? $data.activeTermsBenefits : [])" :key="bIdx">
                            <div class="flex items-start gap-3 p-3 rounded-2xl border transition-all"
                                 :class="benefit.toLowerCase().includes('hemat') || benefit.toLowerCase().includes('save') 
                                         ? 'bg-amber-50/80 border-amber-200 text-amber-950 shadow-xs' 
                                         : 'bg-slate-50 border-slate-200/80 text-slate-800'">
                                <div class="w-5 h-5 rounded-full flex items-center justify-center shrink-0 shadow-xs mt-0.5"
                                     :class="benefit.toLowerCase().includes('hemat') || benefit.toLowerCase().includes('save') 
                                             ? 'bg-amber-500 text-white' 
                                             : 'bg-emerald-500 text-white'">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <span class="text-xs md:text-sm font-bold leading-snug flex-1" x-text="benefit"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Fallback jika array kosong tapi ada deskripsi teks -->
                <div x-show="(!Array.isArray($data.activeTermsBenefits) || $data.activeTermsBenefits.length === 0) && activeTermsDesc">
                    <h5 class="font-black text-aqua-navy text-xs uppercase tracking-wider mb-2">Fasilitas & Akses Termasuk</h5>
                    <div class="p-3.5 bg-aqua-cream rounded-2xl border border-aqua-gold/20 font-semibold text-slate-700 text-xs md:text-sm" x-text="activeTermsDesc"></div>
                </div>

                <div>
                    <h5 class="font-black text-aqua-navy text-xs uppercase tracking-wider mb-2">Syarat & Ketentuan Tiket</h5>
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 text-slate-600 space-y-2 prose prose-sm max-w-none text-xs leading-relaxed" x-html="activeTermsHtml"></div>
                </div>

                <div class="p-3.5 rounded-2xl bg-blue-50 border border-blue-200 flex items-start gap-3">
                    <span class="text-blue-600 text-base shrink-0">🎫</span>
                    <p class="text-[11px] text-blue-900 leading-relaxed font-semibold">
                        <strong>Info Pengambilan Gelang:</strong> E-tiket ber-barcode yang dikirim ke email Anda dapat langsung ditukarkan dengan gelang fisik di loket tiket saat kedatangan di Aquaboom.
                    </p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end">
                <button type="button" @click="activeTermsModal = null" class="px-6 py-2.5 rounded-xl bg-aqua-navy hover:bg-aqua-navy-2 text-white font-black text-xs uppercase tracking-wider transition-colors shadow-sm cursor-pointer">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</form>

@script
<script>
    $wire.on('open-doku-popup', (data) => {
        const payload = Array.isArray(data) ? data[0] : data;
        const paymentUrl = payload?.paymentUrl || (payload && payload[0]?.paymentUrl);
        
        if (paymentUrl) {
            window.dispatchEvent(new CustomEvent('hide-chat-assistant'));
            document.body.classList.add('overflow-hidden');

            // Remove any stale Jokul modal instance to prevent duplicate IDs and event blocking
            const existingModal = document.getElementById('jokul_checkout_modal');
            if (existingModal) {
                existingModal.remove();
            }

            if (typeof loadJokulCheckout === 'function') {
                loadJokulCheckout(paymentUrl);

                // Enhance iframe with proper permissions policy and scroll attributes
                setTimeout(() => {
                    const iframe = document.querySelector('#jokul_checkout_modal iframe');
                    if (iframe) {
                        iframe.setAttribute('allow', 'payment');
                        iframe.setAttribute('scrolling', 'yes');
                    }
                }, 50);
            } else {
                window.location.href = paymentUrl;
            }
        }
    });

    // Listen to DOKU close message to clean up backdrop and restore UI state
    window.addEventListener('message', (event) => {
        if (event.data && (event.data.func === 'closeJokul' || event.data.status === 'close')) {
            document.body.classList.remove('overflow-hidden');
            window.dispatchEvent(new CustomEvent('show-chat-assistant'));
            const modal = document.getElementById('jokul_checkout_modal');
            if (modal) {
                modal.remove();
            }
        }
    });
</script>
@endscript
