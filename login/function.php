<?php
session_start();

$koneksi = mysqli_connect('localhost', 'root', '', 'arayagamestation');

//tambah member
if(isset($_POST['tambahMember'])){
    $cabang = $_POST['cabang'];
    $operator = $_POST['operator'];
    $memberid = $_POST['memberid'];
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $wa = $_POST['wa'];
    $tier = $_POST['tier'];
    $expired = $_POST['expired'];
    $status = $_POST['status'];
    $pembayaran = $_POST['pembayaran'];
    $semua_point = $_POST['semua_point'];

    $tMember = mysqli_query($koneksi, "insert into member (cabang, operator, memberid, nama, gender, wa, tier, expired, status, pembayaran, semua_point) values
    ('$cabang', '$operator', '$memberid', '$nama', '$gender', '$wa', '$tier', '$expired', '$status', '$pembayaran', '$semua_point')");
        if($tMember){
            $_SESSION['notif'] = "Berhasil Ditambahkan";
        header('location: member.php');
        } else {
            echo '
            <script>alert("Gagal");
            window.location.href="member.php"
            </script>';
        }
    }
//tambah Poin member
if(isset($_POST['tambahPoinMember'])){
    // Mengambil data dari form input_poin.php
    $memberid_string = $_POST['memberid_from_select']; // PERBAIKAN DI SINI
    $point_baru = $_POST['semua_point'];
    $pembayaran = $_POST['pembayaran'];

    // Ambil data cabang dan operator langsung dari sesi user yang sedang login
    $cabang_user = $_SESSION['cabang']; 
    $operator_user = $_SESSION['nama_lengkap'];

    // 1. Dapatkan poin lama dan id_member (integer) dari tabel member
    $ambil_data_member = mysqli_query($koneksi, "SELECT id_member, semua_point FROM member WHERE memberid = '$memberid_string'");
    $data_member = mysqli_fetch_assoc($ambil_data_member);

    if($data_member){
        $id_member_int = $data_member['id_member'];
        $poin_lama = (int)$data_member['semua_point'];
        $poin_baru_int = (int)$point_baru;

        $total_poin_baru = $poin_lama + $poin_baru_int;

        // 2. Update total poin di tabel member
        $update_member = mysqli_query($koneksi, "UPDATE member SET semua_point = '$total_poin_baru' WHERE id_member = '$id_member_int'");
        
        // 3. Masukkan record poin baru ke tabel input_poin
        $insert_poin = mysqli_query($koneksi, "INSERT INTO input_poin (id_member, pembayaran, point, cabang, operator) VALUES ('$id_member_int', '$pembayaran', '$poin_baru_int', '$cabang_user', '$operator_user')");

        if($update_member && $insert_poin){
            $_SESSION['notif'] = "Poin Berhasil Ditambahkan!";
            header('location: poin.php');
        } else {
            echo '
            <script>alert("Gagal menambahkan poin.");
            window.location.href="input_poin.php"
            </script>';
        }

    } else {
        echo '
        <script>alert("ID member tidak ditemukan.");
        window.location.href="input_poin.php"
        </script>';
    }
}



?>