<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Transaksi';

    protected static ?string $modelLabel = 'Transaksi';

    protected static ?string $pluralModelLabel = 'Transaksi';

    protected static ?string $navigationGroup = 'Transaksi & Penjualan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pembeli & Tiket')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('order_id')
                            ->label('Kode Tiket / Order ID')
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\Select::make('status')
                            ->label('Status Transaksi')
                            ->options([
                                'pending' => 'Pending (Menunggu Pembayaran)',
                                'paid' => 'Paid (Lunas / Valid)',
                                'failed' => 'Failed (Batal / Gagal)',
                                'scanned' => 'Scanned (Sudah Masuk Gerbang)',
                            ])
                            ->required(),
                        Forms\Components\DatePicker::make('visit_date')
                            ->label('Tanggal Kunjungan')
                            ->helperText('Ubah tanggal ini untuk reschedule jadwal kunjungan pelanggan.')
                            ->required(),
                        Forms\Components\Toggle::make('is_redeemed')
                            ->label('Status Check-in Masuk (Redeemed)')
                            ->helperText('Aktifkan jika tiket sudah digunakan masuk ke waterpark.')
                            ->live(),
                        Forms\Components\TextInput::make('customer_name')
                            ->label('Nama Pelanggan')
                            ->required(),
                        Forms\Components\TextInput::make('customer_email')
                            ->label('Email')
                            ->email()
                            ->required(),
                        Forms\Components\TextInput::make('customer_phone')
                            ->label('WhatsApp / HP')
                            ->tel()
                            ->required(),
                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan Staf / Log Reschedule')
                            ->placeholder('Contoh: Reschedule tanggal kunjungan atas konfirmasi pelanggan.')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Rincian Pembayaran')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->disabled()
                            ->dehydrated(false)
                            ->numeric()
                            ->prefix('Rp'),
                        Forms\Components\TextInput::make('discount_amount')
                            ->label('Diskon Promo')
                            ->disabled()
                            ->dehydrated(false)
                            ->numeric()
                            ->prefix('Rp'),
                        Forms\Components\TextInput::make('total_price')
                            ->label('Total Bayar')
                            ->disabled()
                            ->dehydrated(false)
                            ->numeric()
                            ->prefix('Rp'),
                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Utama & Status Tiket')
                    ->icon('heroicon-o-ticket')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('order_id')
                            ->label('Kode Tiket (Order ID)')
                            ->badge()
                            ->color('warning')
                            ->copyable(),
                        TextEntry::make('status')
                            ->label('Status Pembayaran')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'paid' => 'success',
                                'scanned' => 'info',
                                'pending' => 'warning',
                                'failed' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('attendance_status')
                            ->label('Status Kehadiran')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Checked In' => 'gray',
                                'Hari Ini' => 'warning',
                                'Belum Datang' => 'success',
                                'No Show / Expired' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('is_redeemed')
                            ->label('Status Check-In Gerbang')
                            ->badge()
                            ->state(fn (Transaction $record): string => $record->is_redeemed ? 'Sudah Digunakan (' . ($record->redeemed_at ? $record->redeemed_at->format('d M Y H:i') : '') . ')' : 'Belum Digunakan')
                            ->color(fn (Transaction $record): string => $record->is_redeemed ? 'gray' : 'success'),
                        TextEntry::make('customer_name')
                            ->label('Nama Pelanggan')
                            ->weight('bold'),
                        TextEntry::make('customer_email')
                            ->label('Email')
                            ->icon('heroicon-m-envelope'),
                        TextEntry::make('customer_phone')
                            ->label('WhatsApp / HP')
                            ->icon('heroicon-m-phone'),
                        TextEntry::make('visit_date')
                            ->label('Tanggal Kunjungan')
                            ->date('d F Y')
                            ->color('primary')
                            ->weight('bold'),
                        TextEntry::make('created_at')
                            ->label('Waktu Pembelian')
                            ->dateTime('d M Y H:i:s'),
                    ]),

                Section::make('Rincian Paket Tiket Masuk (Purchased Tickets)')
                    ->icon('heroicon-o-user-group')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->label('Daftar Paket Tiket')
                            ->columns(4)
                            ->schema([
                                TextEntry::make('ticketPackage.name')
                                    ->label('Paket Tiket')
                                    ->weight('bold'),
                                TextEntry::make('price_per_ticket')
                                    ->label('Harga Satuan')
                                    ->money('IDR'),
                                TextEntry::make('quantity')
                                    ->label('Jumlah')
                                    ->suffix(' Orang / Pax')
                                    ->badge()
                                    ->color('info'),
                                TextEntry::make('subtotal')
                                    ->label('Subtotal Paket')
                                    ->money('IDR')
                                    ->weight('bold')
                                    ->color('success'),
                            ]),
                    ]),

                Section::make('Rincian Fasilitas Tambahan / Sewa (Add-Ons)')
                    ->icon('heroicon-o-sparkles')
                    ->visible(fn (Transaction $record): bool => $record->addOns()->exists())
                    ->schema([
                        RepeatableEntry::make('addOns')
                            ->label('Daftar Fasilitas Sewa')
                            ->columns(4)
                            ->schema([
                                TextEntry::make('addOn.name')
                                    ->label('Fasilitas / Add-On')
                                    ->weight('bold'),
                                TextEntry::make('price_per_unit')
                                    ->label('Harga Satuan')
                                    ->money('IDR'),
                                TextEntry::make('quantity')
                                    ->label('Jumlah')
                                    ->suffix(' Item')
                                    ->badge()
                                    ->color('warning'),
                                TextEntry::make('subtotal')
                                    ->label('Subtotal Sewa')
                                    ->money('IDR')
                                    ->weight('bold')
                                    ->color('success'),
                            ]),
                    ]),

                Section::make('Rincian Finansial & Pembayaran (Financial Summary)')
                    ->icon('heroicon-o-calculator')
                    ->columns(4)
                    ->schema([
                        TextEntry::make('payment_channel_label')
                            ->label('Metode / Channel Pembayaran')
                            ->badge()
                            ->color('info')
                            ->icon('heroicon-m-credit-card'),
                        TextEntry::make('subtotal')
                            ->label('Subtotal Tiket & Fasilitas')
                            ->money('IDR'),
                        TextEntry::make('discount_amount')
                            ->label('Potongan Diskon Promo')
                            ->money('IDR')
                            ->color('danger')
                            ->state(fn (Transaction $record): string => '- Rp ' . number_format((float)$record->discount_amount, 0, ',', '.')),
                        TextEntry::make('total_price')
                            ->label('Total Pembayaran Akhir')
                            ->money('IDR')
                            ->weight('bold')
                            ->color('success'),
                    ]),
                Section::make('Catatan Khusus / Log Reschedule')
                    ->icon('heroicon-o-document-text')
                    ->visible(fn (Transaction $record): bool => filled($record->notes))
                    ->schema([
                        TextEntry::make('notes')
                            ->label('Catatan')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_id')
                    ->label('Kode Tiket')
                    ->searchable()
                    ->badge()
                    ->color('warning'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Beli')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('customer_phone')
                    ->label('WhatsApp / HP')
                    ->searchable()
                    ->icon('heroicon-m-phone')
                    ->copyable(),
                Tables\Columns\TextColumn::make('items_summary')
                    ->label('Rincian Pembelian')
                    ->state(function (Transaction $record): string {
                        $parts = [];
                        foreach ($record->items as $item) {
                            $parts[] = $item->quantity . 'x ' . ($item->ticketPackage?->name ?? 'Tiket');
                        }
                        foreach ($record->addOns as $addon) {
                            $parts[] = $addon->quantity . 'x ' . ($addon->addOn?->name ?? 'Addon');
                        }
                        return implode(', ', $parts);
                    })
                    ->limit(35)
                    ->tooltip(function (Transaction $record): string {
                        $parts = [];
                        foreach ($record->items as $item) {
                            $parts[] = $item->quantity . 'x ' . ($item->ticketPackage?->name ?? 'Tiket');
                        }
                        foreach ($record->addOns as $addon) {
                            $parts[] = $addon->quantity . 'x ' . ($addon->addOn?->name ?? 'Addon');
                        }
                        return implode(', ', $parts);
                    }),
                Tables\Columns\TextColumn::make('payment_channel_label')
                    ->label('Metode Bayar')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Bayar')
                    ->money('IDR')
                    ->sortable()
                    ->weight('bold')
                    ->color('success'),
                Tables\Columns\TextColumn::make('visit_date')
                    ->label('Tgl Kunjungan')
                    ->date('d M Y')
                    ->sortable()
                    ->color('primary')
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('attendance_status')
                    ->label('Kehadiran')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Checked In' => 'gray',
                        'Hari Ini' => 'warning',
                        'Belum Datang' => 'success',
                        'No Show / Expired' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status Bayar')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'scanned' => 'info',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\Filter::make('visit_date_today')
                    ->label('Kunjungan Hari Ini')
                    ->query(fn (\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder => $query->whereDate('visit_date', today())),
                Tables\Filters\Filter::make('visit_date_expired')
                    ->label('No Show / Expired')
                    ->query(fn (\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder => $query->whereDate('visit_date', '<', today())->where('is_redeemed', false)->where('status', 'paid')),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid (Lunas)',
                        'failed' => 'Failed',
                        'scanned' => 'Scanned',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Detail')
                    ->icon('heroicon-o-eye'),
                Tables\Actions\Action::make('reschedule')
                    ->label('Reschedule')
                    ->icon('heroicon-o-calendar')
                    ->color('warning')
                    ->visible(fn (Transaction $record): bool => in_array($record->status, ['paid', 'scanned']) && !$record->is_redeemed)
                    ->form([
                        Forms\Components\DatePicker::make('visit_date')
                            ->label('Tanggal Kunjungan Baru')
                            ->minDate(today())
                            ->default(fn (Transaction $record) => $record->visit_date)
                            ->required(),
                        Forms\Components\Textarea::make('reschedule_reason')
                            ->label('Alasan / Catatan Reschedule')
                            ->placeholder('Contoh: Permintaan pelanggan via WhatsApp karena cuaca / kendala.')
                            ->required(),
                    ])
                    ->action(function (Transaction $record, array $data): void {
                        $oldDate = $record->visit_date?->format('d M Y') ?? '-';
                        $newDate = \Carbon\Carbon::parse($data['visit_date'])->format('d M Y');
                        $note = "\n[" . now()->format('d M Y H:i') . ' - Reschedule oleh ' . (auth()->user()?->name ?? 'Admin') . "]: Tanggal dipindah dari {$oldDate} ke {$newDate}. Catatan: " . $data['reschedule_reason'];

                        $record->update([
                            'visit_date' => $data['visit_date'],
                            'notes' => trim(($record->notes ?? '') . $note),
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Jadwal Berhasil Diubah')
                            ->body("Tanggal kunjungan untuk tiket {$record->order_id} berhasil diubah ke {$newDate}.")
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->with(['items.ticketPackage', 'addOns.addOn'])
            ->withoutGlobalScopes([\Illuminate\Database\Eloquent\SoftDeletingScope::class]);
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
            'index' => Pages\ListTransactions::route('/'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasPermission('transactions') ?? false;
    }

    public static function canCreate(): bool
    {
        // Transactions are created through the customer checkout flow only.
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
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
