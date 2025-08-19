<?php

// Pastikan ID member disediakan
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400);
    exit("ID Member dibutuhkan.");
}

$member_id = $_GET['id'];
$data_to_encode = $member_id;

// Sertakan library PHP QR Code
// Sesuaikan path ini jika Anda tidak menggunakan Composer
require 'vendor/autoload.php';

use chillerlan\QRCode\{QRCode, QROptions};

// Atur opsi untuk Kode QR
$options = new QROptions([
    'version'    => 5,
    'outputType' => QRCode::OUTPUT_IMAGE_PNG,
    'eccLevel'   => QRCode::ECC_L,
    'imageTransparent' => false,
]);

// Hasilkan Kode QR
try {
    $qrcode = new QRCode($options);
    header('Content-Type: image/png');
    echo $qrcode->render($data_to_encode);
} catch (Exception $e) {
    http_response_code(500);
    // Jika ada error, kirimkan output berupa teks error
    // Ini membantu debugging
    echo "Gagal membuat kode QR: " . $e->getMessage();
}