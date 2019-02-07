<?php
include "../../config/server.php";
if (@mysqli_query($sqlconn, "select * from cbt_zona LIMIT 1")==TRUE){
	if($val == TRUE){
		$skullogin= $log['XLogin'];
		$email=$log['XEmail'];
		$web=$log['XWeb'];
		$alamat=$log['XAlamat'];
		$tlp=$log['XTelp'];
		$h1=$log['XH1'];
		$h2=$log['XH2'];
		$h3=$log['XH3'];
		$cbt_header = mysqli_query($sqlconn,'select * from cbt_header');
		$ch = mysqli_fetch_array($cbt_header);
		if (mysqli_query($sqlconn,"select * from cbt_sync LIMIT 1")==TRUE){
			$hakakses=$ch['HakAkses'];
			$loginpanel=$ch['LoginPanel'];
		}else{
			$hakakses=0;
			$loginpanel=0;
		}
		
	}else{
		
		$skull= "UJIAN BERBASIS KOMPUTER";
	$skullogin= "pertama.png";
	$web="www.tuwagapat.com";
	$tlp="0000-00000";
	$h1="UJIAN BERBASIS KOMPUTER";
	$h2="BEESMART EDUCATION PARTNER";
	$h3="BEESMART-CBT Login";	
	$hakakses="0";
	$loginpanel="0";
	}
}else{
	if($val == TRUE){
	$skullogin= $log['XLogin'];
		$email=$log['XEmail'];
		$web=$log['XWeb'];
		$alamat=$log['XAlamat'];
		$tlp=$log['XTelp'];
		$h1=$log['XH1'];
		$h2=$log['XH2'];
		$h3=$log['XH3'];
		$cbt_header = mysqli_query($sqlconn,'select * from cbt_header');
		$ch = mysqli_fetch_array($cbt_header);	
		$hakakses="0";
		$loginpanel="0";
	}else{
		
		$skull= "UJIAN BERBASIS KOMPUTER";
	$skullogin= "pertama.png";
	$web="www.tuwagapat.com";
	$tlp="0000-00000";
	$h1="UJIAN BERBASIS KOMPUTER";
	$h2="BEESMART EDUCATION PARTNER";
	$h3="BEESMART-CBT Login";	
	$hakakses="0";
	$loginpanel="0";
	}
}

