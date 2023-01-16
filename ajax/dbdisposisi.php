<?php
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password']) or $_SESSION['leveluser']!="Administrator"){
   header('location: login.php');
}
include "../include/konfigurasi.php";
include "../include/function_view.php";
include "../include/function_date.php";
//Menampilkan data ke tabel
if($_GET['action'] == "table_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM suratMasuk ORDER BY tanggalTerima DESC");
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
      $row = array();
      $row[] = $no;
      $row[] = $r['noSurat'];
      $row[] = tgl_indonesia($r['tanggalSurat']);
      $row[] = $r['perihal'];
      $row[] = $r['sumber'];
	  $row[]= openFile($folderSuratMasuk.$r['fileSurat']);
      $row[] = button_pilih($r['idSuratMasuk']);
      $data[] = $row;
      $no++;
   }
	
   $output = array("data" => $data);
   echo json_encode($output);
}
elseif($_GET['action'] == "form_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM suratMasuk WHERE idSuratMasuk='$_GET[id]'");
   $data = mysqli_fetch_array($query);	
   echo json_encode($data);
}
elseif($_GET['action']=="insert"){
	$tanggal=date("Y-m-d");
	//query disposisi
	$query=mysqli_query($mysqli,"INSERT INTO disposisi SET
	tanggal='$tanggal',
	pengirim='$_SESSION[idpegawai]',
	idsuratmasuk='$_POST[idsurat]',
	indeks='$_POST[indeks]',
	tingkat='$_POST[tingkat]',
	instruksi='$_POST[instruksi]'");
	//pilih data iddisposisi terakhir
	$hasil=mysqli_query($mysqli,"SELECT iddisposisi FROM disposisi ORDER BY iddisposisi DESC LIMIT 1");
	while($result = mysqli_fetch_array($hasil)){
		 $iddis=$result[0];
	}
	//insert detail
	foreach($_POST['kirim'] as $p){
		mysqli_query($mysqli,"INSERT INTO disposisi_detail SET iddisposisi='$iddis',penerima='$p',status='Terkirim'");
	}
	

	echo "ok";
}
?>