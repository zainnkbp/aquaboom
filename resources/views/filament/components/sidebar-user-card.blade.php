@php
    $user = auth()->user();
@endphp
@if($user)
    <!-- Expanded Staff Profile Card -->
    <div x-show="$store.sidebar.isOpen" x-cloak class="mb-2.5 p-2.5 rounded-xl bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 flex items-center gap-2.5 transition-colors">
        <div class="w-8 h-8 rounded-lg bg-rose-500/10 dark:bg-rose-500/20 border border-rose-500/30 text-rose-600 dark:text-rose-400 flex items-center justify-center font-extrabold text-xs shrink-0">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div class="flex-1 min-w-0">
            <div class="text-xs font-bold text-slate-800 dark:text-white truncate">
                {{ $user->name }}
            </div>
            <div class="flex items-center gap-1.5 mt-0.5">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-[0_0_6px_#10b981]"></span>
                <span class="text-[0.6rem] text-rose-600 dark:text-rose-400 font-bold uppercase tracking-wider">{{ $user->role }}</span>
            </div>
        </div>
    </div>

    <!-- Collapsed Staff Profile Icon -->
    <div x-show="!$store.sidebar.isOpen" x-cloak class="flex justify-center mb-2.5" title="{{ $user->name }} ({{ $user->role }})">
        <div class="w-9 h-9 rounded-xl bg-rose-500/10 dark:bg-rose-500/20 border border-rose-500/30 text-rose-600 dark:text-rose-400 flex items-center justify-center font-extrabold text-sm shadow-sm">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
    </div>
@endif
