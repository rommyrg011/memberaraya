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
                            <h4 class="m-0 font-weight-bold text-primary text-center"> Input Poin Member</h4>
                        </div>
                        <form method="post">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">ID Member :</label>
                                <input type="text" id="id-member" class="form-control" placeholder="ID Member" readonly name="memberid">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap :</label>
                                <input type="text" id="nama-lengkap" class="form-control" placeholder="Nama Lengkap" name="nama">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pembayaran :</label>
                                <select type="text" class="form-control" name="pembayaran">
                                  <option hidden> -- Pilih Pembayaran --</option>
                                  <option>Cash</option>
                                  <option>Qris</option>
                                  
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Point :</label>
                                <input type="number" class="form-control" placeholder="Point Member" name="semua_point">
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn btn-primary btn-sm mr-2" name="tambahMember">Submit</button>
                                <a href="poin.php" type="submit" class="btn btn-secondary btn-sm">Kembali</a>
                            </div>
                            </form>
                        </div>
                    </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <?php include 'ui/alert.php'; ?>
    </div>

    <?php include 'ui/mobile.php'; ?>
    
    <?php include 'ui/js.php'; ?>