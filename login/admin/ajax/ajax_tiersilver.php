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

// Daftar nama kolom yang valid dan sesuai dengan database untuk tampilan ini
$columnNames = [
    'memberid', 'nama', 'tier', 'start', 'expired'
];

$columnName = 'memberid';
if ($columnIndex > -1 && $columnIndex < count($columnNames) && isset($columnNames[$columnIndex])) {
    $columnName = $columnNames[$columnIndex];
}

// Basis query untuk Tier Silver yang hanya aktif
$baseQuery = "SELECT * FROM member WHERE tier = 'Silver' AND status = 'Aktif'";

## Query untuk total record (tanpa filter)
$sel = mysqli_query($koneksi, "SELECT COUNT(*) as allcount FROM member WHERE tier = 'Silver' AND status = 'Aktif'");
if (!$sel) {
    http_response_code(500);
    echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
    exit;
}
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Query untuk total record (dengan filter)
$searchQuery = "";
if ($searchValue != '') {
    $searchQuery = " AND (memberid LIKE '%".$searchValue."%' OR
                       nama LIKE '%".$searchValue."%' OR
                       tier LIKE '%".$searchValue."%' ) ";
}
$sel = mysqli_query($koneksi, "SELECT COUNT(*) AS allcount FROM member WHERE tier = 'Silver' AND status = 'Aktif' " . $searchQuery);
if (!$sel) {
    http_response_code(500);
    echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
    exit;
}
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Ambil data
$query = $baseQuery . $searchQuery . " ORDER BY ".$columnName." ".$columnSortOrder." LIMIT ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $query);

if (!$empRecords) {
    http_response_code(500);
    echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
    exit;
}

$data = array();
$no = 1;

while($mr = mysqli_fetch_assoc($empRecords)){
    
    // Perbaikan pada bagian tier
    $tier = strtolower($mr['tier']);
    $class = '';
    
    switch ($tier) {
        case 'Silver':
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

    $data[] = array(
        "no" => $no,
        "memberid" => $mr['memberid'],
        "nama" => $mr['nama'],
        "tier" => $formatted_tier,
        "start" => $start_date,
        "expired" => $expired_date
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