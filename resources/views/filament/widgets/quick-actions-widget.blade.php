<x-filament-widgets::widget>
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-[#160F30] to-slate-950 p-6 sm:p-8 text-white shadow-2xl border border-white/10">
        <!-- Ambient decorative shapes -->
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-pink-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-white/10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pink-500/10 border border-pink-500/30 text-pink-300 text-xs font-bold uppercase tracking-wider mb-2">
                    <span class="w-2 h-2 rounded-full bg-pink-400 animate-pulse"></span>
                    Aquaboom Management Suite
                </div>
                <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Halo, {{ auth()->user()->name }}! 👋
                </h2>
                <p class="text-sm text-slate-300 mt-1 max-w-2xl font-medium">
                    Pantau kinerja penjualan tiket, kehadiran pengunjung hari ini, dan jalankan operasional gate secara real-time.
                </p>
            </div>

            @if(auth()->user()->canValidateTickets())
                <div class="shrink-0">
                    <a href="{{ route('scanner.app') }}" target="_blank" class="inline-flex items-center gap-2.5 px-5 py-3 rounded-2xl bg-gradient-to-r from-amber-500 via-amber-400 to-amber-500 hover:brightness-110 text-slate-950 font-black text-sm uppercase tracking-wider shadow-lg shadow-amber-500/20 transition-all transform active:scale-95">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        <span>Buka Scanner Gate</span>
                        <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </div>
            @endif
        </div>

        <!-- Quick Access Shortcuts Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3.5 pt-6">
            @if(auth()->user()->hasPermission('transactions'))
                <a href="{{ \App\Filament\Resources\TransactionResource::getUrl('index') }}" class="group p-4 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/5 hover:border-pink-500/30 transition-all duration-200 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-pink-500/20 text-pink-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <span class="text-xs text-slate-400 group-hover:text-white transition-colors">Lihat →</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-white group-hover:text-pink-300 transition-colors">Daftar Transaksi</h4>
                        <p class="text-[11px] text-slate-400 mt-0.5">Reschedule & pantau order</p>
                    </div>
                </a>
            @endif

            @if(auth()->user()->hasPermission('ticket_packages'))
                <a href="{{ \App\Filament\Resources\TicketPackageResource::getUrl('index') }}" class="group p-4 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/5 hover:border-amber-500/30 transition-all duration-200 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        <span class="text-xs text-slate-400 group-hover:text-white transition-colors">Atur →</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-white group-hover:text-amber-300 transition-colors">Paket & Harga</h4>
                        <p class="text-[11px] text-slate-400 mt-0.5">Tiket weekday, weekend, bundling</p>
                    </div>
                </a>
            @endif

            @if(auth()->user()->hasPermission('promos'))
                <a href="{{ \App\Filament\Resources\PromoCodeResource::getUrl('index') }}" class="group p-4 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/5 hover:border-emerald-500/30 transition-all duration-200 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                        <span class="text-xs text-slate-400 group-hover:text-white transition-colors">Kelola →</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-white group-hover:text-emerald-300 transition-colors">Kode Promo</h4>
                        <p class="text-[11px] text-slate-400 mt-0.5">Voucher diskon & promosi</p>
                    </div>
                </a>
            @endif

            @if(auth()->user()->hasPermission('settings'))
                <a href="{{ \App\Filament\Resources\SettingResource::getUrl('index') }}" class="group p-4 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/5 hover:border-sky-500/30 transition-all duration-200 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <span class="text-xs text-slate-400 group-hover:text-white transition-colors">Buka →</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-white group-hover:text-sky-300 transition-colors">Pengaturan Web</h4>
                        <p class="text-[11px] text-slate-400 mt-0.5">Kontak WhatsApp, jam buka</p>
                    </div>
                </a>
            @endif
        </div>
    </div>
</x-filament-widgets::widget>
