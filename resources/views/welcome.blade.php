<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aquaboom Waterpark - Premium Family Destination</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine JS -->
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"
    ></script>
    @livewireStyles
    <!-- AOS CSS -->

    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Inter:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>

  <body
    class="bg-white text-slate-900 pb-20 md:pb-0"
    x-data="{ isBookingOpen: false, isMobileMenuOpen: false, cursorText: '', activeDate: 'today', customDate: '' }"
  >
    <div id="custom-cursor" x-ref="cursor" x-text="cursorText"></div>

    <!-- Smart Sticky Header (Foolproof Centered) -->
    <div
      x-data="{ scrolled: false, lastScroll: 0, hidden: false }"
      @scroll.window.throttle.16ms="
                const currentScroll = window.pageYOffset;
                scrolled = currentScroll > 50;
                hidden = currentScroll > lastScroll && currentScroll > 400;
                lastScroll = currentScroll;
            "
      class="fixed top-0 left-0 w-full h-0 z-[100] transition-transform duration-500"
      :class="{ '-translate-y-[150%]': hidden, 'translate-y-0': !hidden }"
    >
      <!-- Scrolled Floating Pill -->
      <div
        class="absolute top-6 left-1/2 -translate-x-1/2 transition-all duration-500 ease-out flex justify-between md:justify-center items-center gap-6 bg-white/90 backdrop-blur-md shadow-[0_20px_40px_rgba(0,0,0,0.1)] border border-white/60 rounded-full py-3 px-6 w-[90%] md:w-max"
        :class="scrolled ? 'opacity-100 translate-y-0 pointer-events-auto' : 'opacity-0 -translate-y-10 pointer-events-none'"
      >
        <div class="bg-white rounded-full p-1 shadow-sm shrink-0">
          <img
            src="assets/img/logo aquaboom.jpg"
            alt="Aquaboom Logo"
            class="h-10 w-auto rounded-full cursor-pointer"
          />
        </div>
        <nav
          class="hidden md:flex items-center gap-10 font-outfit font-bold text-sm text-slate-800 px-4"
        >
          <a href="#tentang-kami" class="hover:text-pink-500 transition-colors"
            >Tentang</a
          >
          <a href="#wahana" class="hover:text-cyan-500 transition-colors"
            >Wahana</a
          >
          <a href="#fasilitas" class="hover:text-pink-500 transition-colors"
            >Keunggulan</a
          >
          <a href="#lokasi" class="hover:text-blue-500 transition-colors"
            >Lokasi</a
          >
        </nav>
        <button
          @click="isBookingOpen = true"
          @mouseenter="cursorText='Pesan!'"
          @mouseleave="cursorText=''"
          class="hidden md:block bg-pink-500 text-white hover:bg-pink-600 px-6 py-2.5 rounded-full font-bold shadow-lg transition-all text-sm tracking-wide font-outfit shrink-0"
        >
          Beli Tiket
        </button>
        <button
          @click="isMobileMenuOpen = true"
          class="md:hidden p-2 rounded-full bg-slate-100 text-slate-700 hover:bg-slate-200 transition-colors"
        >
          <svg
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            ></path>
          </svg>
        </button>
      </div>

      <!-- Unscrolled Full Header -->
      <header
        class="absolute top-0 left-0 w-full flex justify-between items-center py-6 px-6 transition-all duration-500"
        :class="!scrolled ? 'opacity-100 translate-y-0 pointer-events-auto' : 'opacity-0 -translate-y-10 pointer-events-none'"
      >
        <div
          class="bg-white/40 backdrop-blur-md p-1.5 rounded-full border border-white/40 shadow-sm flex items-center justify-center shrink-0"
        >
          <img
            src="assets/img/logo aquaboom.jpg"
            alt="Aquaboom Logo"
            class="h-10 md:h-12 w-auto rounded-full cursor-pointer bg-white"
          />
        </div>
        <nav
          class="hidden md:flex items-center gap-10 font-outfit font-bold text-sm text-white drop-shadow-md"
        >
          <a href="#tentang-kami" class="hover:text-pink-300 transition-colors"
            >Tentang</a
          >
          <a href="#wahana" class="hover:text-cyan-300 transition-colors"
            >Wahana</a
          >
          <a href="#fasilitas" class="hover:text-pink-300 transition-colors"
            >Keunggulan</a
          >
          <a href="#lokasi" class="hover:text-blue-300 transition-colors"
            >Lokasi</a
          >
        </nav>
        <button
          @click="isBookingOpen = true"
          @mouseenter="cursorText='Pesan!'"
          @mouseleave="cursorText=''"
          class="hidden md:block bg-pink-500 text-white hover:bg-pink-600 px-6 py-2.5 rounded-full font-bold shadow-lg transition-all text-sm tracking-wide font-outfit shrink-0"
        >
          Beli Tiket
        </button>
        <button
          @click="isMobileMenuOpen = true"
          class="md:hidden p-2 rounded-full bg-white/20 text-white hover:bg-white/30 backdrop-blur-sm transition-colors"
        >
          <svg
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            ></path>
          </svg>
        </button>
      </header>
    </div>

    <!-- Mobile Full-Screen Blur Menu -->
    <div
      x-show="isMobileMenuOpen"
      style="display: none"
      class="fixed inset-0 z-[200] md:hidden"
    >
      <div
        x-show="isMobileMenuOpen"
        x-transition.opacity.duration.400ms
        class="absolute inset-0 bg-slate-900/60 backdrop-blur-md"
      ></div>
      <div
        x-show="isMobileMenuOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-8"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-8"
        class="absolute inset-0 flex flex-col justify-center items-center p-6 text-center z-10"
      >
        <button
          @click="isMobileMenuOpen = false"
          class="absolute top-8 right-8 p-3 bg-white/10 text-white rounded-full hover:bg-white/20 transition-colors"
        >
          <svg
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            ></path>
          </svg>
        </button>

        <img
          src="assets/img/logo aquaboom.jpg"
          alt="Aquaboom Logo"
          class="h-16 w-auto rounded-full bg-white p-1 mb-12 shadow-2xl"
        />

        <nav
          class="flex flex-col gap-8 font-outfit font-black text-3xl text-white"
        >
          <a
            href="#tentang-kami"
            @click="isMobileMenuOpen = false"
            class="hover:text-pink-400 transition-colors"
            >Tentang</a
          >
          <a
            href="#wahana"
            @click="isMobileMenuOpen = false"
            class="hover:text-cyan-400 transition-colors"
            >Wahana</a
          >
          <a
            href="#fasilitas"
            @click="isMobileMenuOpen = false"
            class="hover:text-pink-400 transition-colors"
            >Keunggulan</a
          >
          <a
            href="#lokasi"
            @click="isMobileMenuOpen = false"
            class="hover:text-blue-400 transition-colors"
            >Lokasi</a
          >
        </nav>

        <div class="mt-16 w-full max-w-xs">
          <button
            @click="isMobileMenuOpen = false; setTimeout(() => isBookingOpen = true, 300)"
            class="w-full bg-gradient-to-r from-pink-500 to-rose-500 text-white px-8 py-4 rounded-full font-black text-xl shadow-[0_10px_30px_rgba(236,72,153,0.4)]"
          >
            Beli Tiket Sekarang
          </button>
        </div>
      </div>
    </div>

    <!-- Global Standard Hero Section (Deep Blue, Immersive) -->
    <!-- Removed overflow-hidden so the wave can spill out to the next section -->
    <section
      class="relative h-[95vh] flex items-center justify-center bg-gradient-to-b from-[#0F172A] via-[#1E3A8A] to-[#2563EB] z-40"
    >
      <!-- Photographic Overlay for Texture (Isolated overflow-hidden to prevent bg spill) -->
      <div class="absolute inset-0 z-0 overflow-hidden">
        <div
          class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1582650570395-58079ba5fa63?w=800&q=60"
        ></div>
        <!-- Additional gradient to make text pop -->
        <div
          class="absolute inset-0 bg-gradient-to-t from-[#2563EB] via-transparent to-transparent opacity-80"
        ></div>
      </div>

      <div
        class="relative z-20 text-center px-4 max-w-5xl mx-auto mt-10 flex flex-col items-center"
      >
        <h1
          class="text-6xl md:text-[7rem] font-black text-white tracking-tight mb-6 leading-[1.1] font-outfit"
        >
          Splash into <br class="md:hidden" />
          <span
            class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-500"
            >Happiness.</span
          >
        </h1>
        <p
          class="text-lg md:text-2xl text-blue-100 font-medium mb-12 max-w-2xl mx-auto leading-relaxed"
        >
          Destinasi wisata air keluarga di jantung kota, menghadirkan sensasi
          ekstrem hingga kolam relaksasi.
        </p>

        <div class="flex flex-col items-center">
          <button
            @click="isBookingOpen = true"
            @mouseenter="cursorText='Seru!'"
            @mouseleave="cursorText=''"
            class="magnetic bg-pink-500 hover:bg-pink-400 text-white px-10 py-4 md:px-12 md:py-5 rounded-full font-bold text-lg md:text-xl shadow-[0_15px_40px_rgba(236,72,153,0.5)] tracking-wide transition-all transform hover:scale-105 font-outfit"
            data-magnetic-strength="35"
          >
            Mulai Petualangan Air
          </button>
          <!-- Glassmorphism Promo Widget -->
          <div
            class="mt-10 flex flex-col sm:flex-row items-center gap-5 bg-white/10 backdrop-blur-md border border-white/20 px-6 py-4 rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.15)] transform hover:-translate-y-1 hover:bg-white/15 transition-all duration-300 group cursor-pointer"
            @click="isBookingOpen = true"
          >
            <div
              x-data="countdownTimer()"
              x-init="startTimer()"
              class="flex flex-col items-center sm:border-r border-white/20 sm:pr-5"
            >
              <span
                class="text-[10px] uppercase tracking-[0.2em] text-cyan-300 font-black mb-1.5 group-hover:text-cyan-200 transition-colors font-outfit"
                >🔥 Promo Berakhir</span
              >
              <div class="flex gap-1.5 text-white font-mono font-bold text-lg">
                <div
                  class="bg-slate-900/40 rounded-lg px-2.5 py-1 shadow-inner border border-white/10 tabular-nums"
                  x-text="hours"
                ></div>
                <span class="opacity-50 pt-1">:</span>
                <div
                  class="bg-slate-900/40 rounded-lg px-2.5 py-1 shadow-inner border border-white/10 tabular-nums"
                  x-text="minutes"
                ></div>
                <span class="opacity-50 pt-1">:</span>
                <div
                  class="bg-slate-900/40 rounded-lg px-2.5 py-1 shadow-inner border border-white/10 tabular-nums"
                  x-text="seconds"
                ></div>
              </div>
            </div>
            <div
              class="flex flex-col sm:pl-2 text-center sm:text-left"
              @mouseenter="cursorText='Jangan terlewat!'"
              @mouseleave="cursorText=''"
            >
              <span
                class="text-white/80 text-xs font-bold uppercase tracking-wider mb-0.5"
                >Tiket Masuk Flash Sale</span
              >
              <div
                class="flex items-baseline gap-2 justify-center sm:justify-start"
              >
                <s class="opacity-60 text-sm font-normal text-white"
                  >Rp 200.000</s
                >
                <span
                  class="text-yellow-400 font-black text-3xl tracking-tighter font-outfit"
                  >Rp 150.000</span
                >
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="wave-container pointer-events-none">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 2400 120"
          preserveAspectRatio="none"
        >
          <!-- Back Layer (Abstract, Frothy, Out of Phase) -->
          <path
            class="wave-back"
            d="M0,0 V40 C 100,80 300,10 500,50 S 800,100 900,30 S 1100,0 1200,40 C 1300,80 1500,10 1700,50 S 2000,100 2100,30 S 2300,0 2400,40 V0 Z"
          ></path>
          <!-- Front Layer (Abstract, Solid Blue matching Hero bg) -->
          <path
            class="wave-front"
            d="M0,0 V50 C 150,90 250,20 400,60 S 650,110 800,40 S 1050,10 1200,50 C 1350,90 1450,20 1600,60 S 1850,110 2000,40 S 2250,10 2400,50 V0 Z"
          ></path>
        </svg>
      </div>
    </section>

    <!-- Cinematic Typography Reveal (About) -->
    <section
      id="tentang-kami"
      class="relative min-h-[80vh] bg-white z-30 flex items-center justify-center overflow-hidden py-32"
    >
      <div class="max-w-5xl mx-auto px-6 text-center relative z-10">
        <!-- AOS replaces Alpine for smoother, less buggy scroll interactions -->
        <h2
          class="text-5xl md:text-6xl lg:text-[5.5rem] font-black tracking-tighter leading-[1.1] text-slate-900"
          style="perspective: 1000px"
        >
          <span class="block mb-2 reveal-text delay-100">Eksplorasi</span>
          <span class="block mb-2 reveal-text delay-200">
            <span class="wave-wrapper">
              <span class="wave-bg-text block">Nirwana Air</span>
              <span class="wave-fill-text block" aria-hidden="true"
                >Nirwana Air</span
              >
            </span>
          </span>
          <span class="block reveal-text delay-300">Tropis Terbaik</span>
        </h2>
        <p
          class="mt-12 text-lg md:text-xl text-slate-500 font-medium max-w-2xl mx-auto leading-relaxed"
        >
          Dirancang khusus untuk menciptakan harmoni sempurna antara keseruan
          wahana ekstrem dan kenyamanan bersantai elegan bersama keluarga Anda
          di jantung kota Balikpapan.
        </p>
      </div>

      <!-- Subtle floating background elements -->
      <div class="absolute inset-0 pointer-events-none opacity-20">
        <div
          class="absolute top-1/4 left-10 w-64 h-64 bg-cyan-200 rounded-full filter blur-2xl opacity-50 will-change-transform"
        ></div>
        <div
          class="absolute top-1/3 right-10 w-72 h-72 bg-pink-200 rounded-full filter blur-2xl opacity-50 will-change-transform animation-delay-2000"
        ></div>
        <div
          class="absolute -bottom-8 left-1/2 w-80 h-80 bg-blue-200 rounded-full filter blur-2xl opacity-50 will-change-transform animation-delay-4000"
        ></div>
      </div>
    </section>

    <!-- Wahana: Cinematic Horizontal Scrollytelling -->
    <section
      id="wahana"
      class="pt-24 pb-32 bg-slate-50 relative z-40 overflow-hidden"
    >
      <div class="max-w-7xl mx-auto px-6 relative z-50">
        <div class="text-center mb-16">
          <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-4">
            Wahana <span class="text-cyan-500">Favorit</span>
          </h2>
          <p class="text-slate-500 text-lg">Pilih tingkat adrenalin Anda.</p>
        </div>

        <div
          class="flex flex-row md:grid md:grid-cols-3 gap-6 md:gap-8 overflow-x-auto snap-x snap-mandatory scrollbar-hide pb-8 -mx-6 px-6 md:mx-0 md:px-0"
        >
          @foreach($wahanas as $index => $wahana)
          @php
              // Colors for the line above the title (cyan, blue, orange, etc based on index)
              $colors = ['bg-cyan-400', 'bg-blue-400', 'bg-orange-400', 'bg-pink-400', 'bg-purple-400'];
              $color = $colors[$index % count($colors)];
          @endphp
          <div
            class="group relative h-[450px] w-[85vw] md:w-auto shrink-0 snap-center rounded-[2.5rem] overflow-hidden cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-700"
            @mouseenter="cursorText='Cobain!'"
            @mouseleave="cursorText=''"
          >
            <img
              src="{{ $wahana->image_url }}"
              alt="{{ $wahana->name }}"
              loading="lazy"
              class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
            />
            <div
              class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-500"
            ></div>

            <div
              class="absolute bottom-0 left-0 w-full p-8 transform translate-y-12 group-hover:translate-y-0 transition-transform duration-500 ease-out"
            >
              <div class="w-12 h-1 {{ $color }} mb-4 rounded-full"></div>
              <h3 class="text-3xl font-black text-white mb-2">{{ $wahana->name }}</h3>
              <p
                class="text-slate-200 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100"
              >
                {{ $wahana->description }}
              </p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Facilities: Modern Bento Grid -->
    <!-- Keunggulan & Fasilitas: Luxury Glassmorphism -->
    <section
      id="fasilitas"
      class="py-32 bg-[#F5F5F7] relative z-40 overflow-hidden"
    >
      <!-- Sophisticated blurred orbs for glass effect -->
      <div class="absolute inset-0 pointer-events-none opacity-50">
        <div
          class="absolute top-0 left-1/4 w-[30rem] h-[30rem] bg-indigo-200/50 rounded-full blur-[60px] opacity-40 will-change-transform"
        ></div>
        <div
          class="absolute bottom-0 right-1/4 w-[30rem] h-[30rem] bg-pink-200/50 rounded-full blur-[60px] opacity-40 will-change-transform"
        ></div>
      </div>

      <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="text-center mb-16">
          <h2
            class="text-4xl md:text-6xl font-black text-slate-900 mb-6 tracking-tight font-outfit"
          >
            Tingkat
            <span
              class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-pink-500"
              >Kemewahan</span
            >
            Baru
          </h2>
          <p class="text-slate-500 text-xl font-medium max-w-2xl mx-auto">
            Dirancang untuk mereka yang menghargai estetika dan kenyamanan kelas
            atas. Keseimbangan sempurna antara desain dan fungsi.
          </p>
        </div>

        <!-- Luxury Bento Grid -->
        <div
          class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 auto-rows-auto md:auto-rows-[340px]"
        >
          <!-- Unik (Span 2 cols) -->
          <div
            @mouseenter="cursorText='Eksklusif!'"
            @mouseleave="cursorText=''"
            class="md:col-span-2 relative bg-white/60 cursor-pointer backdrop-blur-md rounded-[2.5rem] p-10 md:p-12 overflow-hidden group shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-white transition-all hover:bg-white/80"
          >
            <div class="relative z-10 h-full flex flex-col justify-center">
              <div
                class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-blue-500 rounded-2xl flex items-center justify-center text-white mb-8 shadow-lg"
              >
                <svg
                  class="w-6 h-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 8h8"
                  ></path>
                </svg>
              </div>
              <h3
                class="text-3xl md:text-5xl font-black text-slate-900 mb-4 font-outfit leading-tight tracking-tight"
              >
                Satu-satunya di<br />Gedung Bertingkat
              </h3>
              <p
                class="text-slate-500 text-lg font-medium max-w-lg leading-relaxed"
              >
                Pemandangan epik dari atas langit. Sensasi bermain air eksklusif
                yang tidak akan Anda temukan di tempat lain di Indonesia.
              </p>
            </div>
          </div>

          <!-- Mudah Diakses (Span 1 col) -->
          <div
            @mouseenter="cursorText='Mudah!'"
            @mouseleave="cursorText=''"
            class="relative bg-white/60 cursor-pointer backdrop-blur-md rounded-[2.5rem] p-10 md:p-12 overflow-hidden group shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-white transition-all hover:bg-white/80"
          >
            <div
              class="relative z-10 h-full flex flex-col justify-center md:items-center md:text-center"
            >
              <div
                class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center text-white mb-8 shadow-lg"
              >
                <svg
                  class="w-6 h-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                  ></path>
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                  ></path>
                </svg>
              </div>
              <h3
                class="text-2xl md:text-4xl font-black text-slate-900 mb-4 font-outfit leading-tight tracking-tight"
              >
                Akses<br />Premium
              </h3>
              <p class="text-slate-500 text-base font-medium leading-relaxed">
                Berada tepat di jantung kemegahan Balikpapan Super Block (BSB).
              </p>
            </div>
          </div>

          <!-- Fasilitas (Span 3 cols) -->
          <div
            @mouseenter="cursorText='Mewah!'"
            @mouseleave="cursorText=''"
            class="md:col-span-3 relative bg-gradient-to-br cursor-pointer from-slate-900 to-slate-800 rounded-[2.5rem] p-10 md:p-12 overflow-hidden group shadow-[0_20px_40px_rgba(0,0,0,0.2)] transition-all"
          >
            <!-- Glass shine effect -->
            <div
              class="absolute inset-0 bg-gradient-to-tr from-white/10 to-transparent opacity-30"
            ></div>

            <div
              class="relative z-10 h-full flex flex-col md:flex-row items-center gap-10 md:gap-16"
            >
              <div class="flex-1">
                <div
                  class="w-14 h-14 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center justify-center text-white mb-8 shadow-lg"
                >
                  <svg
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"
                    ></path>
                  </svg>
                </div>
                <h3
                  class="text-3xl md:text-5xl font-black text-white mb-4 font-outfit leading-tight tracking-tight"
                >
                  Fasilitas Bintang 4
                </h3>
                <p
                  class="text-slate-300 text-lg font-medium leading-relaxed max-w-2xl"
                >
                  Mulai dari hotel mewah, kamar bilas dan toilet sekelas VIP,
                  musholla elegan, hingga gazebo bersantai. Semua terintegrasi
                  sempurna dengan mall terbaik di Balikpapan.
                </p>
              </div>
              <div
                class="flex gap-3 md:gap-4 shrink-0 flex-wrap justify-center"
              >
                <div
                  class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-5 text-center border border-white/20 shadow-2xl"
                >
                  <span class="text-2xl md:text-3xl block mb-2 opacity-90"
                    >🛍️</span
                  >
                  <span
                    class="text-white font-bold text-xs md:text-sm tracking-wide font-outfit"
                    >Mall Access</span
                  >
                </div>
                <div
                  class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-5 text-center border border-white/20 shadow-2xl"
                >
                  <span class="text-2xl md:text-3xl block mb-2 opacity-90"
                    >🚿</span
                  >
                  <span
                    class="text-white font-bold text-xs md:text-sm tracking-wide font-outfit"
                    >VIP Rooms</span
                  >
                </div>
                <div
                  class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-5 text-center border border-white/20 shadow-2xl"
                >
                  <span class="text-2xl md:text-3xl block mb-2 opacity-90"
                    >🕌</span
                  >
                  <span
                    class="text-white font-bold text-xs md:text-sm tracking-wide font-outfit"
                    >Musholla</span
                  >
                </div>
                <div
                  class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-5 text-center border border-white/20 shadow-2xl"
                >
                  <span class="text-2xl md:text-3xl block mb-2 opacity-90"
                    >🛖</span
                  >
                  <span
                    class="text-white font-bold text-xs md:text-sm tracking-wide font-outfit"
                    >Gazebo</span
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: Momen Keseruan -->
    <section
      class="py-32 bg-white relative z-40 overflow-hidden border-t border-slate-100"
    >
      <div class="max-w-7xl mx-auto px-6 text-center mb-16 relative z-10">
        <h2 class="text-4xl font-black text-slate-900 mb-4 font-outfit">
          Momen <span class="text-pink-500">Keseruan</span>
        </h2>
        <p class="text-slate-500 text-lg">
          Ribuan tawa telah diabadikan di Aquaboom.
        </p>
      </div>

      <!-- Infinite Marquee -->
      <div
        class="marquee-container"
        @mouseenter="cursorText='Keren!'"
        @mouseleave="cursorText=''"
      >
        <div class="marquee-content gap-6 items-center px-3">
          <!-- Group 1 -->
          <img
            src="https://aquaboombsb.com/wp-content/uploads/2023/12/V1.jpg"
            loading="lazy"
            class="h-64 w-80 object-cover rounded-3xl shadow-lg border-4 border-white"
          />
          <img
            src="https://aquaboombsb.com/wp-content/uploads/2023/12/V2.jpg"
            loading="lazy"
            class="h-80 w-72 object-cover rounded-3xl shadow-lg border-4 border-white transform rotate-2"
          />
          <img
            src="https://aquaboombsb.com/wp-content/uploads/2023/12/V3.jpg"
            loading="lazy"
            class="h-64 w-80 object-cover rounded-3xl shadow-lg border-4 border-white"
          />
          <img
            src="https://aquaboombsb.com/wp-content/uploads/2023/12/Tiket.png"
            class="h-80 w-72 object-cover rounded-3xl shadow-lg border-4 border-white transform -rotate-2"
          />
          <!-- Group 2 (Duplicated for seamless loop) -->
          <img
            src="https://aquaboombsb.com/wp-content/uploads/2023/12/V1.jpg"
            loading="lazy"
            class="h-64 w-80 object-cover rounded-3xl shadow-lg border-4 border-white"
          />
          <img
            src="https://aquaboombsb.com/wp-content/uploads/2023/12/V2.jpg"
            loading="lazy"
            class="h-80 w-72 object-cover rounded-3xl shadow-lg border-4 border-white transform rotate-2"
          />
          <img
            src="https://aquaboombsb.com/wp-content/uploads/2023/12/V3.jpg"
            loading="lazy"
            class="h-64 w-80 object-cover rounded-3xl shadow-lg border-4 border-white"
          />
          <img
            src="https://aquaboombsb.com/wp-content/uploads/2023/12/Tiket.png"
            class="h-80 w-72 object-cover rounded-3xl shadow-lg border-4 border-white transform -rotate-2"
          />
        </div>
      </div>
    </section>

    <!-- Location: Immersive Full Map with Glassmorphism Card -->
    <section id="lokasi" class="relative h-[600px] flex items-center z-30">
      <!-- Full Background Map -->
      <div class="absolute inset-0 z-0 pointer-events-none">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.889379899388!2d116.86236931475458!3d-1.2364239990977227!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df146e273a242cf%3A0xc31faab37fc368ce!2sAquaboom%20Waterpark!5e0!3m2!1sid!2sid!4v1655000000000!5m2!1sid!2sid"
          width="100%"
          height="100%"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
      </div>

      <div class="max-w-7xl mx-auto px-6 w-full relative z-10 flex justify-end">
        <!-- Glassmorphism Location Card floating on the right -->
        <div
          class="bg-white/85 backdrop-blur-md p-10 rounded-[2.5rem] shadow-[0_30px_60px_rgba(0,0,0,0.2)] border border-white max-w-md w-full"
        >
          <h2 class="text-3xl font-black text-slate-900 mb-2">
            Pusat <span class="text-cyan-500">Hiburan</span>
          </h2>
          <p class="text-slate-500 text-sm mb-8 font-medium">
            Terintegrasi langsung dengan Astara Hotel di kawasan prestisius
            Balikpapan Superblock.
          </p>

          <div class="flex items-start gap-4 mb-8">
            <div
              class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center shrink-0 text-cyan-600"
            >
              <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                ></path>
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                ></path>
              </svg>
            </div>
            <div>
              <h4 class="font-bold text-slate-900 text-base">Alamat Resmi</h4>
              <p class="text-slate-500 text-xs mt-1 leading-relaxed">
                Balikpapan Superblock, Jl. Jenderal Sudirman No.Kav 47, Gn.
                Bahagia, Balikpapan Sel., Kota Balikpapan 76114
              </p>
            </div>
          </div>

          <a
            href="https://maps.app.goo.gl/example"
            target="_blank"
            @mouseenter="cursorText='Go!'"
            @mouseleave="cursorText=''"
            class="flex items-center justify-center gap-3 bg-slate-900 hover:bg-slate-800 text-white w-full py-4 rounded-xl font-bold shadow-lg transition-transform transform hover:scale-[1.02]"
          >
            Buka di Google Maps
            <svg
              class="w-4 h-4"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="3"
                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
              ></path>
            </svg>
          </a>
        </div>
      </div>
    </section>

    <!-- Footer (Luxury Trust Badge) -->
    <footer
      class="bg-slate-900 text-slate-300 relative pt-24 pb-12 mt-0 z-40 border-t border-slate-800"
    >
      <div
        class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-12 gap-12 relative z-20"
      >
        <!-- Brand & Trust Badge -->
        <div class="col-span-1 md:col-span-5">
          <img
            src="assets/img/logo aquaboom.jpg"
            alt="Aquaboom"
            class="h-16 rounded-2xl mb-6 bg-white p-2 shadow-lg w-max"
          />
          <p
            class="text-sm leading-relaxed max-w-sm mb-8 text-slate-400 font-medium"
          >
            Destinasi hiburan air keluarga premium di pusat kota. Nikmati
            sensasi ekstrem hingga kolam relaksasi dengan standar pelayanan
            bintang 4.
          </p>

          <!-- The Trust Badge -->
          <div
            class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 w-max backdrop-blur-md"
          >
            <img
              src="https://jatrahotels.com/logo/JHR-White.png"
              alt="Jatra Hotels & Resorts"
              class="h-10 w-auto opacity-90"
            />
            <div class="h-8 w-px bg-white/20"></div>
            <div class="flex flex-col">
              <span
                class="text-[10px] uppercase tracking-widest text-slate-500 font-bold mb-0.5"
                >Managed By</span
              >
              <span class="text-sm font-baskerville text-white tracking-wide"
                >Jatra Hotels & Resorts</span
              >
            </div>
          </div>
        </div>

        <!-- Links -->
        <div class="col-span-1 md:col-span-3 md:col-start-7">
          <h4
            class="text-white font-black mb-6 uppercase tracking-wider text-sm font-outfit"
          >
            Informasi
          </h4>
          <ul class="space-y-4 text-sm font-medium text-slate-400">
            <li>
              <a
                href="#"
                class="hover:text-pink-400 transition-colors flex items-center gap-2"
                ><span class="w-1.5 h-1.5 rounded-full bg-pink-500"></span> Cara
                Pembelian</a
              >
            </li>
            <li>
              <a
                href="#"
                class="hover:text-cyan-400 transition-colors flex items-center gap-2"
                ><span class="w-1.5 h-1.5 rounded-full bg-cyan-500"></span>
                Peraturan Wahana</a
              >
            </li>
            <li>
              <a
                href="#"
                class="hover:text-orange-400 transition-colors flex items-center gap-2"
                ><span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                Syarat & Ketentuan</a
              >
            </li>
          </ul>
        </div>

        <!-- Contact -->
        <div class="col-span-1 md:col-span-3">
          <h4
            class="text-white font-black mb-6 uppercase tracking-wider text-sm font-outfit"
          >
            Hubungi Kami
          </h4>
          <ul class="space-y-4 text-sm font-medium text-slate-400">
            <li class="flex items-center gap-3">
              <div
                class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white"
              >
                <svg
                  class="w-4 h-4"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                  ></path>
                </svg>
              </div>
              +62 811 1234 567
            </li>
            <li class="flex items-center gap-3">
              <div
                class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white"
              >
                <svg
                  class="w-4 h-4"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                  ></path>
                </svg>
              </div>
              hello@aquaboom.id
            </li>
          </ul>
        </div>
      </div>

      <div
        class="max-w-7xl mx-auto px-6 mt-16 pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4"
      >
        <p class="text-xs text-slate-500 font-medium tracking-wide">
          &copy; 2026 Aquaboom Waterpark Balikpapan. All rights reserved.
        </p>
        <div class="flex gap-4">
          <a href="#" class="text-slate-500 hover:text-white transition-colors"
            ><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"
              /></svg
          ></a>
          <a href="#" class="text-slate-500 hover:text-white transition-colors"
            ><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"
              /></svg
          ></a>
        </div>
      </div>
    </footer>

    <!-- Sticky Mobile Booking Bar (Conversion Focused) -->
    <div
      class="fixed bottom-0 left-0 w-full bg-white border-t border-slate-200 p-4 px-6 shadow-[0_-10px_20px_rgba(0,0,0,0.05)] z-[90] flex justify-between items-center md:hidden"
    >
      <div>
        <p class="text-xs text-slate-500 font-bold uppercase">Mulai Dari</p>
        <p class="text-lg font-black text-slate-900">Rp 150.000</p>
      </div>
      <button
        @click="isBookingOpen = true"
        @mouseenter="cursorText='Pesan!'"
        @mouseleave="cursorText=''"
        class="bg-pink-500 text-white hover:bg-pink-600 px-6 py-2.5 rounded-full font-bold shadow-lg transition-all text-sm tracking-wide font-outfit shrink-0"
      >
        Beli Tiket
      </button>
    </div>

    <!-- Live Social Proof Toast -->
    <div
      x-data="socialProof()"
      x-init="startPopups()"
      class="fixed bottom-24 md:bottom-10 left-6 z-[95] pointer-events-none"
    >
      <div
        x-show="show"
        x-transition:enter="toast-enter"
        x-transition:enter-start="toast-enter-start"
        x-transition:enter-end="toast-enter-end"
        x-transition:leave="toast-leave"
        x-transition:leave-start="toast-leave-start"
        x-transition:leave-end="toast-leave-end"
        class="bg-white/95 backdrop-blur-md border border-slate-100 shadow-[0_15px_40px_rgba(0,0,0,0.15)] rounded-2xl p-4 flex items-center gap-4 max-w-[320px] pointer-events-auto cursor-pointer"
        style="display: none"
        @click="isBookingOpen = true"
      >
        <div
          class="w-12 h-12 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-full flex items-center justify-center shrink-0 shadow-inner"
        >
          <svg
            class="w-6 h-6 text-white"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
            ></path>
          </svg>
        </div>
        <div>
          <p class="text-xs text-slate-500 font-bold mb-0.5">
            Baru saja membeli tiket
          </p>
          <p
            class="text-[13px] text-slate-800 leading-tight font-medium"
            x-html="message"
          ></p>
          <p
            class="text-[10px] text-cyan-600 font-bold mt-1.5 flex items-center"
          >
            Verifikasi API Nyata
            <span
              class="inline-block w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse ml-1.5"
            ></span>
          </p>
        </div>
      </div>
    </div>

    <!-- Gamified Elastic Booking Panel (Slide-over Drawer) -->
    <div
      x-show="isBookingOpen"
      class="fixed inset-0 z-[100] overflow-hidden"
      style="display: none"
    >
      <div
        x-show="isBookingOpen"
        x-transition.opacity.duration.400ms
        class="absolute inset-0 bg-slate-900/60 backdrop-blur-md"
        @click="isBookingOpen = false"
      ></div>

      <div
        x-show="isBookingOpen"
        x-transition:enter="drawer-enter"
        x-transition:enter-start="translate-y-full md:translate-x-full md:translate-y-0"
        x-transition:enter-end="translate-y-0 md:translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="translate-y-0 md:translate-x-0"
        x-transition:leave-end="translate-y-full md:translate-x-full md:translate-y-0"
        class="absolute inset-x-0 bottom-0 top-auto h-[90vh] md:top-0 md:bottom-0 md:h-auto md:inset-y-0 md:right-0 md:left-auto md:max-w-md w-full bg-slate-50 shadow-[0_0_80px_rgba(0,0,0,0.5)] flex flex-col transform-gpu rounded-t-3xl md:rounded-none"
      >
        <!-- Interactive Feedback Area -->
        <div
          class="absolute inset-0 pointer-events-none z-50 flex items-center justify-center"
        >
          <template x-if="activeDate">
            <div
              class="w-24 h-24 bg-pink-500 rounded-full flex items-center justify-center text-white shadow-2xl animate-ping opacity-70"
            ></div>
          </template>
        </div>

        <!-- Mobile Drag Handle -->
        <div
          class="w-full flex justify-center pt-3 pb-1 bg-white md:hidden rounded-t-3xl md:rounded-none"
        >
          <div class="w-12 h-1.5 bg-slate-200 rounded-full"></div>
        </div>
        <div
          class="px-7 pb-5 pt-3 md:pt-7 border-b border-slate-200 flex justify-between items-center bg-white relative z-10"
        >
          <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">
            Pesan Tiket Instan
          </h2>
          <button
            @click="isBookingOpen = false"
            @mouseenter="cursorText='Tutup'"
            @mouseleave="cursorText=''"
            class="text-slate-400 hover:text-pink-500 transition bg-slate-100 p-2.5 rounded-full hover:bg-pink-50"
          >
            <svg
              class="w-6 h-6"
              fill="none"
              stroke="currentColor"
              stroke-width="2.5"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12"
              ></path>
            </svg>
          </button>
        </div>

        <!-- LIVEWIRE CHECKOUT COMPONENT -->
        @livewire('checkout')

      </div>
    </div>

    <!-- AOS JS for Scroll Animations -->

    <script defer src="assets/js/main.js"></script>
  </body>
</html>
