<?php

namespace App\Filament\Resources\TicketPackageResource\Pages;

use App\Filament\Resources\TicketPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTicketPackages extends ListRecords
{
    protected static string $resource = TicketPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => \Filament\Resources\Components\Tab::make('Semua Paket'),
            'regular' => \Filament\Resources\Components\Tab::make('Tiket Reguler')
                ->modifyQueryUsing(fn ($query) => $query->where('type', 'regular')),
            'promo' => \Filament\Resources\Components\Tab::make('Promo & Flash Sale')
                ->modifyQueryUsing(fn ($query) => $query->whereIn('type', ['bundle', 'flash_sale'])),
            'gathering' => \Filament\Resources\Components\Tab::make('Corporate & Gathering')
                ->modifyQueryUsing(fn ($query) => $query->where('type', 'gathering')),
            'featured' => \Filament\Resources\Components\Tab::make('Featured di Home')
                ->modifyQueryUsing(fn ($query) => $query->where('is_featured_home', true)),
        ];
    }
}
