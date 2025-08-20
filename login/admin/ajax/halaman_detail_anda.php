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
    <title>Detail Anggota: <?= htmlspecialchars($member_data['nama']) ?></title>
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
            min-height: 100vh;
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
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        h1 {
            color: #1a73e8;
            margin-top: 0;
        }
        .qr-code-container {
            margin: 30px 0;
        }
        .qr-code-container img {
            width: 180px;
            height: 180px;
            border: 5px solid #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            text-align: left;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            color: #555;
        }
        .info-value {
            color: #777;
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
            <h1>Detail Anggota</h1>
            <p>Informasi lengkap mengenai anggota.</p>
        </div>
        
        <div class="qr-code-container">
            <img src="<?= htmlspecialchars($qr_code_url) ?>" alt="QR Code Anggota">
        </div>

        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">ID Anggota:</span>
                <span class="info-value"><?= htmlspecialchars($member_data['memberid']) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Nama:</span>
                <span class="info-value"><?= htmlspecialchars($member_data['nama']) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Tier:</span>
                <span class="info-value"><?= htmlspecialchars($member_data['tier']) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Tanggal Mulai:</span>
                <span class="info-value"><?= htmlspecialchars($start_date) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Tanggal Kadaluarsa:</span>
                <span class="info-value"><?= htmlspecialchars($expired_date) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Status:</span>
                <span class="info-value"><?= htmlspecialchars($member_data['status']) ?></span>
            </div>
            </div>

        <a href="javascript:history.back()" class="back-button">Kembali</a>
    </div>
</body>
</html>
<?php
    } else {
        // Data tidak ditemukan
        echo "<h1>Anggota tidak ditemukan.</h1>";
    }
} else {
    // Tidak ada memberid di URL
    echo "<h1>ID Anggota tidak diberikan.</h1>";
}
?>