<?php
include '../function.php';
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
              <h4 class="m-0 font-weight-bold text-primary text-center">Member <br> Araya Gamestation</h4>
              <div class="text-center my-2">
                <a href="input_member.php" class="btn btn-secondary btn-sm btn-mobile">
                  <i class="fas fa-plus"></i> Add
                </a>
                <button id="editRow" class="btn btn-warning btn-sm btn-mobile btn-xs" disabled>
                  <i class="fas fa-edit"></i> Edit
                </button>
                <button id="deleteRow" class="btn btn-danger btn-sm btn-mobile btn-xs" disabled>
                  <i class="fas fa-trash"></i> Delete
                </button>
                <button id="extendRow" class="btn btn-info btn-sm btn-mobile btn-xs" disabled>
                  <i class="fas fa-redo"></i> extend
                </button>
                <button id="printRow" class="btn btn-primary btn-sm btn-mobile btn-xs" disabled>
                  <i class="fas fa-address-card"></i> Print
                </button>
              </div>
              <div id="alertMessage"></div>
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
                      <th>BARCODE</th> </tr>
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

      <div class="modal fade" id="editMemberModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel">Edit Data Member</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="editForm">
                <input type="hidden" name="memberid" id="editMemberId">
                <div class="form-group">
                  <label for="editNama">Nama</label>
                  <input type="text" class="form-control" id="editNama" name="nama">
                </div>
                <div class="form-group">
                  <label for="editWa">No. WhatsApp</label>
                  <input type="text" class="form-control" id="editWa" name="wa">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
              <button id="saveEdit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
            </div>
          </div>
        </div>
      </div>
      
      <div class="modal fade" id="extendMemberModal" tabindex="-1" role="dialog" aria-labelledby="extendModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="extendModalLabel">Perpanjang Member</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="extendForm">
                <input type="hidden" name="memberid" id="extendMemberId">
                <input type="hidden" name="nama" id="extendNama">
                <input type="hidden" name="wa" id="extendWa">

                <div class="form-group">
                  <label for="displayMemberId">ID Member</label>
                  <input type="text" class="form-control" id="displayMemberId" readonly>
                </div>
                <div class="form-group">
                  <label for="displayNama">Nama Member</label>
                  <input type="text" class="form-control" id="displayNama" readonly>
                </div>
                <div class="form-group">
                  <label for="extendTier">Pilih Tier</label>
                  <select class="form-control" id="extendTier" name="tier" required>
                    <option value="" hidden>-- Pilih Tier --</option>
                    <option value="Bronze">Bronze</option>
                    <option value="Silver">Silver</option>
                    <option value="Gold">Gold</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="extendPembayaran">Metode Pembayaran</label>
                  <select class="form-control" id="extendPembayaran" name="pembayaran">
                    <option value="Cash">Cash</option>
                    <option value="QRIS">QRIS</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
              <button id="saveExtend" class="btn btn-primary btn-sm">Perpanjang</button>
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
      var dataTable = $('#dataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url": "ajax/ajax_member.php",
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
          {
            "data": "memberid",
            "orderable": false,
            "render": function(data, type, row) {
              return '<img src="ajax/generate_barcode.php?id=' + data + '" alt="Barcode" style="height: 50px;">';
            }
          }
        ],
      });
      
      // Menambahkan kelas 'selected' saat baris diklik
      $('#dataTable tbody').on('click', 'tr', function() {
        $('tr.selected').removeClass('selected');
        $(this).addClass('selected');
        $('#deleteRow').prop('disabled', false);
        $('#editRow').prop('disabled', false);
        $('#extendRow').prop('disabled', false);
        $('#printRow').prop('disabled', false);
      });

      // Menangani klik tombol delete
      $('#deleteRow').on('click', function() {
        var selectedRow = dataTable.row('.selected');

        if (selectedRow.length) {
          var rowData = selectedRow.data();
          var memberId = rowData.memberid;

          if (confirm("Apakah Anda yakin ingin menghapus member dengan ID " + memberId + "?")) {
            $.ajax({
              url: "ajax/delete_member.php",
              method: "POST",
              data: { id: memberId },
              success: function(response){
                $('#alertMessage').html(response);
                dataTable.ajax.reload(null, false);
                $('#deleteRow').prop('disabled', true);
                $('#editRow').prop('disabled', true);
                $('#extendRow').prop('disabled', true);
                $('#printRow').prop('disabled', true);
                selectedRow.nodes().to$().removeClass('selected');
                
                setTimeout(function() {
                  $('#alertMessage').empty();
                }, 6000);
              },
              error: function(xhr, status, error) {
                $('#alertMessage').html('<div class="alert alert-danger">Terjadi kesalahan: ' + xhr.responseText + '</div>');
              }
            });
          }
        } else {
          alert("Pilih satu baris untuk dihapus.");
        }
      });

      // Menangani klik tombol edit
      $('#editRow').on('click', function() {
        var selectedRow = dataTable.row('.selected');
        if (selectedRow.length) {
            var rowData = selectedRow.data();
            $('#editMemberId').val(rowData.memberid);
            $('#editNama').val(rowData.nama);
            $('#editWa').val(rowData.wa);
            $('#editMemberModal').modal('show');
        } else {
            alert("Pilih satu baris untuk diedit.");
        }
      });

      // Menangani klik tombol simpan di modal edit
      $('#saveEdit').on('click', function() {
          var formData = $('#editForm').serialize();
          $.ajax({
            url: "ajax/update_member.php",
            method: "POST",
            data: formData,
            success: function(response){
                $('#editMemberModal').modal('hide');
                $('#alertMessage').html(response);
                dataTable.ajax.reload(null, false);
                $('#deleteRow').prop('disabled', true);
                $('#editRow').prop('disabled', true);
                $('#extendRow').prop('disabled', true);
                $('#printRow').prop('disabled', true);
                
                setTimeout(function() {
                  $('#alertMessage').empty();
                }, 6000);
            },
            error: function(xhr, status, error) {
                $('#alertMessage').html('<div class="alert alert-danger">Terjadi kesalahan: ' + xhr.responseText + '</div>');
            }
          });
      });
      
      // Menangani klik tombol perpanjang
      $('#extendRow').on('click', function() {
        var selectedRow = dataTable.row('.selected');
        if (selectedRow.length) {
          var rowData = selectedRow.data();
          $('#extendMemberId').val(rowData.memberid);
          $('#displayMemberId').val(rowData.memberid);
          $('#extendNama').val(rowData.nama);
          $('#displayNama').val(rowData.nama);
          $('#extendWa').val(rowData.wa);
          $('#extendMemberModal').modal('show');
        } else {
          alert("Pilih satu baris untuk diperpanjang.");
        }
      });

      // Menangani klik tombol simpan di modal perpanjang
      $('#saveExtend').on('click', function() {
        var formData = $('#extendForm').serialize();
        $.ajax({
          url: "ajax/update_member_extend.php",
          method: "POST",
          data: formData,
          success: function(response){
            $('#extendMemberModal').modal('hide');
            $('#alertMessage').html(response);
            dataTable.ajax.reload(null, false);
            $('#deleteRow').prop('disabled', true);
            $('#editRow').prop('disabled', true);
            $('#extendRow').prop('disabled', true);
            $('#printRow').prop('disabled', true);
            
            setTimeout(function() {
              $('#alertMessage').empty();
            }, 6000);
          },
          error: function(xhr, status, error) {
            $('#alertMessage').html('<div class="alert alert-danger">Terjadi kesalahan: ' + xhr.responseText + '</div>');
          }
        });
      });

      // Menangani klik tombol cetak
      $('#printRow').on('click', function() {
        var selectedRow = dataTable.row('.selected');

        if (selectedRow.length) {
          var rowData = selectedRow.data();
          var memberId = rowData.memberid;

          window.open("cetak_member.php?id=" + memberId, '_blank');
        } else {
          alert("Pilih satu baris untuk dicetak.");
        }
      });
    });
  </script>

</body>
</html>