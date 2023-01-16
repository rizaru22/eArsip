<script type="text/javascript" src="script/view_kepegawaian.js"></script>
<?php
//session
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password']) or $_SESSION['leveluser']!="Administrator"){
   header('location: login.php');
}
//include
include "../include/konfigurasi.php";
include "../include/function_form.php";
include "../include/function_view.php";
//judul
create_title("sort-by-attributes","Daftar Pegawai");

//button
create_button("success", "plus-sign", "Tambah", "btn-add", "form_add()");

//table
create_table(array("Nama","NIP","Jabatan","TTD","Aksi"));


//modal form
open_form ("modalData","return save_data()");
create_textbox("Nama","nama","text",4,"","required");
create_textbox("NIP","nip","text",4,"","required");
$query = mysqli_query($mysqli, "SELECT * FROM pangkat")or die ("Error: ".mysqli_error($mysqli));
   $list = array();
   while($ru = mysqli_fetch_array($query)){
      $list[] = array($ru['idpangkat'], $ru['pangkat']);
   }
create_combobox("Pangkat/Golongan","pangkat",$list,4,"","required");

$query = mysqli_query($mysqli, "SELECT * FROM jabatan")or die ("Error: ".mysqli_error($mysqli));
   $list = array();
   while($ru = mysqli_fetch_array($query)){
      $list[] = array($ru['idjabatan'], $ru['jabatan']);
   }
create_combobox("Jabatan","jabatan",$list,4,"","required");

 $list = array();
   $list[] = array("Ya", "Ya");
   $list[] = array("Tidak", "Tidak");
create_combobox("Menanda Tangani Surat","ttd",$list,4,"","required");
close_form();


?>