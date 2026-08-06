# 📘 BUKU PANDUAN LENGKAP: AQUABOOM TICKET SYSTEM

Dokumen ini berisi panduan resmi cara menggunakan seluruh fitur yang ada di sistem tiket Aquaboom, mulai dari panel Admin (CMS) hingga aplikasi Scanner untuk satpam lapangan.

---

## DAFTAR ISI
1. **[Pendahuluan & Hak Akses (Role)]**
2. **[Cara Menggunakan Panel Admin CMS]**
   - 2.1. Login & Mengganti Profil
   - 2.2. Mengelola Tiket & Wahana
   - 2.3. Fitur Restore (Super Admin)
3. **[Cara Menggunakan Aplikasi Scanner]**
   - 3.1. Login dengan PIN
   - 3.2. Melakukan Scan QR Code

---

## 1. PENDAHULUAN & HAK AKSES (ROLE)
Sistem ini membagi staf menjadi 3 peran utama demi menjaga keamanan data dan mempermudah operasional lapangan.

- **Super Admin:** Pemilik sistem. Bisa menambah staf baru, melihat semua laporan uang, dan **mengembalikan (Restore) data yang tidak sengaja terhapus**.
- **Admin:** Staf pengelola harga tiket dan promo. Tidak bisa menghapus permanen, tapi bisa mengubah harga dan memvalidasi tiket jika diperlukan.
- **Validator (Satpam):** Staf lapangan. Sama sekali tidak bisa membuka CMS/Laporan. Hanya diberikan 6 Digit PIN untuk membuka layar kamera pemindai.

---

## 2. CARA MENGGUNAKAN PANEL ADMIN CMS

### 2.1. Login & Mengganti Profil
Untuk masuk ke sistem admin:
1. Buka halaman: `http://namadomain.com/admin`
2. Masukkan Email dan Password Anda.
3. Di sudut kanan atas (pada nama Anda), klik dan pilih **Edit Profile** jika Anda ingin mengganti foto profil Anda atau memperbarui password.

![Dashboard Admin](/Users/fadlizainulihsani/.gemini/antigravity-ide/brain/9dd72ec0-c9c6-4323-b6ab-3d66211250e2/dashboard_admin_1784799347605.png)
*(Ilustrasi Halaman Dashboard Admin Aquaboom)*

### 2.2. Mengelola Tiket & Wahana
- Di menu samping (sidebar), klik **Paket Tiket**.
- Anda dapat membuat harga normal, harga khusus Flash Sale, dan mengatur waktu berlakunya promo tersebut secara spesifik (Misal: Hanya berlaku di hari Selasa tanggal 15).
- Terdapat fitur **Salin S&K**, di mana Anda tidak perlu capek mengetik ulang Syarat dan Ketentuan, cukup pilih tiket lama Anda dan teksnya akan langsung tersalin.

### 2.3. Fitur Restore (Khusus Super Admin)
Pernah tidak sengaja menghapus tiket? Jangan panik!
1. Login sebagai **Super Admin**.
2. Masuk ke halaman **Paket Tiket** atau **Transaksi**.
3. Di kanan atas tabel, klik logo corong (Filter), lalu aktifkan mode **Trashed**.
4. Data yang terhapus akan muncul kembali. Pilih dan klik **Restore**.

---

## 3. CARA MENGGUNAKAN APLIKASI SCANNER

Aplikasi scanner dirancang sangat cepat dan mudah digunakan oleh satpam lapangan menggunakan ponsel (*smartphone*) atau *tablet*.

### 3.1. Login Cepat dengan PIN
1. Minta satpam membuka link ini di HP mereka: `http://namadomain.com/scanner/login`
2. Tidak ada kolom email/password, cukup ketik **6 Angka PIN** yang sudah Anda buatkan.
3. Layar akan otomatis bergetar/pindah tanpa menekan tombol apa pun.

### 3.2. Melakukan Scan QR Code
1. Saat berhasil login, kamera belakang HP akan langsung menyala.
2. Arahkan kotak pemindai ke QR Code pengunjung.
3. Jika tiket **Valid**, layar akan berubah menjadi HIJAU BESAR dan menunjukkan berapa jumlah orang yang boleh masuk (Contoh: Total Masuk: 5 ORANG).
4. Jika tiket **Sudah Dipakai**, layar akan menjadi MERAH BESAR dan mengeluarkan peringatan.
5. Jika kamera rusak / buram, satpam bisa langsung mengetik *Order ID* secara manual di kolom yang sudah disediakan di bawah kamera.

![Scanner App](/Users/fadlizainulihsani/.gemini/antigravity-ide/brain/9dd72ec0-c9c6-4323-b6ab-3d66211250e2/scanner_app_1784799357362.png)
*(Ilustrasi Tampilan Aplikasi Scanner Satpam saat tiket Valid)*

---
**Dokumen ini dibuat otomatis oleh Sistem Aquaboom.**
