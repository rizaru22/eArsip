<?php
include "konfigurasi.php";
include "function_date.php";
$lastid='';
if($_GET['action'] == "tampil"){
    $lastid=$_GET['id'];
}elseif($_GET['action'] == "cetak"){
    $qlastidi=mysqli_query($mysqli,"SELECT id from suratumum ORDER BY id DESC LIMIT 1") or die ("Error :".mysqli_error($mysqli));
    while($qr=mysqli_fetch_array($qlastidi)){
        $lastid=$qr['id'];
    }
}
	$query=mysqli_query($mysqli,"SELECT * FROM suratumum WHERE id='$lastid'") or die ("Error :".mysqli_error($mysqli));
	while($r=mysqli_fetch_array($query)){
		$jabatan='';
		$namapejabat='';
		$nippejabat='';
		$query2=mysqli_query($mysqli,"SELECT k.nama,k.nip,j.jabatan
FROM kepegawaian as k
INNER JOIN jabatan as j on j.idjabatan=k.jabatan
WHERE k.id='$r[pejabat_ttd]'")or die ("Error :".mysqli_error($mysqli));
		while($r2=mysqli_fetch_array($query2)){
        $jabatan=$r2['jabatan'];
		$namapejabat=$r2['nama'];
		$nippejabat=$r2['nip'];
		}

		$nosurat=$r['nosurat'];
		$lampiran=$r['lampiran'];
        $perihal=$r['perihal'];
        $tanggal=tgl_indonesia($r['tanggal']);
        $kepada=$r['tujuan'];
        $tempat=$r['tempat'];
        $isisurat=$r['isi'];
        $tembusan=$r['tembusan'];
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
            <tr width="600"><td align="left" style="padding-left: 50px;"><table>
                <tr><td>Nomor</td><td>:</td><td>'.$nosurat.'</td></tr>
                <tr><td>Lampiran</td><td>:</td><td>'.$lampiran.'</td></tr>
                <tr><td valign="top">Perihal</td><td valign="top">:</td><td valign="top">'.$perihal.'</td></tr>
            </table></td><td align="right" style="padding-right: 150px;">
                <table>
                    <tr><td>Karang Baru, '.$tanggal.'</td></tr>
                    <tr><td>Kepada Yth,</td></tr>
                    <tr><td>'.$kepada.'</td></tr>
                    <tr><td>di-</td></tr>
                    <tr><td style="padding-left: 20px;">'.$tempat.'</td></tr>
                </table>
            </td></tr>
            <tr><td colspan="2" style="padding-left: 50px; padding-right: 50px;">'.$isisurat.'</td></tr>   
        </tbody>
        <tfoot>
            <tr><td width="400">&nbsp;</td><td align="left">
                <table>
                   <tr><td colspan="2" height="30" valign="bottom">Karang Baru, '.$tanggal.'</td></tr>
                    <tr><td colspan="2"  valign="bottom"> '.$jabatan.' Karang Baru</td></tr>
                    
                    <tr><td colspan="2" height="120" valign="bottom"> <b><u>'.$namapejabat.'</u></b></td></tr>
                    <tr><td colspan="2"> NIP. '.$nippejabat.'</td></tr>
                </table>
            </td></tr>';
            if(!empty($tembusan)){
             echo '<tr><td style="padding-left: 50px; padding-right: 50px;">Tembusan :</td></tr>
            
            <tr><td colspan="2" style="padding-left: 50px; padding-right: 50px;">'.$tembusan.'</td></tr>';
            }
        echo '</tfoot>
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