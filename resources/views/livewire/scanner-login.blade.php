<div class="min-h-screen bg-slate-900 flex flex-col justify-center items-center p-4">
    <div class="w-full max-w-md bg-slate-800 rounded-3xl p-8 shadow-2xl border border-slate-700">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-500/20 text-blue-400 mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-white mb-2">Akses Scanner</h2>
            <p class="text-slate-400 text-sm">Masukkan 6 Digit PIN Satpam</p>
        </div>

        <div class="space-y-6">
            <div>
                <input 
                    type="password" 
                    inputmode="numeric" 
                    maxlength="6"
                    wire:model.live="pin"
                    class="w-full text-center text-3xl tracking-[1em] font-bold bg-slate-900 border-2 border-slate-700 rounded-xl py-4 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors"
                    placeholder="••••••"
                    autofocus
                >
                @error('pin') 
                    <p class="text-red-400 text-sm mt-2 text-center animate-pulse">{{ $message }}</p> 
                @enderror
            </div>

            <p class="text-center text-xs text-slate-500">
                Sistem akan otomatis masuk setelah 6 digit PIN terisi.
            </p>
        </div>
        
    </div>
</div>
