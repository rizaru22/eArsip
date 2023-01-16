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
	
	$query=mysqli_query($mysqli,"SELECT * FROM suratperintahtugas ORDER BY id DESC") or die ("Error :".mysqli_error($mysqli));
	$data=array();
	$no=1;
	while($r=mysqli_fetch_array($query)){
		$qdetail=mysqli_query($mysqli,"SELECT sptd.idkepegawaian,k.nama
				FROM suratperintahtugas_detail as sptd
				INNER join kepegawaian as k on k.id=sptd.idkepegawaian
 				WHERE sptd.id='$r[id]'") or die ("Error :".mysqli_error($mysqli));
		$label="";
		while($r1=mysqli_fetch_array($qdetail)){
			$label .= '<span class="label label-info">'.$r1['nama'].'</span> ';
		}
		$row=array();
		$row[]=$no;
		$row[]=$r['nosurat'];
		$row[]=$label;
		$row[]=$r['tugas'];
		$row[]=$r['tanggal_pelaksanaan'];
		//$row[]=create_action($r['id'],true,false)."  ".'<a class="btn btn-warning btn-edit" href="include/spt.php?action=tampil&id='.$r['id'].'" target="_blank"><i class="glyphicon glyphicon-print"></i></a>';
		$row[]=create_action($r['id'],true,false)."  ".button_cetak($r['id']);
		$data[] = $row;
      $no++;
	}
	 $output = array("data" => $data);
   echo json_encode($output);
}
elseif($_GET['action']=="insert"){
	//insert suratperintahtugas
	$qinsert1=mysqli_query($mysqli,"
		INSERT INTO suratperintahtugas SET
		nosurat='$_POST[nosurat]',
		tugas='$_POST[tugas]',
		tanggal_pelaksanaan='$_POST[tanggal_pelaksanaan]',
		lama_tugas='$_POST[lama_tugas]',
		tempat='$_POST[tempat]',
		pembebanan_biaya='$_POST[pembebanan_biaya]',
		tanggal_ttd='$_POST[tanggal_ttd]',
		pejabat_ttd='$_POST[ttd]',
		pegawai_tu='$_SESSION[idpegawai]'") or die ("Error :".mysqli_error($mysqli));

	//pilih data yg terakhir di insert
	$qselect1=mysqli_query($mysqli,"SELECT id FROM suratperintahtugas ORDER BY id DESC LIMIT 1") or die ("Error :".mysqli_error($mysqli));
	while($rqs=mysqli_fetch_array($qselect1)){
		$idterakhir=$rqs['id'];
	}

	//insert suratperintahtugas_detail
	foreach ($_POST['daftarpegawai'] as $pgw) {
		# code...
		$qinsert2=mysqli_query($mysqli,"INSERT INTO suratperintahtugas_detail SET
			id=$idterakhir,
			idkepegawaian=$pgw") or die ("Error :".mysqli_error($mysqli));

	}
	echo "ok";
}
elseif($_GET['action']=="form_data"){
	$query = mysqli_query($mysqli, "SELECT * FROM suratperintahtugas WHERE id='$_GET[id]'");
   $data = mysqli_fetch_array($query);	
   $query2=mysqli_query($mysqli,"SELECT * FROM suratperintahtugas_detail WHERE id='$_GET[id]'");
   while($r=mysqli_fetch_array($query2)){
   	$idkepegawaian[]=$r['idkepegawaian'];
   }
   //$data2=array();
   $data['pegawai']=implode(",", $idkepegawaian);
   echo json_encode($data);
}

elseif($_GET['action']=="update"){
	//insert suratperintahtugas
	$qinsert1=mysqli_query($mysqli,"
		UPDATE suratperintahtugas SET
		nosurat='$_POST[nosurat]',
		tugas='$_POST[tugas]',
		tanggal_pelaksanaan='$_POST[tanggal_pelaksanaan]',
		lama_tugas='$_POST[lama_tugas]',
		tempat='$_POST[tempat]',
		pembebanan_biaya='$_POST[pembebanan_biaya]',
		tanggal_ttd='$_POST[tanggal_ttd]',
		pejabat_ttd='$_POST[ttd]',
		pegawai_tu='$_SESSION[idpegawai]'
		WHERE id='$_POST[id]'") or die ("Error :".mysqli_error($mysqli));

	//hapus data suratperintahtugas_detail
	mysqli_query($mysqli,"DELETE FROM suratperintahtugas_detail WHERE id='$_POST[id]'") or die ("Error :".mysqli_error($mysqli));


	//insert suratperintahtugas_detail
	foreach ($_POST['daftarpegawai'] as $pgw) {
		# code...
		$qinsert2=mysqli_query($mysqli,"INSERT INTO suratperintahtugas_detail SET
			id=$_POST[id],
			idkepegawaian=$pgw") or die ("Error :".mysqli_error($mysqli));

	}
	echo "ok";
}
?>