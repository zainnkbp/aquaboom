<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;

class SalesChart extends ChartWidget
{
    protected static ?string $heading = 'Penjualan 7 Hari Terakhir';

    protected static ?int $sort = 2;

    public static function canView(): bool
    {
        return auth()->user()?->canManageCatalog() ?? false;
    }

    protected function getData(): array
    {
        $start = today()->subDays(6);
        $period = CarbonPeriod::create($start, today());

        $labels = [];
        $values = [];

        foreach ($period as $date) {
            $labels[] = $date->translatedFormat('D, d M');
            $values[] = (float) Transaction::whereIn('status', ['paid', 'scanned'])
                ->whereDate('created_at', $date)
                ->sum('total_price');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Penjualan (Rp)',
                    'data' => $values,
                    'borderColor' => '#ec4899',
                    'backgroundColor' => 'rgba(236, 72, 153, 0.15)',
                    'fill' => true,
                    'tension' => 0.35,
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
