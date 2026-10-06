<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Transaction;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTabs(): array
    {
        $today = today();

        $todayCount = Transaction::whereDate('visit_date', $today)
            ->whereIn('status', ['paid', 'scanned'])
            ->count();

        $upcomingCount = Transaction::whereDate('visit_date', '>', $today)
            ->where('is_redeemed', false)
            ->whereIn('status', ['paid', 'scanned'])
            ->count();

        $noShowCount = Transaction::whereDate('visit_date', '<', $today)
            ->where('is_redeemed', false)
            ->where('status', 'paid')
            ->count();

        $scannedCount = Transaction::where(function ($q) {
            $q->where('is_redeemed', true)->orWhere('status', 'scanned');
        })->count();

        $pendingCount = Transaction::where('status', 'pending')->count();

        $cancelledCount = Transaction::whereIn('status', ['failed', 'cancelled'])->count();

        return [
            'all' => Tab::make('Semua Transaksi')
                ->badge(Transaction::count()),

            'today' => Tab::make('Kunjungan Hari Ini')
                ->icon('heroicon-m-calendar-days')
                ->badge($todayCount ?: null)
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereDate('visit_date', $today)->whereIn('status', ['paid', 'scanned'])),

            'upcoming' => Tab::make('Mendatang (Belum Datang)')
                ->icon('heroicon-m-calendar')
                ->badge($upcomingCount ?: null)
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereDate('visit_date', '>', $today)->where('is_redeemed', false)->whereIn('status', ['paid', 'scanned'])),

            'no_show' => Tab::make('No Show')
                ->icon('heroicon-m-clock')
                ->badge($noShowCount ?: null)
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereDate('visit_date', '<', $today)->where('is_redeemed', false)->where('status', 'paid')),

            'scanned' => Tab::make('Sudah Check-In')
                ->icon('heroicon-m-check-badge')
                ->badge($scannedCount ?: null)
                ->badgeColor('info')
                ->modifyQueryUsing(fn (Builder $query) => $query->where(function ($q) {
                    $q->where('is_redeemed', true)->orWhere('status', 'scanned');
                })),

            'pending' => Tab::make('Menunggu Bayar')
                ->icon('heroicon-m-exclamation-triangle')
                ->badge($pendingCount ?: null)
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending')),

            'cancelled' => Tab::make('Batal / Cancel')
                ->icon('heroicon-m-x-circle')
                ->badge($cancelledCount ?: null)
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('status', ['failed', 'cancelled'])),
        ];
    }
}
