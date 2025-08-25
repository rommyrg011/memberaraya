<?php
// Sertakan file koneksi database
require_once('../../function.php');

// Memeriksa apakah memberid ada di URL
if (isset($_GET['memberid'])) {
    // Gunakan prepared statement untuk mencegah SQL injection
    $stmt = $koneksi->prepare("SELECT * FROM member WHERE memberid = ?");
    $stmt->bind_param("s", $_GET['memberid']);
    $stmt->execute();
    $result = $stmt->get_result();
    $member_data = $result->fetch_assoc();
    $stmt->close();

    if ($member_data) {
        // Data ditemukan, siapkan data untuk QR code dan tampilkan
        $start_date = isset($member_data['start']) && $member_data['start'] !== '0000-00-00' ? date('d-m-Y', strtotime($member_data['start'])) : '-';
        $expired_date = isset($member_data['expired']) && $member_data['expired'] !== '0000-00-00' ? date('d-m-Y', strtotime($member_data['expired'])) : '-';
        
        $qr_data_array = [
            'Member ID' => $member_data['memberid'],
            'Nama' => $member_data['nama'],
            'Tier' => $member_data['tier'],
            'Mulai' => $start_date,
            'Kadaluarsa' => $expired_date
        ];
        
        $qr_content = json_encode($qr_data_array);
        $qr_code_url = 'generate_qrcode.php?content=' . urlencode($qr_content);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode <?= htmlspecialchars($member_data['nama']) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        .header {
            
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        h1 {
            color: #1a73e8;
            margin-top: 0;
        }
        .qr-code-container {
            margin: 5px 0;
        }
        .qr-code-container img {
            width: 180px;
            height: 180px;
            border: 5px solid #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        
        .back-button {
            margin-top: 30px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #1a73e8;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .back-button:hover {
            background-color: #155bb5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><?=$member_data['nama']; ?></h1>
        </div>
        
        <div class="qr-code-container">
            <img src="<?= htmlspecialchars($qr_code_url) ?>" alt="Barcode Member">
        </div>
        <center><h2><?= $member_data['memberid']; ?></h2></center>

        <a href="javascript:history.back()" class="back-button">Kembali</a>
    </div>
</body>
</html>
<?php
    } else {
        // Data tidak ditemukan
        echo "<h1>Member tidak ditemukan.</h1>";
    }
} else {
    // Tidak ada memberid di URL
    echo "<h1>ID Member tidak diberikan.</h1>";
}
?>