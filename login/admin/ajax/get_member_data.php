<?php
// Sertakan file koneksi database
include '../../function.php';

header('Content-Type: application/json');

$response = array();

// Memeriksa apakah parameter 'memberid' ada dalam permintaan GET
if (isset($_GET['memberid'])) {
    $memberid = $_GET['memberid'];

    // Perbaikan: Tambahkan kolom 'wa' ke dalam query
    // Ini memastikan bahwa semua data yang dibutuhkan oleh JavaScript tersedia
    $sql = "SELECT memberid, nama, tier, status, expired FROM member WHERE memberid = ?";
    $stmt = $koneksi->prepare($sql);
    
    // Periksa apakah statement berhasil disiapkan
    if ($stmt === false) {
        $response['status'] = 'error';
        $response['message'] = 'Gagal menyiapkan statement: ' . $koneksi->error;
        echo json_encode($response);
        exit;
    }

    // Bind parameter dan eksekusi query
    $stmt->bind_param("s", $memberid);
    $stmt->execute();
    $result = $stmt->get_result();
    $member_data = $result->fetch_assoc();

    // Periksa apakah data ditemukan di database
    if ($member_data) {
        $response['status'] = 'success';
        $response['message'] = 'Data member ditemukan.';
        $response['data'] = $member_data;
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Data member tidak ditemukan.';
    }

    // Tutup statement
    $stmt->close();
} else {
    // Jika 'memberid' tidak ada, berikan respons kesalahan
    $response['status'] = 'error';
    $response['message'] = 'Member ID tidak valid.';
}

echo json_encode($response);
?>