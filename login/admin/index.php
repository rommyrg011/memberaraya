<?php 
include '../function.php';

// Cek apakah user sudah login
// Jika belum, alihkan ke halaman login
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:../");
    exit();
}

$a=mysqli_query($koneksi,"select * from member where tier='Bronze'");
$b=mysqli_num_rows($a);

$c=mysqli_query($koneksi,"select * from member where tier='Silver'");
$d=mysqli_num_rows($c);

$e=mysqli_query($koneksi,"select * from member where tier='Gold'");
$f=mysqli_num_rows($e);
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
                        class="d-sm-flex align-items-center justify-content-between mb-4"
                    >
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-bottom-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div
                                                class="text-xs font-weight-bold text-danger text-uppercase mb-1"
                                            >
                                                Bronze
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?=$b; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chess-pawn fa-2x text-gray-300""></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-bottom-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div
                                                class="text-xs font-weight-bold text-secondary text-uppercase mb-1"
                                            >
                                                Silver
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?=$d;?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chess-queen fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-bottom-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div
                                                class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                                            >
                                                Gold
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?=$f;?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chess-king fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 mb-4">
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

                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <h4 class="m-0 font-weight-bold text-primary text-center">Grafik Tingkatan <br> Member Araya Gamestation</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="tierChart"></canvas>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    </div>

    <?php include 'ui/mobile.php'; ?>
    
    <?php include 'ui/js.php'; ?>
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        // Inisialisasi Chart dengan warna baru
        var ctx = document.getElementById('tierChart').getContext('2d');
        var tierChart = new Chart(ctx, {
            type: 'line', 
            data: {
                labels: ['Bronze', 'Silver', 'Gold'],
                datasets: [{
                    label: 'Jumlah',
                    data: [<?= $b ?>, <?= $d ?>, <?= $f ?>],
                    backgroundColor: [
                        'rgba(220, 53, 69, 0.2)', // Merah untuk Bronze
                        'rgba(108, 117, 125, 0.2)', // Abu-abu untuk Silver
                        'rgba(255, 193, 7, 0.2)' // Emas untuk Gold
                    ],
                    borderColor: [
                        'rgb(220, 53, 69)',
                        'rgb(108, 117, 125)',
                        'rgb(255, 193, 7)'
                    ],
                    borderWidth: 2,
                    tension: 0.4,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Member'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tier'
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
        
    </script>
</body>
</html>