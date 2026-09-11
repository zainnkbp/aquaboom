@props(['faqs'])

<div x-data="chatbotData(@js($faqs))" 
     @sticky-price-bar-toggle.window="hasStickyBar = !!$event.detail.active"
     @cart-drawer-toggle.window="isCartDrawerOpen = !!$event.detail.open"
     :style="hasStickyBar ? 'transform: translateY(-80px);' : 'transform: translateY(0);'"
     :class="isCartDrawerOpen ? 'opacity-0 pointer-events-none scale-90' : 'opacity-100 scale-100'"
     class="fixed bottom-6 right-6 z-30 font-sans flex flex-col items-end gap-4 transition-all duration-300 ease-out">
    
    <!-- Chat Window -->
    <div 
        x-show="isOpen" 
        x-transition:enter="transition ease-out duration-300 transform origin-bottom-right"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform origin-bottom-right"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        style="display: none; width: 350px; max-width: calc(100vw - 3rem);"
        class="bg-white rounded-[24px] shadow-2xl border border-slate-100 flex flex-col overflow-hidden max-h-[calc(100vh-6rem)]"
    >
        <!-- Header -->
        <div class="bg-aqua-navy text-white p-5 flex items-center gap-3 shrink-0">
            <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-black text-sm uppercase tracking-wide">Boomy Assistant</h3>
                <p class="text-xs text-white/60 font-semibold">
                    {{ App::getLocale() === 'en' ? 'Always ready to help you' : 'Selalu siap membantu Anda' }}
                </p>
            </div>
        </div>

        <!-- Chat History -->
        <div class="flex-1 p-5 h-[350px] max-h-[350px] min-h-[150px] overflow-y-auto bg-slate-50 flex flex-col gap-4 scroll-smooth" x-ref="chatContainer">
            
            <template x-for="(msg, index) in messages" :key="index">
                <div class="flex flex-col w-full">
                    <div class="flex flex-col max-w-[85%]" :class="msg.type === 'user' ? 'items-end self-end' : 'items-start'">
                        <div 
                            class="text-sm font-medium rounded-2xl px-4 py-3 leading-relaxed"
                            :class="msg.type === 'user' ? 'bg-aqua-navy text-white rounded-tr-sm' : 'bg-white border border-slate-100 shadow-sm text-slate-700 rounded-tl-sm'"
                            x-html="msg.text"
                        ></div>
                    </div>
                </div>
            </template>
            
            <!-- Typing Indicator -->
            <div x-show="isTyping" class="flex flex-col items-start max-w-[85%]">
                <div class="bg-white border border-slate-100 shadow-sm rounded-2xl rounded-tl-sm px-4 py-3 flex items-center gap-1">
                    <div class="w-1.5 h-1.5 bg-slate-300 rounded-full animate-bounce"></div>
                    <div class="w-1.5 h-1.5 bg-slate-300 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    <div class="w-1.5 h-1.5 bg-slate-300 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                </div>
            </div>

        </div>

        <!-- Question Buttons -->
        <div class="p-4 bg-white border-t border-slate-100 shrink-0">
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-3 text-center">
                {{ App::getLocale() === 'en' ? 'Select a Question' : 'Pilih Pertanyaan' }}
            </p>
            <div class="flex flex-col gap-2 max-h-40 overflow-y-auto pr-1">
                <template x-for="faq in faqs" :key="faq.id">
                    <button 
                        @click="askQuestion(faq)"
                        :disabled="isTyping"
                        class="w-full text-left text-sm font-semibold text-aqua-navy bg-aqua-cream hover:bg-aqua-navy hover:text-aqua-gold transition-colors p-3 rounded-xl border border-slate-100 disabled:opacity-50 disabled:cursor-not-allowed"
                        x-text="isEn && faq.question_en ? faq.question_en : faq.question"
                    ></button>
                </template>
            </div>
        </div>
    </div>

    <!-- Floating Button -->
    <button 
        @click="isOpen = !isOpen" 
        class="w-16 h-16 bg-aqua-navy rounded-full shadow-2xl flex items-center justify-center hover:scale-105 transition-all duration-300 ring-4 ring-aqua-navy/30 border-2 border-aqua-gold/50 cursor-pointer"
        :class="{'rotate-12': isOpen}"
        aria-label="Chat Assistant"
    >
        <!-- Closed state: Vibrant Yellow Chat Bubble Icon -->
        <svg x-show="!isOpen" class="w-8 h-8" width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: block;">
            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.8214 2.48697 15.5291 3.33782 17L2.5 21.5L7 20.6622C8.47087 21.513 10.1786 22 12 22Z" fill="#F09628" stroke="#FBAB43" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="8" cy="12" r="1.3" fill="#160F30"/>
            <circle cx="12" cy="12" r="1.3" fill="#160F30"/>
            <circle cx="16" cy="12" r="1.3" fill="#160F30"/>
        </svg>

        <!-- Open state: Vibrant Yellow Close (X) Icon -->
        <svg x-show="isOpen" style="display: none;" class="w-8 h-8" width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 18L18 6M6 6l12 12" stroke="#F09628" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
</div>

<script>
    (function() {
        function getChatbotData(faqData) {
            return {
                isOpen: false,
                isTyping: false,
                hasStickyBar: false,
                isCartDrawerOpen: false,
                isEn: {{ App::getLocale() === 'en' ? 'true' : 'false' }},
                faqs: faqData || [],
                messages: [
                    { 
                        type: 'bot', 
                        text: {!! json_encode(App::getLocale() === 'en' ? 'Hello! I am Boomy 🌊<br/>How can I help you today regarding Aquaboom Waterpark? Please select a question below.' : 'Halo! Saya Boomy 🌊<br/>Ada yang bisa saya bantu terkait Aquaboom Waterpark? Silakan pilih pertanyaan di bawah ini.') !!}
                    }
                ],
                
                askQuestion(faq) {
                    const questionText = this.isEn && faq.question_en ? faq.question_en : faq.question;
                    const answerText = this.isEn && faq.answer_en ? faq.answer_en : faq.answer;

                    // Add user message
                    this.messages.push({ type: 'user', text: questionText });
                    
                    // Scroll to bottom
                    this.scrollToBottom();
                    
                    // Show typing indicator
                    this.isTyping = true;
                    
                    // Simulate delay
                    setTimeout(() => {
                        this.isTyping = false;
                        this.messages.push({ type: 'bot', text: answerText });
                        this.scrollToBottom();
                    }, 1000);
                },
                
                scrollToBottom() {
                    setTimeout(() => {
                        const container = this.$refs.chatContainer;
                        if (container) {
                            container.scrollTop = container.scrollHeight;
                        }
                    }, 50);
                }
            };
        }

        window.chatbotData = getChatbotData;

        if (window.Alpine) {
            window.Alpine.data('chatbotData', getChatbotData);
        } else {
            document.addEventListener('alpine:init', function() {
                Alpine.data('chatbotData', getChatbotData);
            });
        }
    })();
</script>
