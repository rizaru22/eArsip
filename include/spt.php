<?php
include "konfigurasi.php";
include "function_date.php";
$lastid='';
if($_GET['action'] == "tampil"){
    $lastid=$_GET['id'];
}elseif($_GET['action'] == "cetak"){
    $qlastidi=mysqli_query($mysqli,"SELECT id from suratperintahtugas ORDER BY id DESC LIMIT 1") or die ("Error :".mysqli_error($mysqli));
    while($qr=mysqli_fetch_array($qlastidi)){
        $lastid=$qr['id'];
    }

}

$query=mysqli_query($mysqli,"SELECT nosurat,tugas,tanggal_pelaksanaan, (SELECT dayofweek(tanggal_pelaksanaan)) as hari,lama_tugas,tempat,pembebanan_biaya,tanggal_ttd,pejabat_ttd FROM suratperintahtugas WHERE id='$lastid'") or die ("Error :".mysqli_error($mysqli));
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
        $tugas=$r['tugas'];
        $hari=hari_indonesia($r['hari']);
        $tanggal=tgl_indonesia($r['tanggal_pelaksanaan']);
        $lama=$r['lama_tugas'];
        $tempat=$r['tempat'];
        $pembebanan_biaya=$r['pembebanan_biaya'];
        $tanggal_ttd=tgl_indonesia($r['tanggal_ttd']);
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
   

}
p {
    text-align: justify;
    text-justify: inter-word;
     line-height: 150%;
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
</style>
</head>
<body onload="window.print();">

<table>
        
        <thead>
            <tr>
                <th colspan="2"><img src="../images/kopsurat.png" alt=""></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" align="center"><table width="700" >
                    <tr><td align="center" height="20" colspan="3"><b><u>SURAT TUGAS</u></b></td></tr>
                    <tr><td align="center" colspan="3" >Nomor : '.$nosurat.'</td></tr>
                    <tr><td colspan="3"><p>Yang bertanda tangan di bawah ini '.$jabatan.' Karang Baru Kecamatan Karang Baru Kabupaten Aceh Tamiang dengan ini menugaskan kepada :</p></td></tr>
                    <tr><td colspan="3" align="center"><table class="tableisi">
                        <thead>
                            <tr align="center" valign="middle"><td ><h3>NO</h3></td><td><h3>NAMA/NIP/PANGKAT</h3></td><td><h3>JABATAN</h3></td></tr>
                        </thead>
                        <tbody>';
                        	$query3=mysqli_query($mysqli,"SELECT sptd.id,k.nama,k.nip,j.jabatan,p.pangkat
FROM suratperintahtugas_detail as sptd
INNER JOIN kepegawaian as k on k.id=sptd.idkepegawaian
INNER JOIN jabatan as j on j.idjabatan=k.jabatan 
INNER JOIN pangkat as p on p.idpangkat=k.pangkat
WHERE sptd.id='$lastid'") or die("Error :".mysqli_error($mysqli));
                        	$no=1;
                        	while ($r3=mysqli_fetch_array($query3)){
                        		echo '<tr ><td align="center" valign="middle">'.$no.'</td><td>'.$r3['nama'].'<br>NIP.'.$r3['nip'].'<br>'.$r3['pangkat'].'</td><td align="center" valign="middle">'.$r3['jabatan'].'</td></tr>';
                        		$no++;
                        	}
                            
                        echo '</tbody>
                    </table></td></tr>
                    <tr height="50" valign="bottom"><td width="150" class="table1" >Tugas</td><td>:</td><td>'.$tugas.'</td></tr>
                    <tr><td class="table1">Hari/Tanggal</td><td>:</td><td>'.$hari .' / '.$tanggal.'</td></tr>
                    <tr><td class="table1">Lama Tugas</td><td>:</td><td>'.$lama.'</td></tr>
                    <tr><td class="table1">Tempat</td><td>:</td><td>'.$tempat.'</td></tr>
                    <tr><td valign="top" class="table1">Pembebanan Biaya</td><td valign="top">:</td><td width="550"><span style="white-space: pre-line">'.$pembebanan_biaya.'</span></td></tr>
                    <tr><td colspan="3" class="table1">Demikian untuk dapat dilaksanakan sebaik-baiknya</td></tr>

                </table></td>
            </tr>
        </tbody>
        <tfoot>
            <tr><td width="400">&nbsp;</td><td align="left">
                <table>
                    <tr><td>Di tetapkan di</td><td>: Karang Baru</td></tr>
                    <tr><td>Pada Tanggal</td><td>: '.$tanggal_ttd.'</td></tr>
                    <tr><td colspan="2" height="30" valign="bottom"> '.$jabatan.' Karang Baru</td></tr>
                    <tr><td colspan="2"> Kec. Karang Baru Kab. Aceh Tamiang</td></tr>
                    <tr><td colspan="2" height="120" valign="bottom"> <b><u>'.strtoupper($namapejabat).'</u></b></td></tr>
                    <tr><td colspan="2"> NIP. '.$nippejabat.'</td></tr>
                </table>
            </td></tr>
        </tfoot>
    </table>'; 
    /*<script type="text/javascript" src="../assets/jquery/jquery-2.0.2.min.js"></script>
    <script>
    $(document).ready(function () {
    window.print();
});
    </script>*/
echo '</body>
</html>';



?>