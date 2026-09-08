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
            --sidebar-w: 285px;
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

        /* App Layout (Sidebar + Main Wrapper) */
        .app-layout {
            display: flex;
            min-height: 100vh;
            position: relative;
            z-index: 10;
        }

        /* Glass Sidebar */
        .glass-sidebar {
            width: var(--sidebar-w);
            flex-shrink: 0;
            height: 100vh;
            position: sticky;
            top: 0;
            display: flex;
            flex-direction: column;
            background: rgba(12, 9, 26, 0.82);
            backdrop-filter: blur(28px) saturate(200%);
            -webkit-backdrop-filter: blur(28px) saturate(200%);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            z-index: 40;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-scroll-area {
            flex: 1;
            overflow-y: auto;
            padding: 1.25rem 1rem;
        }
        .sidebar-scroll-area::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-scroll-area::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.12);
            border-radius: 9999px;
        }

        .sidebar-brand {
            padding: 1.25rem 1.25rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .brand-crest {
            width: 2.35rem;
            height: 2.35rem;
            border-radius: 0.75rem;
            background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            color: #fff;
            font-size: 0.95rem;
            box-shadow: 0 0 16px var(--primary-glow);
            flex-shrink: 0;
            overflow: hidden;
        }

        .brand-crest img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .brand-title {
            font-size: 1rem;
            font-weight: 900;
            letter-spacing: -0.01em;
            color: #ffffff;
            margin: 0;
            line-height: 1.2;
        }
        .brand-subtitle {
            font-size: 0.68rem;
            color: #94a3b8;
            font-weight: 600;
            margin: 0;
        }

        .brand-badge-v2 {
            background: linear-gradient(135deg, #f43f5e, #e11d48);
            color: #ffffff;
            font-size: 0.62rem;
            font-weight: 900;
            padding: 0.15rem 0.45rem;
            border-radius: 0.4rem;
            letter-spacing: 0.08em;
            box-shadow: 0 0 10px var(--primary-glow);
            display: inline-block;
        }

        /* Staff Profile Box in Sidebar */
        .sidebar-user-card {
            margin: 0.75rem 0 1.25rem;
            padding: 0.85rem;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .sidebar-user-avatar {
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 0.75rem;
            background: rgba(244, 63, 94, 0.18);
            border: 1px solid rgba(244, 63, 94, 0.35);
            color: #fb7185;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        /* Navigation Groups & Links */
        .nav-group-label {
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #64748b;
            padding: 0.75rem 0.65rem 0.35rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-item-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.58rem 0.8rem;
            border-radius: 0.75rem;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.825rem;
            font-weight: 600;
            margin-bottom: 0.2rem;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid transparent;
        }

        .nav-item-link:hover {
            background: rgba(255, 255, 255, 0.06);
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.08);
            transform: translateX(3px);
        }

        .nav-item-link.active {
            background: linear-gradient(135deg, rgba(244, 63, 94, 0.2) 0%, rgba(139, 92, 246, 0.15) 100%);
            border-color: rgba(244, 63, 94, 0.45);
            color: #ffffff;
            font-weight: 700;
            box-shadow: 0 4px 20px -2px rgba(244, 63, 94, 0.25);
        }

        .nav-item-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nav-icon {
            width: 1.15rem;
            height: 1.15rem;
            flex-shrink: 0;
            color: #94a3b8;
            transition: color 0.2s;
        }

        .nav-item-link:hover .nav-icon {
            color: #ffffff;
        }

        .nav-item-link.active .nav-icon {
            color: #fb7185;
        }

        .nav-badge {
            font-size: 0.65rem;
            font-weight: 800;
            padding: 0.15rem 0.45rem;
            border-radius: 0.4rem;
            background: rgba(255, 255, 255, 0.08);
            color: #cbd5e1;
        }

        .nav-badge-v2 {
            background: rgba(244, 63, 94, 0.25);
            color: #fb7185;
            border: 1px solid rgba(244, 63, 94, 0.3);
        }

        .nav-badge-gate {
            background: rgba(245, 158, 11, 0.25);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .btn-sidebar-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.55rem 0.8rem;
            border-radius: 0.65rem;
            font-size: 0.78rem;
            font-weight: 600;
            text-decoration: none;
            color: #94a3b8;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.2s ease;
        }
        .btn-sidebar-footer:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.12);
        }

        .btn-logout {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.55rem 0.8rem;
            border-radius: 0.65rem;
            font-size: 0.78rem;
            font-weight: 700;
            color: #f87171;
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.2);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.18);
            color: #fca5a5;
            border-color: rgba(239, 68, 68, 0.4);
        }

        /* Main Content Wrapper */
        .main-wrapper {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Top Navigation Bar */
        .glass-nav {
            background: rgba(15, 11, 30, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            position: sticky;
            top: 0;
            z-index: 30;
            padding: 0.85rem 1.85rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .btn-hamburger {
            display: none;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #ffffff;
            padding: 0.5rem;
            border-radius: 0.65rem;
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        .breadcrumb-wrap {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.825rem;
            font-weight: 600;
            color: #94a3b8;
        }
        .breadcrumb-wrap span {
            color: #cbd5e1;
        }
        .breadcrumb-active {
            color: #ffffff !important;
            font-weight: 800;
        }

        /* Buttons */
        .btn-scanner {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #0f172a;
            font-weight: 800;
            font-size: 0.78rem;
            padding: 0.55rem 1rem;
            border-radius: 0.75rem;
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
            font-size: 0.78rem;
            font-weight: 700;
            padding: 0.55rem 0.95rem;
            border-radius: 0.75rem;
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

        /* Container Layout inside Main */
        .main-container {
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            padding: 1.85rem;
            position: relative;
            z-index: 10;
        }

        /* Glass Surface Base */
        .glass-panel {
            background: rgba(18, 14, 38, 0.6);
            backdrop-filter: blur(24px) saturate(190%);
            -webkit-backdrop-filter: blur(24px) saturate(190%);
            border: 1px solid rgba(255, 255, 255, 0.09);
            border-radius: 1.35rem;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-panel:hover {
            border-color: rgba(255, 255, 255, 0.16);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        /* Hero Command Ribbon */
        .hero-banner {
            padding: 1.65rem 2rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1.25rem;
            margin-bottom: 1.75rem;
            background: linear-gradient(135deg, rgba(244, 63, 94, 0.15) 0%, rgba(139, 92, 246, 0.1) 40%, rgba(18, 14, 38, 0.75) 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            background: radial-gradient(circle at 90% 20%, rgba(244, 63, 94, 0.15), transparent 45%);
            pointer-events: none;
        }

        /* Metrics Grid */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.75rem;
        }

        .metric-card {
            padding: 1.35rem 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .metric-card::after {
            content: '';
            position: absolute;
            top: 0; right: 0; width: 80px; height: 80px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            pointer-events: none;
        }
        .metric-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }
        .metric-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: #94a3b8;
            font-weight: 800;
        }
        .metric-icon-box {
            width: 2.35rem;
            height: 2.35rem;
            border-radius: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .icon-emerald { background: rgba(16, 185, 129, 0.15); color: #34d399; }
        .icon-rose { background: rgba(244, 63, 94, 0.15); color: #fb7185; }
        .icon-amber { background: rgba(245, 158, 11, 0.15); color: #fbbf24; }
        .icon-cyan { background: rgba(6, 182, 212, 0.15); color: #38bdf8; }

        .metric-val {
            font-size: 1.75rem;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: -0.02em;
            margin-bottom: 0.4rem;
        }
        .metric-sub {
            font-size: 0.72rem;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        /* Analytics Section (2 Charts) */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.25rem;
            margin-bottom: 1.75rem;
        }
        @media (max-width: 1024px) {
            .charts-grid { grid-template-columns: 1fr; }
        }

        .chart-box {
            padding: 1.5rem;
        }
        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
        }

        /* Operational Tables */
        .section-header-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .glass-table-wrap {
            overflow-x: auto;
            border-radius: 1.25rem;
        }
        .glass-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.825rem;
        }
        .glass-table th {
            background: rgba(255, 255, 255, 0.04);
            padding: 0.95rem 1.15rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.7rem;
            color: #94a3b8;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .glass-table td {
            padding: 1rem 1.15rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #e2e8f0;
            vertical-align: middle;
        }
        .glass-table tr:hover td {
            background: rgba(255, 255, 255, 0.03);
        }

        /* Badges */
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.22rem 0.65rem;
            border-radius: 9999px;
            font-size: 0.68rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .status-paid { background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); }
        .status-scanned { background: rgba(6, 182, 212, 0.15); color: #38bdf8; border: 1px solid rgba(6, 182, 212, 0.3); }
        .status-pending { background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.3); }
        .status-expired { background: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }

        /* Action Buttons in Table */
        .btn-action-reschedule {
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: #fbbf24;
            padding: 0.35rem 0.75rem;
            border-radius: 0.6rem;
            font-weight: 800;
            font-size: 0.72rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-action-reschedule:hover {
            background: rgba(245, 158, 11, 0.3);
            color: #fff;
            transform: scale(1.03);
        }

        .btn-action-checkin {
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.4);
            color: #34d399;
            padding: 0.35rem 0.75rem;
            border-radius: 0.6rem;
            font-weight: 800;
            font-size: 0.72rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-action-checkin:hover {
            background: rgba(16, 185, 129, 0.35);
            color: #fff;
            transform: scale(1.03);
        }

        /* Modal Overlay */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(5, 3, 15, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        .modal-card {
            width: 100%;
            max-width: 480px;
            background: rgba(20, 15, 42, 0.92);
            backdrop-filter: blur(32px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.8), 0 0 40px rgba(244, 63, 94, 0.15);
        }

        /* Mobile Drawer for Sidebar */
        .sidebar-backdrop {
            display: none;
        }

        @media (max-width: 1024px) {
            .glass-sidebar {
                position: fixed;
                left: 0;
                top: 0;
                bottom: 0;
                transform: translateX(-100%);
                z-index: 60;
                box-shadow: 15px 0 30px rgba(0,0,0,0.5);
            }
            .glass-sidebar.sidebar-open {
                transform: translateX(0);
            }
            .sidebar-backdrop {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.7);
                backdrop-filter: blur(6px);
                -webkit-backdrop-filter: blur(6px);
                z-index: 55;
            }
            .btn-hamburger {
                display: inline-flex;
            }
        }
    </style>
</head>
<body x-data="{
    sidebarOpen: false,
    rescheduleModal: false,
    activeTx: null,
    openReschedule(tx) {
        this.activeTx = tx;
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

    <!-- App Shell: Sidebar + Content -->
    <div class="app-layout">

        <!-- Mobile Backdrop -->
        <div class="sidebar-backdrop" x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak x-transition.opacity></div>

        <!-- Glassmorphism Sidebar (Semirip mungkin dengan CMS Filament) -->
        <aside class="glass-sidebar" :class="sidebarOpen ? 'sidebar-open' : ''">

            <!-- Sidebar Header Brand -->
            <div class="sidebar-brand">
                <a href="{{ route('admin.dashboard.v2') }}" style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none;">
                    <div class="brand-crest">
                        <img src="{{ asset('logo/favicon-96x96.png') }}" alt="AQB">
                    </div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.35rem;">
                            <h2 class="brand-title">AQUABOOM</h2>
                            <span class="brand-badge-v2">V2</span>
                        </div>
                        <p class="brand-subtitle">Command Center</p>
                    </div>
                </a>

                <!-- Mobile Close Button -->
                <button @click="sidebarOpen = false" style="background: transparent; border: none; color: #94a3b8; cursor: pointer; padding: 0.3rem;" class="lg-hidden">
                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Scrollable Navigation Area -->
            <div class="sidebar-scroll-area">

                <!-- Staff Profile Chip -->
                <div class="sidebar-user-card">
                    <div class="sidebar-user-avatar">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div style="flex: 1; min-width: 0;">
                        <div style="font-size: 0.8rem; font-weight: 800; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $user->name }}
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.4rem; margin-top: 0.15rem;">
                            <span style="width: 0.4rem; height: 0.4rem; border-radius: 9999px; background: #10b981; box-shadow: 0 0 6px #10b981;"></span>
                            <span style="font-size: 0.65rem; color: #f43f5e; font-weight: 700; text-transform: uppercase;">{{ $user->role }}</span>
                        </div>
                    </div>
                </div>

                <!-- Group 1: Ringkasan & Core -->
                <div class="nav-group-label">Ringkasan & Core</div>

                <a href="{{ route('admin.dashboard.v2') }}" class="nav-item-link active">
                    <div class="nav-item-left">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                        <span>Dashboard V2 Glass</span>
                    </div>
                    <span class="nav-badge nav-badge-v2">Live</span>
                </a>

                <a href="{{ url('/admin') }}" class="nav-item-link" title="Buka Dashboard Klasik Filament">
                    <div class="nav-item-left">
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        <span>Dashboard Klasik</span>
                    </div>
                    <span class="nav-badge">CMS</span>
                </a>

                <!-- Group 2: Operasional Gate -->
                @if($user->canValidateTickets())
                    <div class="nav-group-label">Operasional Gate</div>
                    <a href="{{ route('scanner.app') }}" target="_blank" class="nav-item-link">
                        <div class="nav-item-left">
                            <svg class="nav-icon" style="color: #fbbf24;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                            </svg>
                            <span>Scanner Tiket</span>
                        </div>
                        <span class="nav-badge nav-badge-gate">Gate ↗</span>
                    </a>
                @endif

                <!-- Group 3: Transaksi & Tiket -->
                @if(\App\Filament\Resources\TransactionResource::canViewAny() || \App\Filament\Resources\TicketPackageResource::canViewAny() || \App\Filament\Resources\PromoCodeResource::canViewAny())
                    <div class="nav-group-label">Transaksi & Tiket</div>

                    @if(\App\Filament\Resources\TransactionResource::canViewAny())
                        <a href="{{ \App\Filament\Resources\TransactionResource::getUrl('index') }}" class="nav-item-link">
                            <div class="nav-item-left">
                                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <span>Transaksi</span>
                            </div>
                        </a>
                    @endif

                    @if(\App\Filament\Resources\TicketPackageResource::canViewAny())
                        <a href="{{ \App\Filament\Resources\TicketPackageResource::getUrl('index') }}" class="nav-item-link">
                            <div class="nav-item-left">
                                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                                <span>Paket Tiket</span>
                            </div>
                        </a>
                    @endif

                    @if(\App\Filament\Resources\AddOnResource::canViewAny())
                        <a href="{{ \App\Filament\Resources\AddOnResource::getUrl('index') }}" class="nav-item-link">
                            <div class="nav-item-left">
                                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <span>Produk Add-On</span>
                            </div>
                        </a>
                    @endif

                    @if(\App\Filament\Resources\PromoCodeResource::canViewAny())
                        <a href="{{ \App\Filament\Resources\PromoCodeResource::getUrl('index') }}" class="nav-item-link">
                            <div class="nav-item-left">
                                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <span>Kode Promo</span>
                            </div>
                        </a>
                    @endif

                    @if(\App\Filament\Resources\ReferralCodeResource::canViewAny())
                        <a href="{{ \App\Filament\Resources\ReferralCodeResource::getUrl('index') }}" class="nav-item-link">
                            <div class="nav-item-left">
                                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>Kode Referral</span>
                            </div>
                        </a>
                    @endif
                @endif

                <!-- Group 4: Manajemen Pengunjung -->
                @if(\App\Filament\Resources\CustomerResource::canViewAny())
                    <div class="nav-group-label">Manajemen Pengunjung</div>
                    <a href="{{ \App\Filament\Resources\CustomerResource::getUrl('index') }}" class="nav-item-link">
                        <div class="nav-item-left">
                            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span>Akun Pengunjung</span>
                        </div>
                    </a>
                @endif

                <!-- Group 5: CMS Landing Page -->
                @if(\App\Filament\Resources\WahanaResource::canViewAny() || \App\Filament\Resources\DiningResource::canViewAny() || \App\Filament\Resources\FacilityResource::canViewAny() || \App\Filament\Resources\SettingResource::canViewAny())
                    <div class="nav-group-label">CMS Landing Page</div>

                    @if(\App\Filament\Resources\WahanaResource::canViewAny())
                        <a href="{{ \App\Filament\Resources\WahanaResource::getUrl('index') }}" class="nav-item-link">
                            <div class="nav-item-left">
                                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Wahana Waterpark</span>
                            </div>
                        </a>
                    @endif

                    @if(\App\Filament\Resources\DiningResource::canViewAny())
                        <a href="{{ \App\Filament\Resources\DiningResource::getUrl('index') }}" class="nav-item-link">
                            <div class="nav-item-left">
                                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <span>Dining & Culinary</span>
                            </div>
                        </a>
                    @endif

                    @if(\App\Filament\Resources\FacilityResource::canViewAny())
                        <a href="{{ \App\Filament\Resources\FacilityResource::getUrl('index') }}" class="nav-item-link">
                            <div class="nav-item-left">
                                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span>Fasilitas Waterpark</span>
                            </div>
                        </a>
                    @endif

                    @if(\App\Filament\Resources\AwardResource::canViewAny())
                        <a href="{{ \App\Filament\Resources\AwardResource::getUrl('index') }}" class="nav-item-link">
                            <div class="nav-item-left">
                                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                                <span>Penghargaan (Awards)</span>
                            </div>
                        </a>
                    @endif

                    @if(\App\Filament\Resources\FaqResource::canViewAny())
                        <a href="{{ \App\Filament\Resources\FaqResource::getUrl('index') }}" class="nav-item-link">
                            <div class="nav-item-left">
                                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Tanya Jawab (FAQ)</span>
                            </div>
                        </a>
                    @endif

                    @if(\App\Filament\Resources\SettingResource::canViewAny())
                        <a href="{{ \App\Filament\Resources\SettingResource::getUrl('index') }}" class="nav-item-link">
                            <div class="nav-item-left">
                                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Pengaturan Web</span>
                            </div>
                        </a>
                    @endif
                @endif

                <!-- Group 6: Sistem & Keamanan -->
                @if(\App\Filament\Resources\UserResource::canViewAny() || \App\Filament\Resources\AuditLogResource::canViewAny())
                    <div class="nav-group-label">Sistem & Keamanan</div>

                    @if(\App\Filament\Resources\UserResource::canViewAny())
                        <a href="{{ \App\Filament\Resources\UserResource::getUrl('index') }}" class="nav-item-link">
                            <div class="nav-item-left">
                                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                <span>Akun Staff & Petugas</span>
                            </div>
                        </a>
                    @endif

                    @if(\App\Filament\Resources\AuditLogResource::canViewAny())
                        <a href="{{ \App\Filament\Resources\AuditLogResource::getUrl('index') }}" class="nav-item-link">
                            <div class="nav-item-left">
                                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                                <span>Audit Trail (Log)</span>
                            </div>
                        </a>
                    @endif
                @endif

            </div>

            <!-- Sidebar Footer: Website & Logout -->
            <div class="sidebar-footer">
                <a href="{{ url('/') }}" target="_blank" class="btn-sidebar-footer">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <svg style="width: 1rem; height: 1rem; color: #38bdf8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        <span>Website Publik</span>
                    </div>
                    <span style="font-size: 0.7rem; color: #64748b;">↗</span>
                </a>

                <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Keluar (Logout)</span>
                        </div>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Right Main Wrapper -->
        <div class="main-wrapper">

            <!-- Top Glass Navbar -->
            <header class="glass-nav">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <!-- Hamburger button for mobile -->
                    <button class="btn-hamburger" @click="sidebarOpen = true" title="Buka Menu">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <!-- Breadcrumbs -->
                    <div class="breadcrumb-wrap">
                        <span>CMS</span>
                        <span>/</span>
                        <span>Dashboard</span>
                        <span>/</span>
                        <span class="breadcrumb-active">V2 Glassmorphism</span>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 0.85rem;">
                    <a href="{{ url('/admin') }}" class="btn-ghost-nav" title="Kembali ke Filament CMS">
                        <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        <span>CMS Klasik</span>
                    </a>

                    @if($user->canValidateTickets())
                        <a href="{{ route('scanner.app') }}" target="_blank" class="btn-scanner">
                            <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                            </svg>
                            <span>Scanner Gate ↗</span>
                        </a>
                    @endif

                    <div style="height: 1.5rem; width: 1px; background: rgba(255, 255, 255, 0.1); margin: 0 0.15rem;"></div>

                    <div style="display: flex; align-items: center; gap: 0.65rem;">
                        <div style="width: 2.15rem; height: 2.15rem; border-radius: 9999px; background: rgba(244, 63, 94, 0.2); border: 1px solid rgba(244, 63, 94, 0.4); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.85rem; color: #fb7185;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <span style="font-size: 0.8rem; font-weight: 800; color: #fff;">{{ $user->name }}</span>
                            <span style="font-size: 0.65rem; color: #f43f5e; font-weight: 700; text-transform: uppercase;">{{ $user->role }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Body -->
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
                        <h1 style="font-size: 1.75rem; font-weight: 900; color: #fff; margin: 0 0 0.4rem 0; letter-spacing: -0.02em;">
                            Halo, {{ $user->name }}! Selamat Datang di V2 Command Center 👋
                        </h1>
                        <p style="font-size: 0.85rem; color: #94a3b8; margin: 0; font-weight: 500;">
                            {{ now()->translatedFormat('l, d F Y') }} • Pantau analitik penjualan, manifest pengunjung gate, dan kinerja reservasi secara langsung.
                        </p>
                    </div>

                    <!-- Quick Direct Link Buttons -->
                    <div style="display: flex; flex-wrap: wrap; gap: 0.65rem;">
                        @if(\App\Filament\Resources\TransactionResource::canViewAny())
                            <a href="{{ \App\Filament\Resources\TransactionResource::getUrl('index') }}" class="btn-ghost-nav">
                                <svg style="width: 0.95rem; height: 0.95rem; color: #fb7185;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                <span>Kelola Transaksi</span>
                            </a>
                        @endif
                        @if(\App\Filament\Resources\TicketPackageResource::canViewAny())
                            <a href="{{ \App\Filament\Resources\TicketPackageResource::getUrl('index') }}" class="btn-ghost-nav">
                                <svg style="width: 0.95rem; height: 0.95rem; color: #fbbf24;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                <span>Katalog Tiket</span>
                            </a>
                        @endif
                        @if(\App\Filament\Resources\PromoCodeResource::canViewAny())
                            <a href="{{ \App\Filament\Resources\PromoCodeResource::getUrl('index') }}" class="btn-ghost-nav">
                                <svg style="width: 0.95rem; height: 0.95rem; color: #34d399;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
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
                                <span style="color: #fbbf24; font-weight: 800;">{{ $todayCheckInRate }}% Hadir</span>
                                <span>Tamu terverifikasi di gate</span>
                            </p>
                        </div>
                    </div>

                    <!-- Metric 4: Tickets Sold This Month -->
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
                            <span style="color: #38bdf8; font-weight: 800;">Tiket Masuk</span>
                            <span>Waterpark rooftop terkonfirmasi</span>
                        </p>
                    </div>
                </section>

                <!-- Analytics Row (14-day Trend + Distribution Donut) -->
                <section class="charts-grid">
                    <!-- 14-day Trend Chart -->
                    <div class="glass-panel chart-box">
                        <div class="chart-header">
                            <div>
                                <h3 style="font-size: 1.05rem; font-weight: 800; color: #fff; margin: 0 0 0.2rem 0;">Tren Penjualan 14 Hari Terakhir</h3>
                                <p style="font-size: 0.75rem; color: #94a3b8; margin: 0;">Fluktuasi omset harian (Rp) & tiket terjual</p>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.72rem; color: #cbd5e1;">
                                    <span style="width: 0.65rem; height: 0.65rem; border-radius: 9999px; background: #f43f5e;"></span>
                                    <span>Pendapatan</span>
                                </span>
                            </div>
                        </div>
                        <div style="height: 270px; width: 100%;">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>

                    <!-- Ticket Package Distribution Doughnut -->
                    <div class="glass-panel chart-box">
                        <div class="chart-header">
                            <div>
                                <h3 style="font-size: 1.05rem; font-weight: 800; color: #fff; margin: 0 0 0.2rem 0;">Proporsi Jenis Tiket</h3>
                                <p style="font-size: 0.75rem; color: #94a3b8; margin: 0;">Pangsa pasar per kategori paket</p>
                            </div>
                        </div>
                        <div style="height: 270px; width: 100%; position: relative;">
                            <canvas id="distChart"></canvas>
                        </div>
                    </div>
                </section>

                <!-- Operational Section 1: Today's Gate Manifest -->
                <section style="margin-bottom: 2rem;">
                    <div class="section-header-box">
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.6rem;">
                                <h2 style="font-size: 1.25rem; font-weight: 900; color: #fff; margin: 0;">Manifest Kedatangan Gate Hari Ini</h2>
                                <span style="background: rgba(245, 158, 11, 0.2); border: 1px solid rgba(245, 158, 11, 0.4); color: #fbbf24; font-size: 0.7rem; font-weight: 800; padding: 0.15rem 0.55rem; border-radius: 9999px;">
                                    {{ $todayArrivals->count() }} Jadwal Reservasi
                                </span>
                            </div>
                            <p style="font-size: 0.8rem; color: #94a3b8; margin: 0.2rem 0 0 0;">
                                Daftar pengunjung dengan tanggal kunjungan <strong>{{ now()->translatedFormat('d F Y') }}</strong>. Petugas dapat memvalidasi langsung atau reschedule.
                            </p>
                        </div>
                        @if($user->canValidateTickets())
                            <a href="{{ route('scanner.app') }}" target="_blank" class="btn-scanner">
                                <span>Buka Kamera Scanner</span>
                            </a>
                        @endif
                    </div>

                    <div class="glass-panel glass-table-wrap">
                        <table class="glass-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Nama Tamu</th>
                                    <th>Kontak (WA)</th>
                                    <th>Paket & Pax</th>
                                    <th>Status Gate</th>
                                    <th>Jam Kedatangan</th>
                                    <th style="text-align: right;">Aksi Cepat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($todayArrivals as $arrival)
                                    @php
                                        $paxCount = $arrival->items->sum('quantity') ?: 1;
                                        $isCheckedIn = $arrival->is_redeemed || $arrival->status === 'scanned';
                                    @endphp
                                    <tr>
                                        <td>
                                            <span style="font-family: monospace; font-weight: 800; color: #38bdf8; font-size: 0.85rem;">
                                                #{{ $arrival->order_id }}
                                            </span>
                                        </td>
                                        <td>
                                            <div style="font-weight: 800; color: #fff;">{{ $arrival->customer_name }}</div>
                                            <div style="font-size: 0.72rem; color: #94a3b8;">{{ $arrival->customer_email }}</div>
                                        </td>
                                        <td>
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $arrival->customer_phone) }}" target="_blank" style="color: #34d399; text-decoration: none; font-weight: 700; display: inline-flex; align-items: center; gap: 0.3rem;">
                                                <svg style="width: 0.85rem; height: 0.85rem;" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.073.376-.043.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"></path></svg>
                                                <span>{{ $arrival->customer_phone }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            <div style="font-weight: 700; color: #f1f5f9;">
                                                @foreach($arrival->items as $item)
                                                    <div>{{ $item->ticketPackage ? $item->ticketPackage->name : 'Tiket Masuk' }} <span style="color: #fbbf24;">(x{{ $item->quantity }})</span></div>
                                                @endforeach
                                            </div>
                                            <div style="font-size: 0.72rem; color: #94a3b8; font-weight: 800;">Total: {{ $paxCount }} Pax</div>
                                        </td>
                                        <td>
                                            @if($isCheckedIn)
                                                <span class="status-pill status-scanned">
                                                    <span>●</span> Checked In
                                                </span>
                                            @else
                                                <span class="status-pill status-pending">
                                                    <span>○</span> Belum Datang
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($isCheckedIn && $arrival->redeemed_at)
                                                <span style="font-size: 0.75rem; color: #38bdf8; font-weight: 700;">
                                                    {{ $arrival->redeemed_at->format('H:i') }} WITA
                                                </span>
                                            @else
                                                <span style="font-size: 0.75rem; color: #64748b;">—</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right;">
                                            <div style="display: inline-flex; align-items: center; gap: 0.4rem;">
                                                @if(!$isCheckedIn)
                                                    <form method="POST" action="{{ route('admin.dashboard.v2.checkin', $arrival->id) }}" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn-action-checkin" title="Validasi tiket langsung tanpa scan fisik">
                                                            ✓ Check-in
                                                        </button>
                                                    </form>
                                                @endif

                                                <button type="button" class="btn-action-reschedule" @click="openReschedule({
                                                    id: {{ $arrival->id }},
                                                    orderId: '{{ $arrival->order_id }}',
                                                    customerName: '{{ addslashes($arrival->customer_name) }}',
                                                    currentDate: '{{ $arrival->visit_date ? $arrival->visit_date->format('Y-m-d') : now()->format('Y-m-d') }}',
                                                    notes: '{{ addslashes($arrival->notes ?? '') }}'
                                                })">
                                                    Reschedule
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" style="text-align: center; padding: 2.5rem; color: #94a3b8;">
                                            <div style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem;">
                                                <svg style="width: 2rem; height: 2rem; color: #64748b;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                <span>Tidak ada manifest reservasi yang dijadwalkan untuk hari ini.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Operational Section 2: Recent Transactions -->
                <section>
                    <div class="section-header-box">
                        <div>
                            <h2 style="font-size: 1.25rem; font-weight: 900; color: #fff; margin: 0;">Transaksi & Reservasi Terbaru</h2>
                            <p style="font-size: 0.8rem; color: #94a3b8; margin: 0.2rem 0 0 0;">
                                Aktivitas pembelian tiket waterpark masuk secara real-time dari website & loket.
                            </p>
                        </div>
                        @if(\App\Filament\Resources\TransactionResource::canViewAny())
                            <a href="{{ \App\Filament\Resources\TransactionResource::getUrl('index') }}" class="btn-ghost-nav">
                                <span>Buka Semua Transaksi (CMS) →</span>
                            </a>
                        @endif
                    </div>

                    <div class="glass-panel glass-table-wrap">
                        <table class="glass-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Tgl Kunjungan</th>
                                    <th>Nominal</th>
                                    <th>Status Pembayaran</th>
                                    <th>Waktu Dibuat</th>
                                    <th style="text-align: right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $tx)
                                    <tr>
                                        <td>
                                            <span style="font-family: monospace; font-weight: 800; color: #fb7185;">
                                                #{{ $tx->order_id }}
                                            </span>
                                        </td>
                                        <td>
                                            <div style="font-weight: 800; color: #fff;">{{ $tx->customer_name }}</div>
                                            <div style="font-size: 0.72rem; color: #94a3b8;">{{ $tx->customer_phone }}</div>
                                        </td>
                                        <td>
                                            <div style="font-weight: 700; color: #e2e8f0;">
                                                {{ $tx->visit_date ? $tx->visit_date->translatedFormat('d M Y') : '—' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div style="font-weight: 900; color: #34d399;">
                                                Rp {{ number_format($tx->total_price, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($tx->status === 'paid')
                                                <span class="status-pill status-paid">● Lunas</span>
                                            @elseif($tx->status === 'scanned')
                                                <span class="status-pill status-scanned">● Scanned</span>
                                            @elseif($tx->status === 'pending')
                                                <span class="status-pill status-pending">○ Menunggu</span>
                                            @else
                                                <span class="status-pill status-expired">✕ Batal</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span style="font-size: 0.75rem; color: #94a3b8;">
                                                {{ $tx->created_at->diffForHumans() }}
                                            </span>
                                        </td>
                                        <td style="text-align: right;">
                                            <button type="button" class="btn-action-reschedule" @click="openReschedule({
                                                id: {{ $tx->id }},
                                                orderId: '{{ $tx->order_id }}',
                                                customerName: '{{ addslashes($tx->customer_name) }}',
                                                currentDate: '{{ $tx->visit_date ? $tx->visit_date->format('Y-m-d') : now()->format('Y-m-d') }}',
                                                notes: '{{ addslashes($tx->notes ?? '') }}'
                                            })">
                                                Reschedule
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" style="text-align: center; padding: 2rem; color: #94a3b8;">
                                            Belum ada catatan transaksi terbaru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

            </main>
        </div>
    </div>

    <!-- Frosted Glass Reschedule Modal -->
    <div class="modal-backdrop" x-show="rescheduleModal" x-cloak x-transition.opacity>
        <div class="modal-card" @click.away="rescheduleModal = false">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                <div style="display: flex; align-items: center; gap: 0.65rem;">
                    <div style="width: 2.2rem; height: 2.2rem; border-radius: 0.75rem; background: rgba(245, 158, 11, 0.2); border: 1px solid rgba(245, 158, 11, 0.4); display: flex; align-items: center; justify-content: center; color: #fbbf24;">
                        <svg style="width: 1.15rem; height: 1.15rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h3 style="font-size: 1.1rem; font-weight: 800; color: #fff; margin: 0;">Reschedule Tanggal Kunjungan</h3>
                        <p style="font-size: 0.75rem; color: #94a3b8; margin: 0;" x-text="'Pesanan #' + (activeTx ? activeTx.orderId : '')"></p>
                    </div>
                </div>
                <button type="button" @click="rescheduleModal = false" style="background: transparent; border: none; color: #94a3b8; cursor: pointer; font-size: 1.25rem;">✕</button>
            </div>

            <form :action="'{{ url('admin/dashboard/v2/reschedule') }}/' + (activeTx ? activeTx.id : '')" method="POST">
                @csrf
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; font-size: 0.78rem; font-weight: 800; text-transform: uppercase; color: #cbd5e1; margin-bottom: 0.4rem;">Nama Pemesan</label>
                    <input type="text" :value="activeTx ? activeTx.customerName : ''" readonly style="width: 100%; padding: 0.75rem 1rem; border-radius: 0.75rem; background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.1); color: #94a3b8; font-weight: 700; font-size: 0.85rem;" />
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; font-size: 0.78rem; font-weight: 800; text-transform: uppercase; color: #cbd5e1; margin-bottom: 0.4rem;">Tanggal Kunjungan Baru</label>
                    <input type="date" name="visit_date" required :value="activeTx ? activeTx.currentDate : ''" style="width: 100%; padding: 0.75rem 1rem; border-radius: 0.75rem; background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(244, 63, 94, 0.4); color: #fff; font-weight: 800; font-size: 0.95rem;" />
                    <p style="font-size: 0.7rem; color: #94a3b8; margin: 0.35rem 0 0 0;">Pilih tanggal sesuai konfirmasi permintaan tamu.</p>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.78rem; font-weight: 800; text-transform: uppercase; color: #cbd5e1; margin-bottom: 0.4rem;">Catatan Reschedule (Alasan)</label>
                    <textarea name="notes" rows="2" placeholder="Contoh: Tamu sakit, minta ganti ke hari Sabtu." style="width: 100%; padding: 0.75rem 1rem; border-radius: 0.75rem; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); color: #fff; font-size: 0.85rem;" x-text="activeTx ? activeTx.notes : ''"></textarea>
                </div>

                <div style="display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" @click="rescheduleModal = false" class="btn-ghost-nav" style="border-radius: 0.75rem;">Batal</button>
                    <button type="submit" style="background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%); color: #fff; font-weight: 800; font-size: 0.825rem; padding: 0.7rem 1.4rem; border-radius: 0.75rem; border: none; cursor: pointer; box-shadow: 0 4px 15px var(--primary-glow);">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Charts Initialization Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Line Chart: 14-day Trend
            const revCtx = document.getElementById('revenueChart').getContext('2d');

            const revGradient = revCtx.createLinearGradient(0, 0, 0, 260);
            revGradient.addColorStop(0, 'rgba(244, 63, 94, 0.35)');
            revGradient.addColorStop(1, 'rgba(244, 63, 94, 0.0)');

            new Chart(revCtx, {
                type: 'line',
                data: {
                    labels: @json($chartLabels),
                    datasets: [
                        {
                            label: 'Pendapatan (Rp)',
                            data: @json($chartRevenue),
                            borderColor: '#f43f5e',
                            backgroundColor: revGradient,
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#f43f5e',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 7,
                            yAxisID: 'y'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(18, 14, 38, 0.9)',
                            titleColor: '#f8fafc',
                            bodyColor: '#e2e8f0',
                            borderColor: 'rgba(255, 255, 255, 0.15)',
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
                            grid: { color: 'rgba(255, 255, 255, 0.05)' },
                            ticks: {
                                color: '#94a3b8',
                                font: { size: 10, weight: '600' },
                                callback: function(value) {
                                    if (value >= 1000000) return (value / 1000000).toFixed(1) + 'M';
                                    if (value >= 1000) return (value / 1000).toFixed(0) + 'k';
                                    return value;
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
