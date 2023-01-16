<script type="text/javascript" src="script/daftardisposisisk.js"></script>
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
create_title("list","Daftar Disposisi Surat Keluar");
create_table(array("Tanggal","No Surat","Perihal","Penerima","File","Detail"));
?>