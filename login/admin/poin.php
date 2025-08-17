<?php 
include 'koneksi.php';
include '../function.php';
 ?>

<?php include 'ui/head.php'; ?>
<link href="css/mobile-table.css" rel="stylesheet">

<body id="page-top">
  <div id="wrapper">
    <?php include 'ui/sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include 'ui/topbar.php'; ?>

        <div class="container-fluid">
          <div
            class="d-sm-flex align-items-center mb-4"
          >

          </div>

            <script>
                //membuat alert auto close
                window.setTimeout(function() {
                $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 4000);

            </script>
          
          <div class="card shadow mb-3">
            <div class="card-header py-3">
              <h4 class="m-0 font-weight-bold text-primary text-center">Input Poin Member</h4>
              <center><a href="input_poin.php" class="btn btn-secondary btn-sm mt-3"><i class="fas fa-plus"></i> Tambah Point</a></center>
              <br>
              <?php
              //jika berhasil insert
              if(isset($_SESSION['notif'])){
                            
              ?>
                <div class="alert alert-success">
                  <?php echo $_SESSION['notif']; ?>
                </div>
                            
                <?php
                  unset($_SESSION['notif']);
                }
                ?>

            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>CABANG</th>
                      <th>OPERATOR</th>
                      <th>ID MEMBER</th>
                      <th>NAMA</th>
                      <th>POINT DI DAPAT</th>
                      <th>OPSI</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>

      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              Select "Logout" below if you are ready to end your current session.
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">
                Cancel
              </button>
              <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'ui/mobile.php'; ?>
  
  <?php include 'ui/js.php'; ?>

  <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  
  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url": "ajax/ajax_poin.php",
          "type": "POST"
        },
        "columns": [
          { "data": "no", "orderable": false }, // 'no' tidak ada di database, jadi tidak bisa diurutkan
          { "data": "cabang" },
          { "data": "operator" },
          { "data": "memberid" },
          { "data": "nama" },
          { "data": "poin" },
          { "data": "opsi", "orderable": false } // 'opsi' juga tidak ada di database
        ],
        "order": [[ 3, "asc" ]] // Mengatur pengurutan default pada kolom 'ID MEMBER' secara menurun
      });
    });
  </script>
</body>
</html>