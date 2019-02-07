<?php 
include "./config/server.php";
include "./mesin/01.php";
include "./mesin/password.php";
include "./mesin/data-x.php";

if(isset($_REQUEST['ubahpassword'])){
	if 	($_REQUEST["passwordbaru1"]=="" || $_REQUEST["passwordbaru2"==""]){	}else{
	
		$teks1b="<?php ";
		$teks2b="\$data1=\"";$teks3b=$_REQUEST["passwordbaru1"];$teks4b="\";";
		$teks2c="\$data2=\"";$teks3c=$_REQUEST["passwordbaru2"];$teks4c="\";";
		$ubahpass =$teks1b.$teks2b.$teks3b.$teks4b.$teks2c.$teks3c.$teks4c;//isi tulisan file
		$file = fopen("./mesin/data-x.php","w");if($file){fputs($file,$ubahpass);}fclose($file); //proses buka-tulis-tutup file
		
		if 	($_REQUEST["passwordbaru1"]==$_REQUEST["passwordbaru2"]){
			
			$teks1a="<?php ";
			$teks2a="\$password=\"";$teks3a=md5($_REQUEST["passwordbaru1"]);$teks4a="\";";
			$ubahpass =$teks1a.$teks2a.$teks3a.$teks4a;//isi tulisan file
			$file = fopen("./mesin/password.php","w");if($file){fputs($file,$ubahpass);}fclose($file); //proses buka-tulis-tutup file
		}
	}
			header("Location: ./index.php");
}

if ($val==true){
$skul_pic= $log['XBanner'];
$warna= $log['XWarna'];
$elearning= $log['XLoginUtama'];
}else{
	$skul_pic= "banner.png";
$warna= "#F7FACD";
$elearning= "login_utama.jpg";
}
if(isset($_REQUEST['simpan_folder'])){
	$teks1z="<?php ";
	$teks2z="\$data1=\"";$teks3z="";$teks4z="\";";
	$teks2y="\$data2=\"";$teks3y="";$teks4y="\";";
	$ubahpass =$teks1z.$teks2z.$teks3z.$teks4z.$teks2y.$teks3y.$teks4y;//isi tulisan file
	$file = fopen("./mesin/data-x.php","w");if($file){fputs($file,$ubahpass);}fclose($file); //proses buka-tulis-tutup file
if (md5($_REQUEST["password"])==$password){		
	$teks01a="<?php ";
	$teks01b="\$k1=\"";$teks01c=$_REQUEST["1"];$teks01d="\";";
	$teks2i="\$ubahpass=\"";$teks3i=$_REQUEST["ubahpass"];$teks4i="\";";
	$kls01 =$teks01a.$teks01b.$teks01c.$teks01d.$teks2i.$teks3i.$teks4i;
	$file01 = fopen("./mesin/01.php","w");    
			if($file01){fputs($file01,$kls01);}
			fclose($file01); 
			
	$teks0a=$_REQUEST["db_server"];
	$teks1a="<?php ";
	$teks2a="\$db_server=\"";
	$teks3a="\";";
	$db_server =$teks1a.$teks2a.$teks0a.$teks3a;
	$file = fopen("./config/db_server.php","w");    
			if($file){fputs($file,$db_server);}
			fclose($file); 
}		
			header("Location: ./index.php");
}
?>
<link href='images/icon.png' rel='icon' type='image/png'>
<nav class="navbar navbar-default" style="background-color:#F7FACD">
	<div class="container-fluid">

		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header" >
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" ><span style="color:#0100EB"><b>e-LEARNING </span><span style="color:#EB1707">UBK/CBT</b></span></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
		<li><a href="#" data-toggle="modal" data-target="#nama_folder"><span style="color:#CFCCCD">Settings</span></a></li>
		<?php  if ($ubahpass=="1"){?>
				<li><a href="#" data-toggle="modal" data-target="#ubahpassword"><span style="color:#DFBEF7">Ubah Password</span></a></li>
		<?php } if (file_exists('./e-learning/')){?>
			<li><a href="./e-learning/app/index.php" >e-Learning</a></li>
			<?php } ?>
		</ul>
		
		<ul class="nav navbar-nav navbar-right">
			<li ><a style="color:#EB1707" href="./login.php">Ujian Berbasis Komputer (SISWA)</a></li>
			<li><a href="./panel/pages/index.php">Administrasi UBK</a></li>

