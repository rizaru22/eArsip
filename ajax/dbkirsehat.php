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
	$query=mysqli_query($mysqli,"SELECT id,nosurat,nama,golongan_darah,buta_warna,keterangan,tanggal from kirsehat ORDER BY id DESC") or die ("Error :".mysqli_error($mysqli));
	$data=array();
	$no=1;
	while($r=mysqli_fetch_array($query)){
		$keterangan="";
		if ($r['keterangan']=='Y'){
			$keterangan="SEHAT";
		}else{
			$keterangan="TIDAK SEHAT";
		}

		$buta_warna="";
		if ($r['buta_warna']=="Buta") $buta_warna="Buta Warna";
		else $buta_warna=$r['buta_warna'];
		$row=array();
		$row[]=$no;
		$row[]=$r['nosurat'];
		$row[]=$r['nama'];
		$row[]=$r['golongan_darah'];
		$row[]=$buta_warna;
		$row[]=$keterangan;
		$row[]=tgl_indonesia($r['tanggal']);
		$row[]=create_action($r['id'],true,false)."  ".button_cetak($r['id']);
		$data[] = $row;
      $no++;
	}
	$output = array("data" => $data);
   echo json_encode($output);
}
elseif($_GET['action']=="insert"){
	$tanggal=date('Y-m-d');
	//insert 
	mysqli_query($mysqli,"INSERT INTO kirsehat SET
	nosurat='$_POST[nosurat]',
	nama='$_POST[nama]',
	tempat_lahir='$_POST[tempat_lahir]',
	tanggal_lahir='$_POST[tanggal_lahir]',
	pekerjaan='$_POST[pekerjaan]',
	alamat='$_POST[alamat]',
	berat_badan='$_POST[berat_badan]',
	golongan_darah='$_POST[golongan_darah]',
	tinggi_badan='$_POST[tinggi_badan]',
	buta_warna='$_POST[buta_warna]',
	keterangan='$_POST[keterangan]',
	keperluan='$_POST[keperluan]',
	tanggal='$tanggal',
	dokter='$_POST[dokter]',
	pegawai_tu='$_SESSION[idpegawai]'") or die ("Error :".mysqli_error($mysqli));
	echo "ok";
	}
elseif($_GET['action']=="update"){
	$tanggal=date('Y-m-d');
	//update
	mysqli_query($mysqli,"UPDATE kirsehat SET
	nosurat='$_POST[nosurat]',
	nama='$_POST[nama]',
	tempat_lahir='$_POST[tempat_lahir]',
	tanggal_lahir='$_POST[tanggal_lahir]',
	pekerjaan='$_POST[pekerjaan]',
	alamat='$_POST[alamat]',
	berat_badan='$_POST[berat_badan]',
	golongan_darah='$_POST[golongan_darah]',
	tinggi_badan='$_POST[tinggi_badan]',
	buta_warna='$_POST[buta_warna]',
	keterangan='$_POST[keterangan]',
	keperluan='$_POST[keperluan]',
	tanggal='$tanggal',
	dokter='$_POST[dokter]',
	pegawai_tu='$_SESSION[idpegawai]' WHERE id='$_POST[id]'") or die ("Error :".mysqli_error($mysqli));
	echo "ok";
	}
elseif($_GET['action']=="form_data"){
	$query = mysqli_query($mysqli, "SELECT * FROM kirsehat WHERE id='$_GET[id]'");
   	$data = mysqli_fetch_array($query);	
   	echo json_encode($data);
}