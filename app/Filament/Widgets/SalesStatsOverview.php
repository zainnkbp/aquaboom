<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SalesStatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    public static function canView(): bool
    {
        return auth()->user()?->hasPermission('transactions') ?? false;
    }

    protected function getStats(): array
    {
        $paidStatuses = ['paid', 'scanned'];

        // 1. Sales Today & Today's Orders
        $salesToday = Transaction::whereIn('status', $paidStatuses)
            ->whereDate('created_at', today())
            ->sum('total_price');

        $ordersTodayCount = Transaction::whereIn('status', $paidStatuses)
            ->whereDate('created_at', today())
            ->count();

        // 2. Sales This Month vs Last Month
        $salesThisMonth = Transaction::whereIn('status', $paidStatuses)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');

        $salesLastMonth = Transaction::whereIn('status', $paidStatuses)
            ->whereYear('created_at', now()->subMonth()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->sum('total_price');

        $monthGrowthPercent = 0;
        if ($salesLastMonth > 0) {
            $monthGrowthPercent = round((($salesThisMonth - $salesLastMonth) / $salesLastMonth) * 100, 1);
        }

        // 3. Today's Arrivals & Check-in Rate
        $todayArrivalTx = Transaction::whereIn('status', $paidStatuses)
            ->whereDate('visit_date', today())
            ->with('items')
            ->get();

        $todayExpectedPax = 0;
        $todayCheckedInPax = 0;
        foreach ($todayArrivalTx as $tx) {
            $pax = $tx->items->sum('quantity') ?: 1;
            $todayExpectedPax += $pax;
            if ($tx->is_redeemed || $tx->status === 'scanned') {
                $todayCheckedInPax += $pax;
            }
        }

        $checkInRate = $todayExpectedPax > 0 ? round(($todayCheckedInPax / $todayExpectedPax) * 100) : 0;

        // 4. Monthly Tickets Sold (Pax)
        $ticketsSoldThisMonth = TransactionItem::whereHas('transaction', function ($query) use ($paidStatuses) {
            $query->whereIn('status', $paidStatuses)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month);
        })->sum('quantity');

        // Sparklines (Past 7 days revenue)
        $revenueSparkline = [];
        for ($i = 6; $i >= 0; $i--) {
            $d = today()->subDays($i);
            $revenueSparkline[] = (float) Transaction::whereIn('status', $paidStatuses)
                ->whereDate('created_at', $d)
                ->sum('total_price');
        }

        return [
            Stat::make('Penjualan Hari Ini', 'Rp ' . number_format((float) $salesToday, 0, ',', '.'))
                ->description($ordersTodayCount . ' transaksi berhasil hari ini')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success')
                ->chart($revenueSparkline),

            Stat::make('Penjualan Bulan Ini', 'Rp ' . number_format((float) $salesThisMonth, 0, ',', '.'))
                ->description($salesLastMonth > 0 ? ($monthGrowthPercent >= 0 ? "+{$monthGrowthPercent}% vs bulan lalu" : "{$monthGrowthPercent}% vs bulan lalu") : 'Akumulasi ' . now()->translatedFormat('F Y'))
                ->descriptionIcon($monthGrowthPercent >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($monthGrowthPercent >= 0 ? 'primary' : 'warning'),

            Stat::make('Check-in Gate Hari Ini', "{$todayCheckedInPax} / {$todayExpectedPax} Pax")
                ->description($todayExpectedPax > 0 ? "Tingkat kehadiran: {$checkInRate}%" : 'Belum ada jadwal kunjungan hari ini')
                ->descriptionIcon('heroicon-m-qr-code')
                ->color($checkInRate >= 80 ? 'success' : ($checkInRate >= 40 ? 'warning' : 'info')),

            Stat::make('Tiket Terjual Bulan Ini', number_format((int) $ticketsSoldThisMonth, 0, ',', '.') . ' Pax')
                ->description('Total pengunjung bulan ' . now()->translatedFormat('F Y'))
                ->descriptionIcon('heroicon-m-ticket')
                ->color('info'),
        ];
    }
}
