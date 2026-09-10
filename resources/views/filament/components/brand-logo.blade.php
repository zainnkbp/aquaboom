<div class="flex items-center gap-2.5 no-underline overflow-hidden">
    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-rose-500 to-rose-700 flex items-center justify-center shadow-lg shadow-rose-500/30 shrink-0 overflow-hidden border border-white/20">
        <img src="{{ asset('logo/favicon-96x96.png') }}" alt="AQB" class="w-full h-full object-cover" />
    </div>
    <div x-show="$store.sidebar.isOpen" x-cloak class="flex flex-col leading-tight min-w-0">
        <div class="flex items-center gap-1.5">
            <span class="text-base font-black tracking-tight text-slate-900 dark:text-white">AQUABOOM</span>
            <span class="bg-gradient-to-r from-rose-500 to-rose-600 text-white text-[0.55rem] font-black px-1.5 py-0.5 rounded tracking-wider shadow-sm">CMS</span>
        </div>
        <span class="text-[0.62rem] text-slate-500 dark:text-slate-400 font-semibold tracking-wide mt-0.5">Waterpark Management</span>
    </div>
</div>
