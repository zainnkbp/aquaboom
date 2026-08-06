<x-layout>
  <x-slot:title>FAQ - Aquaboom Waterpark</x-slot:title>
  
  <!-- Page Header (Waterbom Style) -->
  <div class="pt-36 pb-20 bg-aqua-cream border-b border-slate-200">
      <div class="max-w-4xl mx-auto px-6 text-center">
          <span class="text-aqua-azure text-sm font-black tracking-widest uppercase mb-4 block">
              {{ App::getLocale() === 'id' ? 'Pusat Bantuan' : 'Help Center' }}
          </span>
          <h1 class="text-5xl md:text-7xl font-black text-aqua-navy mb-6 uppercase tracking-tight">
              {{ App::getLocale() === 'id' ? 'ADA YANG BISA KAMI BANTU?' : 'HOW CAN WE HELP?' }}
          </h1>
          <p class="text-lg md:text-xl text-slate-600 font-semibold leading-relaxed">
              {{ App::getLocale() === 'id' ? 'Temukan jawaban untuk berbagai pertanyaan umum sebelum Anda berkunjung ke taman air kami.' : 'Find answers to common questions before you visit our waterpark.' }}
          </p>
      </div>
  </div>

  <!-- Content (Accordion) -->
  <section class="py-24 bg-aqua-cream min-h-[600px]">
    <div class="max-w-4xl mx-auto px-6">
        
        <div class="space-y-6" x-data="{ activeAccordion: null }">
            
            @foreach($faqs as $faq)
            <div class="bg-white rounded-[24px] overflow-hidden shadow-md border border-slate-100 transition-all duration-300">
                <button @click="activeAccordion = activeAccordion === {{ $faq->id }} ? null : {{ $faq->id }}" class="w-full px-8 py-6 flex justify-between items-center text-left focus:outline-none group">
                    <span class="font-black text-aqua-navy text-xl uppercase tracking-tight">
                        {{ App::getLocale() === 'en' && $faq->question_en ? $faq->question_en : $faq->question }}
                    </span>
                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-aqua-azure transition-colors group-hover:bg-aqua-azure group-hover:text-white" :class="{'bg-aqua-azure text-white': activeAccordion === {{ $faq->id }}}">
                        <svg class="w-5 h-5 transform transition-transform duration-300" :class="{'rotate-180': activeAccordion === {{ $faq->id }}}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </button>
                <div x-show="activeAccordion === {{ $faq->id }}" x-collapse>
                    <div class="px-8 pb-8 pt-2">
                        <div class="w-full h-px bg-slate-100 mb-6"></div>
                        <p class="text-slate-600 text-sm font-semibold leading-relaxed">
                            {{ App::getLocale() === 'en' && $faq->answer_en ? $faq->answer_en : $faq->answer }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
  </section>

</x-layout>
