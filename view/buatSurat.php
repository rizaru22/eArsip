<link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap-multiselect.css"/>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="script/suratperintahtugas.js"></script>
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
create_title("file","Surat Perintah Tugas");
//button
create_button("success", "list", "Daftar SPT", "btn-add", "daftar()");
//table

echo '<hr/><form id="formSPT" class="form-horizontal" onsubmit="return simpandata()"> <input type="hidden" name="id" id="id">';
$nosurat=nosuratperintahtugas();

 echo'<div class="form-group">
   <label for="nosurat" class="col-sm-2 control-label">Nomor Surat</label>
   <div class="col-sm-4">
      <input type="text" class="form-control" id="nosurat" name="nosurat" required value="'.$nosurat.'">
   </div> </div>';

//comboDaftarPegawai
echo '<div class="form-group">
      <label class="control-label col-sm-2" for="pilihan">Pegawai Yang Bertugas</label>
      <div class="col-sm-4">
        <select id="daftarpegawai" name="daftarpegawai[]" multiple class="form-control" required>';
$query=mysqli_query($mysqli,"SELECT id,nama from kepegawaian ORDER BY pangkat DESC")or die ("Error: ".mysqli_error($mysqli));
while($r=mysqli_fetch_array($query)){
       echo '<option value="'.$r[id].'">'.$r[nama].'</option>';
}
  
  echo '</select>
      </div>
    </div>';

create_textbox("Tugas","tugas","text",6,"","required");
create_textbox("Tanggal Pelaksanaan","tanggal_pelaksanaan","text",4,"datepicker","required");
create_textbox("Lama Tugas","lama_tugas","text",4,"","required");
create_textbox("Tempat","tempat","text",4,"","required");
create_textarea("Pembebanan Biaya","pembebanan_biaya","textarea","",6);
create_textbox("Tanggal Tanda Tangan","tanggal_ttd","text",4,"datepicker","required");
$qttd = mysqli_query($mysqli, "SELECT id,nama FROM kepegawaian WHERE ttd='Ya' AND (jabatan='1' OR jabatan='2')")or die ("Error: ".mysqli_error($mysqli));
   $list = array();
   while($ru = mysqli_fetch_array($qttd)){
      $list[] = array($ru['id'], $ru['nama']);
   }
create_combobox("Yang Menanda Tangani", "ttd", $list, 4, "", "required");
echo '<div class="form-group ">
<div class="col-md-4 col-md-offset-4">

<button type="submit" class="btn btn-primary btn-save">
   <i class="glyphicon glyphicon-floppy-disk"></i> Simpan
   </button>
   <button type="button" class="btn btn-warning" onclick="reset_form()">
   <i class="glyphicon glyphicon-remove-sign"></i> Batal
   </button></div>
</div></form>';


open_form("DaftarSurat","");
create_table(array("No Surat","Pegawai","Tugas","Tanggal","Aksi"));
close_form2();

?>