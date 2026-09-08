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
        <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">Secure Online</span>
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

      @if(session('success'))
        <div class="mb-8 p-5 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl font-bold text-sm flex items-center gap-3 shadow-sm">
          <svg class="w-6 h-6 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      <!-- Ticket Checkout Flow (Livewire) -->
      <div id="packages" class="mb-16 bg-white rounded-[32px] overflow-hidden shadow-xl border border-aqua-cream-2">
        @livewire('checkout')
      </div>

      <!-- Info Bar -->
      <div class="bg-aqua-navy rounded-[28px] p-10 grid grid-cols-1 md:grid-cols-3 gap-8 text-white text-center border border-aqua-gold/20 shadow-xl">
        <div>
          <div class="text-aqua-gold text-3xl font-black mb-1">09:00</div>
          <div class="text-xs font-black uppercase tracking-widest text-white/40">
            {{ App::getLocale() === 'id' ? 'Buka' : 'Open' }}
          </div>
          <div class="text-sm font-semibold text-white/60 mt-1">
            {{ App::getLocale() === 'id' ? 'Setiap hari' : 'Every day' }}
          </div>
        </div>
        <div class="border-y md:border-y-0 md:border-x border-aqua-gold/15 py-6 md:py-0">
          <div class="text-aqua-gold text-3xl font-black mb-1">18:00</div>
          <div class="text-xs font-black uppercase tracking-widest text-white/40">
            {{ App::getLocale() === 'id' ? 'Tutup' : 'Close' }}
          </div>
          <div class="text-sm font-semibold text-white/60 mt-1">
            {{ App::getLocale() === 'id' ? 'Tiket terakhir 17:00' : 'Last admission 17:00' }}
          </div>
        </div>
        <div>
          <div class="text-aqua-gold text-3xl font-black mb-1">7th</div>
          <div class="text-xs font-black uppercase tracking-widest text-white/40">
            {{ App::getLocale() === 'id' ? 'Lantai' : 'Floor' }}
          </div>
          <div class="text-sm font-semibold text-white/60 mt-1">Pentacity Mall, BSB</div>
        </div>
      </div>

    </div>
  </section>

</x-layout>
