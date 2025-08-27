<?php

// Aktifkan laporan error PHP untuk debugging
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Sertakan file koneksi database Anda
// Sesuaikan path jika letak file koneksi.php berbeda
require_once('../../function.php');

// Pengecekan koneksi database
if (!$koneksi) {
    http_response_code(500);
    echo json_encode(['error' => 'Koneksi database gagal: ' . mysqli_connect_error()]);
    exit;
}

// DataTables request parameters dengan validasi
$draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
$row = isset($_POST['start']) ? intval($_POST['start']) : 0;
$rowperpage = isset($_POST['length']) ? intval($_POST['length']) : 10;

// Menghindari SQL Injection pada kolom pengurutan
$columnIndex = isset($_POST['order'][0]['column']) ? intval($_POST['order'][0]['column']) : 0;
$columnSortOrder = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'desc'; // Urutkan dari yang terbaru
$searchValue = isset($_POST['search']['value']) ? mysqli_real_escape_string($koneksi, $_POST['search']['value']) : '';

// Daftar nama kolom yang valid dan sesuai dengan database
// Menggunakan alias untuk kolom dari tabel yang berbeda
$columnNames = [
    'ip.id_poin', 'ip.tanggal_input', 'ip.cabang', 'ip.operator', 'm.memberid', 'm.nama', 'ip.pembayaran', 'ip.point'
];

$columnName = 'ip.tanggal_input';
if ($columnIndex > 0 && $columnIndex < count($columnNames) && isset($columnNames[$columnIndex])) {
    $columnName = $columnNames[$columnIndex];
}

## Query untuk total record (tanpa filter)
$sel = mysqli_query($koneksi, "SELECT COUNT(*) as allcount FROM input_poin");
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
   $searchQuery = " AND (m.memberid LIKE '%".$searchValue."%' OR
        m.nama LIKE '%".$searchValue."%' OR
        ip.cabang LIKE '%".$searchValue."%' OR
        ip.operator LIKE '%".$searchValue."%' OR
        ip.pembayaran LIKE '%".$searchValue."%' OR
        ip.point LIKE '%".$searchValue."%' ) ";
}
$sel = mysqli_query($koneksi, "SELECT COUNT(ip.id_poin) AS allcount FROM input_poin ip JOIN member m ON ip.id_member = m.id_member WHERE 1 ".$searchQuery);
if (!$sel) {
    http_response_code(500);
    echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
    exit;
}
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Ambil data
$query = "SELECT ip.*, m.memberid, m.nama FROM input_poin ip
          JOIN member m ON ip.id_member = m.id_member
          WHERE 1 ".$searchQuery." 
          ORDER BY ".$columnName." ".$columnSortOrder." 
          LIMIT ".$row.",".$rowperpage;
$poinRecords = mysqli_query($koneksi, $query);

if (!$poinRecords) {
    http_response_code(500);
    echo json_encode(['error' => 'Query error: ' . mysqli_error($koneksi)]);
    exit;
}

$data = array();
$no = $row + 1;

while($pr = mysqli_fetch_assoc($poinRecords)){
    // Menyiapkan tombol hapus
    $opsi_tombol = "<a href='ajax/poin_hapus.php?id=" . $pr['id_poin'] . "' class='btn btn-danger btn-sm btn-xs' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'><i class='fas fa-trash'></i></a>";
    
    $data[] = array(
      "no" => $no++,
      "tanggal_input" => date('d-m-Y H:i:s', strtotime($pr['tanggal_input'])), 
      "cabang" => $pr['cabang'],
      "operator" => $pr['operator'],
      "memberid" => $pr['memberid'],
      "nama" => $pr['nama'],
      "pembayaran" => $pr['pembayaran'],
      "point" => $pr['point'],
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

?>