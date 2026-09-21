<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    /**
     * Tampilkan formulir permintaan reset password (Forgot Password).
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Kirim email link reset password kepada pengguna.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
        ]);

        $email = strtolower(trim($request->email));
        $user = User::where('email', $email)->first();

        // Keamanan: Tetap berikan respons sukses meski email tidak terdaftar agar mencegah user enumeration
        if (!$user) {
            return back()->with('status', 'Jika alamat email Anda terdaftar, kami telah mengirimkan instruksi pengaturan ulang kata sandi ke kotak masuk Anda.');
        }

        // Generate token unik 64-karakter
        $token = Str::random(64);

        // Simpan token ke tabel password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'email' => $email,
                'token' => Hash::make($token),
                'created_at' => Carbon::now(),
            ]
        );

        // Buat link reset
        $resetUrl = route('password.reset', ['token' => $token, 'email' => $email]);

        // Kirim email notifikasi
        try {
            Mail::send('emails.password_reset', [
                'user' => $user,
                'resetUrl' => $resetUrl,
                'expiresMinutes' => 60,
            ], function ($message) use ($user) {
                $message->to($user->email, $user->name)
                    ->subject('Atur Ulang Kata Sandi Akun - Aquaboom Balikpapan');
            });
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Password reset email failed: ' . $e->getMessage());
        }

        return back()->with('status', 'Kami telah mengirimkan link pengaturan ulang kata sandi ke email Anda. Silakan periksa kotak masuk (atau folder spam).');
    }

    /**
     * Tampilkan formulir input kata sandi baru.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Eksekusi pembaruan kata sandi baru.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'token.required' => 'Token pengaturan ulang kata sandi tidak valid.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $email = strtolower(trim($request->email));

        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$record) {
            return back()->withErrors(['email' => 'Permintaan pengaturan ulang kata sandi tidak ditemukan atau telah kedaluwarsa.']);
        }

        // Cek kedaluwarsa token (60 menit)
        if (Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return back()->withErrors(['email' => 'Link pengaturan ulang kata sandi telah kedaluwarsa. Silakan ajukan permohonan baru.']);
        }

        // Verifikasi token hash
        if (!Hash::check($request->token, $record->token)) {
            return back()->withErrors(['email' => 'Token pengaturan ulang kata sandi tidak valid atau tidak cocok.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Akun pengguna tidak ditemukan.']);
        }

        // Update password baru & verifikasi email jika belum
        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        if (empty($user->email_verified_at)) {
            $user->email_verified_at = Carbon::now();
        }
        $user->save();

        // Hapus token yang sudah digunakan
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('login')->with('status', 'Kata sandi Anda berhasil diperbarui! Silakan masuk dengan kata sandi baru Anda.');
    }
}
