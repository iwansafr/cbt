<?php include "../config/server.php";
$skul_pic= $log['XBanner'];
$warna= $log['XWarna'];

?>
<link href='../images/icon.png' rel='icon' type='image/png'>
<nav class="navbar navbar-default" style="background-color:#F7FACD ">
<!--<nav class="navbar navbar-default" style="background-color:<?php echo "$warna"; ?>">-->
	<div class="container-fluid">

		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header" >
		
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" >MADIPO e-LEARNING</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li><a href="../index.php">Logout</a></li>
		</ul>
		
		<ul class="nav navbar-nav navbar-right">
			<li><a href="./admin/index.php">Admin</a></li>
			<li><a href="./siswa/index.php">Siswa</a></li>
			<li><a href="./guru/index.php">Guru</a></li>
		</ul>
		
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title><?php echo $skull; ?> | Ujian Berbasis Komputer</title>
	<link href="../panel/dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../panel/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="../panel/vendor/jquery/jquery.min.js"></script>
	<script src="../panel/vendor/bootstrap/js/bootstrap.min.js"></script>
	<link href="../panel/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">     
	<script language="JavaScript">
		var txt="<?php echo $skull; ?> | Ujian Berbasis Komputer.....  ";
		var kecepatan=100;var segarkan=null;function bergerak() { document.title=txt;
		txt=txt.substring(1,txt.length)+txt.charAt(0);
		segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
	</script>
    

</head>

<body style="background:url(../panel/pages/images/login_utama.jpg);background-size:cover; background-repeat:no-repeat;">
	<a class="navbar-brand" ><img alt="Brand" src="../images/<?php echo "$skul_pic"; ?>"></a>
</body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div style="margin-top:0px; bottom:50px; background-color:#dcdcdc; padding:7px; font-size:12px">
    <div class="content">
		BeeSMART-CBT :  v3.0
		<br>
		Modifikasi :  Rev3
		<br>
    </div>
</div>
<footer>
<div class="group" style="background-color:<?php echo $warna; ?>;">
    <div  style="background-color:<?php echo $warna; ?>; padding:7px; font-size:12px">
        <center><b><span style="color: #ff0000;"><?php echo strtoupper("$skull"); ?> </span></b> <br> <span style="color: #1B06CF;">Supported by BEESMART</span></center>
    </div>
</footer>
<script src="../js/jquery.cookie.js"></script>
<script src="../js/common.js"></script>
<script src="../js/main.js"></script>
<script src="../js/cookieList.js"></script>
<script src="../js/backend.js"></script>

