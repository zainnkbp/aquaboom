<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        $validator = User::where('email', 'satpam@aquaboom.com')->first();
        if (!$validator) {
            $nextId = ((int) User::max('id')) + 1;
            $user = new User();
            $user->id = $nextId;
            $user->name = 'Petugas Pintu Masuk';
            $user->email = 'satpam@aquaboom.com';
            $user->password = Hash::make('password123');
            $user->role = 'validator';
            $user->pin = '123456';
            $user->save();
        } else {
            $validator->update([
                'pin' => '123456',
                'role' => 'validator',
            ]);
        }
    }

    public function down(): void
    {
    }
};
