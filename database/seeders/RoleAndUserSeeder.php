<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Super Admin Account
        User::updateOrCreate(
            ['email' => 'superadmin@aquaboom.com'],
            [
                'name' => 'Fadli (Super Admin)',
                'password' => Hash::make('password'),
                'role' => User::ROLE_SUPER_ADMIN,
            ]
        );

        // 2. Admin Operasional Account
        User::updateOrCreate(
            ['email' => 'admin@aquaboom.com'],
            [
                'name' => 'Admin Operasional',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ADMIN,
            ]
        );

        // 3. Satpam / Validator Account
        User::updateOrCreate(
            ['email' => 'satpam@aquaboom.com'],
            [
                'name' => 'Petugas Pintu Masuk',
                'password' => Hash::make('password'),
                'role' => User::ROLE_VALIDATOR,
                'pin' => '123456',
            ]
        );
    }
}
