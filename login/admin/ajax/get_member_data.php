<?php
// Sertakan file koneksi database
include '../../function.php';

header('Content-Type: application/json');

$response = array();

if (isset($_GET['memberid'])) {
    $memberid = trim($_GET['memberid']);

    // Pastikan semua kolom yang diperlukan diambil dari database
    // PERBAIKAN: Menambahkan kolom 'status' dan 'start' ke dalam query
    $sql = "SELECT memberid, nama, wa, tier, start, expired, status FROM member WHERE memberid = ?";
    $stmt = $koneksi->prepare($sql);
    
    if ($stmt === false) {
        $response['status'] = 'error';
        $response['message'] = 'Gagal menyiapkan statement: ' . $koneksi->error;
        echo json_encode($response);
        exit;
    }

    $stmt->bind_param("s", $memberid);
    $stmt->execute();
    $result = $stmt->get_result();
    $member_data = $result->fetch_assoc();
    $stmt->close();

    if ($member_data) {
        // Format tanggal agar selalu terbaca dan tidak kosong
        $start_date = isset($member_data['start']) && $member_data['start'] !== '0000-00-00' ? date('d-m-Y', strtotime($member_data['start'])) : '-';
        $expired_date = isset($member_data['expired']) && $member_data['expired'] !== '0000-00-00' ? date('d-m-Y', strtotime($member_data['expired'])) : '-';

        // Siapkan array data yang sudah diformat untuk respons
        $formatted_data = [
            'memberid' => $member_data['memberid'],
            'nama' => $member_data['nama'],
            'wa' => $member_data['wa'],
            'tier' => $member_data['tier'],
            'start' => $start_date,
            'expired' => $expired_date,
            'status' => $member_data['status']
        ];
        
        $response['status'] = 'success';
        $response['message'] = 'Data member ditemukan.';
        $response['data'] = $formatted_data;
    } else {
        $response['status'] = 'error';
        $response['message'] = '<span style="color: red; font-weight: bold;">Data member tidak ditemukan.</span>';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Member ID tidak valid.';
}

echo json_encode($response);
?>