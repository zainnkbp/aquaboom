<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationGroup = 'Sistem & Keamanan';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Akun Staff & Petugas';
    protected static ?string $modelLabel = 'Akun Staff';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\FileUpload::make('avatar_url')
                        ->label('Foto Profil')
                        ->avatar()
                        ->disk('public_uploads')
                        ->directory('avatars')
                        ->dehydrated(fn ($state) => filled($state))
                        ->imageEditor()
                        ->columnSpanFull(),
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
                        ->label('Password (Abaikan jika tidak diubah)')
                        ->password()
                        ->dehydrateStateUsing(fn ($state) => \Illuminate\Support\Facades\Hash::make($state))
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (string $operation): bool => $operation === 'create'),
                    Forms\Components\Select::make('role')
                        ->label('Hak Akses (Role)')
                        ->options(\App\Models\User::roleOptions())
                        ->required()
                        ->live(),
                    Forms\Components\CheckboxList::make('permissions')
                        ->label('Hak Akses Menu & Fitur (Khusus Role Admin)')
                        ->helperText('Pilih menu apa saja yang boleh diakses oleh Admin ini. (Super Admin otomatis memiliki semua akses).')
                        ->options(\App\Models\User::permissionOptions())
                        ->columns(2)
                        ->columnSpanFull()
                        ->visible(fn (Forms\Get $get) => $get('role') === \App\Models\User::ROLE_ADMIN)
                        ->live(),
                    Forms\Components\TextInput::make('pin')
                        ->label('PIN Scanner 6 Digit')
                        ->helperText('PIN 6-digit untuk otentikasi login cepat ke Scanner Gate tiket.')
                        ->numeric()
                        ->password()
                        ->revealable()
                        ->minLength(6)
                        ->maxLength(6)
                        ->visible(function (Forms\Get $get) {
                            $role = $get('role');
                            $perms = $get('permissions') ?? [];
                            return $role === \App\Models\User::ROLE_VALIDATOR 
                                || ($role === \App\Models\User::ROLE_ADMIN && is_array($perms) && in_array('scanner_access', $perms));
                        })
                        ->required(fn (Forms\Get $get) => $get('role') === \App\Models\User::ROLE_VALIDATOR),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(url('https://ui-avatars.com/api/?name=User&color=7F9CF5&background=EBF4FF')),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->formatStateUsing(fn ($state) => \App\Models\User::roleOptions()[$state] ?? $state)
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        \App\Models\User::ROLE_SUPER_ADMIN => 'danger',
                        \App\Models\User::ROLE_ADMIN => 'warning',
                        \App\Models\User::ROLE_VALIDATOR => 'success',
                        \App\Models\User::ROLE_OPERATOR => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('permissions_display')
                    ->label('Hak Akses Menu')
                    ->state(function (User $record): array {
                        if ($record->isSuperAdmin()) {
                            return ['Semua Menu (Full Akses)'];
                        }
                        if ($record->role === User::ROLE_VALIDATOR) {
                            return ['Khusus Scanner Gate'];
                        }
                        $perms = $record->permissions;
                        if (empty($perms) || !is_array($perms)) {
                            return ['Belum Diatur'];
                        }
                        $shortLabels = [
                            'transactions' => 'Transaksi Tiket',
                            'ticket_packages' => 'Katalog Tiket & Addon',
                            'promos' => 'Kode Promo & Referral',
                            'wahanas' => 'Wahana & Atraksi',
                            'facilities_dining' => 'Fasilitas & Resto',
                            'faqs_cms' => 'FAQ & CMS Web',
                            'settings' => 'Pengaturan Web',
                            'scanner_access' => 'Scanner Gate',
                        ];
                        $labels = [];
                        foreach ($perms as $perm) {
                            $labels[] = $shortLabels[$perm] ?? $perm;
                        }
                        return !empty($labels) ? $labels : ['Belum Diatur'];
                    })
                    ->badge()
                    ->color(function (User $record, $state): string {
                        if ($record->isSuperAdmin()) {
                            return 'danger';
                        }
                        if ($record->role === User::ROLE_VALIDATOR) {
                            return 'success';
                        }
                        if ($state === 'Belum Diatur') {
                            return 'gray';
                        }
                        return 'info';
                    })
                    ->wrap(),
                Tables\Columns\TextColumn::make('pin')
                    ->label('PIN Scanner')
                    ->formatStateUsing(fn ($state) => $state ? 'Aktif' : '-')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'gray'),
            ])
            ->filters([
                //
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereIn('role', [
                \App\Models\User::ROLE_SUPER_ADMIN,
                \App\Models\User::ROLE_ADMIN,
                \App\Models\User::ROLE_OPERATOR,
                \App\Models\User::ROLE_VALIDATOR,
            ]);
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
