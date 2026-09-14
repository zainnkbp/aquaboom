@props(['faqs'])

@php
    $rawWa = \App\Models\Setting::where('key', 'contact_whatsapp')->value('value') ?? '628115472233';
    $waClean = preg_replace('/[^0-9]/', '', $rawWa);
    if (str_starts_with($waClean, '0')) {
        $waClean = '62' . substr($waClean, 1);
    }
    $locale = App::getLocale();
    $waText = $locale === 'en'
        ? urlencode('Hello Customer Service Aquaboom, I am visiting the website and would like to ask some questions.')
        : urlencode('Halo Customer Service Aquaboom, saya sedang mengunjungi website dan ingin bertanya.');
    $waUrl = "https://wa.me/{$waClean}?text={$waText}";
@endphp

<div x-data="chatbotData(@js($faqs))" 
     x-init="initAssistant()"
     @sticky-price-bar-toggle.window="hasStickyBar = !!$event.detail.active; checkModals();"
     @cart-drawer-toggle.window="isCartDrawerOpen = !!$event.detail.open; checkModals();"
     @hide-chat-assistant.window="forceHidden = true; checkModals();"
     @show-chat-assistant.window="forceHidden = false; checkModals();"
     @open-wahana-modal.window="isWahanaModalOpen = true; checkModals();"
     @close-wahana-modal.window="isWahanaModalOpen = false; checkModals();"
     @keydown.escape.window="isWahanaModalOpen = false; isCartDrawerOpen = false; checkModals();"
     :class="isAssistantHidden() ? 'opacity-0 pointer-events-none scale-0 invisible' : 'opacity-100 scale-100 visible'"
     :style="isAssistantHidden() ? 'display: none !important;' : ''"
     class="fixed bottom-6 right-6 z-[60] font-sans flex flex-col items-end gap-3 transition-all duration-300 ease-out">
    
    <!-- Chat Window -->
    <div 
        x-show="isOpen" 
        x-transition:enter="transition ease-out duration-300 transform origin-bottom-right"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform origin-bottom-right"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        style="display: none; width: 360px; max-width: calc(100vw - 3rem);"
        class="bg-white rounded-[24px] shadow-2xl border border-slate-100 flex flex-col overflow-hidden max-h-[min(540px,calc(100vh-6.5rem))]"
    >
        <!-- Header -->
        <div class="bg-aqua-navy text-white p-4.5 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-aqua-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-black text-sm uppercase tracking-wide">Boomy Assistant</h3>
                    <p class="text-xs text-white/60 font-semibold">
                        {{ $locale === 'en' ? 'Always ready to help you' : 'Selalu siap membantu Anda' }}
                    </p>
                </div>
            </div>
            <!-- WhatsApp direct icon button in header -->
            <a 
                href="{{ $waUrl }}"
                target="_blank"
                rel="noopener noreferrer"
                class="p-2 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-xl shadow-sm transition-transform hover:scale-105 active:scale-95 flex items-center gap-1.5 text-xs font-bold"
                title="Chat via WhatsApp"
            >
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.301-.15-1.78-.878-2.056-.978-.276-.1-.476-.15-.677.15-.2.301-.777.978-.953 1.178-.175.2-.351.226-.652.075-.3-.15-1.268-.468-2.416-1.492-.894-.798-1.498-1.784-1.674-2.085-.175-.301-.019-.464.132-.614.136-.135.301-.351.452-.527.15-.175.2-.301.3-.501.1-.2.05-.376-.025-.527-.075-.15-.677-1.632-.928-2.235-.245-.588-.494-.508-.677-.517-.175-.01-.376-.01-.577-.01-.201 0-.527.075-.802.376-.276.301-1.053 1.028-1.053 2.508 0 1.48 1.078 2.909 1.229 3.11.15.201 2.122 3.24 5.141 4.544.718.31 1.279.496 1.716.635.721.229 1.377.197 1.896.12.578-.087 1.78-.728 2.031-1.431.251-.703.251-1.306.175-1.431-.075-.125-.276-.201-.577-.351zM12.04 2C6.52 2 2.04 6.48 2.04 12c0 1.98.58 3.82 1.58 5.37L2 22l4.78-1.55C8.28 21.36 10.1 22 12.04 22c5.52 0 10-4.48 10-10S17.56 2 12.04 2zm0 18.27c-1.75 0-3.38-.56-4.73-1.51l-.34-.24-2.84.92.94-2.76-.26-.37A8.22 8.22 0 013.77 12c0-4.56 3.71-8.27 8.27-8.27 4.56 0 8.27 3.71 8.27 8.27 0 4.56-3.71 8.27-8.27 8.27z"/>
                </svg>
                <span class="hidden sm:inline">WA CS</span>
            </a>
        </div>

        <!-- Chat History -->
        <div class="flex-1 p-5 h-[320px] max-h-[320px] min-h-[150px] overflow-y-auto bg-slate-50 flex flex-col gap-4 scroll-smooth" x-ref="chatContainer">
            
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

        <!-- Question Buttons & WhatsApp Help Link -->
        <div class="p-4 bg-white border-t border-slate-100 shrink-0">
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2.5 text-center">
                {{ $locale === 'en' ? 'Frequently Asked Questions' : 'Pertanyaan Sering Diajukan' }}
            </p>
            <div class="flex flex-col gap-2 max-h-36 overflow-y-auto pr-1">
                <template x-for="faq in faqs" :key="faq.id">
                    <button 
                        @click="askQuestion(faq)"
                        :disabled="isTyping"
                        class="w-full text-left text-xs sm:text-sm font-semibold text-aqua-navy bg-aqua-cream hover:bg-aqua-navy hover:text-aqua-gold transition-colors p-2.5 sm:p-3 rounded-xl border border-slate-100 disabled:opacity-50 disabled:cursor-not-allowed"
                        x-text="isEn && faq.question_en ? faq.question_en : faq.question"
                    ></button>
                </template>
            </div>

            <!-- WhatsApp Direct Redirect Button -->
            <div class="mt-3 pt-3 border-t border-slate-100">
                <a 
                    href="{{ $waUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="w-full flex items-center justify-center gap-2 py-2.5 px-3 bg-emerald-50 hover:bg-[#25D366] text-emerald-800 hover:text-white border border-emerald-200 hover:border-transparent rounded-xl text-xs font-bold transition-all duration-200 shadow-xs group"
                >
                    <svg class="w-4 h-4 fill-current shrink-0 text-[#25D366] group-hover:text-white transition-colors" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.301-.15-1.78-.878-2.056-.978-.276-.1-.476-.15-.677.15-.2.301-.777.978-.953 1.178-.175.2-.351.226-.652.075-.3-.15-1.268-.468-2.416-1.492-.894-.798-1.498-1.784-1.674-2.085-.175-.301-.019-.464.132-.614.136-.135.301-.351.452-.527.15-.175.2-.301.3-.501.1-.2.05-.376-.025-.527-.075-.15-.677-1.632-.928-2.235-.245-.588-.494-.508-.677-.517-.175-.01-.376-.01-.577-.01-.201 0-.527.075-.802.376-.276.301-1.053 1.028-1.053 2.508 0 1.48 1.078 2.909 1.229 3.11.15.201 2.122 3.24 5.141 4.544.718.31 1.279.496 1.716.635.721.229 1.377.197 1.896.12.578-.087 1.78-.728 2.031-1.431.251-.703.251-1.306.175-1.431-.075-.125-.276-.201-.577-.351zM12.04 2C6.52 2 2.04 6.48 2.04 12c0 1.98.58 3.82 1.58 5.37L2 22l4.78-1.55C8.28 21.36 10.1 22 12.04 22c5.52 0 10-4.48 10-10S17.56 2 12.04 2zm0 18.27c-1.75 0-3.38-.56-4.73-1.51l-.34-.24-2.84.92.94-2.76-.26-.37A8.22 8.22 0 013.77 12c0-4.56 3.71-8.27 8.27-8.27 4.56 0 8.27 3.71 8.27 8.27 0 4.56-3.71 8.27-8.27 8.27z"/>
                    </svg>
                    <span>
                        {{ $locale === 'en' ? 'Question not listed? Chat via WhatsApp ↗' : 'Pertanyaan tidak ada? Tanya via WA ↗' }}
                    </span>
                </a>
            </div>
        </div>
    </div>

    <!-- Stacked Floating Action Buttons (Support Hub) -->
    <div class="flex flex-col items-end gap-3">
        <!-- 1. Floating WhatsApp Button (Stacked above Boomy) -->
        <div class="relative group" x-show="!isOpen" x-transition:enter="transition ease-out duration-200" x-transition:leave="transition ease-in duration-150">
            <!-- Tooltip on Hover (Desktop) -->
            <div class="absolute right-full mr-3 top-1/2 -translate-y-1/2 hidden sm:group-hover:flex items-center pointer-events-none transition-all duration-200 opacity-0 group-hover:opacity-100 translate-x-2 group-hover:translate-x-0 z-10 whitespace-nowrap">
                <span class="bg-slate-900/95 backdrop-blur-xs text-white text-xs font-bold px-3 py-1.5 rounded-xl shadow-xl border border-slate-700/60 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#25D366] animate-ping"></span>
                    <span>{{ $locale === 'en' ? 'Chat Customer Service (WhatsApp)' : 'Chat CS via WhatsApp' }}</span>
                </span>
            </div>

            <a 
                href="{{ $waUrl }}"
                target="_blank"
                rel="noopener noreferrer"
                class="w-14 h-14 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all duration-300 ring-4 ring-[#25D366]/25 border-2 border-white cursor-pointer relative group-hover:shadow-[#25D366]/30"
                aria-label="Chat CS via WhatsApp"
            >
                <!-- Official WhatsApp Icon -->
                <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.472 14.382c-.301-.15-1.78-.878-2.056-.978-.276-.1-.476-.15-.677.15-.2.301-.777.978-.953 1.178-.175.2-.351.226-.652.075-.3-.15-1.268-.468-2.416-1.492-.894-.798-1.498-1.784-1.674-2.085-.175-.301-.019-.464.132-.614.136-.135.301-.351.452-.527.15-.175.2-.301.3-.501.1-.2.05-.376-.025-.527-.075-.15-.677-1.632-.928-2.235-.245-.588-.494-.508-.677-.517-.175-.01-.376-.01-.577-.01-.201 0-.527.075-.802.376-.276.301-1.053 1.028-1.053 2.508 0 1.48 1.078 2.909 1.229 3.11.15.201 2.122 3.24 5.141 4.544.718.31 1.279.496 1.716.635.721.229 1.377.197 1.896.12.578-.087 1.78-.728 2.031-1.431.251-.703.251-1.306.175-1.431-.075-.125-.276-.201-.577-.351zM12.04 2C6.52 2 2.04 6.48 2.04 12c0 1.98.58 3.82 1.58 5.37L2 22l4.78-1.55C8.28 21.36 10.1 22 12.04 22c5.52 0 10-4.48 10-10S17.56 2 12.04 2zm0 18.27c-1.75 0-3.38-.56-4.73-1.51l-.34-.24-2.84.92.94-2.76-.26-.37A8.22 8.22 0 013.77 12c0-4.56 3.71-8.27 8.27-8.27 4.56 0 8.27 3.71 8.27 8.27 0 4.56-3.71 8.27-8.27 8.27z"/>
                </svg>
                
                <!-- Online Green Dot Status -->
                <span class="absolute top-0 right-0 -mt-0.5 -mr-0.5 flex h-3.5 w-3.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-emerald-500 border-2 border-white"></span>
                </span>
            </a>
        </div>

        <!-- 2. Floating Boomy Assistant Button -->
        <div class="relative group">
            <!-- Tooltip on Hover (Desktop) -->
            <div class="absolute right-full mr-3 top-1/2 -translate-y-1/2 hidden sm:group-hover:flex items-center pointer-events-none transition-all duration-200 opacity-0 group-hover:opacity-100 translate-x-2 group-hover:translate-x-0 z-10 whitespace-nowrap">
                <span class="bg-slate-900/95 backdrop-blur-xs text-white text-xs font-bold px-3 py-1.5 rounded-xl shadow-xl border border-slate-700/60 flex items-center gap-2">
                    <span>🤖</span>
                    <span>{{ $locale === 'en' ? 'Boomy Chatbot Assistant' : 'Tanya Boomy (Chatbot)' }}</span>
                </span>
            </div>

            <button 
                @click="isOpen = !isOpen" 
                class="w-14 h-14 bg-aqua-navy rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all duration-300 ring-4 ring-aqua-navy/30 border-2 border-aqua-gold/50 cursor-pointer"
                :class="{'rotate-12': isOpen}"
                aria-label="Chat Assistant"
            >
                <!-- Closed state: Vibrant Yellow Chat Bubble Icon -->
                <svg x-show="!isOpen" class="w-7 h-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: block;">
                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.8214 2.48697 15.5291 3.33782 17L2.5 21.5L7 20.6622C8.47087 21.513 10.1786 22 12 22Z" fill="#F09628" stroke="#FBAB43" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="8" cy="12" r="1.3" fill="#160F30"/>
                    <circle cx="12" cy="12" r="1.3" fill="#160F30"/>
                    <circle cx="16" cy="12" r="1.3" fill="#160F30"/>
                </svg>

                <!-- Open state: Vibrant Yellow Close (X) Icon -->
                <svg x-show="isOpen" style="display: none;" class="w-7 h-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6l12 12" stroke="#F09628" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
    (function() {
        function getChatbotData(faqData) {
            return {
                isOpen: false,
                isTyping: false,
                hasStickyBar: false,
                isCartDrawerOpen: false,
                isWahanaModalOpen: false,
                forceHidden: false,
                isBodyModalActive: false,
                isEn: {{ App::getLocale() === 'en' ? 'true' : 'false' }},
                faqs: faqData || [],
                messages: [
                    { 
                        type: 'bot', 
                        text: {!! json_encode($locale === 'en' 
                            ? 'Hello! I am Boomy 🌊<br/>How can I help you today regarding Aquaboom Waterpark? Please select a question below, or tap the WhatsApp button if your question is not listed.' 
                            : 'Halo! Saya Boomy 🌊<br/>Ada yang bisa saya bantu terkait Aquaboom Waterpark? Silakan pilih pertanyaan di bawah ini, atau klik tombol WhatsApp jika pertanyaan Anda belum tercantum.') !!}
                    }
                ],

                initAssistant() {
                    this.checkModals();

                    if (window.MutationObserver) {
                        const observer = new MutationObserver(() => {
                            this.checkModals();
                        });
                        observer.observe(document.body, { 
                            attributes: true, 
                            childList: true, 
                            subtree: true, 
                            attributeFilter: ['class', 'style'] 
                        });
                    }

                    setInterval(() => {
                        this.checkModals();
                    }, 300);
                },

                checkModals() {
                    // Check 1: Body scroll locked by any modal, drawer, or popup
                    if (document.body.classList.contains('overflow-hidden')) {
                        this.isBodyModalActive = true;
                        if (this.isOpen) this.isOpen = false;
                        return;
                    }

                    // Check 2: Any active modal overlay or dialog present in DOM outside this assistant
                    const modalSelectors = [
                        '.fixed.inset-0',
                        '[role="dialog"]',
                        '[aria-modal="true"]',
                        '#doku-checkout-frame',
                        'iframe[id*="jokul"]',
                        '.swal2-container'
                    ];

                    let modalVisible = false;
                    for (const sel of modalSelectors) {
                        const elements = document.querySelectorAll(sel);
                        for (const el of elements) {
                            if (this.$el && this.$el.contains(el)) continue;

                            const style = window.getComputedStyle(el);
                            if (style.display !== 'none' && style.visibility !== 'hidden' && style.opacity !== '0') {
                                const rect = el.getBoundingClientRect();
                                if (rect.width > 150 && rect.height > 150) {
                                    modalVisible = true;
                                    break;
                                }
                            }
                        }
                        if (modalVisible) break;
                    }

                    this.isBodyModalActive = modalVisible;
                    if (modalVisible && this.isOpen) {
                        this.isOpen = false;
                    }
                },

                isAnyModalOpen() {
                    return this.isCartDrawerOpen || 
                           this.isWahanaModalOpen || 
                           this.forceHidden || 
                           this.isBodyModalActive;
                },

                isAssistantHidden() {
                    return this.hasStickyBar || 
                           this.isAnyModalOpen();
                },
                
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
