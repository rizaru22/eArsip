<link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="script/suratumum.js"></script>                     
<?php
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password']) or $_SESSION['leveluser']!="Administrator"){
   header('location: login.php');
}

//include
include "../include/konfigurasi.php";
include "../include/function_form.php";
include "../include/function_view.php";
include "../include/nosurat.php";
//judul
create_title("file","Surat Umum");
//button
create_button("success", "list", "Daftar Surat", "btn-add", "daftar()");
$nosurat=nosuratbaru();
echo '<hr/><form id="form_suratumum" class="form-horizontal" onsubmit="return simpandata()"> <input type="hidden" name="id" id="id">';
echo'<div class="form-group">
   <label for="nosurat" class="col-sm-2 control-label">Nomor Surat</label>
   <div class="col-sm-4">
      <input type="text" class="form-control" id="nosurat" name="nosurat" required value="'.$nosurat.'">
   </div> </div>';
create_textbox("Lampiran","lampiran","text",4,"","required");
create_textbox("Perihal","perihal","text",4,"","required");
create_textbox("Tanggal","tanggal","text",4,"datepicker","required");
create_textbox("Kepada","tujuan","text",4,"","required");
create_textbox("Tempat","tempat","text",4,"","");
create_textarea("Isi Surat","isisurat","textarea","required",8);
$qttd = mysqli_query($mysqli, "SELECT id,nama FROM kepegawaian WHERE ttd='Ya'")or die ("Error: ".mysqli_error($mysqli));
   $list = array();
   while($ru = mysqli_fetch_array($qttd)){
      $list[] = array($ru['id'], $ru['nama']);
   }
create_combobox("Yang Menanda Tangani", "ttd", $list, 4, "", "required");
create_textarea("Tembusan","tembusan","textarea","",8);
echo '<div class="form-group ">
<div class="col-md-4 col-md-offset-4">
<button type="submit" class="btn btn-primary btn-save">
   <i class="glyphicon glyphicon-floppy-disk"></i>Simpan
   </button>
   <button type="button" class="btn btn-warning" onclick="reset_form()">
   <i class="glyphicon glyphicon-remove-sign"></i>Batal
   </button></div>
</div></form>';

open_form("DaftarSurat","");
create_table(array("No Surat","Perihal","Tanggal","Kepada","Aksi"));
close_form2();
?>