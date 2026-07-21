<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Validator Staf - Aquaboom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"
    ></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/validator.css" />
  </head>
  <body
    class="bg-slate-950 text-white min-h-screen flex flex-col"
    x-data="{ status: 'idle', code: '' }"
  >
    <!-- Top Bar -->
    <div
      class="p-5 border-b border-slate-800 flex justify-between items-center bg-slate-900/80 backdrop-blur-md sticky top-0 z-10"
    >
      <div class="flex items-center gap-4">
        <div
          class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center font-bold shadow-lg shadow-pink-500/30"
        >
          L1
        </div>
        <div>
          <div class="text-xs text-slate-400 font-medium">Loket Utama 1</div>
          <div class="font-bold text-sm tracking-wide">Fadli (Validator)</div>
        </div>
      </div>
      <div
        class="text-right bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-700"
      >
        <div class="text-[10px] text-slate-400 uppercase font-bold">
          Terpakai Hari Ini
        </div>
        <div class="font-black text-cyan-400 text-sm">254 / 500</div>
      </div>
    </div>

    <!-- Scanner Area -->
    <div
      class="flex-1 flex flex-col items-center justify-center p-6 w-full max-w-md mx-auto relative"
    >
      <div
        class="w-full transition-all duration-300"
        :class="{'opacity-0 pointer-events-none scale-95 absolute': status !== 'idle'}"
      >
        <div class="text-center mb-8">
          <div
            class="w-20 h-20 mx-auto bg-slate-800 rounded-full flex items-center justify-center mb-4 border-2 border-dashed border-slate-600"
          >
            <svg
              class="w-10 h-10 text-slate-400"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"
              ></path>
            </svg>
          </div>
          <h2 class="text-slate-300 font-bold tracking-widest text-sm">
            SCAN QR CODE TIKET
          </h2>
          <p class="text-slate-500 text-xs mt-2">
            Arahkan kamera ke QR pengunjung
          </p>
        </div>

        <div class="flex items-center gap-4 mb-8">
          <div class="flex-1 h-px bg-slate-800"></div>
          <span class="text-slate-600 font-medium text-xs"
            >ATAU INPUT MANUAL</span
          >
          <div class="flex-1 h-px bg-slate-800"></div>
        </div>

        <div class="relative mb-6">
          <input
            type="text"
            x-model="code"
            class="w-full bg-slate-900 border-2 border-slate-700 text-white text-center text-2xl font-mono py-5 rounded-2xl focus:outline-none focus:border-pink-500 transition shadow-inner uppercase tracking-widest"
            placeholder="AQB-..."
          />
        </div>

        <!-- Developer Simulation Buttons -->
        <div class="grid grid-cols-2 gap-3 mt-8">
          <button
            @click="code = 'AQB-VALID'; status = 'valid'"
            class="bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-300 py-3 rounded-xl text-sm font-bold transition"
          >
            Simulasi VALID
          </button>
          <button
            @click="code = 'AQB-USED'; status = 'invalid'"
            class="bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-300 py-3 rounded-xl text-sm font-bold transition"
          >
            Simulasi INVALID
          </button>
        </div>
      </div>

      <!-- Instant Status Feedback -->
      <div
        x-show="status !== 'idle'"
        style="display: none"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-75"
        x-transition:enter-end="opacity-100 scale-100"
        :class="{'vibrate bg-red-500 shadow-[0_0_50px_rgba(239,68,68,0.4)] border-red-400': status === 'invalid', 'bg-emerald-500 shadow-[0_0_50px_rgba(16,185,129,0.4)] border-emerald-400': status === 'valid'}"
        class="w-full rounded-[2rem] p-8 border-4 text-center transform-gpu"
      >
        <!-- Valid State -->
        <template x-if="status === 'valid'">
          <div>
            <div
              class="w-24 h-24 bg-white/20 rounded-full mx-auto flex items-center justify-center mb-6 backdrop-blur-sm"
            >
              <svg
                class="w-12 h-12 text-white"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="4"
                  d="M5 13l4 4L19 7"
                ></path>
              </svg>
            </div>
            <h3 class="text-4xl font-black mb-2 tracking-tight">
              TIKET VALID!
            </h3>
            <div class="bg-black/20 rounded-xl p-4 mt-6 text-left">
              <div class="text-emerald-100 text-xs font-bold uppercase mb-1">
                Detail Pengunjung
              </div>
              <div class="font-bold text-lg">Fadli Zainul</div>
              <div
                class="flex justify-between mt-2 pt-2 border-t border-white/20"
              >
                <span class="text-emerald-100">Jumlah</span>
                <span class="font-bold">2 Pax</span>
              </div>
            </div>
          </div>
        </template>

        <!-- Invalid State -->
        <template x-if="status === 'invalid'">
          <div>
            <div
              class="w-24 h-24 bg-white/20 rounded-full mx-auto flex items-center justify-center mb-6 backdrop-blur-sm"
            >
              <svg
                class="w-12 h-12 text-white"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="4"
                  d="M6 18L18 6M6 6l12 12"
                ></path>
              </svg>
            </div>
            <h3 class="text-4xl font-black mb-2 tracking-tight">DITOLAK</h3>
            <div class="bg-black/20 rounded-xl p-4 mt-6">
              <p class="text-white font-bold uppercase tracking-widest">
                Tiket sudah digunakan
              </p>
              <p class="text-red-200 text-sm mt-1">Pada 09:34 WITA (Gate 1)</p>
            </div>
          </div>
        </template>
      </div>

      <!-- Reset Button -->
      <button
        x-show="status !== 'idle'"
        style="display: none"
        @click="status = 'idle'; code = ''"
        class="w-full mt-6 bg-slate-800 hover:bg-slate-700 text-white py-5 rounded-2xl font-black text-lg transition border border-slate-700 shadow-xl"
      >
        SCAN TIKET BERIKUTNYA
      </button>
    </div>
  </body>
</html>
