<x-layout>
  <x-slot:title>419 - Sesi Kedaluwarsa | Aquaboom Waterpark</x-slot:title>

  <div class="min-h-[80vh] flex items-center justify-center bg-aqua-cream pt-28 pb-16 px-6">
    <div class="max-w-lg w-full bg-white rounded-[32px] p-8 md:p-12 text-center shadow-xl border border-aqua-cream-2 space-y-6">
      <div class="w-20 h-20 rounded-3xl bg-blue-500/10 text-blue-600 flex items-center justify-center mx-auto shadow-inner">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
      </div>
      
      <div class="space-y-2">
        <h1 class="text-2xl md:text-3xl font-black text-aqua-navy uppercase tracking-tight">
          Sesi Telah Berakhir (419)
        </h1>
        <p class="text-sm text-slate-600 leading-relaxed font-semibold">
          Sesi halaman Anda telah habis demi keamanan transaksi. Silakan muat ulang halaman atau lakukan pemesanan kembali.
        </p>
      </div>

      <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
        <a href="javascript:location.reload()" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-aqua-navy hover:bg-aqua-navy-2 text-white font-bold text-xs uppercase px-6 py-3.5 rounded-xl transition-all shadow-md">
          <span>Segarkan Halaman (Refresh)</span>
        </a>
        <a href="{{ route('ticket.buy') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black text-xs uppercase px-6 py-3.5 rounded-xl transition-all shadow-md">
          <span>Pesan Tiket &rarr;</span>
        </a>
      </div>
    </div>
  </div>
</x-layout>
