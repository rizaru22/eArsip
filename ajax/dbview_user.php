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
   $query = mysqli_query($mysqli, "SELECT * FROM pegawai ORDER BY level,idpegawai DESC");
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
      if($r['status']=='Y') $status="Penerima";
      else $status="Bukan Penerima";

      $row = array();
      $row[] = $no;
      $row[] = $r['jabatan'];
      $row[] = $r['username'];
      $row[] = $r['level'];
      $row[] = $status;
      $row[] = create_action($r['idpegawai'],true,true);
      $data[] = $row;
      $no++;
   }
	
   $output = array("data" => $data);
   echo json_encode($output);

}
elseif($_GET['action'] == "insert"){
   $password = md5($_POST['password']);
   mysqli_query($mysqli,"INSERT INTO pegawai SET 
      jabatan='$_POST[pengguna]',
      username='$_POST[username]',
      password='$password',
      level='$_POST[jenis]',
      status='$_POST[status]'")or die ("Error :".mysqli_error($mysqli));
   echo "ok";
}
elseif($_GET['action'] == "update"){
   $password = md5($_POST['password']);
   mysqli_query($mysqli,"UPDATE pegawai SET 
      jabatan='$_POST[pengguna]',
      username='$_POST[username]',
      password='$password',
      level='$_POST[jenis]',
      status='$_POST[status]' WHERE idpegawai='$_POST[id]'")or die ("Error :".mysqli_error($mysqli));
   echo "ok";
}elseif($_GET['action'] == "form_data"){
   $query=mysqli_query($mysqli, "SELECT * FROM pegawai WHERE idpegawai='$_GET[id]'") or die ("Error :".mysqli_error($mysqli));
   $data = mysqli_fetch_array($query); 
   echo json_encode($data);
}
elseif($_GET['action'] == "delete"){
   mysqli_query($mysqli, "DELETE FROM pegawai WHERE idpegawai='$_GET[id]'");  
}