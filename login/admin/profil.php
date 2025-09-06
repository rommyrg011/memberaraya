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

// Handle form submission
if (isset($_POST['update_profil'])) {
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $cabang = mysqli_real_escape_string($koneksi, $_POST['cabang']);
    $foto_lama = $data_profil['foto'];
    $foto_baru = $foto_lama;

    // Handle foto jika ada upload baru
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $dir_foto = "img/profil/";
        $nama_file = uniqid() . '_' . basename($_FILES['foto']['name']);
        $path_file = $dir_foto . $nama_file;
        
        // Pindahkan file yang diunggah
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $path_file)) {
           // Hapus foto lama jika bukan foto default
           if ($foto_lama != $dir_foto . 'circle.png' && file_exists($foto_lama)) {
               unlink($foto_lama);
           }
           $foto_baru = $path_file;
        } else {
            $_SESSION['alert'] = 'danger';
            $_SESSION['pesan'] = 'Gagal mengunggah foto.';
            header("location: profil");
            exit();
        }
    }

    // Update data profil ke database
    $query_update = "UPDATE user SET 
                        nama_lengkap = '$nama_lengkap', 
                        cabang = '$cabang', 
                        foto = '$foto_baru' 
                    WHERE id_user = '$id_user'";
    
    if (mysqli_query($koneksi, $query_update)) {
        // Update session dengan data baru
        $_SESSION['nama_lengkap'] = $nama_lengkap;
        $_SESSION['foto'] = $foto_baru;

        $_SESSION['alert'] = 'success';
        $_SESSION['pesan'] = 'Profil berhasil diperbarui!';
        header("location: profil");
        exit();
    } else {
        $_SESSION['alert'] = 'danger';
        $_SESSION['pesan'] = 'Gagal memperbarui profil: ' . mysqli_error($koneksi);
        header("location: profil");
        exit();
    }
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
                    <center><h1 class="h3 mb-4 text-gray-800">Profil <?= htmlspecialchars($data_profil['nama_lengkap']); ?></h1></center>
                    
                    <?php if (isset($_SESSION['alert'])): ?>
                    <div class="alert alert-<?= htmlspecialchars($_SESSION['alert']); ?> alert-dismissible fade show" role="alert">
                      <?= htmlspecialchars($_SESSION['pesan']); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <script>
                        // membuat alert auto close
                        window.setTimeout(function() {
                            $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove();
                            });
                        }, 4000);
                    </script>
                    <?php 
                      unset($_SESSION['alert']);
                      unset($_SESSION['pesan']);
                    ?>
                    <?php endif; ?>

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
                                        <input type="hidden" name="cabang" value="-">
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