<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Araya Gamestation - Rental PlayStation Terbaik di Banjarmasin!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <style>
      body {
        font-family: 'Poppins', sans-serif;
        /* Background image dari logo */
        background-image: url('./login/images/logoaraya.png'); /* URL gambar logo Anda */
        background-repeat: no-repeat; /* Mencegah gambar berulang */
        background-attachment: fixed; /* Gambar tetap saat di-scroll */
        background-position: center center; /* Memposisikan gambar di tengah */
        min-height: 100vh; /* Memastikan body setidaknya setinggi viewport */
        position: relative; /* Diperlukan untuk overlay */
        background-color: #f3f4f6; /* Warna fallback jika gambar tidak muncul */
      }

      /* Ukuran default untuk mobile */
      body {
        background-size: 80%; /* Logo lebih kecil di mobile */
      }

      /* Media Query untuk Tablet (misalnya, layar > 640px) */
      @media (min-width: 640px) {
        body {
          background-size: 60%; /* Logo sedikit lebih besar di tablet */
        }
      }

      /* Media Query untuk Desktop (misalnya, layar > 1024px) */
      @media (min-width: 1024px) {
        body {
          background-size: 40%; /* Logo lebih besar di desktop */
        }
      }
      
      /* Optional: Overlay transparan untuk teks lebih mudah dibaca */
      body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(243, 244, 246, 0.85); /* Warna abu-abu terang transparan */
        z-index: -1; /* Pastikan overlay di belakang konten */
      }

      /* Sesuaikan warna teks agar lebih kontras dengan background baru jika perlu */
      /* Menaikkan sedikit transparansi untuk elemen yang memiliki latar belakang */
      .bg-white { background-color: rgba(255, 255, 255, 0.95); }
      .bg-gray-50 { background-color: rgba(249, 250, 251, 0.95); }
      .bg-blue-400 { background-color: rgba(96, 165, 250, 0.9); } /* Mengurangi transparansi header agar lebih solid */
      .bg-gray-600 { background-color: rgba(75, 85, 99, 0.95); } /* Footer */


    </style>
  </head>
  <body class="bg-gray-100 text-gray-800">
    <nav class="bg-white shadow-md sticky top-0 z-50">
      <div
        class="container mx-auto px-4 py-4 md:py-3 flex justify-between items-center"
      >
        <div class="nav-brand">
          <a href="./" class="text-xl md:text-2xl font-bold text-yellow-400">Araya Gamestation</a>
        </div>
        <ul class="hidden md:flex md:space-x-4 lg:space-x-6 text-sm">
          <li>
            <a
              href="./"
              class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors"
            >
              <i class="fas fa-home"></i>
              <span>Beranda</span>
            </a>
          </li>
          <li>
            <a
              href="#fasilitas"
              class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors"
            >
              <i class="fas fa-hand-sparkles"></i>
              <span>Fasilitas</span>
            </a>
          </li>
          <li>
            <a
              href="#game"
              class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors"
            >
              <i class="fas fa-gamepad"></i>
              <span>Game</span>
            </a>
          </li>
          <li>
            <a
              href="#lokasi"
              class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors"
            >
              <i class="fas fa-map-marker-alt"></i>
              <span>Lokasi</span>
            </a>
            </li>
            <li>
                <a
                  href="#kontak"
                  class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors"
                >
                  <i class="fas fa-headset"></i>
                  <span>Kontak</span>
                </a>
              </li>
              <li>
                <a
                  href="login/"
                  class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors"
                >
                  <i class="fas fa-user"></i>
                  <span>Login</span>
                </a>
              </li>
            </ul>
    
            <button id="hamburger-btn" class="md:hidden text-gray-700 focus:outline-none">
              <i class="fas fa-bars text-xl"></i>
            </button>
          </div>
    
          <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg py-2">
            <ul class="flex flex-col items-center space-y-4">
              <li>
                <a
                  href="./"
                  class="text-gray-700 hover:text-blue-600 transition-colors text-sm"
                  >Beranda</a
                >
              </li>
              <li>
                <a
                  href="#fasilitas"
                  class="text-gray-700 hover:text-blue-600 transition-colors text-sm"
                  >Fasilitas</a
                >
              </li>
              <li>
                <a
                  href="#game"
                  class="text-gray-700 hover:text-blue-600 transition-colors text-sm"
                  >Game</a
                >
              </li>
              <li>
                <a
                  href="#lokasi"
                  class="text-gray-700 hover:text-blue-600 transition-colors text-sm"
                  >Lokasi</a
                >
              </li>
              <li>
                <a
                  href="#kontak"
                  class="text-gray-700 hover:text-blue-600 transition-colors text-sm"
                  >Kontak</a
                >
              </li>
              <li>
                <a
                  href="login/"
                  class="text-gray-700 hover:text-blue-600 transition-colors text-sm"
                  >Login</a
                >
              </li>
            </ul>
          </div>
        </nav>
    
        <header id="beranda"
          class="bg-blue-400 text-white pt-24 md:pt-32 pb-0 text-center hero-bg bg-cover bg-center overflow-hidden"
        >
          <div class="container mx-auto px-4">
            <h1 class="text-yellow-300 text-3xl md:text-4xl lg:text-6xl font-extrabold md:mb-3 hero-title">
              Araya Gamestation
            </h1>
            <p class="text-sm md:text-base lg:text font-light max-w-3xl mx-auto hero-subtitle">
              Nikmati pengalaman gaming premium dengan console terbaru dan game terlengkap, hanya di Araya Gamestation.
            </p>
           
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto mt-8 -mb-1">
            <path fill="#ffffff" fill-opacity="1" 
            d="M0,64L40,80C80,96,160,128,240,128C320,128,400,96,480,117.3C560,139,640,213,720,202.7C800,192,880,96,960,85.3C1040,75,1120,149,1200,176C1280,203,1360,181,1400,170.7L1440,160L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
          </svg>
        </header>
        
    
        <main class="container mx-auto px-4 py-6 md:py-10">
          
          <section id="fasilitas" class="mb-8 md:mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-6 section-title">Fasilitas Unggulan Kami</h2>
            <div
              class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6"
            >
              <div
                class="bg-white p-4 md:p-6 rounded-lg shadow-md flex flex-col items-center text-center card-item"
              >
                <i class="fas fa-desktop text-3xl md:text-4xl text-blue-600 mb-2"></i>
                <h3 class="text-sm md:text-base font-semibold">SMART TV 43, 55, 65, 75 INCH</h3>
              </div>
              <div
                class="bg-white p-4 md:p-6 rounded-lg shadow-md flex flex-col items-center text-center card-item"
              >
                <i class="fas fa-wifi text-3xl md:text-4xl text-blue-600 mb-2"></i>
                <h3 class="text-sm md:text-base font-semibold">
                  INTERNET KECEPATAN TINGGI
                </h3>
              </div>
              <div
                class="bg-white p-4 md:p-6 rounded-lg shadow-md flex flex-col items-center text-center card-item"
              >
                <i class="fas fa-couch text-3xl md:text-4xl text-blue-600 mb-2"></i>
                <h3 class="text-sm md:text-base font-semibold">SOFA EMPUK & NYAMAN</h3>
              </div>
              <div
                class="bg-white p-4 md:p-6 rounded-lg shadow-md flex flex-col items-center text-center card-item"
              >
                <i class="fas fa-snowflake text-3xl md:text-4xl text-blue-600 mb-2"></i>
                <h3 class="text-sm md:text-base font-semibold">RUANGAN FULL AC</h3>
              </div>
              <div
                class="bg-white p-4 md:p-6 rounded-lg shadow-md flex flex-col items-center text-center card-item"
              >
                <i class="fas fa-gamepad text-3xl md:text-4xl text-blue-600 mb-2"></i>
                <h3 class="text-sm md:text-base font-semibold">CONSOLE <br> PS3, PS4, PS5 & NINTENDO</h3>
              </div>
              <div
                class="bg-white p-4 md:p-6 rounded-lg shadow-md flex flex-col items-center text-center card-item"
              >
                <i class="fas fa-dollar-sign text-3xl md:text-4xl text-blue-600 mb-2"></i>
                <h3 class="text-sm md:text-base font-semibold">
                  HARGA TERJANGKAU <br />
                  MULAI IDR 5000
                </h3>
              </div>
            </div>
          </section>
          
          <section id="game" class="bg-gray-50 py-8 md:py-12 mb-8 md:mb-12 rounded-lg">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-6 section-title">Koleksi Game Terbaik</h2>
            <div
              class="flex overflow-x-auto gap-4 md:gap-6 px-4 pb-4 md:justify-center md:flex-wrap"
            >
              <div class="game-item flex-none w-32 md:w-40 text-center">
                <img
                  src="https://image.api.playstation.com/vulcan/ap/rnd/202408/0817/4248a0d1a669210e5caf5174eda176c7883be2c9089fa106.png"
                  alt="EA Sports FC 24"
                  class="w-full h-44 rounded-lg shadow-md mb-2 object-over game-cover"
                />
                <h3 class="font-semibold text-gray-700 text-sm">EA Sports FC 24</h3>
              </div>
              <div class="game-item flex-none w-32 md:w-40 text-center">
                <img
                  src="https://upload.wikimedia.org/wikipedia/en/a/a5/Grand_Theft_Auto_V.png"
                  alt="GTA V"
                  class="w-full h-44 rounded-lg shadow-md mb-2 object-over game-cover"
                />
                <h3 class="font-semibold text-gray-700 text-sm">Grand Theft Auto V</h3>
              </div>
              <div class="game-item flex-none w-32 md:w-40 text-center">
                <img
                  src="https://www.vgstores.ng/wp-content/uploads/2022/11/God-of-War-Ragnarok-PS5-468x600-1.webp"
                  alt="God of War Ragnarok"
                  class="w-full h-44 rounded-lg shadow-md mb-2 object-over game-cover"
                />
                <h3 class="font-semibold text-gray-700 text-sm">God of War Ragnarok</h3>
              </div>
              <div class="game-item flex-none w-32 md:w-40 text-center">
                <img
                  src="https://via.placeholder.com/150/FFFF33/000000?text=Spider-Man"
                  alt="Spider-Man 2"
                  class="w-full h-44 rounded-lg shadow-md mb-2 object-over game-cover"
                />
                <h3 class="font-semibold text-gray-700 text-sm">Spider-Man 2</h3>
              </div>
              <div class="game-item flex-none w-32 md:w-40 text-center">
                <img
                  src="https://via.placeholder.com/150/8A2BE2/FFFFFF?text=Tekken+8"
                  alt="Tekken 8"
                  class="w-full h-44 rounded-lg shadow-md mb-2 object-over game-cover"
                />
                <h3 class="font-semibold text-gray-700 text-sm">Tekken 8</h3>
              </div>
              <div class="game-item flex-none w-32 md:w-40 text-center">
                <img
                  src="https://via.placeholder.com/150/ADD8E6/000000?text=Fortnite"
                  alt="Fortnite"
                  class="w-full h-44 rounded-lg shadow-md mb-2 object-over game-cover"
                />
                <h3 class="font-semibold text-gray-700 text-sm">Fortnite</h3>
              </div>
              <div class="game-item flex-none w-32 md:w-40 text-center">
                <img
                  src="https://via.placeholder.com/150/D2B48C/FFFFFF?text=NBA+2K24"
                  alt="NBA 2K24"
                  class="w-full h-44 rounded-lg shadow-md mb-2 object-over game-cover"
                />
                <h3 class="font-semibold text-gray-700 text-sm">NBA 2K24</h3>
              </div>
            </div>
            <p class="text-center text-xs text-gray-500 mt-4">
              Koleksi game kami selalu di-update! Kunjungi kami untuk melihat daftar lengkap.
            </p>
          </section>
    
          <section id="lokasi" class="mb-8 md:mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-6 section-title">Lokasi Kami</h2>
            <div class="map-container overflow-hidden rounded-lg shadow-md">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15897.68369324545!2d114.58022725!3d-3.3204996999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de423c102a00c6d%3A0x67c29e79b9a695e2!2sBanjarmasin%2C%20South%20Kalimantan!5e0!3m2!1sen!2sid!4v1701234567890!5m2!1sen!2sid"
                width="100%"
                height="350"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
            <p class="text-center text-xs md:text-sm text-gray-500 mt-4">
              Araya Gamestation berlokasi di pusat kota Banjarmasin, mudah dijangkau!
            </p>
          </section>
    
          <section id="kontak" class="bg-gray-50 py-8 md:py-12 rounded-lg">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-6 section-title">Hubungi Kami</h2>
            <div class="kontak-content text-center max-w-xl mx-auto">
              <div class="kontak-details space-y-2 md:space-y-4">
                <p class="text-sm md:text-lg">
                  <i class="fab fa-whatsapp text-blue-600 mr-2"></i> WhatsApp:
                  <a
                    href="https://wa.me/6281234567890"
                    target="_blank"
                    class="text-blue-600 hover:underline"
                    >+62 812-3456-7890</a
                  >
                </p>
                <p class="text-sm md:text-lg">
                  <i class="fas fa-envelope text-blue-600 mr-2"></i> Email:
                  <a
                    href="mailto:info@arayagamestation.com"
                    class="text-blue-600 hover:underline"
                    >info@arayagamestation.com</a
                  >
                </p>
                <p class="text-sm md:text-lg">
                  <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i> Alamat:
                  Jl. Contoh No. 123, Banjarmasin, Kalimantan Selatan
                </p>
              </div>
            </div>
          </section>
          
        </main>
        
        <footer class="relative mt-8">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
        <path fill="#0099ff" fill-opacity="0.85" d="M0,192L48,186.7C96,181,192,171,288,154.7C384,139,480,117,576,133.3C672,149,768,203,864,218.7C960,235,1056,213,1152,202.7C1248,192,1344,192,1392,192L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>
    <div class="absolute bottom-0 left-0 right-0 w-full text-center">
        <p class="text-white font-bold text-xs md:text-sm py-2">© 2025 Araya Gamestation. Semua Hak Dilindungi.</p>
    </div>
