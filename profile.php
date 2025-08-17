<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Saya - Sewa PS</title>
    <link rel="stylesheet" href="style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
  </head>
  <body>
    <nav class="navbar">
      <div class="nav-brand">
        <a href="index.html">Sewa PS</a>
      </div>
      <ul class="nav-links">
        <li>
          <a href="index.html#features">
            <i class="fas fa-hand-sparkles"></i>
            <span>Fasilitas</span>
          </a>
        </li>
        <li>
          <a href="index.html#games">
            <i class="fas fa-gamepad"></i>
            <span>Game</span>
          </a>
        </li>
        <li>
          <a href="index.html#available-units">
            <i class="fa-brands fa-playstation"></i>
            <span>Unit</span>
          </a>
        </li>
        <li>
          <a href="index.html#contact">
            <i class="fas fa-headset"></i>
            <span>Kontak</span>
          </a>
        </li>
        <li>
          <a href="index.html#location">
            <i class="fas fa-map-marker-alt"></i>
            <span>Lokasi</span>
          </a>
        </li>
        <li>
          <a href="#" class="login-link active">
            <i class="fas fa-user"></i>
            <span>Saya</span>
          </a>
        </li>
      </ul>
    </nav>

    <main class="profile-page-main">
      <section id="user-profile" class="section">
        <div class="profile-header">
          <div class="profile-avatar">
            <img
              src="https://via.placeholder.com/100/3498db/FFFFFF?text=JD"
              alt="User Avatar"
            />
            <div class="edit-avatar-icon"><i class="fas fa-camera"></i></div>
          </div>
          <h2>Halo, John Doe!</h2>
          <p class="user-tier">
            Tier: <span class="tier-name">Premium Gamer</span>
            <i class="fas fa-star"></i>
          </p>
          <a href="#" class="btn btn-edit-profile"
            ><i class="fas fa-edit"></i> Edit Profil</a
          >
        </div>

        <div class="profile-details-grid">
          <div class="detail-card">
            <h3><i class="fas fa-crown"></i> Member Sejak</h3>
            <p>1 Januari 2024</p>
          </div>
          <div class="detail-card">
            <h3><i class="fas fa-calendar-alt"></i> Tenggat Member</h3>
            <p>31 Desember 2025</p>
          </div>
          <div class="detail-card">
            <h3><i class="fas fa-check-circle"></i> Status Member</h3>
            <p class="status-active">Aktif</p>
          </div>
          <div class="detail-card">
            <h3><i class="fas fa-wallet"></i> Pembayaran</h3>
            <p><a href="#" class="action-link">Lihat Riwayat</a></p>
          </div>
          <div class="detail-card">
            <h3><i class="fas fa-trophy"></i> Poin Season</h3>
            <p><strong>1,250</strong> Poin</p>
            <a href="#" class="action-link">Leaderboard Season</a>
          </div>
          <div class="detail-card">
            <h3><i class="fas fa-globe"></i> Poin Semua Season</h3>
            <p><strong>5,800</strong> Poin</p>
            <a href="#" class="action-link">Leaderboard Global</a>
          </div>
        </div>

        <div class="profile-actions">
          <button class="btn btn-logout">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </div>
      </section>
    </main>

    <footer>
      <p>© 2025 Sewa PS. Semua Hak Dilindungi.</p>
    </footer>

    <script>
      // Placeholder untuk script halaman profil
      // Di sini Anda akan menambahkan logika untuk:
      // - Mengambil data profil dari backend
      // - Mengisi data ke elemen HTML
      // - Mengarahkan ke halaman edit profil
      // - Mengimplementasikan fungsi logout
      console.log("Profile page loaded.");
    </script>
  </body>
</html>
