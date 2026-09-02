<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'CMS Landing Page';
    protected static ?string $navigationLabel = 'Pengaturan Kontak & Web';
    protected static ?string $modelLabel = 'Pengaturan';
    protected static ?string $pluralModelLabel = 'Pengaturan Web & Kontak';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengaturan')
                    ->description('Kelola teks, video, dan nomor kontak hotline website.')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->label('Kunci Pengaturan (Key)')
                            ->required()
                            ->disabled(fn ($context) => $context === 'edit')
                            ->helperText('Identitas sistem (cth: contact_whatsapp, hero_headline)')
                            ->maxLength(255),
                        Forms\Components\Select::make('group')
                            ->label('Kategori / Grup')
                            ->options([
                                'contact' => 'Kontak & WhatsApp Hotline',
                                'homepage' => 'Halaman Utama / Beranda',
                                'about' => 'Tentang Kami / Profil',
                                'general' => 'Umum',
                            ])
                            ->default('contact')
                            ->required(),
                        Forms\Components\Select::make('type')
                            ->label('Tipe Nilai')
                            ->options([
                                'text' => 'Teks / Nomor / Link',
                                'textarea' => 'Paragraf Panjang',
                                'file' => 'Berkas Video / Gambar',
                            ])
                            ->default('text')
                            ->required(),
                        Forms\Components\Group::make()
                            ->schema(fn (?Setting $record): array => 
                                $record?->type === 'file' ? [
                                    Forms\Components\FileUpload::make('value')
                                        ->label('Berkas Video/Gambar')
                                        ->disk('public_uploads')
                                        ->columnSpanFull()
                                ] : [
                                    Forms\Components\Textarea::make('value')
                                        ->label('Nilai Pengaturan (Value)')
                                        ->rows(4)
                                        ->helperText('Contoh untuk WhatsApp: 628115472233 atau 08115472233')
                                        ->columnSpanFull()
                                ]
                            )
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Pengaturan')
                    ->formatStateUsing(function (string $state): string {
                        return match ($state) {
                            'contact_whatsapp' => '📱 Nomor WhatsApp Sales & Gathering',
                            'contact_phone' => '☎️ Nomor Telepon Hotline',
                            'contact_email' => '✉️ Email Resmi',
                            'contact_instagram' => '📷 Akun Instagram',
                            'contact_address' => '📍 Alamat Lokasi',
                            'hero_headline' => '🏷️ Headline Beranda (ID)',
                            'hero_headline_en' => '🏷️ Headline Beranda (EN)',
                            'hero_subheadline' => '⏰ Jam Operasional (ID)',
                            'hero_subheadline_en' => '⏰ Jam Operasional (EN)',
                            'hero_description' => '📝 Deskripsi Beranda (ID)',
                            'hero_description_en' => '📝 Deskripsi Beranda (EN)',
                            'hero_video_url' => '🎥 Video Hero (YouTube URL)',
                            'philosophy_text' => '🏛️ Filosofi Perusahaan (ID)',
                            'philosophy_text_en' => '🏛️ Filosofi Perusahaan (EN)',
                            'mission_text' => '🎯 Misi Perusahaan (ID)',
                            'mission_text_en' => '🎯 Misi Perusahaan (EN)',
                            default => $state,
                        };
                    })
                    ->description(fn (Setting $record): string => $record->key)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Nilai Saat Ini')
                    ->limit(60)
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('group')
                    ->label('Grup')
                    ->colors([
                        'success' => 'contact',
                        'primary' => 'homepage',
                        'warning' => 'about',
                        'secondary' => 'general',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'contact' => 'Kontak & Hotline',
                        'homepage' => 'Beranda',
                        'about' => 'Profil / About',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->label('Filter Kategori')
                    ->options([
                        'contact' => 'Kontak & Hotline',
                        'homepage' => 'Beranda / Homepage',
                        'about' => 'Profil / About',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ubah'),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
