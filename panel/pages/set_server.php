<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
	
	include "../../config/server.php";
	$folderpusat= $log['XFolderPusat'];
	
	$sql = mysqli_query($sqlconn,"select * from server_pusat");
	$xadm = mysqli_fetch_array($sql);
	$serverid= $xadm['XServerId'];
	$skulnam= $xadm['XSekolah']; 
	$ipserver= $xadm['XIPSekolah']; 
	$skulala= $xadm['XStatus'];
	$database= $xadm['XUsername']; 
	$passw= $xadm['XPass'];
	$dbnama= $xadm['XDbName'];
?>

<!DOCTYPE html>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>AJAX File Upload - Web Developer Plus Demos</title>
<script type="text/javascript" src="js/jquery-1.3.2.js" ></script>
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<!--<link rel="stylesheet" type="text/css" href="./styles.css" />-->
<style>
.left {
    float: left;
    width: 25%;
}
.right {
    float: left;
    width: 100%;
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
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 	var loading = $("#loading");
	var tampilkan = $("#tampilkan");

	loading.hide()
//apabila terjadi event onchange terhadap object <select id=propinsi>
 $("#simpan").click(function(){

 
 var txt_nama = $("#namaskul").val();
 var txt_id = $("#server").val();
 var txt_ip = $("#ip_server").val();
 var txt_user = $("#userm").val();
 var txt_pas = $("#pas_data").val();
 var txt_db = $("#nama_db").val();
 var folderpusat = $("#folderpusat").val();
 
 $.ajax({
     type:"POST",
     url:"set_server_ubah.php",    
     data: "aksi=simpan&txt_ip=" + txt_ip + "&txt_user=" + txt_user + "&txt_pas=" + txt_pas + "&txt_db=" + txt_db + "&folderpusat=" + folderpusat,
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
<br />
<span>

<div class="group">
    <div class="right">
    				<div class="panel panel-primary">
                        <div class="panel-heading">
                            Setting Server Pusat
                        </div>
                        <div class="panel-body">
                            <table width="80%">
                            <tr height="42px"><td width="50%">Id Sekolah</td><td>: &nbsp;<td><?php echo "$serverid"; ?></td></tr>
                            <tr height="42px"><td >Nama Sekolah</td><td>: <td><?php echo "$skulnam"; ?></td></tr>
							 <tr height="42px"><td>Folder Server Pusat ( huruf tidak peka a/A )</td><td>: <td><input class="form-control" type="text" id="folderpusat"  value="<?php echo "$folderpusat"; ?>"/></td></tr>
                            <tr height="42px"><td>IP/Hostname Server Pusat</td><td>: <td><input type="text" class="form-control" id="ip_server"  value="<?php echo "$ipserver"; ?>"/></td></tr>
                            <tr height="42px"><td>Nama Database</td><td>:<td> <input class="form-control" type="text" id="nama_db"  value="<?php echo "$dbnama"; ?>"/></td></tr>
                            <tr height="42px"><td>Username Db</td><td>: <td><input class="form-control" type="text" id="userm"  value="<?php echo "$database"; ?>"/></td></tr>
                            <tr height="42px"><td>Pass Db Pusat</td><td>: <td><input class="form-control" type="password" id="pas_data"  value="<?php echo "$passw"; ?>"/></td></tr>
                             
					<!--<script>
						$(function() { $('#cp1').colorpicker(); });
					</script>-->
							</td></tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <input type="submit"  class="btn btn-info btn-lg btn-small" id="simpan" name="simpan" value="Simpan">
                            <div id="info"></div><div id="loading"><img src="images/loading.gif" height="10"></div>
                        </div>
                    </div>
    
    
    
	</div>
</div>    

</div>                    
</body>