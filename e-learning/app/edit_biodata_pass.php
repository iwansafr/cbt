<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>AJAX File Upload - Web Developer Plus Demos</title>
<script type="text/javascript" src="../../panel/pages/js/jquery-1.3.2.js" ></script>
<script type="text/javascript" src="../../panel/pages/js/ajaxupload.3.5.js" ></script>
<!--<link rel="stylesheet" type="text/css" href="ckeditor/styles.css" />-->

<script type="text/javascript" ></script>

<style>
.left {
    float: left;
    width: 73%;
}
.right {
    float: right;
    width: 25%;
}
.group:after {
    content:"";
    display: table;
    clear: both;
}
img {
    max-width: 100%;
    height: auto;
}
@media screen and (max-width: 480px) {
    .left, 
    .right {
        float: none;
        width: auto;
		margin-top:10px;		
    }
	
}
</style>
</head>
<body>
<script type="text/javascript" src="../../panel/js/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
 	var loading = $("#loading");
	var tampilkan = $("#tampilkan");

	loading.hide()
	$("#simpanpass").click(function(){
	
	var username = $("#username").val();
	var passlama = $("#passlama").val();
	var passbaru = $("#passbaru").val();
	var konfirmasi = $("#konfirmasi").val(); 
	
	$.ajax({
    type:"POST",
    url:"ubahbiodata_guru_pass.php",    
	data: "aksi=simpanpass&username=" + username + "&passlama=" + passlama
	+ "&passbaru=" + passbaru + "&konfirmasi=" + konfirmasi,
	success: function(data){
		loading.fadeOut();
		$("#info").html(data);
		$("#info").fadeOut(2000);
	 }
	 });
	 });
});
 
</script>
<div id="mainbody" >
<?php 
include "../../config/server.php";

	$sql = mysqli_query($sqlconn, "select * from cbt_user WHERE Username='$_COOKIE[beeuser]'");
	$xadm = mysqli_fetch_array($sql);
	$nama= $xadm['Nama'];
	
	
?>

<br />

    <div class="left">
    				<div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>FORM GANTI PASSWORD</h3>
                        </div>
                        <div class="panel-body">
                            <table width="100%" border="0px">
                            <tr height="42px"><td width="30%">Nama&nbsp;</td><td>: <td> &nbsp;&nbsp;&nbsp;<?php echo "$nama"; ?></td><td width="30%"></td></tr>
							
                            <tr height="42px"><td width="30%">User Name&nbsp;</td><td>: <td>
								<input type="text" class="form-control" id="username" value="<?php echo "$_COOKIE[beeuser]"; ?>"/></td><td width="30%"></td></tr>
                            <tr height="42px"><td width="30%">Password Lama&nbsp;</td><td>: <td>
								<input class="form-control" type="password" id="passlama" value="" /></td><td width="30%"></td></tr>
                            <tr height="42px"><td width="30%">Password Baru&nbsp;</td><td>: <td>
								<input class="form-control" type="password" id="passbaru" value="" /></td><td width="30%"></td></tr>
                            <tr height="42px"><td width="30%">Konfirmasi Password Baru&nbsp;</td><td>: <td>
								<input class="form-control" type="password" id="konfirmasi" value="" /></td><td width="30%"></td></tr>
												
                            </table>
                        </div>
						<div class="panel-body">Bila Salah silahkan refresh/reload web</div>
                        <div class="panel-footer">
                            <input type="submit"  class="btn btn-info btn-lg btn-small" id="simpanpass" name="simpanpass" value="Simpan">
                            <div id="info"></div><div id="loading"><img src="../../panel/pages/images/loading.gif" height="10"></div>
                        </div>
                    </div>
			
			</div>
  
                     
</body>
