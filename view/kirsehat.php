<link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="script/kirsehat.js"></script>
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
create_title("file","Surat Keterangan Sehat");
//button
create_button("success", "list", "Daftar KIR Sehat", "btn-add", "daftar()");
$nosurat=nosuratbaru();
echo '<hr/><form id="form_kirsehat" class="form-horizontal" onsubmit="return simpandata()"> <input type="hidden" name="id" id="id">';
echo'<div class="form-group">
   <label for="nosurat" class="col-sm-2 control-label">Nomor Surat</label>
   <div class="col-sm-4">
      <input type="text" class="form-control" id="nosurat" name="nosurat" required value="'.$nosurat.'">
   </div> </div>';
create_textbox("Nama","nama","text",4,"","required");
create_textbox("Tempat Lahir","tempat_lahir","text",4,"","required");
create_textbox("Tanggal Lahir","tanggal_lahir","text",4,"datepicker","required"); 

create_textbox("Pekerjaan","pekerjaan","text",4,"","");
create_textarea("Alamat","alamat","textarea");
create_textbox("Berat Badan (Kg)","berat_badan","number",2,"","required");
 $list = array();
   $list[] = array('A', 'A');
   $list[] = array('AB', 'AB');
   $list[] = array('B', 'B');
   $list[] = array('O', 'O');
create_combobox("Golongan Darah", "golongan_darah", $list, 2, "", "required");
create_textbox("Tinggi Badan (Cm)","tinggi_badan","number",2,"","required");
 $list = array();
   $list[] = array('Normal', 'Normal');
   $list[] = array('Parsial', 'Parsial');
   $list[] = array("Buta", 'Buta Warna');
create_combobox("Buta Warna", "buta_warna", $list, 2, "", "");
 $list = array();
   $list[] = array('Y', 'Sehat');
   $list[] = array('T', 'Tidak Sehat');
create_combobox("Keterangan", "keterangan", $list, 2, "", "required");
create_textbox("Keperluan","keperluan","text",4,"","required");
$quser = mysqli_query($mysqli, "SELECT k.id,k.nama FROM kepegawaian as k INNER JOIN jabatan as j on j.idjabatan=k.jabatan WHERE j.jabatan LIKE '%dokter%'");
   $list = array();
   while($ru = mysqli_fetch_array($quser)){
      $list[] = array($ru['id'], $ru['nama']);
   }
create_combobox("Dokter", "dokter", $list, 3, "", "required");
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
create_table(array("No Surat","Nama","Gol. Darah","Buta Warna","Ket.","Tanggal","Aksi"));
close_form2();
?>

