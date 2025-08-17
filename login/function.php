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
 ?>