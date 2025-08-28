<?php
include '../../function.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:../");
    exit();
}

// Pastikan ID transaksi poin dikirim melalui URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['notif'] = "ID transaksi tidak valid.";
    header('location: poin');
    exit();
}

$id_poin = mysqli_real_escape_string($koneksi, $_GET['id']);

// Mulai transaksi database untuk memastikan operasi berhasil atau gagal bersamaan
mysqli_begin_transaction($koneksi);

try {
    // 1. Ambil data poin yang akan dihapus dan id_member terkait
    $ambil_poin = mysqli_query($koneksi, "SELECT id_member, point FROM input_poin WHERE id_poin = '$id_poin'");
    $data_poin = mysqli_fetch_assoc($ambil_poin);

    // Cek apakah data poin ditemukan
    if (!$data_poin) {
        throw new Exception("Data poin tidak ditemukan.");
    }

    $id_member_int = $data_poin['id_member'];
    $poin_yang_dihapus = (int)$data_poin['point'];

    // 2. Ambil total poin member saat ini
    $ambil_total_poin = mysqli_query($koneksi, "SELECT semua_point FROM member WHERE id_member = '$id_member_int'");
    $data_member = mysqli_fetch_assoc($ambil_total_poin);

    // Cek apakah data member ditemukan
    if (!$data_member) {
        throw new Exception("Data member tidak ditemukan.");
    }

    $total_poin_lama = (int)$data_member['semua_point'];

    // 3. Kurangi total poin member
    $total_poin_baru = $total_poin_lama - $poin_yang_dihapus;

    // Pastikan total poin tidak negatif
    if ($total_poin_baru < 0) {
        $total_poin_baru = 0;
    }

    // 4. Update total poin di tabel member
    $update_member = mysqli_query($koneksi, "UPDATE member SET semua_point = '$total_poin_baru' WHERE id_member = '$id_member_int'");
    if (!$update_member) {
        throw new Exception("Gagal memperbarui total poin member.");
    }

    // 5. Hapus transaksi poin dari tabel input_poin
    $hapus_poin = mysqli_query($koneksi, "DELETE FROM input_poin WHERE id_poin = '$id_poin'");
    if (!$hapus_poin) {
        throw new Exception("Gagal menghapus transaksi poin.");
    }

    // Jika semua operasi berhasil, commit transaksi
    mysqli_commit($koneksi);
    $_SESSION['notif'] = "Data poin berhasil dihapus dan poin member telah dikurangi.";
    header('location: ../poin');
    exit();

} catch (Exception $e) {
    // Jika ada operasi yang gagal, rollback transaksi
    mysqli_rollback($koneksi);
    $_SESSION['notif'] = $e->getMessage();
    header('location: poin');
    exit();
}

?>