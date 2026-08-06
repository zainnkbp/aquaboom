<!doctype html>
<html lang="id" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $title ?? 'Aquaboom Waterpark' }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap"
    rel="stylesheet">
  <style>
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: 'Outfit', sans-serif;
      letter-spacing: -0.02em;
    }

    .serif-baskerville {
      font-family: 'Libre Baskerville', serif;
    }

    /* Scrolled navbar */
    .glass-nav-wb {
      background: rgba(22, 15, 48, 0.9);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
    }

    /* Gold separator line */
    .gold-line::after {
      content: '';
      display: block;
      width: 48px;
      height: 3px;
      background: #C9A84C;
      margin-top: 12px;
      border-radius: 2px;
    }
  </style>
</head>

<body
  class="bg-aqua-cream text-aqua-navy antialiased min-h-screen flex flex-col selection:bg-aqua-gold selection:text-aqua-navy"
  x-data="{ isMobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)">

  <!-- ============================================================ -->
  <!-- NAVBAR — Midnight Navy with Champagne Gold accents           -->
  <!-- ============================================================ -->
  <nav :class="{'glass-nav-wb shadow-xl border-b border-aqua-gold/20': scrolled, 'bg-aqua-navy': !scrolled}"
    class="fixed w-full z-50 transition-all duration-300">

    <!-- Top Utility Bar (Desktop Only) - Hides on scroll -->
    <div :class="scrolled ? 'h-0 opacity-0 overflow-hidden py-0 border-none' : 'border-b border-white/10 py-2'"
      class="hidden lg:block transition-all duration-300">
      <div class="max-w-7xl mx-auto px-6 lg:px-10 flex justify-end items-center gap-4 text-[10px]">
        <span class="text-white/40 font-semibold mr-auto tracking-wider uppercase">Aquaboom Waterpark Balikpapan</span>

        <!-- Language Switcher (Compact utility style) -->
        <div class="flex items-center bg-white/5 rounded-full p-0.5 border border-white/10 shrink-0">
          <a href="{{ route('lang.switch', ['locale' => 'id']) }}"
            class="px-3 py-0.5 font-black rounded-full uppercase tracking-wider transition-all
              {{ App::getLocale() === 'id' ? 'bg-aqua-gold text-aqua-navy shadow-sm' : 'text-white/50 hover:text-white' }}">
            ID
          </a>
          <a href="{{ route('lang.switch', ['locale' => 'en']) }}"
            class="px-3 py-0.5 font-black rounded-full uppercase tracking-wider transition-all
              {{ App::getLocale() === 'en' ? 'bg-aqua-gold text-aqua-navy shadow-sm' : 'text-white/50 hover:text-white' }}">
            EN
          </a>
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      <div class="flex justify-between items-center h-20">

        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center">
          <a href="{{ url('/') }}"
            class="bg-white/95 hover:bg-white px-3.5 py-2 rounded-2xl shadow-md transition-all duration-300 flex items-center justify-center shrink-0">
            <img src="{{ asset('assets/img/logo-aquaboom.png') }}" alt="Aquaboom" class="h-9 w-auto object-contain">
          </a>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden lg:flex space-x-8 items-center text-white/90">

          <!-- Explore Dropdown -->
          <div class="relative group">
            <button
              class="flex items-center gap-1.5 text-sm font-bold tracking-wide transition-colors hover:text-aqua-gold uppercase">
              Explore
              <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:rotate-180 text-aqua-gold/70"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div
              class="absolute left-1/2 -translate-x-1/2 mt-5 w-60 bg-white rounded-2xl shadow-2xl shadow-aqua-navy/20 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 p-3 border border-slate-100 transform translate-y-2 group-hover:translate-y-0">
              <a href="{{ url('/explore') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-700 hover:bg-aqua-cream hover:text-aqua-navy rounded-xl transition-colors">
                <div class="w-8 h-8 bg-aqua-azure/10 rounded-lg flex items-center justify-center shrink-0">
                  <svg class="w-4 h-4 text-aqua-azure" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 10V3L4 14h7v7l9-11h-7z" />
                  </svg>
                </div>
                Rides & Attractions
              </a>
              <a href="{{ url('/facilities') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-700 hover:bg-aqua-cream hover:text-aqua-navy rounded-xl transition-colors">
                <div class="w-8 h-8 bg-aqua-navy/10 rounded-lg flex items-center justify-center shrink-0">
                  <svg class="w-4 h-4 text-aqua-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                  </svg>
                </div>
                Premium Facilities
              </a>
              <a href="{{ url('/dining') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-700 hover:bg-aqua-cream hover:text-aqua-navy rounded-xl transition-colors">
                <div class="w-8 h-8 bg-amber-500/10 rounded-lg flex items-center justify-center shrink-0">
                  <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M14 12a2 2 0 11-4 0 2 2 0 014 0z" />
                  </svg>
                </div>
                Dining & Culinary
              </a>
            </div>
          </div>

          <!-- Tickets Dropdown -->
          <div class="relative group">
            <button
              class="flex items-center gap-1.5 text-sm font-bold tracking-wide transition-colors hover:text-aqua-gold uppercase">
              Tickets & Pricing
              <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:rotate-180 text-aqua-gold/70"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div
              class="absolute left-1/2 -translate-x-1/2 mt-5 w-60 bg-white rounded-2xl shadow-2xl shadow-aqua-navy/20 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 p-3 border border-slate-100 transform translate-y-2 group-hover:translate-y-0">
              <a href="{{ url('/ticket') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-700 hover:bg-aqua-cream hover:text-aqua-navy rounded-xl transition-colors">
                <div class="w-8 h-8 bg-aqua-azure/10 rounded-lg flex items-center justify-center shrink-0">
                  <svg class="w-4 h-4 text-aqua-azure" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                  </svg>
                </div>
                Tickets & Pricing
              </a>
              <a href="{{ url('/packages') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-700 hover:bg-aqua-cream hover:text-aqua-navy rounded-xl transition-colors">
                <div class="w-8 h-8 bg-aqua-gold/10 rounded-lg flex items-center justify-center shrink-0">
                  <svg class="w-4 h-4 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                  </svg>
                </div>
                Special Packages
              </a>
            </div>
          </div>

          <!-- About Us Dropdown -->
          <div class="relative group">
            <button
              class="flex items-center gap-1.5 text-sm font-bold tracking-wide transition-colors hover:text-aqua-gold uppercase">
              About Us
              <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:rotate-180 text-aqua-gold/70"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <div
              class="absolute left-1/2 -translate-x-1/2 mt-5 w-60 bg-white rounded-2xl shadow-2xl shadow-aqua-navy/20 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 p-3 border border-slate-100 transform translate-y-2 group-hover:translate-y-0">
              <a href="{{ url('/about') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-700 hover:bg-aqua-cream hover:text-aqua-navy rounded-xl transition-colors">
                Company Profile
              </a>
              <a href="{{ url('/about') }}#awards"
                class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-700 hover:bg-aqua-cream hover:text-aqua-navy rounded-xl transition-colors">
                Awards & Achievements
              </a>
              <a href="{{ url('/faq') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-700 hover:bg-aqua-cream hover:text-aqua-navy rounded-xl transition-colors">
                FAQ (Tanya Jawab)
              </a>
              <a href="{{ url('/about') }}#career"
                class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-700 hover:bg-aqua-cream hover:text-aqua-navy rounded-xl transition-colors">
                Careers
              </a>
            </div>
          </div>
        </div>

        <!-- Desktop Actions (Far Right) -->
        <div class="hidden lg:flex items-center gap-4">
          @auth
            <!-- Logged In User Dropdown -->
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
              <button @click="open = !open"
                class="flex items-center gap-2 border border-aqua-gold/30 bg-white/5 hover:bg-white/10 px-5 py-2.5 rounded-full text-xs font-bold text-white hover:text-aqua-gold transition-all duration-300 uppercase">
                <svg class="w-4 h-4 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Hi, {{ Str::words(Auth::user()->name, 1, '') }}</span>
                <svg class="w-3.5 h-3.5 text-aqua-gold/70 transition-transform duration-300" :class="{'rotate-180': open}"
                  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div x-show="open" style="display: none;"
                class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl z-50 p-2 border border-slate-100 py-2">
                <a href="{{ route('my.tickets') }}"
                  class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold text-slate-700 hover:bg-aqua-cream hover:text-aqua-navy rounded-xl transition-colors uppercase">
                  <svg class="w-4 h-4 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                  </svg>
                  My Tickets
                </a>
                <a href="{{ route('logout') }}"
                  class="flex items-center gap-2 px-4 py-2.5 text-xs font-bold text-red-600 hover:bg-red-50 rounded-lg transition-colors uppercase">
                  <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                  </svg>
                  Logout
                </a>
              </div>
            </div>
          @else
            <!-- Loyalty & Login Button -->
            <a href="{{ route('login') }}"
              class="flex items-center gap-2 border border-white/20 bg-white/5 hover:bg-white/10 hover:border-aqua-gold/50 px-5 py-2.5 rounded-full text-xs font-bold text-white hover:text-aqua-gold transition-all duration-300 uppercase shrink-0">
              <svg class="w-4 h-4 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              Login
            </a>
          @endauth

          <!-- Gold CTA Button -->
          <a href="{{ url('/ticket') }}"
            class="bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy px-6 py-3 rounded-full text-sm font-black tracking-wide transform hover:scale-105 transition-all duration-300 shadow-lg shadow-amber-900/20 uppercase whitespace-nowrap">
            BUY TICKETS NOW !
          </a>
        </div>

        <!-- Mobile menu button -->
        <div class="flex lg:hidden items-center">
          <button @click="isMobileMenuOpen = !isMobileMenuOpen"
            class="p-3 transition-colors rounded-full text-white bg-aqua-navy-2 hover:bg-aqua-gold hover:text-aqua-navy shadow-sm border border-aqua-gold/20">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu (Side Drawer) -->
    <div x-show="isMobileMenuOpen" style="display: none;" class="fixed inset-0 z-[100] flex">
      <!-- Backdrop -->
      <div x-show="isMobileMenuOpen" x-transition.opacity.duration.300ms @click="isMobileMenuOpen = false"
        class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

      <!-- Drawer -->
      <div x-show="isMobileMenuOpen" x-transition:enter="transition-transform ease-out duration-300"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-transform ease-in duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="relative w-[85%] max-w-sm bg-aqua-navy h-full shadow-2xl flex flex-col z-10 overflow-hidden border-r border-aqua-gold/20">

        <!-- Drawer Header -->
        <div class="p-8 flex justify-between items-center relative z-20 border-b border-aqua-gold/20">
          <a href="{{ url('/') }}"
            class="bg-white/95 hover:bg-white px-3 py-1.5 rounded-xl shadow-md transition-all duration-300 flex items-center justify-center shrink-0">
            <img src="{{ asset('assets/img/logo-aquaboom.png') }}" alt="Aquaboom" class="h-7 w-auto object-contain">
          </a>
          <button @click="isMobileMenuOpen = false"
            class="text-white/80 hover:text-aqua-gold transition-colors bg-aqua-navy-2 p-3 rounded-full border border-aqua-gold/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <div class="overflow-y-auto flex-1 py-6">
          <div class="px-6 flex flex-col gap-3">

            <!-- Mobile Explore Accordion -->
            <div x-data="{ open: false }" class="bg-aqua-navy-2/80 rounded-2xl p-4 border border-aqua-gold/10">
              <button @click="open = !open"
                class="w-full flex justify-between items-center text-base font-bold text-white uppercase tracking-wide">
                Explore
                <svg class="w-4 h-4 text-aqua-gold transition-transform duration-300" :class="{'rotate-180': open}"
                  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div x-show="open" x-collapse class="mt-3 pl-2 border-l-2 border-aqua-gold/30">
                <div class="flex flex-col gap-1">
                  <a href="{{ url('/explore') }}"
                    class="text-white/80 font-bold hover:text-aqua-gold p-3 rounded-xl transition-all text-sm">Rides &
                    Attractions</a>
                  <a href="{{ url('/dining') }}"
                    class="text-white/80 font-bold hover:text-aqua-gold p-3 rounded-xl transition-all text-sm">Eat &
                    Drink</a>
                  <a href="{{ url('/facilities') }}"
                    class="text-white/80 font-bold hover:text-aqua-gold p-3 rounded-xl transition-all text-sm">Premium
                    Facilities</a>
                </div>
              </div>
            </div>

            <!-- Mobile Tickets Accordion -->
            <div x-data="{ open: false }" class="bg-aqua-navy-2/80 rounded-2xl p-4 border border-aqua-gold/10">
              <button @click="open = !open"
                class="w-full flex justify-between items-center text-base font-bold text-white uppercase tracking-wide">
                Tickets & Pricing
                <svg class="w-4 h-4 text-aqua-gold transition-transform duration-300" :class="{'rotate-180': open}"
                  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div x-show="open" x-collapse class="mt-3 pl-2 border-l-2 border-aqua-gold/30">
                <div class="flex flex-col gap-1">
                  <a href="{{ url('/ticket') }}"
                    class="text-white/80 font-bold hover:text-aqua-gold p-3 rounded-xl transition-all text-sm">Tickets &
                    Pricing</a>
                  <a href="{{ url('/packages') }}"
                    class="text-white/80 font-bold hover:text-aqua-gold p-3 rounded-xl transition-all text-sm">Special
                    Packages</a>
                </div>
              </div>
            </div>

            <!-- Mobile About Us Accordion -->
            <div x-data="{ open: false }" class="bg-aqua-navy-2/80 rounded-2xl p-4 border border-aqua-gold/10">
              <button @click="open = !open"
                class="w-full flex justify-between items-center text-base font-bold text-white uppercase tracking-wide">
                About Us
                <svg class="w-4 h-4 text-aqua-gold transition-transform duration-300" :class="{'rotate-180': open}"
                  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg>
              </button>
              <div x-show="open" x-collapse class="mt-3 pl-2 border-l-2 border-aqua-gold/30">
                <div class="flex flex-col gap-1">
                  <a href="{{ url('/about') }}"
                    class="text-white/80 font-bold hover:text-aqua-gold p-3 rounded-xl transition-all text-sm">Company
                    Profile</a>
                  <a href="{{ url('/about') }}#awards"
                    class="text-white/80 font-bold hover:text-aqua-gold p-3 rounded-xl transition-all text-sm">Awards</a>
                  <a href="{{ url('/faq') }}"
                    class="text-white/80 font-bold hover:text-aqua-gold p-3 rounded-xl transition-all text-sm">FAQ
                    (Tanya Jawab)</a>
                  <a href="{{ url('/about') }}#career"
                    class="text-white/80 font-bold hover:text-aqua-gold p-3 rounded-xl transition-all text-sm">Career</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Mobile CTA -->
        <div class="p-6 bg-aqua-navy-3 border-t border-aqua-gold/20 relative z-20 flex flex-col gap-3">
          @auth
            <a href="{{ route('my.tickets') }}"
              class="block w-full text-center bg-white/10 border border-white/20 text-white hover:border-aqua-gold/50 px-6 py-3 rounded-full font-black text-sm uppercase tracking-wide transition-all">
              My Tickets
            </a>
            <a href="{{ route('logout') }}"
              class="block w-full text-center bg-red-950/20 border border-red-500/30 text-red-400 hover:bg-red-950/40 px-6 py-3 rounded-full font-bold text-sm uppercase tracking-wide transition-all">
              Logout
            </a>
          @else
            <a href="{{ route('login') }}"
              class="block w-full text-center bg-white/10 border border-white/20 text-white hover:border-aqua-gold/50 px-6 py-3 rounded-full font-black text-sm uppercase tracking-wide transition-all">
              Login
            </a>
          @endauth

          <!-- Mobile Language Switcher -->
          <div class="flex justify-center items-center bg-white/10 rounded-full p-1 border border-white/20 self-center">
            <a href="{{ route('lang.switch', ['locale' => 'id']) }}"
              class="px-5 py-2 text-xs font-black rounded-full uppercase tracking-wider transition-all
                {{ App::getLocale() === 'id' ? 'bg-aqua-gold text-aqua-navy shadow-md' : 'text-white/60 hover:text-white' }}">
              ID
            </a>
            <a href="{{ route('lang.switch', ['locale' => 'en']) }}"
              class="px-5 py-2 text-xs font-black rounded-full uppercase tracking-wider transition-all
                {{ App::getLocale() === 'en' ? 'bg-aqua-gold text-aqua-navy shadow-md' : 'text-white/60 hover:text-white' }}">
              EN
            </a>
          </div>
          <a href="{{ url('/ticket') }}"
            class="block w-full text-center bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy px-6 py-4 rounded-full font-black text-base shadow-lg shadow-amber-900/20 uppercase tracking-wide">
            {{ App::getLocale() === 'id' ? 'BELI TIKET SEKARANG !' : 'BUY TICKETS NOW !' }}
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content Slot -->
  <main class="flex-1 w-full flex flex-col pt-20 lg:pt-28">
    {{ $slot }}
  </main>

  <!-- ============================================================ -->
  <!-- FOOTER — Midnight Navy with Gold accents                     -->
  <!-- ============================================================ -->
  <footer class="bg-aqua-navy text-white pt-20 pb-12 w-full border-t border-aqua-gold/20">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

        <!-- Brand & Philosophy -->
        <div>
          <a href="{{ url('/') }}" class="text-3xl font-black tracking-wider text-white inline-block">
            AQUA<span class="text-aqua-gold">BOOM</span>
          </a>
          <div class="h-px w-12 bg-aqua-gold mt-4 mb-5"></div>
          <p class="text-white/55 text-sm font-medium leading-relaxed">
            Destinasi rekreasi air premium di rooftop Balikpapan — kelas internasional, keseruan tak terbatas.
          </p>
          <div class="mt-8 flex items-center gap-3">
            <div class="w-8 h-8 rounded-full border border-aqua-gold/30 flex items-center justify-center">
              <svg class="w-4 h-4 text-aqua-gold" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
            </div>
            <div>
              <span class="serif-baskerville text-[10px] italic tracking-wider uppercase text-white/40 block">Managed
                by</span>
              <span class="serif-baskerville text-sm tracking-wide text-white/70 font-bold">Jatra Hotels &
                Resorts</span>
            </div>
          </div>
        </div>

        <!-- Explore Park -->
        <div>
          <h4 class="text-xs font-black text-aqua-gold mb-5 uppercase tracking-[0.2em]">Explore Park</h4>
          <ul class="space-y-3 text-sm text-white/60 font-semibold">
            <li><a href="{{ url('/explore') }}"
                class="hover:text-aqua-gold transition-colors flex items-center gap-2"><span
                  class="w-1 h-1 bg-aqua-gold/50 rounded-full inline-block"></span>Rides & Attractions</a></li>
            <li><a href="{{ url('/facilities') }}"
                class="hover:text-aqua-gold transition-colors flex items-center gap-2"><span
                  class="w-1 h-1 bg-aqua-gold/50 rounded-full inline-block"></span>Premium Facilities</a></li>
            <li><a href="{{ url('/dining') }}"
                class="hover:text-aqua-gold transition-colors flex items-center gap-2"><span
                  class="w-1 h-1 bg-aqua-gold/50 rounded-full inline-block"></span>Eat & Drink</a></li>
            <li><a href="{{ url('/faq') }}" class="hover:text-aqua-gold transition-colors flex items-center gap-2"><span
                  class="w-1 h-1 bg-aqua-gold/50 rounded-full inline-block"></span>Frequently Asked Questions</a></li>
          </ul>
        </div>

        <!-- Tickets & Info -->
        <div>
          <h4 class="text-xs font-black text-aqua-gold mb-5 uppercase tracking-[0.2em]">Tickets & Info</h4>
          <ul class="space-y-3 text-sm text-white/60 font-semibold">
            <li><a href="{{ url('/ticket') }}"
                class="hover:text-aqua-gold transition-colors flex items-center gap-2"><span
                  class="w-1 h-1 bg-aqua-gold/50 rounded-full inline-block"></span>Buy Tickets Online</a></li>
            <li><a href="{{ url('/packages') }}"
                class="hover:text-aqua-gold transition-colors flex items-center gap-2"><span
                  class="w-1 h-1 bg-aqua-gold/50 rounded-full inline-block"></span>Special Packages</a></li>
            <li><a href="{{ url('/about') }}"
                class="hover:text-aqua-gold transition-colors flex items-center gap-2"><span
                  class="w-1 h-1 bg-aqua-gold/50 rounded-full inline-block"></span>About Us</a></li>
            <li><a href="{{ url('/about') }}#career"
                class="hover:text-aqua-gold transition-colors flex items-center gap-2"><span
                  class="w-1 h-1 bg-aqua-gold/50 rounded-full inline-block"></span>Careers</a></li>
          </ul>
        </div>

        <!-- Opening Hours -->
        <div>
          <h4 class="text-xs font-black text-aqua-gold mb-5 uppercase tracking-[0.2em]">Opening Hours</h4>
          <p class="text-white/80 text-sm font-black uppercase tracking-wider mb-1">Open Daily</p>
          <p class="text-aqua-gold text-3xl font-black tracking-tight mb-4">9 AM — 6 PM</p>
          <div class="bg-aqua-navy-2 rounded-2xl p-4 border border-aqua-gold/10">
            <p class="text-white/50 text-xs leading-relaxed font-semibold">
              <span class="text-aqua-gold/80 font-black block mb-1">📍 Lokasi</span>
              7th Floor, Pentacity Mall, Balikpapan Superblock (BSB), Kalimantan Timur
            </p>
          </div>
        </div>

      </div>

      <!-- Bottom Bar -->
      <div
        class="border-t border-aqua-gold/15 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-semibold text-white/30">
        <div>&copy; {{ date('Y') }} Aquaboom Waterpark. All rights reserved.</div>
        <div class="flex gap-6">
          <a href="#" class="hover:text-aqua-gold transition-colors">Privacy Policy</a>
          <a href="#" class="hover:text-aqua-gold transition-colors">Terms of Use</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Chatbot Assistant -->
  <x-chat-assistant :faqs="\App\Models\Faq::where('is_active', true)->orderBy('sort_order')->get()" />

  @livewireScripts
</body>

</html>