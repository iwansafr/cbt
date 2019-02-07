<?php include "../config/server.php";
$skul_pic= $log['XBanner'];
$warna= $log['XWarna'];
?>
<link href='../images/icon.png' rel='icon' type='image/png'>
<nav class="navbar navbar-default" style="background-color:<?php echo "$warna"; ?>">
	<div class="container-fluid">

		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header" >
		
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" >SMART e-LEARNING</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<!--<li><a href="./pusat/logout.php">Logout</a></li>-->
		</ul>
		
		<ul class="nav navbar-nav navbar-right">
			<li><a href="./login.php">Ujian Berbasis Komputer (UBK)</a></li>
			<li><a href="./pages/index.php">Administrasi</a></li>
			<li><a href="./e_learning/index.php">e-Learning</a></li>
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
	
	<link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="./vendor/jquery/jquery.min.js"></script>
	<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
	
	<script language="JavaScript">
		var txt="<?php echo $skull; ?> | Ujian Berbasis Komputer.....  ";
		var kecepatan=100;var segarkan=null;function bergerak() { document.title=txt;
		txt=txt.substring(1,txt.length)+txt.charAt(0);
		segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
	</script>
    


</head>

<body style="background:url(./pages/images/login_utama.jpg);background-size:cover; background-repeat:no-repeat;">
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

</html>