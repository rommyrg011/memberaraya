<?php

// Aktifkan laporan error PHP untuk debugging
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Sertakan file koneksi database Anda
require_once('../../function.php');

// DataTables request parameters dengan validasi
$draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
$row = isset($_POST['start']) ? intval($_POST['start']) : 0;
$rowperpage = isset($_POST['length']) ? intval($_POST['length']) : 10;

// Daftar nama kolom yang valid dan sesuai dengan database untuk tampilan ini
$columnNames = [
    'no', 'memberid', 'nama', 'tier', 'semua_point'
];

// Ambil data
$query = "SELECT memberid, nama, tier, semua_point FROM member WHERE status = 'Aktif' ORDER BY semua_point DESC LIMIT 10";
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
    
    $data[] = array(
        "no" => $no,
        "memberid" => $mr['memberid'],
        "nama" => $mr['nama'],
        "tier" => $formatted_tier,
        "semua_point" => $mr['semua_point']
    );
    $no++;
}

$sel = mysqli_query($koneksi, "SELECT COUNT(*) as allcount FROM member WHERE status = 'Aktif'");
if (!$sel) {
    http_response_code(500);
    echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
    exit;
}
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];
$totalRecordwithFilter = $records['allcount'];

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