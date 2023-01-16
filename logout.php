<?php
  session_start();
  session_destroy();
  echo "<script>
      alert('Anda telah logout dari Aplikasi Arsip Surat'); 
      window.location = 'login.php';
      </script>";
?>