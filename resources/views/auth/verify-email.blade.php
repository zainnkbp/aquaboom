<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Verify Email Address - Aquaboom Waterpark' : 'Verifikasi Alamat Email - Aquaboom Waterpark' }}</x-slot:title>
  
  <div class="min-h-screen pt-36 pb-20 bg-aqua-cream flex items-center justify-center px-6">
    <div class="w-full max-w-lg bg-white rounded-[32px] shadow-2xl border border-aqua-cream-2 p-8 md:p-12 relative overflow-hidden">
      <!-- Decorative background -->
      <div class="absolute top-0 right-0 w-32 h-32 bg-aqua-azure/10 rounded-full blur-2xl -mr-16 -mt-16"></div>
      <div class="absolute bottom-0 left-0 w-32 h-32 bg-aqua-gold/10 rounded-full blur-2xl -ml-16 -mb-16"></div>

      <div class="relative z-10 text-center mb-8">
        <div class="w-16 h-16 bg-aqua-cream border-2 border-aqua-gold/40 text-aqua-navy rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner">
          ✉️
        </div>
        <span class="text-aqua-gold text-xs font-black tracking-widest uppercase mb-2 block">
          {{ App::getLocale() === 'en' ? 'One More Step' : 'Satu Langkah Lagi' }}
        </span>
        <h1 class="text-2xl md:text-3xl font-black text-aqua-navy uppercase tracking-tight mb-4">
          {{ App::getLocale() === 'en' ? 'VERIFY YOUR EMAIL' : 'VERIFIKASI EMAIL ANDA' }}
        </h1>
        <p class="text-slate-600 text-sm font-semibold leading-relaxed">
          {{ App::getLocale() === 'en'
            ? 'We have sent a verification link to your email address (' . auth()->user()?->email . '). Please check your inbox or spam folder and click the link to activate your account.'
            : 'Kami telah mengirimkan tautan verifikasi ke email (' . auth()->user()?->email . '). Silakan buka kotak masuk atau folder spam Anda dan klik tombol verifikasi untuk mengaktifkan akun.' }}
        </p>
      </div>

      @if (session('status') == 'verification-link-sent')
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold p-4 rounded-2xl mb-6 flex items-center gap-2">
          <svg class="w-5 h-5 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
          <span>{{ App::getLocale() === 'en' ? 'A new verification link has been sent to your email!' : 'Tautan verifikasi baru berhasil dikirim ke alamat email Anda!' }}</span>
        </div>
      @endif

      <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
          @csrf
          <button type="submit" class="w-full bg-aqua-navy hover:bg-aqua-navy-2 text-aqua-gold font-black py-4 rounded-xl text-xs uppercase tracking-widest transition-all shadow-lg shadow-blue-950/20 cursor-pointer">
            {{ App::getLocale() === 'en' ? 'Resend Verification Email' : 'Kirim Ulang Email Verifikasi' }}
          </button>
        </form>

        <div class="flex items-center justify-between pt-4 border-t border-slate-100 text-xs font-semibold">
          <a href="{{ route('ticket.buy') }}" class="text-aqua-azure hover:text-aqua-gold transition-colors">
            ← {{ App::getLocale() === 'en' ? 'Back to Tickets' : 'Kembali ke Tiket' }}
          </a>

          <a href="{{ route('logout') }}" class="text-red-500 hover:text-red-700 transition-colors">
            {{ App::getLocale() === 'en' ? 'Log Out' : 'Keluar Akun' }}
          </a>
        </div>
      </div>

    </div>
  </div>
</x-layout>
