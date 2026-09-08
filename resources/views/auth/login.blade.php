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
