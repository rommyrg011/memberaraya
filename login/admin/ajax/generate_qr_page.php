<?php
// Pastikan ada parameter 'content' di URL
if (isset($_GET['content'])) {
    $content = urlencode($_GET['content']);
    // Ganti path jika file generate_qrcode.php berada di lokasi yang berbeda
    $qr_code_url = 'ajax/generate_qrcode.php?content=' . $content; 
} else {
    // Jika tidak ada konten, tampilkan pesan error atau arahkan kembali
    die("Konten QR Code tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Member</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .qr-container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="qr-container">
        <h1>QR Code</h1>
        <img src="<?php echo htmlspecialchars($qr_code_url); ?>" alt="QR Code">
    </div>
</body>
</html>