<?php
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password']) or $_SESSION['leveluser']!="Administrator"){
   header('location: login.php');
}

//include
include "../include/konfigurasi.php";
include "../include/function_view.php";

if ($_GET['action']=='table_data'){
	$query=mysqli_query($mysqli,"SELECT k.id,k.nama,k.nip,p.pangkat,j.jabatan FROM kepegawaian as k INNER JOIN pangkat as p on p.idpangkat=k.pangkat INNER JOIN jabatan as j on j.idjabatan=k.jabatan ORDER BY k.pangkat DESC ")or die ("Error: ".mysqli_error($mysqli));
	$data=array();
	$no=1;
	while($r=mysqli_fetch_array($query)){
		$row=array();
		$row[]=$no;
		$row[]=$r['id'];
		$row[]=$r['nama'];
		$row[]=$r['nip'];
		$row[]=$r['pangkat'];
		$row[]=$r['jabatan'];
		$row[]='';
		$data[]=$row;
		$no++;
	}
	$output = array("data" => $data);
   echo json_encode($output);
}

?>