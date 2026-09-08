<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class QuickActionsWidget extends Widget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.quick-actions-widget';

    public static function canView(): bool
    {
        return auth()->check();
    }
}
