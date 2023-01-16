<script type="text/javascript" src="script/view_user.js"></script>
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
create_title("user","Daftar Pengguna");

//button
create_button("success", "plus-sign", "Tambah", "btn-add", "form_add()");

//table
create_table(array("Penerima","Username","Level","Status","Aksi"));


//modal form
open_form ("modalData","return save_data()");
create_textbox("Pengguna","pengguna","text",4,"","required");
create_textbox("Username","username","text",4,"","required");
create_textbox("Password","password","password",4,"","required");
 $list = array();
   $list[] = array("Administrator", "Administrator");
   $list[] = array("Pengguna", "Pengguna");
create_combobox("Jenis Pengguna","jenis",$list,4,"","required");
 $list = array();
   $list[] = array("Y", "Penerima");
   $list[] = array("T", "Bukan Penerima");
create_combobox("Penerima","status",$list,4,"","required");
close_form();


?>
