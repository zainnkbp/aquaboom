<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquaboom Command Center V2 • Glassmorphism Edition</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/favicon-96x96.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN for instant Glassmorphism compilation -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"Space Grotesk"', 'monospace'],
                    },
                    colors: {
                        aqua: {
                            gold: '#f59e0b',
                            rose: '#f43f5e',
                            cyan: '#06b6d4',
                            violet: '#8b5cf6',
                            dark: '#080514',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: #070512;
            color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        /* Glassmorphism Classes */
        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.12);
            border-radius: 1.5rem;
        }

        .glass-panel-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-panel-hover:hover {
            background: rgba(255, 255, 255, 0.055);
            border-color: rgba(244, 63, 94, 0.35);
            transform: translateY(-3px);
            box-shadow: 0 30px 60px -15px rgba(244, 63, 94, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .glass-nav {
            background: rgba(12, 9, 26, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Ambient Glow Animations */
        @keyframes float-slow {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -20px) scale(1.08); }
        }
        @keyframes float-reverse {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-25px, 25px) scale(0.95); }
        }
        .animate-blob-1 { animation: float-slow 12s ease-in-out infinite; }
        .animate-blob-2 { animation: float-reverse 15s ease-in-out infinite; }

        /* Custom Scrollbars */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: rgba(0, 0, 0, 0.2); }
        ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.15); border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(244, 63, 94, 0.4); }
    </style>
