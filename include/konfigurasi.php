<?php
$host="localhost";
$user="root";
$pass="";
$db="earsip";

$mysqli=new mysqli($host, $user, $pass, $db);

$url_website="http://localhost/earsip";
$folderSuratMasuk="suratMasuk/";
$folderSuratKeluar="suratKeluar/";

date_default_timezone_set('Asia/Jakarta');
?>