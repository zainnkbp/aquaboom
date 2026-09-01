<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CustomerResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Manajemen Pengunjung';

    protected static ?string $navigationLabel = 'Akun Pengunjung (Customer)';

    protected static ?string $modelLabel = 'Akun Pengunjung';

    protected static ?string $pluralModelLabel = 'Daftar Akun Pengunjung';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Akun Pengunjung')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required(),
                        Forms\Components\TextInput::make('password')
                            ->label('Password Baru (Abaikan jika tidak diubah)')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => \Illuminate\Support\Facades\Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state)),
                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Profil Pengunjung')
                    ->icon('heroicon-o-user')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Lengkap')
                            ->weight('bold'),
                        TextEntry::make('email')
                            ->label('Email')
                            ->icon('heroicon-m-envelope')
                            ->copyable(),
                        TextEntry::make('created_at')
                            ->label('Terdaftar Sejak')
                            ->dateTime('d F Y, H:i'),
                        TextEntry::make('total_transactions')
                            ->label('Total Transaksi')
                            ->state(fn (User $record): string => $record->transactions()->count() . ' Transaksi')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('total_spent')
                            ->label('Total Belanja (LTV)')
                            ->state(fn (User $record): string => 'Rp ' . number_format((float)$record->transactions()->where('status', 'paid')->sum('total_price'), 0, ',', '.'))
                            ->weight('bold')
                            ->color('success'),
                    ]),

                Section::make('Riwayat Pemesanan & Tiket')
                    ->icon('heroicon-o-ticket')
                    ->schema([
                        RepeatableEntry::make('transactions')
                            ->label('Daftar Transaksi Tiket')
                            ->columns(4)
                            ->schema([
                                TextEntry::make('order_id')
                                    ->label('Kode Tiket')
                                    ->badge()
                                    ->color('warning')
                                    ->copyable(),
                                TextEntry::make('visit_date')
                                    ->label('Tanggal Kunjungan')
                                    ->date('d M Y'),
                                TextEntry::make('total_price')
                                    ->label('Total Bayar')
                                    ->money('IDR')
                                    ->weight('bold'),
                                TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'paid' => 'success',
                                        'scanned' => 'info',
                                        'pending' => 'warning',
                                        'failed' => 'danger',
                                        default => 'gray',
                                    }),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(url('https://ui-avatars.com/api/?name=Guest&color=7F9CF5&background=EBF4FF')),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pengunjung')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('transactions_count')
                    ->label('Total Transaksi')
                    ->counts('transactions')
                    ->badge()
                    ->color('info')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_spent')
                    ->label('Total Belanja')
                    ->state(fn (User $record): string => 'Rp ' . number_format((float)$record->transactions()->where('status', 'paid')->sum('total_price'), 0, ',', '.'))
                    ->weight('bold')
                    ->color('success'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn (): bool => auth()->user()?->canManageCatalog() ?? false),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn (): bool => auth()->user()?->isSuperAdmin() ?? false),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where(function ($q) {
                $q->where('role', User::ROLE_CUSTOMER)
                  ->orWhereNull('role');
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->canViewTransactions() ?? false;
    }

    public static function canCreate(): bool
    {
        // Customers register through website checkout/register flow
        return false;
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
}
