<?php

namespace App\Filament\Widgets;

use App\Models\TransactionItem;
use Filament\Widgets\ChartWidget;

class TicketDistributionChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Penjualan Paket Tiket';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 1;

    protected static ?string $maxHeight = '300px';

    public static function canView(): bool
    {
        return auth()->user()?->hasPermission('transactions') ?? false;
    }

    protected function getData(): array
    {
        $paidStatuses = ['paid', 'scanned'];

        // Get total sold per ticket package
        $items = TransactionItem::whereHas('transaction', function ($q) use ($paidStatuses) {
            $q->whereIn('status', $paidStatuses);
        })
        ->with('ticketPackage')
        ->get()
        ->groupBy(function ($item) {
            return $item->ticketPackage ? $item->ticketPackage->name : 'Lainnya';
        });

        $labels = [];
        $data = [];

        foreach ($items as $packageName => $group) {
            $labels[] = $packageName;
            $data[] = $group->sum('quantity');
        }

        if (empty($labels)) {
            $labels = ['Belum Ada Data'];
            $data = [0];
        }

        $colors = [
            '#ec4899', // Pink
            '#f59e0b', // Amber
            '#06b6d4', // Cyan
            '#8b5cf6', // Purple
            '#10b981', // Emerald
            '#3b82f6', // Blue
            '#f97316', // Orange
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Tiket (Pax)',
                    'data' => $data,
                    'backgroundColor' => array_slice(array_merge($colors, $colors), 0, count($data)),
                    'borderWidth' => 2,
                    'borderColor' => '#1e1b4b',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
