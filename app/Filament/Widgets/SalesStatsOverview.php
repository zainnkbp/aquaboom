<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SalesStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    public static function canView(): bool
    {
        return auth()->user()?->canManageCatalog() ?? false;
    }

    protected function getStats(): array
    {
        $paidStatuses = ['paid', 'scanned'];

        $salesToday = Transaction::whereIn('status', $paidStatuses)
            ->whereDate('created_at', today())
            ->sum('total_price');

        $salesThisMonth = Transaction::whereIn('status', $paidStatuses)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');

        $ticketsSold = TransactionItem::whereHas('transaction', function ($query) use ($paidStatuses) {
            $query->whereIn('status', $paidStatuses);
        })->sum('quantity');

        $scannedToday = Transaction::where('status', 'scanned')
            ->whereDate('updated_at', today())
            ->count();

        return [
            Stat::make('Penjualan Hari Ini', 'Rp '.number_format((float) $salesToday, 0, ',', '.'))
                ->description('Total transaksi lunas hari ini')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Penjualan Bulan Ini', 'Rp '.number_format((float) $salesThisMonth, 0, ',', '.'))
                ->description('Akumulasi bulan '.now()->translatedFormat('F Y'))
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),
            Stat::make('Tiket Terjual', number_format((int) $ticketsSold, 0, ',', '.'))
                ->description('Total pax dari transaksi lunas')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('info'),
            Stat::make('Tiket Discan Hari Ini', number_format($scannedToday, 0, ',', '.'))
                ->description('Tiket tervalidasi di gerbang hari ini')
                ->descriptionIcon('heroicon-m-qr-code')
                ->color('warning'),
        ];
    }
}
