<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'My Tickets - Aquaboom Waterpark' : 'Tiket Saya & Riwayat Pembelian - Aquaboom Waterpark' }}</x-slot:title>
  
  <!-- Page Header -->
  <div class="pt-36 pb-20 bg-aqua-navy relative overflow-hidden" x-data="{ showPasswordModal: {{ $errors->any() ? 'true' : 'false' }} }">
    <div class="absolute inset-0 opacity-10">
      <img src="{{ asset('assets/img/default.jpeg') }}" alt="bg" class="w-full h-full object-cover" />
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-aqua-navy/60 to-aqua-navy"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 text-center">
      <div class="flex items-center justify-center gap-3 mb-4">
        <div class="h-px w-10 bg-aqua-gold"></div>
        <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">{{ App::getLocale() === 'en' ? 'User Dashboard' : 'Area Pengguna' }}</span>
        <div class="h-px w-10 bg-aqua-gold"></div>
      </div>
      <h1 class="text-5xl md:text-7xl font-black text-white mb-4 uppercase tracking-tight">{{ App::getLocale() === 'en' ? 'MY TICKETS' : 'TIKET SAYA' }}</h1>
      <p class="text-base md:text-lg text-white/60 max-w-3xl mx-auto font-semibold leading-relaxed mb-6">
        {{ App::getLocale() === 'en' ? 'Welcome back, ' : 'Selamat datang kembali, ' }}<strong>{{ auth()->user()->name }}</strong>{{ App::getLocale() === 'en' ? '. Find and manage your Aquaboom ticket purchase history below.' : '. Temukan dan kelola seluruh riwayat tiket masuk Aquaboom Waterpark Anda di bawah ini.' }}
      </p>

      <!-- Account Actions -->
      <div class="flex items-center justify-center gap-3">
        <button @click="showPasswordModal = true" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs uppercase px-5 py-2.5 rounded-xl transition-all shadow-sm">
          <svg class="w-4 h-4 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
          <span>{{ App::getLocale() === 'en' ? 'Change Password' : 'Ganti Password' }}</span>
        </button>
      </div>

      @if(session('password_success'))
        <div class="mt-6 max-w-md mx-auto p-3.5 rounded-xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-xs font-bold text-center">
          ✓ {{ session('password_success') }}
        </div>
      @endif
    </div>

    <!-- Change Password Modal -->
    <div x-show="showPasswordModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" @keydown.escape.window="showPasswordModal = false">
      <div class="bg-aqua-navy-2 border border-white/15 rounded-3xl w-full max-w-md p-8 shadow-2xl text-left relative" @click.away="showPasswordModal = false">
        <div class="flex items-center justify-between pb-4 border-b border-white/10 mb-6">
          <h3 class="text-xl font-black text-white uppercase tracking-wider">
            {{ App::getLocale() === 'en' ? 'Change Password' : 'Ganti Password' }}
          </h3>
          <button @click="showPasswordModal = false" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
            ✕
          </button>
        </div>

        <form action="{{ route('my.tickets.change_password') }}" method="POST" class="space-y-4">
          @csrf
          <div>
            <label class="block text-xs font-bold text-slate-300 mb-1.5 uppercase tracking-wider">
              {{ App::getLocale() === 'en' ? 'Current Password' : 'Password Saat Ini' }}
            </label>
            <input type="password" name="current_password" required class="w-full text-sm bg-black/40 border border-white/15 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-aqua-gold transition-colors" placeholder="••••••••">
            @error('current_password')
              <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-300 mb-1.5 uppercase tracking-wider">
              {{ App::getLocale() === 'en' ? 'New Password' : 'Password Baru' }}
            </label>
            <input type="password" name="password" required class="w-full text-sm bg-black/40 border border-white/15 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-aqua-gold transition-colors" placeholder="{{ App::getLocale() === 'en' ? 'Min 8 characters' : 'Minimal 8 karakter' }}">
            @error('password')
              <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-300 mb-1.5 uppercase tracking-wider">
              {{ App::getLocale() === 'en' ? 'Confirm New Password' : 'Ulangi Password Baru' }}
            </label>
            <input type="password" name="password_confirmation" required class="w-full text-sm bg-black/40 border border-white/15 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-aqua-gold transition-colors" placeholder="{{ App::getLocale() === 'en' ? 'Repeat new password' : 'Ulangi password baru' }}">
          </div>

          <div class="pt-2">
            <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-black text-sm py-3.5 rounded-xl uppercase tracking-wider transition-all">
              {{ App::getLocale() === 'en' ? 'Save New Password' : 'Simpan Password Baru' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Dashboard Section -->
  <section class="py-24 bg-aqua-cream min-h-[500px]">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      
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

      @if($transactions->isEmpty())
        <div class="bg-white rounded-[32px] border border-aqua-cream-2 p-12 text-center shadow-lg max-w-2xl mx-auto">
          <div class="w-20 h-20 bg-aqua-cream rounded-full flex items-center justify-center mx-auto mb-6 text-aqua-gold">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
          </div>
          <h3 class="text-2xl font-black text-aqua-navy uppercase mb-3">{{ App::getLocale() === 'en' ? 'No Tickets Found' : 'Belum Ada Tiket' }}</h3>
          <p class="text-slate-500 font-semibold text-sm leading-relaxed mb-8">
            {{ App::getLocale() === 'en'
              ? 'You have not made any ticket purchases on this account yet. Book your tickets now to start your splash adventure!'
              : 'Anda belum pernah memesan tiket atau bertransaksi menggunakan akun ini. Beli tiket sekarang untuk memulai petualangan seru Anda!' }}
          </p>
          <a href="{{ route('ticket.buy') }}" class="inline-block bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-8 py-4 rounded-xl uppercase tracking-wider text-sm transition-all shadow-md">
            {{ App::getLocale() === 'en' ? 'Book Tickets Now' : 'Pesan Tiket Sekarang' }}
          </a>
        </div>
      @else
        <div class="bg-white rounded-[32px] border border-aqua-cream-2 shadow-xl overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
              <thead>
                <tr class="bg-aqua-navy text-white text-xs font-black uppercase tracking-wider border-b border-aqua-gold/20">
                  <th class="py-6 px-8">Order ID</th>
                  <th class="py-6 px-6">{{ App::getLocale() === 'en' ? 'Visit Date' : 'Tanggal Kunjungan' }}</th>
                  <th class="py-6 px-6">{{ App::getLocale() === 'en' ? 'Total Amount' : 'Total Pembayaran' }}</th>
                  <th class="py-6 px-6">Status</th>
                  <th class="py-6 px-8 text-right">{{ App::getLocale() === 'en' ? 'Action' : 'Aksi' }}</th>
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
                          <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> {{ App::getLocale() === 'en' ? 'Paid' : 'Lunas' }}
                        </span>
                      @elseif($tx->status === 'pending')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                          <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending
                        </span>
                      @elseif($tx->status === 'scanned')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                          <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> Checked In
                        </span>
                      @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200">
                          <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span> {{ App::getLocale() === 'en' ? 'Failed' : 'Gagal' }}
                        </span>
                      @endif
                    </td>
                    <td class="py-6 px-8 text-right">
                      @if($tx->status === 'paid' || $tx->status === 'scanned')
                        <a href="{{ route('ticket.show', $tx->order_id) }}" class="inline-flex items-center gap-2 bg-aqua-azure hover:bg-aqua-azure-2 text-white font-black px-5 py-2.5 rounded-xl uppercase tracking-wider text-xs transition-all shadow-sm">
                          {{ App::getLocale() === 'en' ? 'View E-Ticket' : 'Lihat E-Ticket' }}
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                      @elseif($tx->status === 'pending')
                        <a href="{{ route('payment.doku.pay', $tx->order_id) }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-black px-5 py-2.5 rounded-xl uppercase tracking-wider text-xs transition-all shadow-md hover:-translate-y-0.5">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                          <span>{{ App::getLocale() === 'en' ? 'Pay Now' : 'Bayar Sekarang' }}</span>
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
