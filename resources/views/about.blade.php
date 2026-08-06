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

  <!-- Awards Section -->
  <section id="awards" class="py-24 bg-aqua-cream">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
      <div class="text-center mb-16">
        <span class="text-aqua-azure text-xs font-black tracking-widest uppercase mb-3 block">Excellence Recognized</span>
        <h2 class="text-4xl md:text-6xl font-black text-aqua-navy uppercase">OUR AWARDS</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
          @foreach($awards as $award)
          <div class="bg-white p-10 rounded-[32px] text-center shadow-lg border border-slate-100 hover:shadow-2xl transition-all duration-300">
              <div class="w-16 h-16 mx-auto bg-amber-50 rounded-2xl flex items-center justify-center mb-6 text-amber-500">
                  <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      @if($award->icon === 'rooftop')
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                      @elseif($award->icon === 'hospitality')
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                      @else
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                      @endif
                  </svg>
              </div>
              <h3 class="text-xl font-black text-aqua-navy mb-3 uppercase">{{ $award->title }}</h3>
              <p class="text-slate-600 text-sm font-semibold leading-relaxed">{{ $award->description }}</p>
          </div>
          @endforeach
      </div>
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
