<?php
session_start();

$koneksi = mysqli_connect('localhost', 'root', '', 'araya');

//tambah member
if(isset($_POST['tambahMember'])){
    $cabang = $_POST['cabang'];
    $operator = $_POST['operator'];
    $memberid = $_POST['memberid'];
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $wa = $_POST['wa'];
    $tier = $_POST['tier'];
    $expired = $_POST['expired'];
    $status = $_POST['status'];
    $pembayaran = $_POST['pembayaran'];
    $semua_point = $_POST['semua_point'];

    $tMember = mysqli_query($koneksi, "insert into member (cabang, operator, memberid, nama, gender, wa, tier, expired, status, pembayaran, semua_point) values
    ('$cabang', '$operator', '$memberid', '$nama', '$gender', '$wa', '$tier', '$expired', '$status', '$pembayaran', '$semua_point')");
        if($tMember){
            $_SESSION['notif'] = "Berhasil Ditambahkan";
        header('location: member.php');
        } else {
            echo '
            <script>alert("Gagal");
            window.location.href="member.php"
            </script>';
        }
    }
//tambah Poin member
if(isset($_POST['tambahPoinMember'])){
    // Mengambil data dari form input_poin.php
    $memberid_string = $_POST['memberid_from_select']; // PERBAIKAN DI SINI
    $point_baru = $_POST['semua_point'];
    $pembayaran = $_POST['pembayaran'];

    // Ambil data cabang dan operator langsung dari sesi user yang sedang login
    $cabang_user = $_SESSION['cabang']; 
    $operator_user = $_SESSION['nama_lengkap'];

    // 1. Dapatkan poin lama dan id_member (integer) dari tabel member
    $ambil_data_member = mysqli_query($koneksi, "SELECT id_member, semua_point FROM member WHERE memberid = '$memberid_string'");
    $data_member = mysqli_fetch_assoc($ambil_data_member);

    if($data_member){
        $id_member_int = $data_member['id_member'];
        $poin_lama = (int)$data_member['semua_point'];
        $poin_baru_int = (int)$point_baru;

        $total_poin_baru = $poin_lama + $poin_baru_int;

        // 2. Update total poin di tabel member
        $update_member = mysqli_query($koneksi, "UPDATE member SET semua_point = '$total_poin_baru' WHERE id_member = '$id_member_int'");
        
        // 3. Masukkan record poin baru ke tabel input_poin
        $insert_poin = mysqli_query($koneksi, "INSERT INTO input_poin (id_member, pembayaran, point, cabang, operator) VALUES ('$id_member_int', '$pembayaran', '$poin_baru_int', '$cabang_user', '$operator_user')");

        if($update_member && $insert_poin){
            $_SESSION['notif'] = "Poin Berhasil Ditambahkan!";
            header('location: poin.php');
        } else {
            echo '
            <script>alert("Gagal menambahkan poin.");
            window.location.href="input_poin.php"
            </script>';
        }

    } else {
        echo '
        <script>alert("ID member tidak ditemukan.");
        window.location.href="input_poin.php"
        </script>';
    }
}

// Handle form submission
if (isset($_POST['update_profil'])) {
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $cabang = mysqli_real_escape_string($koneksi, $_POST['cabang']);
    $foto_lama = $data_profil['foto'];
    $foto_baru = $foto_lama;

    // Handle foto jika ada upload baru
    if ($_FILES['foto']['name']) {
        $dir_foto = "img/profil/";
        $nama_file = uniqid() . '_' . basename($_FILES['foto']['name']);
        $path_file = $dir_foto . $nama_file;
        
        // Pindahkan file yang diupload
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $path_file)) {
           // Hapus foto lama jika bukan foto default
            if ($foto_lama != $dir_foto . 'circle.png' && file_exists($foto_lama)) {
                unlink($foto_lama);
            }
            $foto_baru = $path_file;
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
        header("location: profil.php");
        exit();
    } else {
        $_SESSION['alert'] = 'danger';
        $_SESSION['pesan'] = 'Gagal memperbarui profil: ' . mysqli_error($koneksi);
        header("location: profil.php");
        exit();
    }
}
?>