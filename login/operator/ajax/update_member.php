<?php
include '../../function.php';

// Periksa apakah metode request adalah POST dan data yang diperlukan ada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['memberid'])) {
    // Ambil data dari form
    $member_id = $_POST['memberid'];
    $nama      = $_POST['nama'];
    $wa        = $_POST['wa'];
    // Data 'cabang' tidak lagi diambil dari POST

    // Query untuk memperbarui data
    // Hapus 'cabang' dari query UPDATE
    $sql = "UPDATE member SET nama = ?, wa = ? WHERE memberid = ?";
    
    $stmt = $koneksi->prepare($sql);

    if ($stmt === false) {
        echo '<div class="alert alert-danger">Error saat menyiapkan statement: ' . htmlspecialchars($koneksi->error) . '</div>';
        exit();
    }
    
    // Bind parameter. "sss" karena hanya ada 3 parameter string (nama, wa, memberid)
    $stmt->bind_param("sss", $nama, $wa, $member_id);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo '<div class="alert alert-success">Berhasil memperbarui data member </div>';
        } else {
            echo '<div class="alert alert-warning">Tidak ada perubahan data yang dilakukan.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Error saat menjalankan query</div>';
    }

    $stmt->close();
    
} else {
    echo '<div class="alert alert-danger">Metode tidak diizinkan atau data tidak lengkap.</div>';
}

$koneksi->close();
?>