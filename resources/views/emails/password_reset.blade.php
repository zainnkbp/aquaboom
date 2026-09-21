<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Atur Ulang Kata Sandi - Aquaboom Waterpark Balikpapan</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; line-height: 1.6; color: #1e293b; background-color: #f8fafc; margin: 0; padding: 20px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 560px; margin: 0 auto; background-color: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08); border: 1px solid #e2e8f0;">
        
        <!-- Header Brand -->
        <tr>
            <td style="background: linear-gradient(135deg, #091D26 0%, #112F3D 100%); padding: 32px 24px; text-align: center;">
                <h1 style="color: #F09628; margin: 0 0 6px 0; font-size: 22px; font-weight: 900; letter-spacing: 1.5px; text-transform: uppercase;">AQUABOOM WATERPARK</h1>
                <p style="color: #94a3b8; margin: 0; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Keamanan Akun Pengunjung</p>
            </td>
        </tr>

        <!-- Body Content -->
        <tr>
            <td style="padding: 32px 28px;">
                <h2 style="color: #091D26; margin-top: 0; font-size: 18px; font-weight: 800;">Halo, {{ $user->name }}! 👋</h2>
                <p style="color: #475569; font-size: 14px; margin-bottom: 24px; line-height: 1.6;">
                    Kami menerima permintaan untuk mengatur ulang kata sandi akun Aquaboom Anda. Klik tombol aman di bawah ini untuk membuat kata sandi baru:
                </p>

                <!-- CTA Button -->
                <div style="text-align: center; margin: 32px 0;">
                    <a href="{{ $resetUrl }}" style="background: linear-gradient(to right, #F09628, #ea8a18); color: #091D26; text-decoration: none; padding: 14px 32px; border-radius: 9999px; font-weight: 900; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; box-shadow: 0 4px 12px rgba(240, 150, 40, 0.35);">
                        ATUR ULANG KATA SANDI
                    </a>
                </div>

                <!-- Info Box -->
                <table width="100%" cellspacing="0" cellpadding="0" style="background-color: #f1f5f9; border-radius: 12px; border-left: 4px solid #F09628; margin-bottom: 24px;">
                    <tr>
                        <td style="padding: 14px 16px; font-size: 12px; color: #475569; line-height: 1.5;">
                            ⏱️ <strong>Batas Waktu:</strong> Link ini hanya berlaku selama <strong>{{ $expiresMinutes }} menit</strong> sejak email ini dikirim.
                        </td>
                    </tr>
                </table>

                <p style="color: #64748b; font-size: 13px; line-height: 1.5; margin-bottom: 24px;">
                    Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini. Kata sandi akun Anda akan tetap aman dan tidak mengalami perubahan.
                </p>

                <div style="border-top: 1px solid #e2e8f0; padding-top: 20px; font-size: 11px; color: #94a3b8; word-break: break-all;">
                    Jika tombol di atas tidak dapat diklik, salin dan tempel tautan berikut ke browser Anda:<br>
                    <a href="{{ $resetUrl }}" style="color: #0284c7; text-decoration: underline;">{{ $resetUrl }}</a>
                </div>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #f8fafc; padding: 20px 24px; text-align: center; border-top: 1px solid #e2e8f0; font-size: 11px; color: #94a3b8;">
                <p style="margin: 0 0 4px 0; font-weight: 700; color: #64748b;">Aquaboom Waterpark Balikpapan</p>
                <p style="margin: 0;">Pentacity Shopping Venue Lt. 7, Balikpapan Superblock (BSB)</p>
            </td>
        </tr>
    </table>
</body>
</html>
