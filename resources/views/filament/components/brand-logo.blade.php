<div style="display: flex; align-items: center; gap: 0.65rem; text-decoration: none; overflow: hidden;">
    <div style="width: 2.2rem; height: 2.2rem; border-radius: 0.65rem; background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%); display: flex; align-items: center; justify-content: center; box-shadow: 0 0 14px rgba(244, 63, 94, 0.4); flex-shrink: 0; overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.2);">
        <img src="{{ asset('logo/favicon-96x96.png') }}" alt="AQB" style="width: 100%; height: 100%; object-fit: cover;" />
    </div>
    <div x-show="$store.sidebar.isOpen" x-cloak style="display: flex; flex-direction: column; line-height: 1.1; min-width: 0;">
        <div style="display: flex; align-items: center; gap: 0.35rem;">
            <span class="aqb-brand-text" style="font-size: 0.98rem; font-weight: 900; letter-spacing: -0.02em;">AQUABOOM</span>
            <span style="background: linear-gradient(135deg, #f43f5e, #e11d48); color: #fff; font-size: 0.55rem; font-weight: 900; padding: 0.1rem 0.35rem; border-radius: 0.3rem; letter-spacing: 0.08em; box-shadow: 0 0 8px rgba(244, 63, 94, 0.4);">CMS</span>
        </div>
        <span style="font-size: 0.62rem; color: #94a3b8; font-weight: 600; letter-spacing: 0.02em; margin-top: 0.12rem;">Waterpark Management</span>
    </div>
</div>
