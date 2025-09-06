<?php
// Sertakan file koneksi database Anda
include '../../function.php';

// Cek apakah parameter id telah diterima
if(isset($_GET['id'])){
    // Ambil id dari URL dan bersihkan dari karakter berbahaya
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Query untuk menghapus data dari tabel user berdasarkan id
    $query = "DELETE FROM user WHERE id_user = '$id'";
    
    // Jalankan query
    if(mysqli_query($koneksi, $query)){
        // Jika penghapusan berhasil, simpan notifikasi ke session
        $_SESSION['notif'] = "Data administrator berhasil dihapus.";
        // Alihkan kembali ke halaman administrator
        header("location:../administrator");
        exit();
    } else {
        // Jika penghapusan gagal, simpan pesan error ke session
        $_SESSION['notif'] = "Gagal menghapus data: " . mysqli_error($koneksi);
        // Alihkan kembali ke halaman administrator
        header("location:../administrator");
        exit();
    }
} else {
    // Jika parameter id tidak ditemukan, alihkan kembali
    header("location:../administrator");
    exit();
}
?>