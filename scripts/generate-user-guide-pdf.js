import puppeteer from 'puppeteer';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

async function generatePdf() {
    console.log('Launching browser to generate PDF...');
    const browser = await puppeteer.launch({
        executablePath: '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome',
        headless: 'new',
        args: ['--no-sandbox', '--disable-setuid-sandbox']
    });

    const page = await browser.newPage();

    const htmlContent = `
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Panduan Pengguna Website Aquaboom Waterpark</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        @page {
            size: A4;
            margin: 0;
        }

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
            color: #0f2726;
            font-size: 13px;
            line-height: 1.6;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 24mm 20mm;
            margin: 0 auto;
            background: #ffffff;
            position: relative;
            page-break-after: always;
            display: flex;
            flex-direction: column;
        }

        .page:last-child {
            page-break-after: avoid;
        }

        /* Cover Page */
        .cover {
            background: linear-gradient(135deg, #0f2726 0%, #163a39 50%, #091817 100%);
            color: #ffffff;
            justify-content: space-between;
            padding: 30mm 24mm;
        }

        .cover-badge {
            display: inline-block;
            background: rgba(201, 168, 76, 0.2);
            color: #c9a84c;
            border: 1px solid rgba(201, 168, 76, 0.4);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 30px;
            margin-bottom: 20px;
        }

        h1, h2, h3, h4 {
            font-family: 'Outfit', sans-serif;
            margin: 0 0 10px 0;
            line-height: 1.2;
        }

        .cover-title {
            font-size: 38px;
            font-weight: 900;
            letter-spacing: -0.5px;
            text-transform: uppercase;
            color: #ffffff;
            margin-bottom: 12px;
        }

        .cover-subtitle {
            font-size: 18px;
            font-weight: 600;
            color: #44b3b0;
            line-height: 1.4;
            max-width: 500px;
            margin-bottom: 30px;
        }

        .cover-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 24px;
            margin-top: 40px;
        }

        .cover-card-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.85);
        }

        .cover-card-item:last-child {
            margin-bottom: 0;
        }

        .cover-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #c9a84c;
        }

        .cover-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            font-size: 11px;
            color: rgba(255, 255, 255, 0.6);
        }

        /* Header & Footer on Content Pages */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1.5px solid #e2e8f0;
            padding-bottom: 12px;
            margin-bottom: 24px;
        }

        .page-header-logo {
            font-family: 'Outfit', sans-serif;
            font-weight: 900;
            font-size: 16px;
            color: #0f2726;
            letter-spacing: 0.5px;
        }

        .page-header-title {
            font-size: 11px;
            font-weight: 700;
            color: #44b3b0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .page-footer {
            margin-top: auto;
            border-top: 1px solid #e2e8f0;
            padding-top: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 10px;
            color: #94a3b8;
        }

        /* Content Styling */
        .section-title {
            font-size: 22px;
            font-weight: 800;
            color: #0f2726;
            text-transform: uppercase;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-badge {
            background: #0f2726;
            color: #c9a84c;
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 900;
        }

        .section-desc {
            font-size: 12.5px;
            color: #64748b;
            margin-bottom: 20px;
        }

        /* Step Card */
        .step-container {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 24px;
        }

        .step-card {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            padding: 18px 20px;
            display: flex;
            gap: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }

        .step-num {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, #0f2726, #163a39);
            color: #c9a84c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 16px;
            shrink-0;
            font-family: 'Outfit', sans-serif;
            border: 1px solid #c9a84c;
        }

        .step-content h4 {
            font-size: 14.5px;
            font-weight: 800;
            color: #0f2726;
            margin-bottom: 4px;
        }

        .step-content p {
            margin: 0;
            color: #475569;
            font-size: 12.5px;
            line-height: 1.5;
        }

        /* Callout Alert */
        .alert-box {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-left: 4px solid #22c55e;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .alert-box.info {
            background: #f0fdfa;
            border-color: #99f6e4;
            border-left-color: #44b3b0;
        }

        .alert-box.warning {
            background: #fffbeb;
            border-color: #fde68a;
            border-left-color: #f59e0b;
        }

        .alert-title {
            font-weight: 800;
            font-size: 12.5px;
            color: #0f2726;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .alert-desc {
            font-size: 12px;
            color: #334155;
            margin: 0;
        }

        /* Tables */
        .table-custom {
            width: 100%;
            border-collapse: collapse;
            font-size: 11.5px;
            margin-bottom: 20px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .table-custom th {
            background: #0f2726;
            color: #ffffff;
            padding: 10px 14px;
            text-align: left;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table-custom td {
            padding: 10px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }

        .table-custom tr:nth-child(even) {
            background: #f8fafc;
        }

        /* Grid Feature Boxes */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 20px;
        }

        .feature-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 16px;
        }

        .feature-box h5 {
            font-size: 13px;
            font-weight: 800;
            color: #0f2726;
            margin: 0 0 6px 0;
        }

        .feature-box p {
            margin: 0;
            font-size: 11.5px;
            color: #64748b;
            line-height: 1.4;
        }

        .badge-pill {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 10.5px;
            font-weight: 800;
            text-transform: uppercase;
        }
        .badge-success { background: #dcfce7; color: #166534; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-info { background: #e0f2fe; color: #075985; }

    </style>
</head>
<body>

    <!-- ================= PAGE 1: COVER ================= -->
    <div class="page cover">
        <div>
            <div class="cover-badge">Official User Manual v2.0</div>
            <div class="cover-title">PANDUAN PENGGUNA<br>WEBSITE AQUABOOM</div>
            <div class="cover-subtitle">Tata Cara Pemesanan Tiket Online, Pembayaran Otomatis DOKU, dan Penggunaan E-Ticket Resmi.</div>

            <div class="cover-card">
                <div class="cover-card-item">
                    <div class="cover-dot"></div>
                    <span><strong>Platform:</strong> Website Resmi Aquaboom Waterpark Balikpapan</span>
                </div>
                <div class="cover-card-item">
                    <div class="cover-dot"></div>
                    <span><strong>Lokasi:</strong> 7F - Balikpapan Superblock (Astara & Pentacity Hotel)</span>
                </div>
                <div class="cover-card-item">
                    <div class="cover-dot"></div>
                    <span><strong>Metode Pembayaran:</strong> QRIS, Virtual Account (BCA, Mandiri, BRI, BNI), Kartu Kredit, E-Wallet</span>
                </div>
                <div class="cover-card-item">
                    <div class="cover-dot"></div>
                    <span><strong>Format Tiket:</strong> E-Ticket Resmi QR Code Instan (Simpan PDF / Scan Loket)</span>
                </div>
            </div>
        </div>

        <div class="cover-footer">
            <div>
                <strong>AQUABOOM WATERPARK BALIKPAPAN</strong><br>
                Managed by Astara Hotel Balikpapan
            </div>
            <div style="text-align: right;">
                Dokumentasi Resmi Sistem Web & Transaksi<br>
                Tahun 2026
            </div>
        </div>
    </div>

    <!-- ================= PAGE 2: ALUR PEMBELIAN TIKET ================= -->
    <div class="page">
        <div class="page-header">
            <div class="page-header-logo">AQUABOOM WATERPARK</div>
            <div class="page-header-title">Bab 1: Alur Pemesanan Tiket Online</div>
        </div>

        <div class="section-title">
            <span class="section-badge">01</span>
            Langkah Pembelian Tiket
        </div>
        <div class="section-desc">Pengunjung dapat memesan tiket masuk secara online kapan saja tanpa perlu mengantri panjang di loket fisik.</div>

        <div class="step-container">
            <div class="step-card">
                <div class="step-num">1</div>
                <div class="step-content">
                    <h4>Buka Halaman Pemesanan & Pilih Tanggal Kunjungan</h4>
                    <p>Klik tombol <strong>"Beli Tiket Sekarang"</strong> pada menu navigasi atau halaman utama. Pada <strong>Step 1</strong>, pilih tanggal rencana kedatangan Anda pada kalender interaktif. Sistem akan otomatis mendeteksi apakah tanggal tersebut termasuk <em>Hari Kerja (Weekday)</em>, <em>Akhir Pekan (Weekend)</em>, atau <em>Hari Libur Nasional</em>.</p>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">2</div>
                <div class="step-content">
                    <h4>Pilih Paket Tiket & Tentukan Jumlah Orang (Pax)</h4>
                    <p>Pada <strong>Step 2</strong>, pilih jenis paket tiket yang sesuai (Tiket Reguler, Tiket Berdua, Tiket Rombongan 4 Orang, atau Tiket Terusan). Gunakan tombol <strong>[+]</strong> dan <strong>[-]</strong> untuk menentukan jumlah tiket yang ingin dibeli. Rincian subtotal akan otomatis terkalkulasi secara instan.</p>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">3</div>
                <div class="step-content">
                    <h4>Pilih Tambahan Fasilitas & Sewa (Opsional)</h4>
                    <p>Pada <strong>Step 3</strong>, pengunjung dapat menambahkan fasilitas tambahan seperti <em>Sewa Gazebo Pribadi (Cabana)</em>, <em>Loker Penitipan Barang</em>, atau <em>Ban Renang (Single / Double)</em> untuk kenyamanan ekstra selama berenang.</p>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">4</div>
                <div class="step-content">
                    <h4>Isi Data Pengunjung & Masukkan Kode Promo</h4>
                    <p>Lengkapi formulir Nama Lengkap, Nomor WhatsApp aktif, dan Alamat Email. Salinan E-Ticket resmi akan dikirimkan ke Email dan tersimpan di akun Anda. Jika memiliki kode voucher/promo, masukkan pada kolom <em>"Kode Promo"</em> lalu klik <strong>Terapkan</strong>.</p>
                </div>
            </div>
        </div>

        <div class="alert-box info">
            <div class="alert-title">💡 Tips Hemat Transaksi:</div>
            <div class="alert-desc">Pilih paket bundle <strong>Tiket Berdua</strong> atau <strong>Tiket 4 Orang</strong> untuk mendapatkan potongan harga spesial lebih hemat dibandingkan membeli tiket satuan reguler.</div>
        </div>

        <div class="page-footer">
            <span>Panduan Pengguna — Aquaboom Waterpark</span>
            <span>Halaman 2 dari 4</span>
        </div>
    </div>

    <!-- ================= PAGE 3: PEMBAYARAN & E-TICKET ================= -->
    <div class="page">
        <div class="page-header">
            <div class="page-header-logo">AQUABOOM WATERPARK</div>
            <div class="page-header-title">Bab 2: Pembayaran & Akses E-Ticket</div>
        </div>

        <div class="section-title">
            <span class="section-badge">02</span>
            Tata Cara Pembayaran Online (DOKU)
        </div>
        <div class="section-desc">Aquaboom menggunakan gerbang pembayaran terenkripsi resmi <strong>DOKU Payment Gateway</strong> yang aman dan otomatis terverifikasi secara real-time.</div>

        <table class="table-custom">
            <thead>
                <tr>
                    <th>Metode Pembayaran</th>
                    <th>Instruksi Pembayaran</th>
                    <th>Kecepatan Verifikasi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>QRIS (Semua Bank & E-Wallet)</strong></td>
                    <td>Scan kode QRIS yang muncul menggunakan BCA Mobile, GoPay, OVO, Dana, ShopeePay, dll.</td>
                    <td><span class="badge-pill badge-success">Instan (1 Detik)</span></td>
                </tr>
                <tr>
                    <td><strong>Virtual Account (VA)</strong></td>
                    <td>Transfer ke nomor VA resmi (BCA, Mandiri, BRI, BNI, Permata, Danamon) via ATM / m-Banking.</td>
                    <td><span class="badge-pill badge-success">Otomatis Real-time</span></td>
                </tr>
                <tr>
                    <td><strong>Kartu Kredit / Debit Online</strong></td>
                    <td>Masukkan nomor kartu Visa/Mastercard/JCB dan otentikasi OTP 3D Secure dari Bank penerbit.</td>
                    <td><span class="badge-pill badge-success">Instan</span></td>
                </tr>
            </tbody>
        </table>

        <div class="section-title" style="margin-top: 24px;">
            <span class="section-badge">03</span>
            Pengelolaan E-Ticket Resmi
        </div>
        <div class="section-desc">Setelah pembayaran berhasil diverifikasi oleh sistem, E-Ticket resmi akan langsung diterbitkan:</div>

        <div class="grid-2">
            <div class="feature-box">
                <h5>1. Tampilan E-Ticket & QR Code</h5>
                <p>Halaman E-Ticket menampilkan <strong>QR Code Vektor Unik</strong>, Order ID Transaksi, Nama Pengunjung, Tanggal Kunjungan, dan Rincian Paket Pembelian.</p>
            </div>
            <div class="feature-box">
                <h5>2. Tombol Cetak / Simpan PDF</h5>
                <p>Klik tombol <strong>"Cetak / Simpan E-Ticket (PDF)"</strong> untuk mengunduh dokumen tiket resmi ke HP atau komputer dalam kualitas tajam tanpa pecah.</p>
            </div>
            <div class="feature-box">
                <h5>3. Riwayat Transaksi (Menu Tiket Saya)</h5>
                <p>Pengguna yang login dapat membuka menu <strong>"Tiket Saya"</strong> di bar navigasi kapan saja untuk melihat kembali semua riwayat tiket yang pernah dibeli.</p>
            </div>
            <div class="feature-box">
                <h5>4. Konfirmasi Email Otomatis</h5>
                <p>Sistem mengirimkan rincian invoice dan tautan langsung E-Ticket ke alamat email pemesan secara otomatis.</p>
            </div>
        </div>

        <div class="alert-box warning">
            <div class="alert-title">⚠️ Keamanan Tiket Masuk:</div>
            <div class="alert-desc">Setiap E-Ticket memiliki kode QR unik sekali pakai. Harap tidak membagikan tangkapan layar atau link tiket Anda kepada orang lain sebelum kunjungan untuk mencegah penyalahgunaan.</div>
        </div>

        <div class="page-footer">
            <span>Panduan Pengguna — Aquaboom Waterpark</span>
            <span>Halaman 3 dari 4</span>
        </div>
    </div>

    <!-- ================= PAGE 4: VALIDASI LOKET & CS ================= -->
    <div class="page">
        <div class="page-header">
            <div class="page-header-logo">AQUABOOM WATERPARK</div>
            <div class="page-header-title">Bab 3: Check-In Loket & Bantuan CS</div>
        </div>

        <div class="section-title">
            <span class="section-badge">04</span>
            Prosedur Masuk di Loket Aquaboom
        </div>
        <div class="section-desc">Proses masuk di pintu wahana Aquaboom Waterpark Lantai 7 BSB Area:</div>

        <div class="step-container" style="margin-bottom: 20px;">
            <div class="step-card">
                <div class="step-num">A</div>
                <div class="step-content">
                    <h4>Tiba di Loket Masuk Aquaboom Lantai 7</h4>
                    <p>Tunjukkan layar HP Anda yang menampilkan <strong>QR Code E-Ticket Resmi</strong> (atau lembaran cetak PDF) kepada petugas loket resepsionis.</p>
                </div>
            </div>
            <div class="step-card">
                <div class="step-num">B</div>
                <div class="step-content">
                    <h4>Pemindaian Scanner Validator</h4>
                    <p>Petugas akan melakukan scan QR Code dengan scanner validator. Sistem memverifikasi keabsahan tiket secara instan.</p>
                </div>
            </div>
            <div class="step-card">
                <div class="step-num">C</div>
                <div class="step-content">
                    <h4>Penerimaan Wristband / Akses Wahana</h4>
                    <p>Setelah tiket tervalidasi (status berubah menjadi <em>Checked In / Scanned</em>), pengunjung menerima gelang masuk (wristband) dan siap menikmati seluruh atraksi air!</p>
                </div>
            </div>
        </div>

        <div class="section-title">
            <span class="section-badge">05</span>
            Bantuan & Layanan Pelanggan (CS)
        </div>

        <div class="grid-2">
            <div class="feature-box" style="border-left: 4px solid #25D366;">
                <h5>WhatsApp Customer Service (CS)</h5>
                <p>Hubungi admin bantuan cepat via tombol hijau WhatsApp di pojok kanan bawah website untuk pertanyaan tiket, jadwal operasional, atau kendala pembayaran.</p>
            </div>
            <div class="feature-box" style="border-left: 4px solid #c9a84c;">
                <h5>Paket Corporate / Rombongan</h5>
                <p>Untuk reservasi rombongan kantor, gathering keluarga (min. 10 orang), atau acara ulang tahun, buka menu <strong>Gatherings</strong> untuk penawaran harga khusus.</p>
            </div>
        </div>

        <div class="alert-box" style="background: #f8fafc; border: 1.5px solid #0f2726; border-left: 6px solid #c9a84c;">
            <div class="alert-title">🏢 Kontak Resmi Aquaboom Waterpark:</div>
            <div class="alert-desc" style="line-height: 1.8;">
                • <strong>Alamat:</strong> Lantai 7 - Balikpapan Superblock (Astara Hotel & Pentacity Hotel), Kota Balikpapan.<br>
                • <strong>Email Resmi:</strong> Info.aquaboomwaterpark@jatrahotels.com<br>
                • <strong>Jam Operasional:</strong> Setiap Hari, Pukul 09.00 - 18.00 WITA
            </div>
        </div>

        <div class="page-footer">
            <span>Panduan Pengguna — Aquaboom Waterpark</span>
            <span>Halaman 4 dari 4</span>
        </div>
    </div>

</body>
</html>
    `;

    await page.setContent(htmlContent, { waitUntil: 'networkidle0' });

    const pdfPath = path.join('/Users/fadlizainulihsani/Documents/work/aquaboom', 'DOKUMENTASI_PENGGUNA_AQUABOOM.pdf');

    await page.pdf({
        path: pdfPath,
        format: 'A4',
        printBackground: true,
        margin: {
            top: '0px',
            right: '0px',
            bottom: '0px',
            left: '0px'
        }
    });

    await browser.close();
    console.log('PDF successfully generated at: ' + pdfPath);
}

generatePdf().catch(err => {
    console.error('Error generating PDF:', err);
    process.exit(1);
});
