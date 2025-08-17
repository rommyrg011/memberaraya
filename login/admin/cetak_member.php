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

        /* Container untuk Member Card */
        #member-card-to-capture {
            width: 85.6mm;
            height: 53.98mm;
            /* border-radius: 12px; */
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

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid rgba(255, 255, 255, 0.4);
            padding-bottom: 5px;
            margin-bottom: 3px;
            position: relative;
            z-index: 10;
        }

        .logo-section {
            display: flex;
            align-items: center;
            font-size: 0.6em;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.1;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            text-align: left;
        }

        .logo-icon {
            font-size: 1.8em;
            color: #FFD700;
            margin-right: 4px;
            line-height: 1;
        }

        .tier-badge {
            font-size: 0.7em;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 5px;
            background-color: #FFD700;
            color: #4A0070;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            text-transform: uppercase;
            line-height: 1;
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3px 0;
            position: relative;
            z-index: 5;
        }

        .main-content-block {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
            padding: 0 15px;
        }

        .member-name {
            font-family: 'Roboto', sans-serif;
            font-size: 1.6em;
            font-weight: 700;
            color: #fff;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
            text-transform: uppercase;
            line-height: 1.2;
            text-align: center;
            margin-top: 0;
            margin-bottom: 15px;
            width: 100%;
        }

        .member-details-grid {
            display: grid;
            grid-template-columns: auto auto;
            gap: 15px;
            flex-grow: 0;
            margin-top: 0;
            width: auto;
        }

        .detail-block {
            font-size: 0.6em;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.3;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            width: auto;
        }

        .detail-item {
            display: grid;
            grid-template-columns: min-content auto;
            gap: 5px;
            align-items: baseline;
            margin-bottom: 1px;
            width: 100%;
        }

        .detail-label {
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            text-align: left;
        }

        .detail-value {
            font-weight: 400;
        }

        .card-footer-id {
            font-family: 'Roboto Mono', monospace;
            font-size: 1.1em;
            font-weight: 700;
            color: #FFD700;
            text-align: center;
            margin-top: 5px;
            margin-bottom: 5px;
            position: relative;
            z-index: 10;
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
                <div class="tier-badge">GOLD</div>
            </div>
            <div class="card-body">
                <div class="main-content-block">
                    <div class="member-name">Rommy Gunawan</div>
                    <div class="member-details-grid">
                        <div class="detail-block">
                            <div class="detail-item">
                                <span class="detail-label">STATUS:</span>
                                <span class="detail-value">AKTIF</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">BERLAKU:</span>
                                <span class="detail-value">07 Juli 2026</span>
                            </div>
                        </div>
                        <div class="qr-code">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=RommyGunawan-ID29272-Aktif" alt="QR Code">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer-id">
                <i class="fa fa-circle text-success fa-sm"></i> ID29272
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
            
            // Konfigurasi untuk resolusi gambar yang lebih tinggi
            html2canvas(cardElement, { scale: 3 }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'member_card_rommy_gunawan.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        }
    </script>

</body>
</html>