<?php

// Aktifkan laporan error PHP untuk debugging
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Sertakan file koneksi database Anda
require_once('../../function.php');

// Menggunakan tanggal hari ini untuk perbandingan. Member dianggap expired jika tanggal expirednya lebih kecil dari tanggal hari ini
$current_date = date('Y-m-d');
$sql_update_expired = "UPDATE member SET status = 'Tidak Aktif' WHERE expired < ? AND status = 'Aktif'";
$stmt_update = $koneksi->prepare($sql_update_expired);
if ($stmt_update) {
    $stmt_update->bind_param("s", $current_date);
    $stmt_update->execute();
    $stmt_update->close();
}

// DataTables request parameters dengan validasi
$draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
$row = isset($_POST['start']) ? intval($_POST['start']) : 0;
$rowperpage = isset($_POST['length']) ? intval($_POST['length']) : 10;

// Menghindari SQL Injection pada kolom pengurutan
$columnIndex = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
$columnSortOrder = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc';
$searchValue = isset($_POST['search']['value']) ? mysqli_real_escape_string($koneksi, $_POST['search']['value']) : '';

// Daftar nama kolom yang valid dan sesuai dengan database
$columnNames = [
    'id_member', 'cabang', 'operator', 'memberid', 'nama', 'gender', 'wa', 'tier',
    'start', 'expired', 'status','pembayaran', 'semua_point', 'qr_code'
];

$columnName = 'id_member';
if ($columnIndex > 0 && $columnIndex < count($columnNames) && isset($columnNames[$columnIndex])) {
    $columnName = $columnNames[$columnIndex];
}

## Query untuk total record (tanpa filter)
$sel = mysqli_query($koneksi, "SELECT COUNT(*) as allcount FROM member WHERE status = 'Aktif'");
if (!$sel) {
    http_response_code(500);
    echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
    exit;
}
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Query untuk total record (dengan filter)
$searchQuery = " AND status = 'Aktif' ";
if ($searchValue != '') {
   $searchQuery .= " AND (cabang LIKE '%".$searchValue."%' OR
        operator LIKE '%".$searchValue."%' OR
        memberid LIKE '%".$searchValue."%' OR
        nama LIKE '%".$searchValue."%' OR
        gender LIKE '%".$searchValue."%' OR
        wa LIKE '%".$searchValue."%' OR
        tier LIKE '%".$searchValue."%' OR
        status LIKE '%".$searchValue."%' OR
        pembayaran LIKE '%".$searchValue."%' ) ";
}
$sel = mysqli_query($koneksi, "SELECT COUNT(*) AS allcount FROM member WHERE 1 ".$searchQuery);
if (!$sel) {
    http_response_code(500);
    echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
    exit;
}
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Ambil data
$query = "SELECT * FROM member WHERE status = 'Aktif' ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $query);

if (!$empRecords) {
    http_response_code(500);
    echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
    exit;
}

$data = array();
$no = $row + 1;

while($mr = mysqli_fetch_assoc($empRecords)){
    
    // Perbaikan pada bagian tier
    $tier = strtolower($mr['tier']);
    $class = '';
    
    switch ($tier) {
        case 'bronze':
            $class = 'alert-danger';
            break;
        case 'silver':
            $class = 'alert-secondary';
            break;
        case 'gold':
            $class = 'alert-warning';
            break;
        case 'diamond':
            $class = 'alert-info';
            break;
        default:
            $class = '';
            break;
    }

    $formatted_tier = '<span class="alert ' . $class . '" style="padding: .25rem .5rem; font-size: 75%; border-radius: 20px;">' . htmlspecialchars($mr['tier']) . '</span>';
    
    // Penanganan tanggal
    $start_date = isset($mr['start']) && $mr['start'] !== '0000-00-00' ? date('d-m-Y', strtotime($mr['start'])) : '-';
    $expired_date = isset($mr['expired']) && $mr['expired'] !== '0000-00-00' ? date('d-m-Y', strtotime($mr['expired'])) : '-';

    // Logika untuk status
    $status_class = ($mr['status'] == 'Aktif') ? 'alert-info' : 'alert-danger';
    $formatted_status = '<span class="alert ' . $status_class . '" style="padding: .25rem .5rem; font-size: 75%; border-radius: 20px;">' . htmlspecialchars($mr['status']) . '</span>';
    
    // Siapkan data untuk QR code
    $qr_data_array = [
        'Member ID' => $mr['memberid'],
        'Nama' => $mr['nama'],
        'Tier' => $mr['tier'],
        'Mulai' => $start_date,
        'Kadaluarsa' => $expired_date
    ];
    
    $qr_content = json_encode($qr_data_array);
    $qr_code_url = 'ajax/generate_qrcode.php?content=' . urlencode($qr_content);

    // Membuat URL untuk halaman detail
    // Ganti 'halaman_detail_anda.php' dengan nama file halaman detail yang sebenarnya
    $detail_url = 'ajax/halaman_detail_anda.php?memberid=' . urlencode($mr['memberid']);

    // Menggabungkan gambar QR code dan tautan detail
    $qr_code_with_link = '<a href="' . $detail_url . '" title="Lihat Detail Member: ' . htmlspecialchars($mr['nama']) . '">';
    $qr_code_with_link .= '<img src="' . $qr_code_url . '" alt="Barcode Anda" style="width: 30px; height: 30px;">';
    $qr_code_with_link .= '</a>';

    $data[] = array(
        "no" => $no++,
        "cabang" => $mr['cabang'],
        "operator" => $mr['operator'],
        "memberid" => $mr['memberid'],
        "nama" => $mr['nama'],
        "gender" => $mr['gender'],
        "wa" => $mr['wa'],
        "tier" => $formatted_tier,
        "start" => $start_date,
        "expired" => $expired_date,
        "status" => $formatted_status,
        "pembayaran" => $mr['pembayaran'],
        "semua_point" => $mr['semua_point'],
        "qr_code" => $qr_code_with_link // Kolom sekarang berisi gambar yang dapat diklik
    );
}

## Respons
$response = array(
    "draw" => $draw,
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

header('Content-type: application/json');
echo json_encode($response);
?>