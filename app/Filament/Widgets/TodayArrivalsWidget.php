<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TodayArrivalsWidget extends BaseWidget
{
    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Jadwal Kedatangan Pengunjung Hari Ini';

    public static function canView(): bool
    {
        return auth()->user()?->hasPermission('transactions') ?? false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Transaction::query()
                    ->whereDate('visit_date', today())
                    ->whereIn('status', ['paid', 'scanned', 'pending'])
                    ->with(['items.ticketPackage', 'addOns.addOn'])
                    ->orderBy('is_redeemed', 'asc')
                    ->orderBy('updated_at', 'desc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('order_id')
                    ->label('Kode Tiket')
                    ->badge()
                    ->color('warning')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama Pengunjung')
                    ->weight('bold')
                    ->searchable(),

                Tables\Columns\TextColumn::make('customer_phone')
                    ->label('WhatsApp')
                    ->icon('heroicon-m-phone')
                    ->url(fn ($record) => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $record->customer_phone), true),

                Tables\Columns\TextColumn::make('items_summary')
                    ->label('Rincian Paket & Pax')
                    ->state(function (Transaction $record) {
                        $parts = [];
                        foreach ($record->items as $item) {
                            $parts[] = $item->quantity . 'x ' . ($item->ticketPackage?->name ?? 'Tiket');
                        }
                        return implode(', ', $parts);
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label('Pembayaran')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'scanned' => 'info',
                        'pending' => 'warning',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('is_redeemed')
                    ->label('Status Gate')
                    ->badge()
                    ->state(fn (Transaction $record) => $record->is_redeemed ? 'Sudah Masuk' : 'Belum Datang')
                    ->color(fn (Transaction $record) => $record->is_redeemed ? 'success' : 'gray'),
            ])
            ->actions([
                Tables\Actions\Action::make('reschedule')
                    ->label('Reschedule')
                    ->icon('heroicon-m-calendar')
                    ->color('warning')
                    ->form([
                        Forms\Components\DatePicker::make('visit_date')
                            ->label('Tanggal Kunjungan Baru')
                            ->required(),
                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan Reschedule'),
                    ])
                    ->fillForm(fn (Transaction $record) => [
                        'visit_date' => $record->visit_date,
                        'notes' => $record->notes,
                    ])
                    ->action(function (Transaction $record, array $data) {
                        $record->update([
                            'visit_date' => $data['visit_date'],
                            'notes' => $data['notes'],
                        ]);
                    }),

                Tables\Actions\Action::make('check_in')
                    ->label('Check-in')
                    ->icon('heroicon-m-check-badge')
                    ->color('success')
                    ->visible(fn (Transaction $record) => !$record->is_redeemed && $record->status === 'paid')
                    ->requiresConfirmation()
                    ->action(function (Transaction $record) {
                        $record->update([
                            'is_redeemed' => true,
                            'redeemed_at' => now(),
                            'status' => 'scanned',
                        ]);
                    }),
            ])
            ->emptyStateHeading('Tidak Ada Jadwal Kunjungan Hari Ini')
            ->emptyStateDescription('Belum ada pesanan tiket yang dijadwalkan berkunjung pada tanggal hari ini.');
    }
}
