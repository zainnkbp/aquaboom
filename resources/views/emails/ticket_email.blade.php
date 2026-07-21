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

    <p>Tunjukkan E-Ticket ini di loket masuk. Sampai jumpa di Aquaboom Waterpark!</p>
</body>
</html>
