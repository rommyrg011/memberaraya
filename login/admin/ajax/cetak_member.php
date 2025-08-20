<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Card (Unduh Foto)</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
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
            gap: 15px;
        }
        #member-card-to-capture {
            width: 85.6mm;
            height: 53.98mm;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #5D238C 0%, #8A2BE2 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            padding: 10px 15px;
            box-sizing: border-box;
            background-size: cover;
        }
        /* ... (CSS lainnya tidak berubah) ... */
        
        .tier-badge {
            font-size: 0.7em;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 5px;
            /* Menggunakan warna dinamis dari PHP */
            background-color: <?php echo $tier_color; ?>;
            color: #4A0070;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            text-transform: uppercase;
            line-height: 1;
        }

        .qr-code {
            width: 48px;
            height: 48px;
            background-color: #fff;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            flex-shrink: 0;
            padding: 1px;
        }
        .qr-code img {
            width: 95%;
            height: 95%;
            object-fit: contain;
        }
        .download-button {
            padding: 12px 24px;
            font-size: 1em;
            font-weight: 600;
            color: #fff;
            background-color: #009688;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .download-button:hover {
            background-color: #00796b;
        }
    </style>
</head>
<body>
    <div class="action-container">
        <div id="member-card-to-capture">
            <div class="card-header">
                <div class="logo-section">
                    <span class="logo-icon">&#10084;</span>
                    <div>
                        ARAYA <br>GAMESTATION<br>
                    </div>
                </div>
                <div class="tier-badge"><?= $member_tier ?></div>
            </div>
            <div class="card-body">
                <div class="main-content-block">
                    <div class="member-name"><?= $member_name ?></div>
                    <div class="member-details-grid">
                        <div class="detail-block">
                            <div class="detail-item">
                                <span class="detail-label">STATUS:</span>
                                <span class="detail-value"><?= $member_status ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">BERLAKU:</span>
                                <span class="detail-value"><?= $formatted_expired_date ?></span>
                            </div>
                        </div>
                        <div class="qr-code">
                            <img src="<?= $qr_code_url ?>" alt="QR Code">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer-id">
                <i class="fa fa-circle text-success fa-sm"></i> ID<?= $member_id ?>
            </div>
        </div>
        <button class="download-button" onclick="downloadImage()">
            Unduh Foto
        </button>
    </div>

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        function downloadImage() {
            const cardElement = document.getElementById('member-card-to-capture');
            
            html2canvas(cardElement, { scale: 3 }).then(canvas => {
                const link = document.createElement('a');
                // Nama file unduhan dibuat dinamis
                link.download = `member_card_<?= strtolower(str_replace(' ', '_', $member_name)) ?>.png`;
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        }
    </script>
</body>
</html>