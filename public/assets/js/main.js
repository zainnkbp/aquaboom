// --- Script Block 1 ---
// Magnetic Hover Logic
const initMagnetic = () => {
  const magneticElements = document.querySelectorAll(".magnetic");
  magneticElements.forEach((el) => {
    if (el.dataset.magneticInit) return;

    el.addEventListener(
      "mousemove",
      (e) => {
        const strength = el.dataset.magneticStrength || 20;
        const rect = el.getBoundingClientRect();
        const x = (e.clientX - rect.left) / el.clientWidth - 0.5;
        const y = (e.clientY - rect.top) / el.clientHeight - 0.5;
        el.style.transform = `translate3d(${x * strength}px, ${y * strength}px, 0)`;
      },
      { passive: true },
    );

    el.addEventListener("mouseout", () => {
      el.style.transform = `translate(0px, 0px)`;
    });
    el.dataset.magneticInit = true;
  });
};

// Custom Cursor Interaction Init
const initInteractions = () => {
  initMagnetic();
};

initInteractions();

// Luxury Text Reveal Observer & Wave Trigger
const revealTexts = document.querySelectorAll(".reveal-text");
const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("is-visible");
        // Trigger wave if it has one
        const wave = entry.target.querySelector(".wave-wrapper");
        if (wave) {
          setTimeout(() => {
            wave.classList.add("is-active");
          }, 600); // Wait for fade in
        }
      }
    });
  },
  { threshold: 0.2 },
);
revealTexts.forEach((el) => observer.observe(el));

document.addEventListener("alpine:init", () => {
  // Live Countdown Timer Data
  Alpine.data("countdownTimer", () => ({
    // Set to end of current day for realism
    endTime: new Date(new Date().setHours(23, 59, 59, 999)).getTime(),
    hours: "00",
    minutes: "00",
    seconds: "00",
    startTimer() {
      setInterval(() => {
        const now = new Date().getTime();
        const distance = this.endTime - now;
        if (distance < 0) return;
        this.hours = String(
          Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
        ).padStart(2, "0");
        this.minutes = String(
          Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
        ).padStart(2, "0");
        this.seconds = String(
          Math.floor((distance % (1000 * 60)) / 1000),
        ).padStart(2, "0");
      }, 1000);
    },
  }));

  // Live Social Proof Data (Ready for real API hookup)
  Alpine.data("socialProof", () => ({
    show: false,
    message: "",
    // Simulated API Response Structure.
    // Later, replace this with: fetch('/api/recent-purchases').then(res => res.json())
    simulatedApiData: [
      "<b>Fadli</b> (Balikpapan) memesan <b>4 Tiket</b>",
      "<b>Sinta</b> (Samarinda) mengklaim <b>Promo 20%</b>",
      "<b>Keluarga Budi</b> (Penajam) memesan <b>5 Tiket</b>",
      "<b>Reza</b> (Banjarmasin) memesan <b>3 Tiket</b>",
      "<b>Rina</b> (Balikpapan) mengklaim <b>Promo 20%</b>",
    ],
    startPopups() {
      // Tunda popup pertama agar pengguna sempat melihat halaman
      setTimeout(() => {
        this.fetchAndShowPopup();
      }, 3500);

      // Ulangi setiap 14 detik
      setInterval(() => {
        if (!this.show) this.fetchAndShowPopup();
      }, 14000);
    },
    fetchAndShowPopup() {
      // Logic to select a random simulated purchase
      const randomMsg =
        this.simulatedApiData[
          Math.floor(Math.random() * this.simulatedApiData.length)
        ];
      this.message = randomMsg;
      this.show = true;
      // Hide after 6 seconds
      setTimeout(() => {
        this.show = false;
      }, 6000);
    },
  }));

  Alpine.store("global", {
    init() {
      initInteractions();

      // Luxury Text Reveal Observer & Wave Trigger
      const revealTexts = document.querySelectorAll(".reveal-text");
      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              entry.target.classList.add("is-visible");
              // Trigger wave if it has one
              const wave = entry.target.querySelector(".wave-wrapper");
              if (wave) {
                setTimeout(() => {
                  wave.classList.add("is-active");
                }, 600); // Wait for fade in
              }
            }
          });
        },
        { threshold: 0.2 },
      );
      revealTexts.forEach((el) => observer.observe(el));
    },
  });
});

// --- Script Block 2 ---
// High-Performance Custom Cursor (RAF + Translate3D)
const cursor = document.getElementById("custom-cursor");
let mouseX = window.innerWidth / 2;
let mouseY = window.innerHeight / 2;
let cursorX = mouseX;
let cursorY = mouseY;

// Passive event listener is 10x lighter on main thread
window.addEventListener(
  "mousemove",
  (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
  },
  { passive: true },
);

// RAF Loop for 60FPS smoothness without layout thrashing
function updateCursor() {
  // Lerp (Linear Interpolation) for smooth trailing effect
  cursorX += (mouseX - cursorX) * 0.3;
  cursorY += (mouseY - cursorY) * 0.3;
  // Translate3D forces GPU acceleration
  cursor.style.transform = `translate3d(${cursorX}px, ${cursorY}px, 0) translate(-50%, -50%)`;
  requestAnimationFrame(updateCursor);
}
requestAnimationFrame(updateCursor);
