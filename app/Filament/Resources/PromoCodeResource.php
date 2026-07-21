<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromoCodeResource\Pages;
use App\Models\PromoCode;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PromoCodeResource extends Resource
{
    protected static ?string $model = PromoCode::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationLabel = 'Kode Promo';

    protected static ?string $modelLabel = 'Kode Promo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Kode Promo')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Kode unik promo (otomatis dibuat huruf besar saat dipakai)'),
                Forms\Components\TextInput::make('discount_percentage')
                    ->label('Diskon Persentase')
                    ->numeric()
                    ->suffix('%')
                    ->maxValue(100)
                    ->helperText('Nilai diskon dalam persen. Isi salah satu: persentase ATAU nominal.'),
                Forms\Components\TextInput::make('discount_amount')
                    ->label('Diskon Nominal')
                    ->numeric()
                    ->prefix('Rp')
                    ->helperText('Nilai diskon dalam Rupiah. Isi salah satu: persentase ATAU nominal.'),
                Forms\Components\TextInput::make('max_uses')
                    ->label('Maksimal Penggunaan')
                    ->numeric()
                    ->helperText('Maksimal berapa kali kode promo bisa digunakan. Kosongkan untuk tanpa batas.'),
                Forms\Components\TextInput::make('used_count')
                    ->label('Sudah Digunakan')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('Berapa kali kode promo sudah digunakan'),
                Forms\Components\DateTimePicker::make('valid_from')
                    ->label('Berlaku Dari')
                    ->helperText('Periode awal berlaku promo. Kosongkan bila langsung berlaku.'),
                Forms\Components\DateTimePicker::make('valid_until')
                    ->label('Berlaku Sampai')
                    ->helperText('Periode akhir berlaku promo. Kosongkan bila tanpa batas waktu.'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Centang jika kode promo aktif dan bisa dipakai'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode Promo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('discount_percentage')
                    ->label('Diskon %')
                    ->suffix('%')
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_amount')
                    ->label('Diskon Nominal')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_uses')
                    ->label('Maksimal Penggunaan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('used_count')
                    ->label('Sudah Digunakan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('valid_from')
                    ->label('Berlaku Dari')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('valid_until')
                    ->label('Berlaku Sampai')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListPromoCodes::route('/'),
            'create' => Pages\CreatePromoCode::route('/create'),
            'edit' => Pages\EditPromoCode::route('/{record}/edit'),
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
