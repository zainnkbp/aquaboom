<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Reset Password - Aquaboom Waterpark' : 'Atur Ulang Kata Sandi - Aquaboom Waterpark' }}</x-slot:title>
  
  <div class="min-h-screen pt-36 pb-20 bg-aqua-cream flex items-center justify-center px-6">
    <div class="w-full max-w-lg bg-white rounded-[32px] shadow-2xl border border-aqua-cream-2 p-8 md:p-12 relative overflow-hidden">
      <!-- Decorative background -->
      <div class="absolute top-0 right-0 w-32 h-32 bg-aqua-azure/10 rounded-full blur-2xl -mr-16 -mt-16"></div>
      <div class="absolute bottom-0 left-0 w-32 h-32 bg-aqua-gold/10 rounded-full blur-2xl -ml-16 -mb-16"></div>

      <div class="relative z-10 text-center mb-8">
        <span class="text-aqua-gold text-xs font-black tracking-widest uppercase mb-3 block">
          {{ App::getLocale() === 'en' ? 'Set New Password' : 'Buat Kata Sandi Baru' }}
        </span>
        <h1 class="text-2xl md:text-3xl font-black text-aqua-navy uppercase tracking-tight mb-4">
          {{ App::getLocale() === 'en' ? 'RESET PASSWORD' : 'ATUR ULANG KATA SANDI' }}
        </h1>
        <p class="text-slate-500 text-sm font-semibold leading-relaxed">
          {{ App::getLocale() === 'en'
            ? 'Please enter your email and your new secure password.'
            : 'Silakan masukkan email dan buat kata sandi baru yang aman untuk akun Anda.' }}
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

      <form action="{{ Route::has('password.update') ? route('password.update') : url('/reset-password') }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div>
          <label class="block text-xs font-black text-aqua-navy uppercase tracking-wider mb-2">
            {{ App::getLocale() === 'en' ? 'Email Address' : 'Alamat Email' }}
          </label>
          <input type="email" name="email" required value="{{ old('email', $email) }}"
            class="w-full px-5 py-4 rounded-xl border border-slate-200 bg-white text-aqua-navy text-sm font-bold focus:outline-none focus:border-aqua-gold transition-all"
            placeholder="{{ App::getLocale() === 'en' ? 'Enter your email address' : 'Masukkan alamat email Anda' }}">
        </div>

        <div>
          <label class="block text-xs font-black text-aqua-navy uppercase tracking-wider mb-2">
            {{ App::getLocale() === 'en' ? 'New Password' : 'Kata Sandi Baru' }}
          </label>
          <input type="password" name="password" required
            class="w-full px-5 py-4 rounded-xl border border-slate-200 bg-white text-aqua-navy text-sm font-bold focus:outline-none focus:border-aqua-gold transition-all"
            placeholder="{{ App::getLocale() === 'en' ? 'Min. 8 characters' : 'Minimal 8 karakter' }}">
        </div>

        <div>
          <label class="block text-xs font-black text-aqua-navy uppercase tracking-wider mb-2">
            {{ App::getLocale() === 'en' ? 'Confirm New Password' : 'Konfirmasi Kata Sandi Baru' }}
          </label>
          <input type="password" name="password_confirmation" required
            class="w-full px-5 py-4 rounded-xl border border-slate-200 bg-white text-aqua-navy text-sm font-bold focus:outline-none focus:border-aqua-gold transition-all"
            placeholder="{{ App::getLocale() === 'en' ? 'Re-type new password' : 'Ketik ulang kata sandi baru' }}">
        </div>

        <button type="submit" class="w-full bg-aqua-navy hover:bg-aqua-navy-2 text-aqua-gold font-black py-4 rounded-xl text-sm uppercase tracking-widest transition-all shadow-lg shadow-blue-950/20 cursor-pointer">
          {{ App::getLocale() === 'en' ? 'Save New Password' : 'Simpan Kata Sandi Baru' }}
        </button>
      </form>

      <div class="mt-8 pt-6 border-t border-slate-100 text-center">
        <p class="text-xs text-slate-500 font-semibold">
          <a href="{{ Route::has('login') ? route('login') : url('/login') }}" class="text-aqua-azure font-black hover:text-aqua-gold transition-all">
            {{ App::getLocale() === 'en' ? 'Back to Login' : 'Kembali ke Halaman Masuk' }}
          </a>
        </p>
      </div>
    </div>
  </div>
</x-layout>
