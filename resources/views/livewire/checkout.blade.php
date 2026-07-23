<form wire:submit="submit" class="flex flex-col h-full bg-white overflow-hidden font-outfit">
    <!-- Header -->
    <div class="px-6 md:px-8 py-5 border-b border-slate-100 flex justify-between items-center bg-white relative z-20">
        <div>
            <h2 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight">Checkout</h2>
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

    <div class="px-6 md:px-8 py-6 overflow-y-auto flex-1 relative z-10 space-y-8">
        
        <!-- Langkah 1: Tanggal Kunjungan -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <div class="w-6 h-6 rounded-full bg-slate-900 text-white flex items-center justify-center text-xs font-bold">1</div>
                <h3 class="text-base font-bold text-slate-900">Tanggal Kunjungan</h3>
            </div>
            
            <div class="flex items-center gap-3 overflow-x-auto pb-2 text-sm font-bold snap-x scrollbar-hide">
                <div wire:click="$set('visit_date', '{{ date('Y-m-d') }}')" class="py-2.5 px-6 rounded-full border cursor-pointer transition-all duration-300 whitespace-nowrap snap-start shrink-0 {{ $visit_date === date('Y-m-d') ? 'border-slate-900 bg-slate-900 text-white shadow-md' : 'border-slate-200 hover:border-slate-300 bg-white text-slate-700' }}">
                    Hari Ini
                </div>
                <div wire:click="$set('visit_date', '{{ date('Y-m-d', strtotime('+1 day')) }}')" class="py-2.5 px-6 rounded-full border cursor-pointer transition-all duration-300 whitespace-nowrap snap-start shrink-0 {{ $visit_date === date('Y-m-d', strtotime('+1 day')) ? 'border-slate-900 bg-slate-900 text-white shadow-md' : 'border-slate-200 hover:border-slate-300 bg-white text-slate-700' }}">
                    Besok
                </div>
                <div x-data @click="$refs.datePicker.showPicker()" class="relative py-2.5 px-6 rounded-full border cursor-pointer transition-all duration-300 whitespace-nowrap flex items-center gap-2 snap-start shrink-0 {{ ($visit_date && $visit_date !== date('Y-m-d') && $visit_date !== date('Y-m-d', strtotime('+1 day'))) ? 'border-slate-900 bg-slate-900 text-white shadow-md' : 'border-slate-200 hover:border-slate-300 bg-white text-slate-700' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>{{ ($visit_date && $visit_date !== date('Y-m-d') && $visit_date !== date('Y-m-d', strtotime('+1 day'))) ? \Carbon\Carbon::parse($visit_date)->format('d M Y') : 'Pilih Tanggal' }}</span>
                    <input x-ref="datePicker" type="date" wire:model.live="visit_date" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+30 days')) }}" />
                </div>
            </div>
            @error('visit_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <hr class="border-slate-100">

        <!-- Langkah 2: Paket Tiket (Hanya yang Valid) -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <div class="w-6 h-6 rounded-full bg-slate-900 text-white flex items-center justify-center text-xs font-bold">2</div>
                <h3 class="text-base font-bold text-slate-900">Pilih Paket</h3>
            </div>
            
            @if($packages->isEmpty())
                <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 text-center">
                    <p class="text-sm font-medium text-slate-500">Mohon maaf, tidak ada tiket yang tersedia untuk tanggal kunjungan ini.</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($packages as $pkg)
                    <div 
                        wire:click="$set('ticket_package_id', {{ $pkg->id }})"
                        class="relative rounded-2xl p-5 cursor-pointer transition-all duration-300 border {{ $ticket_package_id == $pkg->id ? 'border-pink-500 bg-pink-50/30 shadow-sm' : 'border-slate-100 hover:border-slate-300 bg-white' }}"
                    >
                        <div class="flex justify-between items-start">
                            <div class="pr-4">
                                <h4 class="font-bold text-slate-900 text-base">{{ $pkg->name }}</h4>
                                <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">{{ $pkg->description }}</p>
                            </div>
                            <div class="w-5 h-5 rounded-full border flex items-center justify-center shrink-0 mt-0.5 {{ $ticket_package_id == $pkg->id ? 'border-pink-500 bg-pink-500' : 'border-slate-300' }}">
                                @if($ticket_package_id == $pkg->id)
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mt-4 flex items-baseline gap-2">
                            <span class="text-xl font-black text-slate-900 tracking-tight">Rp {{ number_format($pkg->effective_price, 0, ',', '.') }}</span>
                            @if($pkg->is_discounted)
                                <span class="text-xs font-medium text-slate-400 line-through">Rp {{ number_format($pkg->price, 0, ',', '.') }}</span>
                            @endif
                        </div>

                        @if($ticket_package_id == $pkg->id)
                            <div class="mt-4 pt-4 border-t border-slate-100 flex justify-between items-center">
                                <span class="text-xs font-bold text-slate-600">Kuantitas</span>
                                <div class="flex items-center space-x-3 bg-slate-50 rounded-full border border-slate-100 p-0.5">
                                    <button type="button" wire:click="decrementQuantity" class="w-8 h-8 rounded-full flex items-center justify-center hover:bg-white hover:shadow-sm text-slate-600 font-bold transition text-lg">-</button>
                                    <span class="text-sm font-bold text-slate-900 w-4 text-center">{{ $quantity }}</span>
                                    <button type="button" wire:click="incrementQuantity" class="w-8 h-8 rounded-full flex items-center justify-center bg-white shadow-sm hover:text-pink-500 text-slate-900 font-bold transition text-lg">+</button>
                                </div>
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @error('ticket_package_id') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror

                @if($selectedPackage && $selectedPackage->terms_and_conditions)
                    <div class="mt-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <h4 class="text-[10px] font-bold text-slate-500 mb-2 uppercase tracking-wider flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Syarat & Ketentuan Paket
                        </h4>
                        <div class="text-xs text-slate-600 prose prose-sm prose-slate max-w-none leading-relaxed prose-p:my-1 prose-ul:my-1 prose-li:my-0.5">
                            {!! $selectedPackage->terms_and_conditions !!}
                        </div>
                    </div>
                @endif
            @endif
        </div>

        <hr class="border-slate-100">

        <!-- Langkah 3: Data Pemesan (Minimalist Floating Label Style) -->
        <div>
            <div class="flex items-center gap-2 mb-4">
                <div class="w-6 h-6 rounded-full bg-slate-900 text-white flex items-center justify-center text-xs font-bold">3</div>
                <h3 class="text-base font-bold text-slate-900">Data Pemesan</h3>
            </div>
            
            <div class="space-y-4">
                <div class="relative">
                    <input type="text" wire:model="customer_name" id="name" class="block rounded-xl px-4 pb-2.5 pt-6 w-full text-sm text-slate-900 bg-slate-50 border-transparent focus:bg-white focus:border-pink-500 focus:ring-1 focus:ring-pink-500 appearance-none peer transition-all" placeholder=" " required />
                    <label for="name" class="absolute text-xs text-slate-400 duration-300 transform -translate-y-3 scale-75 top-4 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-3 font-medium uppercase tracking-wide">Nama Lengkap</label>
                    @error('customer_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div class="relative">
                    <input type="email" wire:model="customer_email" id="email" class="block rounded-xl px-4 pb-2.5 pt-6 w-full text-sm text-slate-900 bg-slate-50 border-transparent focus:bg-white focus:border-pink-500 focus:ring-1 focus:ring-pink-500 appearance-none peer transition-all" placeholder=" " required />
                    <label for="email" class="absolute text-xs text-slate-400 duration-300 transform -translate-y-3 scale-75 top-4 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-3 font-medium uppercase tracking-wide">Email</label>
                    @error('customer_email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div class="relative">
                    <input type="tel" wire:model="customer_phone" id="phone" class="block rounded-xl px-4 pb-2.5 pt-6 w-full text-sm text-slate-900 bg-slate-50 border-transparent focus:bg-white focus:border-pink-500 focus:ring-1 focus:ring-pink-500 appearance-none peer transition-all" placeholder=" " required />
                    <label for="phone" class="absolute text-xs text-slate-400 duration-300 transform -translate-y-3 scale-75 top-4 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-3 font-medium uppercase tracking-wide">No. WhatsApp</label>
                    @error('customer_phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Langkah 4: Kode Voucher (Opsional) -->
        <div class="pb-10">
            <h3 class="text-xs font-bold text-slate-500 mb-3 uppercase tracking-wide">Kode Voucher (Opsional)</h3>
            @if($appliedPromo)
                <div class="flex justify-between items-center bg-green-50/50 border border-green-100 px-4 py-3 rounded-xl">
                    <div class="flex items-center gap-2 text-green-700 font-bold text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Dipakai: {{ $appliedPromo->code }}
                    </div>
                    <button type="button" wire:click="removePromo" class="text-slate-400 hover:text-red-500 text-xs font-medium transition-colors">Hapus</button>
                </div>
            @else
                <div class="flex gap-2">
                    <input type="text" wire:model="promo_code" wire:keydown.enter.prevent="applyPromo" class="flex-1 rounded-xl px-4 py-2.5 text-sm font-bold uppercase text-slate-800 bg-slate-50 border-transparent focus:bg-white focus:border-pink-500 focus:ring-1 focus:ring-pink-500 transition-all" placeholder="Ketik di sini">
                    <button type="button" wire:click="applyPromo" wire:loading.attr="disabled" wire:target="applyPromo" class="bg-slate-900 text-white px-5 py-2.5 rounded-xl font-bold text-xs hover:bg-slate-800 transition disabled:opacity-50 tracking-wide">
                        <span wire:loading.remove wire:target="applyPromo">Pakai</span>
                        <span wire:loading wire:target="applyPromo">...</span>
                    </button>
                </div>
                @if($promoError)
                    <span class="text-red-500 text-[10px] font-bold mt-1.5 block px-1">{{ $promoError }}</span>
                @endif
            @endif
        </div>
    </div>

    <!-- Sticky Ultra-Compact Footer -->
    <div class="p-5 bg-white border-t border-slate-100 shadow-[0_-4px_20px_rgba(0,0,0,0.02)] relative z-20 pb-safe">
        
        <label class="flex items-start gap-3 cursor-pointer group mb-4">
            <div class="relative flex items-start pt-0.5">
                <input type="checkbox" wire:model.live="termsAccepted" class="w-4 h-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900 cursor-pointer transition-colors" required>
            </div>
            <div class="text-[10px] font-medium text-slate-500 leading-relaxed">
                Saya menyetujui <a href="#" class="text-slate-900 font-bold hover:underline">S&K</a> serta <a href="#" class="text-slate-900 font-bold hover:underline">Kebijakan Privasi</a> Aquaboom.
            </div>
        </label>
        
        <div class="flex justify-between items-center gap-4">
            <div class="flex flex-col">
                <span class="text-slate-400 font-bold uppercase text-[9px] tracking-wider mb-0.5">Total Bayar</span>
                <span class="text-xl font-black text-slate-900 tracking-tight leading-none">Rp {{ number_format($this->totalPrice, 0, ',', '.') }}</span>
                @if($appliedPromo)
                    <span class="text-[9px] font-bold text-green-500 mt-1 uppercase tracking-wide">Hemat Rp {{ number_format($this->discountAmount, 0, ',', '.') }}</span>
                @endif
            </div>

            <button
                type="submit"
                wire:loading.attr="disabled"
                @if(!$termsAccepted) disabled @endif
                class="bg-pink-500 text-white font-bold text-sm px-8 py-3.5 rounded-full shadow-[0_4px_15px_rgba(236,72,153,0.3)] hover:bg-pink-600 transform hover:-translate-y-0.5 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none flex-1 max-w-[200px]"
            >
                <span wire:loading.remove>Bayar &rarr;</span>
                <span wire:loading>...</span>
            </button>
        </div>
        @error('termsAccepted') <span class="text-red-500 text-[9px] font-bold mt-2 block text-center">{{ $message }}</span> @enderror
    </div>
</form>
