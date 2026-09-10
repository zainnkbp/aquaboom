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

        $expiredCount = Transaction::whereDate('visit_date', '<', $today)
            ->where('is_redeemed', false)
            ->where('status', 'paid')
            ->count();

        $scannedCount = Transaction::where(function ($q) {
            $q->where('is_redeemed', true)->orWhere('status', 'scanned');
        })->count();

        $pendingCount = Transaction::where('status', 'pending')->count();

        return [
            'all' => Tab::make('Semua Transaksi')
                ->badge(Transaction::count()),

            'today' => Tab::make('Kunjungan Hari Ini')
                ->icon('heroicon-m-calendar-days')
                ->badge($todayCount ?: null)
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereDate('visit_date', $today)->whereIn('status', ['paid', 'scanned'])),

            'expired' => Tab::make('Kunjungan Expired / Terlewat')
                ->icon('heroicon-m-clock')
                ->badge($expiredCount ?: null)
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
        ];
    }
}
