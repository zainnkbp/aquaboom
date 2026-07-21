<div>
    <div class="min-h-screen bg-slate-900 flex flex-col items-center justify-center p-4">
        <!-- Header -->
        <div class="w-full max-w-md text-center mb-8">
            <h1 class="text-3xl font-extrabold text-white mb-2">Aquaboom Scanner</h1>
            <p class="text-slate-400 text-sm">Arahkan kamera ke QR Code tiket pengunjung</p>
        </div>

        <!-- Scanner Box -->
        <div class="w-full max-w-md bg-white rounded-[2rem] shadow-2xl overflow-hidden relative">
            
            <!-- Target overlay purely for aesthetics -->
            <div class="absolute inset-0 z-10 pointer-events-none flex items-center justify-center">
                <div class="w-48 h-48 border-4 border-pink-500 rounded-2xl opacity-50 relative">
                    <div class="absolute -top-1 -left-1 w-6 h-6 border-t-4 border-l-4 border-pink-500 rounded-tl-xl"></div>
                    <div class="absolute -top-1 -right-1 w-6 h-6 border-t-4 border-r-4 border-pink-500 rounded-tr-xl"></div>
                    <div class="absolute -bottom-1 -left-1 w-6 h-6 border-b-4 border-l-4 border-pink-500 rounded-bl-xl"></div>
                    <div class="absolute -bottom-1 -right-1 w-6 h-6 border-b-4 border-r-4 border-pink-500 rounded-br-xl"></div>
                </div>
            </div>

            <!-- HTML5 QR Code Container -->
            <div id="reader" class="w-full h-96 bg-black"></div>
        </div>

        <!-- Back to Admin Button -->
        <div class="w-full max-w-md mt-8 text-center">
            <a href="{{ url('/admin') }}" class="inline-flex items-center text-sm font-semibold text-slate-400 hover:text-white transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Dashboard Admin
            </a>
        </div>
    </div>

    <!-- Hidden Input to trigger Livewire action -->
    <input type="hidden" id="scanned_qr" wire:model.live="scannedData">

    <!-- Libraries -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let isScanning = true;
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader",
                { fps: 10, qrbox: {width: 250, height: 250} },
                /* verbose= */ false
            );

            function onScanSuccess(decodedText, decodedResult) {
                if(!isScanning) return;
                
                isScanning = false; // Pause scanning temporarily
                
                // Play a beep sound (optional, using browser audio or just visual)
                try {
                    const audio = new Audio('https://www.soundjay.com/buttons/beep-07a.mp3');
                    audio.play();
                } catch(e) {}

                // Show processing indicator
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Mengecek data tiket',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Send data to Livewire Component
                @this.call('processTicket', decodedText);
            }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning
            }

            html5QrcodeScanner.render(onScanSuccess, onScanFailure);

            // Listen for Livewire Response
            window.addEventListener('ticket-result', event => {
                const data = event.detail;
                
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'BERHASIL',
                        html: data.message,
                        confirmButtonColor: '#ec4899',
                        confirmButtonText: 'Lanjut Scan'
                    }).then((result) => {
                        isScanning = true; // Resume scanning
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'DITOLAK!',
                        text: data.message,
                        confirmButtonColor: '#0f172a',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        isScanning = true; // Resume scanning
                    });
                }
            });
        });
    </script>
    
    <style>
        /* Hide html5-qrcode default UI elements that are ugly */
        #reader__dashboard_section_csr span {
            color: #fff !important;
        }
        #reader__dashboard_section_swaplink {
            color: #ec4899 !important;
            text-decoration: none;
        }
        #reader button {
            background-color: #ec4899 !important;
            color: white !important;
            border: none !important;
            border-radius: 0.5rem !important;
            padding: 0.5rem 1rem !important;
            font-weight: bold !important;
            margin-top: 0.5rem !important;
            cursor: pointer;
        }
    </style>
</div>
