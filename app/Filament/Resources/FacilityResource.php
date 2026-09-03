<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacilityResource\Pages;
use App\Filament\Resources\FacilityResource\RelationManagers;
use App\Models\Facility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FacilityResource extends Resource
{
    protected static ?string $model = Facility::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    protected static ?string $navigationGroup = 'CMS Landing Page';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Fasilitas (ID)')
                    ->required()
                    ->maxLength(255)
                    ->suffixAction(
                        Forms\Components\Actions\Action::make('translateName')
                            ->icon('heroicon-m-language')
                            ->tooltip('Terjemahkan ke Bahasa Inggris')
                            ->action(function (Forms\Set $set, $state) {
                                $set('name_en', \App\Services\TranslationService::translate($state));
                            })
                    ),
                Forms\Components\TextInput::make('name_en')
                    ->label('Nama Fasilitas (EN)')
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->label('Tipe Fasilitas')
                    ->options([
                        'general' => 'Umum (General)',
                        'gazebo' => 'Gazebo',
                    ])
                    ->required()
                    ->default('general'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi (ID)')
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
                    ->columnSpanFull(),
                Forms\Components\TagsInput::make('features')
                    ->label('Fitur / Keunggulan (ID)')
                    ->placeholder('Tambah fitur lalu tekan Enter')
                    ->hintAction(
                        Forms\Components\Actions\Action::make('translateFeatures')
                            ->icon('heroicon-m-language')
                            ->tooltip('Terjemahkan ke Bahasa Inggris')
                            ->action(function (Forms\Set $set, $state) {
                                if (is_array($state)) {
                                    $translated = [];
                                    foreach ($state as $feature) {
                                        $translated[] = \App\Services\TranslationService::translate($feature);
                                    }
                                    $set('features_en', $translated);
                                }
                            })
                    ),
                Forms\Components\TagsInput::make('features_en')
                    ->label('Fitur / Keunggulan (EN)')
                    ->placeholder('Ketik fitur dalam Bahasa Inggris'),
                Forms\Components\Placeholder::make('current_image_preview')
                    ->label('Foto Fasilitas Saat Ini')
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
                    ->label('Unggah Foto Fasilitas Baru')
                    ->image()
                    ->disk('public_uploads')
                    ->directory('facilities')
                    ->visibility('public')
                    ->dehydrated(fn ($state) => filled($state))
                    ->helperText('Abaikan jika tidak ingin mengubah foto. Upload foto baru untuk mengganti foto saat ini.'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Foto Fasilitas')
                    ->state(fn ($record): ?string => $record->image_url)
                    ->square()
                    ->size(50),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc')
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
        return parent::getEloquentQuery()->where('type', '!=', 'dining');
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
            'index' => Pages\ListFacilities::route('/'),
            'create' => Pages\CreateFacility::route('/create'),
            'edit' => Pages\EditFacility::route('/{record}/edit'),
        ];
    }
}
