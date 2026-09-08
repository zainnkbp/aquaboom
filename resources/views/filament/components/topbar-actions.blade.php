@php
    $user = auth()->user();
@endphp
<div style="display: flex; align-items: center; gap: 0.85rem; margin-right: 0.5rem;">
    <!-- Live Operational Badge -->
    <div class="hidden sm:flex" style="align-items: center; gap: 0.45rem; padding: 0.35rem 0.75rem; border-radius: 9999px; background: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.25); color: #34d399; font-size: 0.72rem; font-weight: 800; text-transform: uppercase;">
        <span style="width: 0.45rem; height: 0.45rem; border-radius: 9999px; background: #10b981; box-shadow: 0 0 8px #10b981; animation: pulse 2s infinite;"></span>
        <span>Buka Hari Ini • Live</span>
    </div>

    <!-- Date Badge -->
    <div class="hidden md:flex" style="align-items: center; gap: 0.4rem; padding: 0.35rem 0.65rem; border-radius: 0.65rem; background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08); color: #94a3b8; font-size: 0.75rem; font-weight: 600;">
        <svg style="width: 0.9rem; height: 0.9rem; color: #cbd5e1;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <span>{{ now()->translatedFormat('d M Y') }}</span>
    </div>

    <!-- Quick Action: Scanner Gate -->
    @if($user && $user->canValidateTickets())
        <a href="{{ route('scanner.app') }}" target="_blank" style="display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.4rem 0.85rem; border-radius: 0.65rem; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #0f172a; font-weight: 800; font-size: 0.75rem; text-decoration: none; box-shadow: 0 4px 15px -2px rgba(245, 158, 11, 0.4); text-transform: uppercase; letter-spacing: 0.03em;">
            <svg style="width: 0.95rem; height: 0.95rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
            </svg>
            <span class="hidden sm:inline">Scanner Gate ↗</span>
        </a>
    @endif

    <!-- Quick Action: Web Publik -->
    <a href="{{ url('/') }}" target="_blank" class="hidden lg:inline-flex" style="align-items: center; gap: 0.4rem; padding: 0.4rem 0.75rem; border-radius: 0.65rem; background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08); color: #cbd5e1; font-weight: 700; font-size: 0.75rem; text-decoration: none; transition: all 0.2s;">
        <svg style="width: 0.9rem; height: 0.9rem; color: #38bdf8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
        </svg>
        <span>Web Publik ↗</span>
    </a>

    <!-- Divider -->
    <div style="height: 1.5rem; width: 1px; background: rgba(255, 255, 255, 0.1); margin: 0 0.15rem;"></div>

    <!-- Staff Info Chip -->
    @if($user)
        <div class="hidden sm:flex" style="align-items: center; gap: 0.55rem;">
            <div style="display: flex; flex-direction: column; text-align: right; line-height: 1.15;">
                <span style="font-size: 0.8rem; font-weight: 800; color: #fff;">{{ $user->name }}</span>
                <span style="font-size: 0.62rem; color: #fb7185; font-weight: 700; text-transform: uppercase;">{{ $user->role }}</span>
            </div>
        </div>
    @endif
</div>
