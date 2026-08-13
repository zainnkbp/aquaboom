<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddOnResource\Pages;
use App\Filament\Resources\AddOnResource\RelationManagers;
use App\Models\AddOn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddOnResource extends Resource
{
    protected static ?string $model = AddOn::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Produk Add-On';
    protected static ?string $modelLabel = 'Produk Add-On';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Produk (ID)')
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
                        ->label('Nama Produk (EN)')
                        ->maxLength(255),
                    
                    Forms\Components\TextInput::make('price')
                        ->label('Harga')
                        ->required()
                        ->numeric()
                        ->prefix('Rp'),
                        
                    Forms\Components\FileUpload::make('image')
                        ->label('Gambar Produk')
                        ->image()
                        ->disk('public_uploads')
                        ->directory('addons'),
                        
                    Forms\Components\RichEditor::make('description')
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
                        
                    Forms\Components\RichEditor::make('description_en')
                        ->label('Deskripsi (EN)')
                        ->columnSpanFull(),
                        
                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif (Tersedia)')
                        ->default(true),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public_uploads'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),
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
            'index' => Pages\ListAddOns::route('/'),
            'create' => Pages\CreateAddOn::route('/create'),
            'edit' => Pages\EditAddOn::route('/{record}/edit'),
        ];
    }
}
