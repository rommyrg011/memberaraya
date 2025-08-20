<?php

require '../../../vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

// Data yang ingin Anda simpan dalam QR Code
$data = 'https://www.example.com';

// Buat objek QR Code
$qrCode = QrCode::create($data)
    ->setSize(300);

// Tulis QR Code sebagai gambar PNG
$writer = new PngWriter();
$writer->write($qrCode)->saveToFile('qrcode.png');

echo 'QR Code telah dibuat dan disimpan sebagai qrcode.png';