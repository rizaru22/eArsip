<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap-multiselect.css"/>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="script/disposisisuratkeluar.js"></script>
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
create_title("transfer","Disposisi Surat Keluar");
//button
create_button("success", "list", "Daftar Disposisi", "btn-add", "daftar()");
//table
echo '<hr/><form id="formDisposisi" class="form-horizontal" onsubmit="return simpandata()">';

create_textbox("Indeks", "indeks", "text", 4, "", "required");
echo '<div class="form-group">
    <label for="surat" class="col-sm-2 control-label">Surat</label>
	<div class="col-sm-4">
    <input type="text" class="form-control" id="surat"></div>
	<input type="hidden" name="idsurat" id="idsurat">
	<button type="button" class="btn btn-info" onclick="form_datasurat()"><i class="glyphicon glyphicon-envelope"></i></button>
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
echo '<div class="form-group ">
<div class="col-md-4 col-md-offset-4">
<button type="submit" class="btn btn-primary btn-save">
   <i class="glyphicon glyphicon-floppy-disk"></i>Simpan
   </button>
   <button type="button" class="btn btn-warning" onclick="reset_form()">
   <i class="glyphicon glyphicon-remove-sign"></i>Batal
   </button></div>
</div></form>';


//modal data surat masuk
open_form ("dataSuratKeluar","return save_data()");
create_table(array("No Surat", "Tanggal Surat", "Perihal", "Tujuan","File","Aksi"));
close_form2();

?>