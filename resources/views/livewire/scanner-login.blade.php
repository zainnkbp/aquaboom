<div class="min-h-screen bg-[#0d091e] flex flex-col justify-center items-center p-4 relative overflow-hidden">
    <!-- Ambient glowing backdrop -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-aqua-gold/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-pink-500/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="w-full max-w-md bg-[#160F30]/90 backdrop-blur-2xl rounded-3xl p-8 shadow-2xl border border-white/10 relative z-10">
        
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-400/20 to-amber-600/10 text-amber-400 border border-amber-400/20 shadow-inner mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h2 class="text-2xl font-black text-white tracking-wide">Scanner Gate Masuk</h2>
            <p class="text-slate-400 text-xs mt-1">Otentikasi Petugas Satpam & Admin Berwenang</p>
        </div>

        <!-- Mode Toggle Tabs -->
        <div class="grid grid-cols-2 gap-2 p-1 bg-black/30 rounded-xl mb-6 border border-white/5">
            <button 
                type="button" 
                wire:click="setMode('pin')"
                class="py-2.5 px-3 rounded-lg text-xs font-bold transition-all {{ $mode === 'pin' ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 shadow-md' : 'text-slate-400 hover:text-white' }}"
            >
                PIN 6-Digit
            </button>
            <button 
                type="button" 
                wire:click="setMode('credentials')"
                class="py-2.5 px-3 rounded-lg text-xs font-bold transition-all {{ $mode === 'credentials' ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 shadow-md' : 'text-slate-400 hover:text-white' }}"
            >
                Email & Password
            </button>
        </div>

        @if($mode === 'pin')
            <!-- PIN Mode Form -->
            <form wire:submit="login" class="space-y-6">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2 text-center uppercase tracking-wider">
                        Ketik 6 Digit PIN
                    </label>
                    <input 
                        type="password" 
                        inputmode="numeric" 
                        maxlength="6"
                        wire:model.live="pin"
                        class="w-full text-center text-3xl tracking-[0.8em] font-mono font-black bg-[#0d091e]/90 border-2 border-amber-400/30 rounded-2xl py-4 text-white focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-400/20 transition-all shadow-inner"
                        placeholder="••••••"
                        autofocus
                    >
                    @error('pin') 
                        <p class="text-rose-400 text-xs mt-2.5 text-center font-medium bg-rose-500/10 py-1.5 px-3 rounded-lg border border-rose-500/20">{{ $message }}</p> 
                    @enderror
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-amber-500 via-amber-400 to-amber-500 hover:brightness-110 text-slate-950 font-black text-sm py-3.5 rounded-xl shadow-lg transition-all transform active:scale-95 uppercase tracking-wider">
                    Masuk ke Scanner
                </button>

                <p class="text-center text-[11px] text-slate-400 leading-relaxed">
                    Sistem otomatis memverifikasi saat 6 digit PIN terisi lengkap.
                </p>
            </form>
        @else
            <!-- Credentials Mode Form -->
            <form wire:submit="loginWithCredentials" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">Alamat Email Staf</label>
                    <input 
                        type="email" 
                        wire:model="email"
                        class="w-full text-sm bg-[#0d091e]/90 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 transition-colors"
                        placeholder="contoh@aquaboom.com"
                        required
                    >
                    @error('email') 
                        <p class="text-rose-400 text-xs mt-1.5 font-medium">{{ $message }}</p> 
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">Password</label>
                    <input 
                        type="password" 
                        wire:model="password"
                        class="w-full text-sm bg-[#0d091e]/90 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 transition-colors"
                        placeholder="••••••••"
                        required
                    >
                    @error('password') 
                        <p class="text-rose-400 text-xs mt-1.5 font-medium">{{ $message }}</p> 
                    @enderror
                </div>

                <button type="submit" class="w-full mt-2 bg-gradient-to-r from-amber-500 via-amber-400 to-amber-500 hover:brightness-110 text-slate-950 font-black text-sm py-3.5 rounded-xl shadow-lg transition-all transform active:scale-95 uppercase tracking-wider">
                    Masuk dengan Email
                </button>
            </form>
        @endif

        <div class="mt-8 pt-4 border-t border-white/5 flex items-center justify-between text-xs text-slate-400">
            <a href="{{ url('/admin') }}" class="hover:text-amber-400 transition-colors flex items-center gap-1">
                <span>← Panel Admin CMS</span>
            </a>
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">
                Website Utama
            </a>
        </div>
        
    </div>
</div>
