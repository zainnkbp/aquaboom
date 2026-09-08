<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquaboom Command Center V2 — Glassmorphism Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/favicon-96x96.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Chart.js & Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.7/dist/cdn.min.js"></script>

    <style>
        :root {
            --primary: #f43f5e;
            --primary-glow: rgba(244, 63, 94, 0.4);
            --gold: #f59e0b;
            --gold-glow: rgba(245, 158, 11, 0.4);
            --cyan: #06b6d4;
            --cyan-glow: rgba(6, 182, 212, 0.4);
            --emerald: #10b981;
            --bg-base: #080614;
        }

        * {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background-color: var(--bg-base);
            color: #f8fafc;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Fluid Ambient Background Mesh Orbs */
        .ambient-mesh {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events-none;
            overflow: hidden;
        }
        .orb {
            position: absolute;
            border-radius: 9999px;
            filter: blur(120px);
            opacity: 0.28;
            animation: float 20s infinite ease-in-out alternate;
        }
        .orb-1 { width: 600px; height: 600px; background: #e11d48; top: -150px; left: -150px; }
        .orb-2 { width: 650px; height: 650px; background: #7c3aed; bottom: -200px; right: -100px; animation-duration: 25s; }
        .orb-3 { width: 500px; height: 500px; background: #0284c7; top: 35%; left: 45%; animation-duration: 22s; }
        .orb-4 { width: 450px; height: 450px; background: #d97706; top: 15%; right: 10%; opacity: 0.18; }

        @keyframes float {
            0% { transform: translate(0px, 0px) scale(1); }
            50% { transform: translate(40px, -30px) scale(1.08); }
            100% { transform: translate(-30px, 40px) scale(0.95); }
        }

        /* Glass Surface Base */
        .glass-panel {
            background: rgba(18, 14, 38, 0.6);
            backdrop-filter: blur(24px) saturate(190%);
            -webkit-backdrop-filter: blur(24px) saturate(190%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.12);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-panel:hover {
            border-color: rgba(255, 255, 255, 0.18);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.18);
        }

        /* Top Navigation Bar */
        .glass-nav {
            background: rgba(15, 11, 30, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            position: sticky;
            top: 0;
            z-index: 50;
            padding: 0.85rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand-logo-wrap {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            text-decoration: none;
        }
        .brand-badge-v2 {
            background: linear-gradient(135deg, #f43f5e, #e11d48);
            color: #ffffff;
            font-size: 0.65rem;
            font-weight: 900;
            padding: 0.2rem 0.5rem;
            border-radius: 0.5rem;
            letter-spacing: 0.08em;
            box-shadow: 0 0 12px var(--primary-glow);
        }

        /* Buttons */
        .btn-scanner {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #0f172a;
            font-weight: 800;
            font-size: 0.8rem;
            padding: 0.65rem 1.15rem;
            border-radius: 0.85rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 6px 20px -3px var(--gold-glow);
            transition: all 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .btn-scanner:hover {
            filter: brightness(1.1);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -2px var(--gold-glow);
        }

        .btn-ghost-nav {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #cbd5e1;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 0.6rem 1rem;
            border-radius: 0.85rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            transition: all 0.2s ease;
        }
        .btn-ghost-nav:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        /* Container Layout */
        .main-container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 2rem;
            position: relative;
            z-index: 10;
        }

        /* Hero Command Ribbon */
        .hero-banner {
            padding: 1.85rem 2.25rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, rgba(244, 63, 94, 0.15) 0%, rgba(139, 92, 246, 0.1) 40%, rgba(18, 14, 38, 0.75) 100%);
            border: 1px solid rgba(244, 63, 94, 0.25);
        }

        /* Grid Layouts */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        @media (max-width: 1024px) {
            .charts-grid { grid-template-columns: 1fr; }
        }

        .tables-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        @media (max-width: 1024px) {
            .tables-grid { grid-template-columns: 1fr; }
        }

        /* Metric Card Specifics */
        .metric-card {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .metric-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }
        .metric-title {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
        }
        .metric-icon-box {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
        }
        .icon-emerald { background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); }
        .icon-rose { background: rgba(244, 63, 94, 0.15); color: #fb7185; border: 1px solid rgba(244, 63, 94, 0.3); }
        .icon-amber { background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.3); }
        .icon-cyan { background: rgba(6, 182, 212, 0.15); color: #38bdf8; border: 1px solid rgba(6, 182, 212, 0.3); }

        .metric-val {
            font-size: 2rem;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: -0.03em;
            margin: 0.2rem 0;
            line-height: 1.1;
        }
        .metric-sub {
            font-size: 0.8rem;
            color: #94a3b8;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        /* Glass Table Styles */
        .table-card {
            padding: 1.75rem;
        }
        .card-header-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
        }
        .card-heading {
            font-size: 1.15rem;
            font-weight: 800;
            color: #ffffff;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .custom-glass-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.85rem;
        }
        .custom-glass-table th {
            padding: 0.85rem 1rem;
            color: #94a3b8;
            font-size: 0.725rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .custom-glass-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #e2e8f0;
        }
        .custom-glass-table tr:hover td {
            background: rgba(255, 255, 255, 0.03);
        }

        .pill-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.25rem 0.65rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .badge-paid { background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); }
        .badge-scanned { background: rgba(6, 182, 212, 0.15); color: #38bdf8; border: 1px solid rgba(6, 182, 212, 0.3); }
        .badge-pending { background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.3); }
        .badge-failed { background: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }
        .badge-unredeemed { background: rgba(148, 163, 184, 0.15); color: #94a3b8; border: 1px solid rgba(148, 163, 184, 0.3); }

        /* Modal Glass */
        .modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 100;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        .modal-card {
            background: rgba(20, 15, 42, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 1.5rem;
            width: 100%;
            max-width: 480px;
            padding: 2rem;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6);
        }
    </style>
</head>
<body x-data="{ 
    rescheduleModal: false,
    selectedId: null,
    selectedOrderId: '',
    selectedVisitDate: '',
    selectedNotes: '',
    openReschedule(id, orderId, visitDate, notes) {
        this.selectedId = id;
        this.selectedOrderId = orderId;
        this.selectedVisitDate = visitDate;
        this.selectedNotes = notes || '';
        this.rescheduleModal = true;
    }
}">

    <!-- Ambient Mesh Gradients -->
    <div class="ambient-mesh">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="orb orb-4"></div>
    </div>

    <!-- Glass Top Navigation Bar -->
    <header class="glass-nav">
        <div style="display: flex; align-items: center; gap: 1.5rem;">
            <a href="{{ route('admin.dashboard.v2') }}" class="brand-logo-wrap">
                <div style="width: 2.4rem; height: 2.4rem; border-radius: 0.75rem; background: linear-gradient(135deg, #f43f5e, #fb7185); display: flex; align-items: center; justify-content: center; font-weight: 900; color: #fff; font-size: 0.95rem; box-shadow: 0 0 15px var(--primary-glow);">
                    AQB
                </div>
                <div>
                    <div style="display: flex; align-items: center; gap: 0.4rem;">
                        <span style="font-weight: 900; font-size: 1.05rem; letter-spacing: -0.01em; color: #fff;">AQUABOOM</span>
                        <span class="brand-badge-v2">V2 GLASS</span>
                    </div>
                    <span style="font-size: 0.7rem; color: #94a3b8; font-weight: 600;">Command Center & Analytics</span>
                </div>
            </a>
        </div>

        <div style="display: flex; align-items: center; gap: 0.85rem;">
            <a href="{{ url('/admin') }}" class="btn-ghost-nav" title="Kembali ke Filament CMS">
                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>CMS Klasik</span>
            </a>

            @if($user->canValidateTickets())
                <a href="{{ route('scanner.app') }}" target="_blank" class="btn-scanner">
                    <svg style="width: 1.1rem; height: 1.1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                    </svg>
                    <span>Scanner Gate ↗</span>
                </a>
            @endif

            <div style="height: 1.5rem; width: 1px; background: rgba(255, 255, 255, 0.1); margin: 0 0.25rem;"></div>

            <div style="display: flex; align-items: center; gap: 0.65rem;">
                <div style="width: 2.2rem; height: 2.2rem; border-radius: 9999px; background: rgba(244, 63, 94, 0.2); border: 1px solid rgba(244, 63, 94, 0.4); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.85rem; color: #fb7185;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div style="display: flex; flex-direction: column;">
                    <span style="font-size: 0.8rem; font-weight: 800; color: #fff;">{{ $user->name }}</span>
                    <span style="font-size: 0.65rem; color: #f43f5e; font-weight: 700; text-transform: uppercase;">{{ $user->role }}</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="main-container">

        <!-- Flash Message Alerts -->
        @if(session('success'))
            <div style="margin-bottom: 1.5rem; padding: 1rem 1.5rem; border-radius: 1.25rem; background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: #34d399; font-weight: 700; font-size: 0.875rem; display: flex; align-items: center; gap: 0.75rem;">
                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Hero Command Ribbon -->
        <section class="glass-panel hero-banner">
            <div>
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.35rem 0.85rem; border-radius: 9999px; background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: #34d399; font-size: 0.72rem; font-weight: 800; text-transform: uppercase; margin-bottom: 0.65rem;">
                    <span style="width: 0.45rem; height: 0.45rem; border-radius: 9999px; background: #10b981; box-shadow: 0 0 8px #10b981;"></span>
                    <span>Sistem Operasional Waterpark Normal • Buka Hari Ini</span>
                </div>
                <h1 style="font-size: 1.85rem; font-weight: 900; color: #fff; margin: 0 0 0.4rem 0; letter-spacing: -0.02em;">
                    Halo, {{ $user->name }}! Selamat Datang di V2 Command Center 👋
                </h1>
                <p style="font-size: 0.875rem; color: #94a3b8; margin: 0; font-weight: 500;">
                    {{ now()->translatedFormat('l, d F Y') }} • Pantau analitik penjualan, manifest pengunjung gate, dan kinerja reservasi secara langsung.
                </p>
            </div>

            <!-- Quick Direct Link Buttons -->
            <div style="display: flex; flex-wrap: wrap; gap: 0.65rem;">
                @if($user->hasPermission('transactions'))
                    <a href="{{ \App\Filament\Resources\TransactionResource::getUrl('index') }}" class="btn-ghost-nav">
                        <svg style="width: 1rem; height: 1rem; color: #fb7185;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        <span>Kelola Transaksi</span>
                    </a>
                @endif
                @if($user->hasPermission('ticket_packages'))
                    <a href="{{ \App\Filament\Resources\TicketPackageResource::getUrl('index') }}" class="btn-ghost-nav">
                        <svg style="width: 1rem; height: 1rem; color: #fbbf24;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        <span>Katalog Tiket</span>
                    </a>
                @endif
                @if($user->hasPermission('promos'))
                    <a href="{{ \App\Filament\Resources\PromoCodeResource::getUrl('index') }}" class="btn-ghost-nav">
                        <svg style="width: 1rem; height: 1rem; color: #34d399;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        <span>Kode Promo</span>
                    </a>
                @endif
            </div>
        </section>

        <!-- 4 Glassmorphism Metric Cards -->
        <section class="metrics-grid">
            <!-- Metric 1: Sales Today -->
            <div class="glass-panel metric-card">
                <div>
                    <div class="metric-header">
                        <span class="metric-title">Penjualan Hari Ini</span>
                        <div class="metric-icon-box icon-emerald">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="metric-val">Rp {{ number_format($salesToday, 0, ',', '.') }}</div>
                </div>
                <p class="metric-sub">
                    <span style="color: #34d399; font-weight: 800;">✓ {{ $ordersTodayCount }} Transaksi</span>
                    <span>Lunas berhasil hari ini</span>
                </p>
            </div>

            <!-- Metric 2: Sales This Month -->
            <div class="glass-panel metric-card">
                <div>
                    <div class="metric-header">
                        <span class="metric-title">Omset Bulan Ini</span>
                        <div class="metric-icon-box icon-rose">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                    </div>
                    <div class="metric-val">Rp {{ number_format($salesThisMonth, 0, ',', '.') }}</div>
                </div>
                <p class="metric-sub">
                    <span style="color: #fb7185; font-weight: 800;">
                        {{ $salesLastMonth > 0 ? ($monthGrowthPercent >= 0 ? "+{$monthGrowthPercent}%" : "{$monthGrowthPercent}%") : 'Akumulasi' }}
                    </span>
                    <span>Bulan {{ now()->translatedFormat('F Y') }}</span>
                </p>
            </div>

            <!-- Metric 3: Today's Check-in Rate -->
            <div class="glass-panel metric-card">
                <div>
                    <div class="metric-header">
                        <span class="metric-title">Gate Check-in Hari Ini</span>
                        <div class="metric-icon-box icon-amber">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="metric-val">{{ $todayCheckedInPax }} / {{ $todayExpectedPax }} <span style="font-size: 1.1rem; color: #fbbf24;">Pax</span></div>
                </div>
                <div>
                    <!-- Progress Bar -->
                    <div style="width: 100%; height: 6px; border-radius: 9999px; background: rgba(255, 255, 255, 0.08); overflow: hidden; margin-bottom: 0.5rem;">
                        <div style="width: {{ $todayCheckInRate }}%; height: 100%; background: linear-gradient(90deg, #f59e0b, #e11d48); border-radius: 9999px; transition: width 1s ease;"></div>
                    </div>
                    <p class="metric-sub">
                        <span style="color: #fbbf24; font-weight: 800;">{{ $todayCheckInRate }}% Kehadiran</span>
                        <span>dari jadwal hari ini</span>
                    </p>
                </div>
            </div>

            <!-- Metric 4: Total Tickets Sold -->
            <div class="glass-panel metric-card">
                <div>
                    <div class="metric-header">
                        <span class="metric-title">Tiket Terjual Bulan Ini</span>
                        <div class="metric-icon-box icon-cyan">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                    </div>
                    <div class="metric-val">{{ number_format($ticketsSoldThisMonth, 0, ',', '.') }} <span style="font-size: 1.1rem; color: #38bdf8;">Pax</span></div>
                </div>
                <p class="metric-sub">
                    <span style="color: #38bdf8; font-weight: 800;">Total Pengunjung</span>
                    <span>terkonfirmasi bulan ini</span>
                </p>
            </div>
        </section>

        <!-- Charts Grid (2 Columns) -->
        <section class="charts-grid">
            <!-- Left Chart: 14-Day Sales & Attendance -->
            <div class="glass-panel" style="padding: 1.75rem;">
                <div class="card-header-flex">
                    <div>
                        <h3 class="card-heading">
                            <svg style="width: 1.25rem; height: 1.25rem; color: #f43f5e;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                            <span>Tren Pendapatan & Pengunjung (14 Hari)</span>
                        </h3>
                        <p style="font-size: 0.775rem; color: #94a3b8; margin: 0.25rem 0 0 0;">Fluktuasi omset harian dan volume pengunjung Aquaboom</p>
                    </div>
                </div>
                <div style="position: relative; height: 280px; width: 100%;">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Right Chart: Ticket Package Distribution -->
            <div class="glass-panel" style="padding: 1.75rem;">
                <div class="card-header-flex">
                    <div>
                        <h3 class="card-heading">
                            <svg style="width: 1.25rem; height: 1.25rem; color: #f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                            <span>Distribusi Paket Tiket</span>
                        </h3>
                        <p style="font-size: 0.775rem; color: #94a3b8; margin: 0.25rem 0 0 0;">Proporsi jenis tiket yang paling diminati pengunjung</p>
                    </div>
                </div>
                <div style="position: relative; height: 280px; width: 100%; display: flex; align-items: center; justify-content: center;">
                    <canvas id="distChart"></canvas>
                </div>
            </div>
        </section>

        <!-- Tables Grid (2 Columns) -->
        <section class="tables-grid">
            <!-- Left Table: Today's Manifest Gate Arrivals -->
            <div class="glass-panel table-card">
                <div class="card-header-flex">
                    <div>
                        <h3 class="card-heading">
                            <svg style="width: 1.25rem; height: 1.25rem; color: #10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            <span>Manifest Kedatangan Hari Ini (Gate)</span>
                        </h3>
                        <p style="font-size: 0.775rem; color: #94a3b8; margin: 0.25rem 0 0 0;">Daftar tamu yang dijadwalkan hadir ke gate waterpark hari ini</p>
                    </div>
                </div>

                @if($todayArrivals->isEmpty())
                    <div style="text-align: center; padding: 2.5rem 1rem; color: #64748b;">
                        <svg style="width: 2.5rem; height: 2.5rem; margin: 0 auto 0.5rem auto; opacity: 0.6;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p style="font-size: 0.875rem; margin: 0; font-weight: 600;">Tidak ada jadwal kedatangan tamu untuk hari ini.</p>
                    </div>
                @else
                    <div style="overflow-x: auto;">
                        <table class="custom-glass-table">
                            <thead>
                                <tr>
                                    <th>Kode Order</th>
                                    <th>Pengunjung</th>
                                    <th>Paket & Pax</th>
                                    <th>Pembayaran</th>
                                    <th>Gate Status</th>
                                    <th style="text-align: right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($todayArrivals as $tx)
                                    <tr>
                                        <td>
                                            <span style="font-family: monospace; font-weight: 800; color: #fbbf24;">#{{ substr($tx->order_id, 0, 8) }}</span>
                                        </td>
                                        <td>
                                            <div style="font-weight: 700; color: #fff;">{{ $tx->customer_name }}</div>
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $tx->customer_phone) }}" target="_blank" style="color: #34d399; font-size: 0.75rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.25rem;">
                                                <span>{{ $tx->customer_phone }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            @php
                                                $parts = [];
                                                foreach ($tx->items as $item) {
                                                    $parts[] = $item->quantity . 'x ' . ($item->ticketPackage?->name ?? 'Tiket');
                                                }
                                            @endphp
                                            <span style="font-size: 0.8rem; color: #cbd5e1;">{{ implode(', ', $parts) ?: '1x Tiket Masuk' }}</span>
                                        </td>
                                        <td>
                                            <span class="pill-badge badge-{{ $tx->status }}">
                                                {{ strtoupper($tx->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($tx->is_redeemed || $tx->status === 'scanned')
                                                <span class="pill-badge badge-scanned">
                                                    ✓ Checked In
                                                </span>
                                            @else
                                                <span class="pill-badge badge-unredeemed">
                                                    Belum Datang
                                                </span>
                                            @endif
                                        </td>
                                        <td style="text-align: right;">
                                            <div style="display: inline-flex; gap: 0.4rem;">
                                                @if(!$tx->is_redeemed && $tx->status === 'paid')
                                                    <form action="{{ route('admin.dashboard.v2.checkin', $tx->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn-ghost-nav" style="padding: 0.35rem 0.65rem; font-size: 0.725rem; color: #34d399; border-color: rgba(16, 185, 129, 0.3);">
                                                            Check-in
                                                        </button>
                                                    </form>
                                                @endif
                                                <button 
                                                    type="button" 
                                                    @click="openReschedule({{ $tx->id }}, '{{ $tx->order_id }}', '{{ $tx->visit_date?->format('Y-m-d') }}', '{{ addslashes($tx->notes ?? '') }}')"
                                                    class="btn-ghost-nav" 
                                                    style="padding: 0.35rem 0.65rem; font-size: 0.725rem; color: #fbbf24; border-color: rgba(245, 158, 11, 0.3);"
                                                >
                                                    Reschedule
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Right Table: Recent Orders -->
            <div class="glass-panel table-card">
                <div class="card-header-flex">
                    <div>
                        <h3 class="card-heading">
                            <svg style="width: 1.25rem; height: 1.25rem; color: #38bdf8;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            <span>Pesanan Terbaru</span>
                        </h3>
                        <p style="font-size: 0.775rem; color: #94a3b8; margin: 0.25rem 0 0 0;">8 transaksi terakhir yang masuk ke sistem</p>
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    <table class="custom-glass-table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ \App\Filament\Resources\TransactionResource::getUrl('edit', ['record' => $order]) }}" style="font-family: monospace; font-weight: 800; color: #fb7185; text-decoration: none;">
                                            #{{ substr($order->order_id, 0, 8) }}
                                        </a>
                                        <div style="font-size: 0.675rem; color: #64748b;">{{ $order->created_at?->diffForHumans() }}</div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 700; color: #fff;">{{ $order->customer_name }}</div>
                                        <div style="font-size: 0.7rem; color: #94a3b8;">Tgl Kunjungan: {{ $order->visit_date?->format('d/m/y') }}</div>
                                    </td>
                                    <td style="font-weight: 800; color: #fff;">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <span class="pill-badge badge-{{ $order->status }}">
                                            {{ strtoupper($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <!-- Frosted Reschedule Modal (Alpine.js) -->
    <div x-show="rescheduleModal" style="display: none;" class="modal-overlay" @keydown.escape.window="rescheduleModal = false">
        <div class="glass-panel modal-card" @click.away="rescheduleModal = false">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #fff; margin: 0;">
                    Reschedule Tanggal Kunjungan
                </h3>
                <button @click="rescheduleModal = false" style="background: rgba(255, 255, 255, 0.1); border: none; color: #fff; width: 2rem; height: 2rem; border-radius: 9999px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                    ✕
                </button>
            </div>

            <form :action="'/admin/dashboard/v2/reschedule/' + selectedId" method="POST">
                @csrf
                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.4rem;">
                        Kode Tiket
                    </label>
                    <input type="text" :value="selectedOrderId" disabled style="width: 100%; padding: 0.75rem 1rem; border-radius: 0.85rem; background: rgba(0, 0, 0, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); color: #fbbf24; font-weight: 800; font-family: monospace;">
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.4rem;">
                        Tanggal Kunjungan Baru
                    </label>
                    <input type="date" name="visit_date" x-model="selectedVisitDate" required style="width: 100%; padding: 0.75rem 1rem; border-radius: 0.85rem; background: rgba(0, 0, 0, 0.4); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; font-weight: 700;">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.4rem;">
                        Catatan Reschedule
                    </label>
                    <textarea name="notes" x-model="selectedNotes" rows="3" placeholder="Alasan perubahan tanggal dari customer..." style="width: 100%; padding: 0.75rem 1rem; border-radius: 0.85rem; background: rgba(0, 0, 0, 0.4); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; font-size: 0.85rem;"></textarea>
                </div>

                <div style="display: flex; gap: 0.75rem;">
                    <button type="button" @click="rescheduleModal = false" class="btn-ghost-nav" style="flex: 1; justify-content: center; padding: 0.75rem;">
                        Batal
                    </button>
                    <button type="submit" class="btn-scanner" style="flex: 1; justify-content: center; padding: 0.75rem; border: none; cursor: pointer;">
                        Simpan Jadwal Baru
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Chart.js Setup Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Line Chart: 14-Day Sales Trend
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            const salesGradient = salesCtx.createLinearGradient(0, 0, 0, 260);
            salesGradient.addColorStop(0, 'rgba(244, 63, 94, 0.35)');
            salesGradient.addColorStop(1, 'rgba(244, 63, 94, 0.0)');

            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: @json($chartRevenue),
                        borderColor: '#f43f5e',
                        borderWidth: 3,
                        backgroundColor: salesGradient,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#f43f5e',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(18, 14, 38, 0.9)',
                            titleColor: '#f8fafc',
                            bodyColor: '#fb7185',
                            borderColor: 'rgba(244, 63, 94, 0.4)',
                            borderWidth: 1,
                            padding: 12,
                            boxPadding: 6,
                            usePointStyle: true,
                            callbacks: {
                                label: function(context) {
                                    return ' Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { color: 'rgba(255, 255, 255, 0.04)' },
                            ticks: { color: '#94a3b8', font: { size: 11, weight: '600' } }
                        },
                        y: {
                            grid: { color: 'rgba(255, 255, 255, 0.04)' },
                            ticks: {
                                color: '#94a3b8',
                                font: { size: 11, weight: '600' },
                                callback: function(val) {
                                    return 'Rp ' + (val / 1000).toFixed(0) + 'k';
                                }
                            }
                        }
                    }
                }
            });

            // 2. Doughnut Chart: Ticket Package Distribution
            const distCtx = document.getElementById('distChart').getContext('2d');
            new Chart(distCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($distLabels),
                    datasets: [{
                        data: @json($distData),
                        backgroundColor: [
                            '#f43f5e',
                            '#f59e0b',
                            '#06b6d4',
                            '#8b5cf6',
                            '#10b981',
                            '#3b82f6',
                            '#ec4899',
                        ],
                        borderColor: '#080614',
                        borderWidth: 3,
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#cbd5e1',
                                font: { size: 11, weight: '700' },
                                padding: 14,
                                boxWidth: 10,
                                boxHeight: 10,
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(18, 14, 38, 0.9)',
                            titleColor: '#f8fafc',
                            borderColor: 'rgba(255, 255, 255, 0.15)',
                            borderWidth: 1,
                            padding: 10,
                            callbacks: {
                                label: function(context) {
                                    return ' ' + context.label + ': ' + context.parsed + ' Pax';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
