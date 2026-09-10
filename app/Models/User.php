<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'email', 'password', 'role', 'pin', 'avatar_url', 'permissions'])]
#[Hidden(['password', 'remember_token', 'pin'])]
class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, \App\Models\Concerns\HasAuditLog, \App\Models\Concerns\AutoFixPostgresSequence;

    public const ROLE_SUPER_ADMIN = 'super_admin';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_VALIDATOR = 'validator';
    public const ROLE_OPERATOR = 'operator';
    public const ROLE_CUSTOMER = 'customer';

    /**
     * Human friendly labels used by the admin panel.
     *
     * @return array<string, string>
     */
    public static function roleOptions(): array
    {
        return [
            self::ROLE_SUPER_ADMIN => 'Super Admin',
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_VALIDATOR => 'Satpam (Validator)',
        ];
    }

    /**
     * Granular menu permissions available for Admin users.
     *
     * @return array<string, string>
     */
    public static function permissionOptions(): array
    {
        return [
            'transactions' => 'Transaksi Tiket (Lihat, Edit, & Reschedule)',
            'ticket_packages' => 'Katalog Tiket & Add-On (Harga, Paket, Kuota)',
            'promos' => 'Kode Promo & Referral',
            'wahanas' => 'Kelola Wahana & Atraksi',
            'facilities_dining' => 'Fasilitas & Resto (Dining)',
            'faqs_cms' => 'Informasi Web & FAQ',
            'settings' => 'Pengaturan Web & Kontak',
            'scanner_access' => 'Akses Scanner Tiket (Security Gate)',
        ];
    }

    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Every authenticated staff role EXCEPT validator may reach the panel.
        return in_array($this->role, [
            self::ROLE_SUPER_ADMIN,
            self::ROLE_ADMIN,
            self::ROLE_OPERATOR,
        ], true);
    }

    public function hasRole(string ...$roles): bool
    {
        return in_array($this->role, $roles, true);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    /**
     * Check if user has specific permission. Super admin always has all permissions.
     */
    public function hasPermission(string $permission): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($this->role === self::ROLE_ADMIN) {
            $perms = $this->permissions ?? [];
            return is_array($perms) && in_array($permission, $perms, true);
        }

        return false;
    }

    /**
     * Can manage the catalog (wahana, ticket packages, promo codes).
     */
    public function canManageCatalog(): bool
    {
        return $this->hasPermission('ticket_packages');
    }

    /**
     * Can see transactions (super admin, admin with transactions permission).
     */
    public function canViewTransactions(): bool
    {
        return $this->hasPermission('transactions');
    }

    /**
     * Can use the ticket validator / scanner.
     */
    public function canValidateTickets(): bool
    {
        return $this->isSuperAdmin()
            || $this->role === self::ROLE_VALIDATOR
            || ($this->role === self::ROLE_ADMIN && $this->hasPermission('scanner_access'));
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'permissions' => 'array',
        ];
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? \Illuminate\Support\Facades\Storage::url($this->avatar_url) : null;
    }
}
