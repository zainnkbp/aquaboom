<x-filament-widgets::widget>
    <style>
        .aqb-ribbon {
            background: linear-gradient(135deg, rgba(244, 63, 94, 0.15) 0%, rgba(139, 92, 246, 0.1) 40%, rgba(15, 23, 42, 0.8) 100%);
            border: 1px solid rgba(244, 63, 94, 0.25);
            border-radius: 1.25rem;
            padding: 1.25rem 1.75rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1.25rem;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            margin-bottom: 0.25rem;
        }
        .aqb-ribbon::before {
            content: '';
            position: absolute;
            top: -40px;
            right: 20%;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.2) 0%, transparent 70%);
            filter: blur(30px);
            pointer-events-none;
        }
        .aqb-ribbon-left {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            position: relative;
            z-index: 2;
        }
        .aqb-ribbon-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #f472b6;
        }
        .aqb-ribbon-pulse {
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 9999px;
            background-color: #10b981;
            box-shadow: 0 0 10px #10b981;
            display: inline-block;
        }
        .aqb-ribbon-heading {
            font-size: 1.45rem;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: -0.02em;
            margin: 0;
            line-height: 1.2;
        }
        .aqb-ribbon-sub {
            font-size: 0.8rem;
            color: #94a3b8;
            margin: 0;
            font-weight: 500;
        }
        .aqb-ribbon-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.65rem;
            position: relative;
            z-index: 2;
        }
        .aqb-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #0f172a !important;
            font-weight: 800;
            font-size: 0.825rem;
            padding: 0.65rem 1.15rem;
            border-radius: 0.85rem;
            text-decoration: none;
            box-shadow: 0 8px 16px -4px rgba(245, 158, 11, 0.4);
            transition: all 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .aqb-btn-primary:hover {
            filter: brightness(1.1);
            transform: translateY(-2px);
            box-shadow: 0 12px 20px -3px rgba(245, 158, 11, 0.5);
            color: #000 !important;
        }
        .aqb-btn-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e2e8f0 !important;
            font-weight: 700;
            font-size: 0.8rem;
            padding: 0.65rem 1rem;
            border-radius: 0.85rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .aqb-btn-pill:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(244, 63, 94, 0.4);
            color: #ffffff !important;
            transform: translateY(-2px);
        }
    </style>

    <div class="aqb-ribbon">
        <div class="aqb-ribbon-left">
            <div class="aqb-ribbon-badge">
                <span class="aqb-ribbon-pulse"></span>
                <span>Waterpark Online • Lantai 7 Pentacity Mall</span>
            </div>
            <h2 class="aqb-ribbon-heading">
                Selamat Datang, {{ auth()->user()->name }}! 👋
            </h2>
            <p class="aqb-ribbon-sub">
                {{ now()->translatedFormat('l, d F Y') }} • Pantau performa reservasi & check-in gate secara real-time.
            </p>
        </div>

        <div class="aqb-ribbon-actions">
            <a href="{{ route('admin.dashboard.v2') }}" class="aqb-btn-pill" style="border-color: rgba(244, 63, 94, 0.4); background: rgba(244, 63, 94, 0.15); color: #fb7185 !important; font-weight: 800;">
                <svg style="width: 1rem; height: 1rem; color: #fb7185;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                </svg>
                <span>Dashboard V2 Glass ↗</span>
            </a>

            @if(auth()->user()->canValidateTickets())
                <a href="{{ route('scanner.app') }}" target="_blank" class="aqb-btn-primary">
                    <svg style="width: 1.15rem; height: 1.15rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                    </svg>
                    <span>Buka Scanner Gate ↗</span>
                </a>
            @endif

            @if(auth()->user()->hasPermission('transactions'))
                <a href="{{ \App\Filament\Resources\TransactionResource::getUrl('index') }}" class="aqb-btn-pill">
                    <svg style="width: 1rem; height: 1rem; color: #fb7185;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span>Transaksi & Reschedule</span>
                </a>
            @endif

            @if(auth()->user()->hasPermission('ticket_packages'))
                <a href="{{ \App\Filament\Resources\TicketPackageResource::getUrl('index') }}" class="aqb-btn-pill">
                    <svg style="width: 1rem; height: 1rem; color: #fbbf24;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                    <span>Katalog & Harga</span>
                </a>
            @endif

            @if(auth()->user()->hasPermission('promos'))
                <a href="{{ \App\Filament\Resources\PromoCodeResource::getUrl('index') }}" class="aqb-btn-pill">
                    <svg style="width: 1rem; height: 1rem; color: #34d399;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <span>Kode Promo</span>
                </a>
            @endif
        </div>
    </div>
</x-filament-widgets::widget>
