<?php
session_start();
include "../include/konfigurasi.php";

$lama = md5($_POST['lama']);
$baru = md5($_POST['baru']);
	
$cek = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM pegawai WHERE idpegawai='$_SESSION[idpegawai]'"));
if($cek['password'] != $lama){
   echo "Password lama salah!";
}else{
   mysqli_query($mysqli, "UPDATE pegawai SET username='$_POST[username]', password='$baru' WHERE idpegawai='$_SESSION[idpegawai]'");
   echo "ok";
}
?>