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

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
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
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255)
                    ->default('general'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi (ID)')
                    ->suffixAction(
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
                    ->suffixAction(
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
                Forms\Components\FileUpload::make('image_url')
                    ->label('Gambar')
                    ->image(),
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
                Tables\Columns\ImageColumn::make('image_url'),
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
