<x-layout>
  <x-slot:title>Activate Account - Aquaboom Waterpark</x-slot:title>
  
  <div class="min-h-screen pt-36 pb-20 bg-aqua-cream flex items-center justify-center px-6">
    <div class="w-full max-w-lg bg-white rounded-[32px] shadow-2xl border border-aqua-cream-2 p-8 md:p-12 relative overflow-hidden">
      <!-- Decorative background -->
      <div class="absolute top-0 right-0 w-32 h-32 bg-aqua-azure/10 rounded-full blur-2xl -mr-16 -mt-16"></div>
      <div class="absolute bottom-0 left-0 w-32 h-32 bg-aqua-gold/10 rounded-full blur-2xl -ml-16 -mb-16"></div>

      <div class="relative z-10 text-center mb-8">
        <span class="text-aqua-gold text-xs font-black tracking-widest uppercase mb-3 block">Welcome to the Club</span>
        <h1 class="text-3xl md:text-4xl font-black text-aqua-navy uppercase tracking-tight mb-4">ACTIVATE ACCOUNT</h1>
        <p class="text-slate-500 text-sm font-semibold leading-relaxed">
          Hai <strong>{{ $user->name }}</strong>, silakan buat password baru Anda untuk mengaktifkan akun dan mengakses riwayat tiket Anda dengan mudah.
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
          <label class="block text-xs font-black text-aqua-navy uppercase tracking-wider mb-2">Email Address</label>
          <input type="text" class="w-full px-5 py-4 rounded-xl border border-slate-200 bg-slate-50 text-slate-500 text-sm font-bold focus:outline-none" value="{{ $user->email }}" readonly disabled>
        </div>

        <div>
          <label class="block text-xs font-black text-aqua-navy uppercase tracking-wider mb-2">Password Baru</label>
          <input type="password" name="password" required class="w-full px-5 py-4 rounded-xl border border-slate-200 bg-white text-aqua-navy text-sm font-bold focus:outline-none focus:border-aqua-gold transition-all" placeholder="Minimal 8 karakter">
        </div>

        <div>
          <label class="block text-xs font-black text-aqua-navy uppercase tracking-wider mb-2">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" required class="w-full px-5 py-4 rounded-xl border border-slate-200 bg-white text-aqua-navy text-sm font-bold focus:outline-none focus:border-aqua-gold transition-all" placeholder="Ulangi password baru">
        </div>

        <button type="submit" class="w-full bg-aqua-navy hover:bg-aqua-navy-2 text-aqua-gold font-black py-4 rounded-xl text-sm uppercase tracking-widest transition-all shadow-lg shadow-blue-950/20">
          Aktifkan & Masuk
        </button>
      </form>
    </div>
  </div>
</x-layout>
