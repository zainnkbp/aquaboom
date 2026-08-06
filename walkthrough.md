# Walkthrough: Integrasi Sistem Login, Registrasi, & Dashboard Tiket Pelanggan

Kami telah melengkapi alur pembelian *hybrid* dengan portal Login, Register, dan Dashboard Tiket Pelanggan untuk mempermudah akses e-ticket pengunjung.

## Perubahan yang Dilakukan

1. **Penambahan Rute Baru di `routes/web.php`:**
   - `/login` (GET & POST) untuk autentikasi pelanggan.
   - `/register` (GET & POST) untuk pendaftaran manual pelanggan baru.
   - `/logout` untuk mengakhiri sesi.
   - `/my-tickets` (GET) yang diproteksi `auth` middleware untuk menampilkan dashboard.

2. **Halaman Autentikasi Premium (`login.blade.php` & `register.blade.php`):**
   - Dibuat dari awal dengan gaya desain modern, menggunakan gradasi warna khas Aquaboom, card glassmorphic melengkung, serta input form yang ber-padding tebal agar nyaman digunakan di perangkat seluler.

3. **Dashboard "My Tickets" (`my-tickets.blade.php`):**
   - Menampilkan seluruh daftar e-ticket yang dimiliki oleh pelanggan aktif dalam bentuk tabel/list yang responsif.
   - Dilengkapi badge status pembayaran (*Paid, Pending, Scanned, Failed*) dan tombol cepat untuk langsung mengunduh/melihat QR Code E-Ticket.

4. **Integrasi Navigasi (Global Layout Navbar):**
   - Navbar utama (Desktop & Mobile Drawer) secara dinamis mendeteksi status login pengguna:
     - **Belum Login:** Menampilkan tombol **LOGIN** di sebelah pengubah bahasa.
     - **Sudah Login:** Menampilkan link **MY TICKETS** (mengarah ke dashboard) dan **LOGOUT**.
