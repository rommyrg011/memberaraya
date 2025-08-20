<?php
// Sertakan file koneksi database
require_once('../../function.php');

$memberid = isset($_GET['memberid']) ? $_GET['memberid'] : '';

if (empty($memberid)) {
    die("Member ID tidak ditemukan.");
}

// Ambil data anggota dari database
$sql = "SELECT nama, tier, status, expired, memberid FROM member WHERE memberid = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $memberid);
$stmt->execute();
$result = $stmt->get_result();
$member_data = $result->fetch_assoc();

if (!$member_data) {
    die("Data anggota tidak ditemukan.");
}

$member_name = $member_data['nama'];
$member_tier = $member_data['tier'];
$expired_date = new DateTime($member_data['expired']);
$formatted_expired_date = $expired_date->format('d F Y');

// Data untuk QR Code
$qr_content = json_encode([
    'ID' => $memberid,
    'Nama' => $member_name,
    'Tier' => $member_tier,
    'Expired' => $formatted_expired_date
]);

$qr_code_url_api = 'https://api.qrserver.com/v1/create-qr-code/?size=700x700&data=' . urlencode($qr_content);

// Tentukan lokasi penyimpanan file
$folder_path = '../../images/qrcodes/';
if (!is_dir($folder_path)) {
    mkdir($folder_path, 0755, true);
}
$file_path = $folder_path . $memberid . '.png';

// Unduh gambar QR code dari API dan simpan secara lokal
$image_data = @file_get_contents($qr_code_url_api);
if ($image_data !== false) {
    file_put_contents($file_path, $image_data);
   
} else {
    die("Gagal mengunduh QR Code dari API.");
}

?>