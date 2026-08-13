<x-layout>
  <x-slot:title>Packages & Special Offers - Aquaboom Waterpark</x-slot:title>

  <!-- Page Header -->
  <div class="pt-36 pb-20 bg-aqua-navy relative overflow-hidden">
    <div class="absolute inset-0 z-0">
      <img src="https://picsum.photos/1920/600?random=50" alt="Packages Header" class="w-full h-full object-cover opacity-20 mix-blend-overlay" />
      <div class="absolute inset-0 bg-gradient-to-b from-waterbom-dark/80 to-waterbom-dark"></div>
    </div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
      <span class="text-aqua-azure text-sm font-black tracking-widest uppercase mb-4 block">Special Deals</span>
      <h1 class="text-5xl md:text-7xl font-black text-white mb-6 uppercase tracking-tight leading-tight">
        PACKAGES &<br/>SPECIAL OFFERS
      </h1>
      <p class="text-base md:text-lg text-white/70 font-semibold max-w-3xl mx-auto leading-relaxed">
        Aquaboom is the perfect setting for special events, birthdays, family gatherings, corporate team outings or just big groups of friends wanting to have a great day out! Our team can assist you with your enquiry and customise a package with special rates for groups of more than 10 people.
      </p>
      <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ url('/book') }}" class="inline-block bg-aqua-gold hover:bg-aqua-gold-2 text-white font-black px-10 py-4 rounded-xl uppercase tracking-wider text-sm transition-all shadow-lg shadow-orange-500/20">
          Book Tickets Online
        </a>
        <a href="mailto:info@aquaboombsb.com" class="inline-block bg-white/10 hover:bg-white/20 text-white border border-white/30 font-black px-10 py-4 rounded-xl uppercase tracking-wider text-sm transition-all">
          Group Enquiry
        </a>
      </div>
    </div>
  </div>

  <!-- Package Cards Grid -->
  <section class="py-24 bg-aqua-cream">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

      <!-- Section intro note -->
      <div class="text-center mb-16">
        <p class="text-slate-600 font-semibold text-sm max-w-2xl mx-auto">
          For bookings of fewer than 10 guests, please visit our <a href="{{ url('/ticket') }}" class="text-aqua-azure underline hover:text-aqua-gold">ticket page</a> and take advantage of our regular online discount. Our current offers and group promotions are below:
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

        <!-- Package 1: Duo Pass -->
        <div class="bg-white rounded-[28px] overflow-hidden shadow-xl border border-slate-100 flex flex-col group hover:-translate-y-2 transition-all duration-300">
          <!-- Image with Hover Overlay -->
          <div class="relative h-64 overflow-hidden">
            <img src="https://picsum.photos/600/400?random=51" alt="Duo Pass" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
            <!-- Hover Overlay -->
            <div class="absolute inset-0 bg-aqua-navy/75 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <p class="text-white text-base font-bold text-center px-6 mb-5">Slide with a friend, relax, and save up to 15%!</p>
              <a href="{{ url('/book') }}" class="bg-white/20 hover:bg-aqua-gold border-2 border-white text-white font-black px-8 py-3 rounded-full text-sm uppercase tracking-wider transition-all">
                BOOK NOW
              </a>
            </div>
            <!-- Badge -->
            <div class="absolute top-4 left-4 bg-aqua-gold text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
              Save 15%
            </div>
          </div>
          <!-- Card Content -->
          <div class="p-8 flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-2xl font-black text-aqua-navy mb-3 uppercase">Duo Pass</h3>
              <p class="text-slate-600 font-semibold text-sm leading-relaxed mb-5">
                The perfect slide package for couples, besties, or any twosome wanting to slide and then relax with a foot massage at the end of the day! Savings up to 15%!
              </p>
              <div class="mb-6">
                <p class="text-xs font-black text-aqua-navy uppercase tracking-widest mb-3">Includes:</p>
                <ul class="space-y-2 text-sm text-slate-600 font-semibold">
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Tiket masuk untuk 2 orang</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>2 handuk kolam gratis</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>1 locker standar gratis</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>30 menit foot massage masing-masing</li>
                </ul>
              </div>
              <div class="bg-aqua-cream rounded-xl p-4 mb-6 text-sm">
                <div class="flex justify-between items-center mb-1">
                  <span class="text-slate-500 font-semibold">Harga Normal</span>
                  <span class="text-slate-400 line-through font-bold">Rp 320.000</span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-aqua-navy font-black">Harga Paket</span>
                  <span class="text-aqua-gold text-xl font-black">Rp 270.000</span>
                </div>
                <p class="text-slate-400 text-xs font-semibold mt-2 italic">Berlaku s.d. 31 Agustus 2026</p>
              </div>
            </div>
            <a href="{{ url('/book') }}" class="block w-full text-center bg-aqua-navy hover:bg-black text-white font-black py-4 rounded-xl text-sm uppercase tracking-wider transition-all">
              Book Now
            </a>
          </div>
        </div>

        <!-- Package 2: Four Pack Pass -->
        <div class="bg-white rounded-[28px] overflow-hidden shadow-xl border border-slate-100 flex flex-col group hover:-translate-y-2 transition-all duration-300">
          <div class="relative h-64 overflow-hidden">
            <img src="https://picsum.photos/600/400?random=52" alt="Four Pack Pass" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
            <div class="absolute inset-0 bg-aqua-navy/75 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <p class="text-white text-base font-bold text-center px-6 mb-5">Get more with this four-tastic package!</p>
              <a href="{{ url('/book') }}" class="bg-white/20 hover:bg-aqua-gold border-2 border-white text-white font-black px-8 py-3 rounded-full text-sm uppercase tracking-wider transition-all">
                BOOK NOW
              </a>
            </div>
            <div class="absolute top-4 left-4 bg-aqua-gold text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
              Save 25%
            </div>
          </div>
          <div class="p-8 flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-2xl font-black text-aqua-navy mb-3 uppercase">Four Pack Pass</h3>
              <p class="text-slate-600 font-semibold text-sm leading-relaxed mb-5">
                Experience more fun together! One easy purchase for a great day out for four people and save up to 25%!
              </p>
              <div class="mb-6">
                <p class="text-xs font-black text-aqua-navy uppercase tracking-widest mb-3">Includes:</p>
                <ul class="space-y-2 text-sm text-slate-600 font-semibold">
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Tiket masuk 4 orang (dewasa/anak)</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>4 handuk kolam gratis</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>1 family locker</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Voucher makanan Rp 100.000</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>10% off spa treatment per orang</li>
                </ul>
              </div>
              <div class="bg-aqua-cream rounded-xl p-4 mb-6 text-sm">
                <div class="flex justify-between items-center mb-1">
                  <span class="text-slate-500 font-semibold">Harga Normal</span>
                  <span class="text-slate-400 line-through font-bold">Rp 600.000</span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-aqua-navy font-black">Harga Paket</span>
                  <span class="text-aqua-gold text-xl font-black">Rp 450.000</span>
                </div>
                <p class="text-slate-400 text-xs font-semibold mt-2 italic">Berlaku semua hari</p>
              </div>
            </div>
            <a href="{{ url('/book') }}" class="block w-full text-center bg-aqua-navy hover:bg-black text-white font-black py-4 rounded-xl text-sm uppercase tracking-wider transition-all">
              Book Now
            </a>
          </div>
        </div>

        <!-- Package 3: Birthday Package -->
        <div class="bg-white rounded-[28px] overflow-hidden shadow-xl border border-slate-100 flex flex-col group hover:-translate-y-2 transition-all duration-300 ring-2 ring-waterbom-orange">
          <div class="relative h-64 overflow-hidden">
            <img src="https://picsum.photos/600/400?random=53" alt="Birthday Package" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
            <div class="absolute inset-0 bg-aqua-navy/75 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <p class="text-white text-base font-bold text-center px-6 mb-5">Celebrate your special day at Aquaboom!</p>
              <a href="mailto:info@aquaboombsb.com?subject=Saya ingin tahu lebih lanjut tentang Birthday Package di Aquaboom!" class="bg-white/20 hover:bg-aqua-gold border-2 border-white text-white font-black px-8 py-3 rounded-full text-sm uppercase tracking-wider transition-all">
                ENQUIRE NOW
              </a>
            </div>
            <div class="absolute top-4 left-4 bg-aqua-gold text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
              🎂 Birthday
            </div>
            <div class="absolute top-4 right-4 bg-white/90 text-aqua-navy text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
              Paling Populer
            </div>
          </div>
          <div class="p-8 flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-2xl font-black text-aqua-navy mb-3 uppercase">Birthday Package</h3>
              <p class="text-slate-600 font-semibold text-sm leading-relaxed mb-5">
                Aquaboom adalah tempat sempurna untuk merayakan ulang tahun buah hati Anda! Paket grup ini sudah termasuk tiket masuk harga spesial, dekorasi, dan kue ulang tahun.
              </p>
              <div class="mb-6">
                <p class="text-xs font-black text-aqua-navy uppercase tracking-widest mb-3">Includes:</p>
                <ul class="space-y-2 text-sm text-slate-600 font-semibold">
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>10 tiket masuk dewasa/anak</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>1 gazebo + dekorasi ulang tahun</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>1 kue ulang tahun</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>10 minuman non-alkohol</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>1 special gift dari Aquaboom</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Voucher kredit Rp 200.000 in-park</li>
                </ul>
              </div>
              <div class="bg-aqua-cream rounded-xl p-4 mb-6 text-sm">
                <div class="flex justify-between items-center">
                  <span class="text-aqua-navy font-black">Harga Paket</span>
                  <span class="text-aqua-gold text-xl font-black">Rp 1.800.000</span>
                </div>
                <p class="text-slate-400 text-xs font-semibold mt-2 italic">Min. booking 3 hari sebelum kunjungan. Valid s.d. 31 Des 2026.</p>
              </div>
            </div>
            <a href="mailto:info@aquaboombsb.com?subject=Saya ingin tahu lebih lanjut tentang Birthday Package di Aquaboom!" class="block w-full text-center bg-aqua-gold hover:bg-aqua-gold-2 text-white font-black py-4 rounded-xl text-sm uppercase tracking-wider transition-all">
              Enquire Now
            </a>
          </div>
        </div>

        <!-- Package 4: Annual Pass -->
        <div class="bg-white rounded-[28px] overflow-hidden shadow-xl border border-slate-100 flex flex-col group hover:-translate-y-2 transition-all duration-300">
          <div class="relative h-64 overflow-hidden">
            <img src="https://picsum.photos/600/400?random=54" alt="Annual Pass" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
            <div class="absolute inset-0 bg-aqua-navy/75 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <p class="text-white text-base font-bold text-center px-6 mb-5">Unlimited thrills all year long!</p>
              <a href="mailto:info@aquaboombsb.com?subject=Saya ingin tahu lebih lanjut tentang Annual Pass Aquaboom!" class="bg-white/20 hover:bg-aqua-gold border-2 border-white text-white font-black px-8 py-3 rounded-full text-sm uppercase tracking-wider transition-all">
                ENQUIRE NOW
              </a>
            </div>
            <div class="absolute top-4 left-4 bg-aqua-azure text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
              Annual Pass
            </div>
          </div>
          <div class="p-8 flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-2xl font-black text-aqua-navy mb-3 uppercase">Unlimited Annual Pass</h3>
              <p class="text-slate-600 font-semibold text-sm leading-relaxed mb-5">
                Untuk para pecinta wahana air! Beli Annual Pass dan kunjungi Aquaboom sesering yang Anda mau selama 12 bulan penuh!
              </p>
              <div class="mb-6">
                <p class="text-xs font-black text-aqua-navy uppercase tracking-widest mb-3">Includes:</p>
                <ul class="space-y-2 text-sm text-slate-600 font-semibold">
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Akses tak terbatas 12 bulan</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>1 handuk gratis per kunjungan</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>20% off untuk tambahan 4 teman per kunjungan</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>10% off gazebo, locker & merchandise</li>
                </ul>
              </div>
              <div class="bg-aqua-cream rounded-xl p-4 mb-6 text-sm">
                <div class="flex justify-between items-center mb-1">
                  <span class="text-aqua-navy font-black">Dewasa</span>
                  <span class="text-aqua-gold font-black text-lg">Rp 780.000</span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-aqua-navy font-black">Anak (2-11 th)</span>
                  <span class="text-aqua-gold font-black text-lg">Rp 660.000</span>
                </div>
              </div>
            </div>
            <a href="mailto:info@aquaboombsb.com?subject=Saya ingin tahu lebih lanjut tentang Annual Pass Aquaboom!" class="block w-full text-center bg-aqua-azure hover:bg-aqua-azure-2 text-white font-black py-4 rounded-xl text-sm uppercase tracking-wider transition-all">
              Enquire Now
            </a>
          </div>
        </div>

        <!-- Package 5: Return Day Pass -->
        <div class="bg-white rounded-[28px] overflow-hidden shadow-xl border border-slate-100 flex flex-col group hover:-translate-y-2 transition-all duration-300">
          <div class="relative h-64 overflow-hidden">
            <img src="https://picsum.photos/600/400?random=55" alt="Return Day Pass" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
            <div class="absolute inset-0 bg-aqua-navy/75 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <p class="text-white text-base font-bold text-center px-6 mb-5">Because one visit is never enough!</p>
              <a href="{{ url('/ticket') }}" class="bg-white/20 hover:bg-aqua-gold border-2 border-white text-white font-black px-8 py-3 rounded-full text-sm uppercase tracking-wider transition-all">
                SEE TICKETS
              </a>
            </div>
            <div class="absolute top-4 left-4 bg-aqua-gold text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
              Save 15%
            </div>
          </div>
          <div class="p-8 flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-2xl font-black text-aqua-navy mb-3 uppercase">Return Day Pass</h3>
              <p class="text-slate-600 font-semibold text-sm leading-relaxed mb-5">
                Hemat lebih dari 15% untuk kunjungan kedua Anda dalam 7 hari! Karena sekali saja tidak pernah cukup!
              </p>
              <div class="mb-6">
                <p class="text-xs font-black text-aqua-navy uppercase tracking-widest mb-3">Ketentuan:</p>
                <ul class="space-y-2 text-sm text-slate-600 font-semibold">
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Hanya bisa dibeli di loket dalam taman</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Digunakan oleh pemilik tiket sama dalam 7 hari</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Tidak dapat dipindahtangankan & non-refundable</li>
                </ul>
              </div>
              <div class="bg-aqua-cream rounded-xl p-4 mb-6 text-sm">
                <div class="flex justify-between items-center mb-1">
                  <span class="text-aqua-navy font-black">Dewasa</span>
                  <span class="text-aqua-gold font-black text-lg">Rp 63.000</span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-aqua-navy font-black">Anak (2-11 th)</span>
                  <span class="text-aqua-gold font-black text-lg">Rp 50.000</span>
                </div>
              </div>
            </div>
            <a href="{{ url('/ticket') }}" class="block w-full text-center bg-aqua-navy hover:bg-black text-white font-black py-4 rounded-xl text-sm uppercase tracking-wider transition-all">
              View Tickets
            </a>
          </div>
        </div>

        <!-- Package 6: Corporate / Group -->
        <div class="bg-aqua-navy rounded-[28px] overflow-hidden shadow-xl flex flex-col group hover:-translate-y-2 transition-all duration-300">
          <div class="relative h-64 overflow-hidden">
            <img src="https://picsum.photos/600/400?random=56" alt="Corporate Group" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-70" />
            <div class="absolute inset-0 bg-gradient-to-t from-waterbom-dark via-transparent to-transparent"></div>
            <div class="absolute bottom-6 left-6">
              <span class="text-aqua-azure text-xs font-black uppercase tracking-widest">Corporate & Group</span>
            </div>
          </div>
          <div class="p-8 flex-1 flex flex-col justify-between">
            <div>
              <h3 class="text-2xl font-black text-white mb-3 uppercase">Custom Group Package</h3>
              <p class="text-white/70 font-semibold text-sm leading-relaxed mb-5">
                Paket sempurna untuk acara perusahaan, gathering tim, atau kunjungan bersama lebih dari 20 orang. Tim kami siap menyesuaikan paket dengan harga dan fasilitas spesial!
              </p>
              <div class="mb-6">
                <p class="text-xs font-black text-aqua-azure uppercase tracking-widest mb-3">Keunggulan:</p>
                <ul class="space-y-2 text-sm text-white/70 font-semibold">
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Harga spesial untuk 20+ orang</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Dedicated event coordinator</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Bisa custom makanan & minuman</li>
                  <li class="flex items-center gap-2"><svg class="w-4 h-4 text-aqua-azure shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Reservasi area eksklusif tersedia</li>
                </ul>
              </div>
              <div class="bg-white/10 rounded-xl p-4 mb-6">
                <p class="text-white/70 text-xs font-semibold italic">Hubungi kami untuk penawaran khusus sesuai kebutuhan grup Anda.</p>
              </div>
            </div>
            <a href="mailto:info@aquaboombsb.com?subject=Group Package Enquiry - Aquaboom" class="block w-full text-center bg-aqua-gold hover:bg-aqua-gold-2 text-white font-black py-4 rounded-xl text-sm uppercase tracking-wider transition-all">
              Enquire Now
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- CTA Bottom Section -->
  <section class="py-20 bg-aqua-cream border-t border-slate-200">
    <div class="max-w-3xl mx-auto px-6 text-center">
      <span class="text-aqua-azure text-xs font-black tracking-widest uppercase mb-3 block">Still Unsure?</span>
      <h2 class="text-3xl md:text-4xl font-black text-aqua-navy uppercase mb-4">NEED A CUSTOM PACKAGE?</h2>
      <p class="text-slate-600 font-semibold text-sm max-w-xl mx-auto mb-8">
        Tidak menemukan paket yang sesuai? Hubungi tim kami dan kami akan membantu menyusun paket eksklusif sesuai kebutuhan Anda.
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="mailto:info@aquaboombsb.com" class="inline-block bg-aqua-navy hover:bg-black text-white font-black px-10 py-4 rounded-xl uppercase tracking-wider text-sm transition-all">
          Email Us
        </a>
        <a href="{{ url('/book') }}" class="inline-block bg-aqua-gold hover:bg-aqua-gold-2 text-white font-black px-10 py-4 rounded-xl uppercase tracking-wider text-sm transition-all shadow-lg shadow-orange-500/20">
          Book Standard Tickets
        </a>
      </div>
    </div>
  </section>

</x-layout>
