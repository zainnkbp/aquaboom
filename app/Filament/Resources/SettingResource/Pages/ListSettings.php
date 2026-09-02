<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pengaturan Baru'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua Pengaturan'),
            'contact' => Tab::make('Kontak & WhatsApp Hotline')
                ->badge(fn () => \App\Models\Setting::where('group', 'contact')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('group', 'contact')),
            'homepage' => Tab::make('Beranda / Homepage')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('group', 'homepage')),
            'about' => Tab::make('Profil / About Us')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('group', 'about')),
        ];
    }
}
