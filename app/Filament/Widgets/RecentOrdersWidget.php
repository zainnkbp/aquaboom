<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentOrdersWidget extends BaseWidget
{
    protected static ?int $sort = 6;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Pesanan Tiket Masuk Terbaru';

    public static function canView(): bool
    {
        return auth()->user()?->hasPermission('transactions') ?? false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Transaction::query()
                    ->with(['items.ticketPackage'])
                    ->latest()
                    ->limit(8)
            )
            ->columns([
                Tables\Columns\TextColumn::make('order_id')
                    ->label('Kode Tiket')
                    ->badge()
                    ->color('warning')
                    ->copyable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama Pemesan')
                    ->weight('bold')
                    ->searchable(),

                Tables\Columns\TextColumn::make('visit_date')
                    ->label('Tgl Kunjungan')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Bayar')
                    ->money('IDR')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'scanned' => 'info',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Order')
                    ->since(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat Detail')
                    ->infolist(fn (\Filament\Infolists\Infolist $infolist) => \App\Filament\Resources\TransactionResource::infolist($infolist)),
            ])
            ->emptyStateHeading('Belum Ada Pesanan');
    }
}
