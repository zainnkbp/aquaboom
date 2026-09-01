<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>E-Ticket & Bukti Pembayaran Resmi - Aquaboom Waterpark</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; line-height: 1.6; color: #1e293b; background-color: #f1f5f9; margin: 0; padding: 20px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        
        <!-- Header -->
        <tr>
            <td style="background: linear-gradient(135deg, #0f2726 0%, #173837 100%); padding: 30px 24px; text-align: center;">
                <h1 style="color: #f59e0b; margin: 0 0 6px 0; font-size: 24px; font-weight: 900; letter-spacing: 1px;">AQUABOOM WATERPARK</h1>
                <p style="color: #94a3b8; margin: 0; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Bukti Pembayaran & E-Ticket Resmi</p>
            </td>
        </tr>

        <!-- Body Content -->
        <tr>
            <td style="padding: 24px;">
                <h2 style="color: #0f172a; margin-top: 0; font-size: 18px; font-weight: 800;">Halo, {{ $transaction->customer_name }}! 👋</h2>
                <p style="color: #475569; font-size: 14px; margin-bottom: 20px;">
                    Pembayaran tiket Anda telah <strong>BERHASIL DIVERIFIKASI</strong>. Berikut adalah rincian lengkap pesanan Anda:
                </p>

                <!-- Order Meta Card -->
                <table width="100%" cellspacing="0" cellpadding="0" style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 20px;">
                    <tr>
                        <td style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-size: 13px; color: #64748b;">Kode Tiket:</td>
                        <td style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-size: 13px; font-weight: 800; color: #d97706; text-align: right; font-family: monospace;">{{ $transaction->order_id }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-size: 13px; color: #64748b;">Tanggal Kunjungan:</td>
                        <td style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-size: 13px; font-weight: 700; color: #0f172a; text-align: right;">{{ \Carbon\Carbon::parse($transaction->visit_date)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 12px 16px; font-size: 13px; color: #64748b;">Status Pembayaran:</td>
                        <td style="padding: 12px 16px; font-size: 12px; font-weight: 800; color: #059669; text-align: right; text-transform: uppercase;">LUNAS (PAID)</td>
                    </tr>
                </table>

                <!-- Itemized Invoice Table -->
                <h3 style="color: #0f172a; font-size: 15px; font-weight: 800; margin: 20px 0 10px 0; text-transform: uppercase; letter-spacing: 0.5px;">Rincian Pembelian:</h3>
                <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse; margin-bottom: 20px;">
                    <thead>
                        <tr style="background-color: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
                            <th style="padding: 10px 12px; text-align: left; font-size: 12px; color: #475569; font-weight: 700; text-transform: uppercase;">Item / Paket</th>
                            <th style="padding: 10px 12px; text-align: center; font-size: 12px; color: #475569; font-weight: 700; text-transform: uppercase;">Qty</th>
                            <th style="padding: 10px 12px; text-align: right; font-size: 12px; color: #475569; font-weight: 700; text-transform: uppercase;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->items as $item)
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 12px; font-size: 13px; color: #1e293b; font-weight: 600;">
                                {{ $item->ticketPackage->name ?? 'Tiket Masuk' }}
                                <div style="font-size: 11px; color: #64748b; font-weight: normal;">@ Rp {{ number_format($item->price_per_ticket, 0, ',', '.') }}</div>
                            </td>
                            <td style="padding: 12px; text-align: center; font-size: 13px; font-weight: 700; color: #0f172a;">{{ $item->quantity }}</td>
                            <td style="padding: 12px; text-align: right; font-size: 13px; font-weight: 700; color: #0f172a;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach

                        @if($transaction->addOns && $transaction->addOns->count() > 0)
                        @foreach($transaction->addOns as $addon)
                        <tr style="border-bottom: 1px solid #e2e8f0; background-color: #fefce8;">
                            <td style="padding: 12px; font-size: 13px; color: #854d0e; font-weight: 600;">
                                [Add-On] {{ $addon->addOn->name ?? 'Fasilitas Tambahan' }}
                                <div style="font-size: 11px; color: #a16207; font-weight: normal;">@ Rp {{ number_format($addon->price_per_unit, 0, ',', '.') }}</div>
                            </td>
                            <td style="padding: 12px; text-align: center; font-size: 13px; font-weight: 700; color: #854d0e;">{{ $addon->quantity }}</td>
                            <td style="padding: 12px; text-align: right; font-size: 13px; font-weight: 700; color: #854d0e;">Rp {{ number_format($addon->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                        @endif

                        @if($transaction->discount_amount > 0)
                        <tr style="border-bottom: 1px solid #e2e8f0; color: #059669;">
                            <td colspan="2" style="padding: 10px 12px; font-size: 13px; font-weight: 700;">Diskon Promo:</td>
                            <td style="padding: 10px 12px; text-align: right; font-size: 13px; font-weight: 800;">- Rp {{ number_format($transaction->discount_amount, 0, ',', '.') }}</td>
                        </tr>
                        @endif

                        <tr style="background-color: #f8fafc; border-top: 2px solid #0f2726;">
                            <td colspan="2" style="padding: 14px 12px; font-size: 14px; font-weight: 900; color: #0f172a; text-transform: uppercase;">Total Pembayaran:</td>
                            <td style="padding: 14px 12px; text-align: right; font-size: 16px; font-weight: 900; color: #f59e0b;">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Call to Action Button -->
                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{ url('/ticket/' . $transaction->order_id) }}" style="display: inline-block; background-color: #f59e0b; color: #0f172a; padding: 14px 28px; text-decoration: none; border-radius: 12px; font-weight: 900; font-size: 15px; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.35);">
                        Buka & Download E-Ticket QR Code
                    </a>
                </div>

                <!-- Account Activation Info -->
                <div style="margin-top: 30px; padding: 20px; background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <h4 style="margin-top: 0; color: #0f172a; font-size: 14px; font-weight: 800; text-transform: uppercase;">Aktivasi Akun / Member Access</h4>
                    <p style="font-size: 13px; color: #475569; margin-bottom: 16px; line-height: 1.5;">
                        Akun otomatis telah dibuatkan untuk memudahkan Anda melihat tiket kapan saja. Silakan atur password akun Anda dengan mengklik tombol di bawah ini:
                    </p>
                    <a href="{{ route('activate.account', ['email' => $transaction->customer_email]) }}" style="display: inline-block; background-color: #0f2726; color: #f59e0b; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 12px; text-transform: uppercase; border: 1px solid #f59e0b;">
                        Aktifkan Akun Saya
                    </a>
                </div>

                <p style="font-size: 12px; color: #94a3b8; text-align: center; margin-top: 30px; margin-bottom: 0;">
                    Tunjukkan QR Code e-ticket saat tiba di pintu masuk Aquaboom Waterpark.<br>
                    Terima kasih atas kunjungan Anda!
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
