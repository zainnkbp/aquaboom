<x-layout>
  <x-slot:title>Premium Facilities - Aquaboom Waterpark</x-slot:title>
  
  <!-- Page Header -->
  <div class="pt-36 pb-20 bg-aqua-navy relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
      <img src="https://picsum.photos/1920/600?random=80" alt="bg" class="w-full h-full object-cover" />
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-aqua-navy/60 to-aqua-navy"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-10 text-center">
      <div class="flex items-center justify-center gap-3 mb-4">
        <div class="h-px w-10 bg-aqua-gold"></div>
        <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">Comfort & Convenience</span>
        <div class="h-px w-10 bg-aqua-gold"></div>
      </div>
      <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight">
        {{ App::getLocale() === 'id' ? 'FASILITAS PREMIUM' : 'PREMIUM FACILITIES' }}
      </h1>
      <p class="text-base md:text-lg text-white/60 max-w-3xl mx-auto font-semibold leading-relaxed">
        {{ App::getLocale() === 'id' ? 'Kenyamanan paripurna untuk pengalaman rekreasi tanpa batas. Kami menyediakan segala kebutuhan dasar dan premium Anda selama berada di area Aquaboom.' : 'Ultimate comfort for an boundless recreation experience. We provide all your basic and premium needs during your time at Aquaboom.' }}
      </p>
    </div>
  </div>

  <!-- Facilities Wrapper -->
  <div class="bg-aqua-cream flex flex-col gap-28" style="padding-top: 7rem; padding-bottom: 5rem;">

    <!-- Section 1: Private Gazebos (Text Left, Image Right) -->
    <section class="max-w-7xl mx-auto px-6 lg:px-10 w-full">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-5">
          <div class="flex items-center gap-3 mb-4">
            <div class="h-px w-10 bg-aqua-gold"></div>
            <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">VIP Experience</span>
          </div>
          <h2 class="text-4xl lg:text-5xl font-black text-aqua-navy uppercase mb-6 leading-tight">
            {{ App::getLocale() === 'id' ? 'GAZEBO PRIBADI & CABANA' : 'PRIVATE GAZEBOS & CABANAS' }}
          </h2>
          <p class="text-slate-600 text-base leading-relaxed font-semibold mb-4">
            {{ App::getLocale() === 'id' ? 'Tingkatkan kenyamanan kunjungan Anda dengan menyewa Gazebo pribadi. Terletak di area teduh nan asri, lengkap dengan layanan pesan antar makanan, pengisian daya, dan privasi penuh.' : 'Elevate the comfort of your visit by renting a private Gazebo. Located in a shaded and lush area, complete with food delivery service, power outlets, and full privacy.' }}
          </p>
          <ul class="space-y-2 text-sm text-slate-600 font-semibold mb-8">
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Layanan makanan & minuman langsung ke gazebo' : 'Food & beverage service directly to your gazebo' }}
            </li>
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Privasi & kenyamanan maksimal' : 'Maximum privacy & comfort' }}
            </li>
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Kapasitas 4–8 orang per gazebo' : 'Capacity of 4–8 people per gazebo' }}
            </li>
          </ul>
          <a href="{{ url('/ticket') }}" class="inline-block bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-8 py-4 rounded-xl shadow-lg shadow-amber-900/20 uppercase tracking-wider text-sm transition-all">
            {{ App::getLocale() === 'id' ? 'Pesan Gazebo' : 'Book a Gazebo' }}
          </a>
        </div>
        <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div class="rounded-3xl overflow-hidden shadow-xl h-64 ring-1 ring-aqua-gold/20">
            <img src="https://picsum.photos/600/400?random=40" alt="Gazebo Standard" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
          </div>
          <div class="rounded-3xl overflow-hidden shadow-xl h-64 ring-1 ring-aqua-gold/20">
            <img src="https://picsum.photos/600/400?random=41" alt="VIP Gazebo" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
          </div>
        </div>
      </div>
    </section>

    <!-- Section 2: Lockers & Towels (Image Left, Text Right) -->
    <section class="max-w-7xl mx-auto px-6 lg:px-10 w-full">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6 lg:order-1 order-2">
          <div class="rounded-3xl overflow-hidden shadow-xl h-64 ring-1 ring-aqua-gold/20">
            <img src="https://picsum.photos/600/400?random=42" alt="Smart Lockers" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
          </div>
          <div class="rounded-3xl overflow-hidden shadow-xl h-64 ring-1 ring-aqua-gold/20">
            <img src="https://picsum.photos/600/400?random=43" alt="Towel Rental" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
          </div>
        </div>
        <div class="lg:col-span-5 lg:order-2 order-1">
          <div class="flex items-center gap-3 mb-4">
            <div class="h-px w-10 bg-aqua-gold"></div>
            <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">Secure Storage</span>
          </div>
          <h2 class="text-4xl lg:text-5xl font-black text-aqua-navy uppercase mb-6 leading-tight">
            {{ App::getLocale() === 'id' ? 'PENYEWAAN LOKER & HANDUK' : 'LOCKERS & TOWEL RENTAL' }}
          </h2>
          <p class="text-slate-600 text-base leading-relaxed font-semibold mb-4">
            {{ App::getLocale() === 'id' ? 'Nikmati petualangan air tanpa rasa cemas. Kami menyediakan fasilitas loker otomatis dengan keamanan terintegrasi, serta penyewaan handuk bersih yang selalu disterilkan secara berkala.' : 'Enjoy your water adventures without worry. We provide automatic lockers with integrated security, as well as clean towel rentals that are sterilized regularly.' }}
          </p>
          <ul class="space-y-2 text-sm text-slate-600 font-semibold mb-8">
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Sistem kunci loker menggunakan gelang RFID / pin' : 'Locker lock system using RFID wristband / pin' }}
            </li>
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Handuk premium bersih & higienis' : 'Clean & hygienic premium towels' }}
            </li>
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Lokasi loker strategis dekat ruang bilas' : 'Strategic locker locations near the rinse rooms' }}
            </li>
          </ul>
        </div>
      </div>
    </section>

    <!-- Section 3: Shower & Changing Amenities (Text Left, Image Right) -->
    <section class="max-w-7xl mx-auto px-6 lg:px-10 w-full">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-5">
          <div class="flex items-center gap-3 mb-4">
            <div class="h-px w-10 bg-aqua-gold"></div>
            <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">Premium Comfort</span>
          </div>
          <h2 class="text-4xl lg:text-5xl font-black text-aqua-navy uppercase mb-6 leading-tight">
            {{ App::getLocale() === 'id' ? 'RUANG BILAS & RUANG GANTI' : 'SHOWER & CHANGING ROOMS' }}
          </h2>
          <p class="text-slate-600 text-base leading-relaxed font-semibold mb-4">
            {{ App::getLocale() === 'id' ? 'Ruang bilas dan ruang ganti premium kami dirancang dengan mengutamakan kebersihan dan kenyamanan. Dilengkapi dengan pancuran air hangat, bilik ganti pribadi yang luas, serta pengering rambut.' : 'Our premium shower and changing rooms are designed with hygiene and comfort in mind. Equipped with hot showers, spacious private changing cubicles, and hair dryers.' }}
          </p>
          <ul class="space-y-2 text-sm text-slate-600 font-semibold mb-8">
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Bilik shower pribadi dengan air hangat' : 'Private shower cubicles with hot water' }}
            </li>
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Peralatan mandi lengkap (sabun & sampo cair)' : 'Complete bath amenities (liquid soap & shampoo)' }}
            </li>
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Wastafel dan cermin rias berukuran besar' : 'Large washbasins and vanity mirrors' }}
            </li>
          </ul>
        </div>
        <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div class="rounded-3xl overflow-hidden shadow-xl h-64 ring-1 ring-aqua-gold/20">
            <img src="https://picsum.photos/600/400?random=44" alt="Premium Shower Room" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
          </div>
          <div class="rounded-3xl overflow-hidden shadow-xl h-64 ring-1 ring-aqua-gold/20">
            <img src="https://picsum.photos/600/400?random=45" alt="Vanity Area" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
          </div>
        </div>
      </div>
    </section>

    <!-- Section 4: First Aid Station (Image Left, Text Right) -->
    <section class="max-w-7xl mx-auto px-6 lg:px-10 w-full">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6 lg:order-1 order-2">
          <div class="rounded-3xl overflow-hidden shadow-xl h-64 ring-1 ring-aqua-gold/20">
            <img src="https://picsum.photos/600/400?random=46" alt="First Aid Room" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
          </div>
          <div class="rounded-3xl overflow-hidden shadow-xl h-64 ring-1 ring-aqua-gold/20">
            <img src="https://picsum.photos/600/400?random=47" alt="Lifeguard Equipment" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
          </div>
        </div>
        <div class="lg:col-span-5 lg:order-2 order-1">
          <div class="flex items-center gap-3 mb-4">
            <div class="h-px w-10 bg-aqua-gold"></div>
            <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">Safety First</span>
          </div>
          <h2 class="text-4xl lg:text-5xl font-black text-aqua-navy uppercase mb-6 leading-tight">
            {{ App::getLocale() === 'id' ? 'KLINIK PERTOLONGAN PERTAMA (P3K)' : 'FIRST AID (P3K) CLINIC' }}
          </h2>
          <p class="text-slate-600 text-base leading-relaxed font-semibold mb-4">
            {{ App::getLocale() === 'id' ? 'Keselamatan Anda adalah prioritas utama kami. Klinik P3K Aquaboom dilengkapi dengan peralatan medis darurat standar internasional serta dipandu oleh tim medis terlatih yang bersertifikasi.' : 'Your safety is our top priority. The Aquaboom First Aid Clinic is equipped with international standard emergency medical gear and guided by certified, trained medical staff.' }}
          </p>
          <ul class="space-y-2 text-sm text-slate-600 font-semibold mb-8">
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Perawat dan pertolongan medis siaga selama jam operasional' : 'Nurses and medical assistance on standby during operational hours' }}
            </li>
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Obat-obatan umum dan peralatan bantuan darurat lengkap' : 'General medicine and complete emergency aid equipment' }}
            </li>
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Akses jalur evakuasi darurat yang cepat' : 'Fast emergency evacuation route access' }}
            </li>
          </ul>
        </div>
      </div>
    </section>

    <!-- Section 5: Pray Rooms (Text Left, Image Right) -->
    <section class="max-w-7xl mx-auto px-6 lg:px-10 w-full mb-12">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-5">
          <div class="flex items-center gap-3 mb-4">
            <div class="h-px w-10 bg-aqua-gold"></div>
            <span class="text-aqua-gold text-xs font-black tracking-[0.3em] uppercase">Spiritual Comfort</span>
          </div>
          <h2 class="text-4xl lg:text-5xl font-black text-aqua-navy uppercase mb-6 leading-tight">
            {{ App::getLocale() === 'id' ? 'MUSHOLA' : 'PRAYER ROOMS (MUSHOLA)' }}
          </h2>
          <p class="text-slate-600 text-base leading-relaxed font-semibold mb-4">
            {{ App::getLocale() === 'id' ? 'Kami menyediakan ruang ibadah (Mushola) yang tenang, sejuk, dan bersih untuk menunjang kenyamanan ibadah Anda. Terpisah secara higienis antara area wudhu pria dan wanita.' : 'We provide a quiet, cool, and clean prayer room (Mushola) to support your worship comfort. Hygienically separated between male and female wudhu areas.' }}
          </p>
          <ul class="space-y-2 text-sm text-slate-600 font-semibold mb-8">
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Tempat wudhu bersih terpisah gender' : 'Clean wudhu areas separated by gender' }}
            </li>
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Dilengkapi sajadah, mukena, sarung, dan Al-Quran' : 'Equipped with prayer mats, female pray wear, sarongs, and Quran' }}
            </li>
            <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                {{ App::getLocale() === 'id' ? 'Ruangan ber-AC yang nyaman' : 'Comfortable air-conditioned rooms' }}
            </li>
          </ul>
        </div>
        <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div class="rounded-3xl overflow-hidden shadow-xl h-64 ring-1 ring-aqua-gold/20">
            <img src="https://picsum.photos/600/400?random=48" alt="Mushola Area" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
          </div>
          <div class="rounded-3xl overflow-hidden shadow-xl h-64 ring-1 ring-aqua-gold/20">
            <img src="https://picsum.photos/600/400?random=49" alt="Wudhu Place" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
          </div>
        </div>
      </div>
    </section>

  </div>

</x-layout>
