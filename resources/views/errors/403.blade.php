<x-layout>
  <x-slot:title>403 - Akses Ditolak | Aquaboom Waterpark</x-slot:title>

  <div class="min-h-[80vh] flex items-center justify-center bg-aqua-cream pt-28 pb-16 px-6">
    <div class="max-w-lg w-full bg-white rounded-[32px] p-8 md:p-12 text-center shadow-xl border border-aqua-cream-2 space-y-6">
      <div class="w-20 h-20 rounded-3xl bg-rose-500/10 text-rose-600 flex items-center justify-center mx-auto shadow-inner">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
      </div>
      
      <div class="space-y-2">
        <h1 class="text-2xl md:text-3xl font-black text-aqua-navy uppercase tracking-tight">
          Akses Ditolak (403)
        </h1>
        <p class="text-sm text-slate-600 leading-relaxed font-semibold">
          Anda tidak memiliki izin atau otorisasi untuk mengakses sumber daya ini.
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
