<?php
include "konfigurasi.php";
include "function_date.php";
//echo $_GET['action'];
//echo $_GET['id'];
$tanggal="";
$nosurat="";
$perihal="";
$pengirim="";
$label="";
$indeks="";
$sifat="";
$list="";
$iddisposisi='';
if($_GET['action'] == "tampil"){
    $iddisposisi=$_GET['id'];
}elseif($_GET['action'] == "cetak"){
  $qlastidi=mysqli_query($mysqli,"SELECT iddisposisi from disposisi ORDER BY iddisposisi DESC LIMIT 1") or die ("Error disini:".mysqli_error($mysqli));
    while($qr=mysqli_fetch_array($qlastidi)){
       $iddisposisi=$qr['iddisposisi'];
    }
}
   $query = mysqli_query($mysqli, "SELECT * FROM disposisi WHERE iddisposisi='$iddisposisi'");
   $data = array();
   $no = 1;
   while($r = mysqli_fetch_array($query)){
    $tanggal=tgl_indonesia($r['tanggal']);
    $indeks=$r['indeks'];
    $sifat=$r['tingkat'];
    $instruksi=$r['instruksi'];
      $querysurat=mysqli_query($mysqli,"SELECT * FROM suratmasuk WHERE idSuratMasuk='$r[idsuratmasuk]'");
      while($rsurat=mysqli_fetch_array($querysurat)){
         $nosurat=$rsurat['noSurat'];
         $perihal=$rsurat['perihal'];
         
         
      }

      $querypengirim=mysqli_query($mysqli,"SELECT jabatan FROM pegawai WHERE idpegawai='$r[pengirim]'") or die ("Error: ".mysqli_error($mysqli));
      
      while($rpengirim=mysqli_fetch_array($querypengirim)){
         $pengirim=$rpengirim['jabatan'];
      }

      
      $querypenerima=mysqli_query($mysqli,"SELECT dd.penerima,dd.status,p.jabatan FROM disposisi_detail as dd INNER JOIN pegawai as p on p.idpegawai=dd.penerima WHERE dd.iddisposisi='$r[iddisposisi]'")or die ("Error: ".mysqli_error($mysqli));
    
      while ($rpenerima=mysqli_fetch_array($querypenerima)) {
         if($rpenerima['status']=="Terkirim") $class="label-warning";
         else $class="label-success";
         $list[] = array($rpenerima['jabatan'],$rpenerima['status']);
      }
      

   }

    $jabatan='';
    $namapejabat='';
    $nippejabat='';
    $query2=mysqli_query($mysqli,"SELECT k.nama,k.nip,j.jabatan
FROM kepegawaian as k
INNER JOIN jabatan as j on j.idjabatan=k.jabatan
WHERE k.id='1'")or die ("Error :".mysqli_error($mysqli));
    while($r2=mysqli_fetch_array($query2)){
        $jabatan=$r2['jabatan'];
    $namapejabat=$r2['nama'];
    $nippejabat=$r2['nip'];
    }

echo '
<html>
<head>
<link href="../images/favicon2.ico" rel="icon" type="image/x-icon">
<title>eArsip-Aplikasi Arsip Surat</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>

<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="../assets/dataTables/css/dataTables.bootstrap.min.css"/>

<style>
@page{
  margin:0;
  border:0;
}
.table{
   font-size:12pt;
}

    .main {
        background: #fffff;
        border-bottom: 15px solid #1E2B38;
        border-top: 15px solid #3498db;
        margin-top: 30px;
        margin-bottom: 30px;
        padding: 40px 30px !important;
        position: relative;
        box-shadow: 0 1px 21px #808080;
        font-size:12pt;
    }

    .table1 thead {
        background: #1E2B38;
        color: #fff;
        }
    .table1 td{
      border: 1px solid black;
    padding: 5px;
    }
    .table1 tr {
    border: 1px solid black;
    padding: 5px;
}

.table1{
  text-align: center;
}
       
    .spasi {
      padding-left: 60px; 
      padding-right:50px;
    }
    

</style>


</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 main">
            <div class="col-md-12">
                 <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Lembar Disposisi Surat Masuk</h2>
                    </div>
                </div>
                <br />
                 <div class="row">
                <div class="col-xs-6">
                      <strong><h4>Tanggal :'.$tanggal.'</h4></strong>
                </div>
                <div class="col-xs-6 text-right">
                    <strong><h4>Dari :'. $pengirim .'</h4></strong>
                </div>
            </div>
                    <div class="row">
                <div class="col-xs-6">
                      <strong><h4>Indeks :'. $indeks.'</h4></strong>
                </div>
                <div class="col-xs-6 text-right">
                    <strong><h4>Sifat :'.$sifat.'</h4></strong>
                </div>
            </div>
                <table class="table ">
                    <tbody>
                    <tr>
                        <td><strong>No Surat :'.$nosurat.'</strong></td>
                        
                    </tr>
                    <tr>
                        <td><strong>Perihal : </strong></td>
                    </tr>
                    <tr>
                        <td><div class="col-xs-12 spasi">'.$perihal.'</div></td>
                    </tr>
                     <tr>
                        <td><strong>Instruksi : </strong></td>
                    </tr>
                    <tr>
                        <td><div class="col-xs-12 spasi" >'.$instruksi.'</div></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
                <div class="row">
                  
            
                    <table class="table table1">
                        <thead>
                            <tr>
                                <td><h4>No</h4></td>
                                <td><h4>Diteruskan Kepada</h4></td>
                                <td><h4>Status</h4></td>
                            </tr>
                        </thead>
                        <tbody>';
                        $no=1;
                        foreach ($list as $daftar) {
                            
                               echo '<tr>
                                <td class="col-md-1">'.$no.'</td>
                                <td class="col-md-6">'.$daftar[0].'</td>
                                <td class="col-md-4">'.$daftar[1].'</td>
                            </tr>';
                              $no++;                      
                        }   
                        echo '</tbody>
                      
                    </table>
                     <table align="right">
                   <tr><td colspan="2" height="30" valign="bottom">Karang Baru, '.$tanggal.'</td></tr>
                    <tr><td colspan="2"  valign="bottom"> '.$jabatan.' Karang Baru</td></tr>
                    
                    <tr><td colspan="2" height="120" valign="bottom"> <b><u>'.$namapejabat.'</u></b></td></tr>
                    <tr><td colspan="2"> NIP. '.$nippejabat.'</td></tr>
                </table>
            
               
            </div>
        </div>
    </div>
</div>

 <script type="text/javascript" src="../assets/jquery/jquery-2.0.2.min.js"></script>
    <script>
    $(document).ready(function () {
    window.print();
});
    </script>
</body>
</html>';
?>