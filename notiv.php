<?php

function dissm(){
	include "include/konfigurasi.php";
	$query=mysqli_query($mysqli,"SELECT dis.iddisposisi FROM disposisi as dis INNER JOIN disposisi_detail as dd on dd.iddisposisi=dis.iddisposisi WHERE dd.status='Terkirim' AND dd.penerima='$_SESSION[idpegawai]'") or die ("Error: ".mysqli_error($mysqli));
	$nil=mysqli_num_rows($query);
	return $nil;
}


function dissk(){
	include "include/konfigurasi.php";
	$query=mysqli_query($mysqli,"SELECT dis.id FROM disposisisk as dis INNER JOIN disposisisk_detail as dd on dd.id=dis.id WHERE dd.status='Terkirim' AND dd.penerima='$_SESSION[idpegawai]'") or die ("Error: ".mysqli_error($mysqli));
	$nil=mysqli_num_rows($query);
	return $nil;
}

?>