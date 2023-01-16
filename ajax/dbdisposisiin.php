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
   $query = mysqli_query($mysqli, "SELECT dis.iddisposisi,dis.tanggal,p.jabatan,sm.noSurat,sm.fileSurat FROM disposisi as dis inner JOIN pegawai as p on p.idpegawai=dis.pengirim inner JOIN suratmasuk as sm on sm.idSuratMasuk=dis.idsuratmasuk INNER JOIN disposisi_detail as dd on dd.iddisposisi=dis.iddisposisi WHERE dd.penerima=$_SESSION[idpegawai] ORDER BY dis.iddisposisi DESC, dis.tanggal DESC " )or die ("Error :".mysqli_error($mysqli));
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
      $row = array();
      $row[] = $no;
      $row[] = tgl_indonesia($r['tanggal']);
      $row[] = $r['jabatan'];
      $row[] = $r['noSurat'];
	  $row[]='<a class="btn btn-info" onclick=setbaca('.$r['iddisposisi'].') href="'.$folderSuratMasuk.$r['fileSurat'].'" target=_blank><i class="glyphicon glyphicon-file"></i></a>';
      $row[] = '<a class="btn btn-primary btn-edit" onclick=setbaca('.$r['iddisposisi'].') href="include/lembardisposisi.php?action=tampil&id='.$r['iddisposisi'].'" target="_blank"><i class="glyphicon glyphicon-eye-open"></i></a>';
      $row[]= ' <a class="btn btn-success btn-edit" onclick="pilih_data('.$r['iddisposisi'].')"><i class="glyphicon glyphicon-send"></i> Disposisikan</a>';
      $data[] = $row;
      $no++;
   }
	
   $output = array("data" => $data);
   echo json_encode($output);
}
else if ($_GET['action']=="form_data"){
    $query = mysqli_query($mysqli, "SELECT dis.iddisposisi,dis.indeks,dis.tingkat,dis.instruksi,sm.noSurat,sm.idSuratMasuk FROM disposisi as dis  inner JOIN suratmasuk as sm on sm.idSuratMasuk=dis.idsuratmasuk WHERE dis.iddisposisi=$_GET[id]")or die ("Error: ".mysqli_error($mysqli));
   $data = mysqli_fetch_array($query); 
   echo json_encode($data);
}
elseif($_GET['action']=="insert"){
   $tanggal=date("Y-m-d");
   //print_r($_POST);
   //echo $_POST['idsurat'];
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
   $penerima=$_POST['kirim'];
   foreach($penerima as $p){
      mysqli_query($mysqli,"INSERT INTO disposisi_detail SET iddisposisi='$iddis',penerima='$p',status='Terkirim'");
   }

   //update detail_disposisi
   mysqli_query($mysqli,"UPDATE disposisi_detail SET status='Dibaca' WHERE iddisposisi=$_POST[id] AND penerima=$_SESSION[idpegawai]") or die ("Error: ".mysqli_error($mysqli));

   echo "ok";
}
else if($_GET['action']=="updatebaca"){
   mysqli_query($mysqli,"UPDATE disposisi_detail SET status='Dibaca' WHERE iddisposisi=$_GET[id] AND penerima=$_SESSION[idpegawai]") or die ("Error: ".mysqli_error($mysqli));   
}
?>