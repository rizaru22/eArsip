<?php
include "konfigurasi.php";
include "function_date.php";
$lastid='';
if($_GET['action'] == "tampil"){
    $lastid=$_GET['id'];
}elseif($_GET['action'] == "cetak"){
    $qlastidi=mysqli_query($mysqli,"SELECT id from kirsehat ORDER BY id DESC LIMIT 1") or die ("Error :".mysqli_error($mysqli));
    while($qr=mysqli_fetch_array($qlastidi)){
        $lastid=$qr['id'];
    }
}
	$query=mysqli_query($mysqli,"SELECT * FROM kirsehat WHERE id='$lastid'") or die ("Error :".mysqli_error($mysqli));
	while($r=mysqli_fetch_array($query)){
		$jabatan='';
		$namapejabat='';
		$nippejabat='';
		$query2=mysqli_query($mysqli,"SELECT k.nama,k.nip
FROM kepegawaian as k
WHERE k.id='$r[dokter]'")or die ("Error :".mysqli_error($mysqli));
		while($r2=mysqli_fetch_array($query2)){
		$namapejabat=$r2['nama'];
		$nippejabat=$r2['nip'];
		}

        $buta_warna="";
        if ($r['buta_warna']=="Buta") $buta_warna="Buta Warna";
        else $buta_warna=$r['buta_warna'];

		$nosurat=$r['nosurat'];
		$nama=$r['nama'];
        $tempat_lahir=$r['tempat_lahir'];
        $tanggal_lahir=tgl_indonesia($r['tanggal_lahir']);
        $pekerjaan=$r['pekerjaan'];
        $alamat=$r['alamat'];
        $berat_badan=$r['berat_badan'];
        $godar=$r['golongan_darah'];
        $tinggi=$r['tinggi_badan'];
        $buta=$buta_warna;
        $keterangan=$r['keterangan'];
        $keperluan=$r['keperluan'];
        $tanggal=tgl_indonesia($r['tanggal']);

        if ($keterangan=='Y'){
            $tampilketerangan='<img src="../images/sehat.png" height="50" alt="">';
        }else{
            $tampilketerangan='<img src="../images/tidaksehat.png" height="50" alt="">';
        }

    }

		echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../images/favicon2.ico" rel="icon" type="image/x-icon">
<title>eArsip-Aplikasi Arsip Surat</title>
    <style>
@page{
	margin:0;
	border:0;
}

body{
    font-size:13pt;
    font-family: "Times New Roman";
    word-spacing: 4px;
    line-height: 150%;

}
.tdd{
    line-height:100%;
    word-spacing: 2px;
}
p {
    text-align: justify;
    text-justify: inter-word;

}

.tableisi {
    border-collapse: collapse;
    width: 90%;
}

.tableisi td {
    border: 1px solid black;
    padding: 5px;
      font-size: 1em;
}
.tableisi th {
    border: 1px solid black;
    padding: 5px;
    font-style: 

}

.table1 {
    padding: 5px;
}
div.fixed {
    position: fixed;
    bottom: 0;
    right: 0;
    width: 300px;
    border: 3px solid #73AD21;
}

garis td{
    border-bottom: 1px solid black;
    
  }

.nosurat{
    line-height: 100%;
}
.no{
    letter-spacing: 0px;
}
  
</style>
</head>
<body>

<table>
        
        <thead>
            <tr>
                <th colspan="2"><img src="../images/kopsurat.png" alt=""></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" align="center">
                    <table width="700" >
                    <tr><td align="center" height="30" colspan="3"><div class="nosurat"><b><u>SURAT KETERANGAN DOKTER</u></b><br>Nomor :'.$nosurat.'</div></td></tr>
                    <tr><td align="center" colspan="3" ></td></tr>
                    <tr><td colspan="3"><p>Yang bertanda tangan dibawah ini '.  $namapejabat.', NIP. '. $nippejabat.'  Dokter Pusat Kesehatan Masyarakat Karang Baru Kab. Aceh Tamiang  dalam hal ini telah menjalankan tugasnya dengan mengingat sumpah (Perjanjian) yang telah diucapkan sewaktu menerima jabatan, menerangkan bahwa </p></td></tr>
                    <tr><td colspan="3" align="center"></td></tr>
                    <tr height="45" valign="bottom"><td width="200" class="table1" >Nama</td><td>:</td><td>'.$nama.'</td></tr>
                    <tr><td class="table1" width="75">Tempat/Tanggal Lahir</td><td>:</td><td>'.$tempat_lahir. '/' .$tanggal_lahir.'</td></tr>
                    <tr><td class="table1">Pekerjaan</td><td>:</td><td>'.$pekerjaan.'</td></tr>
                    <tr><td valign="top" class="table1">Alamat </td><td valign="top">:</td><td width="550"><span style="white-space: pre-line">'.$alamat.'</span></td></tr>
                    <tr><td class="table1">Berat Badan</td><td>:</td><td>'.$berat_badan.' Kg  &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; Golongan Darah : ('.$godar.')</td></tr>
                    <tr><td class="table1">Tinggi Badan</td><td>:</td><td>'.$tinggi.' Cm</td></tr>';
                    if (!empty($buta)){
                    echo '<tr><td class="table1">Tes Buta Warna</td><td>:</td><td>'.$buta.'</td></tr>';
                }
                   echo '<tr><td colspan="3"><table width="600"><tr><td width="350">Berpendapat bahwa yang diperiksa tersebut :</td><td> '.$tampilketerangan.'</td></tr></table></td></tr>
                <tr><td class="table1" height="30" colspan="3">Untuk Keperluan  :'.$keperluan.'</td></tr>
                <tr><td class="table1" colspan="3">Demikianlah Surat Keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan seperlunya.</td></tr>
                </table></td>
            </tr>
        </tbody>
        <tfoot>
            <tr><td width="400">&nbsp;</td><td align="left">
                
                <table>
                   <tr><td colspan="2" height="30" valign="bottom"><span style="line-height:0%;">Karang Baru, '.$tanggal.'<br>Dokter Puskesmas Karang Baru</span></td></tr>
                    
                    <tr><td colspan="2" height="120" valign="bottom"><span style="line-height:0%;"> <b><u>'.$namapejabat.'</u></b><br> NIP. '.$nippejabat.'</span></td></tr>
                </table>
            </td></tr>
        </tfoot>
    </table> 
    <script type="text/javascript" src="../assets/jquery/jquery-2.0.2.min.js"></script>
    <script>
    $(document).ready(function () {
    window.print();
});
    </script>
</body>
</html>';


?>