</footer>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
        <script>
          const hamburgerBtn = document.getElementById('hamburger-btn');
          const mobileMenu = document.getElementById('mobile-menu');
          const navLinks = document.querySelectorAll('#mobile-menu a');
    
          hamburgerBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
          });
    
          navLinks.forEach(link => {
            link.addEventListener('click', () => {
              mobileMenu.classList.add('hidden');
            });
          });
    
          // --- GSAP Animations ---
          gsap.registerPlugin(ScrollTrigger);
    
          // Hero Section Animation
          gsap.from(".hero-title", {
            y: -50,
            opacity: 0,
            duration: 1,
            ease: "power2.out"
          });
          gsap.from(".hero-subtitle", {
            y: 50,
            opacity: 0,
            duration: 1,
            ease: "power2.out",
            delay: 0.5
          });
          gsap.from(".hero-image-container", {
            y: 100,
            opacity: 0,
            duration: 1,
            ease: "power2.out",
            delay: 1
          });
    
          // Section Titles Animation
          gsap.utils.toArray(".section-title").forEach(title => {
            gsap.from(title, {
              y: 30,
              opacity: 0,
              duration: 0.8,
              ease: "power2.out",
              scrollTrigger: {
                trigger: title,
                start: "top 90%"
              }
            });
          });
    
          // Fasilitas Cards Animation
          gsap.utils.toArray("#fasilitas .card-item").forEach((card, i) => {
            gsap.from(card, {
              y: 50,
              opacity: 0,
              duration: 0.8,
              ease: "power2.out",
              delay: i * 0.1, // Staggered effect
              scrollTrigger: {
                trigger: "#fasilitas",
                start: "top 80%"
              }
            });
          });
    
          // Game Covers Animation
          gsap.utils.toArray("#game .game-cover").forEach((cover, i) => {
            gsap.from(cover, {
              scale: 0.5,
              opacity: 0,
              duration: 0.8,
              ease: "back.out(1.7)",
              delay: i * 0.05,
              scrollTrigger: {
                trigger: "#game",
                start: "top 80%"
              }
            });
          });
    
          // Map and Contact Section Animation
          gsap.from("#lokasi .map-container", {
            y: 50,
            opacity: 0,
            duration: 1,
            ease: "power2.out",
            scrollTrigger: {
              trigger: "#lokasi",
              start: "top 80%"
            }
          });
          gsap.from("#kontak .kontak-details", {
            y: 50,
            opacity: 0,
            duration: 1,
            ease: "power2.out",
            scrollTrigger: {
              trigger: "#kontak",
              start: "top 80%"
            }
          });
        </script>
      </body>
    </html>