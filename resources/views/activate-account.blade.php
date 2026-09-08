<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Activate Account - Aquaboom Waterpark' : 'Aktivasi Akun Pengunjung - Aquaboom Waterpark' }}</x-slot:title>
  
  <div class="min-h-screen pt-36 pb-20 bg-aqua-cream flex items-center justify-center px-6">
    <div class="w-full max-w-lg bg-white rounded-[32px] shadow-2xl border border-aqua-cream-2 p-8 md:p-12 relative overflow-hidden">
      <!-- Decorative background -->
      <div class="absolute top-0 right-0 w-32 h-32 bg-aqua-azure/10 rounded-full blur-2xl -mr-16 -mt-16"></div>
      <div class="absolute bottom-0 left-0 w-32 h-32 bg-aqua-gold/10 rounded-full blur-2xl -ml-16 -mb-16"></div>

      <div class="relative z-10 text-center mb-8">
        <span class="text-aqua-gold text-xs font-black tracking-widest uppercase mb-3 block">{{ App::getLocale() === 'en' ? 'Welcome to the Club' : 'Selamat Datang' }}</span>
        <h1 class="text-3xl md:text-4xl font-black text-aqua-navy uppercase tracking-tight mb-4">{{ App::getLocale() === 'en' ? 'ACTIVATE ACCOUNT' : 'AKTIVASI AKUN' }}</h1>
        <p class="text-slate-500 text-sm font-semibold leading-relaxed">
          {{ App::getLocale() === 'en'
            ? 'Hello ' . $user->name . ', please create your password to activate your account and conveniently access your e-tickets.'
            : 'Hai ' . $user->name . ', silakan buat password baru Anda untuk mengaktifkan akun dan mengakses riwayat tiket Anda dengan mudah.' }}
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

      <form action="{{ route('activate.account.submit') }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="email" value="{{ $user->email }}">

        <div>
          <label class="block text-xs font-black text-aqua-navy uppercase tracking-wider mb-2">{{ App::getLocale() === 'en' ? 'Email Address' : 'Alamat Email' }}</label>
          <input type="text" class="w-full px-5 py-4 rounded-xl border border-slate-200 bg-slate-50 text-slate-500 text-sm font-bold focus:outline-none" value="{{ $user->email }}" readonly disabled>
        </div>

        <div>
          <label class="block text-xs font-black text-aqua-navy uppercase tracking-wider mb-2">{{ App::getLocale() === 'en' ? 'New Password' : 'Password Baru' }}</label>
          <input type="password" name="password" required class="w-full px-5 py-4 rounded-xl border border-slate-200 bg-white text-aqua-navy text-sm font-bold focus:outline-none focus:border-aqua-gold transition-all" placeholder="{{ App::getLocale() === 'en' ? 'Minimum 8 characters' : 'Minimal 8 karakter' }}">
        </div>

        <div>
          <label class="block text-xs font-black text-aqua-navy uppercase tracking-wider mb-2">{{ App::getLocale() === 'en' ? 'Confirm Password' : 'Konfirmasi Password' }}</label>
          <input type="password" name="password_confirmation" required class="w-full px-5 py-4 rounded-xl border border-slate-200 bg-white text-aqua-navy text-sm font-bold focus:outline-none focus:border-aqua-gold transition-all" placeholder="{{ App::getLocale() === 'en' ? 'Repeat your new password' : 'Ulangi password baru' }}">
        </div>

        <button type="submit" class="w-full bg-aqua-navy hover:bg-aqua-navy-2 text-aqua-gold font-black py-4 rounded-xl text-sm uppercase tracking-widest transition-all shadow-lg shadow-blue-950/20">
          {{ App::getLocale() === 'en' ? 'Activate & Log In' : 'Aktifkan & Masuk' }}
        </button>
      </form>
    </div>
  </div>
</x-layout>
