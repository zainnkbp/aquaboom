@php
    $user = auth()->user();
@endphp
@if($user)
    <div style="margin: 0.5rem 0.5rem 1rem 0.5rem; padding: 0.75rem 0.85rem; border-radius: 1rem; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.07); display: flex; align-items: center; gap: 0.75rem; box-shadow: 0 4px 15px -3px rgba(0, 0, 0, 0.2);">
        <div style="width: 2.25rem; height: 2.25rem; border-radius: 0.75rem; background: rgba(244, 63, 94, 0.15); border: 1px solid rgba(244, 63, 94, 0.35); color: #fb7185; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.85rem; flex-shrink: 0; box-shadow: 0 0 10px rgba(244, 63, 94, 0.2);">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div style="flex: 1; min-width: 0;">
            <div style="font-size: 0.8rem; font-weight: 800; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                {{ $user->name }}
            </div>
            <div style="display: flex; align-items: center; gap: 0.4rem; margin-top: 0.15rem;">
                <span style="width: 0.4rem; height: 0.4rem; border-radius: 9999px; background: #10b981; box-shadow: 0 0 6px #10b981;"></span>
                <span style="font-size: 0.62rem; color: #fb7185; font-weight: 700; text-transform: uppercase; letter-spacing: 0.03em;">{{ $user->role }}</span>
            </div>
        </div>
    </div>
@endif
