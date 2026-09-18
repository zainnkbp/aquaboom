<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect pengguna ke halaman otentikasi Google.
     */
    public function redirectToGoogle()
    {
        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');

        if (empty($clientId) || empty($clientSecret)) {
            return redirect()->route('login')->withErrors([
                'email' => 'Integrasi Google Sign-In sedang dalam konfigurasi. Silakan masuk menggunakan email dan kata sandi Anda.',
            ]);
        }

        try {
            return Socialite::driver('google')->redirect();
        } catch (\Throwable $e) {
            Log::error('Google OAuth Redirect Error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors([
                'email' => 'Gagal menghubungkan ke layanan Google. Silakan coba lagi nanti.',
            ]);
        }
    }

    /**
     * Menangani callback respon dari Google OAuth.
     */
    public function handleGoogleCallback(Request $request)
    {
        if ($request->has('error') || !$request->has('code')) {
            return redirect()->route('login')->with('warning', 'Proses login dengan Google dibatalkan.');
        }

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            Log::error('Google OAuth Callback Error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors([
                'email' => 'Autentikasi Google gagal atau kedaluwarsa. Silakan coba kembali.',
            ]);
        }

        $email = $googleUser->getEmail();
        $googleId = $googleUser->getId();

        if (empty($email)) {
            return redirect()->route('login')->withErrors([
                'email' => 'Tidak dapat menemukan alamat email dari akun Google Anda.',
            ]);
        }

        // Cari user yang sudah ada berdasarkan google_id atau email
        $user = User::where('google_id', $googleId)
            ->orWhere('email', $email)
            ->first();

        if ($user) {
            // Update data user jika belum tertaut
            $updates = [];
            if (empty($user->google_id)) {
                $updates['google_id'] = $googleId;
            }
            if (empty($user->avatar_url) && !empty($googleUser->getAvatar())) {
                $updates['avatar_url'] = $googleUser->getAvatar();
            }
            if (empty($user->email_verified_at)) {
                $updates['email_verified_at'] = now();
            }

            if (!empty($updates)) {
                $user->update($updates);
            }
        } else {
            // Buat akun customer baru yang langsung terverifikasi
            $nextId = ((int) User::max('id')) + 1;
            $user = new User();
            $user->id = $nextId;
            $user->name = $googleUser->getName() ?: 'Pengunjung Aquaboom';
            $user->email = $email;
            $user->google_id = $googleId;
            $user->avatar_url = $googleUser->getAvatar();
            $user->password = Hash::make(Str::random(24));
            $user->role = User::ROLE_CUSTOMER;
            $user->email_verified_at = now();
            $user->save();
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect()->intended(route('ticket.buy'))->with('success', 'Selamat datang, ' . $user->name . '!');
    }
}
