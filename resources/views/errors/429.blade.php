<x-layout>
  <x-slot:title>429 - Terlalu Banyak Permintaan | Aquaboom Waterpark</x-slot:title>

  <div class="min-h-[80vh] flex items-center justify-center bg-aqua-cream pt-28 pb-16 px-6">
    <div class="max-w-lg w-full bg-white rounded-[32px] p-8 md:p-12 text-center shadow-xl border border-aqua-cream-2 space-y-6">
      <div class="w-20 h-20 rounded-3xl bg-amber-500/10 text-amber-600 flex items-center justify-center mx-auto shadow-inner">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
      </div>
      
      <div class="space-y-2">
        <h1 class="text-2xl md:text-3xl font-black text-aqua-navy uppercase tracking-tight">
          Terlalu Banyak Permintaan (429)
        </h1>
        <p class="text-sm text-slate-600 leading-relaxed font-semibold">
          Sistem mendeteksi aktivitas yang terlalu cepat dari perangkat Anda. Demi keamanan, silakan tunggu beberapa saat sebelum mencoba kembali.
        </p>
      </div>

      <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
        <a href="{{ url('/') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-aqua-navy hover:bg-aqua-navy-2 text-white font-bold text-xs uppercase px-6 py-3.5 rounded-xl transition-all shadow-md">
          <span>&larr; Kembali ke Beranda</span>
        </a>
      </div>
    </div>
  </div>
</x-layout>
