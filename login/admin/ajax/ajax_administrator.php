<?php

// Aktifkan laporan error PHP untuk debugging
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Sertakan file koneksi database Anda
// Sesuaikan path jika letak file koneksi.php berbeda
require_once('../../function.php');

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
    'id_user', 'nama_lengkap', 'username', 'password'
];

$columnName = 'nama_lengkap';
if ($columnIndex > 0 && $columnIndex < count($columnNames) && isset($columnNames[$columnIndex])) {
    $columnName = $columnNames[$columnIndex];
}

## Query untuk total record (tanpa filter)
$sel = mysqli_query($koneksi, "SELECT COUNT(*) as allcount FROM user");
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
   $searchQuery = " AND (nama_lengkap LIKE '%".$searchValue."%' OR
        username LIKE '%".$searchValue."%' OR LIKE '%".$searchValue."%') ";
}
$sel = mysqli_query($koneksi, "SELECT COUNT(id_user) AS allcount FROM user".$searchQuery);
if (!$sel) {
    http_response_code(500);
    echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
    exit;
}
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Ambil data
$query = "SELECT * FROM user WHERE 1 ".$searchQuery." 
          ORDER BY ".$columnName." ".$columnSortOrder." 
          LIMIT ".$row.",".$rowperpage;
$userRecords = mysqli_query($koneksi, $query);

if (!$userRecords) {
    http_response_code(500);
    echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
    exit;
}

$data = array();
$no = $row + 1;

while($user = mysqli_fetch_assoc($userRecords)){
    // Menyiapkan tombol opsi
    $opsi_tombol = "<a href='ajax/administrator_hapus?id=" . $user['id_user'] . "' class='btn btn-danger btn-sm btn-xs' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'><i class='fas fa-trash'></i></a>";
    
    $data[] = array(
      "opsi" => $opsi_tombol,
      "no" => $no++,
      "nama_lengkap" => $user['nama_lengkap'],
      "username" => $user['username'],
      "password" => $user['password']
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