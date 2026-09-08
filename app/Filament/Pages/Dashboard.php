<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?string $title = 'Pusat Kontrol & Analitik';

    public function getColumns(): int | string | array
    {
        return 2;
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\QuickActionsWidget::class,
            \App\Filament\Widgets\SalesStatsOverview::class,
            \App\Filament\Widgets\SalesChart::class,
            \App\Filament\Widgets\TicketDistributionChart::class,
            \App\Filament\Widgets\TodayArrivalsWidget::class,
            \App\Filament\Widgets\RecentOrdersWidget::class,
        ];
    }
}
