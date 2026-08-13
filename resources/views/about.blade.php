<x-layout>
  <x-slot:title>About Us - Aquaboom Waterpark</x-slot:title>
  
  <!-- Page Header (Waterbom Style) -->
  <div class="relative pt-40 pb-32 bg-aqua-navy flex items-center justify-center min-h-[500px] overflow-hidden">
      <div class="absolute inset-0 z-0">
          <img src="https://picsum.photos/1920/1080?random=20" alt="Aquaboom Aerial" class="w-full h-full object-cover opacity-35 mix-blend-overlay">
          <div class="absolute inset-0 bg-gradient-to-t from-waterbom-dark via-transparent to-transparent"></div>
      </div>
      <div class="relative z-10 max-w-4xl mx-auto px-6 text-center text-white">
          <span class="text-aqua-azure text-sm font-black tracking-widest uppercase mb-4 block">Our Story</span>
          <h1 class="text-5xl md:text-7xl font-black mb-6 uppercase tracking-tight">THE OASIS IN THE SKY</h1>
          <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto font-semibold leading-relaxed">
              Kisah di balik destinasi taman rekreasi air atap gedung terluas dan termegah di Kalimantan Timur.
          </p>
      </div>
  </div>

  <!-- Content -->
  <section class="py-24 bg-aqua-cream">
    <div class="max-w-5xl mx-auto px-6 lg:px-10">
        
        <div class="bg-white rounded-[32px] p-8 md:p-16 shadow-xl border border-slate-100 text-center mb-24 relative overflow-hidden">
            <div class="relative z-10">
                <span class="text-aqua-azure text-xs font-black uppercase tracking-widest mb-3 block">Corporate Mission</span>
                <h2 class="text-4xl font-black text-aqua-navy mb-8 uppercase">ELEVATING URBAN RECREATION</h2>
                <p class="text-slate-600 text-base font-semibold leading-relaxed mb-6">
                    {!! $settings['mission_text'] ?? 'Terletak dengan anggun di atap Pentacity Mall - Balikpapan Superblock, Aquaboom menghadirkan standar baru rekreasi air urban. Kami menggabungkan keseruan seluncuran berkelas internasional dengan aksesibilitas dan kemewahan gaya hidup modern.' !!}
                </p>
                <p class="text-slate-600 text-base font-semibold leading-relaxed mb-12">
                    Misi kami sederhana: menyajikan kebahagiaan tak terlupakan bagi keluarga dan pencinta petualangan dengan komitmen penuh pada aspek kebersihan, keramahan, dan keamanan bintang lima.
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center pt-12 border-t border-slate-100">
                    <div>
                        <span class="block text-5xl font-black text-aqua-azure mb-2">10+</span>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">World-Class Slides</span>
                    </div>
                    <div>
                        <span class="block text-5xl font-black text-[#3B82F6] mb-2">7th</span>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Floor Rooftop</span>
                    </div>
                    <div>
                        <span class="block text-5xl font-black text-aqua-gold mb-2">1</span>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Integrated Mall</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

  <!-- Sustainability Section (For /about#sustainability anchor link) -->
  <section id="sustainability" class="py-24 bg-aqua-navy text-white border-t border-b border-aqua-gold/20">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <span class="text-aqua-azure text-sm font-black tracking-widest uppercase mb-4 block">Karmic Returns</span>
      <h2 class="text-4xl md:text-5xl font-black uppercase mb-8 leading-tight">ENVIRONMENT & SUSTAINABILITY</h2>
      <p class="text-white/70 text-base font-semibold leading-relaxed max-w-2xl mx-auto mb-10">
          Seperti halnya filosofi menjaga bumi, Aquaboom berkomitmen menghemat air dan energi lewat sistem sirkulasi canggih serta mengurangi plastik sekali pakai di area taman air demi melestarikan alam sekitar kita.
      </p>
    </div>
  </section>


  <!-- Career Section -->
  <section id="career" class="py-24 bg-aqua-cream border-t border-slate-200">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <span class="text-aqua-azure text-sm font-black tracking-widest uppercase mb-4 block">Join Our Team</span>
      <h2 class="text-4xl md:text-5xl font-black text-aqua-navy uppercase mb-6">WE ARE HIRING!</h2>
      <p class="text-slate-600 text-base font-semibold leading-relaxed max-w-2xl mx-auto mb-10">
          Apakah Anda menyukai tantangan, keramahan, dan bekerja dalam suasana ceria? Bergabunglah bersama keluarga besar Aquaboom untuk menciptakan momen luar biasa.
      </p>
      <a href="mailto:career@aquaboombsb.com" class="inline-block bg-aqua-gold hover:bg-aqua-gold-2 text-white font-black px-10 py-5 rounded-xl shadow-lg shadow-orange-500/20 uppercase tracking-wider text-sm transition-all">
          Contact Career Center
      </a>
    </div>
  </section>

</x-layout>
