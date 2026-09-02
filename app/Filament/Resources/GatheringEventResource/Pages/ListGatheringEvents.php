<?php

namespace App\Filament\Resources\GatheringEventResource\Pages;

use App\Filament\Resources\GatheringEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGatheringEvents extends ListRecords
{
    protected static string $resource = GatheringEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pilar Acara Baru'),
        ];
    }
}
