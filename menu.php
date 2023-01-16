
<nav class="main-nav">
      <!--Menu Sidebar-->
            <ul id="nav" class="main-nav-ul">
<?php
function menu($link, $icon, $title){
   $item = '<li><a href="'.$link.'" class="menu"><i class="glyphicon glyphicon-'.$icon.'"></i> '.$title.'</a></li>';
   return $item;
}

function openDropdown($icon,$title){
   echo '<li class="has-sub"><a href="#"><i class="glyphicon glyphicon-'.$icon.'"></i> '.$title.'<span class="sub-arrow"></span></a>
               <ul>';
}

function closeDropdown(){
   echo '</ul></li>';
}

include "notiv.php";
function badge($color,$ind){
   if ($ind=='1'){
    $jml=dissm();
 }else{
   $jml=dissk();
 }
   $item='<span class="badge badge-'.$color.'">  '.$jml.'</span>';
   return $item;
}

if($_SESSION['leveluser']=="Administrator" or $_SESSION['leveluser']=="super"){
   openDropdown("download-alt","Surat Masuk");
   echo menu("view/suratMasuk.php","envelope","Daftar Surat");
   echo menu("view/disposisi.php","transfer","Disposisi Surat");
   echo menu("view/daftarDisposisi.php","list","Daftar Disposisi");
   closeDropdown();
   openDropdown("cloud-upload","Surat Keluar");
   echo menu("view/suratKeluar.php","file","Daftar Surat");
   echo menu("view/disposisisuratkeluar.php","transfer","Disposisi Surat");
   echo menu("view/daftardisposisisk.php","list","Daftar Disposisi");
   closeDropdown();
   openDropdown("leaf","Buat Surat");
   echo menu("view/buatSurat.php","file","Surat Perintah Tugas");
   echo menu("view/kirsehat.php","file","KIR Sehat");
   echo menu("view/suratumum.php","file","Surat Umum");  
   closeDropdown();
   openDropdown("wrench","Pengaturan Data");
   if($_SESSION['username']=="superadmin"){
   echo menu("view/view_user.php","user","Pengguna");
}
   echo menu("view/view_kepegawaian.php","sort-by-attributes","Kepegawaian");  
   closeDropdown();

} 
if($_SESSION['penerima']=="Y"){        
   echo menu("view/disposisiin.php","inbox","Disposisi Diterima  ".badge("error","1"));
   echo menu("view/disposisiout.php","send","Disposisi Dikirim"); 
   echo menu("view/disposisisk.php","file","Disposisi Surat Keluar  ".badge("warning","2"));
   ;
}
echo menu("view/profile.php","user","Profile");
echo menu("logout.php","off","Logout");
?>
      </ul>   
</nav>