</head>
<body class="min-h-screen relative antialiased selection:bg-rose-500 selection:text-white">

    <!-- Ambient Glowing Background Spheres -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-40 -left-40 w-[600px] h-[600px] bg-rose-600/15 rounded-full blur-[140px] animate-blob-1"></div>
        <div class="absolute top-1/3 -right-40 w-[550px] h-[550px] bg-cyan-600/15 rounded-full blur-[140px] animate-blob-2"></div>
        <div class="absolute -bottom-40 left-1/3 w-[650px] h-[650px] bg-violet-600/15 rounded-full blur-[150px] animate-blob-1"></div>
    </div>

    <!-- Main Wrapper -->
    <div class="relative z-10 flex flex-col min-h-screen">

        <!-- Top Glass Navigation Bar -->
        <header class="glass-nav sticky top-0 z-40 px-6 lg:px-10 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <!-- Logo & Brand Badge -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-rose-500 via-amber-400 to-rose-400 p-[1.5px] shadow-lg shadow-rose-500/25">
                        <div class="w-full h-full bg-[#0d091e] rounded-[14px] flex items-center justify-center font-black text-rose-400 text-sm tracking-tighter">
                            AQB
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-base font-black text-white tracking-wide">AQUABOOM</span>
                            <span class="px-2 py-0.5 rounded-full bg-gradient-to-r from-rose-500 to-violet-500 text-[10px] font-black uppercase tracking-wider text-white">V2 GLASS</span>
                        </div>
                        <p class="text-[11px] text-slate-400 font-medium">Balikpapan Iconic Rooftop Waterpark</p>
                    </div>
                </div>

                <div class="hidden md:block h-6 w-[1px] bg-white/10 mx-2"></div>

                <!-- Live Status Chip -->
                <div class="hidden md:inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/25 text-emerald-400 text-xs font-bold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse shadow-[0_0_8px_#34d399]"></span>
                    <span>Gate Operasional Online</span>
                </div>
            </div>

            <!-- Header Actions & Profile -->
            <div class="flex items-center gap-3">
                <!-- Return to Standard Filament CMS -->
                <a href="{{ url('/admin') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 hover:border-white/20 text-xs font-bold text-slate-300 hover:text-white transition-all">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
                    <span>Panel CMS Standar</span>
                </a>

                @if(auth()->user()->canValidateTickets())
                    <!-- Scanner Gate Button -->
                    <a href="{{ route('scanner.app') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-amber-500 via-amber-400 to-amber-500 hover:brightness-110 text-slate-950 font-black text-xs uppercase tracking-wider shadow-lg shadow-amber-500/25 transition-all transform active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        <span>Scanner Gate ↗</span>
                    </a>
                @endif

                <!-- User Dropdown Pill -->
                <div class="flex items-center gap-2.5 pl-2 border-l border-white/10">
                    <div class="w-8 h-8 rounded-xl bg-rose-500/20 border border-rose-500/30 flex items-center justify-center text-xs font-bold text-rose-300">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <div class="hidden lg:block text-left">
                        <p class="text-xs font-bold text-white leading-tight">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider">{{ auth()->user()->role }}</p>
                    </div>
                    <a href="{{ route('logout') }}" title="Keluar" class="text-slate-400 hover:text-rose-400 transition-colors p-1.5 rounded-lg hover:bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content Body -->
        <main class="flex-1 px-6 lg:px-10 py-8 space-y-8 max-w-[1600px] w-full mx-auto">

            <!-- Executive Welcome Ribbon -->
            <div class="glass-panel p-6 sm:p-8 relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-rose-400 mb-1">
                        <span>Lantai 7 Pentacity Mall BSB</span>
                        <span>•</span>
                        <span>{{ now()->translatedFormat('l, d F Y') }}</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                        Executive Command Center
                    </h1>
                    <p class="text-sm text-slate-400 mt-1 max-w-2xl font-medium">
                        Visualisasi analitik transaksi, tren pengunjung harian, dan pantauan gate tiket masuk real-time.
                    </p>
                </div>

                <!-- Navigation Quick Pills -->
                <div class="flex flex-wrap items-center gap-2.5">
                    <a href="{{ \App\Filament\Resources\TransactionResource::getUrl('index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 hover:border-rose-500/40 text-xs font-bold text-white transition-all">
                        <span class="w-2 h-2 rounded-full bg-rose-400"></span>
                        <span>Kelola Transaksi</span>
                    </a>
                    <a href="{{ \App\Filament\Resources\TicketPackageResource::getUrl('index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 hover:border-amber-500/40 text-xs font-bold text-white transition-all">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        <span>Katalog & Harga</span>
                    </a>
                    <a href="{{ \App\Filament\Resources\PromoCodeResource::getUrl('index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 hover:border-emerald-500/40 text-xs font-bold text-white transition-all">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>Kode Promo</span>
                    </a>
                </div>
            </div>

            <!-- 4 Glass KPI Metric Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                
                <!-- KPI 1: Penjualan Hari Ini -->
                <div class="glass-panel glass-panel-hover p-6 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Penjualan Hari Ini</span>
                        <div class="w-10 h-10 rounded-xl bg-rose-500/15 text-rose-400 flex items-center justify-center border border-rose-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="text-2xl lg:text-3xl font-black text-white font-mono tracking-tight">
                        Rp {{ number_format($salesToday, 0, ',', '.') }}
                    </div>
                    <div class="mt-3 flex items-center gap-2 text-xs text-emerald-400 font-semibold">
                        <span class="px-2 py-0.5 rounded-md bg-emerald-500/10 border border-emerald-500/20">{{ $ordersTodayCount }} Order</span>
                        <span class="text-slate-400">berhasil lunas hari ini</span>
                    </div>
                </div>

                <!-- KPI 2: Penjualan Bulan Ini -->
                <div class="glass-panel glass-panel-hover p-6 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Omset Bulan Ini</span>
                        <div class="w-10 h-10 rounded-xl bg-violet-500/15 text-violet-400 flex items-center justify-center border border-violet-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <div class="text-2xl lg:text-3xl font-black text-white font-mono tracking-tight">
                        Rp {{ number_format($salesThisMonth, 0, ',', '.') }}
                    </div>
                    <div class="mt-3 flex items-center gap-2 text-xs font-semibold">
                        @if($monthGrowthPercent >= 0)
                            <span class="px-2 py-0.5 rounded-md bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">↑ {{ $monthGrowthPercent }}%</span>
                        @else
                            <span class="px-2 py-0.5 rounded-md bg-rose-500/10 border border-rose-500/20 text-rose-400">↓ {{ $monthGrowthPercent }}%</span>
                        @endif
                        <span class="text-slate-400">vs bulan lalu</span>
                    </div>
                </div>

                <!-- KPI 3: Check-in Gate Hari Ini -->
                <div class="glass-panel glass-panel-hover p-6 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Check-in Gate Hari Ini</span>
                        <div class="w-10 h-10 rounded-xl bg-amber-500/15 text-amber-400 flex items-center justify-center border border-amber-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        </div>
                    </div>
                    <div class="text-2xl lg:text-3xl font-black text-white font-mono tracking-tight">
                        {{ $todayCheckedInPax }} / {{ $todayExpectedPax }} <span class="text-lg text-slate-400 font-sans">Pax</span>
                    </div>
                    <!-- Progress Bar -->
                    <div class="mt-3">
                        <div class="w-full bg-white/10 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-gradient-to-r from-amber-400 to-amber-500 h-1.5 rounded-full transition-all duration-500" style="width: {{ $checkInRate }}%"></div>
                        </div>
                        <div class="flex justify-between items-center text-[11px] text-slate-400 mt-1 font-semibold">
                            <span>Kehadiran</span>
                            <span class="text-amber-400">{{ $checkInRate }}%</span>
                        </div>
                    </div>
                </div>

                <!-- KPI 4: Tiket Terjual Bulan Ini -->
                <div class="glass-panel glass-panel-hover p-6 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Tiket Terjual (Bulan Ini)</span>
                        <div class="w-10 h-10 rounded-xl bg-cyan-500/15 text-cyan-400 flex items-center justify-center border border-cyan-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                    </div>
                    <div class="text-2xl lg:text-3xl font-black text-white font-mono tracking-tight">
                        {{ number_format($ticketsSoldThisMonth, 0, ',', '.') }} <span class="text-lg text-slate-400 font-sans">Pax</span>
                    </div>
                    <div class="mt-3 flex items-center gap-2 text-xs text-slate-400 font-semibold">
                        <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                        <span>Akumulasi {{ now()->translatedFormat('F Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Two-Column Interactive Glass Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Main Trend Chart (2 Cols) -->
                <div class="lg:col-span-2 glass-panel p-6 sm:p-7 relative flex flex-col justify-between">
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                        <div>
                            <h3 class="text-base font-bold text-white tracking-wide">Tren Pendapatan & Pengunjung (14 Hari)</h3>
                            <p class="text-xs text-slate-400">Dinamika omset harian serta pax pengunjung terverifikasi</p>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-xl bg-white/5 border border-white/10 text-xs font-bold text-rose-400 font-mono">
                            <span>14 HARI TERAKHIR</span>
                        </div>
                    </div>

                    <!-- Canvas -->
                    <div class="relative w-full h-[290px]">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>

                <!-- Donut Distribution Chart (1 Col) -->
                <div class="glass-panel p-6 sm:p-7 relative flex flex-col justify-between">
                    <div class="mb-4">
                        <h3 class="text-base font-bold text-white tracking-wide">Distribusi Paket Tiket</h3>
                        <p class="text-xs text-slate-400">Porsi penjualan per kategori tiket</p>
                    </div>

                    <!-- Canvas -->
                    <div class="relative w-full h-[220px] flex items-center justify-center">
                        <canvas id="donutChart"></canvas>
                    </div>

                    <div class="mt-4 pt-4 border-t border-white/5 text-center text-xs text-slate-400">
                        Proporsi penjualan terverifikasi di sistem
                    </div>
                </div>
            </div>

            <!-- Two Live Operations Tables -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Table 1: Manifest Kedatangan Hari Ini -->
                <div class="glass-panel p-6 relative overflow-hidden flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-5">
                        <div>
                            <h3 class="text-base font-bold text-white tracking-wide flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                                Manifest Pengunjung Hari Ini
                            </h3>
                            <p class="text-xs text-slate-400">Tamu yang dijadwalkan hadir per {{ now()->translatedFormat('d F Y') }}</p>
                        </div>
                        <span class="px-2.5 py-1 rounded-lg bg-white/5 border border-white/10 text-xs font-bold text-amber-400 font-mono">
                            {{ $todayArrivals->count() }} Booking
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-slate-400 border-b border-white/10 uppercase tracking-wider text-[10px] pb-2">
                                    <th class="py-2.5 font-bold">Tamu & Kontak</th>
                                    <th class="py-2.5 font-bold">Paket Tiket</th>
                                    <th class="py-2.5 font-bold text-center">Status Gate</th>
                                    <th class="py-2.5 font-bold text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($todayArrivals as $tx)
                                    <tr class="hover:bg-white/[0.02] transition-colors">
                                        <td class="py-3 pr-2">
                                            <div class="font-bold text-white text-sm">{{ $tx->customer_name }}</div>
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $tx->customer_phone) }}" target="_blank" class="text-[11px] text-emerald-400 hover:underline flex items-center gap-1 mt-0.5">
                                                <span>💬 {{ $tx->customer_phone }}</span>
                                            </a>
                                        </td>
                                        <td class="py-3 pr-2 text-slate-300">
                                            @foreach($tx->items as $item)
                                                <div class="font-semibold">{{ $item->quantity }}x {{ $item->ticketPackage?->name ?? 'Tiket' }}</div>
                                            @endforeach
                                        </td>
                                        <td class="py-3 text-center">
                                            @if($tx->is_redeemed || $tx->status === 'scanned')
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-[10px] font-bold">
                                                    ✓ Check-in
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-amber-500/10 border border-amber-500/30 text-amber-400 text-[10px] font-bold">
                                                    ● Belum Hadir
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 text-right">
                                            <a href="{{ \App\Filament\Resources\TransactionResource::getUrl('edit', ['record' => $tx]) }}" class="text-rose-400 hover:text-rose-300 font-bold hover:underline">
                                                Reschedule →
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-slate-500">
                                            Tidak ada jadwal kunjungan hari ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Table 2: Pesanan Masuk Terkini -->
                <div class="glass-panel p-6 relative overflow-hidden flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-5">
                        <div>
                            <h3 class="text-base font-bold text-white tracking-wide">Pesanan Tiket Terbaru</h3>
                            <p class="text-xs text-slate-400">Aktivitas transaksi terkini dari website</p>
                        </div>
                        <a href="{{ \App\Filament\Resources\TransactionResource::getUrl('index') }}" class="text-xs font-bold text-rose-400 hover:underline">
                            Lihat Semua →
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-slate-400 border-b border-white/10 uppercase tracking-wider text-[10px] pb-2">
                                    <th class="py-2.5 font-bold">Order ID</th>
                                    <th class="py-2.5 font-bold">Pelanggan</th>
                                    <th class="py-2.5 font-bold">Tgl Kunjungan</th>
                                    <th class="py-2.5 font-bold">Total</th>
                                    <th class="py-2.5 font-bold text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($recentOrders as $order)
                                    <tr class="hover:bg-white/[0.02] transition-colors">
                                        <td class="py-3 font-mono font-bold text-amber-400">
                                            {{ substr($order->order_id, 0, 16) }}...
                                        </td>
                                        <td class="py-3 font-semibold text-white">
                                            {{ $order->customer_name }}
                                        </td>
                                        <td class="py-3 text-slate-300">
                                            {{ \Carbon\Carbon::parse($order->visit_date)->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="py-3 font-mono font-bold text-white">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
                                        <td class="py-3 text-right">
                                            @if($order->status === 'paid' || $order->status === 'scanned')
                                                <span class="px-2 py-0.5 rounded bg-emerald-500/10 border border-emerald-500/25 text-emerald-400 text-[10px] font-bold">
                                                    Lunas
                                                </span>
                                            @elseif($order->status === 'pending')
                                                <span class="px-2 py-0.5 rounded bg-amber-500/10 border border-amber-500/25 text-amber-400 text-[10px] font-bold">
                                                    Pending
                                                </span>
                                            @else
                                                <span class="px-2 py-0.5 rounded bg-rose-500/10 border border-rose-500/25 text-rose-400 text-[10px] font-bold">
                                                    {{ $order->status }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-slate-500">
                                            Belum ada pesanan terbaru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </main>

        <!-- Footer -->
        <footer class="mt-auto px-6 lg:px-10 py-6 border-t border-white/5 text-center text-xs text-slate-500">
            Aquaboom Management Suite V2 • Balikpapan Superblock (BSB) Lantai 7 • Managed by Astara Hotel
        </footer>

    </div>

    <!-- Chart.js Setup Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Trend Area Chart
            const ctxTrend = document.getElementById('trendChart').getContext('2d');
            const gradientRevenue = ctxTrend.createLinearGradient(0, 0, 0, 300);
            gradientRevenue.addColorStop(0, 'rgba(244, 63, 94, 0.45)');
            gradientRevenue.addColorStop(0.7, 'rgba(244, 63, 94, 0.05)');
            gradientRevenue.addColorStop(1, 'rgba(244, 63, 94, 0)');

            new Chart(ctxTrend, {
                type: 'line',
                data: {
                    labels: @json($chartLabels),
                    datasets: [
                        {
                            label: 'Pendapatan (Rp)',
                            data: @json($chartRevenue),
                            borderColor: '#f43f5e',
                            borderWidth: 3,
                            backgroundColor: gradientRevenue,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#f43f5e',
                            pointBorderColor: '#ffffff',
                            pointHoverRadius: 6,
                            yAxisID: 'y',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            titleColor: '#ffffff',
                            bodyColor: '#e2e8f0',
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
                            ticks: { color: '#94a3b8', font: { size: 11, family: 'Space Grotesk' } }
                        },
                        y: {
                            grid: { color: 'rgba(255, 255, 255, 0.04)' },
                            ticks: {
                                color: '#94a3b8',
                                font: { size: 10, family: 'Space Grotesk' },
                                callback: function(value) {
                                    return value >= 1000000 ? (value/1000000) + 'jt' : (value/1000) + 'k';
                                }
                            }
                        }
                    }
                }
            });

            // Donut Chart
            const ctxDonut = document.getElementById('donutChart').getContext('2d');
            new Chart(ctxDonut, {
                type: 'doughnut',
                data: {
                    labels: @json($packageLabels),
                    datasets: [{
                        data: @json($packageValues),
                        backgroundColor: [
                            '#f43f5e',
                            '#f59e0b',
                            '#06b6d4',
                            '#8b5cf6',
                            '#10b981',
                            '#ec4899',
                        ],
                        borderWidth: 3,
                        borderColor: '#0d091e',
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
                                color: '#94a3b8',
                                font: { size: 11 },
                                padding: 12,
                                boxWidth: 10,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
