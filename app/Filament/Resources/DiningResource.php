<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiningResource\Pages;
use App\Models\Facility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DiningResource extends Resource
{
    protected static ?string $model = Facility::class;

    protected static ?string $modelLabel = 'Dining & Culinary';
    protected static ?string $pluralModelLabel = 'Dining & Culinary';
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationGroup = 'CMS Landing Page';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Tempat (ID)')
                    ->required()
                    ->maxLength(255)
                    ->suffixAction(
                        Forms\Components\Actions\Action::make('translateName')
                            ->icon('heroicon-m-language')
                            ->tooltip('Terjemahkan ke Bahasa Inggris')
                            ->action(function (Forms\Set $set, $state) {
                                \App\Services\TranslationService::translateField($set, $state, 'name_en', 'Nama Tempat');
                            })
                    ),
                Forms\Components\TextInput::make('name_en')
                    ->label('Nama Tempat (EN)')
                    ->maxLength(255),
                Forms\Components\Hidden::make('type')
                    ->default('dining'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi (ID)')
                    ->hintAction(
                        Forms\Components\Actions\Action::make('translateDescription')
                            ->icon('heroicon-m-language')
                            ->tooltip('Terjemahkan ke Bahasa Inggris')
                            ->action(function (Forms\Set $set, $state) {
                                \App\Services\TranslationService::translateField($set, $state, 'description_en', 'Deskripsi Tempat');
                            })
                    )
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description_en')
                    ->label('Deskripsi (EN)')
                    ->columnSpanFull(),
                Forms\Components\TagsInput::make('features')
                    ->label('Fitur / Keunggulan (ID)')
                    ->placeholder('Tambah fitur lalu tekan Enter')
                    ->hintAction(
                        Forms\Components\Actions\Action::make('translateFeatures')
                            ->icon('heroicon-m-language')
                            ->tooltip('Terjemahkan ke Bahasa Inggris')
                            ->action(function (Forms\Set $set, $state) {
                                \App\Services\TranslationService::translateArrayField($set, $state, 'features_en', 'Fitur');
                            })
                    ),
                Forms\Components\TagsInput::make('features_en')
                    ->label('Fitur / Keunggulan (EN)')
                    ->placeholder('Ketik fitur dalam Bahasa Inggris'),
                Forms\Components\Section::make('Foto Buku Menu / Banner Promosi Kuliner')
                    ->collapsible()
                    ->schema([
                        Forms\Components\FileUpload::make('menu_items')
                            ->label('Unggah Foto Menu')
                            ->helperText('Upload foto halaman buku menu atau banner promo restoran. Anda dapat mengunggah beberapa foto sekaligus.')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->disk('public_uploads')
                            ->directory('dining-menus')
                            ->columnSpanFull()
                            ->afterStateHydrated(function (Forms\Components\FileUpload $component, $state) {
                                if (is_array($state) && !empty($state) && is_array($state[0])) {
                                    $component->state([]);
                                }
                            }),
                    ])
                    ->columnSpanFull(),
                Forms\Components\Placeholder::make('current_image_preview')
                    ->label('Foto Restoran Saat Ini')
                    ->content(function ($record) {
                        if (!$record || empty($record->image_url)) {
                            return new \Illuminate\Support\HtmlString('<span class="text-xs text-slate-400">Belum ada foto utama</span>');
                        }
                        $url = filter_var($record->image_url, FILTER_VALIDATE_URL)
                            ? $record->image_url
                            : (str_starts_with($record->image_url, 'assets/') ? asset($record->image_url) : asset('uploads/' . $record->image_url));
                        return new \Illuminate\Support\HtmlString('<div class="mt-1"><img src="' . e($url) . '" alt="Preview" class="w-48 h-32 object-cover rounded-xl border border-slate-700 shadow-md"></div>');
                    })
                    ->visible(fn ($record) => $record && filled($record->image_url)),
                Forms\Components\FileUpload::make('image_url')
                    ->label('Unggah Foto Restoran Baru')
                    ->image()
                    ->disk('public_uploads')
                    ->directory('dining')
                    ->visibility('public')
                    ->dehydrated(fn ($state) => filled($state))
                    ->helperText('Abaikan jika tidak ingin mengubah foto. Upload foto baru untuk mengganti foto saat ini.'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->required()
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Gambar')
                    ->disk('public_uploads'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'dining');
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
            'index' => Pages\ListDinings::route('/'),
            'create' => Pages\CreateDining::route('/create'),
            'edit' => Pages\EditDining::route('/{record}/edit'),
        ];
    }
}