<?php if (file_exists('../mesin_utama/01.php')){?>
			<li><a href="../">Logout</a></li>
		<?php } ?>
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
	<link href="./mesin/bootstrap/sb-admin-2.css" rel="stylesheet">
	<link href="./mesin/bootstrap/bootstrap.min.css" rel="stylesheet">
	<script src="./mesin/bootstrap/jquery.min.js"></script>
	<script src="./mesin/bootstrap/bootstrap.min.js"></script>
	<link href="./mesin/bootstrap/metisMenu.min.css" rel="stylesheet">     
	<script language="JavaScript">
		var txt="<?php echo $skull; ?> | Ujian Berbasis Komputer.....  ";
		var kecepatan=100;var segarkan=null;function bergerak() { document.title=txt;
		txt=txt.substring(1,txt.length)+txt.charAt(0);
		segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
	</script>
    

</head>
<html class="no-js" lang="en">
<!--Kode untuk mematikan fungsi klik kanan di blog-->
<script type="text/javascript">
function mousedwn(e){try{if(event.button==2||event.button==3)return false}catch(e){if(e.which==3)return false}}document.oncontextmenu=function(){return false};document.ondragstart=function(){return false};document.onmousedown=mousedwn
</script>
<body style="background:url(./images/<?php echo "$elearning"; ?>);background-size:cover; background-repeat:no-repeat;">
	<a class="navbar-brand" ><img alt="Brand" src="./images/<?php echo "$skul_pic"; ?>"></a>
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
<?php if ($k1==1){ ?>
<center>
<a href="./login.php"><button type="button" class="btn btn-warning btn-small">UBK/CBT (SISWA)</button></a>
<a href="./panel/pages/index.php"><button type="button" class="btn btn-primary btn-small">Administrasi UBK</button></a>
<a href="./e-learning/app/index.php"><button type="button" class="btn btn-success btn-small">&nbsp;&nbsp;&nbsp;&nbsp; e-Learning &nbsp;&nbsp;&nbsp;&nbsp;</button></a><br>
</center>
<?php } ?>
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
	<?php if ($teks3=="madipo_cbt"){echo "MADIPO-CBT";}else{echo "BeeSMART-CBT";}?> : <strong> v3_Rev3</strong><br>
	Modified @2017 by MBA
		<br>
    </div>
</div>
<footer>
<div class="group" style="background-color:<?php echo $warna; ?>;">
    <div  style="background-color:<?php echo $warna; ?>; padding:7px; font-size:12px">
        <center><b><span style="color: #ff0000;"><?php echo strtoupper("$skull"); ?> </span></b> <br> <span style="color: #1B06CF;">Supported by BEESMART</span></center>
    </div>
</footer>

	
<div class="modal fade" id="nama_folder" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
		<!-- MEMBUAT FORM -->
		<form action="?&simpan_folder=yes" method="post">		
			<div class="panel-default">
			<div class="modal-heading" style="width:100%; background-color:#28b2bc; color:#FFFFFF; padding:10px; margin-top:10px; font-size:22px">
				&nbsp; &nbsp;&nbsp; &nbsp;Settings</h1></div>
			<div class="panel-body">
			<div class="inner-content">
			<div class="wysiwyg-content">
			<br>
				<table width="100%" border="0" >
					<tr>
						<td>&nbsp;<td>Tombol&nbsp;&nbsp;<td >:&nbsp;&nbsp;<td >
							<select class="form-control" id="1" name="1">
								<option value='1' <?php if ($k1=="1") {echo "selected";} ?>>Tampil</option>
								<option value='0' <?php if ($k1=="0") {echo "selected";} ?>>Sembunyi </option>
							</select>
						</td>
					</tr>
					<tr>
						<td><td>Ubah Password<td >:<td >
						<select class="form-control" id="image" name="ubahpass">
								<option value='1' <?php if ($ubahpass=="1") {echo "selected";} ?>>Tampil</option>
								<option value='0' <?php if ($ubahpass=="0") {echo "selected";} ?>>Sembunyi </option>
							</select>
						<td></td>
					</tr>
					<tr>
						<td><td>Ubah db<td >:<td >
						<?php echo "<input type='text' class='form-control' name='db_server' value='$db'>"; ?>
						</td>
					</tr>
					<tr><td><td>Password<td >:<td >
						<input type='password' class='form-control' name='password' value='******'>
						<td align="center"><td></td>
					</tr>	
					<tr><td><td><td ><td >
						<span style="color:#1C7E6D;font-size:14px"><?php if (!$data1==""|| !$data2==""){if ($data1==$data2){echo "Gunakan Password Baru Anda";}else{echo "Gunakan Password Lama Anda";}}?></span>
						<td align="center"><td></td>
					</tr>					
				</table>
			<br>
			</div>
			</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-xs-offset-4 col-xs-6">
						<button class="btn btn-primary" type="submit" class="btn btn-primary" style="margin-top:0px"><i class="fa fa-laptop"></i> Simpan</button>
						<button type="submit" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Batal &nbsp;&nbsp;</button>
					</div>
				</div>
			</div>
	</form>	
	</div>
	</div>
    </div>
</div>


<div class="modal fade" id="ubahpassword" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
		<!-- MEMBUAT FORM -->
		<form action="?&ubahpassword=yes" method="post">		
			<div class="panel-default">
			<div class="modal-heading" style="width:100%; background-color:#28b2bc; color:#FFFFFF; padding:10px; margin-top:10px; font-size:22px">
				<center> Ubah Password</center></h1></div>
			<div class="panel-body">
			<div class="inner-content">
			<div class="wysiwyg-content">
		<center>
				<table width="80%" border="0" >
					<tr>
						<td><td>Password Baru<td >:&nbsp;<td >
						<input type='password' class='form-control' name='passwordbaru1' id='p1' value=''>
						<td></td>
					</tr>
					<tr><td><td>Ulangi Password Baru<td >:<td >
						<input type='password' class='form-control' name='passwordbaru2' id='p2' value=''>
						<td align="center"><td></td>
					</tr>
				</table>
				<span style="color: #ff0000; font-size:16px" >
				<br>PERHATIAN<br> </span><span style=" font-size:14px" >- Password tidak tersimpan bila pengulangan salah<br>
				- Bila Sudah tersimpan tutup portal Ubah Password di menu Setting<br>
				- Password tidak boleh KOSONG
				</span>
				</center>
			<br>
		
	</div>
			
			<div class="panel-footer">
				<div class="row">
					<div class="col-xs-offset-4 col-xs-6">
						<button class="btn btn-primary" type="submit" class="btn btn-primary" style="margin-top:0px"><i class="fa fa-laptop"></i> Simpan</button>
						<button type="submit" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Batal &nbsp;&nbsp;</button>
					</div>
				</div>
			</div>
	</form>	
	</div>
	</div>
    </div>
	</div>
    </div>
</div>
</html>