<?php
// Pastikan file koneksi dan session sudah disiapkan
include 'function.php';
session_start();

// Mencegah akses langsung jika data POST tidak ada
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("location:./?pesan=gagal");
    exit();
}

// Tangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Gunakan prepared statement untuk keamanan dari SQL Injection
$stmt = $koneksi->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();
$cek = $result->num_rows;

// Cek apakah username dan password ditemukan
if ($cek > 0) {
    $data = $result->fetch_assoc();

    // Buat session
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['status'] = "login";
    $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
    $_SESSION['username'] = $username;
    $_SESSION['level'] = $data['level'];

    // Alihkan user berdasarkan level
    if ($data['level'] == "admin") {
        header("location:./?admin");
        exit();
    } else if ($data['level'] == "operator") {
        header("location:./?admin");
        exit();
    } else {
        // Jika level tidak dikenali
        header("location:./?pesan=gagal_level");
        exit();
    }
} else {
    // Jika data tidak ditemukan
    header("location:./?pesan=gagal");
    exit();
}
?>