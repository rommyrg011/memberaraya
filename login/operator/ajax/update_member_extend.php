<?php
require_once('../../function.php');

if (!isset($koneksi) || $koneksi->connect_error) {
    echo '<div class="alert alert-danger">Koneksi database gagal. Silakan periksa file function.php.</div>';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $memberid = $_POST['memberid'];
    $tier = $_POST['tier'];
    $pembayaran = $_POST['pembayaran'];
    $nama = $_POST['nama'];
    $wa = $_POST['wa'];
    $operator = $_SESSION['nama_lengkap'];;
    $status = 'Aktif';

    $duration_days = 0;
    switch ($tier) {
        case 'Bronze':
            $duration_days = 30;
            break;
        case 'Silver':
            $duration_days = 90;
            break;
        case 'Gold':
            $duration_days = 180;
            break;
        default:
            echo '<div class="alert alert-danger">Tier tidak valid.</div>';
            exit();
    }
    
    $start_date_obj = new DateTime();
    $start_date_str = $start_date_obj->format('Y-m-d');
    
    $expired_date_obj = new DateTime();
    $expired_date_obj->modify("+$duration_days days");
    $new_expired = $expired_date_obj->format('Y-m-d');
    
    $sql_update = "UPDATE member SET tier = ?, pembayaran = ?, start = ?, expired = ?, status = ?, operator = ?, nama = ?, wa = ? WHERE memberid = ?";
    $stmt_update = $koneksi->prepare($sql_update);
    $stmt_update->bind_param("sssssssss", $tier, $pembayaran, $start_date_str, $new_expired, $status, $operator, $nama, $wa, $memberid);

    if ($stmt_update->execute()) {
        echo '<div class="alert alert-success">Perpanjangan member berhasil!</div>';
    } else {
        echo '<div class="alert alert-danger">Gagal memperpanjang member. ' . $stmt_update->error . '</div>';
    }
    
    $stmt_update->close();
    $koneksi->close();
}