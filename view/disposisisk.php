<script type="text/javascript" src="script/disposisisk.js"></script>
<?php
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password'])){
   header('location: login.php');
}
//include
include "../include/konfigurasi.php";
include "../include/function_form.php";
include "../include/function_view.php";
//judul
create_title("inbox","Daftar Disposisi Surat Keluar");
create_table(array("Tanggal","Pengirim","No Surat","Perihal","File","Detail"));

?>