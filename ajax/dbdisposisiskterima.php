<?php
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password'])){
   header('location: login.php');
}
include "../include/konfigurasi.php";
include "../include/function_view.php";
include "../include/function_date.php";
//Menampilkan data ke tabel
if($_GET['action'] == "table_data"){
   $query = mysqli_query($mysqli, "SELECT dis.id,dis.tanggal,p.jabatan,sm.nosurat,sm.perihal,sm.filesurat FROM disposisisk as dis inner JOIN pegawai as p on p.idpegawai=dis.pengirim inner JOIN suratkeluar as sm on sm.idsuratkeluar=dis.idsuratkeluar INNER JOIN disposisisk_detail as dd on dd.id=dis.id WHERE dd.penerima=$_SESSION[idpegawai]");
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
      $row = array();
      $row[] = $no;
      $row[] = tgl_indonesia($r['tanggal']);
      $row[] = $r['jabatan'];
      $row[] = $r['nosurat'];
      $row[] = $r['perihal'];
	  $row[]='<a class="btn btn-info" onclick=setbaca('.$r['id'].') href="'.$folderSuratKeluar.$r['filesurat'].'" target=_blank><i class="glyphicon glyphicon-file"></i></a>';
      $row[] = '<a class="btn btn-primary btn-edit" onclick=setbaca('.$r['id'].') href="include/lembardisposisisk.php?action=tampil&id='.$r['id'].'" target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a>';
      $data[] = $row;
      $no++;
   }
	
   $output = array("data" => $data);
   echo json_encode($output);
}

else if($_GET['action']=="updatebaca"){
   mysqli_query($mysqli,"UPDATE disposisisk_detail SET status='Dibaca' WHERE id=$_GET[id] AND penerima=$_SESSION[idpegawai]") or die ("Error: ".mysqli_error($mysqli));   
}
?>