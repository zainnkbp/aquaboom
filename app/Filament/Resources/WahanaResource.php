<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WahanaResource\Pages;
use App\Models\Wahana;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WahanaResource extends Resource
{
    protected static ?string $model = Wahana::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationLabel = 'Wahana';

    protected static ?string $modelLabel = 'Wahana';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Wahana (ID)')
                    ->required()
                    ->helperText('Nama wahana / atraksi')
                    ->suffixAction(
                        Forms\Components\Actions\Action::make('translateName')
                            ->icon('heroicon-m-language')
                            ->tooltip('Terjemahkan ke Bahasa Inggris')
                            ->action(function (Forms\Set $set, $state) {
                                $set('name_en', \App\Services\TranslationService::translate($state));
                            })
                    ),
                Forms\Components\TextInput::make('name_en')
                    ->label('Nama Wahana (EN)')
                    ->helperText('Nama wahana dalam Bahasa Inggris'),
                Forms\Components\Select::make('thrill_level')
                    ->label('Tingkat Adrenalin (Thrill Level)')
                    ->options([
                        'Chill' => 'Chill',
                        'Family' => 'Family',
                        'Kids' => 'Kids',
                        'Fun' => 'Fun',
                        'Thrill' => 'Thrill',
                        'Extreme' => 'Extreme',
                    ])
                    ->required()
                    ->helperText('Tingkat petualangan wahana'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi (ID)')
                    ->helperText('Deskripsi singkat wahana dalam Bahasa Indonesia')
                    ->hintAction(
                        Forms\Components\Actions\Action::make('translateDescription')
                            ->icon('heroicon-m-language')
                            ->tooltip('Terjemahkan ke Bahasa Inggris')
                            ->action(function (Forms\Set $set, $state) {
                                $set('description_en', \App\Services\TranslationService::translate($state));
                            })
                    )
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description_en')
                    ->label('Deskripsi (EN)')
                    ->helperText('Deskripsi singkat wahana dalam Bahasa Inggris')
                    ->columnSpanFull(),
                Forms\Components\Placeholder::make('current_image_preview')
                    ->label('Foto Wahana Saat Ini')
                    ->content(function ($record) {
                        if (!$record || empty($record->image_url)) {
                            return new \Illuminate\Support\HtmlString('<span class="text-xs text-slate-400">Belum ada foto</span>');
                        }
                        $url = filter_var($record->image_url, FILTER_VALIDATE_URL)
                            ? $record->image_url
                            : (str_starts_with($record->image_url, 'assets/') ? asset($record->image_url) : asset('uploads/' . $record->image_url));
                        return new \Illuminate\Support\HtmlString('<div class="mt-1"><img src="' . e($url) . '" alt="Preview" class="w-48 h-32 object-cover rounded-xl border border-slate-700 shadow-md"></div>');
                    })
                    ->visible(fn ($record) => $record && filled($record->image_url)),
                Forms\Components\FileUpload::make('image_url')
                    ->label('Unggah Foto Baru')
                    ->image()
                    ->disk('public_uploads')
                    ->directory('wahanas')
                    ->visibility('public')
                    ->dehydrated(fn ($state) => filled($state))
                    ->helperText('Abaikan jika tidak ingin mengubah foto. Upload foto baru untuk mengganti foto saat ini.'),
                Forms\Components\TextInput::make('order_column')
                    ->label('Urutan Tampil')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('Urutan tampil di halaman utama (angka lebih kecil tampil lebih dulu)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Wahana')
                    ->searchable(),
                Tables\Columns\TextColumn::make('thrill_level')
                    ->label('Adrenalin')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Extreme' => 'danger',
                        'Thrill' => 'warning',
                        'Chill' => 'info',
                        'Kids' => 'success',
                        default => 'primary',
                    })
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Foto Wahana')
                    ->state(fn ($record): ?string => $record->image_url)
                    ->square()
                    ->size(50),
                Tables\Columns\TextColumn::make('order_column')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
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
            ->defaultSort('order_column')
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
            'index' => Pages\ListWahanas::route('/'),
            'create' => Pages\CreateWahana::route('/create'),
            'edit' => Pages\EditWahana::route('/{record}/edit'),
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
