<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Login Account - Aquaboom Waterpark' : 'Masuk Akun Pengunjung - Aquaboom Waterpark' }}</x-slot:title>
  
  <div class="min-h-screen pt-36 pb-20 bg-aqua-cream flex items-center justify-center px-6">
    <div class="w-full max-w-lg bg-white rounded-[32px] shadow-2xl border border-aqua-cream-2 p-8 md:p-12 relative overflow-hidden">
      <!-- Decorative background -->
      <div class="absolute top-0 right-0 w-32 h-32 bg-aqua-azure/10 rounded-full blur-2xl -mr-16 -mt-16"></div>
      <div class="absolute bottom-0 left-0 w-32 h-32 bg-aqua-gold/10 rounded-full blur-2xl -ml-16 -mb-16"></div>

      <div class="relative z-10 text-center mb-8">
        <span class="text-aqua-gold text-xs font-black tracking-widest uppercase mb-3 block">{{ App::getLocale() === 'en' ? 'Welcome Back' : 'Selamat Datang Kembali' }}</span>
        <h1 class="text-3xl md:text-4xl font-black text-aqua-navy uppercase tracking-tight mb-4">{{ App::getLocale() === 'en' ? 'CUSTOMER LOGIN' : 'MASUK PENGUNJUNG' }}</h1>
        <p class="text-slate-500 text-sm font-semibold leading-relaxed">
          {{ App::getLocale() === 'en'
            ? 'Please sign in to access your e-tickets, reschedule visits, or book additional facilities.'
            : 'Silakan masuk untuk mengakses e-ticket, mengubah tanggal kunjungan, atau memesan fasilitas tambahan.' }}
        </p>
      </div>

      @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 text-xs font-bold p-4 rounded-2xl mb-6">
          <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Google OAuth 1-Click Login Button -->
      <div class="mb-6">
        <a href="{{ route('auth.google') }}" class="w-full flex items-center justify-center gap-3 bg-white hover:bg-slate-50 text-slate-700 font-bold py-3.5 px-4 rounded-xl border border-slate-300 shadow-xs hover:shadow-md transition-all duration-200 cursor-pointer group">
          <svg class="w-5 h-5" viewBox="0 0 24 24">
            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
          </svg>
          <span class="text-xs uppercase tracking-wider text-slate-800 font-extrabold group-hover:text-aqua-navy">
            {{ App::getLocale() === 'en' ? 'Continue with Google' : 'Lanjutkan dengan Google' }}
          </span>
        </a>
      </div>

      <div class="relative flex items-center justify-center mb-6">
        <div class="border-t border-slate-200 w-full"></div>
        <span class="bg-white px-3 text-[10px] font-black uppercase tracking-wider text-slate-400 absolute">
          {{ App::getLocale() === 'en' ? 'Or login with email' : 'Atau masuk dengan email' }}
        </span>
      </div>

      <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
        @csrf

        <div>
          <label class="block text-xs font-black text-aqua-navy uppercase tracking-wider mb-2">{{ App::getLocale() === 'en' ? 'Email Address' : 'Alamat Email' }}</label>
          <input type="email" name="email" required value="{{ old('email') }}" class="w-full px-5 py-4 rounded-xl border border-slate-200 bg-white text-aqua-navy text-sm font-bold focus:outline-none focus:border-aqua-gold transition-all" placeholder="{{ App::getLocale() === 'en' ? 'Enter your email address' : 'Masukkan alamat email Anda' }}">
        </div>

        <div>
          <label class="block text-xs font-black text-aqua-navy uppercase tracking-wider mb-2">{{ App::getLocale() === 'en' ? 'Password' : 'Kata Sandi' }}</label>
          <input type="password" name="password" required class="w-full px-5 py-4 rounded-xl border border-slate-200 bg-white text-aqua-navy text-sm font-bold focus:outline-none focus:border-aqua-gold transition-all" placeholder="{{ App::getLocale() === 'en' ? 'Enter your password' : 'Masukkan kata sandi Anda' }}">
        </div>

        <div class="flex items-center justify-between">
          <label class="flex items-center gap-2 text-xs text-slate-500 font-semibold cursor-pointer">
            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-aqua-navy focus:ring-aqua-gold">
            {{ App::getLocale() === 'en' ? 'Remember me' : 'Ingat saya' }}
          </label>
        </div>

        <button type="submit" class="w-full bg-aqua-navy hover:bg-aqua-navy-2 text-aqua-gold font-black py-4 rounded-xl text-sm uppercase tracking-widest transition-all shadow-lg shadow-blue-950/20">
          {{ App::getLocale() === 'en' ? 'Log In' : 'Masuk' }}
        </button>
      </form>

      <div class="mt-8 pt-6 border-t border-slate-100 text-center">
        <p class="text-xs text-slate-500 font-semibold">
          {{ App::getLocale() === 'en' ? "Don't have an account?" : 'Belum punya akun?' }} 
          <a href="{{ route('register') }}" class="text-aqua-azure font-black hover:text-aqua-gold transition-all">
            {{ App::getLocale() === 'en' ? 'Register Now' : 'Daftar Sekarang' }}
          </a>
        </p>
      </div>
    </div>
  </div>
</x-layout>
