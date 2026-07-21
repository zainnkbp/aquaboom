<form wire:submit="submit" class="flex flex-col h-full overflow-hidden">
    <div
      class="p-7 overflow-y-auto flex-1 relative z-10"
      @mouseenter="cursorText=''"
      @mouseleave="cursorText=''"
    >
      <div
        class="mb-8 bg-white p-5 rounded-2xl shadow-sm border border-slate-200"
      >
        <label
          class="block text-sm font-extrabold text-slate-700 mb-4 uppercase tracking-wide"
          >Pilih Tanggal Kunjungan</label
        >
        <div 
            class="flex items-center gap-3 overflow-x-auto pb-2 text-sm font-bold snap-x scrollbar-hide"
        >
          <div
            wire:click="$set('visit_date', '{{ date('Y-m-d') }}')"
            class="py-3 px-5 rounded-xl border-2 cursor-pointer transition-all duration-300 whitespace-nowrap snap-start shrink-0 {{ $visit_date === date('Y-m-d') ? 'border-pink-500 bg-pink-500 text-white shadow-[0_5px_15px_rgba(236,72,153,0.3)]' : 'border-slate-200 hover:border-pink-400 hover:bg-pink-50 text-slate-700' }}"
          >
            Hari Ini
          </div>
          <div
            wire:click="$set('visit_date', '{{ date('Y-m-d', strtotime('+1 day')) }}')"
            class="py-3 px-5 rounded-xl border-2 cursor-pointer transition-all duration-300 whitespace-nowrap snap-start shrink-0 {{ $visit_date === date('Y-m-d', strtotime('+1 day')) ? 'border-pink-500 bg-pink-500 text-white shadow-[0_5px_15px_rgba(236,72,153,0.3)]' : 'border-slate-200 hover:border-pink-400 hover:bg-pink-50 text-slate-700' }}"
          >
            Besok
          </div>
          <div
            x-data
            @click="$refs.datePicker.showPicker()"
            class="relative py-3 px-5 rounded-xl border-2 cursor-pointer transition-all duration-300 whitespace-nowrap flex items-center gap-2 snap-start shrink-0 group {{ ($visit_date && $visit_date !== date('Y-m-d') && $visit_date !== date('Y-m-d', strtotime('+1 day'))) ? 'border-cyan-500 bg-cyan-500 text-white shadow-[0_5px_15px_rgba(6,182,212,0.3)]' : 'border-slate-200 hover:border-cyan-400 hover:bg-cyan-50 text-slate-700' }}"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>{{ ($visit_date && $visit_date !== date('Y-m-d') && $visit_date !== date('Y-m-d', strtotime('+1 day'))) ? \Carbon\Carbon::parse($visit_date)->format('d M Y') : 'Tanggal Lain' }}</span>
            <input
              x-ref="datePicker"
              type="date"
              wire:model.live="visit_date"
              class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
              min="{{ date('Y-m-d') }}"
            />
          </div>
        </div>
        @error('visit_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
      </div>

      <div class="space-y-6">
        <div class="relative">
          <label class="block text-sm font-extrabold text-slate-700 mb-2"
            >Nama Lengkap</label
          >
          <input
            type="text"
            wire:model="customer_name"
            class="w-full border-2 border-slate-200 rounded-xl px-5 py-4 input-rainbow bg-white text-slate-800 font-bold placeholder-slate-400 shadow-sm"
            placeholder="Cth: Fadli Zainul"
            required
          />
          @error('customer_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>
        <div class="relative">
          <label class="block text-sm font-extrabold text-slate-700 mb-2"
            >Email</label
          >
          <input
            type="email"
            wire:model="customer_email"
            class="w-full border-2 border-slate-200 rounded-xl px-5 py-4 input-rainbow bg-white text-slate-800 font-bold placeholder-slate-400 shadow-sm"
            placeholder="Cth: fadli@domain.com"
            required
          />
          @error('customer_email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>
        <div class="relative">
          <label class="block text-sm font-extrabold text-slate-700 mb-2"
            >WhatsApp</label
          >
          <input
            type="tel"
            wire:model="customer_phone"
            class="w-full border-2 border-slate-200 rounded-xl px-5 py-4 input-rainbow bg-white text-slate-800 font-bold placeholder-slate-400 shadow-sm"
            placeholder="Cth: 08123456789"
            required
          />
          @error('customer_phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="relative">
          <label class="block text-sm font-extrabold text-slate-700 mb-2"
            >Paket Tiket</label
          >
          <select
            wire:model.live="ticket_package_id"
            class="w-full border-2 border-slate-200 rounded-xl px-5 py-4 bg-white text-slate-800 font-bold shadow-sm appearance-none"
            required
          >
            @foreach($packages as $pkg)
                <option value="{{ $pkg->id }}">{{ $pkg->name }} - Rp {{ number_format($pkg->effective_price, 0, ',', '.') }}</option>
            @endforeach
          </select>
          @error('ticket_package_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror

          @if($selectedPackage)
            <div class="mt-3 flex items-center gap-3 bg-white p-4 rounded-xl border-2 border-slate-200 shadow-sm">
              <div class="flex-1">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">Harga per Tiket</p>
                <div class="flex items-baseline gap-2 flex-wrap">
                  <span class="text-2xl font-black text-{{ $selectedPackage->is_discounted ? 'rose' : 'slate' }}-600 tracking-tight">
                    Rp {{ number_format($selectedPackage->effective_price, 0, ',', '.') }}
                  </span>
                  @if($selectedPackage->is_discounted)
                    <span class="text-sm font-semibold text-slate-400 line-through">
                      Rp {{ number_format($selectedPackage->price, 0, ',', '.') }}
                    </span>
                    <span class="text-[11px] font-black text-white bg-rose-500 px-2 py-0.5 rounded-full uppercase tracking-wide">
                      Hemat Rp {{ number_format($selectedPackage->price - $selectedPackage->effective_price, 0, ',', '.') }}
                    </span>
                  @endif
                </div>
              </div>
            </div>
          @endif
        </div>

        <div
          class="bg-white p-5 rounded-xl border-2 border-slate-200 flex justify-between items-center shadow-sm"
        >
          <label class="text-sm font-extrabold text-slate-700"
            >Jumlah Tiket</label
          >
          <div class="flex items-center space-x-5">
            <button
              type="button"
              wire:click="decrementQuantity"
              class="w-12 h-12 rounded-full border-2 border-slate-200 flex items-center justify-center hover:bg-slate-100 hover:border-slate-300 text-slate-600 font-bold transition text-xl shadow-sm"
            >
              -
            </button>
            <span class="text-3xl font-black text-slate-800 w-8 text-center"
              >{{ $quantity }}</span
            >
            <button
              type="button"
              wire:click="incrementQuantity"
              class="w-12 h-12 rounded-full border-2 border-pink-200 flex items-center justify-center bg-pink-50 hover:bg-pink-100 hover:border-pink-400 text-pink-500 font-bold transition text-xl shadow-sm transform hover:scale-105"
            >
              +
            </button>
          </div>
        </div>

        <!-- Promo Code Section -->
        <div class="bg-slate-50 p-5 rounded-xl border-2 border-slate-200 shadow-sm relative">
            <label class="block text-sm font-extrabold text-slate-700 mb-2">Kode Voucher (Opsional)</label>
            @if($appliedPromo)
                <div class="flex justify-between items-center bg-green-50 border border-green-200 p-3 rounded-lg">
                    <div class="flex items-center gap-2 text-green-700 font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Voucher Dipakai: {{ $appliedPromo->code }}
                    </div>
                    <button type="button" wire:click="removePromo" class="text-red-500 text-sm font-bold hover:underline">Hapus</button>
                </div>
            @else
                <div class="flex gap-2">
                    <input type="text" wire:model="promo_code" wire:keydown.enter.prevent="applyPromo" class="flex-1 border-2 border-slate-200 rounded-lg px-4 py-3 font-bold uppercase text-slate-800" placeholder="Ketik voucher disini">
                    <button type="button" wire:click="applyPromo" wire:loading.attr="disabled" wire:target="applyPromo" class="bg-slate-800 text-white px-5 py-3 rounded-lg font-bold hover:bg-slate-900 transition disabled:opacity-60">
                        <span wire:loading.remove wire:target="applyPromo">Gunakan</span>
                        <span wire:loading wire:target="applyPromo">...</span>
                    </button>
                </div>
                @if($promoError)
                    <span class="text-red-500 text-xs mt-2 block">{{ $promoError }}</span>
                @endif
            @endif
        </div>
      </div>
    </div>

    <div
      class="p-6 bg-white border-t border-slate-200 relative z-10 shadow-[0_-10px_20px_rgba(0,0,0,0.03)]"
    >
        @if($appliedPromo)
          <div class="flex justify-between items-center mb-1">
            <span class="text-slate-500 text-sm">Subtotal</span>
            <span class="text-slate-700 font-bold">Rp {{ number_format($this->subtotal, 0, ',', '.') }}</span>
          </div>
          <div class="flex justify-between items-center mb-3 text-green-600">
            <span class="text-sm font-bold">Diskon Promo</span>
            <span class="font-bold">- Rp {{ number_format($this->discountAmount, 0, ',', '.') }}</span>
          </div>
        @endif
      <div class="flex justify-between items-center mb-5">
        <span
          class="text-slate-500 font-bold uppercase text-sm tracking-wide"
          >Total Bayar</span
        >
        <span class="text-3xl font-black text-slate-900 tracking-tight"
          >Rp {{ number_format($this->totalPrice, 0, ',', '.') }}</span
        >
      </div>
      <button
        type="submit"
        wire:loading.attr="disabled"
        @mouseenter="cursorText='Pay!'"
        @mouseleave="cursorText=''"
        class="w-full bg-gradient-to-r from-pink-500 to-rose-500 text-white font-black text-xl py-5 rounded-2xl shadow-[0_10px_30px_rgba(236,72,153,0.3)] hover:shadow-[0_15px_40px_rgba(236,72,153,0.5)] transform hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group"
      >
        <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
        <span wire:loading.remove>Bayar Sekarang 🚀</span>
        <span wire:loading>Memproses...</span>
      </button>
      <p class="text-center text-xs text-slate-400 mt-4 font-medium flex items-center justify-center gap-2">
        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
        Pembayaran Aman & Terenkripsi
      </p>
    </div>
</form>
