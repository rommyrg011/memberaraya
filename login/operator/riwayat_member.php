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
          <div class="d-sm-flex align-items-center mb-4">
          </div>

          <script>
            // membuat alert auto close
            window.setTimeout(function() {
              $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
              });
            }, 4000);
          </script>
          
          <div class="card shadow mb-3">
            <div class="card-header py-2">
              <br>
              <h4 class="m-0 font-weight-bold text-primary text-center">History Member</h4>
              <br>
              <?php
              if(isset($_SESSION['notif'])){
              ?>
                <div class="alert alert-success mt-2">
                  <?php echo $_SESSION['notif']; ?>
                </div>
              <?php
                unset($_SESSION['notif']);
              }
              ?>
            </div>
            
            <div class="card-body py-1 mt-3">
              <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>CABANG</th>
                      <th>OPERATOR</th>
                      <th>ID MEMBER</th>
                      <th>NAMA</th>
                      <th>GENDER</th>
                      <th>WA</th>
                      <th>TIER</th>
                      <th>START</th>
                      <th>EXPIRED</th>
                      <th>STATUS</th>
                      <th>PEMBAYARAN</th>
                      <th>POINT</th>
                      <th>QR</th>
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

      
    </div>
  </div>

  <?php include 'ui/mobile.php'; ?>

  
  <?php include 'ui/js.php'; ?>

  <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  
  <script>
    $(document).ready(function() {
      var dataTable = $('#dataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url": "ajax/ajax_riwayat_member.php",
          "type": "POST"
        },
        "columns": [
          { "data": "no", "orderable": false },
          { "data": "cabang" },
          { "data": "operator" },
          { "data": "memberid" },
          { "data": "nama" },
          { "data": "gender" },
          { "data": "wa" },
          { "data": "tier" },
          { "data": "start" },
          { "data": "expired" },
          { "data": "status" },
          { "data": "pembayaran" },
          { "data": "semua_point" },
          { "data": "qr_code" },
        ],
        // "order": [[ 3, "asc" ]]
      });
    });
  </script>

</body>
</html>