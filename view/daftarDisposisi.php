<script type="text/javascript" src="script/daftardisposisi.js"></script>
<?php
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password']) or $_SESSION['leveluser']!="Administrator"){
   header('location: login.php');
}

//include
include "../include/konfigurasi.php";
include "../include/function_form.php";
include "../include/function_view.php";

//judul
create_title("list","Daftar Disposisi Surat Masuk");
create_table(array("Tanggal","Pengirim","No Surat","Penerima","File","Detail"));
?>