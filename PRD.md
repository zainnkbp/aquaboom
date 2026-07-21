# Product Requirements Document (PRD)

**Project Name**: Aquaboom Waterpark Landing Page Redesign
**Version**: 2.0 (Modern Luxury Edition)
**Status**: Completed (Frontend UI/UX)

---

## 1. Project Overview

### 1.1 Objective

Mentransformasi _landing page_ Aquaboom Waterpark dari desain konvensional menjadi destinasi digital berkelas premium. Fokus utama adalah meningkatkan _Conversion Rate_ (penjualan tiket) melalui pendekatan desain **Modern Luxury, Glassmorphism, dan Gamifikasi UX**.

### 1.2 Target Audience

- **Primary**: Remaja dan eksekutif muda (Millennials & Gen Z) yang mencari destinasi estetik dan gaya hidup.
- **Secondary**: Keluarga kelas menengah ke atas yang menginginkan fasilitas lengkap dan nyaman (standar hotel bintang 4).

### 1.3 Tech Stack

- **Core**: HTML5, CSS3, Vanilla JavaScript
- **Styling**: Tailwind CSS (CDN)
- **Reactivity & State**: Alpine.js (CDN)
- **Animations**: AOS (Animate on Scroll) & CSS Keyframes

---

## 2. Core Features & Architecture

### 2.1 Smart Navigation & Micro-Interactions

- **Floating Pill Navbar**: _Navbar_ berwujud "pil" kaca yang muncul secara elegan (turun dari atas) hanya ketika _user_ mulai melakukan _scroll_. Mendukung navigasi _smooth scroll_ ke setiap seksi utama.
- **Dynamic Custom Cursor**: Kursor bawaan sistem disembunyikan, diganti dengan kursor interaktif berbentuk lingkaran _pink_. Kursor ini menampilkan teks spesifik (misal: _"Pesan!"_, _"Main Yuk!"_, _"Eksklusif!"_) ketika _hover_ pada elemen-elemen penting.

### 2.2 Section Breakdown

1.  **Hero Section (First Impression)**
    - Latar belakang gradien _mesh_ dengan komposisi warna _playful_ (Pink & Biru laut).
    - Tipografi _punchy_ menggunakan _font_ **Outfit** dipadukan dengan **Plus Jakarta Sans**.
    - CTA Utama: Tombol "Mulai Petualangan" yang dilengkapi efek magnetik.

2.  **Eksplorasi Nirwana Air (Tentang Kami)**
    - Animasi teks pewarnaan dinamis _(scroll-triggered fill)_ menggunakan _Intersection Observer_. Warna teks berubah dari abu-abu menjadi gradien secara perlahan mengikuti posisi _scroll_.

3.  **Wahana Favorit (Katalog)**
    - Grid 3 kolom berisi kartu vertikal bergaya modern.
    - _Hover state_ memicu efek _scale-up_ halus untuk menegaskan interaktivitas.

4.  **Keunggulan Premium (Fasilitas Bintang 4)**
    - Desain **Bento Grid** ala Apple (Glassmorphism).
    - Setiap sel grid diberi efek kaca buram _(backdrop-blur)_ yang menonjolkan fitur unik seperti: Posisi di Gedung Bertingkat, Akses Mall (Pentacity/e-Walk), Musholla, Gazebo, dan Kamar Bilas.

5.  **Momen Keseruan (Social Proof Visual)**
    - _Infinite Horizontal Marquee_ (karousel foto berjalan tanpa henti).
    - Foto diberi bingkai putih (_polaroid style_) pada _background_ putih bersih.

6.  **Lokasi & Aksesibilitas**
    - Integrasi peta interaktif.
    - Kartu alamat _floating_ bergaya _glassmorphism_ di atas area peta dengan CTA langsung ke Google Maps.

### 2.3 Corporate Trust Footer

- **Trust Badge**: Menyertakan lencana kaca berbunyi **"Managed by Jatra Hotels & Resorts"**.
- **Typography Pairing**: Penggunaan _font_ Serif klasik (**Baskerville**) untuk nama grup korporat demi menyuntikkan elemen _Heritage Luxury_ dan mentransfer wibawa hotel bintang 4 ke arena taman air.
- **Warna**: Menggunakan `bg-slate-900` yang gelap, bersih, dan mahal, menjaga _funnel_ agar audiens tidak bocor/berpindah ke properti lain.

### 2.4 Conversion Engine (Booking Drawer & FOMO)

- **Slide-over Booking Drawer**: Panel pemesanan tiket yang meluncur mulus dari sisi kanan layar, meminimalisir _page load_ baru.
- **Native Date Picker**: Sistem pemilihan tanggal cerdas dengan tombol cepat _(Hari Ini, Besok)_ serta integrasi `<input type="date">` HTML5 murni untuk pemesanan jangka panjang.
- **Live Social Proof Pop-up** _(System Ready)_: Modul notifikasi yang siap diaktifkan untuk menampilkan aktivitas pembelian tiket tiruan/nyata (misal: _"Reza memesan 3 tiket"_) guna memicu _Fear of Missing Out (FOMO)_.

---

## 3. Design System

- **Primary Fonts**: `Outfit` (Heading), `Plus Jakarta Sans` (Body).
- **Luxury Font**: `Libre Baskerville` (Corporate Footer Element).
- **Primary Colors**:
  - Accent: Pink-500 (`#ec4899`)
  - Secondary: Cyan-500 (`#06b6d4`)
  - Surface: Slate-50 (`#f8fafc`) to Slate-900 (`#0f172a`)
- **Visual Motif**: _Rounded corners_ ekstra melengkung (`rounded-3xl`), _Soft Dropshadows_, dan panel transparan _(Glassmorphism)_.

---

## 4. Next Steps & Future Scope

1.  **Backend Integration**: Menghubungkan form di dalam _Booking Drawer_ dengan _payment gateway_ (Midtrans/Xendit).
2.  **Activation of Social Proof**: Mengubah _dummy data_ FOMO menjadi data penarikan API _real-time_ dari _database_ pembelian terbaru.
3.  **CMS Connection**: Mengaitkan daftar Wahana dan Promo dengan sistem _headless_ CMS untuk pembaruan instan tanpa menyentuh _source code_.
