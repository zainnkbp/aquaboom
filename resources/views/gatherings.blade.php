<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Corporate & Family Gathering - Aquaboom Waterpark' : 'Paket Corporate & Family Gathering - Aquaboom Waterpark' }}</x-slot:title>

  <!-- ============================================================ -->
  <!-- HERO: Corporate & Group Gathering (Luxury Dark Navy & Gold)   -->
  <!-- ============================================================ -->
  <section class="pt-36 pb-24 bg-aqua-navy relative overflow-hidden">
    <!-- Background Texture -->
    <div class="absolute inset-0 opacity-15">
      <img src="{{ asset('assets/img/default.jpeg') }}" alt="Gathering Hero" class="w-full h-full object-cover" />
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-aqua-navy/70 via-aqua-navy/90 to-aqua-navy"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 text-center">
      <div class="flex items-center justify-center gap-3 mb-4">
        <div class="h-px w-12 bg-aqua-gold"></div>
        <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">
          {{ App::getLocale() === 'en' ? 'Exclusive Group & Corporate Events' : 'Paket Rombongan & Event Perusahaan' }}
        </span>
        <div class="h-px w-12 bg-aqua-gold"></div>
      </div>

      <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black text-white mb-6 uppercase tracking-tight leading-tight">
        {!! App::getLocale() === 'en' ? 'CREATE UNFORGETTABLE MOMENTS<br/><span class="gold-shimmer">ABOVE THE CLOUDS</span>' : 'CIPTAKAN MOMEN KEBERSAMAAN<br/><span class="gold-shimmer">DI ATAS AWAN</span>' !!}
      </h1>

      <p class="text-base sm:text-lg text-white/70 font-semibold max-w-3xl mx-auto leading-relaxed mb-10">
        {{ App::getLocale() === 'en'
          ? 'Aquaboom Waterpark offers a breathtaking 7th-floor rooftop venue for corporate outings, family reunions, school study tours, and private celebrations. Enjoy exclusive group rates, dedicated coordinators, and tailored amenities.'
          : 'Aquaboom Waterpark menghadirkan venue rooftop lantai 7 Pentacity Mall untuk gathering kantor, arisan keluarga besar, study tour sekolah, dan perayaan ulang tahun. Dapatkan harga khusus rombongan, pendampingan tim event, dan fasilitas eksklusif.' }}
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="#inquiry-form" class="inline-flex items-center gap-3 bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-10 py-4 rounded-full uppercase tracking-wider text-sm transition-all shadow-xl shadow-amber-900/30 transform hover:-translate-y-1">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
          </svg>
          {{ App::getLocale() === 'en' ? 'Get Instant Quote' : 'Minta Penawaran Harga' }}
        </a>
        <a href="#packages-list" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white border border-white/20 font-black px-8 py-4 rounded-full uppercase tracking-wider text-sm transition-all">
          {{ App::getLocale() === 'en' ? 'Explore Packages' : 'Lihat Pilihan Paket' }} &darr;
        </a>
      </div>

      <!-- Quick Highlights Grid -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto mt-16 text-left">
        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 backdrop-blur-sm">
          <div class="text-2xl font-black text-aqua-gold mb-1">10 — 1000+</div>
          <div class="text-white/60 text-xs font-bold uppercase tracking-wider">{{ App::getLocale() === 'en' ? 'Pax Capacity' : 'Kapasitas Peserta' }}</div>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 backdrop-blur-sm">
          <div class="text-2xl font-black text-aqua-gold mb-1">VIP Area</div>
          <div class="text-white/60 text-xs font-bold uppercase tracking-wider">{{ App::getLocale() === 'en' ? 'Private Gazebos' : 'Gazebo Khusus Rombongan' }}</div>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 backdrop-blur-sm">
          <div class="text-2xl font-black text-aqua-gold mb-1">Fun Games</div>
          <div class="text-white/60 text-xs font-bold uppercase tracking-wider">{{ App::getLocale() === 'en' ? 'Team Building MC' : 'Instruktur & Games' }}</div>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 backdrop-blur-sm">
          <div class="text-2xl font-black text-aqua-gold mb-1">Catering</div>
          <div class="text-white/60 text-xs font-bold uppercase tracking-wider">{{ App::getLocale() === 'en' ? 'Buffet / Bento Box' : 'Pilihan Paket Makan' }}</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================================ -->
  <!-- 4 PILLARS OF EVENTS SECTION                                   -->
  <!-- ============================================================ -->
  <section class="py-24 bg-aqua-cream">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      <div class="text-center mb-16">
        <div class="flex items-center justify-center gap-3 mb-4">
          <div class="h-px w-10 bg-aqua-gold"></div>
          <span class="text-aqua-gold text-xs font-black tracking-widest uppercase">
            {{ App::getLocale() === 'en' ? 'Event Categories' : 'Kategori Acara' }}
          </span>
          <div class="h-px w-10 bg-aqua-gold"></div>
        </div>
        <h2 class="text-3xl md:text-5xl font-black text-aqua-navy uppercase tracking-tight">
          {{ App::getLocale() === 'en' ? 'CUSTOM SOLUTIONS FOR EVERY GROUP' : 'SOLUSI TERBAIK UNTUK SETIAP ACARA' }}
        </h2>
        <p class="mt-4 text-slate-600 text-base font-semibold max-w-2xl mx-auto">
          {{ App::getLocale() === 'en'
            ? 'From high-energy company gatherings to relaxing family reunions, we tailor our waterpark experience to match your event goals.'
            : 'Mulai dari gathering perusahaan yang penuh semangat hingga arisan keluarga yang santai, kami menyesuaikan setiap detail agar acara Anda berkesan.' }}
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <!-- Pillar 1: Corporate Outing -->
        <div class="bg-white rounded-[28px] p-8 border border-slate-100 shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between group">
          <div>
            <div class="w-14 h-14 bg-aqua-navy text-aqua-gold rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
            </div>
            <h3 class="text-xl font-black text-aqua-navy uppercase mb-3">Corporate Gathering & Outing</h3>
            <p class="text-slate-600 font-medium text-xs leading-relaxed mb-6">
              Tingkatkan kekompakan tim kerja (team building) dengan ice breaking water games, private sound system, dan lunch buffet di venue rooftop berkelas.
            </p>
          </div>
          <ul class="space-y-2 border-t border-slate-100 pt-4 text-xs font-bold text-slate-700">
            <li class="flex items-center gap-2 text-emerald-600">✓ Fun Team Building MC</li>
            <li class="flex items-center gap-2 text-emerald-600">✓ Private Area & Sound System</li>
            <li class="flex items-center gap-2 text-emerald-600">✓ Catering & Coffee Break</li>
          </ul>
        </div>

        <!-- Pillar 2: Family Gathering -->
        <div class="bg-white rounded-[28px] p-8 border border-slate-100 shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between group">
          <div>
            <div class="w-14 h-14 bg-amber-500/10 text-amber-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </div>
            <h3 class="text-xl font-black text-aqua-navy uppercase mb-3">Family Gathering & Arisan</h3>
            <p class="text-slate-600 font-medium text-xs leading-relaxed mb-6">
              Kumpul keluarga besar, reuni akbar, atau arisan komunitas dengan suasana ceria, kolam aman untuk anak & dewasa, serta gazebo santai.
            </p>
          </div>
          <ul class="space-y-2 border-t border-slate-100 pt-4 text-xs font-bold text-slate-700">
            <li class="flex items-center gap-2 text-emerald-600">✓ Complimentary Gazebo</li>
            <li class="flex items-center gap-2 text-emerald-600">✓ Gratis Ban Pelampung</li>
            <li class="flex items-center gap-2 text-emerald-600">✓ Diskon Spesial Rombongan</li>
          </ul>
        </div>

        <!-- Pillar 3: School Field Trip -->
        <div class="bg-white rounded-[28px] p-8 border border-slate-100 shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between group">
          <div>
            <div class="w-14 h-14 bg-aqua-azure/10 text-aqua-azure rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
              </svg>
            </div>
            <h3 class="text-xl font-black text-aqua-navy uppercase mb-3">School Field Trip & Edu-Tour</h3>
            <p class="text-slate-600 font-medium text-xs leading-relaxed mb-6">
              Rekreasi edukatif bagi siswa TK, SD, SMP, SMA, dan universitas. Dilengkapi sesi edukasi keselamatan air dan pengawasan lifeguard bersertifikat.
            </p>
          </div>
          <ul class="space-y-2 border-t border-slate-100 pt-4 text-xs font-bold text-slate-700">
            <li class="flex items-center gap-2 text-emerald-600">✓ Free Tiket Guru Pendamping</li>
            <li class="flex items-center gap-2 text-emerald-600">✓ Water Safety Briefing</li>
            <li class="flex items-center gap-2 text-emerald-600">✓ Paket Hemat Siswa</li>
          </ul>
        </div>

        <!-- Pillar 4: Birthday & Pool Party -->
        <div class="bg-white rounded-[28px] p-8 border border-slate-100 shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between group">
          <div>
            <div class="w-14 h-14 bg-rose-500/10 text-rose-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h10z" />
              </svg>
            </div>
            <h3 class="text-xl font-black text-aqua-navy uppercase mb-3">Birthday & Private Party</h3>
            <p class="text-slate-600 font-medium text-xs leading-relaxed mb-6">
              Rayakan pesta ulang tahun tak terlupakan di pinggir kolam renang rooftop. Lengkap dengan dekorasi balon tematik, kids meals, dan photo spot.
            </p>
          </div>
          <ul class="space-y-2 border-t border-slate-100 pt-4 text-xs font-bold text-slate-700">
            <li class="flex items-center gap-2 text-emerald-600">✓ Poolside Birthday Setup</li>
            <li class="flex items-center gap-2 text-emerald-600">✓ Kids Meal & Goodie Bag Spot</li>
            <li class="flex items-center gap-2 text-emerald-600">✓ Sound System & Lagu Ultah</li>
          </ul>
        </div>

      </div>
    </div>
  </section>

  <!-- ============================================================ -->
  <!-- DYNAMIC GATHERING PACKAGES FROM CMS                           -->
  <!-- ============================================================ -->
  <section id="packages-list" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      <div class="text-center mb-16">
        <div class="flex items-center justify-center gap-3 mb-4">
          <div class="h-px w-10 bg-aqua-gold"></div>
          <span class="text-aqua-gold text-xs font-black tracking-widest uppercase">
            {{ App::getLocale() === 'en' ? 'Curated Gathering Packages' : 'Pilihan Paket Gathering' }}
          </span>
          <div class="h-px w-10 bg-aqua-gold"></div>
        </div>
        <h2 class="text-3xl md:text-5xl font-black text-aqua-navy uppercase tracking-tight">
          {{ App::getLocale() === 'en' ? 'FEATURED GROUP PACKAGES' : 'PAKET ROMBONGAN SPESIAL' }}
        </h2>
        <p class="mt-4 text-slate-600 text-base font-semibold max-w-2xl mx-auto">
          {{ App::getLocale() === 'en'
            ? 'Choose from our most popular group packages or contact us for a tailor-made quotation.'
            : 'Pilih paket favorit di bawah ini atau konsultasikan kebutuhan kustom rombongan Anda langsung dengan tim kami.' }}
        </p>
      </div>

      @if(isset($gatheringPackages) && $gatheringPackages->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
          @foreach($gatheringPackages as $package)
            @php
              $textParam = rawurlencode("Halo Tim Sales Aquaboom, saya ingin konsultasi penawaran untuk paket gathering: " . $package->name);
              $waLink = $package->inquiry_custom_link ?: "https://wa.me/628115472233?text={$textParam}";
            @endphp
            <div class="bg-white rounded-[32px] overflow-hidden shadow-xl border border-slate-100 flex flex-col group hover:-translate-y-2 transition-all duration-300">
              <div class="relative h-64 overflow-hidden bg-aqua-navy">
                <img src="{{ $package->image_url }}" alt="{{ $package->name }}" onerror="this.onerror=null; this.src='{{ asset('assets/img/default.jpeg') }}';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                <div class="absolute top-4 right-4 bg-aqua-gold text-aqua-navy text-xs font-black px-4 py-1.5 rounded-full uppercase tracking-wider shadow-md">
                  Min. 10+ Pax
                </div>
              </div>

              <div class="p-8 flex-1 flex flex-col justify-between">
                <div>
                  <h3 class="text-2xl font-black text-aqua-navy mb-3 uppercase">
                    {{ App::getLocale() === 'en' && $package->name_en ? $package->name_en : $package->name }}
                  </h3>
                  <p class="text-slate-600 font-semibold text-sm leading-relaxed mb-6">
                    {{ App::getLocale() === 'en' && $package->description_en ? $package->description_en : $package->description }}
                  </p>

                  @if($package->price > 0)
                    <div class="mb-6 p-4 bg-aqua-cream rounded-2xl border border-aqua-cream-2">
                      <div class="text-xs font-bold text-slate-500 uppercase tracking-wider">Mulai Dari</div>
                      <div class="text-2xl font-black text-aqua-navy">
                        Rp {{ number_format($package->effective_price, 0, ',', '.') }}
                        <span class="text-xs font-normal text-slate-500">/ orang</span>
                      </div>
                    </div>
                  @endif
                </div>

                <a href="{{ $waLink }}" target="_blank" class="w-full text-center bg-emerald-600 hover:bg-emerald-700 text-white font-black py-4 rounded-xl transition-all shadow-md flex items-center justify-center gap-2 uppercase tracking-wider text-xs">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                  </svg>
                  Tanya Penawaran Paket Ini
                </a>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <!-- Fallback Default Showcase Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="bg-white rounded-[32px] p-8 border border-slate-200 shadow-xl flex flex-col justify-between">
            <div>
              <div class="bg-aqua-navy text-aqua-gold text-[10px] font-black uppercase px-3 py-1 rounded-full w-fit mb-4">Best Seller</div>
              <h3 class="text-2xl font-black text-aqua-navy mb-2">PAKET OUTING CORPO-FUN</h3>
              <p class="text-slate-600 text-sm font-semibold mb-6">Cocok untuk outing kantor & gathering BUMN/Swasta. Sudah termasuk tiket wahana, MC games, sound system, & private gazebo.</p>
            </div>
            <a href="https://wa.me/628115472233?text=Halo%20Tim%20Sales%20Aquaboom,%20saya%20tertarik%20dengan%20Paket%20Outing%20Corpo-Fun" target="_blank" class="w-full text-center bg-emerald-600 hover:bg-emerald-700 text-white font-black py-4 rounded-xl transition-all uppercase tracking-wider text-xs">
              Konsultasi Paket Ini &rarr;
            </a>
          </div>

          <div class="bg-white rounded-[32px] p-8 border border-slate-200 shadow-xl flex flex-col justify-between">
            <div>
              <div class="bg-amber-500 text-white text-[10px] font-black uppercase px-3 py-1 rounded-full w-fit mb-4">Family Favorite</div>
              <h3 class="text-2xl font-black text-aqua-navy mb-2">PAKET ARISAN & KELUARGA</h3>
              <p class="text-slate-600 text-sm font-semibold mb-6">Paket rekreasi santai untuk keluarga besar & arisan. Termasuk gazebo eksklusif, sewa ban pelampung, dan welcome drink.</p>
            </div>
            <a href="https://wa.me/628115472233?text=Halo%20Tim%20Sales%20Aquaboom,%20saya%20tertarik%20dengan%20Paket%20Arisan%20dan%20Keluarga" target="_blank" class="w-full text-center bg-emerald-600 hover:bg-emerald-700 text-white font-black py-4 rounded-xl transition-all uppercase tracking-wider text-xs">
              Konsultasi Paket Ini &rarr;
            </a>
          </div>

          <div class="bg-white rounded-[32px] p-8 border border-slate-200 shadow-xl flex flex-col justify-between">
            <div>
              <div class="bg-aqua-azure text-white text-[10px] font-black uppercase px-3 py-1 rounded-full w-fit mb-4">School Special</div>
              <h3 class="text-2xl font-black text-aqua-navy mb-2">PAKET EDU-TOUR SEKOLAH</h3>
              <p class="text-slate-600 text-sm font-semibold mb-6">Paket wisata edukasi untuk TK hingga SMA. Dilengkapi briefing renang aman, pendampingan lifeguard, dan free tiket guru.</p>
            </div>
            <a href="https://wa.me/628115472233?text=Halo%20Tim%20Sales%20Aquaboom,%20saya%20tertarik%20dengan%20Paket%20Edu-Tour%20Sekolah" target="_blank" class="w-full text-center bg-emerald-600 hover:bg-emerald-700 text-white font-black py-4 rounded-xl transition-all uppercase tracking-wider text-xs">
              Konsultasi Paket Ini &rarr;
            </a>
          </div>
        </div>
      @endif

    </div>
  </section>

  <!-- ============================================================ -->
  <!-- INTERACTIVE WHATSAPP QUOTE GENERATOR FORM                    -->
  <!-- ============================================================ -->
  <section id="inquiry-form" class="py-24 bg-aqua-navy text-white relative overflow-hidden" x-data="{
    picName: '',
    companyName: '',
    phone: '',
    eventType: 'Corporate Gathering / Outing Kantor',
    eventDate: '',
    paxRange: '50 - 100 Orang',
    notes: '',
    generateWaLink() {
      if (!this.picName || !this.phone) {
        alert('Mohon isi Nama PIC dan No WhatsApp Anda');
        return;
      }
      let text = 'Halo Tim Sales Aquaboom Waterpark, saya ingin meminta surat penawaran / proposal acara:\n\n'
        + '👤 *Nama PIC:* ' + this.picName + '\n'
        + '🏢 *Perusahaan / Instansi:* ' + (this.companyName || '-') + '\n'
        + '📱 *No. WhatsApp:* ' + this.phone + '\n'
        + '🎯 *Kategori Acara:* ' + this.eventType + '\n'
        + '📅 *Perkiraan Tanggal:* ' + (this.eventDate || 'Menyusul') + '\n'
        + '👥 *Estimasi Jumlah Peserta:* ' + this.paxRange + '\n'
        + '📝 *Catatan Khusus:* ' + (this.notes || '-') + '\n\n'
        + 'Mohon informasi paket harga dan ketersediaan tanggal. Terima kasih!';
      window.open('https://wa.me/628115472233?text=' + encodeURIComponent(text), '_blank');
    }
  }">
    <!-- Background Rings -->
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full border border-aqua-gold/10 pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full border border-aqua-gold/10 pointer-events-none"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-6">
      <div class="text-center mb-12">
        <div class="flex items-center justify-center gap-3 mb-4">
          <div class="h-px w-10 bg-aqua-gold"></div>
          <span class="text-aqua-gold text-xs font-black tracking-widest uppercase">Fast Response WhatsApp</span>
          <div class="h-px w-10 bg-aqua-gold"></div>
        </div>
        <h2 class="text-3xl md:text-5xl font-black uppercase tracking-tight">
          FORM PERMINTAAN PENAWARAN HARGA
        </h2>
        <p class="mt-4 text-white/70 text-sm font-semibold max-w-xl mx-auto">
          Isi formulir singkat di bawah ini. Tim Sales Executive Aquaboom akan langsung merespons dan menyiapkan proposal penawaran harga terbaik untuk rombongan Anda.
        </p>
      </div>

      <div class="bg-white/5 border border-white/15 rounded-[32px] p-8 md:p-12 backdrop-blur-xl shadow-2xl">
        <form @submit.prevent="generateWaLink()" class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-xs font-black uppercase tracking-wider text-white/70 mb-2">Nama Lengkap PIC *</label>
            <input type="text" x-model="picName" placeholder="Contoh: Bpk. Hendra Wijaya" class="w-full bg-white/10 text-white placeholder-white/40 border border-white/20 px-5 py-4 rounded-xl focus:outline-none focus:border-aqua-gold font-medium text-sm" required />
          </div>

          <div>
            <label class="block text-xs font-black uppercase tracking-wider text-white/70 mb-2">Nama Instansi / Perusahaan / Komunitas</label>
            <input type="text" x-model="companyName" placeholder="Contoh: PT. Pertamina / Bank Mandiri" class="w-full bg-white/10 text-white placeholder-white/40 border border-white/20 px-5 py-4 rounded-xl focus:outline-none focus:border-aqua-gold font-medium text-sm" />
          </div>

          <div>
            <label class="block text-xs font-black uppercase tracking-wider text-white/70 mb-2">Nomor WhatsApp PIC *</label>
            <input type="tel" x-model="phone" placeholder="Contoh: 081234567890" class="w-full bg-white/10 text-white placeholder-white/40 border border-white/20 px-5 py-4 rounded-xl focus:outline-none focus:border-aqua-gold font-medium text-sm" required />
          </div>

          <div>
            <label class="block text-xs font-black uppercase tracking-wider text-white/70 mb-2">Kategori Acara</label>
            <select x-model="eventType" class="w-full bg-slate-900 text-white border border-white/20 px-5 py-4 rounded-xl focus:outline-none focus:border-aqua-gold font-medium text-sm">
              <option value="Corporate Gathering / Outing Kantor">Corporate Gathering / Outing Kantor</option>
              <option value="Family Gathering / Arisan Keluarga">Family Gathering / Arisan Keluarga</option>
              <option value="School Field Trip / Edu-Tour Siswa">School Field Trip / Edu-Tour Siswa</option>
              <option value="Birthday & Private Pool Party">Birthday & Private Pool Party</option>
              <option value="Reuni Komunitas / Event Lainnya">Reuni Komunitas / Event Lainnya</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-black uppercase tracking-wider text-white/70 mb-2">Rencana Tanggal Acara</label>
            <input type="date" x-model="eventDate" class="w-full bg-slate-900 text-white border border-white/20 px-5 py-4 rounded-xl focus:outline-none focus:border-aqua-gold font-medium text-sm" />
          </div>

          <div>
            <label class="block text-xs font-black uppercase tracking-wider text-white/70 mb-2">Estimasi Jumlah Peserta (Pax)</label>
            <select x-model="paxRange" class="w-full bg-slate-900 text-white border border-white/20 px-5 py-4 rounded-xl focus:outline-none focus:border-aqua-gold font-medium text-sm">
              <option value="20 - 50 Orang">20 - 50 Orang (Rombongan Kecil)</option>
              <option value="50 - 100 Orang">50 - 100 Orang (Medium Group)</option>
              <option value="100 - 250 Orang">100 - 250 Orang (Large Group)</option>
              <option value="250 - 500 Orang">250 - 500 Orang (Corporate Big Event)</option>
              <option value="500+ Orang (Full Venue Private Hire)">500+ Orang (Full Venue Private Hire)</option>
            </select>
          </div>

          <div class="md:col-span-2">
            <label class="block text-xs font-black uppercase tracking-wider text-white/70 mb-2">Catatan Tambahan / Kebutuhan Fasilitas</label>
            <textarea x-model="notes" rows="3" placeholder="Contoh: Butuh paket makan siang buffet dan instruktur fun games ice breaking..." class="w-full bg-white/10 text-white placeholder-white/40 border border-white/20 px-5 py-4 rounded-xl focus:outline-none focus:border-aqua-gold font-medium text-sm"></textarea>
          </div>

          <div class="md:col-span-2 mt-4 text-center">
            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-black px-12 py-5 rounded-full uppercase tracking-wider text-sm transition-all shadow-2xl shadow-emerald-900/40 transform hover:-translate-y-1">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
              </svg>
              Kirim Permintaan Penawaran via WhatsApp
            </button>
            <p class="text-white/40 text-xs mt-3">Formulir akan otomatis membuka chat WhatsApp resmi Sales Aquaboom Waterpark.</p>
          </div>
        </form>
      </div>
    </div>
  </section>

</x-layout>
