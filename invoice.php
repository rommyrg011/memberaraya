<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Fonote</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="invoice-page">
        <div class="nav-bar">
            <a href="#" class="back-link">← Back to Device</a>
            <button class="download-button">Download</button>
        </div>
        
        <div class="invoice-container">
            <div class="invoice-header">
                <div class="logo-area">
                    <img src="https://i.ibb.co/b3wJ1L5/fonnote-logo.png" alt="Fonnote Logo">
                    <span>Fonnte</span>
                </div>
                <div class="header-details">
                    <div class="unpaid-stamp">UNPAID</div>
                    <div class="invoice-number">INVOICE #26413</div>
                    <div class="invoice-date">23 August 2025</div>
                </div>
            </div>

            <div class="content-section">
                <div class="invoice-info">
                    <div class="invoice-to">
                        <div class="info-label">Invoice to</div>
                        <div class="info-value name">Rommy Gunawan</div>
                        <div class="info-contact">6285750755502</div>
                    </div>
                    <div class="payment-method">
                        <div class="info-label">Payment Method</div>
                        <div class="info-value method">BCA</div>
                        <div class="info-contact">0373355329</div>
                        <div class="info-account-holder">David Levi Setyawan</div>
                    </div>
                </div>
                
                <hr class="divider">

                <div class="item-table-section">
                    <div class="item-row header-row">
                        <div class="column-device">DEVICE</div>
                        <div class="column-package">PACKAGE</div>
                        <div class="column-period">PERIOD</div>
                        <div class="column-total">TOTAL</div>
                    </div>
                    <div class="item-row data-row">
                        <div class="column-device">
                            <strong>085750755502</strong>
                            <br>Araya Gamestation
                        </div>
                        <div class="column-package">Lite</div>
                        <div class="column-period">Monthly</div>
                        <div class="column-total">Rp 75.875</div>
                    </div>
                </div>

                <div class="package-details-section">
                    <div class="details-label">Package detail :</div>
                    <ul>
                        <li>Quota : 1.000 Messages</li>
                        <li>AI Quota : 0</li>
                        <li>AI Data : 0</li>
                        <li>Deposit : Rp 10.000,-</li>
                    </ul>
                </div>
            </div>

            <div class="summary-footer">
                <div class="summary-details">
                    <div class="summary-item subtotal">
                        <span class="label">SUBTOTAL</span>
                        <span class="amount">85.000</span>
                    </div>
                    <span class="plus-icon">+</span>
                    <div class="summary-item identifier">
                        <span class="label">IDENTIFIER</span>
                        <span class="amount">875</span>
                    </div>
                </div>
                <div class="total-box">
                    <div class="label">TOTAL</div>
                    <div class="total-amount">Rp 85.875</div>
                </div>
            </div>

            <div class="contact-footer">
                <span class="website">fonnte.com</span>
                <span class="phone-number">6282227097005</span>
            </div>
        </div>
    </div>
</body>
</html>