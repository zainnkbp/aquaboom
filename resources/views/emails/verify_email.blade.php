<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verifikasi Akun Pengunjung - Aquaboom Waterpark</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; line-height: 1.6; color: #1e293b; background-color: #f1f5f9; margin: 0; padding: 20px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);">
        
        <!-- Header -->
        <tr>
            <td style="background: linear-gradient(135deg, #0f2726 0%, #163635 100%); padding: 36px 24px; text-align: center;">
                <h1 style="color: #f59e0b; margin: 0 0 6px 0; font-size: 26px; font-weight: 900; letter-spacing: 1px;">AQUABOOM WATERPARK</h1>
                <p style="color: #94a3b8; margin: 0; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Konfirmasi & Verifikasi Alamat Email</p>
            </td>
        </tr>

        <!-- Body Content -->
        <tr>
            <td style="padding: 32px 24px;">
                <h2 style="color: #0f172a; margin-top: 0; font-size: 20px; font-weight: 800;">Halo, {{ $user->name }}! 👋</h2>
                <p style="color: #475569; font-size: 14px; margin-bottom: 24px; line-height: 1.7;">
                    Terima kasih telah bergabung di <strong>Aquaboom Waterpark</strong>. Silakan klik tombol di bawah ini untuk mengonfirmasi keaslian alamat email Anda dan mengaktifkan akses penuh pemesanan tiket resmi.
                </p>

                <!-- CTA Button -->
                <div style="text-align: center; margin: 32px 0;">
                    <a href="{{ $verificationUrl }}" style="background: linear-gradient(135deg, #0f2726 0%, #1e4947 100%); color: #f59e0b; text-decoration: none; padding: 16px 36px; border-radius: 14px; font-weight: 900; font-size: 14px; display: inline-block; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 6px 16px rgba(15, 39, 38, 0.25); border: 1px solid rgba(245, 158, 11, 0.3);">
                        ✓ Verifikasi Alamat Email Saya
                    </a>
                </div>

                <!-- Expiry Note -->
                <p style="color: #64748b; font-size: 12px; line-height: 1.6; margin-top: 24px; background-color: #f8fafc; padding: 14px; border-radius: 12px; border-left: 4px solid #f59e0b;">
                    <strong>Catatan:</strong> Tautan verifikasi ini aman dan akan kedaluwarsa dalam <strong>60 menit</strong>. Jika Anda tidak pernah mendaftar di Aquaboom Waterpark, Anda dapat mengabaikan email ini.
                </p>

                <!-- Plain URL fallback -->
                <div style="margin-top: 24px; padding-top: 18px; border-top: 1px solid #e2e8f0;">
                    <p style="color: #94a3b8; font-size: 11px; margin-bottom: 6px;">Jika tombol di atas tidak berfungsi, salin dan tempel tautan berikut di browser Anda:</p>
                    <p style="word-break: break-all; font-size: 11px; color: #0284c7; margin: 0; font-family: monospace;">{{ $verificationUrl }}</p>
                </div>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #0f2726; padding: 24px; text-align: center; color: #94a3b8; font-size: 12px;">
                <p style="margin: 0 0 6px 0; font-weight: 700; color: #ffffff;">AQUABOOM WATERPARK BALIKPAPAN</p>
                <p style="margin: 0 0 10px 0; font-size: 11px; color: #cbd5e1;">Balikpapan Superblock (BSB) - Pentacity Shopping Venue 7th Floor</p>
                <p style="margin: 0; font-size: 11px; color: #64748b;">&copy; {{ date('Y') }} PT Pesona Balikpapan Jaya. All Rights Reserved.</p>
            </td>
        </tr>
    </table>
</body>
</html>
