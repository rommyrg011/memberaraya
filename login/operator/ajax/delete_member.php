<?php
// Pastikan path ke koneksi.php sudah benar
include '../../function.php';

// Cek apakah metode request adalah POST dan 'id' ada di dalam data yang dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $member_id = $_POST['id'];
    
    // Ganti 'member' dengan nama tabel Anda
    // Ganti 'memberid' dengan nama kolom ID di tabel Anda
    $sql = "DELETE FROM member WHERE memberid = ?";
    
    $stmt = $koneksi->prepare($sql);

    if ($stmt === false) {
        echo '<div class="alert alert-danger">Error saat menyiapkan statement: ' . htmlspecialchars($koneksi->error) . '</div>';
        exit();
    }
    
    // 's' menandakan tipe data string. Ubah menjadi 'i' jika ID adalah integer
    $stmt->bind_param("s", $member_id);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo '<div class="alert alert-success">Berhasil menghapus member</div>';
        } else {
            echo '<div class="alert alert-warning">Tidak ada member yang ditemukan</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Error saat menjalankan query: ' . htmlspecialchars($stmt->error) . '</div>';
    }

    $stmt->close();
    
} else {
    echo '<div class="alert alert-danger">Metode tidak diizinkan atau data tidak lengkap.</div>';
}

$koneksi->close();
?>