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

{{-- Floating WhatsApp CS Button (Bot Assistant is temporarily hidden) --}}
<div x-data="floatingWaData()" 
     x-init="initFloating()"
     @sticky-price-bar-toggle.window="hasStickyBar = !!$event.detail.active; checkModals();"
     @cart-drawer-toggle.window="isCartDrawerOpen = !!$event.detail.open; checkModals();"
     @hide-chat-assistant.window="forceHidden = true; checkModals();"
     @show-chat-assistant.window="forceHidden = false; checkModals();"
     @open-wahana-modal.window="isWahanaModalOpen = true; checkModals();"
     @close-wahana-modal.window="isWahanaModalOpen = false; checkModals();"
     @keydown.escape.window="isWahanaModalOpen = false; isCartDrawerOpen = false; checkModals();"
     :class="isWidgetHidden() ? 'opacity-0 pointer-events-none scale-0 invisible' : 'opacity-100 scale-100 visible'"
     :style="isWidgetHidden() ? 'display: none !important;' : ''"
     class="fixed bottom-6 right-6 z-[60] font-sans flex flex-col items-end gap-3 transition-all duration-300 ease-out">
    
    <!-- Floating WhatsApp Button -->
    <div class="relative group">
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
</div>

<script>
    (function() {
        function getFloatingWaData() {
            return {
                hasStickyBar: false,
                isCartDrawerOpen: false,
                isWahanaModalOpen: false,
                forceHidden: false,
                isBodyModalActive: false,

                initFloating() {
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
                    if (document.body.classList.contains('overflow-hidden')) {
                        this.isBodyModalActive = true;
                        return;
                    }

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
                },

                isAnyModalOpen() {
                    return this.isCartDrawerOpen || 
                           this.isWahanaModalOpen || 
                           this.forceHidden || 
                           this.isBodyModalActive;
                },

                isWidgetHidden() {
                    return this.hasStickyBar || 
                           this.isAnyModalOpen();
                }
            };
        }

        window.floatingWaData = getFloatingWaData;
        window.chatbotData = getFloatingWaData; // Backward compatibility

        if (window.Alpine) {
            window.Alpine.data('floatingWaData', getFloatingWaData);
            window.Alpine.data('chatbotData', getFloatingWaData);
        } else {
            document.addEventListener('alpine:init', function() {
                Alpine.data('floatingWaData', getFloatingWaData);
                Alpine.data('chatbotData', getFloatingWaData);
            });
        }
    })();
</script>
