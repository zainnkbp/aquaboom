<div class="p-2 pt-2.5 border-t border-slate-200 dark:border-white/10 flex flex-col gap-1.5">
    <!-- Expanded View -->
    <div x-show="$store.sidebar.isOpen" x-cloak class="flex flex-col gap-1.5">
        <a href="{{ url('/') }}" target="_blank" class="flex items-center justify-between py-1.5 px-3 rounded-lg text-xs font-bold text-slate-700 dark:text-slate-200 bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 hover:bg-slate-200 dark:hover:bg-white/10 transition-colors">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-sky-500 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span>Website Publik</span>
            </div>
            <span class="text-[0.7rem] text-slate-400 dark:text-slate-500">↗</span>
        </a>
        <div class="flex items-center justify-between px-1 text-[0.62rem] text-slate-500 dark:text-slate-400 font-semibold">
            <span>Aquaboom Engine</span>
            <span class="text-emerald-500 font-extrabold">● v2.4</span>
        </div>
    </div>

    <!-- Collapsed View -->
    <div x-show="!$store.sidebar.isOpen" x-cloak class="flex justify-center">
        <a href="{{ url('/') }}" target="_blank" title="Buka Website Publik" class="flex items-center justify-center w-9 h-9 rounded-lg text-sky-500 dark:text-sky-400 bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 hover:bg-slate-200 dark:hover:bg-white/10 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
            </svg>
        </a>
    </div>
</div>
