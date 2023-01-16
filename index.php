<?php
session_start();
ob_start();

//Mengatur batas login
$timeout = $_SESSION['timeout'];
if(time()<$timeout){
   $_SESSION['timeout'] = time()+5000;
}else{
   $_SESSION['login'] = 0;
}

//Mengecek status login
if(empty($_SESSION['username']) or empty($_SESSION['password']) or $_SESSION['login']==0){
   header('location: login.php');
}
?>
<html>
<head>
<link href="images/favicon2.ico" rel="icon" type="image/x-icon">
<title>eArsip-Aplikasi Arsip Surat</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<link rel="stylesheet" type="text/css" href="styles/menu.css"/>
<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/dataTables/css/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="styles/global.css"/>



</head>

<body>

	<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     <div class="logo"> <a class="navbar-brand menu" href="dashboard.php"><i class="glyphicon glyphicon-leaf"></i>e<span>Arsip</span> </a></div>
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
   
  </div><!-- /.container-fluid -->
</nav>
	<div id="container">
		
	<div id="sidebar-collapse" class="sidebar">
		<?php include "menu.php"; ?>
	</div>

		
		<div class="content">
			<div class="col-lg-12" id="isi"></div>
		</div>
      
		
	</div>
</section>
<footer></footer>
<script type="text/javascript" src="assets/jquery/jquery-2.0.2.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/dataTables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/dataTables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="script/menu.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
   $('.has-sub').click(function(){
		$(this).toggleClass('tap');
	});
});
</script>
</body>
</html>