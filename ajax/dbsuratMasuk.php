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
      $row[] = tgl_indonesia($r['tanggalTerima']);
      $row[] = $r['sumber'];
	  $row[]= openFile($folderSuratMasuk.$r['fileSurat']);
      $row[] = create_action($r['idSuratMasuk'],true,true);
      $data[] = $row;
      $no++;
   }
	
   $output = array("data" => $data);
   echo json_encode($output);
}

//Menambah data
elseif($_GET['action'] == "insert"){
	if (!empty($_FILES['file']['name'])){
	$file_name = $_FILES['file']['name'];
	// Source tempat upload file sementara
	$source = $_FILES['file']['tmp_name'];
	// Membaca jenis file
	$file_type = $_FILES['file']['type'];
	//ganti nama file
	$temp = explode(".", $_FILES["file"]["name"]);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	// Tempat upload file disimpan
	$direktori = "../suratMasuk/$newfilename";
	move_uploaded_file($source,$direktori);
   mysqli_query($mysqli, "INSERT INTO suratMasuk SET
      noAgenda = '$_POST[noAgenda]',
      noSurat = '$_POST[noSurat]',
      tanggalSurat = '$_POST[tanggalSurat]',
      tanggalTerima = '$_POST[tanggalTerima]',
      sumber = '$_POST[sumber]',
      tujuan = '$_POST[tujuan]',
      perihal = '$_POST[perihal]',
      keterangan = '$_POST[keterangan]',
	  fileSurat='$newfilename'");
	}else{
		mysqli_query($mysqli, "INSERT INTO suratMasuk SET
      noAgenda = '$_POST[noAgenda]',
      noSurat = '$_POST[noSurat]',
      tanggalSurat = '$_POST[tanggalSurat]',
      tanggalTerima = '$_POST[tanggalTerima]',
      sumber = '$_POST[sumber]',
      tujuan = '$_POST[tujuan]',
      perihal = '$_POST[perihal]',
      keterangan = '$_POST[keterangan]'");
	}
echo "ok";	  
}

//Menampilkan data ke form
elseif($_GET['action'] == "form_data"){
   $query = mysqli_query($mysqli, "SELECT * FROM suratMasuk WHERE idSuratMasuk='$_GET[id]'");
   $data = mysqli_fetch_array($query);	
   echo json_encode($data);
}

//Update data
elseif($_GET['action'] == "update"){
	if (!empty($_FILES['file']['name'])){
	$file_name = $_FILES['file']['name'];
	// Source tempat upload file sementara
	$source = $_FILES['file']['tmp_name'];
	// Membaca jenis file
	$file_type = $_FILES['file']['type'];
	//ganti nama file
	$temp = explode(".", $_FILES["file"]["name"]);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	// Tempat upload file disimpan
	$direktori = "../suratMasuk/$newfilename";
	move_uploaded_file($source,$direktori);
   mysqli_query($mysqli, "UPDATE suratMasuk SET
      noAgenda = '$_POST[noAgenda]',
      noSurat = '$_POST[noSurat]',
      tanggalSurat = '$_POST[tanggalSurat]',
      tanggalTerima = '$_POST[tanggalTerima]',
      sumber = '$_POST[sumber]',
      tujuan = '$_POST[tujuan]',
      perihal = '$_POST[perihal]',
      keterangan = '$_POST[keterangan]',
	  fileSurat='$newfilename'
      WHERE idSuratMasuk='$_POST[id]'");
	}else{
		mysqli_query($mysqli, "UPDATE suratMasuk SET
      noAgenda = '$_POST[noAgenda]',
      noSurat = '$_POST[noSurat]',
      tanggalSurat = '$_POST[tanggalSurat]',
      tanggalTerima = '$_POST[tanggalTerima]',
      sumber = '$_POST[sumber]',
      tujuan = '$_POST[tujuan]',
      perihal = '$_POST[perihal]',
      keterangan = '$_POST[keterangan]'
      WHERE idSuratMasuk='$_POST[id]'");
	}
echo "ok";	  
}
//Menghapus data
elseif($_GET['action'] == "delete"){
   mysqli_query($mysqli, "DELETE FROM suratMasuk WHERE idSuratMasuk='$_GET[id]'");	
}

?>