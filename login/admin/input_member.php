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
                        <form method="post">
                        <div class="card-body">
                        <div class="mb-3">
                                <label class="form-label">Cabang :</label>
                                <select type="text" class="form-control" name="cabang">
                                  <option hidden> -- Pilih Cabang --</option>
                                  <option>Gambut</option>
                                  <option>Beruntung</option>
                                  <option>Manarap</option>
                                </select>
                            </div>

                            <input type="hidden" name="operator" value="<?=$_SESSION['nama_lengkap']; ?>">

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

                            <!-- <div class="mb-3">
                                <label class="form-label">Point :</label>
                                <input type="number" class="form-control" placeholder="Point Member" name="semua_point">
                            </div> -->

                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn btn-primary btn-sm mr-2" name="tambahMember">Submit</button>
                                <a href="member.php" type="button" class="btn btn-secondary btn-sm mr-2">Kembali</a>
                                
                            </div>
                            </form>
                        </div>
                    </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <div
      class="modal fade"
      id="logoutModal"
      tab-index="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button
              class="close"
              type="button"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Select "Logout" below if you are ready to end your current session.
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-secondary"
              type="button"
              data-dismiss="modal"
            >
              Cancel
            </button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <?php include 'ui/mobile.php'; ?>
    
    <?php include 'ui/js.php'; ?>