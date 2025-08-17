<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>

    <script src="vendor/chart.js/Chart.min.js"></script>

    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script>
      // Original scroll effect (can be removed if not needed for mobile navbar, as fixed bottom makes it less relevant)
      let lastScrollTop = 0;
      const mobileNavbar = document.querySelector(".mobile-bottom-navbar"); // Changed to target the new element

      window.addEventListener(
        "scroll",
        function () {
          const scrollTop =
            window.pageYOffset || document.documentElement.scrollTop;

          if (scrollTop > lastScrollTop) {
            // Scroll ke bawah
            // mobileNavbar.classList.add("scrolled"); // You might not want this for a fixed bottom bar
          } else {
            // Scroll ke atas
            // mobileNavbar.classList.remove("scrolled"); // You might not want this for a fixed bottom bar
          }

          lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        },
        false
      );
    </script>

    <!-- bagian cetak card member -->
    <script>
        function saveMemberCardAsImage() {
            const cardElement = document.getElementById('memberCard');

            html2canvas(cardElement, {
                scale: 3, // Meningkatkan skala untuk kualitas gambar yang lebih baik
                useCORS: true, // Penting jika ada gambar eksternal (misal: QR Code dari API)
                logging: false
            }).then(function(canvas) {
                const imageData = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = imageData;
                link.download = 'member_card_anggota.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        }
    </script>

<!-- Untuk generate auto id member -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const namaLengkapInput = document.getElementById('nama-lengkap');
    const tierSelect = document.getElementById('tier-select');
    const idMemberInput = document.getElementById('id-member');

    // Tambahkan event listener untuk memicu pembuatan ID
    if (namaLengkapInput && tierSelect && idMemberInput) {
        namaLengkapInput.addEventListener('input', generateId);
        tierSelect.addEventListener('change', generateId);
    }

    // Fungsi utama untuk menghasilkan ID baru
    function generateId() {
        const nama = namaLengkapInput.value.trim();
        const tier = tierSelect.value;
        
        // Periksa apakah input nama dan pilihan tier sudah diisi
        if (nama !== '' && tier !== '-- Pilih Tier --') {
            const randomId = generateRandomCode(8); // Buat ID acak dengan 8 karakter
            idMemberInput.value = randomId;
        } else {
            // Jika salah satu atau keduanya kosong, hapus ID
            idMemberInput.value = '';
        }
    }

    // Fungsi untuk membuat string acak dengan panjang tertentu
    function generateRandomCode(length) {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
    
    // Fungsi 'getTierPrefix' sebelumnya telah dihapus karena tidak lagi diperlukan.
});
</script>

<!-- untuk expired Otomatis -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const namaLengkapInput = document.getElementById('nama-lengkap');
    const tierSelect = document.getElementById('tier-select');
    const idMemberInput = document.getElementById('id-member');
    const expiredDateInput = document.getElementById('expired-date');

    // Listener untuk menghasilkan ID member dan tanggal
    if (namaLengkapInput && tierSelect && idMemberInput && expiredDateInput) {
        namaLengkapInput.addEventListener('input', generateIdAndDate);
        tierSelect.addEventListener('change', generateIdAndDate);
    }
    
    // Fungsi utama untuk menghasilkan ID dan tanggal kedaluwarsa
    function generateIdAndDate() {
        const nama = namaLengkapInput.value.trim();
        const tier = tierSelect.value;
        
        // Periksa apakah nama tidak kosong dan tier sudah dipilih
        if (nama !== '' && tier !== '-- Pilih Tier --') {
            // Logika untuk ID Member yang sepenuhnya acak
            const randomId = generateRandomCode(8); // Buat ID acak dengan panjang 8 karakter
            idMemberInput.value = randomId;

            // Logika untuk tanggal kedaluwarsa
            const expiredDate = getExpiredDate(tier);
            expiredDateInput.value = expiredDate;

        } else {
            // Jika salah satu atau keduanya kosong, hapus ID dan tanggal kedaluwarsa
            idMemberInput.value = '';
            expiredDateInput.value = '';
        }
    }

    // Fungsi untuk membuat string acak dengan panjang tertentu
    // Hapus getTierPrefix karena tidak lagi diperlukan
    function generateRandomCode(length) {
        let result = '';
        // Karakter yang akan digunakan: huruf besar, huruf kecil, dan angka
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    // Fungsi untuk menghitung tanggal kedaluwarsa berdasarkan tier
    function getExpiredDate(tier) {
        const today = new Date();
        let daysToAdd = 0;

        switch (tier) {
            case 'Gold':
                daysToAdd = 180;
                break;
            case 'Silver':
                daysToAdd = 90;
                break;
            case 'Bronze':
                daysToAdd = 30;
                break;
        }

        today.setDate(today.getDate() + daysToAdd);
        
        // Format tanggal menjadi YYYY-MM-DD (format standar input date)
        const dd = String(today.getDate()).padStart(2, '0');
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const yyyy = today.getFullYear();

        return `${yyyy}-${mm}-${dd}`;
    }
});
</script>
  </body>
</html>