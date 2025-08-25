<?php

include '../function.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php include 'ui/head.php'; ?>

<body id="page-top">
    <div id="wrapper">
        <?php include 'ui/sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php include 'ui/topbar.php'; ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center mb-4">
                    </div>

                    <script>
                        // membuat alert auto close
                        window.setTimeout(function() {
                            $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove();
                            });
                        }, 4000);
                    </script>
                    
                    <div class="card shadow mb-3">
                        <div class="card-header py-2">
                            <h4 class="m-0 font-weight-bold text-primary text-center">Member <br> Araya Gamestation</h4>
                            <div class="text-center my-2">
                                <a href="input_member.php" class="btn btn-secondary btn-sm btn-mobile btn-xs">
                                    <i class="fas fa-plus"></i> Add
                                </a>
                                <button id="editRow" class="btn btn-warning btn-sm btn-mobile btn-xs" disabled>
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button id="deleteRow" class="btn btn-danger btn-sm btn-mobile btn-xs" disabled>
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                                <button id="extendRow" class="btn btn-info btn-sm btn-mobile btn-xs" disabled>
                                    <i class="fas fa-redo"></i> Extend
                                </button>
                                <button id="scanBarcodeBtn" class="btn btn-dark btn-sm btn-mobile btn-xs">
                                    <i class="fas fa-barcode"></i> Scan
                                </button>
                                <button id="printRow" class="btn btn-primary btn-sm btn-mobile btn-xs" disabled>
                                    <i class="fas fa-address-card"></i> Print
                                </button>
                                <button id="showSendWaModal" class="btn btn-success btn-sm btn-mobile btn-xs" disabled>
                                    <i class="fab fa-whatsapp"></i> Kirim
                                </button>
                            </div>
                            <div id="alertMessage"></div>
                            <?php
                            if(isset($_SESSION['notif'])){
                            ?>
                                <div class="alert alert-success mt-2">
                                    <?php echo $_SESSION['notif']; ?>
                                </div>
                            <?php
                                unset($_SESSION['notif']);
                            }
                            ?>
                        </div>
                        
                        <div class="card-body py-1 mt-3">
                            <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>CABANG</th>
                                            <th>OPERATOR</th>
                                            <th>ID MEMBER</th>
                                            <th>NAMA</th>
                                            <th>GENDER</th>
                                            <th>WA</th>
                                            <th>TIER</th>
                                            <th>START</th>
                                            <th>EXPIRED</th>
                                            <th>STATUS</th>
                                            <th>PEMBAYARAN</th>
                                            <th>POINT</th>
                                            <th>QR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <div class="modal fade" id="editMemberModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Data Member</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editForm">
                                <input type="hidden" name="memberid" id="editMemberId">
                                <div class="form-group">
                                    <label for="editNama">Nama</label>
                                    <input type="text" class="form-control" id="editNama" name="nama">
                                </div>
                                <div class="form-group">
                                    <label for="editWa">No. WhatsApp</label>
                                    <input type="text" class="form-control" id="editWa" name="wa">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
                            <button id="saveEdit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="extendMemberModal" tabindex="-1" role="dialog" aria-labelledby="extendModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="extendModalLabel">Perpanjang Member</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="extendForm">
                                <input type="hidden" name="memberid" id="extendMemberId">
                                <input type="hidden" name="nama" id="extendNama">
                                <input type="hidden" name="wa" id="extendWa">

                                <div class="form-group">
                                    <label for="displayMemberId">ID Member</label>
                                    <input type="text" class="form-control" id="displayMemberId" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="displayNama">Nama Member</label>
                                    <input type="text" class="form-control" id="displayNama" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="extendTier">Pilih Tier</label>
                                    <select class="form-control" id="extendTier" name="tier" required>
                                        <option value="" hidden>-- Pilih Tier --</option>
                                        <option value="Bronze">Bronze</option>
                                        <option value="Silver">Silver</option>
                                        <option value="Gold">Gold</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="extendPembayaran">Metode Pembayaran</label>
                                    <select class="form-control" id="extendPembayaran" name="pembayaran">
                                        <option value="Cash">Cash</option>
                                        <option value="QRIS">QRIS</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
                            <button id="saveExtend" class="btn btn-primary btn-sm">Perpanjang</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-labelledby="scanModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scanModalLabel">Scan Barcode</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <video id="scannerVideo" width="100%" height="auto" playsinline></video>
                            <div class="mt-2 text-muted" id="scannerMessage">Arahkan kamera ke barcode...</div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="viewMemberModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewModalLabel">Data Member</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>ID Member</label>
                                <input type="text" class="form-control" id="viewMemberId" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" id="viewNama" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tier</label>
                                <input type="text" class="form-control" id="viewTier" readonly>
                            </div>
                            <div class="form-group">
                                <label>Mulai</label>
                                <input type="text" class="form-control" id="viewStart" readonly>
                            </div>
                            <div class="form-group">
                                <label>Kadaluarsa</label>
                                <input type="text" class="form-control" id="viewExpired" readonly>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" id="viewStatus" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="sendWaModal" tabindex="-1" role="dialog" aria-labelledby="sendWaModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="sendWaModalLabel">Kirim Pesan WhatsApp</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="sendWaForm" enctype="multipart/form-data">
                                <input type="hidden" name="memberid" id="sendWaMemberId">
                                <input type="hidden" name="memberName" id="sendWaMemberName">
                                <div class="form-group">
                                    <label for="sendWaNumber">Nomor WhatsApp</label>
                                    <input type="text" class="form-control" id="sendWaNumber" name="number" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="sendWaMessage">Isi Pesan</label>
                                    <textarea class="form-control" id="sendWaMessage" name="message" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="sendWaLink">Link Download (Opsional)</label>
                                    <input type="url" class="form-control" id="sendWaLink" name="link" placeholder="Masukkan URL lengkap, misal: https://example.com">
                                    <small class="form-text text-muted">Link akan ditambahkan di akhir pesan dan bisa diklik.</small>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
                            <button id="sendWaBtn" class="btn btn-success btn-sm">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    <?php include 'ui/mobile.php'; ?>
    
    <?php include 'ui/js.php'; ?>

    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@zxing/library@0.19.1/umd/index.min.js"></script>

    <script>
    var codeReader = null;
    var videoStream = null;

    $(document).ready(function() {
        var dataTable = $('#dataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "ajax/ajax_member.php",
                "type": "POST"
            },
            "columns": [
                { "data": "no", "orderable": false },
                { "data": "cabang" },
                { "data": "operator" },
                { "data": "memberid" },
                { "data": "nama" },
                { "data": "gender" },
                { "data": "wa" },
                { "data": "tier" },
                { "data": "start" },
                { "data": "expired" },
                { "data": "status" },
                { "data": "pembayaran" },
                { "data": "semua_point" },
                { "data": "qr_code"}
            ],
        });
        
        // Menambahkan kelas 'selected' saat baris diklik
        $('#dataTable tbody').on('click', 'tr', function() {
            $('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            $('#deleteRow').prop('disabled', false);
            $('#editRow').prop('disabled', false);
            $('#extendRow').prop('disabled', false);
            $('#printRow').prop('disabled', false);
            $('#showSendWaModal').prop('disabled', false);
        });

        // Fungsi untuk menonaktifkan semua tombol aksi
        function disableActionButtons() {
            $('#deleteRow').prop('disabled', true);
            $('#editRow').prop('disabled', true);
            $('#extendRow').prop('disabled', true);
            $('#printRow').prop('disabled', true);
            $('#showSendWaModal').prop('disabled', true);
            $('tr.selected').removeClass('selected');
        }

        // Menangani klik tombol delete
        $('#deleteRow').on('click', function() {
            var selectedRow = dataTable.row('.selected');
            if (selectedRow.length) {
                var rowData = selectedRow.data();
                var memberId = rowData.memberid;
                if (confirm("Yakin ingin menghapus member dengan ID MEMBER " + memberId + "?")) {
                    $.ajax({
                        url: "ajax/delete_member.php",
                        method: "POST",
                        data: { id: memberId },
                        success: function(response){
                            $('#alertMessage').html(response);
                            dataTable.ajax.reload(null, false);
                            disableActionButtons();
                            setTimeout(function() {
                                $('#alertMessage').empty();
                            }, 6000);
                        },
                        error: function(xhr, status, error) {
                            $('#alertMessage').html('<div class="alert alert-danger">Terjadi kesalahan: ' + xhr.responseText + '</div>');
                        }
                    });
                }
            } else {
                alert("Pilih satu baris untuk dihapus.");
            }
        });

        // Menangani klik tombol edit
        $('#editRow').on('click', function() {
            var selectedRow = dataTable.row('.selected');
            if (selectedRow.length) {
                var rowData = selectedRow.data();
                $('#editMemberId').val(rowData.memberid);
                $('#editNama').val(rowData.nama);
                $('#editWa').val(rowData.wa);
                $('#editMemberModal').modal('show');
            } else {
                alert("Pilih satu baris untuk diedit.");
            }
        });

        // Menangani klik tombol simpan di modal edit
        $('#saveEdit').on('click', function() {
            var formData = $('#editForm').serialize();
            $.ajax({
                url: "ajax/update_member.php",
                method: "POST",
                data: formData,
                success: function(response){
                    $('#editMemberModal').modal('hide');
                    $('#alertMessage').html(response);
                    dataTable.ajax.reload(null, false);
                    disableActionButtons();
                    setTimeout(function() {
                        $('#alertMessage').empty();
                    }, 6000);
                },
                error: function(xhr, status, error) {
                    $('#alertMessage').html('<div class="alert alert-danger">Terjadi kesalahan: ' + xhr.responseText + '</div>');
                }
            });
        });
        
        // Menangani klik tombol perpanjang
        $('#extendRow').on('click', function() {
            var selectedRow = dataTable.row('.selected');
            if (selectedRow.length) {
                var rowData = selectedRow.data();
                $('#extendMemberId').val(rowData.memberid);
                $('#displayMemberId').val(rowData.memberid);
                $('#extendNama').val(rowData.nama);
                $('#displayNama').val(rowData.nama);
                $('#extendWa').val(rowData.wa);
                $('#extendMemberModal').modal('show');
            } else {
                alert("Pilih satu baris untuk diperpanjang.");
            }
        });

        // Menangani klik tombol simpan di modal perpanjang
        $('#saveExtend').on('click', function() {
            var formData = $('#extendForm').serialize();
            $.ajax({
                url: "ajax/update_member_extend.php",
                method: "POST",
                data: formData,
                success: function(response){
                    $('#extendMemberModal').modal('hide');
                    $('#alertMessage').html(response);
                    dataTable.ajax.reload(null, false);
                    disableActionButtons();
                    setTimeout(function() {
                        $('#alertMessage').empty();
                    }, 6000);
                },
                error: function(xhr, status, error) {
                    $('#alertMessage').html('<div class="alert alert-danger">Terjadi kesalahan: ' + xhr.responseText + '</div>');
                }
            });
        });

        // Menangani klik tombol cetak
        $('#printRow').on('click', function() {
            var selectedRow = dataTable.row('.selected');

            if (selectedRow.length) {
                var rowData = selectedRow.data();
                var memberId = rowData.memberid;
                window.open("member_card.php?memberid=" + memberId, '_blank');
            } else {
                alert("Pilih satu baris untuk dicetak.");
            }
        });
        
        // Menangani klik tombol untuk menampilkan modal kirim WhatsApp
        $('#showSendWaModal').on('click', function() {
            var selectedRow = dataTable.row('.selected');
            if (selectedRow.length) {
                var rowData = selectedRow.data();
                var memberId = rowData.memberid;
                var memberName = rowData.nama;
                var memberWa = rowData.wa;
                
                // Ambil teks dari kolom yang berisi HTML
                var memberTier = selectedRow.cell(':eq(7)').nodes().to$().text().trim();
                var memberStatus = selectedRow.cell(':eq(10)').nodes().to$().text().trim();
                var memberExpired = rowData.expired;

                if (memberWa) {
                    var cleanWa = memberWa.replace(/\D/g, '');
                    if (!cleanWa.startsWith('62')) {
                        if (cleanWa.startsWith('0')) {
                           cleanWa = '62' + cleanWa.slice(1);
                        } else {
                           cleanWa = '62' + cleanWa;
                        }
                    }
                    $('#sendWaMemberId').val(memberId);
                    $('#sendWaMemberName').val(memberName);
                    $('#sendWaNumber').val(cleanWa);
                    
                    var defaultMessage = `Halo ${memberName}, ini adalah informasi member Anda:\n\n` +
                                         `*ID Member*: ${memberId}\n` +
                                         `*Tier*: ${memberTier}\n` +
                                         `*Status*: ${memberStatus}\n` +
                                         `*Berlaku*: ${memberExpired}\n\n` +
                                        //  `Terima kasih telah menjadi member Araya Gamestation\n` +
                                         `Berikut adalah link download member card anda :`;
                    $('#sendWaMessage').val(defaultMessage);
                    
                    $('#sendWaModal').modal('show');
                } else {
                    alert("Nomor WhatsApp untuk member ini tidak tersedia.");
                }
            } else {
                alert("Pilih satu baris untuk mengirim pesan WhatsApp.");
            }
        });

        // Menangani klik tombol kirim di dalam modal
        $('#sendWaBtn').on('click', function() {
            var formData = new FormData($('#sendWaForm')[0]);
            var btn = $(this);
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim...');

            // Dapatkan pesan dari textarea
            var message = $('#sendWaMessage').val();
            // Dapatkan link dari input field
            var link = $('#sendWaLink').val().trim();

            // Gabungkan pesan dan link
            if (link) {
                // Perbaikan: Pastikan link memiliki prefix http/https
                if (!link.startsWith('http://') && !link.startsWith('https://')) {
                    link = 'https://' + link;
                }
                message += '\n\n' + link;
            }

            // Ganti pesan di formData dengan pesan yang sudah digabungkan
            formData.set('message', message);
            // Hapus input link dari formData karena sudah digabungkan
            formData.delete('link');

            $.ajax({
                url: 'ajax/send_whatsapp.php',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    $('#sendWaModal').modal('hide');
                    if(response.status === 'success') {
                        $('#alertMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                    } else {
                        $('#alertMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                    btn.prop('disabled', false).html('Kirim');
                    setTimeout(function() {
                        $('#alertMessage').empty();
                    }, 6000);
                },
                error: function(xhr, status, error) {
                    $('#sendWaModal').modal('hide');
                    $('#alertMessage').html('<div class="alert alert-danger">Terjadi kesalahan. Silakan cek konsol browser atau log server. Detail: ' + xhr.responseText + '</div>');
                    btn.prop('disabled', false).html('Kirim');
                    
                    console.error("AJAX Error:", status, error);
                    console.log("XHR:", xhr.responseText);

                    setTimeout(function() {
                        $('#alertMessage').empty();
                    }, 6000);
                }
            });
        });
        
       // --- Fitur Scan Barcode Baru ---
        
        // Ketika tombol scan diklik
        $('#scanBarcodeBtn').on('click', function() {
            if (typeof ZXing === 'undefined') {
                $('#scannerMessage').text('Error: Library scanner gagal dimuat. Coba refresh halaman.');
                $('#scanModal').modal('show');
                return;
            }
            
            $('#scannerMessage').text('Arahkan kamera ke barcode...');
            $('#scanModal').modal('show');
        });

        // Ketika modal scanner ditampilkan
        $('#scanModal').on('shown.bs.modal', function() {
            startScanner();
        });

        // Ketika modal scanner ditutup
        $('#scanModal').on('hidden.bs.modal', function() {
            stopScanner();
        });

        function startScanner() {
            codeReader = new ZXing.BrowserQRCodeReader();
            const videoElement = document.getElementById('scannerVideo');

            codeReader.decodeFromVideoDevice(null, videoElement, (result, err) => {
                if (result) {
                    console.log('Barcode berhasil discan:', result.text);
                    stopScanner();
                    $('#scanModal').modal('hide');
                    
                    let memberId = null;
                    try {
                        const scannedData = JSON.parse(result.text);
                        if (scannedData["Member ID"]) {
                            memberId = scannedData["Member ID"];
                        }
                    } catch (e) {
                        memberId = result.text;
                    }
                    
                    if (memberId) {
                        fetchMemberData(memberId);
                    } else {
                    $('#alertMessage').html('<div class="alert alert-danger">Error: Data barcode tidak valid. Silakan coba lagi.</div>');
                    }
                }
                if (err && !(err instanceof ZXing.NotFoundException)) {
                    if (err.name === 'NotAllowedError') {
                        $('#scannerMessage').text('Akses kamera ditolak. Mohon izinkan akses kamera.');
                    } else if (err.name === 'NotFoundError') {
                        $('#scannerMessage').text('Tidak ada kamera yang ditemukan di perangkat ini.');
                    } else {
                        $('#scannerMessage').text('Error: ' + err);
                        console.error(err);
                    }
                }
            }).then(result => {
                if (result && result.getVideoTracks) {
                    videoStream = result.getVideoTracks()[0];
                }
            }).catch(err => {
                console.error(err);
            });
        }

        function stopScanner() {
            if (codeReader) {
                codeReader.reset();
            }
            if (videoStream) {
                videoStream.stop();
                videoStream = null;
            }
        }

        function fetchMemberData(memberId) {
            $.ajax({
                url: "ajax/get_member_data.php",
                method: "GET",
                data: { memberid: memberId },
                dataType: "json",
                success: function(data) {
                    if (data.status === 'success') {
                        // Mengisi inputan di modal viewMemberModal
                        $('#viewMemberId').val(data.data.memberid);
                        $('#viewNama').val(data.data.nama);
                        $('#viewTier').val(data.data.tier);
                        $('#viewStart').val(data.data.start);
                        $('#viewExpired').val(data.data.expired);
                        $('#viewStatus').val(data.data.status); // Menambahkan status

                        // Menampilkan modal yang benar
                        $('#viewMemberModal').modal('show');
                        
                        $('#alertMessage').html('<div class="alert alert-success">Data member berhasil di temukan.</div>');
                        
                        setTimeout(function() {
                            $('#alertMessage').empty();
                        }, 6000);
                        
                    } else {
                        $('#alertMessage').html('<div class="alert alert-success">' + data.message + '</div>');
                        
                    }
                },
                error: function(xhr, status, error) {
                    $('#alertMessage').html('<div class="alert alert-success">' + xhr.responseText + ' (Status: ' + status + ', Error: ' + error + ')</div>');
                }
            });
        }
    });
        
</script>
</body>
</html>