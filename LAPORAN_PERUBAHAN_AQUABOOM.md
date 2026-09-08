# LAPORAN DETAIL PERUBAHAN WEBSITE AQUABOOM WATERPARK

Dokumen ini menjelaskan secara rinci seluruh penyesuaian yang dilakukan pada repositori **Aquaboom** (branch `staging`), baik dari segi **visual (tampilan)**, **konten**, maupun **sistem**.

---

## 📌 Status Headline & Hero Banner (Sesuai Permintaan)
Teks utama Hero Banner **TETAP DIPERTAHANKAN LENGKAP & UTUH**:

* **Eyebrow:** `Rooftop Waterpark Pertama di Kalimantan Timur`
* **Main Headline:** `KAMI BUKA SETIAP HARI`
* **Sub-headline:** `Weekday: 10.00 - 18.00 | Weekend: 09.00 - 18.00`
* **Deskripsi:** `Aquaboom Waterpark Balikpapan — Satu-satunya Waterpark yang berada di atas gedung bertingkat di Indonesia. Managed by Astara Hotel Balikpapan.`
* **Tombol CTA:**
  * `[BELI TIKET ONLINE]` (menuju `/ticket`)
  * `[Paket Rombongan →]` (menuju `/gatherings`)
* **Badge:**
  * `Premium Rooftop`
  * `Safe & Certified`
  * `7th Floor, BSB Mall`

---

## 🎨 Ringkasan Perubahan Tampilan (Visual & UI)

1. **Foto Asli Wahana (Menggantikan Picsum Placeholder):**
   * Sebelumnya menggunakan placeholder acak dari internet (`picsum.photos`).
   * Kini menggunakan foto asli wahana seluncuran dan area waterpark Aquaboom (`aquaboom-slide1.jpg`, dll).

2. **Perapian Tampilan Paket Promo (`/packages` & Homepage):**
   * Label harga paket bundle (Duo Pass & Four Pack) diperjelas menjadi `/ paket` dengan badge hijau `Untuk 2 orang` / `Untuk 4 orang` (sebelumnya membingungkan karena tertulis `/ tiket`).
   * Teks keuntungan yang sebelumnya panjang menumpuk dengan tanda `+` diubah menjadi daftar teratur ke bawah berikon centang SVG hijau.

3. **Banner Jam Buka di Halaman Beli Tiket (`/ticket`):**
   * Diperjelas menjadi 2 jadwal spesifik: *Senin–Jumat: 10:00–18:00 WITA* dan *Sabtu, Minggu & Libur: 09:00–18:00 WITA* dengan catatan batas masuk terakhir 17:00 WITA.

4. **Bilingual Switch (ID ⇄ EN):**
   * Ketika tombol bendera / bahasa EN diklik, seluruh menu Navbar, Drawer Mobile, judul tiket, dan footer kini otomatis berganti ke bahasa Inggris yang rapi.

---

## 🔒 Hal yang Tetap Utuh & Tidak Diubah
* Alur transaksi Midtrans & keamanan pembayaran
* Layout dasar, warna dark navy, dan shimmer gold Aquaboom
* Admin panel Filament & validasi kuota tiket
