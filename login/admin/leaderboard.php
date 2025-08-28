<?php

include '../function.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:../");
    exit();
}
?>

<?php include 'ui/head.php'; ?>
<style>
    .chart-container {
        position: relative;
        height: 80vh; /* Menggunakan viewport height untuk tinggi responsif */
        width: 100%;
        margin-top: 20px;
    }
    /* === Tambahan Kode CSS untuk Tampilan Mobile === */
    @media (max-width: 767px) {
        .card-header h4 {
            font-size: 1.25rem !important; /* Mengubah ukuran font judul menjadi lebih kecil */
        }
        .card-header br {
            display: none; /* Menghapus baris baru untuk judul lebih ringkas */
        }
    }
</style>

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
                            <h4 class="m-0 font-weight-bold text-primary text-center">Leaderboard <br> Member Araya Gamestation</h4>
                            <br>
                            
                            <div id="alertMessage"></div>
                        </div>
                        
                        <div class="card-body py-1 mt-3">
                            <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>RANK</th>
                                            <th>ID MEMBER</th>
                                            <th>NAMA</th>
                                            <th>TIER</th>
                                            <th>POINT</th>
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
    
    <script src="https://cdn.jsdelivr.net/npm/@zxing/library@0.19.1/umd/index.min.js"></script>

    <script>
    var codeReader = null;
    var videoStream = null;

    $(document).ready(function() {
        var dataTable = $('#dataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "paging": false,
            "info": false,
            "searching": false,
            "ordering": false,
            "ajax": {
                "url": "ajax/ajax_leaderboard.php",
                "type": "POST"
            },
            "columns": [
                { "data": "no" },
                { "data": "memberid" },
                { "data": "nama" },
                { "data": "tier" },
                { "data": "semua_point" }
            ],
        });
    });
        
</script>