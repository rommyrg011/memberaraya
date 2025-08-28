<?php
include '../function.php';

if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
 header("location:../");
 exit();
}

?>

<?php include 'ui/head.php'; ?>

<body id="page-top">
 <div id="wrapper">
 <?php include 'ui/sidebar.php'; ?>

 <div id="content-wrapper" class="d-flex flex-column">
  <div id="content">
  <?php include 'ui/topbar.php'; ?>

  <div class="container-fluid">
  <div
   class="d-sm-flex align-items-center justify-content-center mb-4"
   >
   
   </div>
   <div class="card shadow mb-4">
      <div class="card-header py-3">
       <h4 class="m-0 font-weight-bold text-primary text-center"> Input Member</h4>
      </div>
      <form method="post" autocomplete="off">
      <div class="card-body">

       <input type="hidden" name="cabang" value="<?= htmlspecialchars($_SESSION['cabang']); ?>">
              <input type="hidden" name="operator" value="<?= htmlspecialchars($_SESSION['nama_lengkap']); ?>">

       <div class="mb-3">
        <label class="form-label">ID Member :</label>
        <input type="text" id="id-member" class="form-control" placeholder="ID Member" readonly name="memberid">
       </div>

       <div class="mb-3">
        <label class="form-label">Nama Lengkap :</label>
        <input type="text" id="nama-lengkap" class="form-control" placeholder="Nama Lengkap" name="nama">
       </div>

       <div class="mb-3">
        <label class="form-label">Gender :</label>
        <select type="text" class="form-control" name="gender">
        <option hidden> -- Pilih Gender --</option>
        <option>Laki - laki</option>
        <option>Perempuan</option>
        </select>
       </div>

       <div class="mb-3">
        <label class="form-label">No Whatsapp :</label>
        <input type="number" id="no-whatsapp" class="form-control" placeholder="No Whatsapp" name="wa">
       </div>

       <div class="mb-3">
        <label class="form-label">Tier :</label>
        <select type="text" id="tier-select" class="form-control" name="tier">
        <option hidden> -- Pilih Tier --</option>
        <option value="Bronze">Bronze</option>
        <option value="Silver">Silver</option>
        <option value="Gold">Gold</option>
        </select>
       </div>

       <input type="hidden" name="start">

       <div class="mb-3">
        <label class="form-label">Expired :</label>
        <input type="text" id="expired-date" class="form-control" placeholder="Expired Member" readonly name="expired">
       </div>

       <input type="hidden" name="status" value="Aktif">

       <div class="mb-3">
        <label class="form-label">Pembayaran :</label>
        <select type="text" class="form-control" name="pembayaran">
        <option hidden> -- Pilih Pembayaran --</option>
        <option>Cash</option>
        <option>Qris</option>
        
        </select>
       </div>

       <input type="hidden" name="semua_point" value="0">

              <div class="d-flex justify-content-center mt-4">
        <button type="submit" class="btn btn-primary btn-sm mr-2" name="tambahMember">Submit</button>
        <a href="member" type="button" class="btn btn-secondary btn-sm mr-2">Kembali</a>
        
       </div>
       </form>
      </div>
     </div>
 </div>
 <a class="scroll-to-top rounded" href="#page-top">
 <i class="fas fa-angle-up"></i>
 </a>

 </div>

 <?php include 'ui/mobile.php'; ?>
 
 <?php include 'ui/js.php'; ?>
    
  <script>
  document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk membuat ID member acak
        function generateMemberId(length = 8) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }

        // Fungsi untuk menghitung tanggal expired berdasarkan tier
        const tierSelect = document.getElementById('tier-select');
        const expiredDateInput = document.getElementById('expired-date');

        function updateExpiredDate() {
            const selectedTier = tierSelect.value;
            const today = new Date();
            let newDate = new Date();

            switch (selectedTier) {
                case 'Bronze':
                    newDate.setDate(today.getDate() + 30); // 30 hari
                    break;
                case 'Silver':
                    newDate.setDate(today.getDate() + 90); // 90 hari
                    break;
                case 'Gold':
                    newDate.setDate(today.getDate() + 180); // 180 hari
                    break;
                default:
                    expiredDateInput.value = '';
                    return;
            }

            const formattedDate = newDate.getFullYear() + '-' + 
                                 String(newDate.getMonth() + 1).padStart(2, '0') + '-' + 
                                 String(newDate.getDate()).padStart(2, '0');
            expiredDateInput.value = formattedDate;
        }

        // Jalankan fungsi saat tier berubah
        tierSelect.addEventListener('change', updateExpiredDate);
        
        // --- Bagian yang Diperbaiki ---
        const namaLengkapInput = document.getElementById('nama-lengkap');
        const memberIdInput = document.getElementById('id-member');

        // Tambahkan event listener ke input Nama Lengkap
        namaLengkapInput.addEventListener('input', function() {
            // Cek apakah input nama lengkap tidak kosong
            if (this.value.trim() !== '') {
                // Hasilkan ID member baru
                memberIdInput.value = generateMemberId();
            } else {
                // Kosongkan ID member jika input nama lengkap kosong
                memberIdInput.value = '';
            }
        });
        // --- Akhir Bagian yang Diperbaiki ---
    });
    </script>
</body>
</html>