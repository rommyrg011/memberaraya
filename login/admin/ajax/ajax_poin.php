<?php

// Aktifkan laporan error PHP untuk debugging
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Sertakan file koneksi database Anda
// Sesuaikan path jika letak file koneksi.php berbeda
require_once('../../function.php');

// Pengecekan koneksi database
if ($koneksi->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Koneksi database gagal: ' . $koneksi->connect_error]);
    exit;
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
    'start', 'expired', 'status', 'pembayaran', 'semua_point'
];

$columnName = 'id_member';
if ($columnIndex > 0 && $columnIndex < count($columnNames) && isset($columnNames[$columnIndex])) {
    $columnName = $columnNames[$columnIndex];
}

## Query untuk total record (tanpa filter)
$sel = mysqli_query($koneksi, "SELECT COUNT(*) as allcount FROM member");
if (!$sel) {
    http_response_code(500);
    echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
    exit;
}
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Query untuk total record (dengan filter)
$searchQuery = " ";
if ($searchValue != '') {
   $searchQuery = " AND (cabang LIKE '%".$searchValue."%' OR
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
$query = "SELECT * FROM member WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $query);

if (!$empRecords) {
    http_response_code(500);
    echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
    exit;
}

$data = array();
$no = $row + 1;

while($mr = mysqli_fetch_assoc($empRecords)){
    // PERBAIKAN PADA BARIS INI:
    // 1. Variabel yang benar: $mr['id_member']
    // 2. Sintaks yang benar dengan double quotes
    $opsi_tombol = "<a href='member_hapus.php?id=" . $mr['id_member'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'><i class='fas fa-trash'></i></a>";
    
    $data[] = array(
      "no" => $no++,
      "cabang" => $mr['cabang'],
      "operator" => $mr['operator'],
      "memberid" => $mr['memberid'],
      "nama" => $mr['nama'],
      "gender" => $mr['gender'],
      "wa" => $mr['wa'],
      "tier" => $mr['tier'],
      "start" => $mr['start'],
      "expired" => $mr['expired'],
      "status" => $mr['status'],
      "pembayaran" => $mr['pembayaran'],
      "semua_point" => $mr['semua_point'],
      "opsi" => $opsi_tombol
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