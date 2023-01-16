<html>
<head>
<link href="../images/favicon2.ico" rel="icon" type="image/x-icon">
<title>eArsip-Aplikasi Arsip Surat</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>

<style>
    .main {
        background: #fffff;
        border-bottom: 15px solid #02BC0B;
        border-top: 15px solid #02BC0B;
       margin-top: 30px;
        margin-bottom: 30px;
        padding: 40px 30px !important;
        position: relative;
        box-shadow: 0 1px 21px #808080;
        font-size:10px;
    }

    .main thead {
        background: #1E2B38;
        color: #fff;
        }
    .spasi {
      padding-left: 60px; 
      padding-right:50px;
    }

    .table{
    	font-weight:bold ;
    	font-size:2em;
    }

    .well .well-sm{
    	border-style: none;
    	background-color: #FFF;
    }
</style>


</head>
<?php
session_start();
if(empty($_SESSION['username']) or empty($_SESSION['password'])){
   header('location: login.php');
}
include 'notiv.php';
echo '<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-1 main" align="center">
            
                 <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Aplikasi Arsip Surat</h1><br> 
                        <img src="images/logokabupaten.png" width="150"> 
                    </div>
                </div>
                <br />
               
                <table class="table ">
                    <tbody>
                    <tr>
                        <td width="200">Nama Instansi</td><td>:</td><td>Puskesmas Karang Baru</td>
                    </tr>
                     <tr>
                        <td>Alamat</td><td>:</td><td><span style="white-space: pre-line">Jln. Medan – Banda Aceh Dusun Inpres  Desa Pahlawan Kec. Karang Baru Kode Pos : 24476</span></td>
                    </tr>
                    <tr>
                        <td>Pengguna</td><td>:</td><td>'.$_SESSION['jabatan'].'</td>
                    </tr>
              		<tr>
                        <td>Disp. Belum Dibaca</td><td>:</td><td><span style="color:#FC0400">Surat Masuk ('.dissm().')</span> / <span style="color:#4EBFF7">Surat Keluar ('.dissk().')</span></td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
                <div class="row">                  
                <div>Copyright &copy; rizaru.2.2@gmail.com</div>
            </div>
        
    </div>
</div>
</div>

</body>
</html>';
?>