<?php
// Pastikan path ke koneksi.php sudah benar
include '../../function.php';

// Cek apakah metode request adalah POST dan 'id' ada di dalam data yang dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $member_id = $_POST['id'];
    
    // Tentukan path ke folder QR codes
    $qr_code_path = '../../images/qrcodes/';

    // Tentukan nama file QR code yang akan dihapus
    // Format nama file adalah memberid.png
    $file_to_delete = $qr_code_path . $member_id . '.png';

    // Periksa apakah file ada sebelum mencoba menghapusnya
    if (file_exists($file_to_delete)) {
        if (unlink($file_to_delete)) {
            // File berhasil dihapus, lanjutkan dengan penghapusan database
            $sql = "DELETE FROM member WHERE memberid = ?";
            
            $stmt = $koneksi->prepare($sql);

            if ($stmt === false) {
                echo '<div class="alert alert-danger">Error saat menyiapkan statement: ' . htmlspecialchars($koneksi->error) . '</div>';
                exit();
            }
            
            $stmt->bind_param("s", $member_id);
            
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo '<div class="alert alert-success">Berhasil menghapus member.</div>';
                } else {
                    echo '<div class="alert alert-warning">Tidak ada member yang ditemukan di database, tetapi file QR code berhasil dihapus jika ada.</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Error saat menjalankan query: ' . htmlspecialchars($stmt->error) . '</div>';
            }

            $stmt->close();
        } else {
            // Gagal menghapus file
            echo '<div class="alert alert-warning">Gagal menghapus file QR code. Namun, data member akan tetap dihapus dari database.</div>';
            
            // Lanjutkan penghapusan database meskipun file gagal dihapus
            $sql = "DELETE FROM member WHERE memberid = ?";
            $stmt = $koneksi->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("s", $member_id);
                $stmt->execute();
                $stmt->close();
            }
        }
    } else {
        // File tidak ditemukan, hapus data di database saja
        $sql = "DELETE FROM member WHERE memberid = ?";
        
        $stmt = $koneksi->prepare($sql);

        if ($stmt === false) {
            echo '<div class="alert alert-danger">Error saat menyiapkan statement: ' . htmlspecialchars($koneksi->error) . '</div>';
            exit();
        }
        
        $stmt->bind_param("s", $member_id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo '<div class="alert alert-success">Berhasil menghapus member.</div>';
            } else {
                echo '<div class="alert alert-warning">Tidak ada member yang ditemukan di database.</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Error saat menjalankan query: ' . htmlspecialchars($stmt->error) . '</div>';
        }

        $stmt->close();
    }
    
} else {
    echo '<div class="alert alert-danger">Metode tidak diizinkan atau data tidak lengkap.</div>';
}

$koneksi->close();
?>