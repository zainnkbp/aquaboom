<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Ticket - Aquaboom Waterpark</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              'waterbom-teal': '#44b3b0',
              'waterbom-orange': '#ff914d',
              'waterbom-dark': '#0f2726',
            }
          }
        }
      }
    </script>
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"
    ></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <!-- dom-to-image for Flawless SVG & Canvas Download -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <!-- QRCode.js for reliable Canvas-based QR -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/ticket.css') }}" />
    <style>
      body {
        font-family: 'Plus Jakarta Sans', sans-serif;
      }
      h1, h3 {
        font-family: 'Outfit', sans-serif;
      }
    </style>
  </head>
  <body
    class="bg-[#f5f8f7] text-[#0f2726] min-h-screen flex flex-col py-10 px-4"
    x-data="{ showCancelModal: false }"
  >
    <!-- Header Navigation back to home -->
    <div class="max-w-md mx-auto w-full mb-8">
      <a
        href="{{ url('/') }}"
        class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-waterbom-orange transition"
      >
        <svg
          class="w-4 h-4 mr-1"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2.5"
            d="M10 19l-7-7m0 0l7-7m-7 7h18"
          ></path>
        </svg>
        Kembali ke Beranda
      </a>
    </div>

    <div class="w-full max-w-md mx-auto flex-1">
      <!-- Notification Banner -->
      <div class="bg-teal-50 border border-teal-200 text-teal-800 px-4 py-4 rounded-2xl mb-6 flex items-start gap-3 shadow-sm">
        <svg class="w-6 h-6 mt-0.5 shrink-0 text-waterbom-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <div class="text-sm">
          <strong class="block font-bold mb-1 text-base uppercase text-waterbom-dark">Penting!</strong>
          Harap <span class="font-bold underline">Screenshot</span> halaman ini atau klik tombol <span class="font-bold">Simpan E-Ticket</span> di bawah agar tidak hilang. Salinan tiket juga telah dikirim ke Email Anda.
        </div>
      </div>

      <!-- Ticket Card Component -->
      <div
        id="ticket-card"
        class="bg-white rounded-[2rem] overflow-hidden shadow-2xl relative mb-6"
      >
        <!-- Ticket Header -->
        <div
          class="bg-gradient-to-r from-waterbom-dark to-[#163a39] p-8 text-white text-center relative border-b-2 border-dashed border-slate-100"
        >
          <!-- Physical Ticket Cutout Illusion -->
          <div class="ticket-cutout-left"></div>
          <div class="ticket-cutout-right"></div>

          <h1 class="text-3xl font-extrabold tracking-wider uppercase mb-1">
            E-Ticket Aquaboom
          </h1>
          <p class="text-waterbom-teal text-xs font-black uppercase tracking-widest">
            Premium Waterpark Experience
          </p>
        </div>

        <!-- Ticket Body -->
        <div class="p-8 relative bg-white">
          <div class="text-center mb-8">
            <!-- High Contrast Large QR Code -->
            <div
              class="bg-white p-3 inline-block rounded-2xl shadow-md border-2 border-slate-100 mb-4"
            >
              <!-- Client-side Canvas QR Code for 100% html2canvas compatibility -->
              <div id="qrcode-container" class="w-48 h-48 flex items-center justify-center p-2">
                <!-- QRCode will be injected here as a <canvas> -->
              </div>
            </div>
            <p
              class="font-mono text-sm font-bold text-[#0f2726] bg-slate-100 inline-block px-4 py-2 rounded-xl break-all"
            >
              {{ $transaction->order_id }}
            </p>
          </div>

          <div class="space-y-5 text-sm">
            <div
              class="flex justify-between items-end border-b border-slate-100 pb-3"
            >
              <span class="text-slate-400 font-medium">Nama Pengunjung</span>
              <span class="font-bold text-[#0f2726] text-base"
                >{{ $transaction->customer_name }}</span
              >
            </div>
            <div
              class="flex justify-between items-end border-b border-slate-100 pb-3"
            >
              <span class="text-slate-400 font-medium">Tanggal Kunjungan</span>
              <span class="font-bold text-waterbom-orange text-base"
                >{{ \Carbon\Carbon::parse($transaction->visit_date)->translatedFormat('d F Y') }}</span
              >
            </div>
            <div
              class="flex justify-between items-end border-b border-slate-100 pb-3"
            >
              <span class="text-slate-400 font-medium">Jumlah Tiket</span>
              <span class="font-bold text-[#0f2726] text-base">{{ App\Models\TransactionItem::where('transaction_id', $transaction->id)->sum('quantity') }} Pax</span>
            </div>
            <div class="flex justify-between items-center pt-2 border-b border-slate-100 pb-3">
              <span class="text-slate-400 font-medium">Status Pembayaran</span>
              <span
                class="{{ $transaction->status === 'paid' ? 'bg-teal-100 text-teal-800' : ($transaction->status === 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-red-100 text-red-800') }} font-black px-4 py-1.5 rounded-full text-xs shadow-sm uppercase tracking-wider"
                >{{ $transaction->status === 'paid' ? 'LUNAS (PAID)' : ($transaction->status === 'pending' ? 'MENUNGGU PEMBAYARAN' : 'BATAL / GAGAL') }}</span
              >
            </div>

            <!-- Rincian Pembelian Tiket & Fasilitas -->
            <div class="pt-2">
              <span class="text-xs font-black text-slate-400 uppercase tracking-wider block mb-2.5">Rincian Pembelian:</span>
              <div class="space-y-2.5 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                @foreach($transaction->items as $item)
                  <div class="flex justify-between items-center text-xs">
                    <div>
                      <span class="font-bold text-slate-800 block">{{ $item->ticketPackage->name ?? 'Tiket Masuk' }}</span>
                      <span class="text-slate-400 text-[11px]">{{ $item->quantity }} Tiket @ Rp {{ number_format($item->price_per_ticket, 0, ',', '.') }}</span>
                    </div>
                    <span class="font-black text-slate-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                  </div>
                @endforeach

                @if($transaction->addOns && $transaction->addOns->count() > 0)
                  @foreach($transaction->addOns as $addon)
                    <div class="flex justify-between items-center text-xs pt-2 border-t border-slate-200/70">
                      <div>
                        <span class="font-bold text-slate-800 block">{{ $addon->addOn->name ?? 'Fasilitas Tambahan' }}</span>
                        <span class="text-slate-400 text-[11px]">{{ $addon->quantity }}x Sewa @ Rp {{ number_format($addon->price_per_unit, 0, ',', '.') }}</span>
                      </div>
                      <span class="font-black text-slate-900">Rp {{ number_format($addon->subtotal, 0, ',', '.') }}</span>
                    </div>
                  @endforeach
                @endif

                @if($transaction->discount_amount > 0)
                  <div class="flex justify-between items-center text-xs pt-2 border-t border-slate-200/70 text-emerald-600">
                    <span class="font-bold">Potongan Diskon Promo</span>
                    <span class="font-black">- Rp {{ number_format($transaction->discount_amount, 0, ',', '.') }}</span>
                  </div>
                @endif

                <div class="flex justify-between items-center text-sm pt-2.5 border-t-2 border-slate-200">
                  <span class="font-black text-slate-900">Total Dibayar</span>
                  <span class="font-black text-waterbom-orange text-base">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Ticket Footer -->
        <div class="p-6 bg-slate-50 text-center border-t border-slate-100">
          <p class="text-xs text-slate-400 font-semibold leading-relaxed">
            Tunjukkan QR Code ini langsung di loket masuk. Harap tidak
            membagikan kode e-ticket ini kepada orang lain untuk mencegah
            penyalahgunaan.
          </p>
        </div>
      </div>

      <!-- Download/Print Button -->
      <div class="mb-4">
        <button
          id="download-btn"
          onclick="downloadTicket()"
          class="w-full bg-waterbom-dark hover:bg-black text-white font-black text-lg py-4 rounded-2xl shadow-lg transition flex items-center justify-center gap-2 uppercase tracking-wider"
        >
          <svg class="w-6 h-6 text-waterbom-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
          Simpan ke Galeri (Gambar)
        </button>
      </div>

      <!-- Cancelation Action Button -->
      <div class="text-center">
        <button
          @click="showCancelModal = true"
          class="text-sm font-bold text-slate-400 hover:text-red-500 transition-colors py-2 px-4 rounded-xl hover:bg-red-50"
        >
          Ajukan Pembatalan Tiket
        </button>
      </div>
    </div>

    <!-- Cancelation Modal (Non-Automated Flow) -->
    <div
      x-show="showCancelModal"
      class="fixed inset-0 z-50 overflow-y-auto"
      style="display: none"
    >
      <div
        class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0"
      >
        <!-- Blur Backdrop -->
        <div
          x-show="showCancelModal"
          x-transition.opacity
          class="fixed inset-0 transition-opacity bg-slate-900/60 backdrop-blur-sm"
          @click="showCancelModal = false"
        ></div>

        <!-- Modal Panel -->
        <div
          x-show="showCancelModal"
          x-transition:enter="ease-out duration-300"
          x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
          x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
          x-transition:leave="ease-in duration-200"
          x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
          class="relative inline-block w-full max-w-md p-8 text-left align-middle transition-all transform bg-white shadow-2xl rounded-3xl sm:my-8 sm:align-middle"
        >
          <div
            class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mb-5"
          >
            <svg
              class="w-6 h-6 text-red-500"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2.5"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
              ></path>
            </svg>
          </div>

          <h3 class="text-2xl font-bold leading-6 text-slate-900 mb-3">
            Pengajuan Pembatalan
          </h3>
          <div class="text-sm text-slate-500 space-y-4">
            <p class="leading-relaxed">
              Sesuai Syarat & Ketentuan, pembatalan hanya dapat diproses
              maksimal H-1 sebelum tanggal kunjungan. Dana tidak dapat
              dikembalikan secara penuh dan tunduk pada peninjauan manual oleh
              admin.
            </p>

            <div>
              <label class="block font-bold text-slate-700 mb-2"
                >Alasan Pembatalan</label
              >
              <textarea
                class="w-full border-2 border-slate-200 rounded-xl p-4 focus:ring-4 focus:ring-red-100 focus:border-red-400 outline-none transition font-medium text-slate-800"
                rows="3"
                placeholder="Mohon jelaskan alasan pembatalan Anda..."
              ></textarea>
            </div>
          </div>

          <div class="mt-8 flex gap-3">
            <button
              @click="showCancelModal = false"
              class="flex-1 bg-slate-100 text-slate-700 px-4 py-3.5 rounded-xl font-bold hover:bg-slate-200 transition"
            >
              Batal
            </button>
            <button
              @click="showCancelModal = false; alert('Pengajuan pembatalan telah diteruskan ke sistem Admin. Mohon tunggu konfirmasi melalui Email atau WhatsApp dalam 1x24 Jam.')"
              class="flex-1 bg-red-500 text-white px-4 py-3.5 rounded-xl font-bold hover:bg-red-600 transition shadow-lg shadow-red-500/30 transform hover:-translate-y-0.5"
            >
              Kirim Pengajuan
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script>
      // Initialize QR Code as a native canvas element
      document.addEventListener("DOMContentLoaded", function() {
        new QRCode(document.getElementById("qrcode-container"), {
          text: "{{ $transaction->order_id }}",
          width: 170,
          height: 170,
          colorDark : "#0f2726", // waterbom-dark
          colorLight : "#ffffff",
          correctLevel : QRCode.CorrectLevel.M
        });
      });

      function downloadTicket() {
        const btn = document.getElementById('download-btn');
        const originalText = btn.innerHTML;
        btn.innerHTML = 'Mempersiapkan Gambar...';
        btn.disabled = true;

        const ticketCard = document.getElementById('ticket-card');
        
        // Use domtoimage to capture the element (much better than html2canvas for Flexbox and Canvas)
        domtoimage.toPng(ticketCard, { bgcolor: 'transparent' })
            .then(function (dataUrl) {
                // Create download link
                const link = document.createElement('a');
                link.download = 'Aquaboom-Ticket-{{ $transaction->order_id }}.png';
                link.href = dataUrl;
                link.click();

                // Restore button
                btn.innerHTML = originalText;
                btn.disabled = false;
            })
            .catch(function (error) {
                console.error('Error rendering ticket: ', error);
                alert('Gagal mendownload tiket. Silakan screenshot manual.');
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
      }
    </script>
  </body>
</html>
