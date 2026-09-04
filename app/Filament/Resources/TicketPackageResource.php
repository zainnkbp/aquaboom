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

    protected static ?string $navigationGroup = 'Manajemen Tiket';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Paket (ID)')
                    ->required()
                    ->helperText('Nama paket tiket dalam Bahasa Indonesia')
                    ->suffixAction(
                        Forms\Components\Actions\Action::make('translateName')
                            ->icon('heroicon-m-language')
                            ->tooltip('Terjemahkan ke Bahasa Inggris')
                            ->action(function (Forms\Set $set, $state) {
                                \App\Services\TranslationService::translateField($set, $state, 'name_en', 'Nama Paket');
                            })
                    ),
                Forms\Components\TextInput::make('name_en')
                    ->label('Nama Paket (EN)')
                    ->helperText('Nama paket tiket dalam Bahasa Inggris'),
                Forms\Components\RichEditor::make('description')
                    ->label('Deskripsi Singkat (ID)')
                    ->helperText('Deskripsi singkat paket tiket dalam Bahasa Indonesia')
                    ->hintAction(
                        Forms\Components\Actions\Action::make('translateDescription')
                            ->icon('heroicon-m-language')
                            ->tooltip('Terjemahkan ke Bahasa Inggris')
                            ->action(function (Forms\Set $set, $state) {
                                \App\Services\TranslationService::translateField($set, $state, 'description_en', 'Deskripsi Paket');
                            })
                    )
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('description_en')
                    ->label('Deskripsi Singkat (EN)')
                    ->helperText('Deskripsi singkat paket tiket dalam Bahasa Inggris')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('terms_and_conditions')
                    ->label('Syarat & Ketentuan Khusus (ID)')
                    ->helperText('Tuliskan S&K spesifik untuk paket ini dalam Bahasa Indonesia.')
                    ->hintAction(
                        Forms\Components\Actions\Action::make('translateTerms')
                            ->icon('heroicon-m-language')
                            ->tooltip('Terjemahkan ke Bahasa Inggris')
                            ->action(function (Forms\Set $set, $state) {
                                \App\Services\TranslationService::translateField($set, $state, 'terms_and_conditions_en', 'Syarat & Ketentuan');
                            })
                    )
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('terms_and_conditions_en')
                    ->label('Syarat & Ketentuan Khusus (EN)')
                    ->helperText('Tuliskan S&K spesifik untuk paket ini dalam Bahasa Inggris.')
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
                    ->nullable()
                    ->numeric()
                    ->prefix('Rp')
                    ->helperText('Harga normal tiket. Kosongkan jika harga bersifat kustom / berdasarkan penawaran khusus rombongan (harga tidak akan ditampilkan di website).'),
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
                    ->label('Jenis Tiket / Kategori')
                    ->options([
                        'regular' => 'Regular (Tiket Masuk Harian)',
                        'flash_sale' => 'Flash Sale (Promo Terbatas)',
                        'bundle' => 'Special Deals / Paket Promo',
                        'gathering' => 'Corporate & Family Gathering (Rombongan)',
                    ])
                    ->default('regular')
                    ->required()
                    ->helperText('Pilih kategori paket. Paket Gathering akan otomatis tampil pada halaman /gatherings.'),
                Forms\Components\Placeholder::make('current_image_preview')
                    ->label('Foto Paket / Promo Saat Ini')
                    ->content(function ($record) {
                        if (!$record || empty($record->image_url)) {
                            return new \Illuminate\Support\HtmlString('<span class="text-xs text-slate-400">Belum ada foto</span>');
                        }
                        $url = filter_var($record->image_url, FILTER_VALIDATE_URL)
                            ? $record->image_url
                            : (str_starts_with($record->image_url, 'assets/') ? asset($record->image_url) : asset('uploads/' . $record->image_url));
                        return new \Illuminate\Support\HtmlString('<div class="mt-1"><img src="' . e($url) . '" alt="Preview" class="w-48 h-32 object-cover rounded-xl border border-slate-700 shadow-md"></div>');
                    })
                    ->visible(fn ($record) => $record && filled($record->image_url))
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image_url')
                    ->label('Unggah Foto Paket / Promo Baru')
                    ->image()
                    ->disk('public_uploads')
                    ->directory('packages')
                    ->visibility('public')
                    ->dehydrated(fn ($state) => filled($state))
                    ->helperText('Abaikan jika tidak ingin mengubah foto. Upload foto baru untuk mengganti foto saat ini.')
                    ->columnSpanFull(),
                Forms\Components\Select::make('inquiry_type')
                    ->label('Tindakan Tombol (Inquiry/Beli)')
                    ->options([
                        'none' => 'Beli Online Langsung (Kasir Web)',
                        'email' => 'Inquiry via Email Sales',
                        'whatsapp' => 'Inquiry via WhatsApp Sales',
                    ])
                    ->default('none')
                    ->required()
                    ->live(),
                Forms\Components\TextInput::make('inquiry_custom_link')
                    ->label('Link WhatsApp / Email Kustom')
                    ->placeholder('Contoh: https://wa.me/62811... atau mailto:sales@...')
                    ->helperText('Kosongkan untuk menggunakan kontak utama website bawaan settings.')
                    ->visible(fn (Get $get) => in_array($get('inquiry_type'), ['email', 'whatsapp']))
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true)
                    ->helperText('Centang jika paket tiket aktif dan dapat dilihat oleh publik.'),
                Forms\Components\Toggle::make('is_featured_home')
                    ->label('Tampilkan di Beranda (Featured Promo di Home)')
                    ->default(false)
                    ->helperText('Aktifkan untuk memunculkan kartu paket/promo ini langsung di Halaman Utama (Landing Page).'),
                
                Forms\Components\Section::make('Pengaturan Waktu (Dynamic Pricing)')
                    ->description('Atur kapan tiket ini bisa dibeli dan digunakan')
                    ->schema([
                        Forms\Components\DateTimePicker::make('sales_start')
                            ->label('Mulai Penjualan')
                            ->helperText('Kosongkan jika ingin langsung dijual saat ini.'),
                        Forms\Components\DateTimePicker::make('sales_end')
                            ->label('Akhir Penjualan (Batas Waktu)')
                            ->helperText('Paket akan otomatis tidak aktif/hilang setelah tanggal ini terlewati.'),
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
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Foto / Banner')
                    ->state(fn (TicketPackage $record): ?string => $record->image_url)
                    ->square()
                    ->size(52),
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
                    ->label('Kategori')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'regular' => 'Reguler',
                        'flash_sale' => 'Flash Sale',
                        'bundle' => 'Promo Deals',
                        'gathering' => 'Gathering & Event',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'regular' => 'info',
                        'flash_sale' => 'danger',
                        'bundle' => 'warning',
                        'gathering' => 'success',
                        default => 'gray',
                    })
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_featured_home')
                    ->label('Di Beranda')
                    ->boolean()
                    ->sortable(),
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
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc')
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