if(isset($sqlconn)){} else {$pesan1 = "Tidak dapat Koneksi Database.";}
if (!$sqlconn) {die('Could not connect: '.@mysqli_error($sqlconn));}
 
 ?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $skull; ?> | Administrator</title>
	<script language="JavaScript">
		var txt="<?php echo $skull; ?> | Administrator.....  ";
		var kecepatan=100;var segarkan=null;function bergerak() { document.title=txt;
		txt=txt.substring(1,txt.length)+txt.charAt(0);
		segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
	</script>
	<link href='../../images/icon.png' rel='icon' type='image/png'/>
	<!-- Bootstrap Core CSS -->
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- MetisMenu CSS -->
	<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
</head>

<!-- Custom Fonts -->
<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<style>
	.left 	{float: left;width: 50%;}
	.right 	{float: right;width: 42%; margin-top:150px;}
	.group:after {content:""; display: table; clear: both;}
	img {  max-width: 100%;  height: auto;}
	@media screen and (max-width: 480px) {.left, .right {float: none;  width: auto; margin-top:10px;	}}
	input[type=text] {padding: 12px 20px; margin: 8px 0; box-sizing: border-box; border:0;
		border-bottom: 2px solid #939292; background-color: #eae9e9; color: #999; width:100%;} 
	input[type=text]:focus {background-color: #fff; color: #999; width:100%;}
	input[type=password] {padding: 12px 20px; margin: 8px 0; box-sizing: border-box; border:0;  
		border-bottom: 2px solid #939292; background-color: #eae9e9; color: white; width:100%;}
	input[type=password]:focus {background-color: #fff;  color: #999; width:100%; }
	.switch-field {font-family: "Lucida Grande", Tahoma, Verdana, sans-serif; overflow: hidden;}
	.switch-title {margin-bottom: 6px;}
	.switch-field input {display: none;}
	.switch-field label {float: left;}
	.switch-field label {display: inline-block; width: 60px; background-color: #e4e4e4; color: rgba(0, 0, 0, 0.6);
		font-size: 14px; font-weight: normal; text-align: center; text-shadow: none; padding: 6px 14px;
		border: 1px solid rgba(0, 0, 0, 0.2); -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
		box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);  -webkit-transition: all 0.1s ease-in-out;
		-moz-transition: all 0.1s ease-in-out;  -ms-transition: all 0.1s ease-in-out;  -o-transition: all 0.1s ease-in-out;
		transition: all 0.1s ease-in-out;
	}
	.switch-field label:hover {cursor: pointer;}
	.switch-field input:checked + label {background-color: #A5DC86; -webkit-box-shadow: none; box-shadow: none;}
	.switch-field label:first-of-type {border-radius: 4px 0 0 4px;}
	.switch-field label:last-of-type {border-radius: 0 4px 4px 0;}
	#ingat{width:84%; height:90px; background-color:#FBECF0; border:0; border-left:thick #FF0000 solid; padding-left:10; padding-top:15}
</style>
<script>
	function disableBackButton() {window.history.forward();}
	setTimeout("disableBackButton()", 0);
</script>

<script src="js/jquery-1.11.0.min.js">
function validateForm() {
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
<!-- Show Password -->
<!-- 
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="../../mesin/asset/bootstrap-show-password.js"></script>
<script>
    $(function() {
        $('#passz').password().on('show.bs.password', function(e) {
            $('#eventLog').text('On show event');
            $('#methods').prop('checked', true);
        }).on('hide.bs.password', function(e) {
                    $('#eventLog').text('On hide event');
                    $('#methods').prop('checked', false);
                });
        $('#methods').click(function() {
            $('#passz').password('toggle');
        });
    });
</script>
<!-- /Show Password -->

<div class="group">
    <div class="left" >
		<img src="images/<?php echo "$skullogin"; ?>" alt="" >    
    </div>
    
	<div id="kepala" style="margin-top:0px;  background-color:#e8edf0;" align="center"><br /> 
		<h2 style='margin-top:15px'><?php echo $h1; ?></h2>	
		<h1 style='margin-top:-10px'> <?php echo $h2; ?></h1>	
		<h5 style='margin-top:-5px'> <?php echo "Web : ".$web." &nbsp;-&nbsp; Telp : ".$tlp; ?><!--<br><?php echo "Email: ".$email; ?>!--></h5><br/>
	</div>
   
    <div class="right col-xs-6">
	    <div>
			<h2><?php echo $h3; ?></h2>
			<p style="color:#8b8a8a">Selamat datang di aplikasi UBK/CBT.
			<br>Silahkan masukkan Username dan Password </p>
			<div id="ingat" style=" display:none"> 
				<p>	<span style=" padding:20px; padding-top:20; font-size:16px">Peringatan</span></p>        
				<p>	<span id="isine" style="color:#CC3300; margin-left:20px;" >
						<?php if($val == FALSE)	{?>
							<script>$(document).ready(function(){
									var peluru = '\u2022';
									document.getElementById("ingat").style.display = "block";
									document.getElementById("isine").textContent= peluru+" <?php echo "DataBase belum Terbentuk, "; ?>";
									return false;	
							});	</script>
						<?php } ?>
					</span>
					<?php 	if($val == FALSE){?>	<a href="buat_database.php">
							<input type="submit"  class="btn btn-danger btn-small" value="Kilik Sini Buat DataBase"></a>
					<?php } ?>
				</p> 
			</div>
			
		<form id="loginform"  name="loginform" onSubmit="return validateForm();" action="ceklogin.php" method="post">
			<div style="text-align:right; width:75%"><!-- Varable 1 userz -->
				<input type="text" id="userz" name="userz" placeholder="Username">
				<!-- Varable 2 passz -->
				
				<input type="password" id="passz" name="passz" placeholder="Password" >
			
				
				<div class="switch-field">	
				<!-- Varable 3 login -->
					<input type="radio" id="radio_admin" name="loginz" value="admin" checked/> <label for="radio_admin">Admin</label>
					<?php if ($hakakses==0) {?>
					<input type="radio" id="radio_siswa" name="loginz" value="siswa" /> <label for="radio_siswa">Siswa</label>
					<?php }?>
					<input type="radio" id="radio_guru" name="loginz" value="guru" /> <label for="radio_guru">Guru</label>
				</div>
				<div style="text-align:right; width:100%">
				<?php if(!$val == FALSE) {?>   
							<input type="submit"  class="btn btn-info btn-lg btn-small" value="Masuk"  >
				<?php } ?>
				</div>
			</div>
		</form> 
		
		
		</div>    
    </div>
</div>
</body>
</html>
