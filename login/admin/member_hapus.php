<?php 
include 'koneksi.php';
$id_member= $_GET['id'];

$hapusMember= $koneksi->query("DELETE FROM member WHERE id_member = $id_member") or die(mysqli_error($koneksi));
if($hapusMember){
    $_SESSION['notif'] = "Berhasil Di Hapus";
header('location: member.php');
}  else {
echo '
<script>alert("Gagal");
window.location.href="member.php"
</script>';
}

?>