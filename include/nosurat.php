<?php
function nosuratbaru(){
include "konfigurasi.php";
$noakhir_kirsehat='';
$noakhir_suratumum='';
$noakhir_suratkeluar='';
$kodesurat='440';
$tahun=date('Y');
//$tahun='2018';
//kiserhat
$query=mysqli_query($mysqli,"SELECT nosurat from kirsehat where YEAR(tanggal)='$tahun' ORDER BY id DESC LIMIT 1") or die ("Error :".mysqli_error($mysqli));
while ($r=mysqli_fetch_array($query)) {
	$n=explode ("/",$r['nosurat']);
	$noakhir_kirsehat=$n[1];
}

$query2=mysqli_query($mysqli,"SELECT nosurat FROM suratumum WHERE YEAR(tanggal)='$tahun' ORDER BY id DESC LIMIT 1") or die ("Error :".mysqli_error($mysqli));
while($r=mysqli_fetch_array($query2)){
	$n=explode("/", $r['nosurat']);
	$noakhir_suratumum=$n[1];
}

$query3=mysqli_query($mysqli,"SELECT nosurat FROM suratkeluar WHERE YEAR(tanggal)='$tahun' AND nosurat LIKE '440%'") or die ("Error :".mysqli_error($mysqli));
$no1=array("0");
while($r=mysqli_fetch_array($query3)){
	$no=explode ("/",$r['nosurat']);
	$no1[]=$no[1];
}

$noakhir_suratkeluar= max($no1);
if(!empty($noakhir_suratkeluar) OR !empty($noakhir_suratumum) OR !empty($noakhir_kirsehat)){
	$nobaru=max($noakhir_suratumum,$noakhir_kirsehat,$noakhir_suratkeluar) + 1;
}
else{
	$nobaru="001";
}

if (strlen($nobaru)==1){
		$noindekxbaru='00'.$nobaru;

	}elseif(strlen($nobaru)==2){
		$noindekxbaru='0'.$nobaru;
	}else{
		$noindekxbaru=$nobaru;
	}
$nosuratbarusekali=$kodesurat.'/'.$noindekxbaru.'/'.$tahun;

return $nosuratbarusekali;
}

function nosuratperintahtugas(){
	include "konfigurasi.php";
	$kodesurat='800';
	$nosurat="";
	$tahun=date('Y');

	if ($result =mysqli_query($mysqli,"SELECT nosurat FROM suratperintahtugas where YEAR(tanggal_pelaksanaan)='$tahun'")){
	$hit=mysqli_num_rows($result);
	mysqli_free_result($result);
}


if ($hit>0){
$qnosurat=mysqli_query($mysqli,"SELECT * FROM suratperintahtugas where YEAR(tanggal_pelaksanaan)='$tahun' ORDER BY id DESC LIMIT 1") or die ("Error: ".mysqli_error($mysqli));
while($rns=mysqli_fetch_array($qnosurat)){
		$noakhir=$rns['nosurat'];
	}

	$nos=explode("/",$noakhir);
	$nint=(int)$nos[0];
	
	$str=$nint+1;

	$nosurat1='';
	if (strlen($str)==1){
		$nosurat1='00'.$str;

	}elseif(strlen($str)==2){
		$nosurat1='0'.$str;
	}else{
		$nosurat1=$str;
	}
	
	$nosurat=$nosurat1.'/'.$kodesurat.'/'.$tahun;
	}
else {
	$nosurat='001'.'/'.$kodesurat.'/'.$tahun;
}

return $nosurat;
}
?>