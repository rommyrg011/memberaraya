<?php
// Sertakan file koneksi database
require_once('../../function.php');

// Panggil skrip untuk menghasilkan dan menyimpan QR Code
require_once('generate_qr.php');

// Ambil memberid dari URL
$memberid = isset($_GET['memberid']) ? $_GET['memberid'] : '';

if (empty($memberid)) {
    echo "<h1>Error: Member ID tidak ditemukan.</h1>";
    exit;
}

// Gunakan prepared statement untuk mengambil data anggota
$sql = "SELECT nama, tier, status, expired, memberid FROM member WHERE memberid = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $memberid);
$stmt->execute();
$result = $stmt->get_result();
$member_data = $result->fetch_assoc();

if (!$member_data) {
    echo "<h1>Error: Data anggota tidak ditemukan.</h1>";
    exit;
}

$member_name = htmlspecialchars($member_data['nama']);
$member_tier = htmlspecialchars($member_data['tier']);
$member_status = htmlspecialchars($member_data['status']);
$member_id = htmlspecialchars($member_data['memberid']);

$expired_date = new DateTime($member_data['expired']);
$formatted_expired_date = $expired_date->format('d F Y');

$tier_color = '';
switch (strtolower($member_tier)) {
    case 'bronze':
        $tier_color = '#CD7F32';
        break;
    case 'silver':
        $tier_color = '#C0C0C0';
        break;
    case 'gold':
        $tier_color = '#FFD700';
        break;
    default:
        $tier_color = '#fff';
        break;
}

// Tentukan path gambar QR Code lokal
$local_qr_path = '../../images/qrcodes/' . $member_id . '.png';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Card (Unduh Foto)</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f7fa;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .action-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        #member-card-to-capture {
            width: 85.6mm;
            height: 53.98mm;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            background: #ffffff;
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 15px;
            box-sizing: border-box;
            position: relative;
        }
        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Properti yang mungkin tidak didukung html2canvas,
               tetapi sering berfungsi dengan baik. Jika tidak,
               ganti dengan gambar statis. */
            background-image: radial-gradient(circle, #f0f0f0 1px, transparent 1px);
            background-size: 8px 8px;
            opacity: 0.4;
            pointer-events: none;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 5px;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 10px;
            z-index: 10;
        }
        .logo-section {
            display: flex;
            align-items: center;
            font-size: 0.7em;
            font-weight: 700;
            color: #444;
            text-align: left;
        }
        .logo-icon {
            font-size: 1.5em;
            color: #5D238C;
            margin-right: 5px;
            line-height: 1;
        }
        .tier-badge {
            font-size: 0.6em;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 20px;
            background-color: <?php echo $tier_color; ?>;
            color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-transform: uppercase;
            line-height: 1;
        }
        .card-body {
            display: flex;
            align-items: center;
            flex-grow: 1;
            gap: 15px;
            z-index: 5;
        }
        .member-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .member-name {
            font-family: 'Poppins', sans-serif;
            font-size: 1.2em;
            font-weight: 700;
            color: #333;
            text-transform: uppercase;
            line-height: 1.2;
            margin: 0 0 5px 0;
        }
        .detail-block {
            font-size: 0.6em;
            color: #666;
            line-height: 1.4;
        }
        .detail-item {
            display: flex;
            gap: 5px;
            margin-bottom: 2px;
        }
        .detail-label {
            font-weight: 600;
            color: #444;
        }
        .detail-value {
            font-weight: 400;
        }
        .qr-code {
            width: 50px;
            height: 50px;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 3px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .qr-code img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .card-footer-id {
            font-family: 'Roboto', sans-serif;
            font-size: 1.1em;
            font-weight: 700;
            color: #5D238C;
            text-align: right;
            margin-top: 5px;
        }
        .download-button {
            padding: 12px 24px;
            font-size: 1em;
            font-weight: 600;
            color: #fff;
            background-color: #5D238C;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .download-button:hover {
            background-color: #4a1c6e;
        }
    </style>
</head>
<body>
    <div class="action-container">
        <div id="member-card-to-capture">
            <div class="bg-pattern"></div>
            <div class="card-header">
                <div class="logo-section">
                    <img src="../../images/logoaraya.png" style="width: 25px; margin-right: 5px;">
                    <div>
                        ARAYA<br>GAMESTATION
                    </div>
                </div>
                <div class="tier-badge" style="background-color: <?php echo $tier_color; ?>"><?php echo $member_tier; ?></div>
            </div>
            <div class="card-body">
                <div class="member-info">
                    <div class="member-name"><?php echo $member_name; ?></div>
                    <div class="detail-block">
                        <div class="detail-item">
                            <span class="detail-label">STATUS:</span>
                            <span class="detail-value"><?php echo $member_status; ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">BERLAKU:</span>
                            <span class="detail-value"><?php echo $formatted_expired_date; ?></span>
                        </div>
                    </div>
                </div>
                <div class="qr-code">
                    <img id="qr-image" src="<?php echo $local_qr_path; ?>" alt="QR Code">
                </div>
            </div>
            <div class="card-footer-id">
                ID<?php echo $member_id; ?>
            </div>
        </div>
        <button class="download-button" onclick="downloadImage()">
            Unduh Foto
        </button>
    </div>

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        function downloadImage() {
            // Tunggu hingga font dan gambar dimuat
            document.fonts.ready.then(() => {
                const cardElement = document.getElementById('member-card-to-capture');
                
                html2canvas(cardElement, { scale: 7 }).then(canvas => {
                    const link = document.createElement('a');
                    link.download = `member_card_<?php echo strtolower(str_replace(' ', '_', $member_name)); ?>.png`;
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                });
            });
        }
    </script>
</body>
</html>