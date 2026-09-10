@php
    $user = auth()->user();
@endphp
@if($user)
    <!-- Expanded Staff Profile Card -->
    <div x-show="$store.sidebar.isOpen" x-cloak class="aqb-user-card" style="margin: 0 0 0.65rem 0; padding: 0.6rem 0.75rem; border-radius: 0.85rem; display: flex; align-items: center; gap: 0.65rem;">
        <div style="width: 2rem; height: 2rem; border-radius: 0.6rem; background: rgba(244, 63, 94, 0.15); border: 1px solid rgba(244, 63, 94, 0.35); color: #fb7185; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.8rem; flex-shrink: 0;">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div style="flex: 1; min-width: 0;">
            <div class="aqb-user-name" style="font-size: 0.78rem; font-weight: 800; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                {{ $user->name }}
            </div>
            <div style="display: flex; align-items: center; gap: 0.35rem; margin-top: 0.1rem;">
                <span style="width: 0.35rem; height: 0.35rem; border-radius: 9999px; background: #10b981; box-shadow: 0 0 6px #10b981;"></span>
                <span style="font-size: 0.6rem; color: #fb7185; font-weight: 700; text-transform: uppercase;">{{ $user->role }}</span>
            </div>
        </div>
    </div>

    <!-- Collapsed Staff Profile Icon -->
    <div x-show="!$store.sidebar.isOpen" x-cloak style="display: flex; justify-content: center; margin-bottom: 0.65rem;" title="{{ $user->name }} ({{ $user->role }})">
        <div style="width: 2.2rem; height: 2.2rem; border-radius: 0.65rem; background: rgba(244, 63, 94, 0.18); border: 1px solid rgba(244, 63, 94, 0.35); color: #fb7185; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.85rem;">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
    </div>
@endif
