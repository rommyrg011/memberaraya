<?php
// Sertakan file koneksi database
include '../../function.php';

header('Content-Type: application/json');

$response = array();

if (isset($_GET['memberid'])) {
    $memberid = $_GET['memberid'];

    $sql = "SELECT memberid, nama, wa FROM member WHERE memberid = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $memberid);
    $stmt->execute();
    $result = $stmt->get_result();
    $member_data = $result->fetch_assoc();

    if ($member_data) {
        $response['status'] = 'success';
        $response['message'] = 'Data member ditemukan.';
        $response['data'] = $member_data;
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Data member tidak ditemukan.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Member ID tidak valid.';
}

echo json_encode($response);
?>