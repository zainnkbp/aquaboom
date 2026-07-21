# 🏗️ Arsitektur Desain & Teknologi (Study Guide)

**Project**: Aquaboom Premium Landing Page
**Tujuan Dokumen**: Panduan edukasi untuk memahami fungsi, _library_, dan trik desain yang digunakan dalam pembuatan _website_ ini, agar dapat diaplikasikan pada proyek masa depan.

---

## 1. Pustaka Utama (_Core Libraries_)

Kita menggunakan pendekatan _Lightweight Frontend_, yang artinya tidak menggunakan kerangka kerja berat seperti React atau Vue. Semuanya berjalan langsung di _browser_ menggunakan CDN agar _loading_ sangat cepat.

### A. Tailwind CSS (Styling & Layouting)

Tailwind digunakan untuk mendesain seluruh elemen tanpa perlu menulis file CSS terpisah.

- **Fungsi Utama**: Membuat _layout_ (_flexbox/grid_), warna, bayangan, dan tipografi.
- **Trik Kunci yang Digunakan**:
  - **Glassmorphism (Kaca Buram)**: Kombinasi `bg-white/60`, `backdrop-blur-2xl`, dan `border-white/20`. Ini membuat latar belakang tembus pandang secara elegan seperti kaca (digunakan pada Navbar dan Bento Grid).
  - **Gradients**: `bg-gradient-to-r from-cyan-400 to-pink-500` (untuk teks) atau `from-slate-900 to-slate-800` (untuk kartu eksklusif).
  - **Responsive Grid**: `grid-cols-1 md:grid-cols-3` (1 kolom di HP, otomatis menjadi 3 kolom di PC).

### B. Alpine.js (State Management & Interaktivitas)

Alpine.js adalah _framework_ JS mungil yang cara kerjanya mirip Vue/React tetapi ditulis langsung di dalam HTML.

- **Fungsi Utama**: Mengontrol logika UI (buka/tutup _drawer_, ganti _tab_ tanggal).
- **Perintah (Directives) yang Digunakan**:
  - `x-data="{ isBookingOpen: false }"`: Membuat variabel _state_ lokal.
  - `x-show="isBookingOpen"`: Menyembunyikan/menampilkan elemen berdasarkan nilai variabel.
  - `x-transition`: Memberikan animasi halus saat elemen muncul (digunakan pada panel _drawer_ yang meluncur dari kanan).
  - `x-model="customDate"`: Mengikat nilai input kalender langsung ke variabel.

### C. AOS (Animate On Scroll)

Pustaka ringan untuk memicu animasi CSS hanya saat elemen tersebut muncul di layar _(viewport)_ akibat _scroll_.

- **Fungsi Utama**: Membuat elemen melayang masuk _(fade-up)_ atau membesar _(zoom-in)_ saat di-_scroll_.
- **Cara Pakai**: Cukup tambahkan `data-aos="fade-up"` pada HTML. Kita juga mengatur `data-aos-delay="200"` agar animasi kartu muncul bergiliran _(staggered)_.

---

## 2. Fitur Spesial & Trik UX (_Micro-Interactions_)

### A. Custom Cursor Follower

Kursor panah bawaan PC disembunyikan dan diganti dengan elemen buatan kita sendiri.

- **Logika**:
  - CSS: `cursor: none !important;` (menyembunyikan kursor asli).
  - Alpine: `@mousemove="$refs.cursor.style.left = $event.clientX + 'px'"` (memaksa bola pink mengikuti koordinat X dan Y _mouse_ yang asli).
- **Interaktivitas Teks**: Saat kursor menyentuh tombol, perintah `@mouseenter="cursorText='Pesan!'"` akan mengisi bola _pink_ tersebut dengan teks.

### B. Magnetic Hover Effect (Tombol "Bayar Sekarang")

Tombol di dalam _drawer_ tidak statis, melainkan "menarik" diri mendekati kursor _mouse_.

- **Logika**: Menggunakan Vanilla Javascript `getBoundingClientRect()`. Kita menghitung posisi _mouse_ di dalam tombol, lalu menggeser koordinat tombol `transform: translate(X, Y)` searah dengan pergerakan _mouse_ dalam radius tertentu.

### C. Cinematic Text Reveal (Seksi "Tentang Kami")

Teks yang perlahan menyala saat di-_scroll_.

- **Logika**: Menggunakan fitur bawaan _browser_ bernama `Intersection Observer` atau deteksi _scroll_ sederhana.
- **Trik CSS**: Teks aslinya diberi warna abu-abu gelap, lalu kita menimpa _layer_ di atasnya menggunakan warna gradien transparan yang perlahan menebal _(opacity)_ atau bergeser ukurannya saat _class_ `.aos-animate` aktif.

### D. Native HTML5 Date Picker

Pada menu "Pilih Tanggal", alih-alih membuat kalender rumit menggunakan kalender JS yang berat, kita menggunakan trik UX peramban bawaan.

- **Logika**: `<input type="date">` diatur menjadi `opacity-0` (tembus pandang tak terlihat), tetapi diletakkan menumpuk (_absolute_) tepat di atas tombol "Tanggal Lain".
- **Hasil**: Saat pengunjung mengklik tombol tersebut, mereka sebenarnya mengklik input tak terlihat yang langsung memanggil kalender _Native_ bawaan iPhone/Android/Windows yang sangat _smooth_ dan anti-_bug_.

---

## 3. Teori Tipografi (_Luxury Pairing_)

Pemilihan _font_ adalah tulang punggung desain mahal.

1.  **Outfit**: _Font_ modern tanpa kait (_sans-serif_) namun memiliki lekukan tegas. Digunakan untuk Heading besar agar terasa _Playful_ tapi _Premium_.
2.  **Plus Jakarta Sans**: Sangat bersih dan mudah dibaca di layar kecil. Digunakan untuk paragraf deskripsi.
3.  **Libre Baskerville**: _Font_ klasik dengan kait (_serif_). Digunakan **hanya** pada nama Jatra Hotels (di bagian Footer). Secara psikologis, _font serif_ memberikan sinyal "Warisan, Sejarah, Kredibilitas, dan Kekayaan".

---

## 4. Cara Belajar Lebih Lanjut

Jika Anda ingin membangun _website_ seperti ini dari awal di masa depan, urutan pelajari teknologinya adalah:

1.  Kuasai konsep `Flexbox` dan `Grid` pada CSS biasa.
2.  Baca dokumentasi **Tailwind CSS** (terutama bagian _Spacing, Colors_, dan _Positioning_).
3.  Pelajari **Alpine.js** untuk menggantikan manipulasi DOM rumit dari JavaScript biasa (ini jauh lebih mudah daripada belajar React untuk pemula).
4.  Cari referensi _micro-interactions_ di **Awwwards.com** atau **Dribbble** dan pahami bahwa desain yang bagus adalah 80% _spacing_ (jarak putih yang lega) dan 20% ornamen.
