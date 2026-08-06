<form wire:submit="submit" class="flex flex-col h-full bg-white overflow-hidden font-outfit">
    <!-- Header -->
    <div class="px-6 md:px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-white relative z-20 shadow-sm">
        <div>
            <h2 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight">Tickets & Pricing</h2>
            <p class="text-xs font-medium text-slate-500 mt-0.5">Selesaikan pemesanan tiket Anda</p>
        </div>
        <button
            type="button"
            @click="isBookingOpen = false"
            class="text-slate-400 hover:text-pink-500 transition-colors bg-slate-50 p-2.5 rounded-full hover:bg-pink-50"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <div class="px-6 md:px-8 py-6 overflow-y-auto flex-1 relative z-10 space-y-8 bg-slate-50/50">
        
        <!-- Langkah 1: Tanggal Kunjungan -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-slate-800 to-slate-900 text-white flex items-center justify-center text-xs font-bold shadow-md">1</div>
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Tanggal Kunjungan</h3>
            </div>
            
            <div class="flex items-center gap-3 overflow-x-auto pb-2 text-sm font-bold snap-x scrollbar-hide">
                <div wire:click="$set('visit_date', '{{ date('Y-m-d') }}')" class="py-2.5 px-6 rounded-xl border cursor-pointer transition-all duration-300 whitespace-nowrap snap-start shrink-0 {{ $visit_date === date('Y-m-d') ? 'border-transparent bg-slate-900 text-white shadow-lg shadow-slate-900/20' : 'border-slate-200 hover:border-slate-300 bg-white text-slate-700 hover:shadow-sm' }}">
                    Hari Ini
                </div>
                <div wire:click="$set('visit_date', '{{ date('Y-m-d', strtotime('+1 day')) }}')" class="py-2.5 px-6 rounded-xl border cursor-pointer transition-all duration-300 whitespace-nowrap snap-start shrink-0 {{ $visit_date === date('Y-m-d', strtotime('+1 day')) ? 'border-transparent bg-slate-900 text-white shadow-lg shadow-slate-900/20' : 'border-slate-200 hover:border-slate-300 bg-white text-slate-700 hover:shadow-sm' }}">
                    Besok
                </div>
                <div x-data @click="$refs.datePicker.showPicker()" class="relative py-2.5 px-6 rounded-xl border cursor-pointer transition-all duration-300 whitespace-nowrap flex items-center gap-2 snap-start shrink-0 {{ ($visit_date && $visit_date !== date('Y-m-d') && $visit_date !== date('Y-m-d', strtotime('+1 day'))) ? 'border-transparent bg-slate-900 text-white shadow-lg shadow-slate-900/20' : 'border-slate-200 hover:border-slate-300 bg-white text-slate-700 hover:shadow-sm' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>{{ ($visit_date && $visit_date !== date('Y-m-d') && $visit_date !== date('Y-m-d', strtotime('+1 day'))) ? \Carbon\Carbon::parse($visit_date)->format('d M Y') : 'Pilih Tanggal' }}</span>
                    <input x-ref="datePicker" type="date" wire:model.live="visit_date" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+30 days')) }}" />
                </div>
            </div>
            @error('visit_date') <span class="text-red-500 text-xs font-medium mt-2 block">{{ $message }}</span> @enderror
        </div>

        <!-- Langkah 2: Paket Tiket (Accordion Luxury Style) -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-slate-800 to-slate-900 text-white flex items-center justify-center text-xs font-bold shadow-md">2</div>
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Pilih Paket</h3>
            </div>
            
            @if($packages->isEmpty())
                <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 text-center">
                    <p class="text-sm font-medium text-slate-500">Mohon maaf, tidak ada tiket yang tersedia untuk tanggal kunjungan ini.</p>
                </div>
            @else
                <div class="space-y-4" x-data="{ activeAccordion: {{ $ticket_package_id ?? 'null' }} }">
                    @foreach($packages as $pkg)
                    <div 
                        class="relative rounded-2xl overflow-hidden transition-all duration-300 border bg-white"
                        :class="activeAccordion === {{ $pkg->id }} ? 'border-pink-500 ring-4 ring-pink-50 shadow-md' : 'border-slate-200 hover:border-slate-300 hover:shadow-sm'"
                    >
                        <!-- Accordion Header -->
                        <div 
                            @click="activeAccordion = {{ $pkg->id }}; $wire.set('ticket_package_id', {{ $pkg->id }})"
                            class="p-5 cursor-pointer flex justify-between items-center group"
                        >
                            <div class="flex-1 pr-4">
                                <h4 class="font-black text-slate-900 text-lg uppercase tracking-wide group-hover:text-pink-600 transition-colors">{{ $pkg->name }}</h4>
                                <div class="mt-1 flex items-baseline gap-2">
                                    <span class="text-sm text-slate-500 font-medium">Mulai dari</span>
                                    <span class="text-xl font-black text-slate-900 tracking-tight">Rp {{ number_format($pkg->effective_price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            
                            <!-- Toggle Button / Icon -->
                            <div class="flex flex-col items-center justify-center w-24 gap-2 shrink-0 border-l border-slate-100 pl-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider" x-text="activeAccordion === {{ $pkg->id }} ? 'Terpilih' : 'Pilih'"></span>
                                <div class="w-8 h-8 rounded-full border flex items-center justify-center transition-all duration-300"
                                    :class="activeAccordion === {{ $pkg->id }} ? 'border-pink-500 bg-pink-500 text-white shadow-[0_4px_10px_rgba(236,72,153,0.4)]' : 'border-slate-300 text-slate-400 group-hover:border-pink-300 group-hover:text-pink-400'">
                                    <svg x-show="activeAccordion !== {{ $pkg->id }}" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                    <svg x-show="activeAccordion === {{ $pkg->id }}" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Accordion Content -->
                        <div 
                            x-show="activeAccordion === {{ $pkg->id }}"
                            x-collapse
                            x-cloak
                            class="bg-slate-50/50 border-t border-slate-100"
                        >
                            <div class="p-5">
                                <div class="flex gap-4">
                                    <!-- Info modal trigger -->
                                    <div class="flex-1 text-sm text-slate-600 font-medium leading-relaxed">
                                        {{ $pkg->description }}
                                        
                                        @if($pkg->terms_and_conditions)
                                        <div class="mt-3">
                                            <button type="button" @click="$dispatch('open-tnc-modal', { id: {{ $pkg->id }}, title: '{{ addslashes($pkg->name) }}', content: `{{ addslashes($pkg->terms_and_conditions) }}` })" class="inline-flex items-center gap-1.5 text-xs font-bold text-pink-600 hover:text-pink-700 transition-colors bg-pink-50 px-3 py-1.5 rounded-full">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Lihat Syarat & Ketentuan
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Quantity Selector -->
                                <div class="mt-5 pt-5 border-t border-slate-200/60 flex justify-between items-center">
                                    <div>
                                        <span class="block text-sm font-black text-slate-900">Jumlah Tiket</span>
                                        <span class="text-xs font-medium text-slate-500">Maks. 20 tiket per transaksi</span>
                                    </div>
                                    <div class="flex items-center space-x-3 bg-white shadow-sm rounded-full border border-slate-200 p-1">
                                        <button type="button" wire:click="decrementQuantity" class="w-9 h-9 rounded-full flex items-center justify-center hover:bg-slate-100 text-slate-700 font-bold transition text-lg">-</button>
                                        <span class="text-base font-black text-slate-900 w-6 text-center">{{ $quantity }}</span>
                                        <button type="button" wire:click="incrementQuantity" class="w-9 h-9 rounded-full flex items-center justify-center bg-slate-900 hover:bg-slate-800 text-white shadow-md transition text-lg">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @error('ticket_package_id') <span class="text-red-500 text-xs font-medium mt-3 block">{{ $message }}</span> @enderror
            @endif
        </div>

        <!-- Langkah 3: Data Pemesan (Floating Label Luxury) -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-slate-800 to-slate-900 text-white flex items-center justify-center text-xs font-bold shadow-md">3</div>
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Data Pemesan</h3>
            </div>
            
            <div class="space-y-4">
                <div class="relative">
                    <input type="text" wire:model="customer_name" id="name" class="block rounded-xl px-4 pb-2.5 pt-6 w-full text-sm font-medium text-slate-900 bg-slate-50 border border-slate-200 focus:bg-white focus:border-pink-500 focus:ring-1 focus:ring-pink-500 appearance-none peer transition-all shadow-inner" placeholder=" " required />
                    <label for="name" class="absolute text-xs text-slate-500 duration-300 transform -translate-y-3 scale-75 top-4 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-3 font-bold uppercase tracking-wide">Nama Lengkap</label>
                    @error('customer_name') <span class="text-red-500 text-xs font-medium mt-1.5 block px-1">{{ $message }}</span> @enderror
                </div>
                <div class="relative">
                    <input type="email" wire:model="customer_email" id="email" class="block rounded-xl px-4 pb-2.5 pt-6 w-full text-sm font-medium text-slate-900 bg-slate-50 border border-slate-200 focus:bg-white focus:border-pink-500 focus:ring-1 focus:ring-pink-500 appearance-none peer transition-all shadow-inner" placeholder=" " required />
                    <label for="email" class="absolute text-xs text-slate-500 duration-300 transform -translate-y-3 scale-75 top-4 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-3 font-bold uppercase tracking-wide">Alamat Email</label>
                    @error('customer_email') <span class="text-red-500 text-xs font-medium mt-1.5 block px-1">{{ $message }}</span> @enderror
                </div>
                <div class="relative">
                    <input type="tel" wire:model="customer_phone" id="phone" class="block rounded-xl px-4 pb-2.5 pt-6 w-full text-sm font-medium text-slate-900 bg-slate-50 border border-slate-200 focus:bg-white focus:border-pink-500 focus:ring-1 focus:ring-pink-500 appearance-none peer transition-all shadow-inner" placeholder=" " required />
                    <label for="phone" class="absolute text-xs text-slate-500 duration-300 transform -translate-y-3 scale-75 top-4 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-3 font-bold uppercase tracking-wide">No. WhatsApp Aktif</label>
                    @error('customer_phone') <span class="text-red-500 text-xs font-medium mt-1.5 block px-1">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Langkah 4: Kode Voucher (Opsional) -->
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 pb-8">
            <h3 class="text-xs font-bold text-slate-500 mb-3 uppercase tracking-wide flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                Punya Kode Promo?
            </h3>
            @if($appliedPromo)
                <div class="flex justify-between items-center bg-green-50/50 border border-green-100 px-4 py-3 rounded-xl shadow-inner">
                    <div class="flex items-center gap-2 text-green-700 font-bold text-xs uppercase tracking-wide">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Dipakai: {{ $appliedPromo->code }}
                    </div>
                    <button type="button" wire:click="removePromo" class="text-slate-400 hover:text-red-500 text-xs font-bold transition-colors">HAPUS</button>
                </div>
            @else
                <div class="flex gap-2">
                    <input type="text" wire:model="promo_code" wire:keydown.enter.prevent="applyPromo" class="flex-1 rounded-xl px-4 py-2.5 text-sm font-black uppercase tracking-wider text-slate-800 bg-slate-50 border border-slate-200 focus:bg-white focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition-all shadow-inner" placeholder="Masukkan Kode">
                    <button type="button" wire:click="applyPromo" wire:loading.attr="disabled" wire:target="applyPromo" class="bg-gradient-to-r from-slate-800 to-slate-900 text-white px-6 py-2.5 rounded-xl font-bold text-xs hover:shadow-lg transition-all disabled:opacity-50 tracking-wide">
                        <span wire:loading.remove wire:target="applyPromo">TERAPKAN</span>
                        <span wire:loading wire:target="applyPromo">...</span>
                    </button>
                </div>
                @if($promoError)
                    <span class="text-red-500 text-[10px] font-bold mt-2 block px-1 uppercase tracking-wide">{{ $promoError }}</span>
                @endif
            @endif
        </div>
    </div>

    <!-- Sticky Ultra-Compact Footer (Luxury Glass) -->
    <div class="p-5 bg-white/90 backdrop-blur-xl border-t border-slate-100 shadow-[0_-10px_30px_rgba(0,0,0,0.05)] relative z-20 pb-safe">
        
        <label class="flex items-start gap-3 cursor-pointer group mb-4 bg-slate-50/80 p-3 rounded-xl border border-slate-100 hover:border-slate-300 transition-colors">
            <div class="relative flex items-start pt-0.5 shrink-0">
                <input type="checkbox" wire:model.live="termsAccepted" class="w-4 h-4 rounded border-slate-300 text-pink-500 focus:ring-pink-500 cursor-pointer transition-colors" required>
            </div>
            <div class="text-[10px] font-medium text-slate-600 leading-relaxed">
                Saya telah membaca dan menyetujui <a href="#" class="text-pink-600 font-bold hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-pink-600 font-bold hover:underline">Kebijakan Privasi</a> pembelian tiket Aquaboom.
            </div>
        </label>
        
        <div class="flex justify-between items-center gap-4">
            <div class="flex flex-col">
                <span class="text-slate-500 font-bold uppercase text-[9px] tracking-widest mb-0.5">Total Pembayaran</span>
                <span class="text-2xl font-black text-slate-900 tracking-tighter leading-none">Rp {{ number_format($this->totalPrice, 0, ',', '.') }}</span>
                @if($appliedPromo)
                    <span class="text-[9px] font-bold text-green-500 mt-1 uppercase tracking-wider bg-green-50 px-1.5 py-0.5 rounded inline-block w-max">Hemat Rp {{ number_format($this->discountAmount, 0, ',', '.') }}</span>
                @endif
            </div>

            <button
                type="submit"
                wire:loading.attr="disabled"
                @if(!$termsAccepted) disabled @endif
                class="bg-gradient-to-r from-pink-500 to-rose-500 text-white font-black text-sm px-8 py-4 rounded-xl shadow-[0_8px_20px_rgba(236,72,153,0.3)] hover:shadow-[0_8px_25px_rgba(236,72,153,0.5)] transform hover:-translate-y-0.5 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none flex-1 max-w-[200px] flex items-center justify-center gap-2"
            >
                <span wire:loading.remove>Lanjut Bayar</span>
                <svg wire:loading.remove class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                <span wire:loading>Memproses...</span>
            </button>
        </div>
        @error('termsAccepted') <span class="text-red-500 text-[10px] font-bold mt-3 block text-center uppercase tracking-wide">{{ $message }}</span> @enderror
    </div>

    <!-- T&C Modal -->
    <div 
        x-data="{ open: false, title: '', content: '' }"
        @open-tnc-modal.window="open = true; title = $event.detail.title; content = $event.detail.content"
        x-show="open"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4"
        style="display: none;"
    >
        <div x-show="open" x-transition.opacity @click="open = false" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
        <div 
            x-show="open" 
            x-transition.scale.95
            class="bg-white rounded-3xl shadow-2xl w-full max-w-lg relative z-10 overflow-hidden flex flex-col max-h-[85vh]"
        >
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <h3 class="font-black text-slate-900 text-lg" x-text="'S&K: ' + title"></h3>
                <button @click="open = false" class="text-slate-400 hover:text-red-500 bg-white p-2 rounded-full shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="p-6 overflow-y-auto prose prose-sm prose-slate max-w-none prose-p:my-2 prose-ul:my-2" x-html="content">
            </div>
            <div class="p-4 border-t border-slate-100 bg-white">
                <button @click="open = false" class="w-full bg-slate-900 text-white font-bold py-3 rounded-xl hover:bg-slate-800 transition">Mengerti</button>
            </div>
        </div>
    </div>
</form>
