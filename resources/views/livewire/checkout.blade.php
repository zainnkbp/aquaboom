<form wire:submit.prevent="openConfirmationModal" class="flex flex-col h-full bg-white font-sans">
    
    <!-- Top Bar -->
    <div class="px-4 md:px-10 py-4 bg-aqua-navy text-white flex justify-between items-center border-b border-aqua-gold/20">
        <span class="text-sm font-black tracking-widest uppercase">
            {{ $locale === 'id' ? 'FORMULIR PEMESANAN TIKET' : 'TICKET BOOKING FORM' }}
        </span>
    </div>

    <!-- Step 1: Visit Date -->
    <div id="step-1-date" class="px-4 md:px-10 py-8 bg-aqua-cream border-b border-slate-100 scroll-mt-24">
        <div class="max-w-5xl mx-auto">
            <div class="flex items-center gap-3 mb-6">
                <div class="h-px w-8 bg-aqua-gold"></div>
                <span class="text-aqua-gold text-xs font-black uppercase tracking-[0.2em]">Step 1</span>
                <span class="text-aqua-navy text-sm font-black uppercase tracking-wide">
                    {{ $locale === 'id' ? 'PILIH TANGGAL KUNJUNGAN' : 'SELECT VISIT DATE' }}
                </span>
            </div>
            
            <div class="flex items-center gap-4 overflow-x-auto pb-2 snap-x scrollbar-hide">
                <button type="button" 
                     wire:click="$set('visit_date', '{{ date('Y-m-d') }}')" 
                     @click="setTimeout(() => { document.getElementById('step-2-tickets')?.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 150)"
                     class="py-4 px-10 rounded-2xl cursor-pointer transition-all duration-300 whitespace-nowrap snap-start shrink-0 font-bold border-2
                     {{ $visit_date === date('Y-m-d') ? 'border-aqua-gold bg-aqua-navy text-white shadow-md' : 'bg-white border-slate-200 text-slate-500 hover:border-aqua-gold/50' }}">
                    {{ $locale === 'id' ? 'Hari Ini' : 'Today' }}
                </button>
                <button type="button" 
                     wire:click="$set('visit_date', '{{ date('Y-m-d', strtotime('+1 day')) }}')" 
                     @click="setTimeout(() => { document.getElementById('step-2-tickets')?.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 150)"
                     class="py-4 px-10 rounded-2xl cursor-pointer transition-all duration-300 whitespace-nowrap snap-start shrink-0 font-bold border-2
                     {{ $visit_date === date('Y-m-d', strtotime('+1 day')) ? 'border-aqua-gold bg-aqua-navy text-white shadow-md' : 'bg-white border-slate-200 text-slate-500 hover:border-aqua-gold/50' }}">
                    {{ $locale === 'id' ? 'Besok' : 'Tomorrow' }}
                </button>
                <div x-data @click="$refs.datePicker.showPicker()" 
                     class="relative py-4 px-10 rounded-2xl cursor-pointer transition-all duration-300 whitespace-nowrap flex items-center gap-3 snap-start shrink-0 font-bold border-2
                     {{ ($visit_date && $visit_date !== date('Y-m-d') && $visit_date !== date('Y-m-d', strtotime('+1 day'))) ? 'border-aqua-gold bg-aqua-navy text-white shadow-md' : 'bg-white border-slate-200 text-slate-500 hover:border-aqua-gold/50' }}">
                    <svg class="w-5 h-5 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>{{ ($visit_date && $visit_date !== date('Y-m-d') && $visit_date !== date('Y-m-d', strtotime('+1 day'))) ? \Carbon\Carbon::parse($visit_date)->format('d M Y') : ($locale === 'id' ? 'Tanggal Lain' : 'Other Date') }}</span>
                    <input x-ref="datePicker" type="date" wire:model.live="visit_date" 
                           @change="setTimeout(() => { document.getElementById('step-2-tickets')?.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 150)"
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+30 days')) }}" />
                </div>
            </div>
            @error('visit_date') <span class="text-red-500 text-sm mt-3 block font-semibold bg-red-50 p-4 rounded-2xl border border-red-100">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- Step 2: Choose Tickets (Premium Cards - Redesigned to be Big and Detailed) -->
    <div id="step-2-tickets" class="px-4 md:px-10 py-12 max-w-5xl mx-auto w-full scroll-mt-24">
        <div class="flex items-center gap-3 mb-8">
            <div class="h-px w-8 bg-aqua-gold"></div>
            <span class="text-aqua-gold text-xs font-black uppercase tracking-[0.2em]">Step 2</span>
            <span class="text-aqua-navy text-sm font-black uppercase tracking-wide">
                {{ $locale === 'id' ? 'PILIH JENIS TIKET' : 'SELECT TICKET TYPE' }}
            </span>
        </div>

        @if($packages->isEmpty())
            <div class="bg-white rounded-3xl p-16 text-center shadow-xl border border-slate-100">
                <p class="text-lg font-bold text-aqua-navy">
                    {{ $locale === 'id' ? 'Maaf, tidak ada tiket yang tersedia untuk tanggal ini.' : 'Sorry, no tickets are available for this date.' }}
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($packages as $pkg)
                    @php
                        $isWeekend = Str::contains(strtolower($pkg->name), 'weekend');
                        $isGroup = Str::contains(strtolower($pkg->name), 'group');
                        $isDuo = Str::contains(strtolower($pkg->name), 'duo');
                        $isFour = Str::contains(strtolower($pkg->name), 'four');
                        
                        // Dynamic pricing label
                        $pricingLabel = $locale === 'id' ? 'per orang' : 'per person';
                        if ($isDuo) {
                            $pricingLabel = $locale === 'id' ? 'per 2 orang' : 'per 2 people';
                        } elseif ($isFour) {
                            $pricingLabel = $locale === 'id' ? 'per 4 orang' : 'per 4 people';
                        } elseif ($isGroup) {
                            $pricingLabel = $locale === 'id' ? 'per orang (min. 10)' : 'per person (min. 10)';
                        }

                        // Dynamic header gradient (wristband colors)
                        $headerGradient = 'bg-gradient-to-br from-purple-600 to-indigo-700'; // Default / Weekday
                        if ($isDuo) {
                            $headerGradient = 'bg-gradient-to-br from-pink-500 to-rose-600'; // Duo Pass: Pink
                        } elseif ($isFour) {
                            $headerGradient = 'bg-gradient-to-br from-emerald-500 to-teal-600'; // Four Pack: Emerald
                        } elseif ($isWeekend) {
                            $headerGradient = 'bg-gradient-to-br from-cyan-500 to-blue-600'; // Weekend: Blue
                        } elseif ($isGroup) {
                            $headerGradient = 'bg-gradient-to-br from-orange-500 to-amber-600'; // Group: Orange
                        }
                        
                        $qty = $quantities[$pkg->id] ?? 0;
                    @endphp

                    <!-- Ticket Card -->
                    <div class="bg-white rounded-[28px] overflow-hidden shadow-xl border flex flex-col group hover:-translate-y-1 transition-all duration-300
                         {{ $isDuo ? 'border-pink-500/45 ring-2 ring-pink-500/10' : ($isFour ? 'border-emerald-500/45 ring-2 ring-emerald-500/10' : ($isWeekend ? 'border-blue-500/45 ring-2 ring-blue-500/10' : 'border-slate-200')) }}">
                        
                        <!-- Header Card (Exactly like Landing Page) -->
                        <div class="h-44 flex flex-col items-center justify-center p-6 relative overflow-hidden {{ $headerGradient }}">
                            
                            @if($isWeekend)
                                <div class="md:absolute md:top-4 md:right-4 bg-white text-aqua-navy text-[10px] font-black uppercase px-3 py-1 rounded-full tracking-widest mb-3 md:mb-0">
                                    {{ $locale === 'id' ? 'Paling Populer' : 'Most Popular' }}
                                </div>
                            @endif

                            <span class="text-xs font-black tracking-widest uppercase mb-1 text-white/80">
                                {{ $pkg->validity_type === 'weekday' ? 'Weekday' : ($pkg->validity_type === 'weekend' ? 'Weekend' : ($pkg->validity_type === 'all_days' ? ($locale === 'id' ? 'Setiap Hari' : 'Everyday') : 'Weekday')) }}
                            </span>

                            <!-- Clear Full Price text -->
                            <div class="text-4xl font-black tracking-tight text-white">
                                Rp {{ number_format($pkg->effective_price, 0, ',', '.') }}
                            </div>
                        </div>

                        <!-- Card Body (Beautiful features with Gold checkmarks) -->
                        <div class="p-8 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-black text-aqua-navy mb-4 uppercase">
                                    {{ $locale === 'en' && $pkg->name_en ? $pkg->name_en : $pkg->name }}
                                </h3>
                                
                                <div class="text-slate-600 text-sm font-semibold leading-relaxed mb-6 ticket-rich-description">
                                    {!! $locale === 'en' && $pkg->description_en ? $pkg->description_en : $pkg->description !!}
                                </div>

                                @if($pkg->terms_and_conditions)
                                    <!-- Accordion Terms & Conditions -->
                                    <div x-data="{ open: false }" class="mb-4">
                                        <button type="button" @click="open = !open" class="flex items-center gap-1.5 text-xs font-black text-aqua-azure hover:text-aqua-gold uppercase tracking-wider transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ $locale === 'id' ? 'Syarat & Ketentuan' : 'Terms & Conditions' }} <span x-text="open ? '▲' : '▼'"></span>
                                        </button>
                                        <div x-show="open" x-collapse style="display: none;" class="mt-3 p-4 bg-aqua-cream rounded-xl border border-aqua-gold/15 text-[11px] text-slate-600 font-semibold leading-relaxed">
                                            {!! $locale === 'en' && $pkg->terms_and_conditions_en ? $pkg->terms_and_conditions_en : $pkg->terms_and_conditions !!}
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Quantity Selection -->
                            <div class="mt-6 pt-4 border-t border-slate-100">
                                @if($qty === 0)
                                    <button type="button" 
                                        wire:click="incrementQuantity({{ $pkg->id }})" 
                                        @click="setTimeout(() => { document.getElementById('step-3-addons')?.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 200)"
                                        class="w-full text-center py-4 rounded-xl font-black text-sm uppercase tracking-wider transition-all border-2
                                        {{ $isWeekend ? 'bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy border-aqua-gold' : ($isGroup ? 'bg-aqua-azure hover:bg-aqua-azure-2 text-white border-aqua-azure' : 'bg-aqua-navy hover:bg-aqua-navy-2 text-white border-aqua-navy') }}">
                                        {{ $locale === 'id' ? 'Pilih Tiket' : 'Select Ticket' }}
                                    </button>
                                @else
                                    <div class="flex items-center justify-between bg-aqua-cream rounded-xl p-2 border border-aqua-gold/20">
                                        <button type="button" wire:click="decrementQuantity({{ $pkg->id }})" 
                                            class="w-10 h-10 rounded-lg flex items-center justify-center bg-white text-aqua-navy hover:bg-slate-100 shadow-sm font-black text-xl transition-all">
                                            -
                                        </button>
                                        <span class="text-base font-black text-aqua-navy w-8 text-center">{{ $qty }}</span>
                                        <button type="button" wire:click="incrementQuantity({{ $pkg->id }})" 
                                            class="w-10 h-10 rounded-lg flex items-center justify-center bg-aqua-navy text-aqua-gold hover:bg-aqua-navy-2 shadow-sm font-black text-xl transition-all">
                                            +
                                        </button>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            @error('quantities') <span class="text-red-500 text-sm mt-3 block font-semibold bg-red-50 p-4 rounded-2xl border border-red-100">{{ $message }}</span> @enderror
        @endif
    </div>

    <!-- Step 3: Add-Ons (Optional Facilities like Gazebos, Tubes, Lockers) -->
    <div id="step-3-addons" class="px-4 md:px-10 py-12 bg-aqua-cream border-t border-b border-slate-100 scroll-mt-24">
        <div class="max-w-5xl mx-auto">
            <div class="flex items-center gap-3 mb-8">
                <div class="h-px w-8 bg-aqua-gold"></div>
                <span class="text-aqua-gold text-xs font-black uppercase tracking-[0.2em]">Step 3</span>
                <span class="text-aqua-navy text-sm font-black uppercase tracking-wide">
                    {{ $locale === 'id' ? 'FASILITAS TAMBAHAN (OPSIONAL)' : 'ADDITIONAL FACILITIES (OPTIONAL)' }}
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($addons as $addon)
                    @php
                        $addonQty = $addon_quantities[$addon->id] ?? 0;
                    @endphp
                    <!-- Add-On Row -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-200/60 shadow-sm flex flex-col sm:flex-row items-center sm:items-start gap-4 sm:gap-6">
                        <img src="{{ $addon->image_url }}" alt="{{ $addon->name }}" onerror="this.onerror=null; this.src='{{ asset('assets/img/default-addon.svg') }}';" class="w-full sm:w-24 h-48 sm:h-24 rounded-2xl object-cover ring-1 ring-aqua-gold/20 shrink-0" />
                        <div class="flex-1 flex flex-col justify-between w-full min-h-[96px]">
                            <div>
                                <h4 class="font-black text-aqua-navy text-base uppercase leading-tight">
                                    {{ $locale === 'en' && $addon->name_en ? $addon->name_en : $addon->name }}
                                </h4>
                                <p class="text-slate-500 text-[11px] font-semibold leading-relaxed line-clamp-2 mt-1">
                                    {!! strip_tags($locale === 'en' && $addon->description_en ? $addon->description_en : $addon->description) !!}
                                </p>
                            </div>
                            
                            <div class="flex items-center justify-between mt-3 pt-3 border-t border-slate-50">
                                <span class="text-sm font-black text-aqua-gold">Rp {{ number_format($addon->price, 0, ',', '.') }}</span>
                                
                                <div class="flex items-center bg-slate-50 rounded-lg p-1 border border-slate-200/60 scale-90 origin-right">
                                    <button type="button" wire:click="decrementAddonQuantity({{ $addon->id }})" class="w-8 h-8 rounded bg-white text-aqua-navy hover:bg-slate-100 shadow-sm font-bold text-sm">-</button>
                                    <span class="text-xs font-black text-aqua-navy w-6 text-center">{{ $addonQty }}</span>
                                    <button type="button" wire:click="incrementAddonQuantity({{ $addon->id }})" class="w-8 h-8 rounded bg-aqua-navy text-aqua-gold hover:bg-aqua-navy-2 shadow-sm font-bold text-sm">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Quick Action to Continue to Step 4 -->
            <div class="mt-8 flex justify-end">
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
    <div id="step-4-contact" class="px-4 md:px-10 py-12 max-w-5xl mx-auto w-full scroll-mt-24">
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
                <input type="text" wire:model="customer_name" id="name" class="block w-full px-5 py-4 rounded-2xl border border-slate-200 bg-white text-aqua-navy focus:outline-none focus:border-aqua-gold focus:ring-2 focus:ring-aqua-gold/20 transition-all text-base font-semibold placeholder-slate-400" placeholder="e.g. John Doe" required />
                @error('customer_name') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-xs font-black text-aqua-navy uppercase tracking-widest mb-3">
                        {{ $locale === 'id' ? 'Alamat Email' : 'Email Address' }}
                    </label>
                    <input type="email" wire:model="customer_email" id="email" class="block w-full px-5 py-4 rounded-2xl border border-slate-200 bg-white text-aqua-navy focus:outline-none focus:border-aqua-gold focus:ring-2 focus:ring-aqua-gold/20 transition-all text-base font-semibold placeholder-slate-400" placeholder="e.g. john@example.com" required />
                    @error('customer_email') <span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="phone" class="block text-xs font-black text-aqua-navy uppercase tracking-widest mb-3">
                        {{ $locale === 'id' ? 'Nomor WhatsApp' : 'WhatsApp Number' }}
                    </label>
                    <input type="tel" wire:model="customer_phone" id="phone" class="block w-full px-5 py-4 rounded-2xl border border-slate-200 bg-white text-aqua-navy focus:outline-none focus:border-aqua-gold focus:ring-2 focus:ring-aqua-gold/20 transition-all text-base font-semibold placeholder-slate-400" placeholder="e.g. 08123456789" required />
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
                    <input type="text" wire:model="promo_code" wire:keydown.enter.prevent="applyPromo" class="flex-1 w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-white text-aqua-navy focus:outline-none focus:border-aqua-gold transition-all text-sm font-black uppercase placeholder-slate-400" placeholder="{{ $locale === 'id' ? 'Masukkan Kode Promo' : 'Enter Promo Code' }}">
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
        <div x-data="{ termsModalOpen: false, termsAccepted: @entangle('termsAccepted') }" class="mb-12">
            <div @click="termsModalOpen = true" class="flex items-start gap-4 bg-aqua-cream/50 p-6 rounded-[24px] border border-aqua-gold/10 cursor-pointer hover:bg-aqua-cream transition-colors">
                <div class="relative flex items-start pt-1">
                    <input type="checkbox" 
                        @click.prevent
                        class="w-6 h-6 rounded-md border-aqua-gold/30 text-aqua-navy focus:ring-aqua-gold cursor-pointer transition-colors bg-white border-2" 
                        id="terms_checkbox"
                        :checked="termsAccepted">
                </div>
                <div class="text-xs font-semibold text-slate-600 leading-relaxed select-none">
                    @if($locale === 'id')
                        Saya menyetujui <span class="text-aqua-azure font-black hover:text-aqua-gold transition-all uppercase underline">Syarat & Ketentuan</span> serta <span class="text-aqua-azure font-black hover:text-aqua-gold transition-all uppercase underline">Kebijakan Privasi</span> yang berlaku di Aquaboom Waterpark.
                    @else
                        I agree to the <span class="text-aqua-azure font-black hover:text-aqua-gold transition-all uppercase underline">Terms & Conditions</span> and <span class="text-aqua-azure font-black hover:text-aqua-gold transition-all uppercase underline">Privacy Policy</span> governing Aquaboom Waterpark.
                    @endif
                </div>
            </div>
            
            <!-- S&K Modal Pop-up -->
            <div x-show="termsModalOpen" @click.stop style="display: none;" class="fixed inset-0 z-[200] flex items-center justify-center px-4">
                <div x-show="termsModalOpen" x-transition.opacity @click="termsModalOpen = false" class="absolute inset-0 bg-aqua-navy/60 backdrop-blur-sm"></div>
                <div x-show="termsModalOpen" x-transition class="relative bg-white w-full max-w-2xl rounded-[32px] shadow-2xl p-8 md:p-10 max-h-[80vh] flex flex-col border border-aqua-gold/20">
                    <button type="button" @click="termsModalOpen = false" class="absolute top-6 right-6 text-slate-400 hover:text-slate-800 bg-slate-100 rounded-full p-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    
                    <h4 class="text-xl font-black text-aqua-navy uppercase mb-6 pb-4 border-b border-slate-100 flex items-center gap-3">
                        <svg class="w-6 h-6 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        {{ $locale === 'id' ? 'Syarat & Ketentuan Aquaboom' : 'Aquaboom Terms & Conditions' }}
                    </h4>
                    
                    <div class="flex-1 overflow-y-auto pr-2 text-sm text-slate-600 leading-relaxed font-semibold mb-6 space-y-6">
                        <div>
                            <h5 class="font-black text-aqua-navy uppercase text-xs mb-2">1. {{ $locale === 'id' ? 'Ketentuan Umum' : 'General Rules' }}</h5>
                            <p class="text-xs">
                                {{ $locale === 'id' 
                                    ? 'Pengunjung wajib mengikuti seluruh peraturan keselamatan dan instruksi penjaga kolam (Lifeguard). Semua transaksi yang sudah dibayar tidak dapat dibatalkan atau di-refund.' 
                                    : 'Visitors must follow all safety rules and instructions from lifeguards. All transactions once paid are non-refundable and cannot be cancelled.' 
                                }}
                            </p>
                        </div>
                        
                        @php $hasSelectedTerms = false; @endphp
                        @foreach($packages as $pkg)
                            @if(($quantities[$pkg->id] ?? 0) > 0 && ($pkg->terms_and_conditions || $pkg->terms_and_conditions_en))
                                @php $hasSelectedTerms = true; @endphp
                                <div>
                                    <h5 class="font-black text-aqua-navy uppercase text-xs mb-2">
                                        {{ $locale === 'en' && $pkg->name_en ? $pkg->name_en : $pkg->name }}
                                    </h5>
                                    <div class="text-xs font-semibold leading-relaxed border-l-2 border-aqua-gold/30 pl-3">
                                        {!! $locale === 'en' && $pkg->terms_and_conditions_en ? $pkg->terms_and_conditions_en : $pkg->terms_and_conditions !!}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                        @if(!$hasSelectedTerms)
                            <p class="text-xs text-slate-400 italic">
                                {{ $locale === 'id' ? '* Silakan pilih tiket terlebih dahulu di atas untuk melihat detail syarat spesifik tiket.' : '* Please select tickets above to load specific ticket policies.' }}
                            </p>
                        @endif
                    </div>
                    
                    <button type="button" 
                        @click="termsAccepted = true; @this.set('termsAccepted', true); termsModalOpen = false;" 
                        class="w-full bg-aqua-navy hover:bg-aqua-navy-2 text-aqua-gold font-black py-4 rounded-xl text-sm uppercase tracking-wider transition-all shadow-md">
                        {{ $locale === 'id' ? 'Saya Membaca & Menyetujui' : 'I Read & Agree' }}
                    </button>
                </div>
            </div>
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

    <!-- Modal Konfirmasi Pembayaran & Ringkasan Transparan -->
    @if($showConfirmationModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 md:p-6 bg-slate-950/80 backdrop-blur-md overflow-y-auto"
             x-data
             @keydown.escape.window="$wire.closeConfirmationModal()">
            <div class="bg-white rounded-[32px] max-w-2xl w-full p-6 md:p-8 shadow-2xl border border-slate-100 relative my-auto max-h-[92vh] flex flex-col overflow-hidden animate-in fade-in zoom-in-95 duration-200"
                 @click.away="$wire.closeConfirmationModal()">
                
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
                    
                    <!-- Secure Payment Indicator Banner -->
                    <div class="bg-gradient-to-r from-emerald-50 via-teal-50 to-emerald-50 border border-emerald-200/80 rounded-2xl p-4 flex items-center gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <div class="text-xs">
                            <div class="font-black text-emerald-950 uppercase tracking-wide flex items-center gap-2">
                                <span>{{ $locale === 'id' ? 'Pembayaran 100% Aman & Terenkripsi' : '100% Secure & Encrypted Payment' }}</span>
                                <span class="bg-emerald-200/70 text-emerald-900 text-[10px] px-2 py-0.5 rounded-full font-black">256-Bit SSL</span>
                            </div>
                            <p class="text-emerald-800/80 font-medium mt-0.5">
                                {{ $locale === 'id' 
                                    ? 'Diproses langsung melalui DOKU Payment Gateway resmi berlisensi Bank Indonesia.' 
                                    : 'Processed directly via DOKU Payment Gateway licensed by Bank Indonesia.' 
                                }}
                            </p>
                        </div>
                    </div>

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

                    <!-- Supported Payment Channels Preview -->
                    <div>
                        <div class="text-[11px] font-black uppercase text-slate-400 tracking-wider mb-2">
                            {{ $locale === 'id' ? 'Metode Pembayaran Tersedia di DOKU:' : 'Available Payment Methods in DOKU:' }}
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-center text-xs">
                            <div class="bg-slate-50 border border-slate-200/80 rounded-xl p-2.5 flex flex-col items-center justify-center gap-1">
                                <span class="font-black text-slate-800 text-[11px]">Virtual Account</span>
                                <span class="text-[10px] text-slate-500 font-semibold leading-tight">BCA, Mandiri, BRI, BNI, Maybank, Permata</span>
                            </div>
                            <div class="bg-slate-50 border border-slate-200/80 rounded-xl p-2.5 flex flex-col items-center justify-center gap-1">
                                <span class="font-black text-slate-800 text-[11px]">QRIS & E-Wallet</span>
                                <span class="text-[10px] text-slate-500 font-semibold leading-tight">QRIS All Bank, GoPay, OVO, ShopeePay, Dana</span>
                            </div>
                            <div class="bg-slate-50 border border-slate-200/80 rounded-xl p-2.5 flex flex-col items-center justify-center gap-1">
                                <span class="font-black text-slate-800 text-[11px]">Kartu Kredit/Debit</span>
                                <span class="text-[10px] text-slate-500 font-semibold leading-tight">Visa, Mastercard, JCB</span>
                            </div>
                            <div class="bg-slate-50 border border-slate-200/80 rounded-xl p-2.5 flex flex-col items-center justify-center gap-1">
                                <span class="font-black text-slate-800 text-[11px]">Gerai Retail</span>
                                <span class="text-[10px] text-slate-500 font-semibold leading-tight">Indomaret, Alfamart</span>
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
    @endif
</form>
