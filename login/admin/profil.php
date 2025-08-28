<?php 
include '../function.php';

// Cek apakah user sudah login
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:../");
    exit();
}

$id_user = $_SESSION['id_user'];

// Ambil data profil user saat ini dari database
$query_profil = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'");
$data_profil = mysqli_fetch_assoc($query_profil);

?>

<?php include 'ui/head.php'; ?>

<body id="page-top">
    <div id="wrapper">
        <?php include 'ui/sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'ui/topbar.php'; ?>

                <div class="container-fluid">
                    <center><h1 class="h3 mb-4 text-gray-800">Profil <?= $data_profil['nama_lengkap']; ?></h1></center>

                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Foto Profil</h6>
                                </div>
                                <div class="card-body text-center">
                                    <img src="<?= htmlspecialchars($data_profil['foto']); ?>" alt="Foto Profil" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Profil</h6>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= htmlspecialchars($data_profil['nama_lengkap']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cabang">Cabang</label>
                                            <select class="form-control" id="cabang" name="cabang" required>
                                                <option value="Gambut" <?= ($data_profil['cabang'] == 'Gambut') ? 'selected' : ''; ?>>Gambut</option>
                                                <option value="Beruntung" <?= ($data_profil['cabang'] == 'Beruntung') ? 'selected' : ''; ?>>Beruntung</option>
                                                <option value="Manarap" <?= ($data_profil['cabang'] == 'Manarap') ? 'selected' : ''; ?>>Manarap</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto">Foto Profil Anda</label>
                                            <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*">
                                            
                                        </div>
                                        <button type="submit" name="update_profil" class="btn btn-primary btn-sm">Simpan</button>
                                    </form>
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


    <?php include 'ui/mobile.php'; ?>
    <?php include 'ui/js.php'; ?>
</body>
</html>