<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketPackageResource\Pages;
use App\Models\TicketPackage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
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
                    ->label('Deskripsi Singkat')
                    ->helperText('Deskripsi singkat paket tiket')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('terms_and_conditions')
                    ->label('Syarat & Ketentuan Khusus')
                    ->helperText('Tuliskan S&K spesifik untuk paket ini (jika ada). Akan ditampilkan di bawah pilihan tiket.')
                    ->columnSpanFull(),
                Forms\Components\Select::make('copy_terms_from')
                    ->label('Trik Cepat: Salin S&K dari Paket Lain')
                    ->options(fn () => \App\Models\TicketPackage::pluck('name', 'id'))
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        if ($state) {
                            $package = \App\Models\TicketPackage::find($state);
                            if ($package && $package->terms_and_conditions) {
                                $set('terms_and_conditions', $package->terms_and_conditions);
                            }
                        }
                    })
                    ->dehydrated(false)
                    ->columnSpanFull()
                    ->helperText('Pilih paket tiket lain di sini, maka teks Syarat & Ketentuan-nya akan otomatis tersalin ke kotak di atas!'),
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
                
                Forms\Components\Section::make('Pengaturan Waktu (Dynamic Pricing)')
                    ->description('Atur kapan tiket ini bisa dibeli dan digunakan')
                    ->schema([
                        Forms\Components\Select::make('validity_type')
                            ->label('Aturan Hari')
                            ->options([
                                'all_days' => 'Berlaku Setiap Hari',
                                'weekday' => 'Hanya Weekday (Senin - Jumat)',
                                'weekend' => 'Hanya Weekend (Sabtu - Minggu, Libur)',
                                'specific_days' => 'Hanya Hari Tertentu (Misal: Tiap Rabu)',
                                'specific_dates' => 'Hanya Tanggal Tertentu',
                            ])
                            ->default('all_days')
                            ->required()
                            ->live()
                            ->helperText('Pilih kapan tiket ini akan muncul di form pemesanan.'),
                        Forms\Components\Select::make('valid_days')
                            ->label('Pilih Hari')
                            ->multiple()
                            ->options([
                                'Monday' => 'Senin',
                                'Tuesday' => 'Selasa',
                                'Wednesday' => 'Rabu',
                                'Thursday' => 'Kamis',
                                'Friday' => 'Jumat',
                                'Saturday' => 'Sabtu',
                                'Sunday' => 'Minggu',
                            ])
                            ->visible(fn (Get $get) => $get('validity_type') === 'specific_days')
                            ->required(fn (Get $get) => $get('validity_type') === 'specific_days')
                            ->helperText('Pilih hari-hari apa saja tiket ini berlaku.'),
                        Forms\Components\TagsInput::make('valid_dates')
                            ->label('Tanggal Khusus')
                            ->placeholder('Contoh: 2026-12-31')
                            ->helperText('Ketik tanggal dengan format YYYY-MM-DD lalu tekan Enter. Hanya diisi jika memilih "Hanya Tanggal Tertentu".')
                            ->visible(fn (Get $get) => $get('validity_type') === 'specific_dates')
                            ->required(fn (Get $get) => $get('validity_type') === 'specific_dates'),
                    ])->columns(2),
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
                Tables\Columns\TextColumn::make('validity_type')
                    ->label('Berlaku')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'all_days' => 'Setiap Hari',
                        'weekday' => 'Weekday',
                        'weekend' => 'Weekend',
                        'specific_days' => 'Hari Tertentu',
                        'specific_dates' => 'Tanggal Tertentu',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'all_days' => 'success',
                        'weekday' => 'info',
                        'weekend' => 'warning',
                        'specific_days' => 'primary',
                        'specific_dates' => 'danger',
                        default => 'gray',
                    }),
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
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    public static function canRestore($record): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    public static function canRestoreAny(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    public static function canForceDelete($record): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    public static function canForceDeleteAny(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }
}
