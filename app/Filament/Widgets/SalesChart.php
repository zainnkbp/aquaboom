<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;

class SalesChart extends ChartWidget
{
    protected static ?string $heading = 'Tren Pendapatan & Pengunjung (14 Hari Terakhir)';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected static ?string $maxHeight = '300px';

    public static function canView(): bool
    {
        return auth()->user()?->hasPermission('transactions') ?? false;
    }

    protected function getData(): array
    {
        $start = today()->subDays(13);
        $period = CarbonPeriod::create($start, today());

        $labels = [];
        $revenue = [];
        $pax = [];

        foreach ($period as $date) {
            $labels[] = $date->translatedFormat('d M');

            $dayRevenue = (float) Transaction::whereIn('status', ['paid', 'scanned'])
                ->whereDate('created_at', $date)
                ->sum('total_price');

            $dayPax = (int) \App\Models\TransactionItem::whereHas('transaction', function ($q) use ($date) {
                $q->whereIn('status', ['paid', 'scanned'])
                    ->whereDate('created_at', $date);
            })->sum('quantity');

            $revenue[] = $dayRevenue;
            $pax[] = $dayPax;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan (Rp)',
                    'data' => $revenue,
                    'borderColor' => '#ec4899',
                    'backgroundColor' => 'rgba(236, 72, 153, 0.12)',
                    'fill' => true,
                    'tension' => 0.35,
                    'yAxisID' => 'y',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
