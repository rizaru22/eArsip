<link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="script/suratMasuk.js"></script>
<?php

//session
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password']) or $_SESSION['leveluser']!="Administrator"){
   header('location: login.php');
}
//include
include "../include/function_form.php";
include "../include/function_view.php";
//judul
create_title("envelope","Surat Masuk");

//button
create_button("success", "plus-sign", "Tambah", "btn-add", "form_add()");

//table
create_table(array("No Surat", "Tanggal Surat", "Tanggal Terima", "Sumber","File","Aksi"));


//modal form
open_form ("modalData","return save_data()");
create_textbox("No Agenda","noAgenda","text",4,"","required");
create_textbox("No Surat","noSurat","text",4,"","required");
create_textbox("Tanggal Surat","tanggalSurat","text",4,"datepicker","required");
create_textbox("Tanggal Terima","tanggalTerima","text",4,"datepicker","required");
create_textbox("Sumber","sumber","text",6,"","required");
create_textbox("Tujuan","tujuan","text",6,"","");
create_textarea("Perihal","perihal","richtext");
create_textarea("Keterangan","keterangan","richtext");
create_textbox("Pilih File .pdf", "file", "file", 6, "", "");
close_form();


?>
