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
   $query = mysqli_query($mysqli, "SELECT * FROM disposisi ORDER BY tanggal DESC, iddisposisi DESC ") or die ("Error :".mysqli_error($mysqli));
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
      $nosurat="";
      $fileSurat="";

      $querysurat=mysqli_query($mysqli,"SELECT * FROM suratmasuk WHERE idSuratMasuk='$r[idsuratmasuk]'");
      while($rsurat=mysqli_fetch_array($querysurat)){
         $nosurat=$rsurat['noSurat'];
         $fileSurat=$rsurat['fileSurat'];
      }

      $querypengirim=mysqli_query($mysqli,"SELECT jabatan FROM pegawai WHERE idpegawai='$r[pengirim]'") or die ("Error: ".mysqli_error($mysqli));
      $pengirim="";
      while($rpengirim=mysqli_fetch_array($querypengirim)){
         $pengirim=$rpengirim['jabatan'];
      }

      $label="";
      $querypenerima=mysqli_query($mysqli,"SELECT dd.penerima,dd.status,p.jabatan FROM disposisi_detail as dd INNER JOIN pegawai as p on p.idpegawai=dd.penerima WHERE dd.iddisposisi='$r[iddisposisi]'")or die ("Error: ".mysqli_error($mysqli));
    
      while ($rpenerima=mysqli_fetch_array($querypenerima)) {
         if($rpenerima['status']=="Terkirim") $class="label-warning";
         else $class="label-success";
         $label .= '<span class="label '.$class.'">'.$rpenerima['jabatan'].'</span> ';
      }
      $row = array();
      $row[] = $no;
      $row[] = tgl_indonesia($r['tanggal']);
      $row[] = $pengirim;
      $row[] = $nosurat;
      $row[] = $label;
	  $row[]= openFile($folderSuratMasuk.$fileSurat);
      $row[] = '<a class="btn btn-primary btn-edit" href="include/lembardisposisi.php?action=tampil&id='.$r['iddisposisi'].'" target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a>';
      $data[] = $row;
      $no++;
   }
	
   $output = array("data" => $data);
   echo json_encode($output);
}
?>