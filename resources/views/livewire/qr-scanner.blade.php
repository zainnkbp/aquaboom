<div class="min-h-screen bg-slate-950 flex flex-col justify-between p-3 sm:p-5 relative select-none" 
     x-data="scannerApp()" 
     x-init="initScanner()"
     @restart-scanner.window="restart()">

    {{-- Top Bar / Header --}}
    <header class="w-full max-w-md mx-auto flex justify-between items-center bg-slate-900/90 backdrop-blur-md px-4 py-3 rounded-2xl border border-slate-800 shadow-xl z-20">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-amber-500 to-amber-400 flex items-center justify-center font-black text-slate-950 text-sm shadow-md shadow-amber-500/20">
                AQB
            </div>
            <div>
                <div class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full" :class="isCameraReady ? 'bg-emerald-400 animate-pulse' : 'bg-amber-400'"></span>
                    <h1 class="text-sm font-bold text-white tracking-wide">VALIDATOR LOKET</h1>
                </div>
                <p class="text-[11px] text-amber-400/90 font-medium">Petugas: {{ auth()->user()->name ?? 'Satpam' }}</p>
            </div>
        </div>

        <button wire:click="logout" class="bg-red-500/10 hover:bg-red-500/20 text-red-400 hover:text-red-300 px-3 py-1.5 rounded-xl text-xs font-bold transition-all border border-red-500/20 flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Keluar
        </button>
    </header>

    {{-- Main Viewfinder Section (wire:ignore ensures Livewire never breaks the camera feed) --}}
    <main class="w-full max-w-md mx-auto flex-1 flex flex-col items-center justify-center my-3 relative">
        
        {{-- Viewfinder Container (Always present in DOM) --}}
        <div class="w-full flex flex-col items-center">
            
            {{-- Native Camera Frame --}}
            <div class="w-full relative aspect-square sm:aspect-[4/5] max-h-[65vh] bg-black rounded-3xl overflow-hidden shadow-2xl border-2 border-slate-800/80">
                
                {{-- HTML5 Video Feed DOM Protected from Livewire DOM Morphing --}}
                <div wire:ignore class="w-full h-full">
                    <div id="reader" class="w-full h-full object-cover"></div>
                </div>

                {{-- Camera HUD & Laser Reticle Overlay --}}
                <div class="absolute inset-0 pointer-events-none flex flex-col items-center justify-center p-6 z-10">
                    
                    {{-- Central Target Frame --}}
                    <div class="w-64 h-64 sm:w-72 sm:h-72 relative flex items-center justify-center">
                        
                        {{-- Corner Brackets --}}
                        <div class="absolute top-0 left-0 w-8 h-8 border-t-4 border-l-4 border-amber-400 rounded-tl-xl shadow-lg shadow-amber-400/50"></div>
                        <div class="absolute top-0 right-0 w-8 h-8 border-t-4 border-r-4 border-amber-400 rounded-tr-xl shadow-lg shadow-amber-400/50"></div>
                        <div class="absolute bottom-0 left-0 w-8 h-8 border-b-4 border-l-4 border-amber-400 rounded-bl-xl shadow-lg shadow-amber-400/50"></div>
                        <div class="absolute bottom-0 right-0 w-8 h-8 border-b-4 border-r-4 border-amber-400 rounded-br-xl shadow-lg shadow-amber-400/50"></div>
                        
                        {{-- Animated Scanning Laser Line --}}
                        <div class="absolute inset-x-2 h-0.5 bg-gradient-to-r from-transparent via-amber-400 to-transparent shadow-[0_0_15px_#f59e0b] animate-scan"></div>
                        
                        {{-- Center subtle reticle --}}
                        <div class="w-12 h-12 border border-white/20 rounded-full flex items-center justify-center">
                            <div class="w-1.5 h-1.5 bg-amber-400 rounded-full animate-ping"></div>
                        </div>
                    </div>

                    {{-- Camera status instruction --}}
                    <div class="mt-6 bg-slate-950/80 backdrop-blur-md px-4 py-1.5 rounded-full border border-slate-700/60 shadow-lg">
                        <p class="text-xs font-semibold text-slate-300 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                            Posisikan QR Code di dalam kotak
                        </p>
                    </div>
                </div>

                {{-- Camera Loading / Permission Fallback --}}
                <div x-show="!isCameraReady" class="absolute inset-0 bg-slate-900/95 flex flex-col items-center justify-center p-6 text-center z-20">
                    <div class="w-12 h-12 border-4 border-amber-400/30 border-t-amber-400 rounded-full animate-spin mb-4"></div>
                    <p class="text-sm font-bold text-white">Menghubungkan Kamera...</p>
                    <p class="text-xs text-slate-400 mt-1 max-w-xs mb-4">Pastikan izin kamera telah diaktifkan di browser Anda.</p>
                    <button @click="restart()" 
                            type="button" 
                            class="bg-amber-400 hover:bg-amber-500 text-slate-950 font-black text-xs px-4 py-2 rounded-xl shadow-lg transition-all flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Refresh Kamera
                    </button>
                </div>
            </div>

            {{-- Camera Controls Action Bar --}}
            <div class="w-full flex items-center justify-between gap-2.5 mt-4 px-1">
                
                {{-- Switch Camera (Front/Back) Button --}}
                <button @click="switchCamera()" 
                        type="button"
                        class="flex-1 bg-slate-900 hover:bg-slate-800 active:scale-95 text-white font-bold py-3.5 px-3 rounded-2xl border border-slate-700 shadow-lg transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 text-amber-400 transition-transform duration-500" :class="{'rotate-180': isFrontCamera}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    <span class="text-xs font-extrabold uppercase tracking-wider" x-text="isFrontCamera ? 'Kamera Depan' : 'Kamera Belakang'"></span>
                </button>

                {{-- Quick Refresh Camera Button --}}
                <button @click="restart()" 
                        type="button"
                        title="Refresh / Muat Ulang Kamera"
                        class="bg-slate-900 hover:bg-slate-800 active:scale-95 text-amber-400 hover:text-amber-300 font-bold p-3.5 rounded-2xl border border-slate-700 shadow-lg transition-all flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </button>

                {{-- Toggle Manual Input Button --}}
                <button @click="showManualInput = !showManualInput; $nextTick(() => { if (showManualInput) $refs.manualInput.focus(); })" 
                        type="button"
                        title="Input Manual Order ID"
                        class="bg-slate-900 hover:bg-slate-800 active:scale-95 text-slate-300 font-bold p-3.5 rounded-2xl border border-slate-700 shadow-lg transition-all flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </button>
            </div>

            {{-- Collapsible Manual Input Drawer with Smart Mask --}}
            <div x-show="showManualInput" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="w-full bg-slate-900 p-4 rounded-2xl border border-slate-800 shadow-xl mt-3">
                <div class="flex justify-between items-center mb-2">
                    <p class="text-xs font-bold text-slate-300">Input Manual Kode Tiket:</p>
                    <span class="text-[10px] text-amber-400 font-mono">Format: AQB-XXXX-XXXX-XXXX</span>
                </div>
                <form @submit.prevent="submitManual()" class="flex gap-2">
                    <input type="text" 
                           x-ref="manualInput"
                           x-model="manualCode"
                           x-on:input="formatTicketInput($event)"
                           placeholder="AQB-XXXX-XXXX-XXXX" 
                           maxlength="18"
                           autocomplete="off"
                           autocorrect="off"
                           spellcheck="false"
                           class="flex-1 bg-slate-950 border border-slate-700 rounded-xl px-3 py-2.5 text-sm text-white font-mono placeholder:text-slate-600 focus:outline-none focus:border-amber-400 uppercase tracking-widest text-center font-bold">
                    <button type="submit" 
                            class="bg-amber-400 hover:bg-amber-500 text-slate-950 font-black px-5 py-2.5 rounded-xl text-sm transition-all active:scale-95">
                        Cek
                    </button>
                </form>
                <p class="text-[10px] text-slate-500 text-center mt-2">
                    Cukup ketik huruf/angka, tanda strip (-) dan huruf kapital akan terisi otomatis.
                </p>
            </div>

        </div>

        {{-- Success State Modal Overlay (Appears on top of camera without unmounting video) --}}
        @if($scanResult === 'success')
            <div class="absolute inset-0 bg-slate-950/95 backdrop-blur-md rounded-3xl p-5 sm:p-6 shadow-2xl border-2 border-emerald-500/40 text-center text-white flex flex-col justify-between animate-scale-up z-30 overflow-y-auto">
                <div class="w-full">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-emerald-500 text-slate-950 shadow-lg shadow-emerald-500/40 mb-2">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    
                    <h2 class="text-2xl font-black tracking-tight text-white">TIKET VALID!</h2>
                    <p class="text-emerald-400 font-extrabold text-xs uppercase tracking-wider mb-3">Silakan Masuk ke Aquaboom</p>
                    
                    {{-- Detail Card --}}
                    <div class="w-full bg-slate-900/95 rounded-2xl p-4 text-left border border-slate-800 space-y-3 shadow-inner">
                        
                        {{-- Order ID & Visitor Header --}}
                        <div class="flex justify-between items-start border-b border-slate-800 pb-2.5">
                            <div>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">Nama Pengunjung</span>
                                <span class="font-black text-base text-white">{{ $ticketDetails['customer'] }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">Kode Tiket</span>
                                <span class="font-mono font-black text-xs text-amber-400 bg-amber-400/10 border border-amber-400/20 px-2 py-0.5 rounded-lg">{{ $ticketDetails['order_id'] }}</span>
                            </div>
                        </div>

                        {{-- Total Pax & Visit Date --}}
                        <div class="flex justify-between items-center bg-slate-950/80 px-3 py-2 rounded-xl border border-slate-800/80">
                            <div>
                                <span class="text-[10px] text-slate-400 font-bold uppercase block">Kunjungan</span>
                                <span class="text-xs font-bold text-slate-200">{{ $ticketDetails['visit_date'] }}</span>
                            </div>
                            <div class="text-right flex items-baseline gap-1">
                                <span class="text-2xl font-black text-emerald-400">{{ $ticketDetails['total'] }}</span>
                                <span class="text-xs font-extrabold text-slate-300">PAX</span>
                            </div>
                        </div>

                        {{-- Rincian Paket Tiket --}}
                        <div>
                            <span class="text-[10px] text-slate-400 font-extrabold uppercase tracking-wider block mb-1.5">Rincian Tiket:</span>
                            <div class="space-y-1.5">
                                @foreach($ticketDetails['tickets'] as $ticket)
                                    <div class="flex justify-between items-center bg-slate-950/60 px-3 py-1.5 rounded-xl text-xs border border-slate-800/50">
                                        <span class="font-medium text-slate-200">{{ $ticket['name'] }}</span>
                                        <span class="font-black text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-lg border border-emerald-500/20">{{ $ticket['qty'] }}x</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Rincian Fasilitas Tambahan / Add-Ons (Jika Ada) --}}
                        @if(!empty($ticketDetails['addons']) && count($ticketDetails['addons']) > 0)
                            <div class="pt-1 border-t border-slate-800">
                                <span class="text-[10px] text-amber-400 font-extrabold uppercase tracking-wider block mb-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    Fasilitas Tambahan (Add-Ons):
                                </span>
                                <div class="space-y-1.5">
                                    @foreach($ticketDetails['addons'] as $addon)
                                        <div class="flex justify-between items-center bg-amber-500/10 border border-amber-500/20 px-3 py-1.5 rounded-xl text-xs">
                                            <span class="font-bold text-amber-200">{{ $addon['name'] }}</span>
                                            <span class="font-black text-amber-300 bg-amber-500/20 px-2 py-0.5 rounded-lg">{{ $addon['qty'] }}x</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- Action Button --}}
                <div class="w-full mt-3">
                    <button wire:click="resetScan" 
                            @click="restart()"
                            class="w-full bg-emerald-400 hover:bg-emerald-300 text-slate-950 font-black text-base py-3.5 rounded-2xl shadow-xl shadow-emerald-500/20 transition-all transform active:scale-95 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        SCAN TIKET BERIKUTNYA
                    </button>
                </div>
            </div>
        @endif

        {{-- Error / Denied State Modal Overlay (Appears on top without unmounting video) --}}
        @if($scanResult && $scanResult !== 'success')
            <div class="absolute inset-0 bg-slate-950/90 backdrop-blur-md rounded-3xl p-6 sm:p-8 shadow-2xl border-2 border-red-500/40 text-center text-white flex flex-col items-center justify-center animate-scale-up z-30">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-red-500 text-white shadow-lg shadow-red-500/40 mb-4 animate-pulse">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
                
                <h2 class="text-3xl font-black tracking-tight text-white mb-2">TIKET DITOLAK!</h2>
                
                <div class="w-full bg-red-950/40 rounded-2xl p-4 mb-6 border border-red-900/60 text-center">
                    <p class="text-red-200 font-semibold text-sm leading-relaxed">{{ $errorMessage }}</p>
                </div>
                
                <button wire:click="resetScan" 
                        @click="restart()"
                        class="w-full bg-white hover:bg-slate-200 text-red-600 font-black text-lg py-4 rounded-2xl shadow-xl transition-all transform active:scale-95 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    COBA SCAN LAGI
                </button>
            </div>
        @endif

    </main>

    {{-- Footer Info --}}
    <footer class="w-full max-w-md mx-auto text-center py-1">
        <p class="text-[10px] text-slate-500 font-medium tracking-wider uppercase">Aquaboom Gate Access Management • 2026</p>
    </footer>

    {{-- Scanner Script Implementation with Clean Stream Restart --}}
    <script>
        function scannerApp() {
            return {
                html5QrCode: null,
                isCameraReady: false,
                isFrontCamera: false,
                showManualInput: false,
                cameras: [],
                currentCameraIndex: 0,

                manualCode: '',

                async initScanner() {
                    this.$nextTick(() => {
                        this.startCamera();
                    });
                },

                formatTicketInput(event) {
                    let inputVal = event.target.value;
                    if (!inputVal) {
                        this.manualCode = '';
                        this.$wire.set('orderId', '');
                        return;
                    }
                    
                    // Bersihkan hanya huruf dan angka lalu ubah ke huruf besar
                    let clean = inputVal.toUpperCase().replace(/[^A-Z0-9]/g, '');
                    
                    // Jika diawali AQB, pisahkan untuk pemformatan seragam
                    if (clean.startsWith('AQB')) {
                        clean = clean.substring(3);
                    }
                    
                    // Batasi maksimal 12 karakter inti
                    clean = clean.substring(0, 12);
                    
                    let formatted = 'AQB';
                    if (clean.length > 0) {
                        formatted += '-' + clean.substring(0, 4);
                    }
                    if (clean.length > 4) {
                        formatted += '-' + clean.substring(4, 8);
                    }
                    if (clean.length > 8) {
                        formatted += '-' + clean.substring(8, 12);
                    }
                    
                    this.manualCode = formatted;
                    this.$wire.set('orderId', formatted);
                },

                submitManual() {
                    if (this.manualCode) {
                        this.$wire.processScan(this.manualCode);
                    }
                },

                async startCamera() {
                    const readerElem = document.getElementById('reader');
                    if (!readerElem) return;

                    this.isCameraReady = false;

                    // Cleanly stop and reset any previous instance
                    if (this.html5QrCode) {
                        try {
                            if (this.html5QrCode.isScanning) {
                                await this.html5QrCode.stop();
                            }
                        } catch (e) {
                            console.warn("Camera stop error:", e);
                        }
                        try {
                            this.html5QrCode.clear();
                        } catch (e) {}
                        this.html5QrCode = null;
                    }

                    // Reset reader inner DOM to ensure a fresh canvas/video node
                    readerElem.innerHTML = '';
                    this.html5QrCode = new Html5Qrcode("reader");

                    const config = {
                        fps: 15,
                        qrbox: (viewfinderWidth, viewfinderHeight) => {
                            const minEdge = Math.min(viewfinderWidth, viewfinderHeight);
                            const qrboxSize = Math.floor(minEdge * 0.75);
                            return { width: qrboxSize, height: qrboxSize };
                        },
                        aspectRatio: 1.0,
                    };

                    const facingMode = this.isFrontCamera ? "user" : "environment";

                    try {
                        await this.html5QrCode.start(
                            { facingMode: facingMode },
                            config,
                            (decodedText) => {
                                this.handleScanSuccess(decodedText);
                            },
                            () => {}
                        );
                        this.isCameraReady = true;
                    } catch (err) {
                        console.warn("FacingMode failed, trying device list fallback:", err);
                        try {
                            this.cameras = await Html5Qrcode.getCameras();
                            if (this.cameras && this.cameras.length > 0) {
                                const selectedCam = this.cameras[this.currentCameraIndex % this.cameras.length];
                                await this.html5QrCode.start(
                                    selectedCam.id,
                                    config,
                                    (decodedText) => {
                                        this.handleScanSuccess(decodedText);
                                    },
                                    () => {}
                                );
                                this.isCameraReady = true;
                            }
                        } catch (camErr) {
                            console.error("Camera completely failed:", camErr);
                        }
                    }
                },

                async switchCamera() {
                    this.isFrontCamera = !this.isFrontCamera;
                    this.currentCameraIndex++;
                    await this.startCamera();
                },

                async restart() {
                    this.$nextTick(async () => {
                        await this.startCamera();
                    });
                },

                handleScanSuccess(decodedText) {
                    if (navigator.vibrate) {
                        navigator.vibrate(150);
                    }
                    if (this.html5QrCode && this.html5QrCode.isScanning) {
                        this.html5QrCode.stop().then(() => {
                            this.$wire.processScan(decodedText);
                        }).catch(() => {
                            this.$wire.processScan(decodedText);
                        });
                    } else {
                        this.$wire.processScan(decodedText);
                    }
                }
            }
        }
    </script>

    {{-- Clean Custom HUD Animation Styles --}}
    <style>
        #reader video {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            border-radius: 1.5rem !important;
        }
        #reader {
            border: none !important;
            width: 100% !important;
            height: 100% !important;
            position: relative !important;
        }
        /* Sembunyikan kotak putih dan bayangan bawaan html5-qrcode */
        #qr-shaded-region,
        #reader__scan_region,
        #reader__scan_region svg,
        #reader__scan_region div,
        #reader img {
            display: none !important;
            opacity: 0 !important;
            border: none !important;
            box-shadow: none !important;
            visibility: hidden !important;
        }
        @keyframes scan {
            0% { top: 5%; opacity: 0; }
            15% { opacity: 1; }
            85% { opacity: 1; }
            100% { top: 95%; opacity: 0; }
        }
        .animate-scan {
            animation: scan 2.2s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }
        @keyframes scaleUp {
            0% { transform: scale(0.92); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-scale-up {
            animation: scaleUp 0.25s ease-out forwards;
        }
    </style>
</div>
