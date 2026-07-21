<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketPackageResource\Pages;
use App\Models\TicketPackage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketPackageResource extends Resource
{
    protected static ?string $model = TicketPackage::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationLabel = 'Paket Tiket';

    protected static ?string $modelLabel = 'Paket Tiket';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Paket')
                    ->required()
                    ->helperText('Nama paket tiket'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->helperText('Deskripsi singkat paket tiket')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->label('Harga Normal')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->helperText('Harga normal tiket'),
                Forms\Components\Select::make('discount_type')
                    ->label('Jenis Diskon')
                    ->options([
                        'amount' => 'Nominal (Rp)',
                        'percentage' => 'Persentase (%)',
                    ])
                    ->default('amount')
                    ->required()
                    ->live()
                    ->helperText('Pilih apakah diskon berupa harga akhir (nominal) atau potongan persen'),
                Forms\Components\TextInput::make('discount_price')
                    ->label(fn (Get $get): string => $get('discount_type') === 'percentage' ? 'Persentase Diskon' : 'Harga Setelah Diskon')
                    ->numeric()
                    ->prefix(fn (Get $get): ?string => $get('discount_type') === 'percentage' ? null : 'Rp')
                    ->suffix(fn (Get $get): ?string => $get('discount_type') === 'percentage' ? '%' : null)
                    ->maxValue(fn (Get $get): ?float => $get('discount_type') === 'percentage' ? 100 : null)
                    ->helperText('Harga setelah diskon (atau persentase diskon jika jenis diskon = persentase). Kosongkan bila tidak ada diskon.'),
                Forms\Components\Select::make('type')
                    ->label('Jenis Tiket')
                    ->options([
                        'regular' => 'Regular',
                        'flash_sale' => 'Flash Sale',
                        'bundle' => 'Bundle',
                    ])
                    ->default('regular')
                    ->required()
                    ->helperText('Jenis tiket: regular, flash_sale, bundle'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Centang jika paket tiket aktif dan bisa dibeli'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Paket')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga Normal')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_price')
                    ->label('Diskon')
                    ->formatStateUsing(fn ($state, TicketPackage $record): string => $state === null
                        ? '-'
                        : ($record->discount_type === 'percentage'
                            ? rtrim(rtrim(number_format((float) $state, 2), '0'), '.').'%'
                            : 'Rp '.number_format((float) $state, 0, ',', '.')))
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Jenis')
                    ->badge()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([SoftDeletingScope::class]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTicketPackages::route('/'),
            'create' => Pages\CreateTicketPackage::route('/create'),
            'edit' => Pages\EditTicketPackage::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->canManageCatalog() ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->canManageCatalog() ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->canManageCatalog() ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->canManageCatalog() ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->canManageCatalog() ?? false;
    }
}
