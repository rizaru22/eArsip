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
	$query = mysqli_query($mysqli, "SELECT * FROM disposisisk ORDER BY tanggal DESC");
	$data = array();
	$no = 1;
	while($r = mysqli_fetch_array($query)){
		$nosurat="";
		$fileSurat="";
		$perihal="";
		$querysurat=mysqli_query($mysqli,"SELECT * FROM suratkeluar WHERE idsuratkeluar='$r[idsuratkeluar]'");
		while($rsurat=mysqli_fetch_array($querysurat)){
			$nosurat=$rsurat['nosurat'];
			$perihal=$rsurat['perihal'];
			$fileSurat=$rsurat['filesurat'];
		}

	  

		$label="";
		$querypenerima=mysqli_query($mysqli,"SELECT dd.penerima,dd.status,p.jabatan FROM disposisisk_detail as dd INNER JOIN pegawai as p on p.idpegawai=dd.penerima WHERE dd.id='$r[id]'")or die ("Error: ".mysqli_error($mysqli));
	 
		while ($rpenerima=mysqli_fetch_array($querypenerima)) {
			if($rpenerima['status']=="Terkirim") $class="label-warning";
			else $class="label-success";
			$label .= '<span class="label '.$class.'">'.$rpenerima['jabatan'].'</span> ';
		}
		$row = array();
		$row[] = $no;
		$row[] = tgl_indonesia($r['tanggal']);
		$row[] = $nosurat;
		$row[] = $perihal;
		$row[] = $label;
	  $row[]= openFile($folderSuratKeluar.$fileSurat);
		$row[] = '<a class="btn btn-primary btn-edit" href="include/lembardisposisisk.php?action=tampil&id='.$r['id'].'" target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a>';
		$data[] = $row;
		$no++;
	}
	
	$output = array("data" => $data);
	echo json_encode($output);
}
?>