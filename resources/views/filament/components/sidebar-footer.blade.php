<div style="padding: 0.5rem 0.2rem; border-top: 1px solid rgba(255, 255, 255, 0.06); display: flex; flex-direction: column; gap: 0.35rem;">
    <!-- Expanded View -->
    <div x-show="$store.sidebar.isOpen" x-cloak style="display: flex; flex-direction: column; gap: 0.35rem;">
        <a href="{{ url('/') }}" target="_blank" style="display: flex; align-items: center; justify-content: space-between; padding: 0.45rem 0.75rem; border-radius: 0.65rem; font-size: 0.75rem; font-weight: 700; text-decoration: none; color: #cbd5e1; background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08); transition: all 0.2s ease;">
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <svg style="width: 0.95rem; height: 0.95rem; color: #38bdf8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                <span>Website Publik</span>
            </div>
            <span style="font-size: 0.7rem; color: #64748b;">↗</span>
        </a>
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.1rem 0.35rem; font-size: 0.62rem; color: #64748b; font-weight: 600;">
            <span>Aquaboom Engine</span>
            <span style="color: #10b981; font-weight: 800;">● v2.4</span>
        </div>
    </div>

    <!-- Collapsed View -->
    <div x-show="!$store.sidebar.isOpen" x-cloak style="display: flex; justify-content: center;">
        <a href="{{ url('/') }}" target="_blank" title="Buka Website Publik" style="display: flex; align-items: center; justify-content: center; width: 2.2rem; height: 2.2rem; border-radius: 0.65rem; color: #38bdf8; background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08); transition: all 0.2s ease;">
            <svg style="width: 1.1rem; height: 1.1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
            </svg>
        </a>
    </div>
</div>
