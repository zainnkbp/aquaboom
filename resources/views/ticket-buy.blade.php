<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Tickets & Pricing - Aquaboom Waterpark' : 'Beli Tiket Masuk & Wahana - Aquaboom Waterpark' }}</x-slot:title>

  <!-- Page Header -->
  <div class="pt-36 pb-20 bg-aqua-navy relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
      <img src="{{ asset('assets/img/default.jpeg') }}" alt="bg" class="w-full h-full object-cover" />
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-aqua-navy/60 to-aqua-navy"></div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
      <div class="flex items-center justify-center gap-3 mb-4">
        <div class="h-px w-10 bg-aqua-gold"></div>
        <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">{{ App::getLocale() === 'en' ? 'Secure Online Booking' : 'Pemesanan Tiket Resmi' }}</span>
        <div class="h-px w-10 bg-aqua-gold"></div>
      </div>
      <h1 class="text-5xl md:text-7xl font-black text-white mb-4 uppercase tracking-tight">
        {{ App::getLocale() === 'id' ? 'TIKET & HARGA' : 'TICKETS & PRICING' }}
      </h1>
      <p class="text-base text-white/60 font-semibold max-w-2xl mx-auto">
        {{ App::getLocale() === 'id' ? 'Beli tiket online sekarang dan langsung masuk tanpa antre di loket!' : 'Buy tickets online now and skip the queue at the counter!' }}
      </p>
    </div>
  </div>

  <!-- Main Section -->
  <section class="py-20 bg-aqua-cream">
    <div class="max-w-5xl mx-auto px-6">

      @if(session('error'))
        <div class="mb-8 p-5 bg-red-50 border border-red-200 text-red-700 rounded-2xl font-bold text-sm flex items-center gap-3 shadow-sm">
          <svg class="w-6 h-6 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      @if(session('warning'))
        <div class="mb-8 p-5 bg-amber-50 border border-amber-200 text-amber-800 rounded-2xl font-bold text-sm flex items-center gap-3 shadow-sm">
          <svg class="w-6 h-6 shrink-0 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
          <span>{{ session('warning') }}</span>
        </div>
      @endif

      @if(session('info'))
        <div class="mb-8 p-5 bg-blue-50 border border-blue-200 text-blue-800 rounded-2xl font-bold text-sm flex items-center gap-3 shadow-sm">
          <svg class="w-6 h-6 shrink-0 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          <span>{{ session('info') }}</span>
        </div>
      @endif

      @if(session('success'))
        <div class="mb-8 p-5 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl font-bold text-sm flex items-center gap-3 shadow-sm">
          <svg class="w-6 h-6 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @if(session('pending_order_id'))
        @php
          $pendingTrx = \App\Models\Transaction::where('order_id', session('pending_order_id'))->first();
        @endphp
        @if($pendingTrx && $pendingTrx->status === 'pending')
          <div class="mb-8 p-6 bg-gradient-to-r from-amber-50 via-orange-50/50 to-white border-2 border-amber-400 rounded-3xl shadow-lg flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="space-y-1 text-center md:text-left">
              <div class="flex items-center justify-center md:justify-start gap-2">
                <span class="w-3 h-3 rounded-full bg-amber-500 animate-ping"></span>
                <h4 class="font-black text-amber-950 uppercase tracking-wider text-sm">Pesanan Menunggu Pembayaran (#{{ $pendingTrx->order_id }})</h4>
              </div>
              <p class="text-xs text-slate-600 font-semibold">
                Total: <strong class="text-amber-600 font-black text-sm">Rp {{ number_format($pendingTrx->total_price, 0, ',', '.') }}</strong> — Klik tombol di samping untuk menyelesaikan pembayaran atau memilih metode bayar lain di DOKU.
              </p>
            </div>
            <a href="{{ route('payment.doku.pay', $pendingTrx->order_id) }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-black px-6 py-3.5 rounded-xl uppercase tracking-wider text-xs transition-all shadow-md hover:-translate-y-0.5 shrink-0">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
              <span>Bayar Sekarang / Ganti Metode</span>
            </a>
          </div>
        @endif
      @endif

      <!-- Ticket Checkout Flow (Livewire) -->
      <div id="packages" class="mb-16 bg-white rounded-[32px] overflow-hidden shadow-xl border border-aqua-cream-2">
        @livewire('checkout')
      </div>

      <!-- Info Bar (1 Single Source of Truth) -->
      <div class="bg-aqua-navy rounded-[28px] p-8 md:p-10 grid grid-cols-1 md:grid-cols-3 gap-8 text-white text-center border border-aqua-gold/20 shadow-xl">
        <div>
          <div class="text-aqua-gold text-2xl md:text-3xl font-black mb-1">09:00 — 18:00</div>
          <div class="text-xs font-black uppercase tracking-widest text-white/50">
            {{ App::getLocale() === 'en' ? 'Open Daily' : 'Buka Setiap Hari' }}
          </div>
          <div class="text-xs font-semibold text-white/70 mt-1">
            {{ App::getLocale() === 'en' ? 'Monday — Sunday & Holidays' : 'Senin — Minggu & Hari Libur' }}
          </div>
        </div>
        <div class="border-y md:border-y-0 md:border-x border-aqua-gold/15 py-6 md:py-0">
          <div class="text-aqua-gold text-2xl md:text-3xl font-black mb-1">17:00 WITA</div>
          <div class="text-xs font-black uppercase tracking-widest text-white/50">
            {{ App::getLocale() === 'en' ? 'Last Admission' : 'Batas Masuk Terakhir' }}
          </div>
          <div class="text-xs font-semibold text-amber-400 mt-1">
            {{ App::getLocale() === 'en' ? 'Entry closes at 5:00 PM WITA' : 'Batas masuk terakhir 17:00 WITA' }}
          </div>
        </div>
        <div>
          <div class="text-aqua-gold text-2xl md:text-3xl font-black mb-1">{{ App::getLocale() === 'en' ? 'Floor 7F' : 'Lantai 7' }}</div>
          <div class="text-xs font-black uppercase tracking-widest text-white/50">
            7F - Shared Common Area
          </div>
          <div class="text-xs font-semibold text-white/70 mt-1">7F - Shared Common Area for Astara Hotel & Pentacity Hotel Balikpapan</div>
        </div>
      </div>

    </div>
  </section>

</x-layout>
