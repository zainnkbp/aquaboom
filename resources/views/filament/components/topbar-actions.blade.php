@php
    $user = auth()->user();
@endphp
<div class="flex items-center gap-2 mr-1">
    <!-- Live Operational Badge -->
    <div class="hidden sm:flex items-center gap-1.5 py-1 px-2.5 rounded-full bg-emerald-500/10 dark:bg-emerald-500/15 border border-emerald-500/25 text-emerald-600 dark:text-emerald-400 text-[0.7rem] font-extrabold uppercase tracking-wide">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-[0_0_6px_#10b981] animate-pulse"></span>
        <span>Buka Hari Ini • Live</span>
    </div>

    <!-- Date Badge -->
    <div class="hidden md:flex items-center gap-1.5 py-1 px-2.5 rounded-lg bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-300 text-xs font-semibold">
        <svg class="w-3.5 h-3.5 text-slate-500 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <span>{{ now()->translatedFormat('d M Y') }}</span>
    </div>

    <!-- Quick Action: Scanner Gate -->
    @if($user && $user->canValidateTickets())
        <a href="{{ route('scanner.app') }}" target="_blank" class="inline-flex items-center gap-1.5 py-1 px-3 rounded-lg bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 font-extrabold text-xs shadow-md uppercase tracking-wider hover:opacity-95 transition-opacity">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
            </svg>
            <span class="hidden sm:inline">Scanner Gate ↗</span>
        </a>
    @endif

    <!-- Quick Action: Web Publik -->
    <a href="{{ url('/') }}" target="_blank" class="hidden lg:inline-flex items-center gap-1.5 py-1 px-2.5 rounded-lg bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-700 dark:text-slate-200 font-bold text-xs hover:bg-slate-200 dark:hover:bg-white/10 transition-colors">
        <svg class="w-3.5 h-3.5 text-sky-500 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
        </svg>
        <span>Web Publik ↗</span>
    </a>

    <!-- Divider -->
    <div class="h-5 w-px bg-slate-200 dark:bg-white/10 mx-0.5"></div>

    <!-- Staff Info Chip -->
    @if($user)
        <div class="hidden sm:flex items-center gap-2">
            <div class="flex flex-col text-right leading-tight">
                <span class="text-xs font-extrabold text-slate-800 dark:text-white">{{ $user->name }}</span>
                <span class="text-[0.6rem] text-rose-600 dark:text-rose-400 font-bold uppercase tracking-wider">{{ $user->role }}</span>
            </div>
        </div>
    @endif
</div>
