<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ App::getLocale() === 'en' ? 'Official E-Ticket - Aquaboom Waterpark' : 'E-Ticket Resmi - Aquaboom Waterpark' }}</title>
    
    <!-- Tailwind CSS & Custom Themes -->
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
    
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap"
      rel="stylesheet"
    />
    
    <!-- Self-hosted html2canvas for 100% Reliable Client Export -->
    <script src="{{ asset('assets/js/html2canvas.min.js') }}"></script>
    
    <link rel="stylesheet" href="{{ asset('assets/css/ticket.css') }}" />
    <style>
      body {
        font-family: 'Plus Jakarta Sans', sans-serif;
      }
      h1, h3 {
        font-family: 'Outfit', sans-serif;
      }
      @media print {
        body {
          background-color: #ffffff !important;
          padding: 0 !important;
        }
        .no-print {
          display: none !important;
        }
        #ticket-card {
          box-shadow: none !important;
          border: 1px solid #e2e8f0 !important;
          max-width: 100% !important;
          margin: 0 auto !important;
          border-radius: 1rem !important;
        }
      }
    </style>
  </head>
  <body
    class="bg-[#f5f8f7] text-[#0f2726] min-h-screen flex flex-col py-10 px-4"
  >
    @php
      // Server-Side QR Code Generation for 100% Reliability & Zero-CDN Dependency
      $qrSvg = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(240)
          ->color(15, 39, 38)
          ->backgroundColor(255, 255, 255)
          ->margin(1)
          ->generate($transaction->order_id);
      $cleanQrSvg = preg_replace('/<\?xml.*?\?>/s', '', (string) $qrSvg);
      $qrBase64 = 'data:image/svg+xml;base64,' . base64_encode($cleanQrSvg);
    @endphp

    <!-- Header Navigation back to home -->
    <div class="max-w-md mx-auto w-full mb-6 no-print">
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
      <div class="bg-teal-50 border border-teal-200 text-teal-800 px-4 py-4 rounded-2xl mb-6 flex items-start gap-3 shadow-sm no-print">
        <svg class="w-6 h-6 mt-0.5 shrink-0 text-waterbom-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <div class="text-sm">
          <strong class="block font-bold mb-1 text-base uppercase text-waterbom-dark">Penting!</strong>
          Harap <span class="font-bold underline">Screenshot</span> atau klik tombol <span class="font-bold">Simpan Gambar / PDF</span> di bawah agar tiket mudah ditunjukkan di loket masuk. Salinan tiket juga telah dikirim ke Email Anda.
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
            <!-- High Contrast Large Server-Side QR Code -->
            <div
              class="bg-white p-3 inline-block rounded-2xl shadow-md border-2 border-slate-100 mb-4"
            >
              <div class="w-48 h-48 flex items-center justify-center p-1 bg-white">
                <img 
                  src="{{ $qrBase64 }}" 
                  alt="QR Code {{ $transaction->order_id }}" 
                  class="w-full h-full object-contain pointer-events-none select-none" 
                  crossorigin="anonymous"
                />
              </div>
            </div>
            <div>
              <p class="font-mono text-sm font-bold text-[#0f2726] bg-slate-100 inline-block px-4 py-2 rounded-xl break-all">
                {{ $transaction->order_id }}
              </p>
            </div>
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
                  @php
                    $unitPrice = $item->price_per_ticket > 0 ? $item->price_per_ticket : ($item->quantity > 0 ? ($item->subtotal / $item->quantity) : 0);
                  @endphp
                  <div class="flex justify-between items-center text-xs">
                    <div>
                      <span class="font-bold text-slate-800 block">{{ $item->ticketPackage->name ?? 'Tiket Masuk' }}</span>
                      <span class="text-slate-400 text-[11px]">{{ $item->quantity }} Tiket @ Rp {{ number_format($unitPrice, 0, ',', '.') }}</span>
                    </div>
                    <span class="font-black text-slate-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                  </div>
                @endforeach

                @if($transaction->addOns && $transaction->addOns->count() > 0)
                  @foreach($transaction->addOns as $addon)
                    @php
                      $addonUnitPrice = $addon->price_per_unit > 0 ? $addon->price_per_unit : ($addon->quantity > 0 ? ($addon->subtotal / $addon->quantity) : 0);
                    @endphp
                    <div class="flex justify-between items-center text-xs pt-2 border-t border-slate-200/70">
                      <div>
                        <span class="font-bold text-slate-800 block">{{ $addon->addOn->name ?? 'Fasilitas Tambahan' }}</span>
                        <span class="text-slate-400 text-[11px]">{{ $addon->quantity }}x Sewa @ Rp {{ number_format($addonUnitPrice, 0, ',', '.') }}</span>
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

      <!-- Action Buttons (Download & Print) -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6 no-print">
        <button
          id="download-btn"
          onclick="downloadTicket()"
          class="w-full bg-waterbom-dark hover:bg-black text-white font-black text-sm py-4 px-4 rounded-2xl shadow-lg transition flex items-center justify-center gap-2 uppercase tracking-wider cursor-pointer active:scale-95"
        >
          <svg class="w-5 h-5 text-waterbom-orange shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
          <span id="btn-text">Simpan Gambar</span>
        </button>

        <button
          onclick="window.print()"
          class="w-full bg-white hover:bg-slate-50 text-waterbom-dark border-2 border-slate-200 font-black text-sm py-4 px-4 rounded-2xl shadow-sm transition flex items-center justify-center gap-2 uppercase tracking-wider cursor-pointer active:scale-95"
        >
          <svg class="w-5 h-5 text-waterbom-teal shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
          <span>Cetak / PDF</span>
        </button>
      </div>
    </div>

    <!-- Scripts -->
    <script>
      async function downloadTicket() {
        const btn = document.getElementById('download-btn');
        const btnText = document.getElementById('btn-text');
        const originalText = btnText.innerHTML;
        
        btnText.innerHTML = 'Memproses Gambar...';
        btn.disabled = true;

        const ticketCard = document.getElementById('ticket-card');

        try {
          if (typeof html2canvas === 'undefined') {
            throw new Error('html2canvas library is not ready.');
          }

          const canvas = await html2canvas(ticketCard, {
            scale: 2,
            useCORS: true,
            allowTaint: true,
            backgroundColor: '#ffffff',
            logging: false
          });

          const dataUrl = canvas.toDataURL('image/png');
          const link = document.createElement('a');
          link.download = 'Aquaboom-Ticket-{{ $transaction->order_id }}.png';
          link.href = dataUrl;
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);

          btnText.innerHTML = '✓ Tersimpan!';
          setTimeout(() => {
            btnText.innerHTML = originalText;
            btn.disabled = false;
          }, 2500);
        } catch (error) {
          console.error('Error generating image: ', error);
          btnText.innerHTML = originalText;
          btn.disabled = false;
          
          // Fallback seamlessly to native browser print/save PDF
          if (confirm('Unduhan otomatis gambar dibatasi oleh browser perangkat. Apakah Anda ingin membuka menu Cetak / Simpan sebagai PDF?')) {
            window.print();
          }
        }
      }
    </script>
  </body>
</html>
