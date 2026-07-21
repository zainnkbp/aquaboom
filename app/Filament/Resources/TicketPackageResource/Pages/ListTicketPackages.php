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
}
