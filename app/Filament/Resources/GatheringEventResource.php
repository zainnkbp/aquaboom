<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GatheringEventResource\Pages;
use App\Models\GatheringEvent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GatheringEventResource extends Resource
{
    protected static ?string $model = GatheringEvent::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'CMS Landing Page';
    protected static ?string $navigationLabel = 'Kategori & Pilar Gathering';
    protected static ?string $modelLabel = 'Pilar Acara Gathering';
    protected static ?string $pluralModelLabel = 'Kategori & Pilar Acara Gathering';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kategori Acara')
                    ->description('Kelola kartu showcase 4 pilar acara di halaman /gatherings.')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Acara (ID)')
                            ->required()
                            ->maxLength(255)
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('translateTitle')
                                    ->icon('heroicon-m-language')
                                    ->tooltip('Terjemahkan ke Bahasa Inggris')
                                    ->action(function (Forms\Set $set, $state) {
                                        $set('title_en', \App\Services\TranslationService::translate($state));
                                    })
                            ),
                        Forms\Components\TextInput::make('title_en')
                            ->label('Judul Acara (EN)')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subtitle')
                            ->label('Sub-judul / Highlight Fasilitas (ID)')
                            ->helperText('Contoh: Team Building Games • Sound System • Lunch Buffet')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subtitle_en')
                            ->label('Sub-judul / Highlight Fasilitas (EN)')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('badge_text')
                            ->label('Teks Label Badge')
                            ->helperText('Contoh: Corporate & BUMN, Keluarga & Komunitas, Sekolah')
                            ->maxLength(255),
                        Forms\Components\Select::make('badge_color')
                            ->label('Warna Badge')
                            ->options([
                                'navy' => 'Dark Navy (Corporate)',
                                'amber' => 'Gold / Amber (Keluarga)',
                                'azure' => 'Azure Blue (Sekolah)',
                                'rose' => 'Rose Pink / Merah (Ulang Tahun)',
                                'emerald' => 'Emerald Green',
                            ])
                            ->default('navy')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Lengkap (ID)')
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description_en')
                            ->label('Deskripsi Lengkap (EN)')
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\TagsInput::make('features')
                            ->label('Daftar Fasilitas / Checklist Keunggulan (ID)')
                            ->placeholder('Ketik fasilitas lalu tekan Enter')
                            ->columnSpanFull(),
                        Forms\Components\TagsInput::make('features_en')
                            ->label('Daftar Fasilitas / Checklist Keunggulan (EN)')
                            ->placeholder('Type feature and press Enter')
                            ->columnSpanFull(),
                        Forms\Components\Placeholder::make('current_image_preview')
                            ->label('Foto Acara Saat Ini')
                            ->content(function ($record) {
                                if (!$record || empty($record->image_url)) {
                                    return new \Illuminate\Support\HtmlString('<span class="text-xs text-slate-400">Belum ada foto</span>');
                                }
                                return new \Illuminate\Support\HtmlString('<div class="mt-1"><img src="' . e($record->image_url) . '" alt="Preview" class="w-64 h-36 object-cover rounded-2xl border border-slate-700 shadow-md"></div>');
                            })
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image_url')
                            ->label('Unggah Foto Acara Baru')
                            ->image()
                            ->disk('public_uploads')
                            ->directory('gatherings')
                            ->visibility('public')
                            ->dehydrated(fn ($state) => filled($state))
                            ->helperText('Upload foto baru untuk mengganti foto showcase saat ini.')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('button_text')
                            ->label('Teks Tombol')
                            ->default('Minta Penawaran Acara →')
                            ->required(),
                        Forms\Components\TextInput::make('button_action')
                            ->label('Tujuan Tombol (Link / Anchor)')
                            ->default('#inquiry-form')
                            ->helperText('Contoh: #inquiry-form atau link WhatsApp khusus'),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif Ditampilkan')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Foto')
                    ->state(fn (GatheringEvent $record): ?string => $record->image_url)
                    ->square()
                    ->size(54),
                Tables\Columns\TextColumn::make('title')
                    ->label('Kategori Acara')
                    ->description(fn (GatheringEvent $record): string => $record->subtitle ?? '')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('badge_text')
                    ->label('Label')
                    ->colors([
                        'primary' => fn ($state) => filled($state),
                    ]),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ubah'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGatheringEvents::route('/'),
            'create' => Pages\CreateGatheringEvent::route('/create'),
            'edit' => Pages\EditGatheringEvent::route('/{record}/edit'),
        ];
    }
}
