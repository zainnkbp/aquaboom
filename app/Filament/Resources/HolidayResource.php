<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HolidayResource\Pages;
use App\Models\Holiday;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HolidayResource extends Resource
{
    protected static ?string $model = Holiday::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Libur & Peak Season';

    protected static ?string $modelLabel = 'Hari Libur / Peak Season';

    protected static ?string $pluralModelLabel = 'Kalender Libur & Peak Season';

    protected static ?string $navigationGroup = 'Transaksi & Penjualan';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Hari Libur / Periode Peak Season')
                    ->description('Tentukan tanggalan libur nasional atau rentang tanggal peak season (seperti libur sekolah dan Nataru) agar tarif tiket otomatis menyesuaikan.')
                    ->schema([
                        Forms\Components\Select::make('preset_template')
                            ->label('⚡ Template Cepat (Opsional)')
                            ->options([
                                'libur_sekolah' => '🏖️ Peak Season: Liburan Sekolah (Juni - Juli)',
                                'nataru' => '🎄 Peak Season: Libur Natal & Tahun Baru (Desember - Januari)',
                                'lebaran' => '🕌 Peak Season: Libur Hari Raya Idul Fitri',
                            ])
                            ->placeholder('-- Pilih Template atau Isi Manual --')
                            ->dehydrated(false)
                            ->live()
                            ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                                $year = (int) date('Y');
                                if ($state === 'libur_sekolah') {
                                    $set('name', "Peak Season Liburan Sekolah {$year}");
                                    $set('type', 'peak_season');
                                    $set('start_date', "{$year}-06-20");
                                    $set('end_date', "{$year}-07-15");
                                    $set('note', 'Periode Peak Season Liburan Sekolah. Berlaku tarif Weekend & Tiket Liburan.');
                                } elseif ($state === 'nataru') {
                                    $nextYear = $year + 1;
                                    $set('name', "Peak Season Libur Nataru {$year}/{$nextYear}");
                                    $set('type', 'peak_season');
                                    $set('start_date', "{$year}-12-20");
                                    $set('end_date', "{$nextYear}-01-05");
                                    $set('note', 'Periode Libur Natal & Tahun Baru (Nataru). Berlaku tarif Weekend & Peak Season.');
                                } elseif ($state === 'lebaran') {
                                    $set('name', "Peak Season Hari Raya Idul Fitri {$year}");
                                    $set('type', 'peak_season');
                                    $set('note', 'Periode Libur Hari Raya Idul Fitri. Berlaku tarif Weekend & Peak Season.');
                                }
                            })
                            ->helperText('Pilih salah satu template di atas untuk mengisi otomatis nama, kategori, dan rentang tanggal rekomendasi.')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Hari Libur / Periode')
                            ->placeholder('e.g. Hari Raya Idul Fitri / Liburan Sekolah 2026 / Peak Season Nataru')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('type')
                            ->label('Kategori / Tipe')
                            ->options([
                                'national_holiday' => '🔴 Hari Libur Nasional (Tanggal Merah)',
                                'peak_season' => '⭐ Peak Season (Liburan Sekolah, Nataru, Lebaran)',
                                'joint_leave' => '🟡 Cuti Bersama Resmi',
                                'custom' => '🔵 Event Khusus / Libur Tambahan',
                            ])
                            ->default('national_holiday')
                            ->required()
                            ->live()
                            ->columnSpanFull(),

                        // Single Date (for 1-day holidays)
                        Forms\Components\DatePicker::make('date')
                            ->label('Tanggal Libur (1 Hari)')
                            ->helperText('Gunakan ini jika libur hanya berlangsung 1 hari spesifik (contoh: 17 Agustus).')
                            ->visible(fn (Get $get) => $get('type') !== 'peak_season')
                            ->required(fn (Get $get) => $get('type') !== 'peak_season' && empty($get('start_date'))),

                        // Date Range (for Peak Season / multi-day periods)
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Tanggal Mulai Periode')
                            ->helperText('Awal rentang libur panjang / peak season.')
                            ->visible(fn (Get $get) => $get('type') === 'peak_season' || empty($get('date')))
                            ->required(fn (Get $get) => $get('type') === 'peak_season'),

                        Forms\Components\DatePicker::make('end_date')
                            ->label('Tanggal Selesai Periode')
                            ->helperText('Akhir rentang libur panjang / peak season.')
                            ->visible(fn (Get $get) => $get('type') === 'peak_season' || empty($get('date')))
                            ->required(fn (Get $get) => $get('type') === 'peak_season')
                            ->afterOrEqual('start_date'),

                        Forms\Components\Textarea::make('note')
                            ->label('Keterangan / Pengumuman Tarif')
                            ->placeholder('e.g. Berlaku tarif Weekend & Peak Season untuk seluruh wahana')
                            ->helperText('Pesan ini akan ditampilkan ke pengunjung saat memilih tanggal ini di form booking.')
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->helperText('Jika non-aktif, tanggal ini akan dihitung sebagai hari biasa (weekday normal).'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Tables\Actions\Action::make('syncApiHolidays')
                    ->label('Sinkronkan Libur Nasional (API)')
                    ->icon('heroicon-m-arrow-path')
                    ->color('primary')
                    ->form([
                        Forms\Components\Select::make('year')
                            ->label('Pilih Tahun Kalender')
                            ->options([
                                2025 => 'Tahun 2025',
                                2026 => 'Tahun 2026',
                                2027 => 'Tahun 2027',
                            ])
                            ->default((int) date('Y'))
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        $year = (int) ($data['year'] ?? date('Y'));
                        $res = Holiday::syncFromNationalApi($year);
                        Notification::make()
                            ->title("Sinkronisasi Selesai")
                            ->body("Berhasil mengimpor/memperbarui {$res['imported']} hari libur nasional Indonesia untuk tahun {$year}.")
                            ->success()
                            ->send();
                    }),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Libur / Periode')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('type')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'national_holiday' => 'danger',
                        'peak_season' => 'warning',
                        'joint_leave' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'national_holiday' => 'Libur Nasional',
                        'peak_season' => 'Peak Season',
                        'joint_leave' => 'Cuti Bersama',
                        default => 'Khusus',
                    }),

                Tables\Columns\TextColumn::make('date_display')
                    ->label('Tanggal / Periode')
                    ->state(function (Holiday $record): string {
                        if ($record->start_date && $record->end_date) {
                            return $record->start_date->translatedFormat('d M Y') . ' — ' . $record->end_date->translatedFormat('d M Y');
                        }
                        return $record->date ? $record->date->translatedFormat('l, d F Y') : '-';
                    })
                    ->sortable(query: fn ($query, $direction) => $query->orderByRaw('COALESCE(date, start_date) ' . $direction)),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),

                Tables\Columns\TextColumn::make('note')
                    ->label('Keterangan Tarif')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->defaultSort(fn ($query) => $query->orderByRaw('COALESCE(date, start_date) ASC'))
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Kategori')
                    ->options([
                        'national_holiday' => 'Libur Nasional',
                        'peak_season' => 'Peak Season',
                        'joint_leave' => 'Cuti Bersama',
                        'custom' => 'Khusus',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListHolidays::route('/'),
            'create' => Pages\CreateHoliday::route('/create'),
            'edit' => Pages\EditHoliday::route('/{record}/edit'),
        ];
    }
}
