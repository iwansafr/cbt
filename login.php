<?php 
if(isset($_SERVER['HTTP_COOKIE'])){$kue = $_SERVER['HTTP_COOKIE'];
	$cookies = explode(';', $kue);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $user = trim($parts[0]);
        setcookie($user, '', time()-1000);
        setcookie($user, '', time()-1000, '/');
		setcookie("user", '', time()-1000);
		setcookie("apl", '', time()-1000);		
    	unset($_COOKIE['user']);
    	setcookie('user', '', time() - 3600, '/'); // empty value and old timestamp
    }
}
include "config/server.php";
if($val == TRUE){
$logo = $log['XLogo'];
$banner = $log['XBanner'];
$footer = $log['XSekolah'];
$warna = $log['XWarna'];
}else{ 
$banner = "banner.png"; 
$logo ="logo.gif";
$warna = "#0AF713";
if  (file_exists('./config/madipo_cbt.sql')){$footer = "MADIPO-CBT";}else{
$footer = "BeeSMART-CBT";}
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $skull;?> | UJIAN BERBASIS KOMPUTER</title>
	<script language="JavaScript">
		var txt="<?php echo $skull;?> | UJIAN BERBASIS KOMPUTER...... ";
		var kecepatan=100;var segarkan=null;function bergerak() { document.title=txt;
		txt=txt.substring(1,txt.length)+txt.charAt(0);
		segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
	</script>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='images/icon.png' rel='icon' type='image/png'/>
<style>
	.no-close .ui-dialog-titlebar-close {display: none;}
</style>
    <link rel="stylesheet" href="mesin/css/bootstrap2.min.css">
	<link href="mesin/css/klien.css" rel="stylesheet">
    <script src="mesin/js/jquery.min.js"></script>
    <script src="mesin/js/bootstrap.min.js"></script>
    <script src="mesin/js/inline.js"></script>
	<script type="text/javascript" src="mesin/js/jquery.js"></script>
	<script type="text/javascript" src="mesin/js/jquery.validate.js"></script>
	<script type="text/javascript">
    $(document).ready(function()
	 {//$("#form1").validate
		({	errorLabelContainer: "#myerror",
			wrapper: "li", rules: 
			{	UserName: "required",// simple rule, converted to {required:true}
				Password: "required",// simple rule, converted to {required:true}
				email: // compound rule
					{required: true, 
					email: true	},
				url: 
					{required: true,
					url: true },
				comment: 
				{required: true}
			},
			messages: 
			{	UserName:"Username Harus diisi, masukkan Username dengan benar",
				Password:"Password Harus diisi, masukkan Password dengan benar",
				comment: "Please enter a comment.",
				url:"Please Enter Correct URL"
			}
		});
    });		
  </script>

</head>
<style>
.left 	{float: left; width: 70%;}
.right 	{float: right; width: 30%; background-color: #333333; height:101px; color:#FFFFFF;	
		font-size: 13px; font-style:normal; font-weight:normal;}
.user 	{color:#FFFFFF; font-size: 15px; font-style:normal; font-weight:bold; top:-20px;}
.log 	{color:#3799c2; font-size: 11px; font-style:normal; font-weight:bold; top:-20px;}
.group:after {content:""; display: table; clear: both;}
/*
img 	{max-width: 100%; height: auto;}
*/
.visible{display: block !important;}
.hidden	{display: none !important;}
.foto	{height:80px;}	
.buntut	{width:100%;bottom:0px; position:absolute; margin-top:50px;}
@media screen and (max-width: 780px) 
	{ /* jika screen maks. 780 right turun */
		/*    .left, */
		.left,
		.right 	{float: none; width: auto; margin-top:0px; height:101px;	color:#FFFFFF; display:block;}
		.foto	{height:80px;}	
		.buntut	{width:200%;bottom:0px; position:absolute; margin-top:50px;}	
	}
@media screen and (max-width: 400px) 
	{ /* jika screen maks. 780 right turun */
		/*    .left, */
		.left	{width: auto; height: 91px;}
		.right 	{float: none; width: auto; margin-top:0px; height:60px; color:#FFFFFF;}
		.foto	{height:60px;}	
		.buntut	{width:100%;bottom:0px; position:absolute; padding-top:50px;}
	}
</style>
<!-- show password -->
<script src="mesin/js/jquery.min.js"></script>
<script src="mesin/js/bootstrap.js"></script>
<script src="mesin/asset/bootstrap-show-password.js"></script>
<!-- 
<script>
    $(function() {
        $('#password').password().on('show.bs.password', function(e) {
            $('#eventLog').text('On show event');
            $('#methods').prop('checked', true);
        }).on('hide.bs.password', function(e) {
                    $('#eventLog').text('On hide event');
                    $('#methods').prop('checked', false);
                });
        $('#methods').click(function() {
            $('#password').password('toggle');
        });
    });
</script>-->
<!-- /show password -->
<body class="font-medium">

<header style="background-color:<?php echo "$warna"; ?>">
<div class="group">
    <div class="left" style="background-color:<?php echo "$warna"; ?>"><img src="images/<?php echo $banner; ?>" style=" margin-left:0px;"></div>
    	<div class="right">
			<table width="100%" border="0" style="margin-top:10px">   
     			<tr><td rowspan="3" width="120px" align="center"><img src="images/avatar.gif" style=" margin-left:0px;" class="foto"></td>
				<td>Selamat Datang Peserta Ujian</td></tr>
				<tr><td><span class="user">Jangan Lupa Berdo'a </span></td></tr>
				<tr><td><span class="log"><a href="index.php">Logout</a><span></td></tr>
			</table>
        </div>
           
</div>
</div> 
</div>   

</header>

<ul>
  
	<div id="myerror" class="alert alert-danger" role="alert" style=" font-size: 13px; font-style:normal; font-weight:normal; margin-left:-40px; padding-left:30px;">
    <?php 
	if(isset($_REQUEST['salah'])){
		if($_REQUEST['salah']==2){echo "<b><li>Database belum tersedia, Hubungi Administrator Ujian </li></b>";}
		elseif($_REQUEST['salah']==1){echo "<b><li>Username atau Password anda salah</li></b>";}
		elseif($_REQUEST['salah']==3){echo "<b><li>Anda Sudah Login di tempat lain</li></b>";
		
		}
	$_REQUEST['salah']="";}
	?>
	</div>
</ul>
    
<div  class="col-md-4 col-md-offset-4 login-wrapper" id="panel_login" style="float:inherit; margin-top:0px;  max-width:500px;">
<div class="panel panel-default" style="margin-top:20px">
	<div class="panel-heading " style="font-size:25px; font-weight:bold; padding-left:20px">
		<img src="images/<?php echo  $logo  ?>" style=" width:17%; margin-top:-5px; overflow:hidden "/>
		&nbsp&nbsp Login Peserta
    </div>
	<div class="inner-content" style="height:250px">
		<form action="konfirm.php" method="post" data-toggle="validator" id="form1" ><input  type="hidden">
			<div class="form-horizontal" style="margin-top:0px"><br>
				<div class="form-group error" >
					<label class="col-sm-3 control-label" for="UserName">Username</label>
					<div class="col-sm-8 input-wrapper">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
							<input class="form-control" style="width:84%; height:37px; margin-left:38px" data-val="true" data-val-required="User name wajib diisi" 
								id="inputUsername" name="UserName" placeholder="Username" type="text" value="">
						<span class="hide error-message"><span class="field-validation-valid" data-valmsg-for="UserName" data-valmsg-replace="true"></span></span>
					</div>
				</div>
				<!--
				<div class="form-group">
					<label class="col-sm-3 control-label" for="Password">Password</label>
						<div class="col-sm-8 input-wrapper">
							<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-eye-open showPassword" aria-hidden="true">&nbsp;&nbsp;</span>
								<input class="form-control" style="width:87%; height:37px; margin-left:38px"  data-val="true" data-val-required="Password wajib diisi" 
									id="inputPassword" name="Password" placeholder="Password" type="password" value=""> 
							<br>
						</div>
				</div>
				-->
				<div class="form-group">
				 
				        <label class="col-sm-3 control-label" for="Password">Password</label>
                        <div class="col-sm-8 input-wrapper">
                            <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                            <span class="glyphicon glyphicon-eye-open showPassword" aria-hidden="true" id="eye"></span>
                                <input class="form-control" style="width:84%; height:37px; margin-left:38px"  data-val="true" data-val-required="Password wajib diisi"
                                    id="password" name="Password" placeholder="Password" type="password" value="">
                            <br>
                        </div>
                            </div>
 
<script src="mesin/jss/jquery.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#eye').hover(function(){
            $('#password').prop('type','text');
        },function(){
            $('#password').prop('type','password');
        })
        });
</script>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-8 text-right">
						<button type="submit" class="btn btn-success btn-block doblockui" onClick="validateAndSend()">LOGIN</button>
					</div>
				</div>
			</div>
		</form>                
</div>
</div>
</div>

<div id="buntut"  >

<div style="margin-top:0px; bottom:50px; background-color:#dcdcdc; padding:7px; font-size:12px">
    <div class="content">
	<?php if  (file_exists('./config/madipo_cbt.sql')){echo "MADIPO-CBT :";} else {echo "BeeSMART-CBT :";}?>
	 <strong> v3_Rev3</strong><br>
	Modified @2017 by MBA
<!--		BeeSMART-CBT : <strong> v3.0</strong><br>
		Modifikasi : <strong> Rev3</strong><br>-->
    </div>
</div>
<footer>
<div class="group" style="background-color:<?php echo $warna; ?>;">
    <div  style="background-color:<?php echo $warna; ?>; padding:7px; font-size:12px">
        <p><b><span style="color: #ff0000;"><?php echo strtoupper("$footer"); ?> </span></b><br> <span style="color: #1B06CF;">Supported by BEESMART</span></p>
    </div>
</footer>
<script src="mesin/js/jquery.cookie.js"></script>
<script src="mesin/js/common.js"></script>
<script src="mesin/js/main.js"></script>
<script src="mesin/js/cookieList.js"></script>
<script src="mesin/js/backend.js"></script>

<script>
document.oncontextmenu = document.body.oncontextmenu = function() {return false;}
</script>