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
	$query=mysqli_query($mysqli,"SELECT id,nosurat,perihal,tanggal,tujuan FROM suratumum ORDER BY id DESC") or die ("Error :".mysqli_error($mysqli));
	$data=array();
	$no=1;
	while($r=mysqli_fetch_array($query)){
		$row=array();
		$row[]=$no;
		$row[]=$r['nosurat'];
		$row[]=$r['perihal'];
		$row[]=tgl_indonesia($r['tanggal']);
		$row[]=$r['tujuan'];
		$row[]=create_action($r['id'],true,false)."  ".button_cetak($r['id']);
		$data[] = $row;
      $no++;
	}
	$output = array("data" => $data);
   echo json_encode($output);
}
elseif($_GET['action']=="insert"){
	$isi=addslashes($_POST['isisurat']);
	$tembusan=addslashes($_POST['tembusan']);
	mysqli_query($mysqli,"INSERT INTO suratumum SET
		nosurat='$_POST[nosurat]',
		lampiran='$_POST[lampiran]',
		perihal='$_POST[perihal]',
		tanggal='$_POST[tanggal]',
		tujuan='$_POST[tujuan]',
		tempat='$_POST[tempat]',
		isi='$isi',
		pejabat_ttd='$_POST[ttd]',
		tembusan='$tembusan',
		pegawai_tu='$_SESSION[idpegawai]'") or die ("Error :".mysqli_error($mysqli));

	echo "ok";
	}
elseif($_GET['action']=="update"){
	$isi=addslashes($_POST['isisurat']);
	$tembusan=addslashes($_POST['tembusan']);
	mysqli_query($mysqli,"UPDATE suratumum SET
		nosurat='$_POST[nosurat]',
		lampiran='$_POST[lampiran]',
		perihal='$_POST[perihal]',
		tanggal='$_POST[tanggal]',
		tujuan='$_POST[tujuan]',
		tempat='$_POST[tempat]',
		isi='$isi',
		pejabat_ttd='$_POST[ttd]',
		tembusan='$tembusan',
		pegawai_tu='$_SESSION[idpegawai]'
		WHERE id='$_POST[id]'") or die ("Error :".mysqli_error($mysqli));

	echo "ok";
	}
elseif($_GET['action']=="form_data"){
	$query = mysqli_query($mysqli, "SELECT * FROM suratumum WHERE id='$_GET[id]'");
   	$data = mysqli_fetch_array($query);	
   	echo json_encode($data);
}