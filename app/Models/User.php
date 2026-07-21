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

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_SUPER_ADMIN = 'super_admin';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_VALIDATOR = 'validator';
    public const ROLE_OPERATOR = 'operator';

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
            self::ROLE_VALIDATOR => 'Validator',
            self::ROLE_OPERATOR => 'Operator',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Every authenticated staff role may reach the panel; individual
        // resources are gated per-role. Validators are routed to the scanner.
        return in_array($this->role, [
            self::ROLE_SUPER_ADMIN,
            self::ROLE_ADMIN,
            self::ROLE_VALIDATOR,
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
     * Can manage the catalog (wahana, ticket packages, promo codes).
     */
    public function canManageCatalog(): bool
    {
        return $this->hasRole(self::ROLE_SUPER_ADMIN, self::ROLE_ADMIN);
    }

    /**
     * Can see transactions (super admin, admin, operator).
     */
    public function canViewTransactions(): bool
    {
        return $this->hasRole(self::ROLE_SUPER_ADMIN, self::ROLE_ADMIN, self::ROLE_OPERATOR);
    }

    /**
     * Can use the ticket validator / scanner.
     */
    public function canValidateTickets(): bool
    {
        return $this->hasRole(self::ROLE_SUPER_ADMIN, self::ROLE_ADMIN, self::ROLE_VALIDATOR);
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
        ];
    }
}
