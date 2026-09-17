<x-layout>
    <x-slot:title>{{ App::getLocale() === 'en' ? 'About Us - Aquaboom Waterpark' : 'Tentang Kami - Aquaboom Waterpark' }}</x-slot:title>

    <!-- Page Header (Waterbom Style) -->
    <div class="relative pt-40 pb-32 bg-aqua-navy flex items-center justify-center min-h-[500px] overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/img/aquaboom_about.jpeg') }}" alt="Aquaboom Aerial"
                class="w-full h-full object-cover opacity-35 mix-blend-overlay">
            <div class="absolute inset-0 bg-gradient-to-t from-waterbom-dark via-transparent to-transparent"></div>
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center text-white">
            <span class="text-aqua-azure text-sm font-black tracking-widest uppercase mb-4 block">{{ App::getLocale() === 'en' ? 'Our Story' : 'Kisah Kami' }}</span>
            <h1 class="text-5xl md:text-7xl font-black mb-6 uppercase tracking-tight">{{ App::getLocale() === 'en' ? 'THE WATERPARK OASIS' : 'OASIS REKREASI AIR' }}</h1>
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto font-semibold leading-relaxed">
                {{ App::getLocale() === 'en'
                    ? 'The story behind Balikpapan\'s premier waterpark destination at Astara Hotel & Pentacity Hotel.'
                    : 'Kisah di balik destinasi taman rekreasi air premium pilihan di Balikpapan (7F - Shared Common Area for Astara Hotel & Pentacity Hotel).' }}
            </p>
        </div>
    </div>

    <!-- Content -->
    <section class="py-24 bg-aqua-cream">
        <div class="max-w-5xl mx-auto px-6 lg:px-10">

            <div
                class="bg-white rounded-[32px] p-8 md:p-16 shadow-xl border border-slate-100 text-center mb-24 relative overflow-hidden">
                <div class="relative z-10">
                    <span class="text-aqua-azure text-xs font-black uppercase tracking-widest mb-3 block">{{ App::getLocale() === 'en' ? 'Corporate Mission' : 'Misi Perusahaan' }}</span>
                    <h2 class="text-4xl font-black text-aqua-navy mb-8 uppercase">{{ App::getLocale() === 'en' ? 'ELEVATING URBAN RECREATION' : 'STANDAR BARU REKREASI URBAN' }}</h2>
                    <p class="text-slate-600 text-base font-semibold leading-relaxed mb-6">
                        {!! App::getLocale() === 'en' && !empty($settings['mission_text_en']) ? $settings['mission_text_en'] : ($settings['mission_text'] ?? 'Terletak di Lantai 7 (Shared Common Area Astara Hotel & Pentacity Hotel) - Balikpapan Superblock, Aquaboom menghadirkan standar baru rekreasi air perkotaan di Balikpapan. Kami menggabungkan keseruan seluncuran berkelas internasional dengan aksesibilitas dan kemewahan gaya hidup modern.') !!}
                    </p>
                    <p class="text-slate-600 text-base font-semibold leading-relaxed mb-12">
                        {{ App::getLocale() === 'en' 
                            ? 'Our mission is simple: to deliver unforgettable happiness to families and adventure lovers with a full commitment to hygiene, hospitality, and five-star safety.' 
                            : 'Misi kami sederhana: menyajikan kebahagiaan tak terlupakan bagi keluarga dan pencinta petualangan dengan komitmen penuh pada aspek kebersihan, keramahan, dan keamanan bintang lima.' }}
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center pt-12 border-t border-slate-100">
                        <div>
                            <span class="block text-5xl font-black text-aqua-azure mb-2">10+</span>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                                {{ App::getLocale() === 'en' ? 'World-Class Slides' : 'Seluncuran Kelas Dunia' }}
                            </span>
                        </div>
                        <div>
                            <span class="block text-5xl font-black text-[#3B82F6] mb-2">7F</span>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                                {{ App::getLocale() === 'en' ? 'Shared Common Area' : 'Shared Common Area' }}
                            </span>
                        </div>
                        <div>
                            <span class="block text-5xl font-black text-aqua-gold mb-2">1</span>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                                {{ App::getLocale() === 'en' ? 'Integrated Mall' : 'Mall Terintegrasi' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sustainability Section (For /about#sustainability anchor link) -->
    <section id="sustainability" class="py-24 bg-aqua-navy text-white border-t border-b border-aqua-gold/20">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <span class="text-aqua-azure text-sm font-black tracking-widest uppercase mb-4 block">{{ App::getLocale() === 'en' ? 'Eco Commitment' : 'Komitmen Lingkungan' }}</span>
            <h2 class="text-4xl md:text-5xl font-black uppercase mb-8 leading-tight">{{ App::getLocale() === 'en' ? 'ENVIRONMENT & SUSTAINABILITY' : 'LINGKUNGAN & KEBERLANJUTAN' }}</h2>
            <p class="text-white/70 text-base font-semibold leading-relaxed max-w-2xl mx-auto mb-10">
                {{ App::getLocale() === 'en'
                    ? 'Aquaboom is committed to conserving water and energy through advanced circulation systems, while actively reducing single-use plastics across the waterpark area to protect our environment.'
                    : 'Seperti halnya filosofi menjaga bumi, Aquaboom berkomitmen menghemat air dan energi lewat sistem sirkulasi canggih serta mengurangi plastik sekali pakai di area taman air demi melestarikan alam sekitar kita.' }}
            </p>
        </div>
    </section>

    <!-- Career Section -->
    <section id="career" class="py-24 bg-aqua-cream border-t border-slate-200">
        <div class="max-w-4xl mx-auto px-6 text-center">
            @php
                $rawWa = \App\Models\Setting::where('key', 'contact_whatsapp')->value('value') ?? '628115472233';
                $waClean = preg_replace('/[^0-9]/', '', $rawWa);
                if (str_starts_with($waClean, '0')) {
                    $waClean = '62' . substr($waClean, 1);
                }
                $locale = App::getLocale();
                $careerWaText = $locale === 'en'
                    ? urlencode('Hello Aquaboom HR / Career Team, I am interested in career opportunities and would like to ask about available job vacancies.')
                    : urlencode('Halo Tim HRD / Karir Aquaboom, saya tertarik untuk bergabung dan ingin menanyakan informasi lowongan kerja yang tersedia di Aquaboom Waterpark.');
                $careerWaUrl = "https://wa.me/{$waClean}?text={$careerWaText}";
            @endphp
            <span class="text-aqua-azure text-sm font-black tracking-widest uppercase mb-4 block">{{ App::getLocale() === 'en' ? 'Join Our Team' : 'Karir & Peluang' }}</span>
            <h2 class="text-4xl md:text-5xl font-black text-aqua-navy uppercase mb-6">{{ App::getLocale() === 'en' ? 'WE ARE HIRING!' : 'KAMI MEMBUKA LOWONGAN!' }}</h2>
            <p class="text-slate-600 text-base font-semibold leading-relaxed max-w-2xl mx-auto mb-10">
                {{ App::getLocale() === 'en'
                    ? 'Do you love challenges, warm hospitality, and working in an energetic, cheerful atmosphere? Join the Aquaboom family to create wonderful moments.'
                    : 'Apakah Anda menyukai tantangan, keramahan, dan bekerja dalam suasana ceria? Bergabunglah bersama keluarga besar Aquaboom untuk menciptakan momen luar biasa.' }}
            </p>
            <a href="{{ $careerWaUrl }}"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center justify-center gap-3 bg-aqua-gold hover:bg-aqua-gold-2 text-aqua-navy font-black px-10 py-5 rounded-2xl shadow-xl shadow-orange-500/20 uppercase tracking-wider text-sm transition-all hover:scale-105 active:scale-95 cursor-pointer">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.472 14.382c-.301-.15-1.78-.878-2.056-.978-.276-.1-.476-.15-.677.15-.2.301-.777.978-.953 1.178-.175.2-.351.226-.652.075-.3-.15-1.268-.468-2.416-1.492-.894-.798-1.498-1.784-1.674-2.085-.175-.301-.019-.464.132-.614.136-.135.301-.351.452-.527.15-.175.2-.301.3-.501.1-.2.05-.376-.025-.527-.075-.15-.677-1.632-.928-2.235-.245-.588-.494-.508-.677-.517-.175-.01-.376-.01-.577-.01-.201 0-.527.075-.802.376-.276.301-1.053 1.028-1.053 2.508 0 1.48 1.078 2.909 1.229 3.11.15.201 2.122 3.24 5.141 4.544.718.31 1.279.496 1.716.635.721.229 1.377.197 1.896.12.578-.087 1.78-.728 2.031-1.431.251-.703.251-1.306.175-1.431-.075-.125-.276-.201-.577-.351zM12.04 2C6.52 2 2.04 6.48 2.04 12c0 1.98.58 3.82 1.58 5.37L2 22l4.78-1.55C8.28 21.36 10.1 22 12.04 22c5.52 0 10-4.48 10-10S17.56 2 12.04 2zm0 18.27c-1.75 0-3.38-.56-4.73-1.51l-.34-.24-2.84.92.94-2.76-.26-.37A8.22 8.22 0 013.77 12c0-4.56 3.71-8.27 8.27-8.27 4.56 0 8.27 3.71 8.27 8.27 0 4.56-3.71 8.27-8.27 8.27z"/>
                </svg>
                <span>{{ App::getLocale() === 'en' ? 'Contact Career Center (WhatsApp)' : 'Hubungi Tim Karir via WhatsApp' }}</span>
            </a>
        </div>
    </section>

</x-layout>