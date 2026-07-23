<div class="min-h-screen bg-slate-900 flex flex-col p-4 relative" x-data="scannerApp()" x-init="initScanner()">
    
    {{-- Header --}}
    <header class="flex justify-between items-center bg-slate-800 p-4 rounded-2xl shadow-lg border border-slate-700 mb-4">
        <div>
            <h1 class="text-xl font-bold text-white">Scanner Tiket</h1>
            <p class="text-xs text-slate-400">Pintu Masuk Aquaboom</p>
        </div>
        <button wire:click="logout" class="bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors">
            Keluar
        </button>
    </header>

    {{-- Main Scanner Area --}}
    <main class="flex-1 flex flex-col items-center justify-center">
        
        {{-- Default State: Camera View --}}
        @if(!$scanResult)
            <div class="w-full max-w-sm bg-slate-800 rounded-3xl overflow-hidden shadow-2xl border border-slate-700 relative">
                <div id="reader" class="w-full bg-black aspect-[3/4]"></div>
                
                {{-- Fallback Manual Input --}}
                <div class="p-4 border-t border-slate-700">
                    <p class="text-xs text-center text-slate-400 mb-2">Kamera bermasalah? Ketik manual:</p>
                    <div class="flex gap-2">
                        <input type="text" wire:model="orderId" placeholder="Order ID..." class="flex-1 bg-slate-900 border border-slate-700 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-blue-500">
                        <button wire:click="processScan($wire.orderId)" class="bg-blue-600 text-white px-4 py-2 rounded-xl font-medium">Cek</button>
                    </div>
                </div>
            </div>
        @endif

        {{-- Success State --}}
        @if($scanResult === 'success')
            <div class="w-full max-w-sm bg-green-500 rounded-3xl p-8 shadow-2xl text-center text-white transform transition-all scale-105">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white/20 mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-3xl font-black mb-2">VALID!</h2>
                <p class="text-green-100 text-lg mb-6">Silakan Masuk</p>
                
                <div class="bg-black/20 rounded-2xl p-4 mb-8 text-left">
                    <p class="text-sm text-green-100 mb-1">Nama Pemesan:</p>
                    <p class="font-bold text-lg mb-3">{{ $ticketDetails['customer'] }}</p>
                    
                    <p class="text-sm text-green-100 mb-1">Total Masuk:</p>
                    <p class="font-black text-4xl mb-2">{{ $ticketDetails['total'] }} ORANG</p>
                    
                    <p class="text-xs text-green-200 border-t border-green-400/30 pt-2 mt-2">
                        Detail: {{ $ticketDetails['items'] }}
                    </p>
                </div>

                <button wire:click="resetScan" class="w-full bg-white text-green-600 font-bold text-lg py-4 rounded-xl shadow-lg hover:bg-green-50 transition-colors">
                    SCAN TIKET SELANJUTNYA
                </button>
            </div>
        @endif

        {{-- Error State --}}
        @if($scanResult && $scanResult !== 'success')
            <div class="w-full max-w-sm bg-red-500 rounded-3xl p-8 shadow-2xl text-center text-white transform transition-all scale-105">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white/20 mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
                <h2 class="text-3xl font-black mb-2">DITOLAK!</h2>
                <p class="text-red-100 text-lg mb-6">{{ $errorMessage }}</p>
                
                <button wire:click="resetScan" class="w-full bg-white text-red-600 font-bold text-lg py-4 rounded-xl shadow-lg hover:bg-red-50 transition-colors">
                    COBA LAGI
                </button>
            </div>
        @endif

    </main>

    {{-- Script for Scanner --}}
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('scannerApp', () => ({
                html5QrcodeScanner: null,
                
                initScanner() {
                    this.$nextTick(() => {
                        this.startCamera();
                    });
                },

                startCamera() {
                    const reader = document.getElementById('reader');
                    if (!reader) return;

                    if (this.html5QrcodeScanner) {
                        this.html5QrcodeScanner.clear();
                    }

                    this.html5QrcodeScanner = new Html5QrcodeScanner(
                        "reader",
                        { fps: 10, qrbox: {width: 250, height: 250} },
                        /* verbose= */ false);
                        
                    this.html5QrcodeScanner.render((decodedText) => {
                        // On Success
                        if (this.html5QrcodeScanner) {
                            this.html5QrcodeScanner.clear();
                        }
                        this.$wire.processScan(decodedText);
                    }, (error) => {
                        // Ignore continuous scan errors
                    });
                }
            }));
        });

        // Listen for reset event from Livewire
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('restart-scanner', () => {
                // Alpine init will handle it because DOM element 'reader' returns
                setTimeout(() => {
                    const alpineData = document.querySelector('[x-data="scannerApp()"]');
                    if(alpineData) {
                        alpineData.__x.$data.startCamera();
                    }
                }, 100);
            });
        });
    </script>
    
    <style>
        /* Override html5-qrcode styles to make it look dark mode */
        #reader { border: none !important; border-radius: 1.5rem 1.5rem 0 0; overflow: hidden; }
        #reader__dashboard_section_csr span { color: white !important; }
        #reader button { background: #3b82f6 !important; color: white !important; border-radius: 0.5rem !important; border: none !important; padding: 0.5rem 1rem !important; margin: 0.5rem 0 !important; font-weight: bold; cursor: pointer; }
        #reader select { background: #1e293b !important; color: white !important; border: 1px solid #334155 !important; border-radius: 0.5rem !important; padding: 0.5rem !important; }
    </style>
</div>
