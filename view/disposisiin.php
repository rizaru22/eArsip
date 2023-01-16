<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap-multiselect.css"/>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="script/disposisiin.js"></script>
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
create_title("inbox","Daftar Disposisi Masuk");
create_table(array("Tanggal","Pengirim","No Surat","File","Detail","Disposisikan"));

open_form("modalData","return simpan_data()");
create_textbox("Indeks", "indeks", "text", 4, "", "required");
echo '<div class="form-group">
    <label for="surat" class="col-sm-2 control-label">Surat</label>
	<div class="col-sm-4">
    <input type="text" class="form-control" id="surat"></div>
	<input type="hidden" name="idsurat" id="idsurat">
  </div>';
$list = array("Rahasia","Penting","Biasa");
echo'<div class="form-group">
   <label for="tingkat" class="col-sm-2 control-label">Tingkat</label>
   <div class="col-sm-4">
      <select class="form-control" name="tingkat" id="tingkat" required>
         <option value="">- Pilih -</option>';

foreach($list as $ls){
   echo '<option value='.$ls.'>'.$ls.'</option>';
}
	
   echo '</select>
   </div> </div>';
create_textarea("Instruksi","instruksi","");
$qpegawai = mysqli_query($mysqli, "SELECT * FROM pegawai WHERE idpegawai !=$_SESSION[idpegawai] AND status='Y'");
   $list = array();
   while($rp = mysqli_fetch_array($qpegawai)){
      $list[] = array($rp['idpegawai'], $rp['jabatan']);
   }
//create_checkbox("Diteruskan Kepada","kirim", $list);
create_combobox_multi("Diterukan Kepada","kirim",$list,"4","","required");
close_form();
?>