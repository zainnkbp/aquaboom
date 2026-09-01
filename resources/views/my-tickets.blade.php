<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'My Tickets - Aquaboom Waterpark' : 'Tiket Saya & Riwayat Pembelian - Aquaboom Waterpark' }}</x-slot:title>
  
  <!-- Page Header -->
  <div class="pt-36 pb-20 bg-aqua-navy relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
      <img src="{{ asset('assets/img/default.jpeg') }}" alt="bg" class="w-full h-full object-cover" />
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-aqua-navy/60 to-aqua-navy"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 text-center">
      <div class="flex items-center justify-center gap-3 mb-4">
        <div class="h-px w-10 bg-aqua-gold"></div>
        <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">User Dashboard</span>
        <div class="h-px w-10 bg-aqua-gold"></div>
      </div>
      <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">MY TICKETS</h1>
      <p class="text-base md:text-lg text-white/60 max-w-3xl mx-auto font-semibold leading-relaxed">
        Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong>. Temukan dan kelola seluruh riwayat tiket masuk Aquaboom Waterpark Anda di bawah ini.
      </p>
    </div>
  </div>

  <!-- Dashboard Section -->
  <section class="py-24 bg-aqua-cream min-h-[500px]">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      
      @if($transactions->isEmpty())
        <div class="bg-white rounded-[32px] border border-aqua-cream-2 p-12 text-center shadow-lg max-w-2xl mx-auto">
          <div class="w-20 h-20 bg-aqua-cream rounded-full flex items-center justify-center mx-auto mb-6 text-aqua-gold">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
          </div>
          <h3 class="text-2xl font-black text-aqua-navy uppercase mb-3">Belum Ada Tiket</h3>
          <p class="text-slate-500 font-semibold text-sm leading-relaxed mb-8">
            Anda belum pernah memesan tiket atau bertransaksi menggunakan akun ini. Beli tiket sekarang untuk memulai petualangan seru Anda!
          </p>
          <a href="{{ route('ticket.buy') }}" class="inline-block bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-8 py-4 rounded-xl uppercase tracking-wider text-sm transition-all shadow-md">
            Pesan Tiket Sekarang
          </a>
        </div>
      @else
        <div class="bg-white rounded-[32px] border border-aqua-cream-2 shadow-xl overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
              <thead>
                <tr class="bg-aqua-navy text-white text-xs font-black uppercase tracking-wider border-b border-aqua-gold/20">
                  <th class="py-6 px-8">Order ID</th>
                  <th class="py-6 px-6">Tanggal Kunjungan</th>
                  <th class="py-6 px-6">Total Pembayaran</th>
                  <th class="py-6 px-6">Status</th>
                  <th class="py-6 px-8 text-right">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100 text-sm font-semibold text-slate-700">
                @foreach($transactions as $tx)
                  <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-6 px-8 font-black text-aqua-navy">#{{ $tx->order_id }}</td>
                    <td class="py-6 px-6">{{ \Carbon\Carbon::parse($tx->visit_date)->translatedFormat('d F Y') }}</td>
                    <td class="py-6 px-6">Rp {{ number_format($tx->total_price, 0, ',', '.') }}</td>
                    <td class="py-6 px-6">
                      @if($tx->status === 'paid')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                          <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Lunas / Paid
                        </span>
                      @elseif($tx->status === 'pending')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                          <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                        </span>
                      @elseif($tx->status === 'scanned')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                          <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> Checked In
                        </span>
                      @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200">
                          <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span> Gagal / Failed
                        </span>
                      @endif
                    </td>
                    <td class="py-6 px-8 text-right">
                      @if($tx->status === 'paid' || $tx->status === 'scanned')
                        <a href="{{ route('ticket.show', $tx->order_id) }}" class="inline-flex items-center gap-2 bg-aqua-azure hover:bg-aqua-azure-2 text-white font-black px-5 py-2.5 rounded-xl uppercase tracking-wider text-xs transition-all shadow-sm">
                          Lihat E-Ticket
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                      @else
                        <span class="text-slate-400 text-xs italic">-</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endif

    </div>
  </section>
</x-layout>
