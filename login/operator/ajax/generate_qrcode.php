<?php
// Memanggil library php qrcode
include "phpqrcode/qrlib.php"; 

// Mengambil konten dari parameter GET
$qr_content = isset($_GET['content']) ? $_GET['content'] : 'Data tidak tersedia';

// Set header untuk memberitahu browser bahwa ini adalah gambar PNG
header('Content-Type: image/png');

// Menghasilkan QR code dan langsung mengeluarkannya ke output browser
// Parameter kedua di set ke false (atau null) agar tidak disimpan ke file
// QRcode::png(isi, false, level_pemulihan, pixel, frame);
QRcode::png(urldecode($qr_content), false, QR_ECLEVEL_L, 10, 5);
?>