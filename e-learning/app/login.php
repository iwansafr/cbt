<?php
include "../../config/server.php";
if($val==true){
$skull= $log['XSekolah'];
$skul_pic= $log['XBanner'];
$skul_ban= $log['XLoginUtama']; 
$skul_tkt= $log['XTingkat']; 
$skul_warna= $log['XWarna']; 
$skul_web= $log['XWeb']; 
$skul_alamat= $log['XAlamat']; 
$skul_tlp= $log['XTelp']; 
$skul_email= $log['XEmail']; 
$skul_prop= $log['XProp']; 
$skul_adm= strtoupper($log['XAdmin']); 
$status_server = 1;
$h1=$log['XH1'];
		$h2=$log['XH2'];
		$h3=$log['XH3'];
}
else{
	$h3="Login";$skul_pic="banner.png";$skul_ban="login_utama.jpg";
}
?>
<link href='../../images/icon.png' rel='icon' type='image/png'>
<nav class="navbar navbar-default" style="background-color:#F7FACD ">
<!--<nav class="navbar navbar-default navbar-static-top hidden-xs">-->
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
			<!--<li><a href=".../../index.php">Logout</a></li>-->
			
		</ul>
		
		<ul class="nav navbar-nav navbar-right">
		<li><a href="../../index.php">Menu Utama</a></li>
		<!--
			<li><a href="./login.php">Ujian Berbasis Komputer (SISWA)</a></li>
			<li><a href="./panel/pages/index.php">Administrasi UBK</a></li>
			<li><a href="./e-learning/app/index.php">e-Learning</a></li>
	-->
		</ul>
	
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
		


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LOGIN CBT</title>

	
    <!-- Bootstrap Core CSS -->
    <link href="../../panel/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../../panel/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../../panel/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../../panel/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<script language="JavaScript">
		var txt="MADIPO-CBT | Administrator.....";
		var kecepatan=100;var segarkan=null;function bergerak() { document.title=txt;
		txt=txt.substring(1,txt.length)+txt.charAt(0);
		segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
	</script>
    
<style>
html, body {height: 100%;}
input[type=text] {margin: 8px 0; box-sizing: border-box; border:0; border-bottom: 2px solid #939292; background-color: #eae9e9; color: #999;width:100%;}
input[type=text]:focus {background-color: #fff; color: #999; width:100%;}
input[type=password] {margin: 8px 0; box-sizing: border-box; border:0; border-bottom: 2px solid #939292; background-color: #eae9e9; color: white; width:100%;}
input[type=password]:focus {background-color: #fff; color: #999; width:100%;}
.switch-field {font-family: "Lucida Grande", Tahoma, Verdana, sans-serif; overflow: hidden;}
.switch-title {margin-bottom: 6px;}
.switch-field input {display: none;}
.switch-field label {float: left;}
.switch-field label {display: inline-block;width: 60px; background-color: #e4e4e4; color: rgba(0, 0, 0, 0.6); font-size: 14px;
	font-weight: normal; text-align: center; text-shadow: none; padding: 6px 14px; border: 1px solid rgba(0, 0, 0, 0.2);
	-webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
	box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
	-webkit-transition: all 0.1s ease-in-out;
	-moz-transition:    all 0.1s ease-in-out;
	-ms-transition:     all 0.1s ease-in-out;
	-o-transition:      all 0.1s ease-in-out;
	transition:         all 0.1s ease-in-out;
}
.switch-field label:hover {cursor: pointer;}
.switch-field input:checked + label {background-color: #A5DC86; -webkit-box-shadow: none; box-shadow: none;}
.switch-field label:first-of-type {border-radius: 4px 0 0 4px;}
.switch-field label:last-of-type {border-radius: 0 4px 4px 0;}
#ingat{width:84%; height:90px; background-color:#FBECF0; border:0; border-left:thick #FF0000 solid; padding-left:10; padding-top:15}
</style>
</head>
	
<body style="background:url(../../panel/pages/images/<?php echo "$skul_ban";?>);background-size:cover; background-repeat:no-repeat;">


<script>
        function disableBackButton() {window.history.forward();}
        setTimeout("disableBackButton()", 0);
</script>
	<script src="../../panel/pages/js/jquery-1.11.0.min.js"></script>
	<script>function validateForm() {
		var x = document.forms["loginform"]["userz"].value;
		var y = document.forms["loginform"]["passz"].value;
		var peluru = '\u2022';
		if (x == null || x == "" || y == null || y == "") {
			document.getElementById("ingat").style.display = "block";
			document.getElementById("isine").textContent= peluru+"Username dan Password harus diisi";
			return false;
		}
	}
</script>
 <div >
<p><a class="navbar-brand" href="?"><img alt="Brand" src="../../images/<?php echo "$skul_pic"; ?>"></a><br></br></p>
 </div>	
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
						<h3 class="panel-title"><?php echo "$h3"; ?>  </h3>   
                    </div>
                    <div class="panel-body">
					<center>Silahkan masukkan Username dan Password </center><br>
					<div id="ingat" style=" display:none"> <p>
						<span style=" padding:20px; padding-top:20; font-size:16px">Peringatan</span>
					</p>        
						<p>
						<span id="isine" style="color:#CC3300; margin-left:20px;" >
					 <?php 	if($val == FALSE){?>
						<script>
						$(document).ready(function(){
							var peluru = '\u2022';
								document.getElementById("ingat").style.display = "block";
								document.getElementById("isine").textContent= peluru+" <?php echo "Database belum Terbentuk"; ?>";
								return false;
						});		
						</script>
						<?php }	?>
									</span>
					<?php 	if($val == FALSE) {?>
						<a href="buat_database.php">
						<input type="submit"  class="btn btn-danger btn-small" value="Buat Database"></a>
					<?php }	?>
						</p> 
						</div>
                        <form role="form" id="loginform"  name="loginform" onSubmit="return validateForm();" action="./ceklogin.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" id="userz" name="userz" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" id="passz" name="passz" type="password" value="">
                                </div>
                                <div class="switch-field">
									 <!--<input type="radio" id="radio_admin" name="loginz" value="admin" /> <label for="radio_admin">Admin</label>-->
									<input type="radio" id="radio_siswa" name="loginz" value="siswa" checked/> <label for="radio_siswa">Siswa</label>
									<input type="radio" id="radio_guru" name="loginz" value="guru" /> <label for="radio_guru">Guru</label>
								</div>
                                <!-- Change this to a button or input when using this as a form -->
                                <?php if(!$val == FALSE) {?>   
									<p style="text-align:right; "><input type="submit"  class="btn btn-info btn-small" value=" &nbsp; Login &nbsp;"  ></p>
								<?php }	?>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../../panel/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../../panel/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../panel/vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../../panel/dist/js/sb-admin-2.js"></script>

</body>

</html>
