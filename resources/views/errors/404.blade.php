<x-layout>
  <x-slot:title>404 - Halaman Tidak Ditemukan | Aquaboom Waterpark</x-slot:title>

  <div class="min-h-[80vh] flex items-center justify-center bg-aqua-cream pt-28 pb-16 px-6">
    <div class="max-w-lg w-full bg-white rounded-[32px] p-8 md:p-12 text-center shadow-xl border border-aqua-cream-2 space-y-6">
      <div class="w-20 h-20 rounded-3xl bg-amber-500/10 text-amber-600 flex items-center justify-center mx-auto shadow-inner">
        <span class="text-3xl font-black">404</span>
      </div>
      
      <div class="space-y-2">
        <h1 class="text-2xl md:text-3xl font-black text-aqua-navy uppercase tracking-tight">
          Halaman Tidak Ditemukan
        </h1>
        <p class="text-sm text-slate-600 leading-relaxed font-semibold">
          Maaf, halaman atau rute yang Anda cari tidak tersedia atau telah dipindahkan.
        </p>
      </div>

      <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
        <a href="{{ url('/') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-aqua-navy hover:bg-aqua-navy-2 text-white font-bold text-xs uppercase px-6 py-3.5 rounded-xl transition-all shadow-md">
          <span>&larr; Kembali ke Beranda</span>
        </a>
        <a href="{{ route('ticket.buy') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black text-xs uppercase px-6 py-3.5 rounded-xl transition-all shadow-md">
          <span>Pesan Tiket &rarr;</span>
        </a>
      </div>
    </div>
  </div>
</x-layout>
