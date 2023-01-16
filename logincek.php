<?php
session_start();
include "include/konfigurasi.php";
include "include/function_antiinjection.php";

$username = antiinjeksi($_POST['username']);
$password = antiinjeksi(md5($_POST['password']));

$cekuser = mysqli_query($mysqli, "SELECT * FROM pegawai WHERE username='$username' AND password='$password'");
$jmluser = mysqli_num_rows($cekuser);
$data = mysqli_fetch_array($cekuser);
if($jmluser > 0){
   $_SESSION['username']     = $data['username'];
   $_SESSION['jabatan']		 = $data['jabatan'];
   $_SESSION['password']     = $data['password'];
   $_SESSION['idpegawai']    = $data['idpegawai'];
   $_SESSION['leveluser']    = $data['level'];
   $_SESSION['penerima']     = $data['status'];
   $_SESSION['timeout'] 	 = time()+2000;
   $_SESSION['login'] 		 = 1;
   echo "ok";
}else{
   echo "<b>Username</b> atau <b>password</b> tidak terdaftar!";
}
?>