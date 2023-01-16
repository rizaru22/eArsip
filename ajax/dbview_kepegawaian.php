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
   $query = mysqli_query($mysqli, "SELECT  k.id,k.nama,k.nip,p.pangkat,j.jabatan,k.ttd
FROM kepegawaian as k
INNER JOIN pangkat as p on p.idpangkat=k.pangkat
INNER JOIN jabatan as j on j.idjabatan=k.jabatan
ORDER BY k.jabatan,k.pangkat DESC") or die ("Error :".mysqli_error($mysqli));
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
      
      $row = array();
      $row[] = $no;
      $row[] = $r['nama'];
      $row[] = $r['nip'];
      $row[] = $r['jabatan'];
      $row[] = $r['ttd'];
      $row[] = create_action($r['id'],true,true);
      $data[] = $row;
      $no++;
   }
	
   $output = array("data" => $data);
   echo json_encode($output);

}elseif($_GET['action'] == "insert"){
   
   mysqli_query($mysqli,"INSERT INTO kepegawaian SET 
      nama='$_POST[nama]',
      nip='$_POST[nip]',
      pangkat='$_POST[pangkat]',
      jabatan='$_POST[jabatan]',
      ttd='$_POST[ttd]'")or die ("Error :".mysqli_error($mysqli));
   echo "ok";
}
elseif($_GET['action'] == "update"){
   
   mysqli_query($mysqli,"UPDATE kepegawaian SET 
      nama='$_POST[nama]',
      nip='$_POST[nip]',
      pangkat='$_POST[pangkat]',
      jabatan='$_POST[jabatan]',
      ttd='$_POST[ttd]' WHERE id=$_POST[id]")or die ("Error :".mysqli_error($mysqli));
   echo "ok";
}elseif($_GET['action'] == "form_data"){
   $query=mysqli_query($mysqli, "SELECT * FROM kepegawaian WHERE id='$_GET[id]'") or die ("Error :".mysqli_error($mysqli));
   $data = mysqli_fetch_array($query); 
   echo json_encode($data);
}
elseif($_GET['action'] == "delete"){
   mysqli_query($mysqli, "DELETE FROM kepegawaian WHERE id='$_GET[id]'");  
}

?>