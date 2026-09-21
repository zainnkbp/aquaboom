<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Forgot Password - Aquaboom Waterpark' : 'Lupa Kata Sandi - Aquaboom Waterpark' }}</x-slot:title>
  
  <div class="min-h-screen pt-36 pb-20 bg-aqua-cream flex items-center justify-center px-6">
    <div class="w-full max-w-lg bg-white rounded-[32px] shadow-2xl border border-aqua-cream-2 p-8 md:p-12 relative overflow-hidden">
      <!-- Decorative background -->
      <div class="absolute top-0 right-0 w-32 h-32 bg-aqua-azure/10 rounded-full blur-2xl -mr-16 -mt-16"></div>
      <div class="absolute bottom-0 left-0 w-32 h-32 bg-aqua-gold/10 rounded-full blur-2xl -ml-16 -mb-16"></div>

      <div class="relative z-10 text-center mb-8">
        <span class="text-aqua-gold text-xs font-black tracking-widest uppercase mb-3 block">
          {{ App::getLocale() === 'en' ? 'Account Security' : 'Keamanan Akun' }}
        </span>
        <h1 class="text-2xl md:text-3xl font-black text-aqua-navy uppercase tracking-tight mb-4">
          {{ App::getLocale() === 'en' ? 'FORGOT PASSWORD' : 'LUPA KATA SANDI' }}
        </h1>
        <p class="text-slate-500 text-sm font-semibold leading-relaxed">
          {{ App::getLocale() === 'en'
            ? 'Enter your registered email address and we will send a password reset link to your inbox.'
            : 'Masukkan alamat email Anda yang terdaftar dan kami akan mengirimkan link pengaturan ulang kata sandi ke email Anda.' }}
        </p>
      </div>

      @if(session('status'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold p-4 rounded-2xl mb-6 flex items-start gap-3">
          <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
          <div>{{ session('status') }}</div>
        </div>
      @endif

      @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 text-xs font-bold p-4 rounded-2xl mb-6">
          <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
        @csrf

        <div>
          <label class="block text-xs font-black text-aqua-navy uppercase tracking-wider mb-2">
            {{ App::getLocale() === 'en' ? 'Email Address' : 'Alamat Email' }}
          </label>
          <input type="email" name="email" required value="{{ old('email') }}" autofocus
            class="w-full px-5 py-4 rounded-xl border border-slate-200 bg-white text-aqua-navy text-sm font-bold focus:outline-none focus:border-aqua-gold transition-all"
            placeholder="{{ App::getLocale() === 'en' ? 'Enter your registered email' : 'Masukkan email terdaftar Anda' }}">
        </div>

        <button type="submit" class="w-full bg-aqua-navy hover:bg-aqua-navy-2 text-aqua-gold font-black py-4 rounded-xl text-sm uppercase tracking-widest transition-all shadow-lg shadow-blue-950/20 cursor-pointer">
          {{ App::getLocale() === 'en' ? 'Send Reset Link' : 'Kirim Link Reset Kata Sandi' }}
        </button>
      </form>

      <div class="mt-8 pt-6 border-t border-slate-100 text-center">
        <p class="text-xs text-slate-500 font-semibold">
          {{ App::getLocale() === 'en' ? 'Remembered your password?' : 'Sudah ingat kata sandi Anda?' }} 
          <a href="{{ route('login') }}" class="text-aqua-azure font-black hover:text-aqua-gold transition-all">
            {{ App::getLocale() === 'en' ? 'Back to Login' : 'Kembali ke Halaman Masuk' }}
          </a>
        </p>
      </div>
    </div>
  </div>
</x-layout>
