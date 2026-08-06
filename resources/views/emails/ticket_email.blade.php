<!DOCTYPE html>
<html>
<head>
    <title>E-Ticket Aquaboom</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333;">
    <h2>Terima kasih, {{ $transaction->customer_name }}!</h2>
    <p>Pembayaran Anda telah kami terima (Mock Payment). Berikut adalah detail pesanan tiket Anda:</p>
    <ul>
        <li><strong>Order ID:</strong> {{ $transaction->order_id }}</li>
        <li><strong>Tanggal Kunjungan:</strong> {{ \Carbon\Carbon::parse($transaction->visit_date)->translatedFormat('d F Y') }}</li>
        <li><strong>Total Pembayaran:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</li>
    </ul>
    
    <p>
        <a href="{{ url('/ticket/' . $transaction->order_id) }}" style="display: inline-block; background-color: #ec4899; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
            Lihat & Download E-Ticket
        </a>
    </p>

    <div style="margin-top: 30px; padding: 20px; background-color: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; max-width: 600px;">
        <h4 style="margin-top: 0; color: #0f172a; font-size: 16px; text-transform: uppercase;">Aktivasi Akun Anda / Activate Your Account</h4>
        <p style="font-size: 13px; color: #475569; margin-bottom: 20px; font-weight: 500; line-height: 1.6;">
            Kami telah otomatis membuatkan akun untuk Anda agar dapat mengakses riwayat transaksi & tiket masuk dengan mudah. Silakan klik tombol di bawah ini untuk mengatur password dan mengaktifkan akun Anda.
            <br><span style="font-style: italic; color: #64748b;">(We have automatically created an account for you to easily manage your transactions and tickets. Please click the button below to set your password and activate your account.)</span>
        </p>
        <a href="{{ route('activate.account', ['email' => $transaction->customer_email]) }}" style="display: inline-block; background-color: #0f172a; color: #d97706; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 13px; text-transform: uppercase; border: 1px solid #d97706;">
            Aktifkan Akun / Activate Account
        </a>
    </div>

    <p style="margin-top: 30px;">Tunjukkan E-Ticket ini di loket masuk. Sampai jumpa di Aquaboom Waterpark!</p>
</body>
</html>
